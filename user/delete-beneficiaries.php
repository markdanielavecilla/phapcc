<?php
    require_once "../connection/connection.php";
    $beneficiaryId = $_GET['id'];
    $status = 1;
    $stmt = $conn->prepare("UPDATE tbl_beneficiaries SET status = ? WHERE ben_id = ? LIMIT 1");
    $stmt->bind_param("ii", $status, $beneficiaryId);
    $stmt->execute();
    $stmt->close();
    header("Location: ./profile.php?id=".$_SESSION['user_id']."#beneficiaries");
?>