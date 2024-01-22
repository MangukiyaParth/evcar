<?php

function manage_homepage()
{
	global $outputjson, $gh, $db;
	$outputjson['success'] = 0;
	$outputjson['status'] = 0;

	$action = $gh->read("action");

	if($action == "get_data")
	{
		$qry_slider="SELECT * FROM tbl_slidermaster
		WHERE `isactive`=1 ORDER BY `orderno`+0 ASC";
		$rows_slider = $db->execute($qry_slider);
		if ($rows_slider != null && is_array($rows_slider) && count($rows_slider) > 0) {	
			$outputjson["slider"] = $rows_slider;
		}

		$qry_testimonial="SELECT * FROM tbl_testimonialmaster WHERE `isactive`=1 ORDER BY `orderno`+0 ASC";
		$rows_testimonial = $db->execute($qry_testimonial);
		if ($rows_testimonial != null && is_array($rows_testimonial) && count($rows_testimonial) > 0) {	
			$outputjson["testimonial"] = $rows_testimonial;
		}

		$query_future = "SELECT DISTINCT p.*,p.id AS md5_id,ca.category,t.igst AS saletax,ta.igst AS purchase_tax,u.unitname AS punit,un.unitname AS saleunit,
		IFNULL((SELECT GROUP_CONCAT(cm.colorname) AS colorname FROM tbl_colormaster cm INNER JOIN tbl_productcolor uc ON uc.colorid=cm.id WHERE uc.productid=p.id),'') AS colorname
			FROM tbl_productmaster as p 
			INNER JOIN tbl_categorymaster ca ON ca.id=p.categoryid
			INNER JOIN tbl_taxmaster t  ON t.id=p.staxid
			INNER JOIN tbl_taxmaster ta  ON ta.id=p.ptaxid
			INNER JOIN tbl_unitmaster u ON u.id=p.punitid
			INNER JOIN tbl_unitmaster un ON un.id=p.sunitid
			WHERE STR_TO_DATE(p.`realese_date`,'%d/%m/%Y') > CURDATE()";
		$future_rows = $db->execute($query_future);
		if ($rows_testimonial != null && is_array($rows_testimonial) && count($rows_testimonial) > 0) {
			$outputjson['future_data'] = $future_rows;
		}
		$outputjson['success'] = 1;
		$outputjson['status'] = 1;
		$outputjson['message'] = 'success.';
	}
}
