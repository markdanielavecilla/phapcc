<?php
    require_once "./includes/connection.php";

    // ADD PRACTICE
    if(isset($_POST['addPractice'])) {
        $practice = $_POST['practice-title'];

        $conn->autocommit(FALSE);

        $stmt = $conn->prepare("INSERT INTO tbl_practice (practice) VALUES (?)");
        $stmt->bind_param("s", $practice);
        $stmt->execute();

        if(!$conn->commit()) {
            $_SESSION['message'] = "Failed to add practice";
            $conn->rollback();
            return;
        } else {
            $_SESSION['message'] = "Successfully added practice";
        }
    }
?>