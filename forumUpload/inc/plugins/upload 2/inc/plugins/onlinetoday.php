<?php
if(!defined("IN_MYBB"))
{
    die("This file cannot be accessed directly.");
}

$plugins->add_hook('index_start', 'add_onlinetoday', 20);

function onlinetoday_info()
{
	return array(
		"name"			=>	"Online Today",
		"description"	=>	"Shows the users that has been online within 24 hours.",
		"website"		=>	"",
		"author"		=>	"Dark Neo",
		"authorsite"	=>	"https://soportemybb.es",
		"version"		=>	"2.0.1",
		"codename"		=>	"onlinetoday",
		"compatibility" =>	"18*",
	);
}

function onlinetoday_activate()
{
	global $db;
	$template = array(
		"tid"		=> NULL,
		"title"		=> "online_today_all",
		"template"	=> "<html>
<head>
<title>{\$mybb->settings[\'bbname\']}</title>
{\$headerinclude}
</head>
<body>
{\$header}
<table border=\"0\" cellspacing=\"{\$theme[\'borderwidth\']}\" cellpadding=\"{\$theme[\'tablespace\']}\" class=\"tborder\">
	<thead>
	<tr>
		<td class=\"thead{\$collapsedthead[\'boardstats\']}\">
			<div class=\"expcolimage\"><img src=\"{\$theme[\'imgdir\']}/collapse{\$collapsedimg[\'boardstats\']}.png\" id=\"onlinetoday_img\" class=\"expander\" alt=\"[-]\" title=\"[-]\" /></div>
			<div><strong>{\$lang->boardstats}</strong></div>
		</td>
	</tr>
	</thead>
	<tbody style=\"{\$collapsed[\'boardstats_e\']}\" id=\"onlinetoday_e\">
		{\$online_today}
	</tbody>
</table>
<br />		
{\$footer}
</body>
</html>",
		"sid"		=> "-1"
	);
	$db->insert_query("templates", $template);
	
	$template = array(
		"tid"		=> NULL,
		"title"		=> "online_today_index",
		"template"	=> "<tr>
	<td class=\"tcat\"><strong>{\$lang->whos_online_today}</strong> [<a href=\"onlinetoday.php?my_post_key={\$mybb->post_code}\">{\$lang->complete_list}</a>]</td>
</tr>
<tr>
	<td class=\"trow1\"><span class=\"smalltext\">{\$lang->online_note_today}<br />{\$onlinemembers}</span></td>
</tr>",
		"sid"		=> "-1"
	);
	$db->insert_query("templates", $template);

	$template = array(
		"tid"		=> NULL,
		"title"		=> "online_today_rows",
		"template"	=> "<div class=\"avatarep_online_row\">
	<span><img src=\"{\$user[\'avatar\']}\" alt=\"avatar\" class=\"avatarep_image\" /></span>
	<span class=\"avatarep_span\">{\$user[\'profilelink\']}{\$invisiblemark}</span>
</div>",
		"sid"		=> "-1"
	);
	$db->insert_query("templates", $template);
	
//Create stylesheet for this plugin...
	$style = '.avatarep_online_row{text-align:center;width:100px;display:inline-block;padding:0px 5px;}
.avatarep_image{display:block;width:80px;height:60px;border: 1px solid #cacaca; background: #fff;padding:8px;border-radius:4px;}
.avatarep_span{text-align:center;}';	
	$stylesheet = array(
		"name"			=> "online_today.css",
		"tid"			=> 1,
		"attachedto"	=> 0,		
		"stylesheet"	=> $db->escape_string($style),
		"cachefile"		=> "online_today.css",
		"lastmodified"	=> TIME_NOW
	);

	$sid = $db->insert_query("themestylesheets", $stylesheet);
	
	//Archivo requerido para cambios en estilos y plantillas.
	require_once MYBB_ADMIN_DIR.'/inc/functions_themes.php';
	cache_stylesheet($stylesheet['tid'], $stylesheet['cachefile'], $style);
	update_theme_stylesheet_list(1, false, true);

	require MYBB_ROOT."/inc/adminfunctions_templates.php";
	find_replace_templatesets('index_boardstats', '#{\$whosonline}#', "{\$whosonline}\n{\$online_today}");
}

function onlinetoday_deactivate()
{
	global $db;
	$db->query("DELETE FROM ".TABLE_PREFIX."templates WHERE title IN('online_today_index','online_today_all','online_today_rows')");

  	$db->delete_query('themestylesheets', "name='online_today.css'");
	$query = $db->simple_select('themes', 'tid');
	while($style = $db->fetch_array($query))
	{
		require_once MYBB_ADMIN_DIR.'inc/functions_themes.php';
		cache_stylesheet($style['tid'], $style['cachefile'], $style['stylesheet']);
		update_theme_stylesheet_list($style['tid'], false, true);	
	}
	
	require MYBB_ROOT."/inc/adminfunctions_templates.php";
	find_replace_templatesets('index_boardstats', '#(\n?){\$online_today}#', '', 0);
}

$plugins->add_hook("global_start", "online_today_load_templates");
function online_today_load_templates()
{
	if(isset($GLOBALS['templatelist']))
	{
		if(THIS_SCRIPT == "index.php" || THIS_SCRIPT == "onlinetoday.php")
		{	
			$GLOBALS['templatelist'] .= ',online_today_rows, online_today_index';
		}
	}
}
function add_onlinetoday()
{
	global $db, $mybb, $templates, $online_today, $lang, $theme, $spiders, $lang;
	$online_today = '';
	if(!is_array($spiders))
	{
		global $cache;
		$spiders = $cache->read('spiders');
	}	
	if($mybb->settings['showwol'] != 0 && $mybb->usergroup['canviewonline'] != 0)
	{
		$lang->load("onlinetoday", false, true);
		$lang->load("index", false, true);
		$timesearch = time() - 24*60*60;
		$queries = array();
		$queries[] = $db->simple_select(
			"users u LEFT JOIN ".TABLE_PREFIX."sessions s ON (u.uid=s.uid)", 
			"s.sid, s.ip, s.time, s.location, u.uid, u.username, u.invisible, u.usergroup, u.displaygroup, u.avatar",
			"u.lastactive > $timesearch ORDER BY u.username ASC, s.time DESC"
		);
		$queries[] = $db->simple_select(
			"sessions s LEFT JOIN ".TABLE_PREFIX."users u ON (s.uid=u.uid)",
			"s.sid, s.ip, s.uid, s.time, s.location, u.username, u.invisible, u.usergroup, u.displaygroup, u.avatar",
			"s.time>'$timesearch' ORDER BY u.username ASC, s.time DESC"
		);
		$comma = $onlinemembers = '';
		$membercount = $guestcount = $anoncount = 0;
		$doneusers = $ips = array();
		foreach($queries as $query)
		{
			while($user = $db->fetch_array($query))
			{
				if(isset($user['sid']))
				{
					$botkey = my_strtolower(str_replace("bot=", '', $user['sid']));
				}

				if($user['uid'] > 0)
				{
					if($doneusers[$user['uid']] < $user['time'] || !$doneusers[$user['uid']])
					{
						if($user['invisible'] == 1)
						{
							++$anoncount;
						}
						++$membercount;
						if($user['invisible'] != 1 || $mybb->usergroup['canviewwolinvis'] == 1 || $user['uid'] == $mybb->user['uid'])
						{
							$invisiblemark = ($user['invisible'] == 1) ? "*" : "";
							if(function_exists(avatarep_style_format)){
								$format = $user['dntstyle'];
								$username = $user['username'];

								if($format != "{username}"){
									$user['username'] = avatarep_style_format($username, $format);
								}
								else{							
									$user['username'] = format_name($user['username'], $user['usergroup'], $user['displaygroup']);
								}
							}
							else{							
								$user['username'] = format_name($user['username'], $user['usergroup'], $user['displaygroup']);
							}							
							$user['profilelink'] = build_profile_link($user['username'], $user['uid']);
							$user['avatar'] = htmlspecialchars_uni($user['avatar']);
							if(empty($user['avatar']))
							$user['avatar'] = "images/default_avatar.png";							
							eval("\$onlinemembers .= \"".$templates->get("online_today_rows", 1, 0)."\";");
							$comma = ", ";
						}

						if(isset($user['time']))
						{
							$doneusers[$user['uid']] = $user['time'];
						}
						else
						{
							$doneusers[$user['uid']] = $user['lastactive'];
						}
					}
				}
				// Otherwise this session is a bot
				else if(my_strpos($user['sid'], "bot=") !== false && $spiders[$botkey])
				{
					$user['bot'] = $spiders[$botkey]['name'];
					$user['usergroup'] = $spiders[$botkey]['usergroup'];
					$guests[] = $user;
					$onlinemembers .= $comma.format_name($user['bot'], $user['usergroup']);
					$comma = ", ";
					++$botcount;					
				}
				// Or a guest
				else
				{
					++$guestcount;
					$guests[] = $user['ip'];
				}
			}
		}
		
		$guestcount = (int)$guestcount;
		$onlinecount = $membercount + $guestcount;
		$onlinebit = ($onlinecount != 1) ? $lang->online_online_plural : $lang->online_online_singular;
		$memberbit = ($membercount != 1) ? $lang->online_member_plural : $lang->online_member_singular;
		$anonbit = ($anoncount != 1) ? $lang->online_anon_plural : $lang->online_anon_singular;
		$guestbit = ($guestcount != 1) ? $lang->online_guest_plural : $lang->online_guest_singular;
		$lang->online_note_today = $lang->sprintf($lang->online_note_today, my_number_format($onlinecount), $onlinebit, 24, my_number_format($membercount), $memberbit, my_number_format($anoncount), $anonbit, my_number_format($guestcount), $guestbit);
		eval("\$online_today = \"".$templates->get("online_today_index")."\";");
	}
}
?>
