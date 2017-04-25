<?php
	require_once('app/init.php');
	$auth = new TwitterAuth($client);

	$auth->getAuthUrl();
	if($auth->signedIn()){
?>
<p> You are signd in.<a href="signout.php">Sign Out</a></p>
<?php
	}else{
?>
	<p><a href="<?php echo $auth->getAuthUrl(); ?>">SignIn with Twitter</a></p>
<?php
	}
?>