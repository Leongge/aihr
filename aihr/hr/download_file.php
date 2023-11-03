<?php

// Downloads files
if (isset($_GET['f_id'])) 
{
    $f_id = $_GET['f_id'];

    // fetch file to download from database
    $sqldownload = "SELECT * FROM form WHERE f_id='$f_id'";
    //Query SQL statement
    $query_check_download=$conn->query($sqldownload);

    $result_download = mysqli_fetch_assoc($query_check_download);
    $filepath = '../uploads/' . $result_download['attachment'];

    if(file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . urlencode(basename($filepath)) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Transfer-Encoding: binary');
        readfile('../uploads/' . $result_download['attachment']);

        exit;
    }
    else
    {
        die('error');
    }
}

?>