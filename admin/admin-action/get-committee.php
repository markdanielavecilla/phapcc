<?php
    require_once "./includes/connection.php";

    //GET COMMITTEE
    $status = 0;
    $stmt = $conn->prepare("SELECT *, tbl_committee.cmt_id, COUNT(tbl_hospital_committee.cmt_id) as totalCount FROM tbl_committee LEFT JOIN tbl_hospital_committee ON tbl_committee.cmt_id = tbl_hospital_committee.cmt_id WHERE status = ? GROUP BY tbl_hospital_committee.cmt_id, committee ORDER BY tbl_committee.cmt_id ASC");
    $stmt->bind_param("i", $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
?>