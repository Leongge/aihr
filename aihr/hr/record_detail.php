<?php
//include header
include('hr_header.php');

//Get id from record_list
$id=$_GET['id'];
//Get existing data from table cda
//SQL statement to check existing data
$sql_check="SELECT * FROM form WHERE f_id='$id'";
//Query SQL statement
$query_check=$conn->query($sql_check);
//Get result
$rslt=mysqli_fetch_assoc($query_check);
//variable
$name=$rslt['f_name'];
$job=$rslt['f_job'];
$compatibility=$rslt['compatibility'];
?>

<!-- nav -->
<nav class="nav nav-tabs">
    <a class="nav-link" aria-current="page" href="index.php">Dashboard</a>
    <a class="nav-link active" href="record_list.php">Records</a>
    <a class="nav-link" href="job.php">Job</a>
    <a class="nav-link" href="logout.php">Logout</a>
</nav>
<div class="container">
    <br>
    <h2><?php echo $name ?></h2>
    <br>
    <form method="post" action="" onsubmit="return confirm('Confirm submit this form ?')">
        <div class="mb-3">
        <label for="jobname">Job Name</label>
        <input type="text" name="jobname" class="form-control" value="<?php echo $job ?>"required>
        </div>
</div>
<?php   
//include footer
include('hr_footer.php');
?>