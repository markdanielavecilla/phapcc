<?php
    require_once "./includes/connection.php";
    $council_id = $_GET['id'];
    $status = 1;

    $stmt = $conn->prepare("UPDATE tbl_council SET status = ? WHERE council_id = ? LIMIT 1");
    $stmt->bind_param("ii", $status, $council_id);
    $stmt->execute();
    $stmt->close();

    header("Location: ".$_SERVER['HTTP_REFERER']);
?>