<?php
    require_once "./includes/connection.php";
    $specialTrainingId = $_GET['id'];

    // GET SPECIAL TRAINING BY ID
    $stmt = $conn->prepare("SELECT special_training FROM tbl_special_training WHERE st_id = ?");
    $stmt->bind_param("i", $specialTrainingId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // UPDATE SPECIAL TRAINING
    $errSpecialTraining = "";
    if(isset($_POST['editSpecialTraining'])) {
        $flag = true;
        $newSpecialTraining = $_POST['special_training'];
        $error = array();

        if(!preg_match("/^[a-zA-Z\s\-]*$/", $newSpecialTraining)) {
            $flag = false;
            $errSpecialTraining = "Special training must not contain numbers.";
            $error[] = $errSpecialTraining;
        }

        if($flag === false && count($error) > 0) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to update special training</div>";
        } else {
            $specialTraining = $conn->prepare("UPDATE tbl_special_training SET special_training = ? WHERE st_id = ?");
            $specialTraining->bind_param("si", $newSpecialTraining, $specialTrainingId);
            $specialTraining->execute();
            $specialTraining->close();
            $_SESSION['message'] = "<div class='alert alert-success'>Successfully updated special training.</div>";
        }
    }
?>