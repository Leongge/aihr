<?php
// 启动会话
session_start();

$signup_err = '';

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];

    // 添加输入验证（例如，检查密码是否匹配，是否已存在相同的用户名等）
    if ($pass !== $repass) {
        $signup_err = '<div style="color:red;">Password and Confirm Password do not match</div>';
    } else {
        // 导入数据库连接
        include('inc/database.php');

        // 检查是否已存在相同的用户名
        $check_sql = "SELECT * FROM hr WHERE username = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $user);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $signup_err = '<div style="color:red;">Username already exists</div>';
        } else {
            // 插入新用户数据
            $insert_sql = "INSERT INTO hr (email, hr_name, username, password) VALUES (?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("ssss", $email, $name, $user, $pass);

            if ($insert_stmt->execute()) {
                // 注册成功后可以重定向到登录页面或其他操作

               echo '<script>alert("Registration successful. You will be redirected to the index page.");</script>';
                echo '<script>setTimeout(function() { window.location.href = "index.php"; }, 2000);</script>';
            } else {
                $signup_err = '<div style="color:red;">Registration failed</div>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>AIHR</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="desktop.css">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
</head>
<body>
   
    <!-- body -->
    <div class="login-box">

    <div class="mb-3">
        <img src="assets/logo.jpg" style="width:250px;">
    </div>

    <form method="post" action="">

        <div class="mb-3">
            <input type="text" name="name" class="form-control fonta" placeholder="Name" required>
        </div>

        <div class="mb-3">
            <input type="text" name="email" class="form-control fonta" placeholder="Email" required>
        </div>

        <div class="mb-3">
            <input type="text" name="user" class="form-control fonta" placeholder="Username" required>
        </div>

        <div class="mb-3">
            <input type="password" name="pass" class="form-control" placeholder="Password" required>
        </div>

        <div class="mb-3">
            <input type="password" name="repass" class="form-control" placeholder="Confirm Password" required>
        </div>
        <table style="margin-left:auto; margin-right:auto;">
            <tr>
                <td>
                    <input type="submit" value="signup" name="signup" class="btn btn-primary" style="width:150px; margin-left:10px; margin-right:10px;">
                </td>
            </tr>
            <tr>
                <td>
                    <a href="index.php" class="btn btn-secondary" style="width:150px; margin-left:10px; margin-right:10px; margin-top:5px;">Back</a>
                </td>
            </tr>
        </table>
        <?php
            //Display Error if used username or incorrect password
            echo $signup_err;
        ?>
    </form>

    </div>
</body>
</html>

<style>
    body
    {
        margin:0;
        height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        background-image:url('assets/bg1.jpg');
        background-size:cover;
        font-family: 'Poppins', sans-serif;
    }

    .login-box
    {
        text-align:center;
        width:250px;
    }
</style>