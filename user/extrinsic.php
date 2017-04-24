<?php

$ds = DIRECTORY_SEPARATOR;
require(dirname(__FILE__,'2')."{$ds}base-setting.php");
get_header('profile');

?>

<div class="h1">No user found, Please Login again.</div>

<?php
redirect_timer('../logout.php',5000);
?>