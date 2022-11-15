<?php 
$dbcon =  mysqli_connect('localhost', 'admin', 'omondi2000', 'voting');

// Require/includethe Database Connection Page
// require("db_connect.php");

//function to sanitize user data
function sanitize($data){
    $data = htmlspecialchars($data);
    // $data = mysqli_real_escape_string($dbconnect, $data);
     $data = mysqli_real_escape_string($GLOBALS['dbcon'], $data);

     return $data;
}


?>