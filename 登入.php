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
    
    // 查詢帳號是否存在並比對密碼
    $query = "SELECT * FROM `老師帳密` WHERE `老師帳號` = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        if (password_verify($password, $user_data['老師密碼'])) {
            // 登入成功，返回成功訊息
            echo json_encode(["success" => true, "message" => "帳號密碼正確，登入成功！"]);
        } else {
            // 密碼錯誤，返回錯誤訊息
            echo json_encode(["success" => false, "message" => "密碼錯誤，請重新輸入。"]);
        }
    } else {
        // 找不到使用者帳號，返回錯誤訊息
        echo json_encode(["success" => false, "message" => "帳號不存在，請重新輸入。"]);
    }
}
$conn->close();
?>
