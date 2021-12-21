<?php
    session_start();
    require_once('database.php');
    $check = check_download($_GET['file']);

    if (!isset($_SESSION['email']) || (!$check && (!check_product_of_account($_SESSION['email'], $check['IdProduct']) || 
    !check_provider($_SESSION['email'], $check['IdProduct'])))) {
        header('location: index.php');
        exit();
    }
   
    if(isset($_REQUEST["file"])) {
        // Get parameters
        $file = urldecode($_REQUEST["file"]); 
        $file_ext_arr = explode(".", $file);
        $file_ext = end($file_ext_arr);

        $filepath = "file/" . $file;
        $name_app = $_GET["name"];
        $file_download = "file/". $name_app . "." . $file_ext;

        // download
        if (file_exists($filepath)) {
            copy($filepath, $file_download);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'. basename($file_download) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); 
            readfile($filepath);
            unlink($file_download);
            exit();
        } else {
            die('File không tồn tại');
        }
    } 

    // echo "helo";
?>