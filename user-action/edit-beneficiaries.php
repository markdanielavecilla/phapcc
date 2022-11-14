<?php
    session_start();
    require_once  "../connection/connection.php";
    $BENEFICIARY_ID = $_GET['id'];
    // GET BENEFICIARY RECORD BY BEN_ID
    $stmt = $conn->prepare("SELECT * FROM tbl_beneficiaries WHERE ben_id = ?");
    $stmt->bind_param("i", $BENEFICIARY_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // UPDATE BENEFICIARY
    $errFname = $errMidName = $errLname = $errSuffix = "";
    if(isset($_POST['updateBeneficiaries'])) {
        $flag = true;
        $error = array();
        $STRING_CHECK = "/^[a-zA-Z\s\.\-]*$/";
        $firstName = $conn->real_escape_string($_POST['first_name']);
        $middleName = $conn->real_escape_string($_POST['middle_name']);
        $lastName = $conn->real_escape_string($_POST['last_name']);
        $suffix = $conn->real_escape_string($_POST['suffix']);

        if(!preg_match($STRING_CHECK, $firstName)) {
            $flag = false;
            $errFname = "Invalid first name";
            $error[] = $errFname;
        }
        if(!preg_match($STRING_CHECK, $middleName)) {
            $flag = false;
            $errMidName = "Invalid middle name";
            $error[] = $errMidName;
        }
        if(!preg_match($STRING_CHECK, $lastName)) {
            $flag = false;
            $errLname = "Invalid last name";
            $error[] = $errLname;
        }
        if(!preg_match($STRING_CHECK, $suffix)) {
            $flag = false;
            $errSuffix = "Invalid suffix";
            $error[] = $errSuffix;
        }

        if($flag === false && count($error) > 0) {
            $_SESSION['client_message'] = "<div class='alert alert-danger'>Failed to update beneficiary information</div>";
        } else {
            $stmt = $conn->prepare("UPDATE tbl_beneficiaries SET ben_first_name = ?, ben_middle_name = ?, ben_last_name = ?, ben_suffix = ? WHERE ben_id = ? LIMIT 1");
            $stmt->bind_param("ssssi", $firstName, $middleName, $lastName, $suffix, $BENEFICIARY_ID);
            $stmt->execute();
            $stmt->close();
            header("location: ./profile.php?id=".$_SESSION['user_id']."#beneficiaries");
        }
    }
?>