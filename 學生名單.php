<?php
// 連接資料庫
$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'emo';
// 创建数据库连接
$conn = new mysqli($host, $user, $password, $database);

// 检查连接是否成功
if ($conn->connect_error) {
    die("資料庫連接失敗：" . $conn->connect_error);
}

// 查詢學生名單
$sql = "SELECT * FROM `學生`";
$result = $conn->query($sql);

// 顯示學生名單
$students = array();
if ($result->num_rows > 0) {
    while($row=mysqli_fetch_assoc($result)){
/*      echo "$row[學號]<br/>"; */
        $students[]=$row;
     
    }
}



// 釋放結果集
$result->free();

// 關閉資料庫連接
$conn->close();
// 转换为 JSON 格式
$jsonData = json_encode($students);

// 設定HTTP標頭以通知瀏覽器返回的是JSON格式
header('Content-Type: application/json');

// 返回JSON格式的學生資料
echo $jsonData;