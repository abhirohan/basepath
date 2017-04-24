<?php
$ds = DIRECTORY_SEPARATOR;
require(dirname(__FILE__,'2')."{$ds}base-setting.php");
get_header('profile');
$wfields = array('id','name','email','city','status','country');
$userData = Queries::userData($wfields);
if( isset($_REQUEST['user_id'])){
	$user_id = $_REQUEST['user_id'];
}

	//redirect_timer('user.php?redirect=note_added',300000000);

?><br>
<div  id='act'></div>
<?php
	echo "Name : ".$userData['name']."<br>";

echo"<a href='../logout.php?token=".$_SESSION['name']."'>Logout</a>";
?>
<form data-ajaxurl = "<?php echo WEB_URL."base-included/ajax.php";  ?>" id="postForm" name="postForm"  method="POST" enctype="multipart/form-data">
<input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>"><br>
<input type="hidden" id="classname" name="classname" value="Queries"><br>
<input type="hidden" id="method" name="method" value="postRegister"><br>
<input type="text" name="title" id="title" placeholder="Title"><br>
<input type="file" name="file" id="file" accept="image/gif, image/jpeg" />
<textarea name="content" id="content" rows="5"></textarea><br>
<input type="text" name="tags" id="tags" placeholder="Keywords/Tags (eg: #basepath)"><br>

<button type="submit" id="postbtn" name="postbtn">Submit</button>
<img src="" id="show">
</form>


<?php
get_footer('profile');
?>
