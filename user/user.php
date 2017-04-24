<?php
	$ds = DIRECTORY_SEPARATOR;
	require(dirname(__FILE__,'2')."{$ds}base-setting.php");
	$objConfig =  new Config();
	$wfields = array('id','name','email','city','status','country');
	$postData = array('post_id','post_title','post_content','post_user_id','post_user_id','post_user_id','post_tags','post_draft');
	get_header('profile');
	$userData = Queries::userData($wfields);

	echo "Name : ".$userData['id']."<br>";
	echo "Name : ".$userData['name']."<br>";
	echo "Email : ".$userData['email']."<br>";
	echo "City : ".$userData['city']."<br>";
	echo "Country : ".$userData['country']."<br>";
	echo "Status : ".$userData['status']."<br>";
	$newPostURL = WEB_URL."user/new-post{$ds}".$userData['id']."{$ds}".$userData['name'];
?>
<br>
<div class="h2 text-info">Posts</div>
<hr>
<?php
$ipostData = implode(',', $postData);
$postSql = $objConfig->conn->query("SELECT $ipostData from post WHERE post_user_id = '".$userData['id']."'");
	while($postRows =  $postSql->fetch_assoc()){
		$post_title = str_replace(" ", "-", $postRows['post_title']);
		echo"<a href='".WEB_URL."post/".$postRows['post_id']."$ds".$postRows['post_user_id']."{$ds}".$post_title."'>".$postRows['post_title']."</a><br>";

	}

?>
<small class="etxt-primary"><b>Total Posts : <?php echo mysqli_num_rows($postSql); ?></small>
<br>
<a href="<?php echo $newPostURL; ?>">New Post</a>
<?php
echo"<a href='".WEB_URL."logout.php?token=".$_SESSION['name']."'>Logout</a>";
get_footer('profile');
?>
