<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "students_databases";

// 连接数据库服务器
$conn = mysqli_connect($host, $username, $password);
if (!$conn) {
    die("连接失败：" . mysqli_connect_error());
}

// 选择数据库
mysqli_select_db($conn, $database);

// 获取要删除的学生ID
if (isset($_GET['student_ids'])) {
    $studentIds = $_GET['student_ids'];
    $deleteQuery = "DELETE FROM students WHERE student_id IN ($studentIds)";
    mysqli_query($conn, $deleteQuery);
    header("Location: students_view.php");
    exit();
}
// 关闭数据库连接
mysqli_close($conn);
?>
