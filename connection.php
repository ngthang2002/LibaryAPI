<?php
    $host = "192.168.249.134";
    $username = "ngt";
    $password = "Qscefb123..";
    $database = "libaryutt";
    $conn = mysqli_connect($host,$username,$password,$database);
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }
?>