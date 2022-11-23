<?php
    require_once "./includes/connection.php";

    // ADD SPECIAL TRAINING
    $errST = "";
    if(isset($_POST['addSpecialTraining'])) {
        $special_training = $_POST['special-training-title'];
        $status = 0;

        $conn->autocommit(FALSE);

        //check if input is empty
        if(empty($special_training)) {
            $errST = "This field is required";
            return;
        }

        //check if special training already exist
        $st = $conn->prepare("SELECT special_training from tbl_special_training where special_training = ?");
        $st->bind_param("s", $special_training);
        $st->execute();
        $resultSt = $st->get_result();
        if($resultSt->num_rows > 0) {
            $errST = "Special training already exist";
            $_SESSION['message'] = "<div class='alert alert-danger'>$errST</div>";
            return;
        }
        $st->close();

        $stmt = $conn->prepare("INSERT INTO tbl_special_training (special_training, status) VALUES (?, ?)");
        $stmt->bind_param("si", $special_training, $status);
        $stmt->execute();

        if(!$conn->commit()) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to add special training</div>";
            $conn->rollback();
            return;
        } else {
            $_SESSION['message'] = "<div class='alert alert-success'>Successfully added special training.</div>";
        }
    }
?>