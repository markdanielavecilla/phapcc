<?php
    require_once "./includes/connection.php";
    $specialTraining_id = $_GET['id'];
    $status = 1;

    $stmt = $conn->prepare("UPDATE tbl_special_training SET status = ? WHERE st_id = ? LIMIT 1");
    $stmt->bind_param("ii", $status, $specialTraining_id);
    $stmt->execute();
    $stmt->close();

    header("Location: ".$_SERVER['HTTP_REFERER']);
?>