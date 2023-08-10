<?php
session_start(); // 啟動 session
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'emo';

// 建立資料庫連線
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];
    
    // 在資料庫中查詢使用者帳號和密碼
    $query = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
    $result = $conn->query($query);
    
    if ($result->num_rows == 1) {
        // 登入成功
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // 登入成功後重導向到儀表板頁面
    } else {
        echo '<script>alert("登入失敗，請檢查帳號和密碼。");</script>';
    }
}

$conn->close();
?>
