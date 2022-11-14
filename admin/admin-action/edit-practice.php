<?php
    require_once "./includes/connection.php";
    $practiceId = $_GET['id'];

    // GET PRACTICE BY ID
    $stmt = $conn->prepare("SELECT practice FROM tbl_practice WHERE practice_id = ?");
    $stmt->bind_param("i", $practiceId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // UPDATE PRACTICE
    $errPractice = "";
    if(isset($_POST['editPractice'])) {
        $flag = true;
        $newPractice = $_POST['practice'];
        $error = array();

        if(!preg_match("/^[a-zA-Z\s\-]*$/", $newPractice)) {
            $flag = false;
            $errPractice = "Practice must not contain numbers.";
            $error[] = $newPractice;
        }

        if($flag === false && count($error) > 0) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to update practice</div>";
        } else {
            $practice = $conn->prepare("UPDATE tbl_practice SET practice = ? WHERE practice_id = ?");
            $practice->bind_param("si", $newPractice, $practiceId);
            $practice->execute();
            $practice->close();
            $_SESSION['message'] = "<div class='alert alert-success'>Successfully updated practice.</div>";

        }
    }
?>