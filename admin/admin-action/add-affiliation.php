<?php
    require_once "./includes/connection.php";
    $user_id = $_GET['id'];
    $status = 0;

    // UPDATE additional affiliation
    $errAff = $errContact = $errLandline = "";
    $errors = array();
    if(isset($_POST['save'])) {
        $add_affiliation = $conn->real_escape_string($_POST['add_affiliation']);
        $add_contact_number = $conn->real_escape_string($_POST['add_contact_number']);
        $add_landline = $conn->real_escape_string($_POST['add_landline']);

        $STRING_VALIDATE = "/^[a-zA-Z0-9\.\'\s\-]*$/";
        $MOBILE_VALIDATE = "/^(09[0-9]{9})*$/";
        $flag = true;

        if(empty($add_affiliation)) {
            $flag = false;
            $errAff = "Additional affiliation is required.";
            $errors[] = $errAff;
        } else {
            if(!preg_match($STRING_VALIDATE, $add_affiliation)) {
                $flag = false;
                $errAff = "Invalid affiliation.";
                $errors[] = $errAff;
            }
        }

        if(empty($add_contact_number)) {
            $flag = false;
            $errContact = "Contact number is required.";
            $errors[] = $errContact;
        } else {
            if(!preg_match($MOBILE_VALIDATE, $add_contact_number)) {
                $flag = false;
                $errContact = "Invalid contact number.";
                $errors[] = $errContact;
            }
        }

        if(empty($add_landline)) {
            $flag = false;
            $errLandline = "Landline number is required.";
            $errors[] = $errLandline;
        }

        if($flag) {
            if(count($errors) > 0) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Failed to update other affiliation</div>";
                return;
            } else {
                $conn->autocommit(false);

                $insertAff = $conn->prepare("INSERT into tbl_extrainformation (doctors_id, hospital_aff, contact, landline, status) VALUES (?, ?, ?, ?, ?)");
                $insertAff->bind_param("isssi", $user_id, $add_affiliation, $add_contact_number, $add_landline, $status);
                $insertAff->execute();
                $insertAff->close();

                if(!$conn->commit()) {
                    $conn->rollback();
                    return;
                } else {
                    header("Location: ./view-user.php?id=$user_id#otherAffiliation");
                }
            }
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to update additional affiliation</div>";
            return;
        }

    }
?>