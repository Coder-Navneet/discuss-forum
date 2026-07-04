<?php
session_start();
session_unset();
session_destroy();
echo "<script>alert('login successfully .')</script>";
header("location:../index.php");

?>