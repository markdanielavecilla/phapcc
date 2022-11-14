<?php
    require_once "./includes/connection.php";

    // ADD SPECIAL TRAINING
    if(isset($_POST['addSpecialTraining'])) {
        $special_training = $_POST['special-training-title'];

        $conn->autocommit(FALSE);

        $stmt = $conn->prepare("INSERT INTO tbl_special_training (special_training) VALUES (?)");
        $stmt->bind_param("s", $special_training);
        $stmt->execute();

        if(!$conn->commit()) {
            $_SESSION['message'] = "Failed to add special training";
            $conn->rollback();
            return;
        } else {
            $_SESSION['message'] = "Successfully added special training.";
        }
    }
?>