<?php
    require_once "./includes/connection.php";

    // GET CHAPTER LISTS
    $status = 0;
    $stmt = $conn->prepare("SELECT *, COUNT(chapter_id) as totalCount FROM tbl_chapter LEFT JOIN tbl_hospital_chapter ON tbl_chapter.chapid = tbl_hospital_chapter.chapter_id WHERE status = ? GROUP BY chapter_id, chapter");
    $stmt->bind_param("i", $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
?>