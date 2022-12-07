<?php
    session_start();
    require_once "./includes/connection.php";
    $user_id = $_SESSION['admin_user_id'];
    $aff_id = $_GET['id'];
    $update_status = 1;

    // UPDATE status of additional affiliation
    $updateStatus = $conn->prepare("UPDATE tbl_extrainformation set status = ? where id = ?");
    $updateStatus->bind_param("ii", $update_status, $aff_id);
    $updateStatus->execute();

    header("Location: ./view-user.php?id=$user_id#otherAffiliation");
?>