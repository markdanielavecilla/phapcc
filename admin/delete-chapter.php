<?php
    require_once "./includes/connection.php";
    $chapter_id = $_GET['id'];
    $status = 1;

    // echo $_SERVER['HTTP_REFERER'];
    $deleteChapter = $conn->prepare("UPDATE tbl_chapter SET status = ? WHERE chapid = ? LIMIT 1");
    $deleteChapter->bind_param("ii", $status, $chapter_id);
    $deleteChapter->execute();
    $deleteChapter->close();

    header("Location: ".$_SERVER['HTTP_REFERER']);
?>