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
    $signup_err='';

    //button
    if(isset($_POST['signup']))
    {
        //Receive data from INPUT
        $p=$_POST;
        $name=$p['name'];
        $user=$p['user'];
        $email=$p['email'];
        $pass=$p['pass']; //if wan encrpyt can put encrpt here
        $repass=$p['repass'];
        //Import database connection
        include('inc/database.php');
        
        $resultsql=mysqli_query($conn,"SELECT COUNT(*) AS userexist FROM hr WHERE username='$user'");
        $user_exist = mysqli_fetch_array($resultsql);
        $user_exist = $user_exist['userexist'];
        if($user_exist>0)
        {
            $signup_err='<div style="color:red">Username taken!</div>';
        }
        else
        {
            if(strlen($pass)<8 || strlen($pass)>20)
            {
            $passworderr='<div style="color:red">Your password must be 8-20 characters long</div>';
            }
            else
            {
            $number = preg_match('@[0-9]@', $pass);
            $uppercase = preg_match('@[A-Z]@', $pass);
            $lowercase = preg_match('@[a-z]@', $pass);
            $specialChars = preg_match('@[^\w]@', $pass);
            if(!$number || !($uppercase||$lowercase) )
            {
                $signup_err='<div style="color:red">You password must contain at least one number and one letter</div>';
            }
            else
            {
                if($specialChars)
                {
                $signup_err='<div style="color:red">Your password must not contain special characters</div>';
                }
                else
                {
                if($repass==$pass)
                {
                    //SQL statement
                    $sql="INSERT INTO hr(hr_name,username,pass,email)
                    VALUES('$name','$user','$pass','$email')";

                    //Check adn run query
                    if($conn->query($sql))
                    {
                    //Redirect to home page
                    header("Location:index.php");
                    }
                    else
                    {
                    //if there has any error
                    die('SQL report error' .$conn->error);
                    }
                }
                else
                {
                    $signup_err='<div style="color:red">Password not matched</div>';
                }
                }
            }
            }
        }
    }
    ?>
    <!-- body -->
    <div class="login-box">

    <div class="mb-3">
        <img src="assets/logo.jpg" style="width:250px;">
    </div>

    <form method="post" action="">

        <div class="mb-3">
            <input type="text" name="name" class="form-control fonta" placeholder="Name" require>
        </div>

        <div class="mb-3">
            <input type="text" name="email" class="form-control fonta" placeholder="Email" require>
        </div>

        <div class="mb-3">
            <input type="text" name="user" class="form-control fonta" placeholder="Username" require>
        </div>

        <div class="mb-3">
            <input type="password" name="pass" class="form-control" placeholder="Password" require>
        </div>

        <div class="mb-3">
            <input type="password" name="repass" class="form-control" placeholder="Confirm Password" require>
        </div>
        <table style="margin-left:auto; margin-right:auto;">
            <tr>
                <td>
                    <input type="submit" value="Sign up" name="signup" class="btn btn-primary" style="width:150px; margin-left:10px; margin-right:10px;">
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