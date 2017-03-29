<?php

/**
 * Online Today 2.0
 * Compatobyllity MyBB 1.8.x
 * Contact: neogeoman@gmail.com
 * Website: http://www.mybb.com
 * Author:  Dark Neo
 */
 
define("IN_MYBB", 1);
$filename = substr($_SERVER['SCRIPT_NAME'], -strpos(strrev($_SERVER['SCRIPT_NAME']), "/"));
define('THIS_SCRIPT', $filename);
$templatelist = "online_today_all, online_today_index,online_today_rows";
require_once "./global.php";

require_once MYBB_ROOT.'inc/plugins/onlinetoday.php';
$lang->load('onlinetoday', false, true);
add_breadcrumb($lang->whos_online_today, THIS_SCRIPT);

global $db, $mybb, $templates, $online_today, $lang, $theme, $spiders;
$online_today = '';
if(!is_array($spiders))
{
	global $cache;
	$spiders = $cache->read('spiders');
}	
if($mybb->settings['showwol'] != 0 && $mybb->usergroup['canviewonline'] != 0)
{
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
if(!$online_today)
{
	$online_today = "You don't have permissions to see this content";
}

eval("\$online_today_res = \"".$templates->get("online_today_all")."\";");

output_page($online_today_res);
exit;
?>