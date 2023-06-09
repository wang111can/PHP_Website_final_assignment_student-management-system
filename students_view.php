<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>学生信息</title>
    <style>
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%;
        }

        th, td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }

        h1 {
            text-align: center;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>


    <script>
        
        function confirmDelete() {
            
            var checkboxes = document.getElementsByName("student_id");
            var checkedIds = [];
            // 获取 复选 框的 id
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    checkedIds.push(checkboxes[i].value);
                }
            }

            if (checkedIds.length === 0) {
                alert("请先选择要删除的学生！");
            } else if (confirm("确定要删除选中的学生吗？")) {
                var url = "delete_student.php?student_ids=" + checkedIds.join(",");
                window.location.href = url;
                // 调用 删除函数 删除
            }
        }
        
        function searchByStudentId() {

            // 获取 ID 为 "studentIdInput" 的输入框元素，并将其值存储在变量 input 中
            var input = document.getElementById("studentIdInput"); 
            // 转换为 大小写 使在搜所使 忽略大小写
            var filter = input.value.toUpperCase();
            // 获取表单元素
            var table = document.getElementById("studentTable");
            // 把报表元素的 每一行存储在rows 元素 中
            var rows = table.getElementsByTagName("tr");



            for (var i = 1; i < rows.length; i++) {
                // td[1] 为 学号 元素 转换为 大写 方便搜所
                var studentId = rows[i].getElementsByTagName("td")[1].textContent.toUpperCase();
                // > 0 说明 改行 找到 了学生 id
                if (studentId.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    // 否则隐藏改行
                    rows[i].style.display = "none";
                }
            }
        }
        
        // 与 searchById 同理
        function searchByMajor() {
            var input = document.getElementById("majorInput");
            var filter = input.value.toUpperCase();
            var table = document.getElementById("studentTable");
            var rows = table.getElementsByTagName("tr");

            for (var i = 1; i < rows.length; i++) {
                var major = rows[i].getElementsByTagName("td")[3].textContent.toUpperCase();

                if (major.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
        function deleteByStudentId() {
            var input = document.getElementById("deleteStudentIdInput");
            var studentId = input.value.trim(); // 去除 空白字符
            if (studentId === "") {
                alert("请输入要删除的学号！");
                return;
            }
           if (confirm("确定要删除学生吗？")) {
                var url = "delete_student.php?student_ids=" + studentId; 
                window.location.href = url;// 调用 delete_students.php 来删除学生
            }
        }



    </script>


</head>
<body>
    <h1>学生信息</h1>



    <input type="text" id="studentIdInput" placeholder="请输入学号" onkeyup="searchByStudentId()">
    <button onclick="searchByStudentId()">确认搜索</button>
    <br><br>
    
    <input type="text" id="majorInput" placeholder="请输入专业" onkeyup="searchByMajor()">
    <button onclick="searchByMajor()">确认搜索</button>
    <br><br>

    <table id="studentTable">
        <tr>
            <th>选择</th>
            <th>学号</th>
            <th>姓名</th>
            <th>专业</th>
            <th>联系方式</th>
            <th>性别</th>
            <th>编辑</th> <!-- 添加编辑列 -->
        </tr>

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
        // 设置字符集
        mysqli_set_charset($conn, "utf8mb4");
        // 选择数据库
        mysqli_select_db($conn, $database);

        // 查询学生信息
        $query = "SELECT * FROM students";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='student_id' value='" . $row['student_id'] . "'></td>";
                echo "<td>" . $row['student_id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['major'] . "</td>";
                echo "<td>" . $row['contact'] . "</td>";
                echo "<td>" . $row['gender'] . "</td>";
                echo "<td><a href='edit_student.php?student_id=" . $row['student_id'] . "'>编辑</a></td>"; // 添加编辑链接
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>暂无学生信息</td></tr>";
        }

        // 关闭数据库连接
        mysqli_close($conn);
        ?>

    </table>

    <br>
    <button onclick="confirmDelete()">删除所选学生</button>
    <br>
    
    <br>
    <input type="text" id="deleteStudentIdInput" placeholder="请输入要删除的学号">
    <button onclick="deleteByStudentId()"> 删除学生</button>
    <br>



    <a href="main.php">返回</a>
</body>
</html>
