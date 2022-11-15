<?php 

//Start the session
session_start();

//unset individual session variable
// unset($_SESSION['firstname']);
// unset($_SESSION['othernames']);
// unset($_SESSION['id']);
// unset($_SESSION['contact']);
// unset($_SESSION['emailadress']);
// unset($_SESSION['password']);

// But to  remove all session variables we use
session_unset();

//Redirect the user to the login page
header('Location: login.php');

?>