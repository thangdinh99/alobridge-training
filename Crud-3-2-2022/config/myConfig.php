<?php
    $host = 'localhost';
    $user = 'root';
    $passw ='';
    $database = 'alobridge_crud';
    $conn = mysqli_connect($host, $user, $passw, $database );
    if ($conn){
        mysqli_set_charset($conn, 'utf8');     
    }
    else{
        echo "Cannot connect to database";
    }
?>