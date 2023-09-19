<?php 

    $dbconnect = mysqli_connect('localhost', 'EduBabu', '123qwerty', 'votingdb');

    if(!$dbconnect) {
        echo 'Database failed to connect' . mysqli_connect_error();
    } else {
      // echo "<p style='color: white;'>Database connected</p>";
    }
?>