<?php
$ds =DIRECTORY_SEPARATOR;
define('HOME_SITE',"{$ds}basePath");
function get_header($headerName = ''){
	global $ds;
	$header = $_SERVER['DOCUMENT_ROOT'].HOME_SITE."{$ds}header-".$headerName.".php";
	if(!file_exists($header)){
		include($_SERVER['DOCUMENT_ROOT'].HOME_SITE."{$ds}header.php");
	}else{
		include($header);
	}
}

function get_footer($footerName = ''){
	global $ds;
	$footer = $_SERVER['DOCUMENT_ROOT'].HOME_SITE."{$ds}footer-".$footerName.".php";
	if(!file_exists($footer)){
		include($_SERVER['DOCUMENT_ROOT'].HOME_SITE."{$ds}footer.php");
	}else{
		include($footer);
	}
}

function alertmsg($msg){
	echo"<script>alert('$msg');</script>";
}
function redirect($url, $permanent = false) {
	if($permanent) {
		header('HTTP/1.1 301 Moved Permanently');
	}
	header('Location: '.$url);
	exit();
}
function  redirect_timer($url, $time){
	echo"<script>setTimeout(function(){
			window.location ='$url';
			},$time);</script>";
}
function  fadeout_msg($id, $time){
	echo"<script>setTimeout(function(){
			var id = document.getElementById('$id');
			$(id).fadeOut('slow');
			},$time);</script>";
}


