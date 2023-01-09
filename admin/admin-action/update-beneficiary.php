<?php
    require_once "./includes/connection.php";
    $ben_id = $_GET['id'];
    $user_id = $_SESSION['admin_user_id'];

    // GET BENEFICIARY BY ben_id
    $beneficiary = $conn->prepare("SELECT * from tbl_beneficiaries where ben_id = ?");
    $beneficiary->bind_param("i", $ben_id);
    $beneficiary->execute();
    $resultBen = $beneficiary->get_result();
    $rowBen = $resultBen->fetch_assoc();
    $beneficiary->close();

    // UPDATE BENEFICIARY
    $errFname = $errMidName = $errLname = $errSuffix = "";
    if(isset($_POST['save'])) {
        $flag = true;
        $error = array();
        $STRING_CHECK = "/^[a-zA-Z\s\.\-]*$/";
        $firstName = $conn->real_escape_string($_POST['first_name']);
        $middleName = $conn->real_escape_string($_POST['middle_name']);
        $lastName = $conn->real_escape_string($_POST['last_name']);
        $suffix = $conn->real_escape_string($_POST['suffix']);

        if(empty($firstName)) {
            $flag = false;
            $errFname = "First name is required";
            $error[] = $errFname;
        } else {
            if(!preg_match($STRING_CHECK, $firstName)) {
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
            if(!preg_match($STRING_CHECK, $middleName)) {
                $flag = false;
                $errMidName = "Invalid middle name";
                $error[] = $errMidName;
            }
        }

        if(empty($lastName)) {
            $flag = false;
            $errLname = "Last name is required.";
            $error[] = $errLname;
        } else {
            if(!preg_match($STRING_CHECK, $lastName)) {
                $flag = false;
                $errLname = "Invalid last name";
                $error[] = $errLname;
            }
        }

        if(!preg_match($STRING_CHECK, $suffix)) {
            $flag = false;
            $errSuffix = "Invalid suffix";
            $error[] = $errSuffix;
        }

        if($flag) {
            if(count($error) > 0) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Failed to update beneficiary information</div>";
                return;
            } else {
                $sql = "UPDATE tbl_beneficiaries SET ben_first_name = ?, ben_middle_name = ?, ben_last_name = ?, ben_suffix = ? WHERE ben_id = ? LIMIT 1";
                if($updateBen = $conn->prepare($sql)){
                    $updateBen->bind_param("ssssi", $firstName, $middleName, $lastName, $suffix, $ben_id);
                    $updateBen->execute();
                    $updateBen->close();
                    header("Location: ./view-user.php?id=$user_id#beneficiaries");
                } else {
                    $queryErr = $conn->errno.' '.$conn->error;
                    $_SESSION['message'] = "<div class='alert alert-danger'>$queryErr</div>";
                }
            }
        }
    }
?>