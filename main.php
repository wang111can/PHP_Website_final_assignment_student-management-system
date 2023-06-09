<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> 主页 </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        .container {
            width: 500px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .button-container .button {
            margin: 10px;
        }
        
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1> 主页 </h1>
        <div class="button-container">
            <button class="button" onclick="location.href='students_view.php'"> 查看 并编辑 所有学生信息 </button>
            <button class="button" onclick="location.href='addstudents.php'"> 添加学生 </button>
            <!-- <button class="button" onclick="location.href='page5.html'">按钮5</button>
            <button class="button" onclick="location.href='page6.html'">按钮6</button>
            <button class="button" onclick="location.href='page7.html'">按钮7</button>
            <button class="button" onclick="location.href='page8.html'">按钮8</button>
            <button class="button" onclick="location.href='page9.html'">按钮9</button>
            <button class="button" onclick="location.href='page10.html'">按钮10</button> -->
        </div>
    </div>
</body>
</html>
