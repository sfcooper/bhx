<?php
// Main Plugin file for the plugin Google Analytics
// © 2014 - 2017 juventiner
// ----------------------------------------
// Last Update: 09.01.2017

if(!defined('IN_MYBB'))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

$plugins->add_hook('pre_output_page','googleanalytics');
$plugins->add_hook("usercp_options_end", "googleanalytics_usercp");
$plugins->add_hook("usercp_do_options_end", "googleanalytics_usercp");

function googleanalytics_info()
{
	global $lang;
	$lang->load('googleanalytics');
	
	return array
	(
		'name'			=> $lang->googleanalytics_info_name,
		'description'	=> $lang->googleanalytics_info_desc,
		'website'		=> 'http://community.mybb.com/user-32469.html',
		'author'		=> 'juventiner',
		'authorsite'	=> 'https://www.mybboard.de/forum/user-5490.html',
		'version'		=> '1.7',
		'compatibility' => '14*,16*,18*',
		'codename'		=> 'googleanalytics'
	);
}

function googleanalytics_install() {
	global $db;
	
	// Add field for user option
	$db->query("ALTER TABLE ".TABLE_PREFIX."users ADD DisableGoogleAnalytics int NOT NULL default '0'");
}

function googleanalytics_is_installed()
{
	global $db;
	
	if($db->field_exists("DisableGoogleAnalytics", "users"))
	{
		return true;
	}
	else 
	{
		return false;
	}
}

function googleanalytics_uninstall()
{
	global $db;
	
	if($db->field_exists("DisableGoogleAnalytics", "users"))
		$db->query("ALTER TABLE ".TABLE_PREFIX."users DROP COLUMN DisableGoogleAnalytics");
}

// This function runs when the plugin is activated.
function googleanalytics_activate()
{
	global $db, $lang;
	$lang->load('googleanalytics');

	$insertarray = array(
		'name' => 'googleanalytics',
		'title' => $db->escape_string($lang->googleanalytics_settings_name),
		'description' => $db->escape_string($lang->googleanalytics_settings_desc),
		'disporder' => 35,
		'isdefault' => 0,
	);
	$gid = $db->insert_query("settinggroups", $insertarray);
	
	$insertarray = array(
		'name' => 'googleanalytics_status',
		'title' => $db->escape_string($lang->googleanalytics_settings_status_name),
		'description' => $db->escape_string($lang->googleanalytics_settings_status_desc),
		'optionscode' => 'yesno',
		'value' => 0,
		'disporder' => 1,
		'gid' => $gid
	);
	$db->insert_query("settings", $insertarray);
	
	$insertarray = array(
		'name' => 'googleanalytics_ip_anonymize',
		'title' => $db->escape_string($lang->googleanalytics_settings_anonymize_name),
		'description' => $db->escape_string($lang->googleanalytics_settings_anonymize_desc),
		'optionscode' => 'yesno',
		'value' => 0,
		'disporder' => 1,
		'gid' => $gid
	);
	$db->insert_query("settings", $insertarray);
	
	$insertarray = array(
		'name' => 'googleanalytics_ID',
		'title' => $db->escape_string($lang->googleanalytics_settings_url_name),
		'description' => $db->escape_string($lang->googleanalytics_settings_url_desc),
		'optionscode' => 'text',
		'value' => '',
		'disporder' => 2,
		'gid' => $gid
	);
	$db->insert_query("settings", $insertarray);
	
	$insertarray = array(
		'name' => 'googleanalytics_allow_to_hide',
		'title' => $db->escape_string($lang->googleanalytics_settings_allow_to_hide_name),
		'description' => $db->escape_string($lang->googleanalytics_settings_allow_to_hide_desc),
		'optionscode' => 'yesno',
		'value' => 1,
		'disporder' => 3,
		'gid' => $gid
	);
	$db->insert_query("settings", $insertarray);

	rebuild_settings();

}

// This function runs when the plugin is deactivated.
function googleanalytics_deactivate(){

	global $db;
	$db->delete_query("settings", "name IN('googleanalytics_status','googleanalytics_ID','googleanalytics_status')");
	$db->delete_query("settinggroups", "name IN('googleanalytics')");
}

function googleanalytics_usercp() {

	global $db, $mybb, $templates, $user, $lang;
	
	$lang->load('googleanalytics');
	
	if($mybb->settings['googleanalytics_allow_to_hide'] == 1) {
	
	if($mybb->request_method == "post")
	{
		$update_array = array(
			"DisableGoogleAnalytics" => intval($mybb->input['DisableGoogleAnalytics'])
		);		
		$db->update_query("users", $update_array, "uid = '".$user['uid']."'");
	}
	
	$add_option = '</tr><tr>
<td valign="top" width="1"><input type="checkbox" class="checkbox" name="DisableGoogleAnalytics" id="DisableGoogleAnalytics" value="1" {$GLOBALS[\'$GoogleAnalyticsChecked\']} /></td>
<td><span class="smalltext"><label for="DisableGoogleAnalytics">{$lang->googleanalytics_disable_usercp}</label></span></td>';

	$find = '{$lang->show_codebuttons}</label></span></td>';
	$templates->cache['usercp_options'] = str_replace($find, $find.$add_option, $templates->cache['usercp_options']);
	
	$GLOBALS['$GoogleAnalyticsChecked'] = '';
	if($user['DisableGoogleAnalytics'])
	{
		$GLOBALS['$GoogleAnalyticsChecked'] = "checked=\"checked\"";
	}
	}
}

function googleanalytics($page)
{
	global $mybb, $user;
	
	if($mybb->settings['googleanalytics_ip_anonymize'] == 1) {
		$gaa = "ga('set', 'anonymizeIp', true);";
	} else {
		$gaa ="";
	}
	
	if($mybb->settings['googleanalytics_status'] == 1 && ($user['DisableGoogleAnalytics'] == 0 || $mybb->settings['googleanalytics_allow_to_hide'] == 0))
	{
		$page=str_replace("</head>","<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '".htmlspecialchars_uni($mybb->settings['googleanalytics_ID'])."', 'auto');
  ga('send', 'pageview');
".$gaa."
</script></head>",$page);
	}
	return $page;
}
?>
