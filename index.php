<?php

// 启动会话
session_start();

$login_error = '';
$user = '';


// 检查用户是否提交登录表单
if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // 导入数据库连接
    include('inc/database.php');

    // 查询数据库以验证用户名和密码
    $sql = "SELECT * FROM hr WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // 登录成功，可以设置会话变量或重定向到其他页面
        $_SESSION['user_id'] = $row['hr_id'];
        header("Location:hr");
        exit();
    } else {
        $login_error = '<div style="color:red;">Wrong email or password</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>AIHR</title>
    <!-- 所需的元标记 -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="desktop.css">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
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
            <input type="text" name="user" class="form-control fonta" placeholder="Email" value="<?php echo $user ?>">
        </div>

        <div class="mb-3">
            <input type="password" name="pass" class="form-control" placeholder="Password">
        </div>
        <table style="margin-left:auto; margin-right:auto;">
            <tr>
                <td>
                    <input type="submit" value="Login" name="login" class="btn btn-primary"
                           style="width:150px; margin-left:10px; margin-right:10px;">
                </td>
                <tr>
                <td>
                    <a href="signup.php" class="btn btn-primary" style="width:150px; margin-left:10px; margin-right:10px; margin-top:5px;">Sign Up</a>
                </td>
            </tr>
            </tr>
        </table>
        <?php
        // 显示登录错误消息
        echo $login_error;
        ?>
    </form>

</div>
</body>
</html>

<style>
    body {
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-image: url('assets/bg1.jpg');
        background-size: cover;
        font-family: 'Poppins', sans-serif;
    }

    .login-box {
        text-align: center;
        width: 250px;
    }
</style>
