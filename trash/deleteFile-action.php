<?php
    ob_start();
    include_once("./connection.php");
    session_start();
    $conn->autocommit(false);

    $fileId = $_GET['fileid'];
    $id = $_SESSION['id'];
    $selected_file = $_GET['file_name'];
    $path = "./files/$selected_file";
    // echo $selected_file;
    $sql = "DELETE FROM tbl_files WHERE fileid = $fileId";
    $conn->query($sql);

    if(!$conn->commit()) {
        die($conn->error);
    } else {
        if(is_file($path)) {
            unlink($path);
            header("Location: view.php?id=$id");
        } else {
            echo "file not found";
        }
    }
    ob_end_flush();
?>