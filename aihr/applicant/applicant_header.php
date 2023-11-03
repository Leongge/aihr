<?php
//start session
session_start();

//if session not found
if(!isset($_SESSION['user_id']))
{
    header('Location:../index.php');
}
else
{
    $user_id=$_SESSION['user_id'];
}
?>

<!DOCTYPE html>
<html lang="eng">
<head>
    <title>AIHR</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="desktop.css">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Fredoka One' rel='stylesheet'>
    <script>
    function delete_data(url)
    {
      var conf=confirm('Are you sure to delete?');
      if(conf)
      {
        window.location=url;
      }
      else
      {
        return false;
      }
    }
    </script>
</head>
<body>
<?php

//include db
include('../inc/database.php');
?>
