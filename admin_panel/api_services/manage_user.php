<?php

function manage_user()
{
	global $outputjson, $gh, $db,$role_admin;
	$outputjson['success'] = 0;
	$outputjson['status'] = 0;

	$action = $gh->read("action");

	if($action == "get_data")
	{
		$start = $gh->read("start");
		$length = $gh->read("length");
		$searcharr = $gh->read("search");
		$search = $searcharr['value'];
		$orderarr = $gh->read("order");
		$orderindex = $orderarr[0]['column'];
		$orderdir = $orderarr[0]['dir'];
		$columnsarr = $gh->read("columns");
		$ordercolumn = $columnsarr[$orderindex]['name'];

		$whereData = "(
			p.name LIKE '%" . $search . "%' 
			or IFNULL((SELECT GROUP_CONCAT(cm.role) AS rolename FROM tbl_roles cm INNER JOIN tbl_userrole uc ON uc.roleid=cm.id WHERE uc.userid=p.id),'') LIKE '%" . $search . "%' 
		)";
	
		$total_count = $db->get_row_count('tbl_users', " id != '17019352-1247-1172-9a37-27852d564b27' ");
		$filtered_count = 0;
		$count_query = "SELECT count(DISTINCT p.id) as cnt FROM tbl_users as p 
			WHERE p.id != '17019352-1247-1172-9a37-27852d564b27' AND " . $whereData;
		$filtered_count = $db->execute_scalar($count_query);
	
		 $orderby = " ORDER BY p.entry_date DESC";
		if ($orderindex > 0) {
			$orderby = " ORDER BY " . $ordercolumn . " " . $orderdir;
		}
		$query_port_rates = "SELECT DISTINCT p.*,p.id AS md5_id,
		IFNULL((SELECT GROUP_CONCAT(uc.roleid) AS roleid FROM tbl_userrole uc WHERE uc.userid=p.id),'') AS roleid,
		IFNULL((SELECT GROUP_CONCAT(cm.role) AS rolename FROM tbl_roles cm INNER JOIN tbl_userrole uc ON uc.roleid=cm.id WHERE uc.userid=p.id),'') AS rolename,st.statename,ct.cityname
		FROM tbl_users as p 
		inner join tbl_statemaster st on st.id=p.stateid
		inner join tbl_citymaster ct on ct.id=p.cityid
			WHERE p.id != '17019352-1247-1172-9a37-27852d564b27' AND " . $whereData . " " . $orderby . " LIMIT " . $start . "," . $length . "";
		$rows = $db->execute($query_port_rates);

		if ($rows != null && is_array($rows) && count($rows) > 0) {
			
			$outputjson['recordsTotal'] = $total_count;
			$outputjson['recordsFiltered'] = $filtered_count;
			$outputjson['success'] = 1;
			$outputjson['status'] = 1;
			$outputjson['message'] = 'success.';
			$outputjson["data"] = $rows;
		} else {
			$outputjson["data"] = [];
			$outputjson['recordsTotal'] = $total_count;
			$outputjson['recordsFiltered'] = 0;
			$outputjson['message'] = "No Products found!";
		}
	}
	else if($action == "add_data"){
		$id = $gh->read("id");
		$user_id = $gh->read("user_id", 0);
		$cmpid = $gh->read("cmpid");
		$roleid = $gh->read("roleid");
		$personname = $gh->read("personname");
		$contact1 = $gh->read("contact1");
		$contact2 = $gh->read("contact2");
		$email = $gh->read("email");
		$address = $gh->read("address");
		$stateid = $gh->read("stateid");
		$cityid = $gh->read("cityid");
		$pincode = $gh->read("pincode");
		$username = $gh->read("username");
		$password = $gh->read("password");
		$date = date('Y-m-d H:i:s');
		$formevent = $gh->read("formevent");
		$date = date('Y-m-d H:i:s');
		if ($roleid && $personname && $contact1) {
			if($formevent== 'submit')
			{	
				$query = "SELECT * FROM tbl_users where name='$personname'";
				$filtered_count = $db->execute($query);
				if(sizeof($filtered_count) > 0)
				{
					$outputjson['success'] = 0;
					$outputjson['message'] = "Data Already Exist";
				}else{
					$id=$gh->generateuuid();
					$data = array(
						"id" => $id,
						"name" => $personname,
						"contact" => $contact1,
						"email" => $email,
						"address" => $address,
						"stateid" => $stateid,
						"cityid" => $cityid,
						"pincode" => $pincode,
						"username" => $username,
						"password" => md5($password),
						"entry_uid" => $user_id,
						"entry_date" => $date,
					);
					$db->insert("tbl_users", $data);

					$urid=$gh->generateuuid();
					$data_role = array(
						"id" => $urid,
						"userid" => $id,
						"roleid" => $roleid,
					);	
					$db->insert("tbl_userrole", $data_role);
					
					$outputjson['result'] = [];
					$outputjson['success'] = 1;
					$outputjson['message'] = "Data added successfully";
				}
			}
			else {
				$query = "SELECT * FROM tbl_users where name='$personname' AND id <> '$id'";
				$filtered_count = $db->execute($query);
				if(sizeof($filtered_count) > 0)
				{
					$outputjson['success'] = 0;
					$outputjson['message'] = "Data Already Exist";
				}else{
					$data = array(
						"name" => $personname,
						"contact" => $contact1,
						"email" => $email,
						"address" => $address,
						"stateid" => $stateid,
						"cityid" => $cityid,
						"pincode" => $pincode,
						"update_uid" => $user_id,
						"update_date" => $date,
					);
					$db->update("tbl_users", $data, array("id" => $id));
					
					$db->delete('tbl_userrole', array("userid" => $id));
					if($roleid)
					{
						$urid=$gh->generateuuid();
						$data_role = array(
							"id" => $urid,
							"userid" => $id,
							"roleid" => $roleid,
						);
						
						$db->insert("tbl_userrole", $data_role);
					}
					$outputjson['success'] = 1;
					$outputjson['message'] = "Data updated	successfully";
				}
			}
		} else {
			$outputjson['message'] = "Please add require fields!";
		}
	}
	else if($action =='resetuserpass')
	{
		$id = $gh->read("id");
		$user_id = $gh->read("user_id", 0);
		$date = date('Y-m-d H:i:s');
		$password = $gh->read("password");
		$data = array(
			"password" => md5($password),
			"update_uid" => $user_id,
			"update_date" => $date,
		);
	
		$rows = $db->update('tbl_users', $data, array("id" => $id));
		$outputjson['success'] = 1;
		$outputjson['message'] = 'password Reset successfully.';
		$outputjson["data"] = $rows;
	}
	
}