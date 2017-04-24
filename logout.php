<?php
session_start();
unset($_SESSION['name']);

session_destroy();

echo"<script>window.location='login.php';</script>";
die;
?>