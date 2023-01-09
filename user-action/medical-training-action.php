<?php
    require_once "../connection/connection.php";
    session_start();
    $USER_ID = $_SESSION['user_id'];

    //GET THE MEDICAL AND TRAINING INSTITUTION OF A USER
    $stmt = $conn->prepare("SELECT * FROM tbl_school WHERE docid = ?");
    $stmt->bind_param("i", $USER_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    //UPDATE MEDICAL & TRAINING INSTITUTION
    $errMedSchool = $errMedYear = $errTrainInst = $errTrainYear = "";
    $errors = array();
    $flag = true;
    if(isset($_POST['save'])) {
        $VALIDATE_NAME = "/^[a-zA-Z\s\-\.]*$/";
        $VALIDATE_YEAR = "/^((19|20)[0-9]{2})*$/";
        $medicalSchool = test_input($_POST['medical_school']);
        $medicalYear = test_input($_POST['medical_year']);
        $trainingInstitution = test_input($_POST['training_institution']);
        $trainingYear = test_input($_POST['training_year']);

        if(empty($medicalSchool)) {
            $flag = false;
            $errMedSchool = "Medical school name is required";
            $errors[] = $errMedSchool;
        } else {
            if(!preg_match($VALIDATE_NAME, $medicalSchool)) {
                $flag = false;
                $errMedSchool = "Invalid medical school name";
                $errors[] = $errMedSchool;
            }
        }

        if(empty($medicalYear)) {
            $flag = false;
            $errMedYear = "Medical year is required";
            $errors[] = $errMedYear;
        } else {
            if(!preg_match($VALIDATE_YEAR, $medicalYear)) {
                $flag = false;
                $errMedYear = "Invalid Medical year";
                $errors[] = $errMedYear;
            }
        }

        if(empty($trainingInstitution)) {
            $flag = false;
            $errTrainInst = "Training institution name is required";
            $errors[] = $errTrainInst;
        } else {
            if(!preg_match($VALIDATE_NAME, $trainingInstitution)) {
                $flag = false;
                $errTrainInst = "Invalid Training institution name";
                $errors[] = $errTrainInst;
            }
        }

        if(empty($trainingYear)) {
            $flag = false;
            $errTrainYear = "Training institution date finished is required";
            $errors[] = $errTrainYear;
        } else {
            if(!preg_match($VALIDATE_YEAR, $trainingYear)) {
                $flag = false;
                $errTrainYear = "Invalid training year";
                $errors[] = $errTrainYear;
            }
        }

        if($flag) {
            if(count($errors) > 0) {
                $_SESSION['client_message'] = "<div class='alert alert-danger'>Failed to update. Please check your data input to the field</div>";
                return;
            } else {
                $conn->autocommit(false);

                $stmt = $conn->prepare("UPDATE tbl_school SET medical_school = ?, year_graduated = ?, training_school = ?, year_finish = ? WHERE docid = ?");
                $stmt->bind_param("sisii", $medicalSchool, $medicalYear, $trainingInstitution, $trainingYear, $USER_ID);
                $stmt->execute();

                if(!$conn->commit()) {
                    $conn->rollback();
                    exit();
                } else {
                    header("Location: ./profile.php?id=$USER_ID#school");
                }

            }
        } else {
            $_SESSION['client_message'] = "<div class='alert alert-danger'>Failed to update. Please check your data input to the field</div>";
            return;
        }

    }

    function test_input($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
    }

    
?>