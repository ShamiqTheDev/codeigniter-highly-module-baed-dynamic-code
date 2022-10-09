<?php


function dd($data,$exit=true,$text='')
{
	if (is_array($data)) {
		echo "<pre>";
		print_r($data);
		$msg = !empty($text)?$text:'';
		ee($msg,$exit);
		echo "</pre>";
	}else{
		echo "not type of an array";
		var_dump($data);
		exit;
	}
}

function debug($data,$exit=true,$text='')
{
	if (is_array($data)) {
		echo "<pre>";
		print_r($data);
		if ($exit) {
			$msg= !empty($text)?$text:'';
			exit($msg);
		}
		echo "</pre>";
	}else{
		$data = json_encode($data);
		$data = json_decode($data,true);
		if (is_array($data)) {
			echo "<b>Data Type : <span style='color:red;'>Converted From Object<span></b>";
			debug($data);
		}
		exit;
	}

}

function ee($string,$exit=true)
{
	echo $string;
	if ($exit) {
		exit;
	}
}

function pageLoadTimeTaken($startTime) {
	$endTime = strtotime(date('h:i:s'));
    $unixTime = $endTime - $startTime;
    $timeTaken = date('i:s', $unixTime);
    exit('Page loadTime: '.$timeTaken);
}