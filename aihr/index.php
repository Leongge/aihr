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
    <link href='https://fonts.googleapis.com/css?family=Fredoka One' rel='stylesheet'>
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
        $pass=($p['pass']);
        $logintype=$p['logintype'];
        //Import database connection
        include('inc/database.php');
        if($logintype=='applicant')
        {
            $sql="SELECT * FROM applicant WHERE username='$user' AND password='$pass'";
            $query=$conn->query($sql);
            $result=mysqli_fetch_assoc($query);
            if($result)//login success
            {
                header("Location:applicant");
                //store session
                $_SESSION['user_id']=$result['a_id'];
            }
            else//data not exist
            {
                //display error
                $login_error='<div style="color:red;">Invalid User and Password</div>';
            }

        }
        else if($logintype='hr')
        {

            header("Location:hr");

        }
        else
        {
            $login_error='<div style="color:red;">Please select your role</div>';
        }
    }
    ?>

    <!-- body -->
    <div class="login-box">

    <div class="mb-3">
        <img src="assets/logo.jpg" style="width:250px;">
    </div>

    <form method="post" action="">
        <div class="mb-3" >
            <table style="margin-left:auto; margin-right:auto;">
                <tr>
                    <td>
                        <p style="margin-top:15px;" class="font-fredoka">I am </p>
                    </td>
                    <td>
                        <input type="radio" id="applicant" name="logintype" value="applicant" style="margin-left:20px;" checked>
                        <label for="applicant">Applicant</label> &emsp;
                        <input type="radio" id="hr" name="logintype" value="hr">
                        <label for="hr">HR</label>

                    </td>
                </tr>
            </table>
        </div>

        <div class="mb-3">
            <input type="text" name="user" class="form-control font-fredoka" placeholder="Username" value="<?php echo $user?>">
        </div>

        <div class="mb-3">
            <input type="password" name="pass" class="form-control font-fredoka" placeholder="Password">
        </div>
        <table style="margin-left:auto; margin-right:auto;">
            <tr>
                <td>
                    <input type="submit" value="Login" name="login" class="btn btn-primary font-fredoka" style="width:100px; margin-left:10px; margin-right:10px;">
                </td>
                <td>
                    <input type="submit" value="Sign up" name="signup" class="btn btn-primary font-fredoka" style="width:100px; margin-left:10px; margin-right:10px;">
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
    }

    .login-box
    {
        text-align:center;
        width:250px;
    }
</style>