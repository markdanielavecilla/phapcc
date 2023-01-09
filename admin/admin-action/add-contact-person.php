<?php
    require_once "./includes/connection.php";
    $user_id = $_GET['id'];

    // Add contact person
    $errFname = $errMidname = $errLname = $errContact = "";
    if(isset($_POST['save'])) {
        $STRING_CHECKER = "/^[a-zA-Z\s\-\.]*$/";
        $INT_CHECKER = "/^((09)[0-9]{9})*$/";
        $error = array();
        $flag = true;
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

        if($flag) {
            if(count($error) > 0) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Failed to insert data.</div>";
                return;
            } else {
                $sql = "INSERT INTO tbl_contact_person (dr_id, cp_first_name, cp_middle_name, cp_last_name, cp_mobile_number, status) VALUES (?, ?, ?, ?, ?, ?)";
                if($addContact = $conn->prepare($sql)) {
                    $addContact->bind_param("issssi", $user_id, $firstName, $middleName, $lastName, $mobile, $status);
                    $addContact->execute();
                    $addContact->close();
                    header("Location: ./view-user.php?id=$user_id#contact_person");
                } else {
                    $contactError = $conn->errno.' '.$conn->error;
                    $_SESSION['message'] = "<div class='alert alert-anger'>$contactError</div>";
                    return;
                }
            }
        } else {
            echo 'Flag false';
        }
    }
?>