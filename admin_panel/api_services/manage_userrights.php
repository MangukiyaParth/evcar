<?php

function manage_userrights()
{
	global $outputjson, $gh, $db;
	$outputjson['success'] = 0;

	$id = $gh->read("id");
	$user_id = $gh->read("user_id", 0);
	$roleid = $gh->read("roleid");
	$personid = $gh->read("personid");
	$mfg_item=$_POST['mfg_item'];
	$date = date('Y-m-d H:i:s');

	if ($roleid) {
		if($personid)
		{
			$del =array(
				"roleid"=>$roleid,
				"personid"=>$personid,
			);
			$db->delete('tbl_userrights', $del);
		}else{
			$del =array(
				"roleid"=>$roleid,
				"personid"=>'',
			);
			$db->delete('tbl_userrights', $del);
		}
		if(isset($_POST['mfg_item']))
		{
			for ($i = 0;$i < sizeof($mfg_item);$i++){
				$this_item = $mfg_item[$i];
				$subid=$gh->generateuuid();
				$data1 =array(
					"id"=>$subid,
					"roleid"=>$roleid,
					"personid"=>$personid,
					"menuid"=>$this_item['tbl_menuid'],
					"viewright"=>$this_item['tbl_viewright'],
					"addright"=>$this_item['tbl_addright'],
					"editright"=>$this_item['tbl_editright'],
					"deleteright"=>$this_item['tbl_deleteright'],
					"entry_uid" => $user_id,
					"entry_date" => $date,
				);
				// print_r($data1);
				$db->insert("tbl_userrights", $data1);
			}
		}
		$outputjson['result'] = [];
		$outputjson['success'] = 1;
		$outputjson['message'] = "Data added successfully";
	} else {
		$outputjson['message'] = "Please add Rates Category!";
	}
}