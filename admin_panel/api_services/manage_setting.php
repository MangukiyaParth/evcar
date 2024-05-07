<?php

function manage_setting()
{
	global $outputjson, $gh, $db,$role_admin;
	$outputjson['success'] = 0;
	$outputjson['status'] = 0;

	$action = $gh->read("action");
	if($action == "update_data"){
		
		$user_id = $gh->read("user_id", 0);
		$password = $gh->read("password");
		$date = date('Y-m-d H:i:s');
		if ($password) {
			$query = "SELECT * FROM tbl_users where id='$user_id'";
			$filtered_count = $db->execute($query);
			if(sizeof($filtered_count) > 0)
			{
				$data = array(
					"password" => md5($password),
				);
				$db->update("tbl_users", $data, array("id" => $user_id));
				
				$outputjson['success'] = 1;
				$outputjson['message'] = "Data updated	successfully";
			}else{
				$outputjson['success'] = 0;
				$outputjson['message'] = "Somthing went wrong";
			}
		} else {
			$outputjson['message'] = "Please add require fields!";
		}
	}	
}