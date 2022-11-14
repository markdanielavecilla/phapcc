<?php
    require_once "../connection/connection.php";
    $extraInformationId = $_GET['info_id'];
    
    $setStatus = 1;

    $stmt = $conn->prepare("UPDATE tbl_extrainformation SET status = ? WHERE id = ? LIMIT 1");
    $stmt->bind_param("ii", $setStatus, $extraInformationId);
    $stmt->execute();

    // echo $_SERVER['HTTP_REFERER'];
    header("Location:". $_SERVER['HTTP_REFERER']."#other_affiliation");
?>