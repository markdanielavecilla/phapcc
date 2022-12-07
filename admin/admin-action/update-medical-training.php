<?php
    require_once "./includes/connection.php";
    $user_id = $_GET['id'];

    // GET medical and training year if existing
    $stmt = $conn->prepare("SELECT * from tbl_school where docid = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $resultStmt = $stmt->get_result();
    $row = $resultStmt->fetch_assoc();
    $stmt->close();

    // UPDATE medical and training institution
    $errMschool = $errMyear = $errTins = $errTyear = "";
    $errors = array();
    if(isset($_POST['save'])) {
        $flag = true;
        $STRING_VALIDATE = "/^[a-zA-Z0-9\'\-\s\.]*$/";
        $YEAR_VALIDATE = "/^((19|20)[0-9]{2})*$/";

        $medical_school = $conn->real_escape_string($_POST['medical_school']);
        $medical_year = $conn->real_escape_string($_POST['medical_year']);
        $training_institution = $conn->real_escape_string($_POST['training_institution']);
        $training_year = $conn->real_escape_string($_POST['training_year']);

        if(empty($medical_school)) {
            $flag = false;
            $errMschool = "Medical school is required.";
            $errors[] = $errMschool;
        } else {
            if(!preg_match($STRING_VALIDATE, $medical_school)) {
                $flag = false;
                $errMschool = "Invalid medical school.";
                $errors[] = $errMschool;
            }
        }

        if(empty($medical_year)) {
            $flag = false;
            $errMyear = "Medical year is required.";
            $errors[] = $errMyear;
        } else {
            if(!preg_match($YEAR_VALIDATE, $medical_year)) {
                $flag = false;
                $errMyear = "Invalid medical year.";
                $errors[] = $errMyear;
            }

            if($medical_year > date("Y")) {
                $flag = false;
                $errMyear = "Medical year should not exceed to the current year";
                $errors[] = $errMyear;
            }
        }

        if(empty($training_institution)) {
            $flag = false;
            $errTins = "Training institution is required.";
            $errors[] = $errTins;
        } else {
            if(!preg_match($STRING_VALIDATE, $training_institution)) {
                $flag = false;
                $errTins = "Invalid training institution.";
                $errors[] = $errTins;
            }
        }

        if(empty($training_year)) {
            $flag = false;
            $errTyear = "Training year is required.";
            $errors[] = $errTyear;
        } else {
            if(!preg_match($YEAR_VALIDATE, $training_year)) {
                $flag = false;
                $errTyear = "Invalid training year.";
                $errors[] = $errTyear;
            }

            if($training_year > date("Y")) {
                $flag = false;
                $errTyear = "Training year should not exceed to the current year.";
                $errors[] = $errTyear;
            }
        }

        if($flag) {
            if(count($errors) > 0) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Please fill up field correctly.</div>";
                return;
            } else {
                $conn->autocommit(false);

                $updateQry = $conn->prepare("UPDATE tbl_school Set medical_school = ?, year_graduated = ?, training_school = ?, year_finish = ? where docid = ?");
                $updateQry->bind_param("sisii", $medical_school, $medical_year, $training_institution, $training_year, $user_id);
                $updateQry->execute();
                $updateQry->close();

                if(!$conn->commit()) {
                    $conn->rollback();
                    return;
                } else {
                    header("Location: ./view-user.php?id=$user_id#school");
                }
            }
        }
    }
?>