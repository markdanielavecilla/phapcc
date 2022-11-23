<?php
    require_once "./includes/connection.php";

    // GET SPECIAL TRAINING
    $status = 0;
    $stmt = $conn->prepare("SELECT *, count(special_training_id) as totalCount FROM tbl_special_training LEFT JOIN tbl_hospital_special_training ON tbl_special_training.st_id = tbl_hospital_special_training.special_training_id WHERE status = ? GROUP BY special_training_id, special_training order by st_id asc");
    $stmt->bind_param("i", $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
?>