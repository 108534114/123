<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'emo';

// 建立資料庫連線
$conn = new mysqli($host, $user, $password, $database);

// 檢查連線是否成功
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];
    
    // 在資料庫中搜尋帳號是否存在
    $check_user_query = "SELECT * FROM `老師帳密` WHERE `老師帳號` = '$username'";
    $check_user_query = "SELECT * FROM `老師帳密` WHERE `老師密碼` = '$password'";
    $check_user_result = $conn->query($check_user_query);

    if ($check_user_result->num_rows > 0) {
        $user_data = $check_user_result->fetch_assoc();
        $stored_password = $user_data['老師密碼'];
        
        // 使用 password_verify() 函數驗證密碼
        if (password_verify($password, $stored_password)) {
            // 登入成功，返回成功訊息
            echo "登入成功";
        } else {
            // 登入失敗，返回錯誤訊息
            header("HTTP/1.1 401 Unauthorized");
            echo "登入失敗，請檢查帳號和密碼。";
        }
    } else {
        // 帳號不存在，返回錯誤訊息
        header("HTTP/1.1 401 Unauthorized");
        echo "登入失敗，請檢查帳號和密碼。";
    }
}
$conn->close();
?>
