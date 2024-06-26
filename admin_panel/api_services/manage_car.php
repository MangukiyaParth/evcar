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
		$comming_soon = $gh->read("comming_soon");
		$modal_year = $gh->read("modal_year");
		$transmision = $gh->read("transmision");
		$transmision_name = $gh->read("transmision_name");
		$seater = $gh->read("seater");
		$car_type = $gh->read("car_type");
		$car_type_name = $gh->read("car_type_name");
		$mileage = $gh->read("mileage");
		$ground_clearance = $gh->read("ground_clearance");
		$warranty = $gh->read("warranty");
		$fuel_tank = $gh->read("fuel_tank");
		$length = $gh->read("length");
		$width = $gh->read("width");
		$height = $gh->read("height");
		$img_360 = $gh->read("img_360");
		$driving_range = $gh->read("driving_range");
		$battery_warranty = $gh->read("battery_warranty");
		$battery_capacity = $gh->read("battery_capacity");
		$ncap_rating = $gh->read("ncap_rating");
		$description = $gh->read("description");
		$discontinued = $gh->read("discontinued");
		$color_data = $_POST["color_data"];
		$verient_data = $_POST["verient_data"];
		$video_data = $_POST["video_data"];

		$date = date('Y-m-d H:i:s');
		$formevent = $gh->read("formevent");

		if($formevent =='submit'){
			$id=$gh->generateuuid();
			
			$file_new_url='';
			$file_data='';
			if(isset($_POST["file"]))
			{
				// $file = json_decode($_POST["file"], true);
				// $file_url = $file[0]['url'];
				// $file_name = $file[0]['filename'];
				// $file_new_url = str_replace('tmp/','images/', $file_url);
				// $file_data = str_replace('tmp/','images/', $_POST["file"]);
				
				// $gh->TryCreateDirIfNeeded(str_replace($file_name,$id.'/', $file_new_url));// Create directory if not exist
				// $file_new_url = str_replace($file_name,$id.'/'.$file_name, $file_new_url);
				// $file_data = str_replace('/'.$file_name, '/'.$id.'/'.$file_name, $file_data);
				// rename($file_url, $file_new_url);
				// saveThumbnail($file_new_url, str_replace('/'.$file_name,'', $file_new_url));

				$newData = uploadDropzoneFiles($_POST["file"],$id);
				$file_new_url= $newData['file_url'][0];
				$file_data= $newData['file_data'];
			}
			
			$brochure_file_url='';
			$brochure_file_data='';
			if(isset($_POST["brochure_file"]))
			{
				$newData = uploadDropzoneFiles($_POST["brochure_file"],$id);
				$brochure_file_url= $newData['file_url'][0];
				$brochure_file_data= $newData['file_data'];
			}
			
			$gallery_file_url='';
			$gallery_file_data='';
			if(isset($_POST["gallery_file"]))
			{
				$newData = uploadDropzoneFiles($_POST["gallery_file"],$id);
				$gallery_file_url= json_encode($newData['file_url']);
				$gallery_file_data= $newData['file_data'];
			}
			
			$interior_gallery_file_url='';
			$interior_gallery_file_data='';
			if(isset($_POST["interior_gallery_file"]))
			{
				$newData = uploadDropzoneFiles($_POST["interior_gallery_file"],$id);
				$interior_gallery_file_url= json_encode($newData['file_url']);
				$interior_gallery_file_data= $newData['file_data'];
			}

			if(isset($color_data)){
				$colordata = json_decode($color_data, true);
				$color_cnt = 0;
				foreach($colordata as $clrdata){
					$img_data = $clrdata['img_data'];
					$file_urls = [];
					if(isset($img_data)){
						// $imgdata = json_decode($img_data, true);
						// $img_cnt = 0;
						// foreach($imgdata as $imgs){
						// 	$color_file_url = $imgs['url'];
						// 	$color_file_name = $imgs['filename'];
						// 	$color_file_new_url = str_replace('tmp/','images/', $color_file_url);
						// 	$img_data = str_replace('tmp/','images/', $img_data);
							
						// 	$gh->TryCreateDirIfNeeded(str_replace($color_file_name, $id.'/', $color_file_new_url));// Create directory if not exist
						// 	$color_file_new_url = str_replace($color_file_name, $id.'/'.$color_file_name, $color_file_new_url);
						// 	$img_data = str_replace('/'.$color_file_name, '/'.$id.'/'.$color_file_name, $img_data);

						// 	array_push($file_urls, $color_file_new_url);
						// 	rename($color_file_url, $color_file_new_url);
						// 	saveThumbnail($color_file_new_url, str_replace('/'.$color_file_name,'', $color_file_new_url));
						// 	$img_cnt++;
						// }
						$newData = uploadDropzoneFiles($img_data,$id);
						$file_urls = $newData['file_url'];
						$img_data = $newData['file_data'];
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
				"comming_soon" => $comming_soon,
				"modal_year" => $modal_year,
				"transmision" => $transmision,
				"transmision_name" => $transmision_name,
				"seater" => $seater,
				"car_type" => $car_type,
				"car_type_name" => $car_type_name,
				"mileage" => $mileage,
				"ground_clearance" => $ground_clearance,
				"warranty" => $warranty,
				"fuel_tank" => $fuel_tank,
				"length" => $length,
				"width" => $width,
				"height" => $height,
				"img_360" => $img_360,
				"driving_range" => $driving_range,
				"battery_warranty" => $battery_warranty,
				"battery_capacity" => $battery_capacity,
				"ncap_rating" => $ncap_rating,
				"discontinued" => $discontinued,
				"description" => $description,
				"file" => $file_new_url,
				"file_data" => $file_data,
				"brochure_file" => $brochure_file_url,
				"brochure_file_data" => $brochure_file_data,
				"gallery_file" => $gallery_file_url,
				"gallery_file_data" => $gallery_file_data,
				"interior_gallery_file" => $interior_gallery_file_url,
				"interior_gallery_file_data" => $interior_gallery_file_data,
				"color_data" => $color_data,
				"verient_data" => $verient_data,
				"video_data" => $video_data,
				"entry_uid" => $user_id,
				"entry_date" => $date,
			);
			$db->insert("tbl_cars", $data);

			$outputjson['result'] = [];
			$outputjson['success'] = 1;
			$outputjson['message'] = "Data added successfully";
		}else{	
			$existing_data = [];
			$query = "SELECT file FROM tbl_cars WHERE id = '" . $id ."'";
			$rows = $db->execute($query);
			if ($rows != null && is_array($rows) && count($rows) > 0) {
				$existing_data = $rows[0];
			}																					//update
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
					"mileage" => $mileage,
					"ground_clearance" => $ground_clearance,
					"warranty" => $warranty,
					"fuel_tank" => $fuel_tank,
					"length" => $length,
					"width" => $width,
					"height" => $height,
					"img_360" => $img_360,
					"driving_range" => $driving_range,
					"battery_warranty" => $battery_warranty,
					"battery_capacity" => $battery_capacity,
					"ncap_rating" => $ncap_rating,
					"description" => $description,
					"update_uid" => $user_id,
					"update_date" => $date,
					"comming_soon" => $comming_soon,
				);
				if(isset($_POST["file"]))
				{
					if (str_contains($_POST["file"], 'tmp/'))
					{

						$newData = uploadDropzoneFiles($_POST["file"],$id);
						$data['file'] = $newData['file_url'][0];
						$data['file_data'] = $newData['file_data'];
						if ($existing_data != null && $existing_data != []) {
							unlink($existing_data['file']);
						}
						
						// $file_url = $file[0]['url'];
						// $file_name = $file[0]['name'];
						// $file_new_url = str_replace('tmp/','images/', $file_url);
						// $logo_data = str_replace('tmp/','images/', $_POST["file"]);
						// $gh->TryCreateDirIfNeeded(str_replace($file_name,$id.'/', $file_new_url));// Create directory if not exist
						// $file_new_url = str_replace($file_name,$id.'/'.$file_name, $file_new_url);
						// $logo_data = str_replace('/'.$logo_data, '/'.$id.'/'.$file_name, $logo_data);
						// rename($file_url, $file_new_url);
						// saveThumbnail($file_new_url, str_replace('/'.$file_name,'', $file_new_url));
						// $data['file'] = $file_new_url;
						// $data['file_data'] = $logo_data;

					}
				}

				if(isset($_POST["brochure_file"]))
				{
					$newData = uploadDropzoneFiles($_POST["brochure_file"],$id);
					$data['brochure_file'] = $newData['file_url'][0];
					$data['brochure_file_data'] = $newData['file_data'];
					if ($existing_data != null && $existing_data != []) {
						unlink($existing_data['brochure_file']);
					}
				}
				
				if(isset($_POST["gallery_file"]))
				{
					$newData = uploadDropzoneFiles($_POST["gallery_file"],$id);
					$data['gallery_file'] = json_encode($newData['file_url']);
					$data['gallery_file_data'] = $newData['file_data'];
				}
				
				if(isset($_POST["interior_gallery_file"]))
				{
					$newData = uploadDropzoneFiles($_POST["interior_gallery_file"],$id);
					$data['interior_gallery_file'] = json_encode($newData['file_url']);
					$data['interior_gallery_file_data'] = $newData['file_data'];
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
								// $img_cnt = 0;
								// foreach($imgdata as $imgs){
								// 	if (str_contains($imgs['url'], 'tmp/')){
								// 		$color_file_url = $imgs['url'];
								// 		$color_file_name = $imgs['filename'];
								// 		$color_file_new_url = str_replace('tmp/','images/', $color_file_url);
								// 		$img_data = str_replace('tmp/','images/', $img_data);
										
								// 		$gh->TryCreateDirIfNeeded(str_replace($color_file_name, $id.'/', $color_file_new_url));// Create directory if not exist
								// 		$color_file_new_url = str_replace($color_file_name, $id.'/'.$color_file_name, $color_file_new_url);
								// 		$img_data = str_replace('/'.$color_file_name, '/'.$id.'/'.$color_file_name, $img_data);

								// 		array_push($file_urls, $color_file_new_url);
								// 		rename($color_file_url, $color_file_new_url);
								// 		saveThumbnail($color_file_new_url, str_replace('/'.$color_file_name,'', $color_file_new_url));
								// 	}
								// 	else{
								// 		array_push($file_urls, $imgs['url']);
								// 	}
								// 	$img_cnt++;
								// }
								$newData = uploadDropzoneFiles($img_data,$id);
								$file_urls = $newData['file_url'];
								$img_data = $newData['file_data'];
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
				$data["video_data"] = $video_data;
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
