<?php
     $dbconnect= mysqli_connect('localhost', 'EduBabu', '123qwerty', 'votingdb');
//function to sanitize user data
    function sanitize($data){
        $data=htmlspecialchars($data);
        $data = mysqli_real_escape_string($GLOBALS['dbconnect'],$data);

        return $data;


    }
?>