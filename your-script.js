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
