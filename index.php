<?php 
require 'create_databases.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>学生管理系统</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        h1 {
            text-align: center;
            margin-top: 50px;
        }
        
        .container {
            width: 300px;
            margin: 0 auto;
            margin-top: 50px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        
        .form-group input {
            width: 100%;
            padding: 5px;
        }
        
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        
        .btn-container button {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>学生管理系统</h1>
    <div class="container">
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="username">用户名</label>
                <input type="text" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">密码</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="btn-container">
                <button type="submit">登录</button>
            </div>
        </form>
    </div>
</body>
</html>
