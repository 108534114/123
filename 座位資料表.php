<?php
// 啟動錯誤報告
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 設定字符集為UTF-8
header('Content-Type: application/json; charset=utf-8');

// 數據庫配置
$host = '127.0.0.1';
$user = 'seat';
$password = 'seat995SEAT';
$database = 'seat';

// 創建連接
$conn = new mysqli($host, $user, $password, $database);

// 檢查連接
if ($conn->connect_error) {
    echo json_encode(["error" => "連接失敗：" . $conn->connect_error]);
    exit();
} 

// 驗證輸入
$inputData = json_decode(file_get_contents("php://input"), true);
if (!isset($inputData['tableData']) || empty($inputData['tableData'])) {
    die("沒有收到任何數據");
}
$tableData = $inputData['tableData'];

$sql = "INSERT INTO 教室座位表 (學號, 姓名, 第幾排, 第幾個) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("準備語句時出錯：" . $conn->error);
}

foreach ($tableData as $rowData) {
    foreach ($rowData as $cellData) {
        if (isset($cellData['student'])) {
            $學號 = $cellData['student']['學號'];
            $姓名 = $cellData['student']['姓名'];
            $stmt->bind_param("ssii", $學號, $姓名, $cellData['第幾排'], $cellData['第幾個']);

            if (!$stmt->execute()) {
                die("保存學號 " . $學號 . " 的表格數據時出錯：" . $stmt->error);
            }
        }
    }
}

echo "所有數據已保存";

$stmt->close();
$conn->close();
?>







