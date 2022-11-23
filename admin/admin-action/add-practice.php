<?php
    require_once "./includes/connection.php";

    // ADD PRACTICE
    $errPrac = "";
    if(isset($_POST['addPractice'])) {
        $practice = $_POST['practice-title'];
        $status = 0;

        $conn->autocommit(FALSE);

        //checks if input is empty
        if(empty($practice)) {
            $errPrac = "This field is required";
            return;
        }

        //check if practice exist
        $prac = $conn->prepare("SELECT practice from tbl_practice where practice = ?");
        $prac->bind_param("s", $practice);
        $prac->execute();
        $resultPrac = $prac->get_result();
        if($resultPrac->num_rows > 0) {
            $errPrac = "Practice already exist";
            $_SESSION['message'] = "<div class='alert alert-danger'>$errPrac</div>";
            return;
        }
        $prac->close();

        // Insert new practice
        $stmt = $conn->prepare("INSERT INTO tbl_practice (practice, status) VALUES (?, ?)");
        $stmt->bind_param("si", $practice, $status);
        $stmt->execute();

        if(!$conn->commit()) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to add practice</div>";
            $conn->rollback();
            return;
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger'>Successfully added practice</div>";
        }
    }
?>