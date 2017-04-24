<?php
$ds = DIRECTORY_SEPARATOR;
include(dirname(__FILE__,'2')."{$ds}init.php");
trait queryMethods{

	public static function register(){
		$objConfig =  new Config();
		if(isset( $_REQUEST['name'] )){
			$email 		= $objConfig->escape_string($_REQUEST['email']);
			$name 		= $objConfig->escape_string($_REQUEST['name']);
			$password 	= $objConfig->escape_string(md5($_REQUEST['password']));
			$city 		= $objConfig->escape_string($_REQUEST['city']);
			$country 	= $objConfig->escape_string($_REQUEST['country']);
			if(!is_string($name)){
				echo "<div class='cem'><i class='glyphicon glyphicon-warning-sign'></i> Name should be of alphabatical characters</div> </div>";
				exit;
			}
			$sql = $objConfig->conn->query("INSERT INTO test(email,name,password,city,country, status,created)VALUES ('$email','$name','$password','$city','$country','1',now())") 
				or die(mysqli_error($objConfig->conn) );
			return $sql;
			$objConfig->conn->close();
		}
	}

	public static function login(){
		$objConfig =  new Config();
		if(isset( $_REQUEST['email'] )){
			session_start();
			$email 		= $objConfig->escape_string($_REQUEST['email']);
			$password 	= $objConfig->escape_string(md5($_REQUEST['password']));
			$sql = $objConfig->conn->query("SELECT * from test WHERE email = '$email' LIMIT 1") 
				or die($objConfig->conn->connect_error);
			$countrows = mysqli_num_rows($sql);
			if($countrows  <= 0){
				echo"<i class='glyphicon glyphicon-warning-sign'></i> No user Found </br>";
			}
			$row = $sql->fetch_array();
			if($row['password'] !== $password){
				echo"<i class='glyphicon glyphicon-warning-sign'></i> Password doesn't match to your account.</br>";
				exit;
			}
			$_SESSION['id'] = $row['id'];
			$_SESSION['name'] = $row['name'];
			$_SESSION['email'] = $row['email'];
			echo "Welcome";

			$objConfig->conn->close();
			exit();
		}
	}
	public static function userData($wfields){
		$eifields = implode(',', $wfields);
		$objConfig =  new Config();

		if(isset($_SESSION['name'])){
			$name = $_SESSION['name'];
			$userId = $_SESSION['id'];
			$sql = $objConfig->conn->query("SELECT $eifields from test WHERE name = '$name' LIMIT 1") 
				or die($objConfig->conn->connect_error);
			$countrows = mysqli_num_rows($sql); 
			$row = $sql->fetch_assoc();
			return $row;
			$objConfig->conn->close();
		}
	}

	public static function postRegister(){
		$objConfig =  new Config();

		if(isset( $_REQUEST['title'] ) && isset( $_REQUEST['userid'] )){
			$user_id 			= $_REQUEST['userid'];
			$userExist = self::userExists($user_id);
			if($userExist === false){
				echo"<script>window.location='extrinsic.php';</script>";
				exit();
			}
			$colorcode = array('#8EE5EE','#838B8B','#4169E1','#4B0082','#2E8B57',	'#6E8B3D','#FF9912','#EE5C42','#71C671','#7171C6');
			$randowmfeaturecolor = array_rand($colorcode,2);
			$randcolor = $colorcode[$randowmfeaturecolor[0]];
			$ftmpImage			= $_FILES['file']['tmp_name'];
			$fImage 			= $_FILES['file']['name'];
			$title 				= $objConfig->escape_string($_REQUEST['title']);
			$titleName 			= explode(" ",$title);
			$titleNameValues 	= array_values($titleName);
			$titleNameGlu  		=implode("-",$titleNameValues);
			$content 			= $objConfig->escape_string($_REQUEST['content']);
			$tags 				= $objConfig->escape_string($_REQUEST['tags']);
			$ds= DIRECTORY_SEPARATOR;
			$featured_image_path = dirname(__FILE__,'3')."{$ds}base-content/featured-note";
			if( !file_exists($featured_image_path)){
				mkdir($featured_image_path,0777,true);
			}

			$sql 				= $objConfig->conn->query("INSERT INTO post(post_title,post_content,featured_color,featured_image,post_user_id,post_name, post_url,post_status,post_tags,post_created,post_modified,post_draft)VALUES ('$title','$content','$$randcolor','$fImage','$user_id','$titleNameGlu','google.com','1','#hello',now(),now(),'0')") or die("Error".$objConfig->conn->connect_error);
			if($sql){
				$sds = move_uploaded_file($ftmpImage, "$featured_image_path/$fImage");
				if($sds){
					echo "Post Added Successfully.";
				}else{
					echo"falied";
				}
			}
			$objConfig->conn->close();
		}
	}

	public static function fetchNote($postElement,$postUserId, $postId){
		$objConfig =  new Config();
		$pElement = implode(',', $postElement);
		$sql = $objConfig->conn->query("SELECT $pElement from post WHERE post_id = '$postId' AND post_user_id = '$postUserId' LIMIT 1") or die(mysqli_error($objConfig->conn));
		if(mysqli_num_rows($sql) > 0){
			$row = $sql->fetch_assoc();
			return $row;
		}

	}

	private static function userExists($userId){
		$objConfig =  new Config();
		$sql = $objConfig->conn->query("SELECT * from test WHERE id = '$userId' LIMIT 1") or die($objConfig->conn->connect_error);
		if(mysqli_num_rows($sql) <= 0){
			return false;
		}
		$objConfig->conn->close();
	}

	public static function confirmLike($loggedinUserId,$postId ){
		$objConfig =  new Config();
		$sql = $objConfig->conn->query("SELECT * from post_likes WHERE post_id='$postId'  AND who_like_id ='$loggedinUserId' LIMIT 1") or die("Error".mysqli_error($objConfig->conn));
		if(mysqli_num_rows($sql) > 0){
			$row = $sql->fetch_assoc();
			return $row;
		}
	} 

	public static function increaselike(){
		$objConfig =  new Config();

		if(isset( $_REQUEST['status'] ) && isset( $_REQUEST['post_id'] ) && isset( $_REQUEST['default_status'] )){
			$status_default = $_REQUEST['default_status'];
			$status = $_REQUEST['status'];
			$post_id = $_REQUEST['post_id'];
			$l_user_id = $_REQUEST['l_user_id'];
			$l_user_name = $_REQUEST['l_user_name'];
			$l_user_email = $_REQUEST['l_user_email'];
			if($l_user_id == 0 && $l_user_name == 0 && $l_user_email == 0){
				echo"loginPlease";
				exit;
			}


			$sql = $objConfig->conn->query("SELECT post_total_likes from post WHERE post_id='$post_id' LIMIT 1 ") or die("Error1".mysqli_error($objConfig->conn));
			if(mysqli_num_rows($sql) > 0){
				$row = $sql->fetch_array();

				$sqlPostLikes = $objConfig->conn->query("SELECT * from post_likes WHERE post_id='$post_id' AND who_like_id='$l_user_id' LIMIT 1 ") or die("Error2".mysqli_error($objConfig->conn));

				if(mysqli_num_rows($sqlPostLikes) <= 0){

					$sqllike = $objConfig->conn->query("INSERT INTO post_likes(post_id,who_like_id,status) VALUES('$post_id','$l_user_id','1')") or die("Error3".mysqli_error($objConfig->conn));
					if($sqllike){
						$nowlike = $row['post_total_likes']+1;
						$updatelike = $objConfig->conn->query("UPDATE post 
						SET post_total_likes = '$nowlike' WHERE post_id='$post_id' LIMIT 1 ") or die("Error".mysqli_error($objConfig->conn));
						if($updatelike){
							echo $nowlike;
							exit;
						}
					}
				}/*else{
					$updatelike = $objConfig->conn->query("UPDATE post_likes 
						SET status = '0' WHERE post_id='$post_id' AND who_like_id='$l_user_id' LIMIT 1 ") or die("Error4".mysqli_error($objConfig->conn));
					$nowlike = $row['post_total_likes']+1;
					if($updatelike){
						echo $nowlike;
						exit;
					}
				}*/
			}
			if($status == '1'){
				$sql = $objConfig->conn->query("SELECT post_total_likes from post WHERE post_id='$post_id' LIMIT 1 ") or die("Error".mysqli_error($objConfig->conn));

				if(mysqli_num_rows($sql) > 0){
					$row = $sql->fetch_array();
					$nowlike = $row['post_total_likes']-1;
					$updatelike = $objConfig->conn->query("UPDATE post 
						SET post_total_likes = ' $nowlike' WHERE post_id='$post_id' LIMIT 1 ") or die("Error".mysqli_error($objConfig->conn));
					$updatepostlike_table = $objConfig->conn->query("UPDATE post_likes
						SET status = '0' WHERE post_id='$post_id' AND who_like_id ='$l_user_id' LIMIT 1 ") or die("Error".mysqli_error($objConfig->conn));
					if($updatepostlike_table){
							echo $nowlike;

						}
				}
			}

			$sqlCountLikes = $objConfig->conn->query("SELECT * from post_likes WHERE post_id = '$post_id' AND status = '1' ");
			echo mysqli_num_rows($sqlCountLikes);
			exit;
			
			/*if($status == '0'){
				$sql = $objConfig->conn->query("SELECT post_total_likes from post WHERE post_id='$post_id' LIMIT 1 ") or die("Error".mysqli_error($objConfig->conn));

				if(mysqli_num_rows($sql) > 0){
					$row = $sql->fetch_array();
					if($row['post_total_likes'] == '0'){
						$nowlike = $row['post_total_likes']+1;
						$updatelike = $objConfig->conn->query("UPDATE post 
						SET post_total_likes = '1' WHERE post_id='$post_id' LIMIT 1 ") or die("Error".mysqli_error($objConfig->conn));
						$updatepostlike_table = $objConfig->conn->query("UPDATE post_likes SET status = '1' WHERE post_id='$post_id' AND who_like_id ='$l_user_id' LIMIT 1 ") or die("Error".mysqli_error($objConfig->conn));
						if($updatepostlike_table){
							echo $nowlike;
							exit;
						}
					}else{ 
						$sql = $objConfig->conn->query("SELECT post_total_likes from post WHERE post_id='$post_id' LIMIT 1 ") or die("Error".mysqli_error($objConfig->conn));
						$nowlike = $row['post_total_likes']+1;
						$updatelike = $objConfig->conn->query("UPDATE post 
						SET post_total_likes = ' $nowlike' WHERE post_id='$post_id' LIMIT 1 ") or die("Error".mysqli_error($objConfig->conn));
						$updatepostlike_table = $objConfig->conn->query("UPDATE post_likes SET status = '1' WHERE post_id='$post_id' AND who_like_id ='$l_user_id' LIMIT 1 ") or die("Error".mysqli_error($objConfig->conn));
						if($updatepostlike_table){
							echo $nowlike;
							exit;
						}
					}
				}
			}*/
			
		}
	}
}

class Queries{
	use queryMethods;
}

