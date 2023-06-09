<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "students_databases";

// 连接数据库服务器
$conn = mysqli_connect($host, $username, $password);
if (!$conn) {
    die("connect fail" . mysqli_connect_error());
}
// 设置字符集
mysqli_set_charset($conn, "utf8mb4");
// 创建数据库
$query = "CREATE DATABASE IF NOT EXISTS $database  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ";
if (mysqli_query($conn, $query)) {
    // echo "created success<br>";
} else {
    // echo "created fail" . mysqli_error($conn) . "<br>";
}

// 选择数据库
mysqli_select_db($conn, $database);

// 创建users数据表
$query = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";


if (mysqli_query($conn, $query)) {
    // echo "table<br>";
} else {
    // echo "table" . mysqli_error($conn) . "<br>";
}


$username = "111";
$password = "111";

// 检查用户名是否已经存在
$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) <= 0) {
    // 插入用户信息
    $insertQuery = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $insertQuery)) {
        // echo "用户插入成功";
    } else {
        // echo "用户插入失败: " . mysqli_error($conn);
    }
}

mysqli_select_db($conn, $database);
// 创建学生表

$query = "CREATE TABLE IF NOT EXISTS students (
    student_id VARCHAR(50) PRIMARY KEY,
    name VARCHAR(50),
    major VARCHAR(50),
    contact VARCHAR(50),
    gender VARCHAR(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";


if (mysqli_query($conn, $query)) {
    // echo "数据表创建成功";
} else {
    // echo "数据表创建失败: " . mysqli_error($conn);
}


// 关闭数据库连接
mysqli_close($conn);
?>
