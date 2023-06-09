<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>添加学生信息</title>
    <style>
        body {
            text-align: center;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>添加学生信息</h1>

    <?php
    // PHP代码部分
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "students_databases";

    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
        die("连接数据库失败: " . mysqli_connect_error());
    }
    mysqli_set_charset($conn, "utf8mb4");

    $name = $gender = $student_id = $major = $contact = "";
    $nameErr = $genderErr = $studentIdErr = $majorErr = $contactErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 验证输入的学生信息
        if (empty($_POST["name"])) {
            $nameErr = "姓名不能为空";
        } else {
            $name = test_input($_POST["name"]);
        }

        if (empty($_POST["gender"])) {
            $genderErr = "性别不能为空";
        } else {
            $gender = test_input($_POST["gender"]);
        }

        if (empty($_POST["student_id"])) {
            $studentIdErr = "学号不能为空";
        } else {
            $student_id = test_input($_POST["student_id"]);
            if (strlen($student_id) != 10) {
                $studentIdErr = "学号位数必须为10位";
            } else {
                // 检查学号是否已存在
                $query = "SELECT * FROM students WHERE student_id = '$student_id'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $studentIdErr = "该学号已存在，请重新输入";
                }
            }
        }

        if (empty($_POST["major"])) {
            $majorErr = "专业不能为空";
        } else {
            $major = test_input($_POST["major"]);
        }

        if (empty($_POST["contact"])) {
            $contactErr = "联系方式不能为空";
        } else {
            $contact = test_input($_POST["contact"]);
        }

        // 如果所有输入都有效，则将学生信息插入数据库
        if (empty($nameErr) && empty($genderErr) && empty($studentIdErr) && empty($majorErr) && empty($contactErr)) {
            $query = "INSERT INTO students (name, gender, student_id, major, contact) VALUES ('$name', '$gender', '$student_id', '$major', '$contact')";
            if (mysqli_query($conn, $query)) {
                echo "<p>学生信息添加成功</p>";
            } else {
                echo "<p>学生信息添加失败：" . mysqli_error($conn) . "</p>";
            }
        }
    }

    mysqli_close($conn);

    // 函数用于验证输入的数据
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">姓名：</label>
        <input type="text" name="name" id="name" value="<?php echo $name; ?>">
        <span class="error"><?php echo $nameErr; ?></span>
        <br><br>

        <label for="gender">性别：</label>
        <input type="radio" name="gender" value="男" <?php if ($gender == "男") echo "checked"; ?>>男
        <input type="radio" name="gender" value="女" <?php if ($gender == "女") echo "checked"; ?>>女
        <span class="error"><?php echo $genderErr; ?></span>
        <br><br>

        <label for="student_id">学号：</label>
        <input type="text" name="student_id" id="student_id" value="<?php echo $student_id; ?>">
        <span class="error"><?php echo $studentIdErr; ?></span>
        <br><br>

        <label for="major">专业：</label>
        <input type="text" name="major" id="major" value="<?php echo $major; ?>">
        <span class="error"><?php echo $majorErr; ?></span>
        <br><br>

        <label for="contact">联系方式：</label>
        <input type="text" name="contact" id="contact" value="<?php echo $contact; ?>">
        <span class="error"><?php echo $contactErr; ?></span>
        <br><br>

        <button type="submit">添加</button>
    </form>
    <br>
    <a href="main.php">返回</a>
</body>
</html>
