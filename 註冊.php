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
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"]; // 取得明文密碼
    
    // 在插入資料之前檢查使用者名稱是否已經存在
    $check_username_query = "SELECT * FROM `老師帳密` WHERE `老師帳號` = '$username'";
    $check_username_result = $conn->query($check_username_query);
    
    if ($check_username_result->num_rows > 0) {
        echo "帳號已存在，無法重複註冊。<br>";
        echo '<a href="註冊.html">返回註冊頁面</a>';
    } else {
        // 使用預備語句將註冊資訊插入資料庫
        $stmt = $conn->prepare("INSERT INTO `老師帳密` (`老師姓名`, `老師帳號`, `老師密碼`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $username, $password);
        
        if ($stmt->execute()) {
            // 註冊成功後，進行頁面重導向
            header("Location: 教師登入頁面.html");
            exit();
        } else {
            echo "註冊失敗，請稍後再試。";
        }
        
        $stmt->close();
    }
}

$conn->close();
?>
