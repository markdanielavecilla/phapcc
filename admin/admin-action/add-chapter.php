<?php
    require_once "./includes/connection.php";

    // ADD CHAPTER
    if(isset($_POST['addChapter'])) {
        $conn->autocommit(FALSE);

        $chapter = $_POST['chapter-title'];

        $stmt = $conn->prepare("INSERT INTO tbl_chapter (chapter) VALUES (?)");
        $stmt->bind_param("s", $chapter);
        $stmt->execute();
        $stmt->close();

        if(!$conn->commit()) {
            $_SESSION['message'] = "Failed to add chapter";
            $conn->rollback();
        } else {
            $_SESSION['message'] = "Chapter added successfully";
        }
    }
?>