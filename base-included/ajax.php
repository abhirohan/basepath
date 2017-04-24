<?php
include('init.php');
	if( isset($_REQUEST) ){
		$classname = $_REQUEST['classname'];
		$method = $_REQUEST['method'];
		if(class_exists($classname) && method_exists($classname, $method)){
			$classname::{$method}();
		}	
	}

?>