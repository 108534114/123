
<?php
$host = '127.0.0.1';//127.0.0.1
$user = 'seat';//seat
$password = 'seat995SEAT';//seat995SEAT
$database = 'seat';//seat

$conn = new mysqli($host, $user, $password, $database);

// 確認是否連接成功
if ($conn->connect_error) {
    die("連接資料庫失敗: " . $conn->connect_error);
}
$sql="SELECT * FROM `學生`";
$ret=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($ret)){
    echo "$row[學號]<br/>";
};


?>