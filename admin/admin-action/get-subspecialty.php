<?php
    require_once "./includes/connection.php";

    // GET SSUBSPECIALTY
    $status = 0;
    $stmt = $conn->prepare("SELECT *, count(subspecialty_id) as totalCount FROM tbl_subspecialty LEFT JOIN tbl_hospital_subspecialty ON tbl_subspecialty.sub_id = tbl_hospital_subspecialty.subspecialty_id WHERE status = ? GROUP BY subspecialty_id, subspecialty ORDER BY sub_id ASC");
    $stmt->bind_param("i", $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
?>