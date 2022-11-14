<?php
    session_start();
    require_once "../connection/connection.php";
    $USER_ID = $_SESSION['user_id'];

    $errFname = $errMidName = $errLname = $errContact = "";
    if(isset($_POST['addEmergencyContact'])) {
        $STRING_CHECKER = "/^[a-zA-Z\s\-\.]*$/";
        $INT_CHECKER = "/^((09)[0-9]{9})*$/";
        $error = array();
        $flag = false;
        $status = 0;

        $firstName = $conn->real_escape_string($_POST['first_name']);
        $middleName = $conn->real_escape_string($_POST['middle_name']);
        $lastName = $conn->real_escape_string($_POST['last_name']);
        $mobile = $conn->real_escape_string($_POST['mobile']);

        if(empty($firstName)) {
            $flag = false;
            $errFname = "First name is required";
            $error[] = $errFname;
        } else {
            if(!preg_match($STRING_CHECKER, $firstName)) {
                $flag = false;
                $errFname = "Invalid first name";
                $error[] = $errFname;
            }
        }
        if(empty($middleName)) {
            $flag = false;
            $errMidName = "Middle name is required";
            $error[] = $errMidName;
        } else {
            if(!preg_match($STRING_CHECKER, $middleName)) {
                $flag = false;
                $errFname = "Invalid first name";
                $error[] = $errFname;
            }
        }
        if(empty($lastName)) {
            $flag = false;
            $errLname = "Last name is required";
            $error[] = $errLname;
        } else {
            if(!preg_match($STRING_CHECKER, $lastName)) {
                $flag = false;
                $errLname = "Invalid first name";
                $error[] = $errLname;
            }
        }
        if(empty($mobile)) {
            $flag = false;
            $errContact = "Contact number is required";
            $error[] = $errContact;
        } else {
            if(!preg_match($INT_CHECKER, $mobile)) {
                $flag = false;
                $errContact = "Invalid mobile number";
                $error[] = $errContact;
            }
        }

        if($flag === false && count($error) > 0) {
            $_SESSION['client_message'] = "<div class='alert alert-danger'>Failed to insert data.</div>";
        } else {
            $stmt = $conn->prepare("INSERT INTO tbl_contact_person (dr_id, cp_first_name, cp_middle_name, cp_last_name, cp_mobile_number, status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssi", $USER_ID, $firstName, $middleName, $lastName, $mobile, $status);
            $stmt->execute();
            $stmt->close();
            $_POST = array();
            header("Location: ./profile.php?id=$USER_ID#contact_person");
        }
    }
?>