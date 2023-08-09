function saveTableToDatabase() {
    // 將表格資料作為 JavaScript 物件傳送到後端 PHP 檔案
    $.ajax({
        type: 'POST',
        url: '座位資料表.php', // 請將 save-to-database.php 替換為你的後端 PHP 檔案路徑
        data: { tableData: JSON.stringify(tableData) },
        success: function (response) {
            console.log(response); // PHP 檔案回傳的訊息會顯示在瀏覽器的開發者工具中
        },
        error: function (xhr, status, error) {
            console.error(error); // 顯示錯誤訊息
        },
    });
}
document.addEventListener('DOMContentLoaded', function () {
    // ... 其他程式碼 ...

    // 綁定 "儲存" 按鈕的點擊事件
    const saveButton = document.getElementById('save-button');
    saveButton.addEventListener('click', saveTableToDatabase);
});
// 在 randomFillTable 函数中的循环中添加以下代码
cell.textContent = `學號: ${selectedStudent}`;
cell.style.textDecoration = 'none'; // 默认情况下移除横线样式

// 添加点击事件，用于切换选中状态时改变横线样式
cell.addEventListener('click', function () {
    if (cell.style.textDecoration === 'line-through') {
        cell.style.textDecoration = 'none';
    } else {
        cell.style.textDecoration = 'line-through';
    }
});
const selectedStudents = Array.from(document.querySelectorAll('input[name="studentList"]:checked'))
    .map(checkbox => checkbox.value);

// ...

if (selectedStudents.length === 0) {
    console.log("請選擇至少一位學生。");
    return;
}

// 在生成 cell 时，根据已选择的学生为其添加横线样式
if (selectedStudents.includes(selectedStudent)) {
    cell.style.textDecoration = 'line-through';
}

