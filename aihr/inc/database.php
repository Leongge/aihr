<?php
$host_name="localhost";
$host_user="root";
$host_pwd="";
$db_name="aihr";

//Create connection
$conn=new mysqli($host_name,$host_user,$host_pwd,$db_name);

//Check connection
if($conn->connect_error)
{
    die("Connection failed".$conn->connect_error);
}
?>