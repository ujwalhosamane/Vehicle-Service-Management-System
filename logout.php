<?php   
session_start();  
unset($_SESSION['Email']);
unset($_SESSION['usr_type']);  
session_destroy();  
header("location:login.php");  
?> 