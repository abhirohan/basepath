<?php
$ds = DIRECTORY_SEPARATOR;
define('ABSPATH', dirname(__FILE__)."$ds");
define('WEB_URL', "http://localhost{$ds}basepath{$ds}");
define('BASEINC', ABSPATH."base-included{$ds}");

require_once(BASEINC.'init.php');
require(BASEINC.'functions.php');