<?php
    require_once "../connection/connection.php";
    $aff_id = $_GET['id'];
    $user_id = $_SESSION['admin_user_id'];
    // GET additional affiliation based on ID selected
    $aff = $conn->prepare("SELECT * from tbl_extrainformation where id = ?");
    $aff->bind_param("i", $aff_id);
    $aff->execute();
    $affResult = $aff->get_result();
    $rowAff = $affResult->fetch_assoc();
    $aff->close();

    // Update additional Information based on ID
    $errHospital = $errContact = $errLandline = "";
    $errors = array();
    if(isset($_POST['save'])) {
        $STRING_VALIDATE = "/^[a-zA-Z0-9\.\s\-]*$/";
        $MOBILE_VALIDATE = "/^((09)[0-9]{9})*$/";
        $flag = true;

        $update_hospital = $conn->real_escape_string($_POST['update_add_affiliation']);
        $update_contact = $conn->real_escape_string($_POST['update_contact_number']);
        $update_landline = $conn->real_escape_string($_POST['update_landline']);

        if(empty($update_hospital)) {
            $flag = false;
            $errHospital = "Hospital affiliation is required";
            $errors[] = $errHospital;
        } else {
            if(!preg_match($STRING_VALIDATE, $update_hospital)) {
                $flag = false;
                $errHospital = "Invalid Hospital name";
                $errors[] = $errHospital;
            }
        }

        if(empty($update_contact)) {
            $flag = false;
            $errContact = "Contact number is required";
            $errors[] = $errContact;
        } else {
            if(!preg_match($MOBILE_VALIDATE, $update_contact)) {
                $flag = false;
                $errContact = "Invalid contact number";
                $errors[] = $errContact;
            }
        }

        if(empty($update_landline)) {
            $flag = false;
            $errLandline = "Landline number is required";
            $errors[] = $errLandline;
        } else {
            if(!preg_match($STRING_VALIDATE, $update_landline)) {
                $flag = false;
                $errLandline = "Invalid landline number";
                $errors[] = $errLandline;
            }
        }

        if($flag) {
            if(count($errors) > 0) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Failed to update additional information</div>";
                return;
            } else {
                $conn->autocommit(false);

                $update_affiliation = $conn->prepare("UPDATE tbl_extrainformation set hospital_aff = ?, contact = ?, landline = ? where id = ?");
                $update_affiliation->bind_param("sssi", $update_hospital, $update_contact, $update_landline, $aff_id);
                $update_affiliation->execute();

                if(!$conn->commit()) {
                    $conn->rollback();
                    return;
                } else {
                    header("Location: ./view-user.php?id=$user_id#otherAffiliation");
                }
            }
        }
    }
?>