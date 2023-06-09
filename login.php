<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "students_databases";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("数据库连接失败：" . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)) {
        header("Location: main.php"); // 跳转到 主页面
        echo "<script>alert('login success');</script>";

        // 在这里可以跳转到其他页面或执行其他操作
    } else {
        echo "<script>alert('login fail');</script>";
    }
}

mysqli_close($conn);
?>
