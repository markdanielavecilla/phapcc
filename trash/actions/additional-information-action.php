<?php
    // session_start();
    include_once('connection.php');
    // include 'test-input.php';
    // include 'test-input.php';
    
    $id = $_SESSION['id'];
    $stmt = $conn->prepare("SELECT * FROM tbl_extrainformation WHERE doctors_id = ? ORDER BY id DESC");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows1 = $result->fetch_all(MYSQLI_ASSOC);


    // $errors = array();
    // $message = '';


    // if(isset($_POST['addMoreInfo'])) {
    //     $userId = $_SESSION['addId'];
    //     $STRING_REGEX = "/^[a-zA-Z0-9\s\.\-]*$/";
    //     $CONTACT_NUMBER_REGEX = "/^((09)[0-9]{9})*$/";

    //     if(empty($_POST['addHospitalAff'])) {
    //         $errAddHospital = "Hospital Affiliation is required";
    //         $errors[] = $errAddHospital;
    //     } else {
    //         $addHospital = test_input($_POST['addHospitalAff']);
    //         if(!preg_match($STRING_REGEX, $addHospital)) {
    //             $errAddHospital = "Invalid Hospital affiliation";
    //             $errors[] = $errAddHospital;
    //         }
    //     }

    //     if(empty($_POST['addContactNumber'])) {
    //         $errAddContact = "Contact Number is required";
    //         $errors[] = $errAddContact;
    //     } else {
    //         $addContact = test_input($_POST['addContactNumber']);
    //         if(!preg_match($CONTACT_NUMBER_REGEX, $addContact)) {
    //             $errAddContact = "Invalid contact number";
    //             $errors[] = $errAddContact;
    //         }
    //     }

    //     if(empty($_POST['addLandlineNumber'])) {
    //         $errAddLandline = "Landline number is required";
    //         $errors[] = $errAddLandline;
    //     } else {
    //         $addLandline = test_input($_POST['addLandlineNumber']);
    //         if(!preg_match("/^[0-9\(\)\-]*$/", $addLandline)) {
    //             $errAddLandline = "Invalid landline number";
    //             $errors[] = $errAddLandline;
    //         }
    //     }

    //     if(empty($_POST['addEmail'])) {
    //         $errAddEmail = "Email is required";
    //         $errors[] = $errAddEmail;
    //     } else {
    //         $addEmail = test_input($_POST['addEmail']);
    //         if(!filter_var($addEmail, FILTER_VALIDATE_EMAIL)) {
    //             $errAddEmail = "Invalid email";
    //             $errors[] = $errAddEmail;
    //         }
    //     }
    // }
    // if(count($errors) > 0) {
    //     $message = "<div class='alert alert-danger'>Failed to insert additional information</div>";
    // } else {
    //     $conn->autocommit(false);

    //     $stmt = $conn->prepare("INSERT INTO tbl_extrainformation (doctors_id, hospital_aff, contact, landline, email) VALUES (?, ?, ?, ?, ?)");
    //     $stmt->bind_param("isiss", $userId, $addHospital, $addContact, $addLandline, $addEmail);
    //     $stmt->execute();

    //     if(!$conn->commit()) {
    //         $stmt->error;
    //     } else {
    //         echo "success";
    //         // header("Location: view.php?id=$userId");
    //     }
    // }
?>