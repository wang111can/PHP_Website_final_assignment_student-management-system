<?php
// 获取要删除的学生学号
$studentId = $_GET['student_id'];

// 判断学号是否为空
if (empty($studentId)) {
    echo "请输入要删除的学号！";
    return;
}

// 连接数据库服务器
$host = "localhost";
$username = "root";
$password = "";
$database = "students_databases";

$conn = mysqli_connect($host, $username, $password);
if (!$conn) {
    die("连接失败：" . mysqli_connect_error());
}

// 设置字符集
mysqli_set_charset($conn, "utf8mb4");
// 选择数据库
mysqli_select_db($conn, $database);

// 构建删除学生信息的 SQL 查询语句
$query = "DELETE FROM students WHERE student_id = '$studentId'";

// 执行查询
if (mysqli_query($conn, $query)) {
    echo "成功删除学号为 $studentId 的学生信息！";
} else {
    echo "删除学生信息失败：" . mysqli_error($conn);
}

// 关闭数据库连接
mysqli_close($conn);
?>
