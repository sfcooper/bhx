<?php

if(!defined("IN_MYBB")) {
    die("You cannot access this file directly. Please make sure IN_MYBB is defined.");
}

function bcrypt_info() {
	return Bcrypt::info();
}

function bcrypt_activate() {
	Bcrypt::activate();
}

function bcrypt_deactivate() {
	Bcrypt::deactivate();
}

class Bcrypt {

	private static $description = "Upgrades the login system by storing hashes using bcrypt instead of md5 and by not rehashing the password every time a user makes a failed login attempt.  Also makes login backwards-compatible with unsalted md5 login setups such that, if the salt field of the database is blank, the software will accept the md5 password hash.  This plugin is backwards-compatible with MyBB md5 password hashing and will not rehash values in the database until the user changes their password.  The use of hooks for this functionality was not possible, so this plugin modifies files on activation and creates backups.  On deactivation, it restores the file from the oldest backup it has.";

	public static function info() {
		return array(
			"name"  		=> "Bcrypt",
			"description"	=> self::$description,
			"website"       => "http://forums.woodnet.net",
			"author"        => "kloddant",
			"authorsite"    => "http://forums.woodnet.net",
			"version"       => "1.0",
			"guid"          => "",
			"compatibility" => "18*"
		);
	}

	public static function activate() {
		global $db;

		self::rewrite_functions_user();
		self::rewrite_datahandler_user();
		self::rewrite_datahandler_login();

		$group = array(
	        'name'  	  => 'bcrypt',
	        'title'       => 'Bcrypt',
	        'description' => self::$description,
	        'disporder'   => "1",
	        'isdefault'   => "0",
	    );

	    $db->insert_query('settinggroups', $group);
	 	$gid = intval($db->insert_id());

		rebuild_settings();
	}

	public static function deactivate() {
		global $db;

		self::restore_file(MYBB_ROOT."inc/functions_user.php");
		self::restore_file(MYBB_ROOT."inc/datahandlers/user.php");
		self::restore_file(MYBB_ROOT."inc/datahandlers/login.php");

	 	$db->query("
	 		DELETE FROM ".TABLE_PREFIX."settings 
	 		WHERE name LIKE 'bcrypt%'
	 	");
	    $db->query("
	    	DELETE FROM ".TABLE_PREFIX."settinggroups 
	    	WHERE name = 'bcrypt'
	    ");

		rebuild_settings();
	}

	private static function restore_file($path) {
		$path_info = pathinfo($path);
		$directory = $path_info['dirname'];
		$filenames = scandir($directory);
		$restore_file_name = $path_info['basename'];
		$oldest_datetime = new DateTime();
		// Find the oldest backup file.
		foreach ($filenames as $filename) {
			preg_match("/".$path_info['basename']."\.backup_(\d{14})/", $filename, $matches);
			if ($matches) {
				$datetime = date_create_from_format("YmdHis", $matches[1]);
				if ($datetime < $oldest_datetime) {
					$restore_file_name = $filename;
				}
			}
		}
		if ($restore_file_name != $path_info['basename']) {
			$main_file_pointer = fopen($directory."/".$path_info['basename'], "w+");
			$restore_file_string = implode("", file($directory."/".$restore_file_name));
			fwrite($main_file_pointer, $restore_file_string);
			fclose($main_file_pointer);
		}
	}

	private static function rewrite_function($old_function_name = "", $new_function_string = "") {
		/*
			If this function is being called on multiple functions in the same file, 
			it should be called on them in the reverse order from which they were defined.
		*/
	    if (strpos($old_function_name, "::") !== false) {
			$old_function = explode("::", $old_function_name);
			$old_class = $old_function[0];
			$old_method = $old_function[1];
			$reflection = new ReflectionMethod($old_class, $old_method);
		}
		else {
			$reflection = new ReflectionFunction($old_function_name);
		}

		$filename = $reflection->getFileName();
		$start_line = $reflection->getStartLine() - 1;
		$end_line = $reflection->getEndLine();
		$length = $end_line - $start_line;

		$source = file($filename);
		$old_function_string = trim(implode("", array_slice($source, $start_line, $length)));

		$file_pointer = fopen($filename, "w+");
		$old_file_string = implode("", $source);

		$new_file_string = str_replace(trim($old_function_string), trim($new_function_string), $old_file_string);

		file_put_contents($filename.".backup_".date("YmdHis"), $old_file_string);
		fwrite($file_pointer, $new_file_string);
		fclose($file_pointer);
	}

	private static function rewrite_functions_user() {
		$validate_password_from_uid = '
			function validate_password_from_uid($uid, $password, $user = array()) {
				global $db, $mybb;
				if(isset($mybb->user["uid"]) && $mybb->user["uid"] == $uid) {
					$user = $mybb->user;
				}
				if(!$user["password"]) {
					$query = $db->simple_select("users", "uid,username,password,salt,loginkey,usergroup", "uid=\'".(int)$uid."\'");
					$user = $db->fetch_array($query);
				}
				$hash = $user["password"];

				if(!$user["loginkey"]) {
					$user["loginkey"] = generate_loginkey();
					$sql_array = array(
						"loginkey" => $user["loginkey"]
					);
					$db->update_query("users", $sql_array, "uid = ".$user["uid"]);
				}
				// old method
				if(salt_password(md5($password), $user["salt"]) === $hash or md5($password) === $hash) {
					return $user;
				}
				// new method
				else if (password_verify($password, $hash)) {
					return $user;
				}
				else {
					return false;
				}
			}
		';

		$update_password = '
			function update_password($uid, $password) {
				global $db, $plugins;

				$newpassword = array(
					"password" => password_hash($password, PASSWORD_DEFAULT),
					"loginkey" => generate_loginkey(),
				);

				// Update password and login key in database
				$db->update_query("users", $newpassword, "uid=\'$uid\'");

				$plugins->run_hooks("password_changed");

				return $newpassword;
			}
		';

		self::rewrite_function("update_password", $update_password);
		self::rewrite_function("validate_password_from_uid", $validate_password_from_uid);
	}

	private static function rewrite_datahandler_user() {
		@include_once(MYBB_ROOT."inc/datahandlers/user.php");
		$verify_password = '
			function verify_password() {
				global $mybb;

				$user = &$this->data;

				// Always check for the length of the password.
				if(my_strlen($user["password"]) < $mybb->settings["minpasswordlength"] || my_strlen($user["password"]) > $mybb->settings["maxpasswordlength"]) {
					$this->set_error("invalid_password_length", array($mybb->settings["minpasswordlength"], $mybb->settings["maxpasswordlength"]));
					return false;
				}

				// Has the user tried to use their email address or username as a password?
				if($user["email"] === $user["password"] || $user["username"] === $user["password"]) {
					$this->set_error("bad_password_security");
					return false;
				}

				// See if the board has "require complex passwords" enabled.
				if($mybb->settings["requirecomplexpasswords"] == 1) {
					// Complex passwords required, do some extra checks.
					// First, see if there is one or more complex character(s) in the password.
					if(!preg_match("/^.*(?=.{".$mybb->settings["minpasswordlength"].",})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $user["password"])) {
						$this->set_error("no_complex_characters", array($mybb->settings["minpasswordlength"]));
						return false;
					}
				}

				// If we have a "password2" check if they both match
				if(isset($user["password2"]) && $user["password"] !== $user["password2"]) {
					$this->set_error("passwords_dont_match");
					return false;
				}

				// Hash the password
				$user["saltedpw"] = password_hash($user["password"], PASSWORD_DEFAULT);

				// Generate the user login key
				$user["loginkey"] = generate_loginkey();

				//Set the user display group
				$user["displaygroup"] = (int)$user["usergroup"];

				return true;
			}
		';
		self::rewrite_function("UserDataHandler::verify_password", $verify_password);
		unset($verify_password);
	}

	private static function rewrite_datahandler_login() {
		@include_once(MYBB_ROOT."inc/datahandlers/login.php");
		$verify_password = '
			function verify_password($strict = true) {
				global $db, $mybb, $plugins;

				$this->get_login_data();

				if(empty($this->login_data["username"])) {
					// Username must be validated to apply a password to
					$this->invalid_combination();
					return false;
				}

				$args = array(
					"this" => &$this,
					"strict" => &$strict,
				);

				$plugins->run_hooks("datahandler_login_verify_password_start", $args);

				$user = &$this->data;

				if(!$this->login_data["uid"] || $this->login_data["uid"] && !$this->login_data["salt"] && $strict == false) {
					$this->invalid_combination();
				}

				if($strict == true) {
					if(!$this->login_data["loginkey"]) {
						$this->login_data["loginkey"] = generate_loginkey();

						$sql_array = array(
							"loginkey" => $this->login_data["loginkey"]
						);

						$db->update_query("users", $sql_array, "uid = \'{$this->login_data["uid"]}\'");
					}
				}

				$salted_password = md5(md5($this->login_data["salt"]).md5($user["password"]));

				$plugins->run_hooks("datahandler_login_verify_password_end", $args);

				// old method
				if($salted_password === $this->login_data["password"] or ($this->login_data["password"] === md5($user["password"]) and $this->login_data["salt"] == "")) {
					return true;
				}
				// new method
				else if (password_verify($user["password"], $this->login_data["password"])) {
					return true;
				}

				$this->invalid_combination(true);
				return false;
			}
		';
		self::rewrite_function("LoginDataHandler::verify_password", $verify_password);
		unset($verify_password);
	}

}

?>