<?php
ini_set("extension","gd");
//ini_set("extension","exif");

$config=json_decode(
	file_get_contents("config.json")
);
$index=file_get_contents("index");
$dirDatas=json_decode(
	file_get_contents("dirDatas.json")
);
$index=(int)$index;
if(count($dirDatas)<=$index)
	exit;
$path=$dirDatas[$index];
$info=getimagesize($path);
if(!$info) $info=array();
$width=$info[0];
$height=$info[1];
$type=$info["mime"]||"";
$suffix=str_replace("image/", "", $type);
if($suffix=="png") {
	$img=imagecreatefrompng($path);
	$path=$config->inputImages.$index."jpeg";
	$suffix="jpeg";
	imagejpeg($img, $path);
}
if($suffix && $width*$height>=4000000) {
	copy($path, $config->outputImages.$index.".".$suffix);
	echo "{$path} -- 通过(pass)";
}
echo "_";

file_put_contents("index", $index+1);
































