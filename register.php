<?php
echo"<div id='top'></div>";
    get_header();
?>
<form method="post" id="register_form" data-ajaxurl = "<?php echo WEB_URL."base-included/ajax.php";  ?>">
<input type="text" name="email" id="email" placeholder="Email"><br>
<input type="text" name="name" id="name" placeholder="name"><br>
<input type="password" name="password" id="pwd" placeholder="Password"><br>
<input type="text" name="city" id="city" placeholder="City"><br>
<input type="text" name="country" id="country" placeholder="country"><br>
<button type="submit" id="sbtn" name="sbtn">Submit</button>
</form>
<a href="login.php">Login</a>
<?php get_footer(); ?>
