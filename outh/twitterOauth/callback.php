<?php
	require_once('app/init.php');
	$auth = new TwitterAuth($client);
	if($auth->signIn()){
		header("location: index.php");
	}else{
		die("Sign in Failed");
	}
?>