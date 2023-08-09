<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'emo';

// 创建数据库连接
$conn = new mysqli($host, $user, $password, $database);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"]; // 获取明文密码
    
    // 在插入数据之前检查用户名是否已存在
    $check_username_query = "SELECT * FROM `老師帳密` WHERE `老師帳號` = '$username'";
    $check_username_result = $conn->query($check_username_query);
    
    if ($check_username_result->num_rows > 0) {
        echo "帳號已存在，不能重複註冊。";
    } else {
        // 使用预处理语句插入注册信息到数据库
        $stmt = $conn->prepare("INSERT INTO `老師帳密` (`老師姓名`, `老師帳號`, `老師密碼`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $username, $password);
        
        if ($stmt->execute()) {
            // 注册成功后，进行页面重定向
            header("Location: 教師登入頁面.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
}

$conn->close();
?>
