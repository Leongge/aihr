<?php

if (isset($_GET['f_id'])) {
    $f_id = $_GET['f_id'];

    // Fetch file to download from the database
    $sqldownload = "SELECT attachment FROM form WHERE f_id='$f_id'";
    // Query SQL statement
    $query_check_download = $conn->query($sqldownload);

    $result_download = mysqli_fetch_assoc($query_check_download);
    $filepath = '../uploads/' . $result_download['attachment'];
    $fp = fopen($file, "r");

    if(file_exists($filepath)) {
        header('Content-Length: '.filesize($filepath));
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename='.basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        ob_clean();
        flush();
        readfile('../uploads/' . $result_download['attachment']);

        exit;
    } else {
        die('File not found');
    }

}

?>