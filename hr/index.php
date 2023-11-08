<?php
ob_start(); // 启用输出缓冲

//include header
include('hr_header.php');

require __DIR__ . '/vendor/autoload.php'; // Remove this line if you use a PHP Framework.

use Orhanerday\OpenAi\OpenAi;

$open_ai_key = getenv('OPENAI_API_KEY');
$open_ai = new OpenAi($open_ai_key);

// Check if the form is submitted
if (isset($_POST['send'])) {
    // Receive data from the input form
    $p = $_POST;
    $job = $p['job'];

    // File upload path
    $targetDir = "../uploads/";
    $fileName = basename($_FILES["attachment"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $allowTypes = array('pdf', 'PDF');

    // Check allowed file type
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $targetFilePath)) {
            // Extract text from the uploaded PDF
            $parser = new \Smalot\PdfParser\Parser();
            $file = $targetFilePath;
            $pdf = $parser->parseFile($file);
            $pdfText = $pdf->getText();

            $job = $p['job'];

            // Get the job requirement from the database based on the selected job
            $jobSql = "SELECT j_requirement FROM job WHERE j_name = ?";
            $jobStmt = $conn->prepare($jobSql);
            $jobStmt->bind_param("s", $job);
            $jobStmt->execute();
            $jobResult = $jobStmt->get_result();
            if ($jobResult->num_rows > 0) {
                $jobData = $jobResult->fetch_assoc();
                $job_requirement = $jobData['j_requirement'];
            } else {
                // Handle the case when job requirement is not found for the selected job
                $job_requirement = "No specific requirement found for this job.";
            }


            // Perform compatibility and username checks
            $compatibility = $open_ai->chat([
                'model' => 'gpt-4',
                'messages' => [
                    [
                        "role" => "system",
                        "content" => "Position requirement: $job_requirement.
                        
                        I need you based on the position requirement to compare with applicant details to give a marks (0-100%), 
                        and the response must be result (e.g 78) without any explanation"
                    ],
                    [
                        "role" => "user",
                        "content" => $pdfText
                    ],
                ],
                'temperature' => 1.0,
                'max_tokens' => 4000,
                'frequency_penalty' => 0,
                'presence_penalty' => 0,
            ]);

            $username = $open_ai->chat([
                'model' => 'gpt-4',
                'messages' => [
                    [
                        "role" => "system",
                        "content" => "display applicant full name without other word"
                    ],
                    [
                        "role" => "user",
                        "content" => $pdfText
                    ],
                ],
                'temperature' => 1.0,
                'max_tokens' => 4000,
                'frequency_penalty' => 0,
                'presence_penalty' => 0,
            ]);

            $d= json_decode($compatibility);
            $d2 = json_decode($username); 
            // Get Content
            $fcompatibility=$d->choices[0]->message->content;
            $fname=$d2->choices[0]->message->content;
            // Prepare the SQL statement with placeholders
            $sql = "INSERT INTO form (f_name, f_job, attachment, f_status, compatibility) VALUES (?, ?, ?, '', ?)";

            // Create a prepared statement
            $stmt = $conn->prepare($sql);

            // Bind parameters to the statement
            $stmt->bind_param("ssss", $fname, $job, $fileName, $fcompatibility);

            // Execute the statement
            if ($stmt->execute()) {
                $message = "Application Sent";
                echo "<script type='text/javascript'>alert('$message');</script>";
                // Redirect to home page
                header("Location: record_list.php");
            } else {
                // If there is an error
                die('SQL report error' . $stmt->error);
            }

            // Close the prepared statement and database connection
            $stmt->close();
            $conn->close();
        } else {
            $message = "Sorry, there was an error uploading your file.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    } else {
        $message = "Sorry, only PDF files are allowed to upload.";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
ob_end_flush();
?>
<!-- Rest of your HTML code -->

<!-- nav -->
<nav class="nav nav-tabs">
    <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
    <a class="nav-link" href="record_list.php">Records</a>
    <a class="nav-link" href="job.php">Job</a>
    <a class="nav-link" href="logout.php" onclick=" return confirm('Are You sure you want to logout?');">Logout</a>
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