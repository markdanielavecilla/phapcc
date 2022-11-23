<?php
    require_once "./includes/connection.php";

    // GET PRACTICE
    $status = 0;
    $stmt = $conn->prepare("SELECT *, tbl_practice.practice_id, count(tbl_hospital_practice.practice_id) as totalCount FROM tbl_practice LEFT JOIN tbl_hospital_practice ON tbl_practice.practice_id = tbl_hospital_practice.practice_id WHERE status = ? GROUP BY tbl_hospital_practice.practice_id, practice order by tbl_practice.practice_id asc");
    $stmt->bind_param("i", $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
?>