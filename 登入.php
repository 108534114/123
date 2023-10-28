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

// 接收用戶提供的帳號和密碼
$user = $_POST['username'];
$pass = $_POST['password'];

// 避免 SQL 注入攻擊，使用 prepared statement
$query = "SELECT * FROM 老師帳密 WHERE 老師帳號 = ? AND 老師密碼 = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();

// 檢查是否有符合的記錄
if ($result->num_rows === 1) {
    // 用戶帳號和密碼正確
    $row = $result->fetch_assoc();
    if ($row['角色'] === '管理者') {
        // 用戶是管理者
        header("Location: admin_index.html");
    } else if ($row['角色'] === '老師') {
        // 用戶是老師
        header("Location: teacher_index.html");
    } else {
        // 未知角色
        echo '未知角色';
    }
    exit;  // 確保後續程式碼不再執行
} else {
    // 用戶帳號或密碼錯誤
    echo '<script>';
    echo 'alert("帳號或密碼錯誤，請再試一次。");';
    echo 'window.location.href = "教師登入頁面.html";';  // 重定向到教師登入頁面
    echo '</script>';
}

// 關閉 prepared statement 和資料庫連接
$stmt->close();
$conn->close();
?>
