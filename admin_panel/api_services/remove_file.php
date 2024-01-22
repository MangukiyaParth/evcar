<?php

function remove_file()
{
	global $outputjson, $gh;
	$outputjson['success'] = 0;
	$url = $gh->read('url');
	if (str_contains($url, 'tmp/'))
	{
		unlink($url);
	}
	$outputjson['success'] = 1;
	$outputjson['message'] = "File Removed successfully";
}
