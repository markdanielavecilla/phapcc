<?php
    require_once "./includes/connection.php";
    $cp_id = $_GET['id'];
    $user_id = $_SESSION['admin_user_id'];

    // GET CONTACT PERSON BASE ON TABLE ID
    $sql = "SELECT * from tbl_contact_person where cp_id = ? limit 1";
    if($getContact = $conn->prepare($sql)) {
        $getContact->bind_param("i", $cp_id);
        $getContact->execute();
        $resultContact = $getContact->get_result();
        $rowContact = $resultContact->fetch_assoc();
        $getContact->close();
    } else {
        $contactError = $conn->errno.' '.$conn->error;
        $_SESSION['message'] = "<div class='alert alert-danger'>$contactError</div>";
    }

    // UPDATE contact person
    $errFname = $errMidName = $errLname = $errMobile = "";
    if(isset($_POST['save'])) {
        $STRING_CHECKER = "/^[a-zA-Z\s\-\.]*$/";
        $INT_CHECKER = "/^((09)[0-9]{9})*$/";
        $error = array();
        $flag = true;

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
                $sql = "UPDATE tbl_contact_person SET cp_first_name = ?, cp_middle_name = ?, cp_last_name = ?, cp_mobile_number = ? WHERE cp_id = ? limit 1";
                if($updateContact = $conn->prepare($sql)) {
                    $updateContact->bind_param("ssssi", $firstName, $middleName, $lastName, $mobile, $cp_id);
                    $updateContact->execute();
                    $updateContact->close();
                    header("Location: ./view-user.php?id=$user_id#contact_person");
                } else {
                    $updateError = $conn->errno.' '.$conn->error;
                    $_SESSION['message'] = "<div class='alert alert-danger'>$updateError</div>";
                }
            }
        }
    }
?>