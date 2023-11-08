<?php
ob_start();
//include header
include('hr_header.php');


$jobnameerr="";

//if button save clicked
if(isset($_POST['save']))
{
  //Receive data from input form
  $p=$_POST;
  $j_name=ucwords(strtolower($p['jobname']));
  $j_requirement=strtolower($p['jobrequirement']);
  $resultsql=mysqli_query($conn,"SELECT COUNT(*) AS jobexist FROM job WHERE j_name='$j_name'");
  $user_exist = mysqli_fetch_array($resultsql);
  $user_exist = $user_exist['jobexist'];
  
  if($user_exist>0)
  {
    $jobnameerr='<div style="color:red">Job Existed!</div>';
  }
  else
  {
    //SQL statement
    $sql = "INSERT INTO job(j_name, j_requirement) VALUES ('$j_name', '$j_requirement')";



    //Check adn run query
    if($conn->query($sql))
    {
    //Redirect to home page
    header("Location:job.php");
    }
    else
    {
    //if there has any error
    die('SQL report error' .$conn->error);
    }
    }
}
ob_end_flush();
?>
<!-- nav -->
<nav class="nav nav-tabs">
    <a class="nav-link" aria-current="page" href="index.php">Dashboard</a>
    <a class="nav-link" href="record_list.php">Records</a>
    <a class="nav-link active" href="job.php">Job</a>
    <a class="nav-link" href="logout.php" onclick=" return confirm('Are You sure you want to logout?');">Logout</a>
</nav>
<br>
<div class="container">
  <h2>Add Job <a href="job.php" class="btn btn-secondary btn-sm">Back</a></h2>
  <br>
  <form method="post" action="" onsubmit="return confirm('Confirm submit this form ?')">
    <div class="mb-3">
      <label for="jobname">Job Name</label>
      <input type="text" name="jobname" class="form-control" required>
      <small id="passwordHelpBlock" class="form-text text-muted">
      <?php echo $jobnameerr ?>
    </div>

    <div class="mb-3">
      <label for="jobrequirement">Job Requirement</label>
      <textarea type="text" name="jobrequirement" class="form-control" rows=5 placeholder="Put requirement including skills, education, etc..." required></textarea>
    </div>


    <input type="submit" name="save" value="Save" class="btn btn-primary">
</div>

<?php
//include footer
include('hr_footer.php');
?>