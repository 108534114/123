<?php
$host = '127.0.0.1';//127.0.0.1
$user = 'seat';//seat
$password = 'seat995SEAT';//seat995SEAT
$database = 'seat';//seat
// 创建数据库连接
$conn = new mysqli($host, $user, $password, $database);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 获取来自前端的数据
$name = $_POST['name'];
$student_id = $_POST['student_id'];
$rating = $_POST['rating'];

// 创建SQL插入语句
$sql = "INSERT INTO students (name, student_id, rating) VALUES ('$name', '$student_id', $rating)";

if ($conn->query($sql) === TRUE) {
    echo "数据插入成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 关闭数据库连接
$conn->close();
?>
