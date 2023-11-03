<?php

// Downloads files
if (isset($_GET['f_id'])) 
{
    $f_id = $_GET['f_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM form WHERE f_id='$f_id'";
    //Query SQL statement
    $query_check=$conn->query($sql);

    $result = mysqli_fetch_assoc($query_check);
    $filepath = '../uploads/' . $result['attachment'];

    if(file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Transfer-Encoding: binary');
        readfile('../uploads/' . $result['attachment']);

        exit;
    }
    else
    {
        die('error');
    }
}

?>