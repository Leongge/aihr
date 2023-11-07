<?php
//start session
session_start();
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
    <?php
    $login_error='';
    $user='';

    //button
    if(isset($_POST['login']))
    {
        //Receive data from INPUT
        $p=$_POST;
        $user=$p['user'];
        $pass=$p['pass']; //if wan encrpyt can put encrpt here
        //Import database connection
        include('inc/database.php');
        
        /* { */
            //login coding can insert here
            header("Location:hr");

        /* }
        else
        {
            $login_error='<div style="color:red;">Please select your role</div>';
        } */
    }
    ?>

    <!-- body -->
    <div class="login-box">

    <div class="mb-3">
        <img src="assets/logo.jpg" style="width:250px;">
    </div>

    <form method="post" action="">

        <div class="mb-3">
            <input type="text" name="user" class="form-control fonta" placeholder="Username" value="<?php echo $user?>">
        </div>

        <div class="mb-3">
            <input type="password" name="pass" class="form-control" placeholder="Password">
        </div>
        <table style="margin-left:auto; margin-right:auto;">
            <tr>
                <td>
                    <input type="submit" value="Login" name="login" class="btn btn-primary" style="width:150px; margin-left:10px; margin-right:10px;">
                </td>
            </tr>
            <tr>
                <td>
                    <a href="signup.php" class="btn btn-primary" style="width:150px; margin-left:10px; margin-right:10px; margin-top:5px;">Sign Up</a>
                </td>
            </tr>
        </table>
        <?php
            //Display Error Login if Invalid username and password
            echo $login_error;
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