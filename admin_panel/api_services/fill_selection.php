<?php

function fill_selection()
{
	global $outputjson, $gh, $at,$db,$acc_purparty,$acc_puracc,$acc_bank,$acc_cash,$role_admin;
	$outputjson['success'] = 0;
	// print_r($ur->getRights());
	$action = $gh->read("action");
	$user_id= $gh->read("user_id");
	$userrole_id= $gh->read("userrole_id");
	$from= $gh->read("from");
	
	if($action=='fill_state')
	{
		$countryid=$gh->read("countryid");
		$query = "SELECT * FROM tbl_statemaster WHERE countryid = '$countryid'";
		$qry_res = $db->execute($query);
		if(sizeof($qry_res)>0)
		{
			$outputjson["state"] = $qry_res;
		}
        $outputjson['message'] = 'Data Found';
        $outputjson['success'] = 1;
	}
	if($action=='fill_statewithout')
	{
		$countryid=$gh->read("countryid");
		$query = "SELECT * FROM tbl_statemaster ";
		$qry_res = $db->execute($query);
		if(sizeof($qry_res)>0)
		{
			$outputjson["state"] = $qry_res;
		}
        $outputjson['message'] = 'Data Found';
        $outputjson['success'] = 1;
	}
	else if($action=='fill_role')
	{
		$query = "SELECT * FROM tbl_roles WHERE id != '17019350-1059-3172-f8de-9c507e9e4901'";
		$qry_res = $db->execute($query);
		if(sizeof($qry_res)>0)
		{
			$outputjson["role"] = $qry_res;
		}
		
			$outputjson['message'] = 'Data Found';
			$outputjson['success'] = 1;
		
	}
	else if($action=='fill_city'){
		$stateid=$gh->read("stateid");
		$query = "SELECT * FROM tbl_citymaster where stateid='$stateid'";
		$qry_res = $db->execute($query);

		if(sizeof($qry_res)>0)
		{
			$outputjson["city"] = $qry_res;
			
		}
		$outputjson['message'] = 'Data Found';
		$outputjson['success'] = 1;
	}
	else if($action=='fill_user_field'){
		$query_roles = "SELECT * FROM tbl_roles";
		$qry_res_roles = $db->execute($query_roles);
		if(sizeof($qry_res_roles)>0)
		{
			$outputjson["roles"] = $qry_res_roles;
		}

		$query_state = "SELECT * FROM tbl_statemaster";
		$qry_res_state = $db->execute($query_state);

		if(sizeof($qry_res_state)>0)
		{
			$outputjson["state"] = $qry_res_state;
		}else{
			$outputjson["state"] = '';
		}

		$outputjson['message'] = 'Data Found';
		$outputjson['success'] = 1;
	}
	else if($action=='fill_user'){
		$roleid = $gh->read("roleid");
		$query = "SELECT tu.id,tu.`name`
		FROM tbl_users tu
		inner join tbl_userrole ur on ur.userid=tu.id
		WHERE ur.`roleid` LIKE '$roleid' GROUP BY tu.id";
		$qry_res = $db->execute($query);
		
		$outputjson["data"] = $qry_res;
		$outputjson['message'] = 'Data Found';
		$outputjson['success'] = 1;
	}
	else if($action=='fill_userrights'){
		$roleid = $gh->read("roleid");
		$personid = $gh->read("personid");
		$sql="AND tu.personid like ''";
		if($personid)
		{
			$sql=" AND tu.personid like '$personid'";
		}
		$query = "SELECT tm.id,tm.`menuname`,tm.`pagename`
		,IFNULL((SELECT tu.viewright FROM `tbl_userrights` tu WHERE tu.menuid=tm.id AND tu.roleid LIKE '$roleid' $sql ),0) AS viewright 
		,IFNULL((SELECT tu.addright FROM `tbl_userrights` tu WHERE tu.menuid=tm.id AND tu.roleid LIKE '$roleid' $sql ),0) AS addright 
		,IFNULL((SELECT tu.editright FROM `tbl_userrights` tu WHERE tu.menuid=tm.id AND tu.roleid LIKE '$roleid' $sql ),0) AS editright 
		,IFNULL((SELECT tu.deleteright FROM `tbl_userrights` tu WHERE tu.menuid=tm.id AND tu.roleid LIKE '$roleid' $sql ),0) AS deleteright 
		FROM tbl_menumaster tm
		";
		$qry_res = $db->execute($query);
		
		$outputjson["data"] = $qry_res;
		$outputjson['message'] = 'Data Found';
		$outputjson['success'] = 1;
	}
}