<?php
    require_once "./includes/connection.php";
    $committee_id = $_GET['id'];
    
    // USE FOR SOFT DELETE
    $status = 1;
    
    $stmt = $conn->prepare("UPDATE tbl_committee SET status = ? WHERE cmt_id = ? LIMIT 1");
    $stmt->bind_param("ii", $status, $committee_id);
    $stmt->execute();
    $stmt->close();

    header("Location: ".$_SERVER['HTTP_REFERER']);
?>