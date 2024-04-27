<?php

function manage_testimonial()
{
	global $outputjson, $gh, $db;
	$outputjson['success'] = 0;
	$outputjson['status'] = 0;

	$action = $gh->read("action");
	if($action == 'get_data'){  // get data

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
			p.personname LIKE '%" . $search . "%'
			or p.tdate LIKE '%" . $search . "%'
			or p.orderno LIKE '%" . $search . "%'
			)";

		$total_count = $db->get_row_count('tbl_testimonialmaster', "1=1");
		$filtered_count = 0;
		$count_query = "SELECT count(DISTINCT p.id) as cnt FROM tbl_testimonialmaster as p 
			WHERE " . $whereData;
		$filtered_count = $db->execute_scalar($count_query);

		$orderby = "ORDER BY p.entry_date DESC";
		if ($orderindex >0) {
			$orderby = " ORDER BY ".$ordercolumn . " " . $orderdir;
		}
		$query_port_rates = "SELECT DISTINCT p.*,p.id AS md5_id
			FROM tbl_testimonialmaster as p 
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
	}else if($action == 'add_data'){			//insert && update

		$formevent = $gh->read("formevent");
		$id = $gh->read("id");
		$user_id = $gh->read("user_id", 0);
		$personname = $gh->read("personname");
		$orderno = $gh->read("orderno");
		$rating = $gh->read("rating");
		$date = $gh->read("date");
		$description = $gh->read("description");
		$entry_date = date('Y-m-d H:i:s');

		if($formevent == 'submit'){
			
			$id=$gh->generateuuid();
			$file_new_url='';
			$logo_data='';
			if ($personname) {
				if(isset($_POST["file_name"]))
				{
					// $file = json_decode($_POST["file_name"], true);
					// $file_url = $file[0]['url'];
					// $file_name = $file[0]['filename'];
					// $file_new_url = str_replace('tmp/','images/', $file_url);
					// $logo_data = str_replace('tmp/','images/', $_POST["file_name"]);

					// $gh->TryCreateDirIfNeeded(str_replace($file_name,$id.'/', $file_new_url));// Create directory if not exist
					// $file_new_url = str_replace($file_name,$id.'/'.$file_name, $file_new_url);
					// $logo_data = str_replace('/'.$file_name, '/'.$id.'/'.$file_name, $logo_data);
					// rename($file_url, $file_new_url);
					// saveThumbnail($file_new_url, str_replace('/'.$file_name,'', $file_new_url));

					$newData = uploadDropzoneFiles($_POST["file_name"],$id);
					$file_new_url= $newData['file_url'][0];
					$logo_data= $newData['file_data'];
				}

				$data = array(
					"id" => $id,
					"personname" => $personname,
					"tdate" => $date,
					"rating" => $rating,
					"description" => $description,
					"file" => $file_new_url,
					"file_data" => $logo_data,
					"entry_uid" => $user_id,
					"entry_date" => $entry_date,
				);
				$db->insert("tbl_testimonialmaster", $data);

				$outputjson['result'] = [];
				$outputjson['success'] = 1;
				$outputjson['message'] = "Data added successfully";
			}
		}else{
			$id = $gh->read("id");
			$personname = $gh->read("personname");
			$orderno = $gh->read("orderno");
			$rating = $gh->read("rating");
			$date = $gh->read("date");
			$description = $gh->read("description");
			$user_id = $gh->read("user_id", 0);
			$date = date('Y-m-d H:i:s');
		
			if(isset($_POST["file_name"]))
			{
				$file = json_decode($_POST["file_name"], true);
			}
			if ($id != "") {
				$data = array(
					"personname" => $personname,
					"tdate" => $date,
					"orderno" => $orderno,
					"rating" => $rating,
					"description" => $description,
					"update_uid" => $user_id,
					"update_date" => $entry_date,
				);
				if(isset($_POST["file_name"]))
				{
					if (str_contains($_POST["file_name"], 'tmp/'))
					{
						// $file_url = $file[0]['url'];
						// $file_name = $file[0]['name'];
						// $file_new_url = str_replace('tmp/','images/', $file_url);
						// $logo_data = str_replace('tmp/','images/', $_POST["file_name"]);
						// $gh->TryCreateDirIfNeeded(str_replace($file_name,$id.'/', $file_new_url));// Create directory if not exist
						// $file_new_url = str_replace($file_name,$id.'/'.$file_name, $file_new_url);
						// $logo_data = str_replace('/'.$logo_data, '/'.$id.'/'.$file_name, $logo_data);
						// rename($file_url, $file_new_url);
						// saveThumbnail($file_new_url, str_replace('/'.$file_name,'', $file_new_url));
						// $data['file'] = $file_new_url;
						// $data['file_data'] = $logo_data;

						$newData = uploadDropzoneFiles($_POST["file_name"],$id);
						$data['file'] = $newData['file_url'][0];
						$data['file_data'] = $newData['file_data'];
		
						$query = "SELECT file FROM tbl_testimonialmaster WHERE id = '" . $id ."'";
						$rows = $db->execute($query);
						if ($rows != null && is_array($rows) && count($rows) > 0) {
							unlink($rows[0]['file']);
						}
					}
				}
				$rows = $db->update('tbl_testimonialmaster', $data, array("id" => $id));
		
				$outputjson['success'] = 1;
				$outputjson['message'] = 'Data updated successfully.';
				$outputjson["data"] = $rows;
			}
		}
	
	} else {
		$outputjson['message'] = "Please add Rates Category!";
	}
	
}
