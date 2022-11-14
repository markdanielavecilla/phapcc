<?php
    require_once "./includes/connection.php";
    $subspecialty_id = $_GET['id'];
    $status = 1;

    $stmt = $conn->prepare("UPDATE tbl_subspecialty SET status = ? WHERE sub_id = ? LIMIT 1");
    $stmt->bind_param("ii", $status, $subspecialty_id);
    $stmt->execute();
    $stmt->close();

    header("Location: ".$_SERVER['HTTP_REFERER']);
?>