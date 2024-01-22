<?php
// $at->setToken(1);
function login_user()
{
	global $outputjson, $gh, $db, $tz_name, $at, $ur, $ud;
	
	$at = new user_token();
	$outputjson['success'] = 0;
	$username = $gh->read("email");
	$username = addslashes(str_replace('&apos;', "'", $username));
	$password = $gh->read("password");
	$dateNow = date('Y-m-d H:i:s');
	$from = $gh->read('from', PANEL_CONSTANT);
	$where = " ";
	
	if (empty($username)) {
		$outputjson['message'] = "Username is required.";
		return;
	}
	if (empty($password)) {
		$outputjson['message'] = "Password is required.";
		return;
	}
	$user_id = 0;
	$where = "( usr.username ='" . $username . "' ) ";
	
	$query_user = "SELECT usr.*
	,ifnull((SELECT GROUP_CONCAT(ur.`roleid`) asrid from tbl_userrole ur where ur.userid=usr.id),'') as userroleid
	,ifnull((SELECT GROUP_CONCAT(tr.`role`) asrid from tbl_userrole ur inner join tbl_roles tr on tr.id=ur.roleid where ur.userid=usr.id),'') as userrole
	,IFNULL((SELECT GROUP_CONCAT(uc.cmpid) AS cmpid FROM tbl_user_cmp uc WHERE uc.userid=usr.id),'') AS allcmpid
	,IFNULL((SELECT uc.cmpid AS cmpid FROM tbl_user_cmp uc WHERE uc.userid=usr.id order by uc.id asc limit 1),'') AS cmpid
	FROM tbl_users as usr WHERE " . $where . "";
	$rows = $db->execute($query_user);

	if ($rows != null && is_array($rows) && count($rows) > 0) {
		$user = $rows[0];
		$userPassword = $user['password'];
		$userroleid = $user['userroleid'];
		$user_id = $user['id'];
		$role_id = $user['role_id'];
		
		// remove password from user object
		unset($user["password"]);
		unset($user["otp"]);
		// echo $userPassword.' == '.md5($password);
		if ($userPassword == md5($password)) {	

			if($from == PANEL_CONSTANT)
			{
				$update = array();
				$update['last_logged_in'] = $dateNow;
				if (!empty($gh->read('tzid', ''))) {
					
					$timezone = new DateTimeZone($tz_name);
					$tz_offset1 = $timezone->getOffset(new DateTime);
					$seconds = $tz_offset1;
					$offset = ($seconds / 60) + ($seconds % 60);
					$update['last_login_offset'] = $offset;
				}
				if (count($update) > 0) {
					$db->update("tbl_users", $update, array("id" => $user["id"]));
				}
				
				$qry_ur = "SELECT tm.*, rights.id, CASE WHEN (rights.id != '') THEN 1 ELSE 0 END AS tmp
					,IFNULL((SELECT ur.viewright FROM tbl_userrights ur WHERE tm.id=ur.menuid AND ur.roleid='$userroleid' AND (CASE WHEN (rights.id != '') THEN ur.personid='$user_id' ELSE ur.personid='' END)),0) AS viewright 
					,IFNULL((SELECT ur.addright FROM tbl_userrights ur WHERE tm.id=ur.menuid AND ur.roleid='$userroleid' AND (CASE WHEN (rights.id != '') THEN ur.personid='$user_id' ELSE ur.personid='' END)),0) AS addright 
					,IFNULL((SELECT ur.editright FROM tbl_userrights ur WHERE tm.id=ur.menuid AND ur.roleid='$userroleid' AND (CASE WHEN (rights.id != '') THEN ur.personid='$user_id' ELSE ur.personid='' END)),0) AS editright 
					,IFNULL((SELECT ur.deleteright FROM tbl_userrights ur WHERE tm.id=ur.menuid AND ur.roleid='$userroleid' AND (CASE WHEN (rights.id != '') THEN ur.personid='$user_id' ELSE ur.personid='' END)),0) AS deleteright 
					FROM tbl_menumaster tm
					LEFT JOIN tbl_userrights rights ON rights.menuid = tm.id AND rights.personid = '$user_id'";
				$res_ur = $db->execute($qry_ur);
				$ur->setRights($res_ur);
			}

			$ud->setUser($user);
			$token_data = $gh->getjwt($user['id'], $from);
			if($token_data['status'] == "1")
			{
				$at->setToken($token_data['token']);
			}

			// $outputjson['token'] = $at->getToken();
			$outputjson['success'] = 1;
			$outputjson['global_search_flag'] = 1;
			$outputjson['message'] = 'User logged in successfully.';
			$outputjson["data"] = $user;
		} else {
			$outputjson['message'] = "Invalid password. contact your Account Administrator.";
		}
	} else {
		$outputjson['message'] = "Your account is Inactive or this Username does not exist.";
	}
}
