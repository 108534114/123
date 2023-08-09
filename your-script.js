// 更新 "全部選取" 按钮的状态
function updateSelectAllButton() {
    const studentCheckboxes = document.querySelectorAll('input[name="studentList"]');
    const selectAllButton = document.getElementById('btn_all');

    // 检查是否所有复选框都被选中
    const allSelected = Array.from(studentCheckboxes).every(checkbox => checkbox.checked);

    // 更新 "全部選取" 按钮的选中状态
    selectAllButton.checked = allSelected;
}

// 在 "全部選取" 按钮的点击事件中调用 updateSelectAllButton
function selectAllStudents() {
    const checkboxes = document.querySelectorAll('input[name="studentList"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = true;
    });
    updateSelectAllButton(); // 更新按钮状态
}
