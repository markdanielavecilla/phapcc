<?php
    require_once "./includes/connection.php";

    $chapterId = $_GET['id'];

    // GET CHAPTER BY ID
    $stmt = $conn->prepare("SELECT chapter from tbl_chapter WHERE chapid = ?");
    $stmt->bind_param("i", $chapterId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // UPDATE CHAPTER
    $errChapter = "";
    if(isset($_POST['editChapter'])) {
        $flag = true;
        $newChapter = $_POST['chapter'];
        $error = array();

        if(!preg_match("/^[a-zA-Z\s\-]*$/", $newChapter)) {
            $flag = false;
            $errChapter = "Chapter must contain letters only.";
            $error[] = $errChapter;
        }

        if($flag === false && count($error) > 0) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to update chapter</div>";
        } else {
            $chapter = $conn->prepare("UPDATE tbl_chapter SET chapter = ? WHERE chapid = ?");
            $chapter->bind_param("si", $newChapter, $chapterId);
            $chapter->execute();
            $chapter->close();
            $_SESSION['message'] = "<div class='alert alert-success'>Successfully updated chapter</div>";
        }

    }
?>