<?php
    require_once "./includes/connection.php";

    //GET COMMITTEE
    $status = 0;
    $stmt = $conn->prepare("SELECT *, COUNT(tbl_hospital_committee.cmt_id) as totalCount FROM tbl_committee LEFT JOIN tbl_hospital_committee ON tbl_committee.cmt_id = tbl_hospital_committee.cmt_id WHERE status = ? GROUP BY tbl_hospital_committee.cmt_id, committee");
    $stmt->bind_param("i", $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
?>