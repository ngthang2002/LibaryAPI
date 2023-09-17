<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "libary";
    $conn = mysqli_connect($host,$username,$password,$database);
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }
?>