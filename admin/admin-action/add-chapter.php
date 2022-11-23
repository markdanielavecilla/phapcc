<?php
    require_once "./includes/connection.php";

    // ADD CHAPTER
    $errChapter = "";
    if(isset($_POST['addChapter'])) {
        $conn->autocommit(FALSE);

        $chapter = $_POST['chapter-title'];
        $status = 0;

        
        if(empty($chapter)) {
            $errChapter = "This field is required";
            return;
        }

        // check if there is existing chapter on user output
        $chptr = $conn->prepare("SELECT chapter from tbl_chapter where chapter = ?");
        $chptr->bind_param("s", $chapter);
        $chptr->execute();
        $resultChptr = $chptr->get_result();
        if($resultChptr->num_rows > 0) {
            $errChapter = "Chapter already exist.";
            $_SESSION['message'] = "<div class='alert alert-danger'>$errChapter</div>";
            return;
        }
        $chptr->close();
        
        $stmt = $conn->prepare("INSERT INTO tbl_chapter (chapter, status) VALUES (?, ?)");
        $stmt->bind_param("si", $chapter, $status);
        $stmt->execute();
        $stmt->close();

        if(!$conn->commit()) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to add chapter</div>";
            $conn->rollback();
        } else {
            $_SESSION['message'] = "<div class='alert alert-success'>Chapter added successfully</div>";
        }
    }
?>