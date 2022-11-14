<?php
    require_once "./includes/connection.php";

    // GET SSUBSPECIALTY
    $status = 0;
    $stmt = $conn->prepare("SELECT * FROM tbl_subspecialty WHERE status = ?");
    $stmt->bind_param("i", $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
?>