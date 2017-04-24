<?php
require(dirname(__FILE__).'/base-setting.php');
if(isset($_REQUEST['redirect']) == 'new_user'){
	echo"<div id='welcomemsg' class='welcomemsg animated slideInDown'>Welcome, We are happy to have you on board. </div>";
	fadeout_msg('welcomemsg',5000);
}
echo"<div id='top'></div>";
get_header();
?>
<form method="post" id="login_forma" data-ajaxurl = "<?php echo WEB_URL."base-included/ajax.php";  ?>">
<input type="text" id="email" name="email" placeholder="email" ><br>
<input type="password" id="password" name="password" placeholder="Password"><br>
<button type="submit" id="loginbtn" name="sbtn">Login</button>
</form>
<?php
if(isset($_REQUEST['error'])){
if($_REQUEST['error']  == 'pwd' ){

	echo"<label id='xyz'>Password Doesn't match</label>";
	}else{
		echo"<label id='xyz'>
			This email/user is not attached with Basepath. <a href='index.php'>Register</a>
		</label>";
	}
	
}
?>
<br>
<a href="index.php">Register</a>
<?php get_footer(); ?>