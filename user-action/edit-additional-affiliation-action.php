<?php
    session_start();
    require_once "../connection/connection.php";

    // ID OF USER
    $USER_ID = $_SESSION['user_id'];

    // ID OF DATA UPDATING
    $info_id = $_GET['info_id'];

    // GET EXISTING ADDITIONAL AFFILIATION
    $stmt = $conn->prepare("SELECT hospital_aff, contact, landline FROM tbl_extrainformation WHERE id = ?");
    $stmt->bind_param("i", $info_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    // UPDATE EXISTING ADDITIONAL AFFILIATION
    $errAdd = $errContact = $errLandline = "";
    $error = array();
    if(isset($_POST['update_affiliation'])) {
        /**
         * update_add_affiliation
         * update_contact_number
         * update_landline
         */
        $flag = true;
        $STRING_VALIDATE = "/^[a-zA-Z\s\.]*$/";
        $MOBILE_VALIDATE = "/^((09)[0-9]{9})*$/";
        $add_affiliation = test_input($_POST['update_add_affiliation']);
        $contact_number = test_input($_POST['update_contact_number']);
        $landline_number = test_input($_POST['update_landline']);

        if(empty($add_affiliation)) {
            $errAdd = "This field is required";
            $flag = false;
            $error[] = $errAdd;
        } else {
            if(!preg_match($STRING_VALIDATE, $add_affiliation)) {
                $flag = false;
                $errAdd = "Please avoid using special characters";
                $error[] = $errAdd;
            }
        }

        if(empty($contact_number)) {
            $errContact = "This field is required";
            $flag = false;
            $error[] = $errContact;
        } else {
            if(!preg_match($MOBILE_VALIDATE, $contact_number)) {
                $flag = false;
                $errContact = "Invalid contact number";
                $error[] = $errContact;
            }
        }

        if(empty($landline_number)) {
            $errLandline = "This field is required";
            $flag = false;
            $error[] = $errLandline;
        }

        if($flag) {
            if(count($error) > 0) {
                $_SESSION['client_message'] = "<div class='alert alert-danger'>Failed to update.</div>";
                return;
            } else {
                $sql = "UPDATE tbl_extrainformation SET hospital_aff = ?, contact = ?, landline = ? where id = ?";
                if($updateInfo = $conn->prepare($sql)) {
                    $updateInfo->bind_param("sssi", $add_affiliation, $contact_number, $landline_number, $info_id);
                    $updateInfo->execute(); 
                    header("Location: ./profile.php?id=$USER_ID#other_affiliation");
                } else {
                    $error = $conn->errno.' '.$conn->error;
                    $_SESSION['client_message'] = "<div class='alert alert-danger'>$error</div>";
                    return;
                }
            }
        } else {
            $_SESSION['client_message'] = "<div class='alert alert-danger'>Failed to update.</div>";
            return;
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>