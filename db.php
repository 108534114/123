<?php

$host = 'localhost';
$user = 'seat';
$password = 'seat995SEAT';
$database = 'seat';

// 建立 MySQLi 連接
$conn = new mysqli($host, $user, $password, $database);

// 檢查連接是否成功
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

?>