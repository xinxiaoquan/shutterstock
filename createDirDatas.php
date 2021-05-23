<?php
$config=json_decode(
	file_get_contents("config.json")
);
if(substr($config->inputImages,-1)!=="/")
	$config->inputImages .= "/";
if(substr($config->outputImages,-1)!=="/")
	$config->outputImages .= "/";
global $pathArr;
$pathArr=array();

getDirInfo($config->inputImages);

file_put_contents("dirDatas.json",json_encode($pathArr));
file_put_contents("index", "0");

echo count($pathArr);

function getDirInfo($path) {
	$dir=opendir($path);
	while($fileName=readdir($dir)) {
		if($fileName=="." || $fileName=="..")
			continue;
		if(is_dir($path.$fileName))
			getDirInfo($path.$fileName."/");
		else $GLOBALS["pathArr"][]=$path.$fileName;
	}
	closedir($dir);
}





























