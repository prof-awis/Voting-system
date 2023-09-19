<?php
    //connect to the database
   $dbconnect= mysqli_connect('localhost', 'EduBabu', '123qwerty', 'votingdb');
   // check whether database connection is successful
       if(!$dbconnect){
           echo "database failed to connect" .mysqli_connect_error();
    } else{
         //create variable to pick up session variable
   $firstname=$_SESSION['firstname'];
   $othernames=$_SESSION['othernames'];

    }

    //check whether the user is logged in
    if(!isset($_SESSION['firstname'])){
        //redirect user to login page
        header('Location:login.php');

    }
    ?>