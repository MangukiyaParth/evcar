<?php

function manage_car()
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
		
		$whereData = "(p.name LIKE '%" . $search . "%')";

		$total_count = $db->get_row_count('tbl_cars', "1=1");
		$filtered_count = 0;
		$count_query = "SELECT count(DISTINCT p.id) as cnt FROM tbl_cars as p 
			WHERE " . $whereData;
		$filtered_count = $db->execute_scalar($count_query);

		$orderby = "ORDER BY p.entry_date DESC";
		if ($orderindex >0) {
			$orderby = " ORDER BY ".$ordercolumn . " " . $orderdir;
		}
		$query_port_rates = "SELECT DISTINCT p.*
			FROM tbl_cars as p 
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
	}
	else if($action == "add_data")
	{
		$id = $gh->read("id");
		$user_id = $gh->read("user_id", 0);

		$name = $gh->read("name");
		$brand = $gh->read("brand");
		$brand_name = $gh->read("brand_name");
		$price = $gh->read("price");
		$fule_type = $gh->read("fule_type");
		$fule_type_name = $gh->read("fule_type_name");
		$engine = $gh->read("engine");
		$modal_year = $gh->read("modal_year");
		$transmision = $gh->read("transmision");
		$transmision_name = $gh->read("transmision_name");
		$seater = $gh->read("seater");
		$car_type = $gh->read("car_type");
		$car_type_name = $gh->read("car_type_name");
		$description = $gh->read("description");
		$color_data = $_POST["color_data"];
		$verient_data = $_POST["verient_data"];

		$date = date('Y-m-d H:i:s');
		$formevent = $gh->read("formevent");

		if($formevent =='submit'){
			$file_new_url='';
			$file_data='';
			$id=$gh->generateuuid();
			if(isset($_POST["file"]))
			{
				$file = json_decode($_POST["file"], true);
				$file_url = $file[0]['url'];
				$file_name = $file[0]['filename'];
				$file_new_url = str_replace('tmp/','images/', $file_url);
				$file_data = str_replace('tmp/','images/', $_POST["file"]);
				
				$gh->TryCreateDirIfNeeded(str_replace($file_name,$id.'/', $file_new_url));// Create directory if not exist
				$file_new_url = str_replace($file_name,$id.'/'.$file_name, $file_new_url);
				$file_data = str_replace('/'.$file_name, '/'.$id.'/'.$file_name, $file_data);
				rename($file_url, $file_new_url);
			}

			if(isset($color_data)){
				$colordata = json_decode($color_data, true);
				$color_cnt = 0;
				foreach($colordata as $clrdata){
					$img_data = $clrdata['img_data'];
					$file_urls = [];
					if(isset($img_data)){
						$imgdata = json_decode($img_data, true);
						$img_cnt = 0;
						foreach($imgdata as $imgs){
							$color_file_url = $imgs['url'];
							$color_file_name = $imgs['filename'];
							$color_file_new_url = str_replace('tmp/','images/', $color_file_url);
							$img_data = str_replace('tmp/','images/', $img_data);
							
							$gh->TryCreateDirIfNeeded(str_replace($color_file_name, $id.'/', $color_file_new_url));// Create directory if not exist
							$color_file_new_url = str_replace($color_file_name, $id.'/'.$color_file_name, $color_file_new_url);
							$img_data = str_replace('/'.$color_file_name, '/'.$id.'/'.$color_file_name, $img_data);
							array_push($file_urls, $color_file_new_url);
							rename($color_file_url, $color_file_new_url);
							$img_cnt++;
						}
					}
					$colordata[$color_cnt]['img_data'] = $img_data;
					$colordata[$color_cnt]['img_url'] = json_encode($file_urls);
					$color_id=$gh->generateuuid();
					$color_insert_data = array(
						"id" => $color_id,
						"car_id" => $id,
						"color" => $clrdata['color'],
						"file_url" => json_encode($file_urls),
						"file_data" => $img_data,
						"entry_uid" => $user_id,
						"entry_date" => $date,
					);
					$db->insert("tbl_cars_colors", $color_insert_data);
					$color_cnt++;
				}
				$color_data = json_encode($colordata);
			}

			if(isset($verient_data)){
				$verientdata = json_decode($verient_data, true);
				foreach($verientdata as $verdata){
					$verient_id=$gh->generateuuid();
					$verient_insert_data = array(
						"id" => $verient_id,
						"car_id" => $id,
						"verient_name" => $verdata['verient_name'],
						"fule_type" => $verdata['fule_type'],
						"fule_type_text" => $verdata['fule_type_text'],
						"transmision" => $verdata['transmision'],
						"transmision_text" => $verdata['transmision_text'],
						"engine" => $verdata['engine'],
						"price" => $verdata['price'],
						"entry_uid" => $user_id,
						"entry_date" => $date,
					);
					$db->insert("tbl_cars_verient", $verient_insert_data);
				}
			}

			$data = array(
				"id" => $id,
				"name" => $name,
				"brand" => $brand,
				"brand_name" => $brand_name,
				"price" => $price,
				"fule_type" => $fule_type,
				"fule_type_name" => $fule_type_name,
				"engine" => $engine,
				"modal_year" => $modal_year,
				"transmision" => $transmision,
				"transmision_name" => $transmision_name,
				"seater" => $seater,
				"car_type" => $car_type,
				"car_type_name" => $car_type_name,
				"description" => $description,
				"file" => $file_new_url,
				"file_data" => $file_data,
				"color_data" => $color_data,
				"verient_data" => $verient_data,
				"entry_uid" => $user_id,
				"entry_date" => $date,
			);
			$db->insert("tbl_cars", $data);

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
					"name" => $name,
					"brand" => $brand,
					"brand_name" => $brand_name,
					"price" => $price,
					"fule_type" => $fule_type,
					"fule_type_name" => $fule_type_name,
					"engine" => $engine,
					"modal_year" => $modal_year,
					"transmision" => $transmision,
					"transmision_name" => $transmision_name,
					"seater" => $seater,
					"car_type" => $car_type,
					"car_type_name" => $car_type_name,
					"description" => $description,
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
						$data['file'] = $file_new_url;
						$data['file_data'] = $logo_data;

						$query = "SELECT file FROM tbl_cars WHERE id = '" . $id ."'";
						$rows = $db->execute($query);
						if ($rows != null && is_array($rows) && count($rows) > 0) {
							unlink($rows[0]['file']);
						}
					}
				}

				if(isset($color_data)){
					$db->delete("tbl_cars_colors", array("car_id" => $id));
					$colordata = json_decode($color_data, true);
					$color_cnt = 0;
					foreach($colordata as $clrdata){
						$img_data = $clrdata['img_data'];
						$file_urls = [];
						if(isset($img_data)){
							$imgdata = json_decode($img_data, true);
							if (str_contains($img_data, 'tmp/')){
								$img_cnt = 0;
								foreach($imgdata as $imgs){
									$color_file_url = $imgs['url'];
									$color_file_name = $imgs['filename'];
									$color_file_new_url = str_replace('tmp/','images/', $color_file_url);
									$img_data = str_replace('tmp/','images/', $img_data);
									
									$gh->TryCreateDirIfNeeded(str_replace($color_file_name, $id.'/', $color_file_new_url));// Create directory if not exist
									$color_file_new_url = str_replace($color_file_name, $id.'/'.$color_file_name, $color_file_new_url);
									$img_data = str_replace('/'.$color_file_name, '/'.$id.'/'.$color_file_name, $img_data);
									array_push($file_urls, $color_file_new_url);
									rename($color_file_url, $color_file_new_url);
									$img_cnt++;
								}
							}
							else{
								$file_urls = array_column($imgdata, 'url');
							}
						}
						$colordata[$color_cnt]['img_data'] = $img_data;
						$colordata[$color_cnt]['img_url'] = json_encode($file_urls);
						$color_id=$gh->generateuuid();
						$color_insert_data = array(
							"id" => $color_id,
							"car_id" => $id,
							"color" => $clrdata['color'],
							"file_url" => json_encode($file_urls),
							"file_data" => $img_data,
							"entry_uid" => $user_id,
							"entry_date" => $date,
						);
						$db->insert("tbl_cars_colors", $color_insert_data);
						$color_cnt++;
					}
					$color_data = json_encode($colordata);
				}
	
				if(isset($verient_data)){
					$db->delete("tbl_cars_verient", array("car_id" => $id));
					$verientdata = json_decode($verient_data, true);
					foreach($verientdata as $verdata){
						$verient_id=$gh->generateuuid();
						$verient_insert_data = array(
							"id" => $verient_id,
							"car_id" => $id,
							"verient_name" => $verdata['verient_name'],
							"fule_type" => $verdata['fule_type'],
							"fule_type_text" => $verdata['fule_type_text'],
							"transmision" => $verdata['transmision'],
							"transmision_text" => $verdata['transmision_text'],
							"engine" => $verdata['engine'],
							"price" => $verdata['price'],
							"entry_uid" => $user_id,
							"entry_date" => $date,
						);
						$db->insert("tbl_cars_verient", $verient_insert_data);
					}
				}
				$data["color_data"] = $color_data;
				$data["verient_data"] = $verient_data;
				$rows = $db->update('tbl_cars', $data, array("id" => $id));

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
