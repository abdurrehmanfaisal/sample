<?php
    include('functions.inc.php');

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "lawyer_db";

    if($conn = mysqli_connect($hostname,$username,$password,$database)) {
        echo "$database connected successfully!";
    }