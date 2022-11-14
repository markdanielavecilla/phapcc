<?php

    // echo $_GET['id'];
    // echo $_GET['drId'];
    include("../connection.php");

    $drId = $_GET['drId'];

    $stmt = $conn->prepare("DELETE FROM tbl_extrainformation WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $result = $stmt->execute();
    if(!$result) {
        echo "Failed to delete";
    } else {
        $stmt->close();
        header("Location: ../view.php?id=$drId");
    }
    

?>