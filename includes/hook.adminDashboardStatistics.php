<?php
//##copyright##

if (iaView::REQUEST_HTML == $iaView->getRequestType() && $iaView->blockExists('member_on_map'))
{
	if ($onlineMembers = $iaCore->factory('users')->getVisitorsInfo())
	{
		foreach ($onlineMembers as &$entry)
		{
			$userName = $entry['username'];
			$ip = long2ip($entry['ip']);
			$entry = iaUtil::jsonDecode(file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=89fe0a129bbdd51694b0dd3997f7db74139ed3124771ba2f2104d392e6cf29ad&ip={$ip}&format=json"));
			$entry['username'] = $userName;
		}
	}

	$iaView->assign('onlineMembers', $onlineMembers);
}