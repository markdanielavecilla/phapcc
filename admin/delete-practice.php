<?php
    require_once "./includes/connection.php";
    $practice_id = $_GET['id'];
    $status = 1;

    $stmt = $conn->prepare("UPDATE tbl_practice SET status = ? WHERE practice_id = ? LIMIT 1");
    $stmt->bind_param("ii", $status, $practice_id);
    $stmt->execute();
    $stmt->close();

    header("Location: ".$_SERVER['HTTP_REFERER']);
?>