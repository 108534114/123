<?php
$host = 'localhost';
$user = 'seat';
$password = 'seat995SEAT';
$database = 'seat';

// 建立数据库连接
$conn = new mysqli($host, $user, $password, $database);

// 確認是否連接成功
if ($conn->connect_error) {
    die("連接資料庫失敗: " . $conn->connect_error);
}

// 檢查請求方法是否為 POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 取得 POST 請求中的表格資料
    $jsonData = $_POST['tableData'];

    // 解析 JSON 資料
    $tableData = json_decode($jsonData, true);

    // 建立資料表格，如果尚未建立的話（假設你的資料表格名稱為 "seat_data"）
    $sql = "CREATE TABLE IF NOT EXISTS seat_data (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        student_id VARCHAR(30) NOT NULL,
        student_name VARCHAR(50) NOT NULL,
        classroom_row INT(6) NOT NULL,
        classroom_column INT(6) NOT NULL
    )";

    if ($conn->query($sql) === false) {
        echo "建立資料表格失敗: " . $conn->error;
        $conn->close();
        return;
    } else {
        echo "建立資料表格成功。";
    }

    // 先清空原有的資料
    $sql = "TRUNCATE TABLE seat_data";

    if ($conn->query($sql) === false) {
        echo "清空資料表格失敗: " . $conn->error;
        $conn->close();
        return;
    } else {
        echo "清空資料表格成功。";
    }

    // 插入新的資料
    foreach ($tableData as $rowData) {
        $studentId = $rowData['student_id'];
        $studentName = $rowData['student_name'];
        $classroomRow = $rowData['classroom_row'];
        $classroomColumn = $rowData['classroom_column'];

        $sql = "INSERT INTO seat_data (student_id, student_name, classroom_row, classroom_column) 
                VALUES ('$studentId', '$studentName', '$classroomRow', '$classroomColumn')";

        if ($conn->query($sql) === false) {
            echo "插入資料失敗: " . $conn->error;
            $conn->close();
            return;
        } else {
            echo "插入資料成功。";
        }
    }

    echo "表格資料已成功儲存到資料庫。";
    $conn->close();
    return;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
