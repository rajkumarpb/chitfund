<?php
   session_start();
   unset($_SESSION['is_logged_in']);
   unset($_SESSION['username']);
   header("Location:adminlogin.php");
 ?>
