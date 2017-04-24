<?php
  session_start();
  error_reporting(1);
	if(isset($_SESSION['name'])){
    $locatioReload = WEB_URL."user{$ds}".$_SESSION['name']."{$ds}".session_id();
	  header("location:$locatioReload");
		exit;
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>BasePath</title>
  <noscript>
    <META HTTP-EQUIV="Refresh" CONTENT="0;URL=js-error.php">
  </noscript>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">	
  <link rel="stylesheet" href="<?php echo WEB_URL; ?>style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="h1 text-warning">Website Header</div>