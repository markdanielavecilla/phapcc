<?php
    include('./connection.php'); 
    session_start();
    $errEditHospital = $errEditContact = $errEditLandline = $errEditEmail = $message = '';
    $flag = false;
    $errors = array();
    
    if(isset($_POST['editMoreInfo'])) {
        $h_id = $_SESSION['id'];
        $drID = $_SESSION['drID'];

        if(empty($_POST['editHospitalAff'])) {
            $errEditHospital = "Hospital is required";
            $flag = false;
            $errors[] = $errEditHospital;
        } else {
            $editHospital = test_input($_POST['editHospitalAff']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z0-9\(\)\-\s\.]*$/", $editHospital)) {
                $errEditHospital = "Invalid hospital name";
                $flag = false;
                $errors[] = $errEditHospital;
            }
        }

        if(empty($_POST['editContactNumber'])) {
            $errEditContact = "Contact Number is required";
            $flag = false;
            $errors[] = $errEditContact;
        } else {
            $contact = test_input($_POST['editContactNumber']);
            $flag = true;
            if(!preg_match("/^[0-9]*$/", $contact)) {
                $errEditContact = "Invalid contact number";
                $flag = false;
                $errors[] = $errEditContact;
            }
        }

        if(empty($_POST['editLandlineNumber'])) {
            $errEditLandline = "Landline number is required";
            $flag = false;
            $errors[] = $errEditLandline;
        } else {
            $landline = test_input($_POST['editLandlineNumber']);
            $flag = true;
            if(!preg_match("/^[0-9\s\(\)\-]*$/", $landline)) {
                $errEditLandline = "Invalid landlin number";
                $flag = false;
                $errors[] = $errEditLandline;
            }
        }

        if(empty($_POST['editEmail'])) {
            $errEditEmail = "Email is required";
            $flag = false;
            $errors[] = $errEditEmail;
        } else {
            $email = test_input($_POST['editEmail']);
            $flag = true;
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errEditEmail = "Invalid email";
                $flag = false;
                $errors[] = $errEditEmail;
            }
        }

        if($flag) {
            if(count($errors) > 0) {
                $message = "<div class='alert alert-danger'>Update failed</div>";
            } else {
                $conn->autocommit(false);
                $stmt = $conn->prepare("UPDATE tbl_extrainformation SET hospital_aff = ?, contact = ?, landline = ?, email = ? WHERE id = ?");
                $stmt->bind_param("ssssi", $editHospital, $contact, $landline, $email, $h_id);
                $stmt->execute();

                if(!$conn->commit()) {
                    $message = "<div class='alert alert-danger'>Failure". $stmt->error ."</div>";
                } else {
                    header("Location: view.php?id=$drID");
                }
            }
        }

    }

    function test_input($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        return $data;
    }

?>