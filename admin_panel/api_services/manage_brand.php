<?php

function manage_brand()
{
	global $outputjson, $gh, $db;
	$outputjson['success'] = 0;
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
		
		$whereData = "(p.brand LIKE '%" . $search . "%')";

		$total_count = $db->get_row_count('tbl_brand', "1=1");
		$filtered_count = 0;
		$count_query = "SELECT count(DISTINCT p.id) as cnt FROM tbl_brand as p 
			WHERE " . $whereData;
		$filtered_count = $db->execute_scalar($count_query);

		$orderby = "ORDER BY p.entry_date DESC";
		if ($orderindex >0) {
			$orderby = " ORDER BY ".$ordercolumn . " " . $orderdir;
		}
		$query_port_rates = "SELECT DISTINCT p.*,p.id AS md5_id
			FROM tbl_brand as p 
			WHERE " . $whereData . " " . $orderby . " LIMIT " . $start . "," . $length . "";
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
	}else if($action == "add_data")
	{
		$id = $gh->read("id");
		$user_id = $gh->read("user_id", 0);
		$brand = $gh->read("brand");
		$dis_order = $gh->read("dis_order");
		$button = $gh->read("button");
		$description = $gh->read("description");
		$date = date('Y-m-d H:i:s');
		$formevent = $gh->read("formevent");

		if($formevent =='submit'){
			$file_new_url='';
			$logo_data='';
			if(isset($_POST["file"]))
			{

				$file = json_decode($_POST["file"], true);
				$file_url = $file[0]['url'];
				$file_name = $file[0]['filename'];
				$file_new_url = str_replace('tmp/','images/', $file_url);
				$logo_data = str_replace('tmp/','images/', $_POST["file"]);
			}
			
				$id=$gh->generateuuid();
				if(isset($_POST["file"]))
				{
					$gh->TryCreateDirIfNeeded(str_replace($file_name,$id.'/', $file_new_url));// Create directory if not exist
					$file_new_url = str_replace($file_name,$id.'/'.$file_name, $file_new_url);
					$logo_data = str_replace('/'.$file_name, '/'.$id.'/'.$file_name, $logo_data);
					rename($file_url, $file_new_url);
				}
				$data = array(
					"id" => $id,
					"brand" => $brand,
					"logo" => $file_new_url,
					"logo_data" => $logo_data,
					"entry_uid" => $user_id,
					"entry_date" => $date,
				);
				$db->insert("tbl_brand", $data);

				$outputjson['result'] = [];
				$outputjson['success'] = 1;
				$outputjson['message'] = "Data added successfully";
		}else{																						//update
			if(isset($_POST["file"]))
			{
				$file = json_decode($_POST["file"], true);
			}
			if ($id != "") {
				$data = array(
					"brand" => $brand,
					"update_uid" => $user_id,
					"update_date" => $date,
				);
				if(isset($_POST["file"]))
				{
					if (str_contains($_POST["file"], 'tmp/'))
					{
						$file_url = $file[0]['url'];
						$file_name = $file[0]['name'];
						$file_new_url = str_replace('tmp/','images/', $file_url);
						$logo_data = str_replace('tmp/','images/', $_POST["file"]);
						$gh->TryCreateDirIfNeeded(str_replace($file_name,$id.'/', $file_new_url));// Create directory if not exist
						$file_new_url = str_replace($file_name,$id.'/'.$file_name, $file_new_url);
						$logo_data = str_replace('/'.$logo_data, '/'.$id.'/'.$file_name, $logo_data);
						rename($file_url, $file_new_url);
						$data['logo'] = $file_new_url;
						$data['logo_data'] = $logo_data;

						$query = "SELECT logo FROM tbl_brand WHERE id = '" . $id ."'";
						$rows = $db->execute($query);
						if ($rows != null && is_array($rows) && count($rows) > 0) {
							unlink($rows[0]['logo']);
						}
					}
				}
				$rows = $db->update('tbl_brand', $data, array("id" => $id));

				$outputjson['success'] = 1;
				$outputjson['message'] = 'Data updated successfully.';
				$outputjson["data"] = $rows;
			} 
		} 
	}else {
		$outputjson["data"] = [];
		$outputjson['message'] = "Error!";
	}
		
}
