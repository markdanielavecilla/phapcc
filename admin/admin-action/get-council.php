<?php
    require_once "./includes/connection.php";

    // GET COUNCIL LIST
    $status = 0;
    $stmt = $conn->prepare("SELECT *, tbl_council.council_id, COUNT(tbl_hospital_council.council_id) as totalCount FROM tbl_council LEFT JOIN tbl_hospital_council ON tbl_council.council_id = tbl_hospital_council.council_id WHERE status = ? GROUP BY tbl_hospital_council.council_id, council ORDER BY tbl_council.council_id ASC");
    $stmt->bind_param("i", $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
?>