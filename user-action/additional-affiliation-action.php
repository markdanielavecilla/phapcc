<?php
    session_start();
    require_once "../connection/connection.php";
    $USER_ID = $_SESSION['user_id'];

    // ADDITIONAL AFFILIATION
    $errors = array();
    $errAddAffiliation = $errAddContact = $errAddLandline = "";

    if(isset($_POST['save_additionalAffiliation'])) {
        $VALIDATE_NAME = "/^[a-zA-Z\s\-\.]*$/";
        $VALIDATE_NUMBER = "/^((09)[0-9]{9})*$/";
        $VALIDATE_LANDLINE = "/^[0-9\-\(\)]*$/";
        $flag = true;
        $defaultStatus = 0;

        $addAffiliation = test_input($_POST['add_affiliation']);
        $addContactNumber = test_input($_POST['add_contact_number']);
        $addLandline = test_input($_POST['add_landline']);
        
        if(empty($addAffiliation)) {
            $errAddAffiliation = "This field is required";
            $flag = false;
            $errors[] = $errAddAffiliation;
        } else {
            if(!preg_match($VALIDATE_NAME, $addAffiliation)) {
                $flag = false;
                $errAddAffiliation = "Invalid hospital affiliation name";
                $errors[] = $errAddAffiliation;
            }
        }

        if(empty($addContactNumber)) {
            $errAddContact = "This field is required";
            $flag = false;
            $errors[] = $errAddContact;
        } else {
            if(!preg_match($VALIDATE_NUMBER, $addContactNumber)) {
                $flag = false;
                $errAddContact = "Invalid Contact number";
                $errors[] = $errAddContact;
            }
        }

        if(empty($addLandline)) {
            $errAddLandline = "This field is required";
            $flag = false;
            $errors[] = $errAddLandline;
        } else {
            if(!preg_match($VALIDATE_LANDLINE, $addLandline)) {
                $flag = false;
                $errAddLandline = "Invalid landline number";
                $errors[] = $errAddLandline;
            }
        }

        if($flag === false && count($errors) > 0) {
            $_SESSION['client_message'] = "<div class='alert alert-danger'>Failed to insert to data. Please check all fields</div>";
            return;
        } else {
            $conn->autocommit(FALSE);

            $stmt = $conn->prepare("INSERT INTO tbl_extrainformation (doctors_id, hospital_aff, contact, landline, status) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("isssi", $USER_ID, $addAffiliation, $addContactNumber, $addLandline, $defaultStatus);
            $stmt->execute();

            if(!$conn->commit()) {
                $_SESSION[' client_message'] = "<div class='alert alert-danger'>Failed to insert data.</div>";
                return;
            } else {
                header("Location: ../user/profile.php?id".$USER_ID."#other_affiliation");
                return;
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>