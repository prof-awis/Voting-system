<?php 

// Connect to the Database
//$dbconnect mysqli_connect(server, username, password, database);
$dbconnect = mysqli_connect('localhost', 'admin', 'omondi2000', 'voting');
mysqli_connect();
//check whether databse connection is successful
if (!$dbconnect) {
    echo "Database failed to connect" . mysqli_connect_error();
}else {
  //echo "<p style='color: white;'>Database connected";
}

//check whether the user is logged in
if (!isset($_SESSION['firstname'])) {
    //Redirect the user to the login page
    header('Location: login.php');
}

?>