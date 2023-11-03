<?php
//include header
include('hr_header.php');

//click button send
//if button save clicked
if(isset($_POST['send']))
{

    //Receive data from input form
    $p=$_POST;
    $job=$p['job'];

    //File upload path
    $targetDir = "../uploads/";
    $fileName = basename($_FILES["attachment"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $allowTypes = array('pdf','PDF');
    //check allow type
    if(in_array($fileType, $allowTypes)){
        //upload file to server
        if(move_uploaded_file($_FILES["attachment"]["tmp_name"],$targetFilePath))
        {
            $sql="INSERT INTO form(f_job,attachment)
            VALUES('$job','$fileName')";

            //Check and run
            if($conn->query($sql))
            {
                $message="Application Sent";
                echo"<script type='text/javascript'>alert('$message');</script>";
                //Redirect to home page
                header("Location:record_list.php");
            }
            else
            {
                //if there has any error
                die('SQL report error' .$conn->error);
            }
        }
        else
        {
            $message="Sorrym there was an error uploading your file.";
            echo"<script type='text/javascript'>alaert('$message');</script>";
        }
    }
    else
    {
        $message="Sorry, only PDF files are allowed to uplaod.";
        echo"<script type='text/javascript'>alert('$message');</script>";
  
    }
}
?>
<!-- nav -->
<nav class="nav nav-tabs">
    <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
    <a class="nav-link" href="record_list.php">Records</a>
    <a class="nav-link" href="job.php">Job</a>
    <a class="nav-link" href="logout.php">Logout</a>
</nav>
<br>
<div class="container">
    <h2>Upload applicant's file here !</h2>
    <br>
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return confirm('Confirm submit this form ?')">

    <div>
        <label for="job">Job</label>
        <select name="job" class="form-select">
            <option value="">Select Job</option>
            <?php 
            $jquery ="SELECT * FROM job";
            $jresult = $conn->query($jquery);
            if($jresult->num_rows> 0){
                while($optionData=$jresult->fetch_assoc()){
                $option =ucwords(strtolower($optionData['j_name']));
                $id =$optionData['j_id'];
            ?>
            <option value="<?php echo $option; ?>" ><?php echo $option; ?> </option>
        <?php
            }}
            ?>
        </select>
    </div>
    <br>
    <div class="mb-3">
      <label for="attachment">Attachment</label>
      <br>
      <input type="file" name="attachment" class="btn btn-light">
    </div>

    <div class="d-grid gap-2 col-1">
      <input type="submit" name="send" value="Send" class="btn btn-primary" required>
    </div>
    </form>
</div>


<?php
// include footer
include('hr_footer.php');
?>