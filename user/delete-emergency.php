<?php
    require_once "../connection/connection.php";
    $emergencyId = $_GET['id'];
    $status = 1;
    $stmt = $conn->prepare("UPDATE tbl_contact_person SET status = ? WHERE cp_id = ? LIMIT 1");
    $stmt->bind_param("ii", $status, $emergencyId);
    $stmt->execute();
    $stmt->close();
    header("Location: ./profile.php?id=".$_SESSION['user_id']."#contact_person");
?>