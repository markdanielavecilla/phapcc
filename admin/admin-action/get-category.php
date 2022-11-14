<?php
    require_once "./includes/connection.php";

    // GET CATEGORY
    $status = 0;
    $stmt = $conn->prepare("SELECT *, count(category_id) as totalCount FROM tbl_drcategory LEFT JOIN tbl_hospital_drcategory ON tbl_drcategory.catid = tbl_hospital_drcategory.category_id WHERE status = ? GROUP BY category_id, category ORDER BY catid ASC");
    $stmt->bind_param("i", $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
?>