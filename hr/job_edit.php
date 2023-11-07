<?php
ob_start();

//include header
include('hr_header.php');
//get data id
$id=$_GET['id'];

$jobanmeerr="";

//Check existing data
//SQL statement
$sql_check="SELECT * FROM job WHERE j_id='$id'";

//Query
$query_check=$conn->query($sql_check);

//Get result
$result=mysqli_fetch_assoc($query_check);


//Process to update data
//if button save clicked
if (isset($_POST['save'])) {
    // Receive data from input form
    $p = $_POST;
    $j_name = ucwords(strtolower($p['jobname']));
    $j_requirement = $p['jobrequirement'];

    // Prepare the SQL statement with placeholders
    $sql = "UPDATE job SET j_name=?, j_requirement=? WHERE j_id=?";

    // Prepare and bind the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $j_name, $j_requirement, $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the home page
        header("Location: job.php");
    } else {
        // If there is an error
        die("SQL error report " . $stmt->error);
    }
}
ob_end_flush();
?>
<!-- nav -->
<nav class="nav nav-tabs">
    <a class="nav-link" aria-current="page" href="index.php">Dashboard</a>
    <a class="nav-link" href="record_list.php">Records</a>
    <a class="nav-link active" href="job.php">Job</a>
    <a class="nav-link" href="logout.php">Logout</a>
</nav>
<br>
<div class="container">
    <h2>Job Details <a href="job.php" class="btn btn-secondary btn-sm">Back</a></h2>
    <br>
    <form method="post" action="" onsubmit="return confirm('Confirm submit this form ?')">
    
        <div class="mb-3">
        <label for="jobname">Job Name</label>
        <input type="text" name="jobname" class="form-control" value="<?php echo ucwords(strtolower($result['j_name'])) ?>" required>
        </div>

        <div class="mb-3">
        <label for="jobrequirement">Job Requirement</label>
        <textarea type="text" name="jobrequirement" class="form-control" rows=5 placeholder="Put requirement including skills, education, etc..." required><?php echo $result['j_requirement'] ?></textarea>
        </div>

        <div class="d-grid gap-2 col-1">
        <input type="submit" name="save" value="Save" class="btn btn-primary">
        </div>
        <br>
    </form>
</div>

<?php
//include footer
include('hr_footer.php');
?>