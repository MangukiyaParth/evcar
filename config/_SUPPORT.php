<?php
// error_reporting(0);
// error_reporting(E_ERROR | E_WARNING | E_PARSE);

global $debug_mode, $db, $global_postmark_array, $postmark_message_id, $log_mode, $secret_key, $const_session_key_value;

require_once '_SimpleImage.php';
require 'vendor/autoload.php';

//For Mail Sent Using SMTP
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$secret_key = file_get_contents(ROOT_URL.'config/private.pem');

define("GST",$_ENV['GST']);

class SUPPORT
{
	public $current_user;
	public function get($input, $trim_special_characters = false)
	{
		$output = $input;
		$output = html_entity_decode($input, ENT_QUOTES | ENT_HTML5);
		if ($trim_special_characters) {
			$output = preg_replace("/[:,?;]/", '', $output);
		}
		return $output;
	}

	public function format_error($errno, $errstr, $errfile, $errline)
	{

		$trace = print_r(debug_backtrace(false), true);
		$content = '<table width="100%" border="1" cellspacing="1" cellpadding="5" style="border:1px solid red"><tr><th>Item</th><th>Description</th></tr><tr><th>Error</th><td><pre>' . $errstr . '</pre></td></tr><tr><th>#</th><td><pre>' . $errno . '</pre></td></tr><tr><th>File</th><td><pre>' . $errfile . '</pre></td></tr><tr><th>Line</th><td><pre>' . $errline . '</pre></td></tr><tr><th>Trace</th><td><pre>' . $trace . '</pre></td></tr></table>';

		return $content;
	}

	public function is_empty($value)
	{
		return (!isset($value)
			|| is_null($value)
			|| (!$value && $value != 0)
			|| ($value == "")
		);
	}
	public function ind_format($num)
	{
		$explrestunits = "" ;
		$num=preg_replace('/,+/', '', $num);
		if($num==''){ $num=0; }
		$num=trim($num);
		$firstchar=substr($num,0,1); //get first char of number , check if contains + or -
		$sign='';
		if($firstchar=='-')
		{
			$num=ltrim($num, '-');	
			$sign='-';
		}
		else if($firstchar=='+')
		{
			$num=ltrim($num, '+');	
		}
		
		$words = explode(".", $num);
		$des="00";
		if(count($words)<=2){
			$num=$words[0];
			if(count($words)>=2){$des=$words[1];}
			if(strlen($des)<2)
			{
				$des=$des."0";
			}
			else
			{
				$thirdchar=substr($des,2,1);
				$des=substr($des,0,2);
				
				if($thirdchar>=5)
				{
					$des=$des+1;
				}			
			}
		}
		if(strlen($num)>3){
			$lastthree = substr($num, strlen($num)-3, strlen($num));
			$restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
			$restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
			$expunit = str_split($restunits, 2);
			for($i=0; $i<sizeof($expunit); $i++){
				// creates each of the 2's group and adds a comma to the end
				if($i==0)
				{
					$explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
				}else{
					$explrestunits .= $expunit[$i].",";
				}
			}
			$thecash = $explrestunits.$lastthree;
		} else {
			$thecash = $num;
		}
		return $sign."".$thecash.".".$des; // writes the final format where $currency is the currency symbol.
	}
	public function read($param_name, $default = null, $input_is_json = false)
	{
		$ret = "";
		// POST
		if (isset($_POST[$param_name]) && is_array($_POST[$param_name])) {
			return $_POST[$param_name];
		} else if (isset($_POST[$param_name]) && is_string($_POST[$param_name])) {
			$ret = trim($_POST[$param_name]);
			if ($input_is_json == false) {
				$ret = addslashes(rawurldecode($ret));
			}
			return $ret;
		} // REQUEST
		else if (isset($_REQUEST[$param_name]) && is_array($_REQUEST[$param_name])) {
			return $_REQUEST[$param_name];
		} else if (isset($_REQUEST[$param_name]) && is_string($_REQUEST[$param_name])) {
			$ret = trim($_REQUEST[$param_name]);
			$ret = addslashes(urldecode($ret));
			return $ret;
		} else {
			return $default;
		}
		return $ret;
	}

	public function debug($obj, $force_display = false)
	{
		global $debug_mode, $outputjson;
		if ($debug_mode >= 1 || $force_display == true) {
			$outputjson["debug"][] = $obj;
		}
	}

	public function Log($__msg, $sub_path = "", $try_send_email = true)
	{
		//Comment this function because if I some text with word 'error', it goes to infinite loop
		if ($try_send_email) {
			// $this->send_email_if_needed($__msg);
		}

		$msg = "";
		$path = dirname(__DIR__, 1) . "/admin_panel/api_services/";
		try {
			if (is_array($__msg)) {
				$msg = print_r($__msg, true);
			}

			if (is_object($__msg) && ($__msg instanceof Exception)) {
				$msg = $__msg->getMessage();
				$msg .= $__msg->getTraceAsString();
			}
			if (is_string($__msg)) {
				$msg = $__msg;
			}

			$requested_by_user_id = $this->read("user_id", "00000");
			$requested_by_user_id = ($requested_by_user_id == "0" || $requested_by_user_id == "") ? "00000" : $requested_by_user_id;
			$requested_by_user_id .= "/";

			$sub_path .= ($sub_path != "") ? "/" : "";

			$month_year = date('Y-m') . "/";
			if ($month_year == "2021-05/") {
				$month_year = "";
			}

			$path_fe = "";
            if($this->read("from") == FRONTEND_CONSTANT){
				$path_fe = "front_end/";
			}
			
			$path1 = $path . "upload/_log/" . $path_fe . $month_year;
			$this->TryCreateDirIfNeeded($path1);

			$path1 = $path . "upload/_log/" . $path_fe . $month_year . $sub_path;
			$this->TryCreateDirIfNeeded($path1);

			$path1 = $path . "upload/_log/" . $path_fe . $month_year . $sub_path . $requested_by_user_id;
			$this->TryCreateDirIfNeeded($path1);

			$msg = str_replace('\r\n', PHP_EOL, $msg);
			$msg = PHP_EOL . date('Y-m-d H:i:s') . ": " . $msg;
			file_put_contents($path1 . date('Y_m_d') . ".txt", $msg, FILE_APPEND | LOCK_EX);
		} catch (Throwable $t) {
			file_put_contents("upload/_log/catch_error.txt", PHP_EOL . date('Y-m-d H:i:s') . "  ==>  " . $t->getMessage(), FILE_APPEND | LOCK_EX);
		} catch (Exception $e) {
			file_put_contents("upload/_log/catch_error.txt", PHP_EOL . date('Y-m-d H:i:s') . "  ==>  " . $e->getMessage(), FILE_APPEND | LOCK_EX);
		}
	}

	public function TryCreateDirIfNeeded($dirpath, $mode = 0777)
	{

		// is_dir() - Tells whether the filename is a directory
		// file_exists — Checks whether a file or directory exists
		$success = false;

		try {

			if (is_dir($dirpath) && file_exists($dirpath)) {
				$success = true;
			} else if (!file_exists($dirpath)) {
				// When we have multiple calls first time (when dir not exist), the process is facing the race condition. so try to sleep the process with randon microseconds. 100000 = 100ms
				usleep(intval(rand(1, 100000)));

				$oldmask = umask(0);
				$success = @mkdir($dirpath, $mode, true);
				@chmod($dirpath, $mode);
				umask($oldmask);
			}
		} catch (Throwable $th_ex) {
			// ignore
		} catch (Exception $ex) {
			// ignore
		} finally {
			// not needed for now
		}
		return  $success;
	}

	public function LogQueryStart($query)
	{
		global $debug_mode, $outputjson, $log_mode;
		if ($debug_mode >= 1 || $log_mode >= 3) {
			$query_info = array();

			$query = str_replace('\r\n', " ", $query);
			$query = str_replace("\t", " ", $query);
			$query = str_replace("\r", " ", $query);
			$query = str_replace("\n", " ", $query);
			$query_info["query"] = $query;
			$query_start = microtime(true);
			$outputjson["query_info"][] = $query_info;

			return $query_start;
		}
		return null;
	}

	public function LogQueryResult($query_result)
	{
		global $debug_mode, $outputjson, $log_mode;

		if ($debug_mode <= 1 && $log_mode < 4) {
			return;
		}

		if (is_null($query_result)) {
			return;
		}

		if ($debug_mode >= 1 || $log_mode == 4) {
			// $query_info = array_pop($outputjson["query_info"]);
			$query_info = $outputjson["query_info"];
			$query_info["output"] = $query_result;
			$outputjson["query_info"][] = $query_info;
		}

		if ($log_mode == 4 && isset($query_info)) {
			$this->Log($query_info, "QUERY");
			unset($outputjson["query_info"]);
		}
	}

	public function LogQueryEnd($query_start)
	{
		global $debug_mode, $outputjson, $log_mode;

		if (is_null($query_start)) {
			return;
		}

		if ($debug_mode >= 1 || $log_mode >= 3) {
			$query_stop = microtime(true);
			$query_time_diff = ($query_stop - $query_start) . ' seconds';
			// $query_info = array_pop($outputjson["query_info"]);
			$query_info = $outputjson["query_info"];
			$query_info["time"] = $query_time_diff;
			$outputjson["query_info"][] = $query_info;
		}

		if ($log_mode == 3 && isset($query_info)) {
			$this->Log($query_info, "QUERY");
			unset($outputjson["query_info"]);
		}
	}

	public function encrypt($string_to_encrypt)
	{
		$password = "TheApp";
		$encrypted_string = openssl_encrypt($string_to_encrypt, "AES-128-ECB", $password);
		return $encrypted_string;
	}

	public function decrypt($encrypted_string)
	{
		$encrypted_string = preg_replace('/\s+/', '+', $encrypted_string);
		$password = "TheApp";
		$decrypted_string = openssl_decrypt($encrypted_string, "AES-128-ECB", $password);
		return $decrypted_string;
	}

	public function parse_json_to_array($json)
	{
		$json = htmlspecialchars_decode($json);
		return (array)json_decode($json);
	}

	public function call_service($parameter = array())
	{
		global $tz_offset, $tz_name;
		$result = null;
		$parameter["tz"] = $tz_offset;
		$parameter["tzid"] = $tz_name;
		try {
			$curl_handle = curl_init();
			curl_setopt($curl_handle, CURLOPT_URL, API_SERVICE_URL . "manage.php");
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_POST, 1);
			curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $parameter);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			$data = $this->removeBOM($buffer);
			$result = json_decode($data, true);
		} catch (Throwable $t) {
			// Executed only in PHP 7, will not match in PHP 5.x
			$this->Log($t);
		} catch (Exception $e) {
			$this->Log($e);
		}
		return $result;
	}

	function removeBOM($data)
	{
		if (0 === strpos(bin2hex($data), 'efbbbf')) {
			return substr($data, 3);
		}
		return $data;
	}

	/* This Function is used for upload image. When thumb_needed is true is also upload thumbnail image in thumb folder */
	public function UploadImage($file, $thumb_needed, $prepend = "")
	{

		// global $gh;

		$img_path = "";
		$thumb_needed = isset($thumb_needed) ? $thumb_needed : true;

		if (!isset($_FILES[$file]['size']) || $_FILES[$file]['size'] == '' || $_FILES[$file]['size'] <= 0) {
			return $img_path;
		}

		if (isset($_FILES[$file]['name']) && $_FILES[$file]['name'] != '') {
			if ($prepend == "") {
				$prepend = time() . "_";
			}
			$success = move_uploaded_file($_FILES[$file]['tmp_name'], "upload/tmp/" . $_FILES[$file]['name']);
			if ($success) {
				$img_path = API_SERVICE_URL . UPLOAD . 'tmp/' . $_FILES[$file]['name'];
				$this->Log('image uploaded: ' . $img_path);
			}

			if ($success && $thumb_needed == true) {
				$this->GetThumbnail("upload/tmp/" . $_FILES[$file]['name'], "upload/tmp_thumb/" . $_FILES[$file]['name'], 308);
				$img_path = API_SERVICE_URL . UPLOAD . 'tmp_thumb/' . $_FILES[$file]['name'];
				$this->Log('thumb uploaded: ' . $img_path);
			}
		}
		return $img_path;
	}

	/* This function is used for get thumbnail size image */
	public function GetThumbnail($big_img_path, $image_path, $wid)
	{
		$this->debug($image_path . " - " . $wid);
		$image = new SimpleImage();
		$image->load($big_img_path);
		if ($wid > 0 && $wid != $image->getWidth()) {
			$this->debug("Processing $image_path -> $wid");
			$image->resizeToWidth($wid);
			$result = $image->save($image_path);
			$this->debug($result);
			$this->debug("Processing done");
		} else {
			$this->debug("No processing needed for $image_path");
		}
	}

	public function get_client_ip()
	{
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		} else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		} else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		} else if (isset($_SERVER['HTTP_FORWARDED'])) {
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		} else if (isset($_SERVER['REMOTE_ADDR'])) {
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		} else {
			$ipaddress = 'UNKNOWN';
		}

		return $ipaddress;
	}

	public function download_file($source_url, $destination_file_path)
	{
		try {
			set_time_limit(0);
			//This is the file where we save the    information
			$fp = fopen($destination_file_path, 'w+');
			//Here is the file we are downloading, replace spaces with %20
			$ch = curl_init(str_replace(" ", "%20", $source_url));
			curl_setopt($ch, CURLOPT_TIMEOUT, 50);
			// write curl response to file
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			// get curl response
			curl_exec($ch);
			curl_close($ch);
			fclose($fp);
		} catch (Exception $e) {
			$this->Log($e);
			return false;
		}
		return true;
	}

	public function format_currency($amount)
	{
		$amount = str_replace("_", "", $amount);
		$amount = $amount == "" ? 0.00 : $amount;
		$currency = "USD ";
		$dec_point = ".";
		$thousands_sep = ",";

		$output = $currency . number_format($amount / 100, 2, $dec_point, $thousands_sep);
		return $output;
	}

	public function GetString($input)
	{
		if (isset($input) && $input != null) {
			$input = html_entity_decode($input, ENT_QUOTES | ENT_HTML5);
			return preg_replace('/(?!<[a-zA-Z=\"\':; ]*[^ ]>|<\\/[a-zA-Z="\':; ]*>)(<)/', "&lt;", $input);
		}
		return "";
	}

	public function getFileNameFromURL($fileUrl)
	{
		$fileParts = explode('.', basename($fileUrl));
		unset($fileParts[count($fileParts) - 1]);
		$fileParts = implode('.', $fileParts);
		return $fileParts;
	}

	function __construct()
	{
	}

	public function echoBase64($filename)
	{
		$contents = file_get_contents($filename);
		$base64_contents = base64_encode($contents);
		$base64_contents_split = str_split($base64_contents, 80);
		$str = '';
		foreach ($base64_contents_split as $one_line) {
			$str .= $one_line;
		}
		return $str;
	}

	public function get_http_response_code($url)
	{
		$headers = get_headers($url);
		return substr($headers[0], 9, 3);
	}

	function getRealIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	// In use for creating filename on Amazon S3 bucket.
	public function remove_special_char($filename)
	{

		// replace special characters except underscore, dash, dot
		$filename = preg_replace("/[^a-z0-9\s\_\-\.]/i", '', $filename);

		// replace multiple space with single
		$filename = preg_replace('!\s+!', ' ', $filename);

		// replace space with underscore
		$filename = str_replace(' ', '_', $filename);

		return $filename;
	}

	function cleanup_enconding($str)
	{

		// for some reason, mb_convert is not working
		// echo mb_convert_encoding($msg_title, 'HTML-ENTITIES', 'UTF-8');

		$str = str_replace("â€™", "'", $str); // left single smart-quote
		$str = str_replace("â€˜", "'", $str); // right single smart-quote
		$str = str_replace("â€œ", "\"", $str); // left double smart-quotation mark
		$str = str_replace("â€", "\"", $str); // right double smart-quotation mark
		return $str;
	}

	//Use this function to get proportional height/width of company logo when attaching it in email.
	function getImageHeightWidthRatio($image, $imgHeight, $imgWidth)
	{
		$final_logo_width = $logo_width = $max_logo_width = 307;
		$final_logo_height = $logo_height = $max_logo_height = 71;
		if (!empty($image)) {
			if (!empty($image)) {
				$company_image = str_replace("/thumb/", "/large/", $image);

				if (empty($imgWidth)) {
					list($logo_width, $logo_height) = getimagesize($company_image);
				} else {
					$logo_width = $imgWidth;
					$logo_height = $imgHeight;
				}

				if ($logo_height > $max_logo_height) {
					$final_logo_height = $max_logo_height;
					$final_logo_width = intval(($logo_width * $final_logo_height) / $logo_height);
				} else {
					$final_logo_height = $logo_height;
					$final_logo_width = intval(($logo_width * $final_logo_height) / $logo_height);
				}
			}
		}
		return array('height' => $final_logo_height, 'width' => $final_logo_width);
	}

	function send_email($toUserEmail, $toUserName, $emailSubject, $emailBody, $ccEmail = array())
	{

		global $outputjson, $db, $const;

		$query_settings = "SELECT * FROM tbl_settings LIMIT 1";
		$settings_rows = $db->execute($query_settings);
		$setting = $settings_rows[0];

		$mail = new PHPMailer(true);

		//Enable SMTP debugging.
		//$mail->SMTPDebug = 3;
		//Set PHPMailer to use SMTP.
		$mail->isSMTP();
		//Set SMTP host name
		$mail->Host = "smtp.gmail.com";
		//Set this to true if SMTP host requires authentication to send email
		$mail->SMTPAuth = true;
		//Provide username and password
		$mail->Username = $setting['admin_email'];
		$mail->Password = $setting['admin_email_password'];
		//If SMTP requires TLS encryption then set it
		// $mail->SMTPSecure = "ssl";
		$mail->SMTPSecure = "tls";
		//Set TCP port to connect to
		$mail->Port = 587;

		$mail->From = $setting['admin_email']; // this needs to be the user's email address
		$mail->FromName = $setting['company_name'];

		$mail->addAddress($toUserEmail, $toUserName);

		if (count($ccEmail) > 0) {
			foreach ($ccEmail as $recipient) {
				$mail->AddCC($recipient, "");
			}
		}

		$mail->isHTML(true);

		$mail->Subject = $emailSubject;
		$mail->Body = $emailBody;

		try {
			$mail->send();
			$smtpMailResponse['success'] = 1;
			$smtpMailResponse['message'] = "Message has been sent successfully";
		} catch (Exception $e) {
			$smtpMailResponse['success'] = 0;
			$smtpMailResponse['message'] = "Mailer Error: " . $mail->ErrorInfo;
		}

		return $smtpMailResponse;
	}

	function getjwt($user_id, $issuer, $expmin=90, $temp_user=0)
	{
		global $secret_key;
		$resp=array();  
		$status=0;
		$token=''; 
		if($issuer && $user_id)
		{
			$issuedAt   = new DateTimeImmutable();
			$expire     = $issuedAt->modify('+'.$expmin.' minutes')->getTimestamp();    

			if($expmin > 0){
				$payload = [
					'issuedat'  => $issuedAt->getTimestamp(),
					'issuer'    => $issuer,
					'expire'    => $expire,
					'user_id'   => $user_id,
					'temp_user' => $temp_user,
					'user_agent'=> $_SERVER['HTTP_USER_AGENT'],
					'ip_address'=> $this->get_client_ip()
				];
			}
			else {
				$payload = [
					'issuedat'  => $issuedAt->getTimestamp(),
					'issuer'    => $issuer,
					'user_id'   => $user_id,
					'temp_user' => $temp_user,
					'user_agent'=> $_SERVER['HTTP_USER_AGENT'],
					'ip_address'=> $this->get_client_ip()
				];
			}
			$token = JWT::encode($payload, $secret_key, 'HS256');
			$status=1;
		}
		$resp['status']=$status;
		$resp['token']=$token;
		return $resp;
	}

	function validatejwt($token,$issuer)
	{
		global $secret_key, $at;
		$resp=array();
		$status=0;
		$uid=0;
		$temp_user=false;
		$user_agent=$_SERVER['HTTP_USER_AGENT'];
		try
		{
			$decoded = JWT::decode($token, new Key($secret_key, 'HS256'));
			$decoded_jwt = (array) $decoded;
			// print_r($decoded_jwt);
			// print_r($issuer);
			// print_r($user_agent);
			if($decoded_jwt['issuer'] == $issuer && $decoded_jwt['user_agent'] == $user_agent )
			{
				$uid = $decoded_jwt['user_id'];
				$temp_user = $decoded_jwt['temp_user'];
				$status=1;
				$msg= 'valid token';
			}
			else if($decoded_jwt['temp_user'] == 1 && $issuer == FRONTEND_CONSTANT){
				$user_id = $this->generateuuid();
				$key=$this->getjwt($user_id,$issuer,0,true);	
				$token = '';
				$status=0;
				if($key['status']==1){
					$token = $key['token'];
					$at->setToken($token);
					$msg= 'valid token';
				}
				else
				{
					$msg= 'invalid token';
				}
			}
			else
			{
				$msg= 'invalid token';
			}
		}
		catch(\Firebase\JWT\ExpiredException $e)
		{
			if($issuer == FRONTEND_CONSTANT){
				$msg=$e->getMessage();
				$user_id = $this->generateuuid();
				$key=$this->getjwt($user_id,$issuer,0,true);	
				$token = '';
				$status=0;
				if($key['status']==1){
					$token = $key['token'];
					$at->setToken($token);
					$status=1;
					$msg = '';
				}else{
					$msg = 'invalid token.';
				}
				$resp['key']=$token;
			}
			else {
				$msg=$e->getMessage();
				$status=-1;
			}
		
		} 
		catch(Exception $e)
		{
			$msg=$e->getMessage();
			$status=-1;
			
		}
	
		$resp['status']=$status;
		$resp['message']=$msg;
		$resp['user_id']=$uid;
		$resp['temp_user']=$temp_user;
		
		return $resp;
	}

	function generateuuid() {
		list($microseconds, $seconds) = explode(" ", microtime());
		$timestamp = sprintf('%d%06d', $seconds, $microseconds * 1000000);
	
		// Generate a random part
		$randomPart = sprintf('%04x%04x%04x%04x%04x%04x%04x%04x',
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000,
			mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);
	
		// Concatenate timestamp and random part to create a UUID
		$uuid = sprintf('%s-%s-%s-%s-%s',
			substr($timestamp, 0, 8), substr($timestamp, 8, 4),
			substr($timestamp, 12, 4), substr($randomPart, 0, 4),
			substr($randomPart, 4, 12)
		);
	
		return $uuid;
	}
	
	function check_directory_path($target_dir){
		if (!is_dir($target_dir)) {
			$oldmask = umask(0);
			mkdir($target_dir, 0777, true);
			umask($oldmask);
		}
	}

	function removeFolder($type, $id){
		$dirname = dirname(__DIR__, 1) . "/admin_panel/api_services/upload/images/".$type."/".$id;
		array_map('unlink', glob("$dirname/*"));
		array_map("rmdir", glob("$dirname/*")); 
		rmdir($dirname);
		
		$dirname = dirname(__DIR__, 1) . "/admin_panel/api_services/upload/images_thumb/".$type."/".$id;
		array_map('unlink', glob("$dirname/*"));
		array_map("rmdir", glob("$dirname/*")); 
		rmdir($dirname);

	}

	function findArrayByValue($multiArray, $key, $value) {
		foreach ($multiArray as $subArray) {
			if (isset($subArray[$key]) && $subArray[$key] === $value) {
				return $subArray;
			}
		}
		return null; // Return null if not found
	}

	/** http://stackoverflow.com/a/118886/1005741
	 *  Given a file, i.e. /css/base.css, replaces it with a string containing the
	 *  file's mtime, i.e. /css/base.1221534296.css.
	 *  
	 *  @param $file  The file to be loaded.  Must be an absolute path (i.e.
	 *                starting with slash).
	 */
	function auto_version($file)
	{
		//if(strpos($file, '/') !== 0 || !file_exists($_SERVER['DOCUMENT_ROOT'] . "/" . $file))
		if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/" . $file))
			return $file;

		$mtime = filemtime($_SERVER['DOCUMENT_ROOT'] . "/" . $file);
		$filename = preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
		return $filename;
	}

}
