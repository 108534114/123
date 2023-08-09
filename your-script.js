function saveTableToDatabase() {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '座位資料表.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
            } else {
                console.error('AJAX request failed:', xhr.status, xhr.statusText);
            }
        }
    };
    xhr.send(JSON.stringify({ tableData: tableData }));
}

// 在 DOMContentLoaded 事件中绑定按钮点击事件
document.addEventListener('DOMContentLoaded', function () {
    // ... 其他代码 ...

    const selectAllButton = document.getElementById('btn_all');
    selectAllButton.addEventListener('click', selectAllStudents);

    const saveButton = document.getElementById('save-button');
    saveButton.addEventListener('click', saveTableToDatabase);
});
