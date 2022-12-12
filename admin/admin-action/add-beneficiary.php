<?php
    require_once "./includes/connection.php";
    $user_id = $_GET['id'];

    // SAVE BENEFICIARY
    $errFname = $errMidName = $errLname = $errSuffix = "";
    $errors = array();
    if(isset($_POST['save'])) {
        $STRING_CHECKER = "/^[a-zA-Z\s\-\.]*$/";
        $flag = true;
        $status = 0;

        $firstName = $conn->real_escape_string($_POST['first_name']);
        $middleName = $conn->real_escape_string($_POST['middle_name']);
        $lastName = $conn->real_escape_string($_POST['last_name']);
        $suffix = $conn->real_escape_string($_POST['suffix']);

        // VALIDATE
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
                $errMidName = "Invalid middle name";
                $error[] = $errMidName;
            }
        }

        if(empty($lastName)) {
            $flag = false;
            $errLname = "Last name is required";
            $error[] = $errLname;
        } else {
            if(!preg_match($STRING_CHECKER, $lastName)) {
                $flag = false;
                $errLname = "Invalid last name";
                $error[] = $errLname;
            }
        }

        if(isset($suffix)) {
            if(!preg_match($STRING_CHECKER, $suffix)) {
                $flag = false;
                $errSuffix = "Invalid suffix";
                $error[] = $errSuffix;
            }
        }

        if($flag) {
            if(count($errors) > 0) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Failed to insert data.</div>";
                return;
            } else {
                $addBeneficiary = $conn->prepare("INSERT INTO tbl_beneficiaries (dr_id, ben_first_name, ben_middle_name, ben_last_name, ben_suffix, status) VALUES (?, ?, ?, ?, ?, ?)");
                $addBeneficiary->bind_param("issssi", $USER_ID, $firstName, $middleName, $lastName, $suffix, $status);
                $addBeneficiary->execute();
                $addBeneficiary->close();
                $_SESSION['message'] = "<div class='alert alert-success'>Data added successfully.</div>";
                $_POST = array();
                header("Location: ./view-user.php?id=$user_id#beneficiaries");
            }
        }
    }
?>