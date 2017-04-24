<?php
$ds = DIRECTORY_SEPARATOR;
spl_autoload_register(function($class_name){
	 include(dirname(__FILE__).'/classes/'.$class_name.'.inc.php');
});
