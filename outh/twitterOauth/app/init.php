<?php
	
	session_start();
	require_once dirname(__FILE__,'2').'/vendor/autoload.php';
	require_once 'classes/db.inc.php';
	require_once 'classes/twitterauth.inc.php';
	\Codebird\Codebird::setConsumerKey('ddGb3ldwMokmSax9yyGt5NfxL','WQLWNIeNx0ncoENXcSdgAXvrQlqOctOb8cstiNpsUmDb8GFggK'); 

	$client = \Codebird\Codebird::getInstance();


?>