<?php
//Import database connection
include('../inc/database.php');

//Get id
$id=$_GET['id'];

//SQL statement
$sql="DELETE FROM job WHERE j_id='$id'";

//Check and run query
if($conn->query($sql))
{
    //redirect to home page
    header("Location:job.php");
}
else
{
    die("SQL error report ".$conn->error);
}
?>