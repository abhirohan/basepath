<?php 
session_start();
	$loggedinUserId	   = 0;
	$loggedinUserName  = 0;
	$loggedinUserEmail = 0;
	if(isset($_SESSION)){
		if(isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['email'])){
			$loggedinUserId = $_SESSION['id'];
			$loggedinUserName = $_SESSION['name'];
			$loggedinUserEmail = $_SESSION['email'];
		}
	}
	$ds = DIRECTORY_SEPARATOR;
	require(dirname(__FILE__)."{$ds}base-setting.php");
	$objConfig  = new Config();
	if(isset($_REQUEST['post_id']) && isset($_REQUEST['post_user_id']) && isset($_REQUEST['post_title'])){
		$postUserId = $_REQUEST['post_user_id'];
		$postId 	= $_REQUEST['post_id'];
		$postElement = array('post_id','post_title','post_total_likes','post_content','post_user_id','post_name','Post_url','post_tags');
		$userData = Queries::fetchNote($postElement,$postUserId, $postId);
	}else{
		redirect('login.php');
	}
?>
<div id="confirmLikes">
<?php
$confirmLike = Queries::confirmLike($loggedinUserId,$postId );
?>
</div>
<?php
	get_header('note');
?>
<h2 class="text-primary"><?php echo $userData['post_title']; ?></h2>
<br>
<p class="contentpost">
<?php echo $userData['post_content']; ?>
</p>
<?php 
	if($confirmLike['status'] == '1'){
?>
		<i class="glyphicon glyphicon-heart" id="love_post" style="color:#c03"s 
					 	data-id="<?php echo $postId; ?>"
					 	data-ajaxurl = "<?php echo WEB_URL."base-included/ajax.php";  ?>"
					 	data-luserid="<?php echo $loggedinUserId; ?>"
					 	data-lusername="<?php echo $loggedinUserName; ?>"
					 	data-luseremail="<?php echo $loggedinUserEmail; ?>"
					 	data-wholike = "<?php echo $confirmLike['who_like_id']; ?>">
		</i>
		<span class="total_likes">
			<?php echo $userData['post_total_likes']; ?>
			</span>
		<span>Likes</span>
<?php
	}else{
?>
		<i class="glyphicon glyphicon-heart" id="love_post"  
					 data-id="<?php echo $postId; ?>"
					 data-ajaxurl = "<?php echo WEB_URL."base-included/ajax.php";  ?>"
					 data-luserid="<?php echo $loggedinUserId; ?>"
					 data-lusername="<?php echo $loggedinUserName; ?>"
					 data-luseremail="<?php echo $loggedinUserEmail; ?>"
					 data-wholike = "<?php echo $confirmLike['who_like_id']; ?>" >
		</i>
		<span class="total_likes">
			<?php echo $userData['post_total_likes']; ?>
		</span>
		<span>Likes</span>
<?php
	}
?>

<div id="pop_login" style="display: none;">
<div id="top"></div>
	<div class="pop_login_form">
		<form method="post" id="login_forma" data-ajaxurl = "<?php echo WEB_URL."base-included/ajax.php";  ?>">
			<input type="text" id="email" name="email" placeholder="email" ><br>
			<input type="password" id="password" name="password" placeholder="Password"><br>
			<button type="submit" id="loginbtn" name="sbtn">Login</button>
		</form>
	</div>
</div>
<br><br>
<?php
	if(isset($_SESSION)){
		if(isset($_SESSION['name'])){
			echo"<a href='".WEB_URL."logout.php?token=".$_SESSION['name']."'>Logout</a>";
			}
	}else{
		if(!isset($_SESSION['name'])){
				echo"<a href='login.php?ref=post'>Login</a>";
		}
	}
	get_footer('note');
?>