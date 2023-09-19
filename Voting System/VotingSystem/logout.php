<?php
   session_start();

//unset individual session variable
//unset($_SESSION['firstname']);

//remove allset variables
session_unset();
//redirect the user to the login page
header('Location:login.php');

?>