<?php

    require_once './connection/connection.php';

    $errors = array();
    $errFirstname = $errMiddlename = $errLastname = $errSuffix = $errAge = $errMobilenumber = $errEmail = $errPassword = $errSecretQuestion = $errSecretAnswer = $errChkBx = "";
    $flag = true;

    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    if(isset($_POST['register'])) {
        $VALIDATE_NAME = "/^[a-zA-Z\s\-\.]*$/";
        $VALIDATE_MOBILENUMBER = "/^((09)[0-9]{9})*$/";
        $STRING_RANGE = 6;
        $EMPTY = "";
        $DECEASED = 0;
        $firstname = test_input($_POST['firstname']);
        $middlename = test_input($_POST['middlename']);
        $lastname = test_input($_POST['lastname']);
        $suffix = test_input($_POST['suffix']);
        $month = test_input($_POST['month']);
        $day = test_input($_POST['day']);
        $year = test_input($_POST['year']);
        $age = test_input($_POST['age']);
        $gender = test_input($_POST['gender']);
        $mobileNumber = test_input($_POST['mobilenumber']);
        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);
        $secretQuestion = test_input($_POST['secretquestion']);
        $secretAnswer = test_input($_POST['secretanswer']);
        $agreement = isset($_POST['agree']);
        $ROLE = "user";

        // echo test_input($_POST['age']);
        // echo $gender;

        if(empty($firstname)) {
            $flag = false;
            $errFirstname = "First name is required.";
            $errors[] = $errFirstname;
        } else {
            if(!preg_match($VALIDATE_NAME, $firstname)) {
                $flag = false;
                $errFirstname = "First name must not contain numbers";
                $errors[] = $errFirstname;
            }
        }

        if(empty($middlename)) {
            $flag = false;
            $errMiddlename = "Middle name is required.";
            $errors[] = $errMiddlename;
        } else {
            if(!preg_match($VALIDATE_NAME, $middlename)) {
                $flag = false;
                $errMiddlename = "Middle name must not contain numbers";
                $errors[] = $errMiddlename;
            }
        }

        if(empty($lastname)) {
            $flag = false;
            $errLastname = "Last name is required.";
            $errors[] = $errLastname;
        } else {
            if(!preg_match($VALIDATE_NAME, $lastname)) {
                $flag = false;
                $errLastname = "Last name must not contain numbers";
                $errors[] = $errLastname;
            }
        }

        if(!preg_match($VALIDATE_NAME, $suffix)) {
            $flag = false;
            $errSuffix = "Invalid suffix";
            $errors[] = $errSuffix;
        }

        if(empty($age)) {
            $errAge = "Age is required.";
            $flag = false;
            $errors[] = $errAge;
        }

        if(empty($mobileNumber)) {
            $flag = false;
            $errMobilenumber = "Mobile number is required.";
            $errors[] = $errMobilenumber;
        } else {
            if(!preg_match($VALIDATE_MOBILENUMBER, $mobileNumber)) {
                $flag = false;
                $errMobilenumber = "Invalid mobile number";
                $errors[] = $errMobilenumber;
            }
        }

        if(empty($email)) {
            $flag = false;
            $errEmail = "Email is required.";
            $errors[] = $errEmail;
        } else {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $flag = false;
                $errEmail = "Invalid Email";
                $errors[] = $errEmail;
            } else {
                $stmt = $conn->prepare("SELECT email FROM tbl_information");
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()) {
                    if($email === $row['email']) {
                        $errEmail = "Email already exist.";
                        $flag = false;
                        $errors[] = $errEmail;
                    }
                }
            }
        }

        if(empty($password)) {
            $flag = false;
            $errPassword = "Last name is required.";
            $errors[] = $errPassword;
        } else {
            if(strlen($password) < $STRING_RANGE) {
                $errPassword = "Minimum password is 6";
                $flag = false;
                $errors[] = $errPassword;
            }
        }

        if(empty($secretQuestion)) {
            $errSecretQuestion = "Secret question is required.";
            $flag = false;
            $errors[] = $errSecretQuestion;
        }

        if(empty($secretAnswer)) {
            $errSecretAnswer = "Secret Answer is required.";
            $flag = false;
            $errors[] = $errSecretAnswer;
        }

        if($agreement == 0) {
            $errChkBx = "This is required";
            $flag = false;
            $errors[] = $errChkBx;
        }

        if($flag) {
            if(count($errors) > 0) {
                echo "<div class='alert alert-danger'>There is an error upon registering</div>";
            } else {
                $conn->autocommit(false);

                /**
                 * tbl_credentials
                 */
                $stmt = $conn->prepare("INSERT INTO tbl_credentials (email, user_password, secret_question, secret_answer, user_role, user_agreement) VALUES (?, ?, ?, ? ,?, ?)");
                $stmt->bind_param("sssssi", $email, $password, $secretQuestion, $secretAnswer, $ROLE, $agreement);
                $stmt->execute();
                $stmt->close();

                $userLastId = $conn->insert_id;

                $currYear = date("Y");
                $UID_LENGTH = 5;
                $ZERO = 0; 
                $generateUid = str_pad($userLastId, $UID_LENGTH, $ZERO, STR_PAD_LEFT);
                $uid = $currYear.$generateUid;

                $stmt = $conn->prepare("INSERT INTO tbl_uid (userid, user_uid) VALUES (?, ?)");
                $stmt->bind_param("ii", $userLastId, $uid);
                $stmt->execute();
                $stmt->close();

                $stmt = $conn->prepare("INSERT INTO tbl_information (cred_id, first_name, middle_name, last_name, suffix, gender, mobile_number, second_mobile_number, email, prcno, pmano, deceased, birth_month, birth_day, birth_year, age, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("issssssssissiiiis", $userLastId, $firstname, $middlename, $lastname, $suffix, $gender, $mobileNumber, $EMPTY, $email, $EMPTY, $EMPTY, $DECEASED, $month, $day, $year, $age, $EMPTY);
                $stmt->execute();
                $stmt->close();

                $stmt = $conn->prepare("INSERT INTO tbl_hospital (doctor_id) VALUES (?)");
                $stmt->bind_param("i", $userLastId);
                $stmt->execute();
                $stmt->close();

                $stmt = $conn->prepare("INSERT INTO tbl_school (docid) VALUES (?)");
                $stmt->bind_param("i", $userLastId);
                $stmt->execute();
                $stmt->close();

                $stmt = $conn->prepare("INSERT INTO tbl_member_year (id) VALUES (?)");
                $stmt->bind_param("i", $userLastId);
                $stmt->execute();
                $stmt->close();

                // $stmt = $conn->prepare("INSERT INTO tbl_contact_person (dr_id) VALUES (?)");
                // $stmt->bind_param("i", $userLastId);
                // $stmt->execute();
                // $stmt->close();

                // $stmt = $conn->prepare("INSERT INTO tbl_beneficiaries (dr_id) VALUES (?)");
                // $stmt->bind_param("i", $userLastId);
                // $stmt->execute();
                // $stmt->close();

                // others
                $stmt = $conn->prepare("INSERT INTO tbl_other_subspecialty (u_id) VALUES (?)");
                $stmt->bind_param("i", $userLastId);
                $stmt->execute();
                $stmt->close();

                $stmt = $conn->prepare("INSERT INTO tbl_other_special_training (u_id) VALUES (?)");
                $stmt->bind_param("i", $userLastId);
                $stmt->execute();
                $stmt->close();

                $stmt = $conn->prepare("INSERT INTO tbl_other_practice (u_id) VALUES (?)");
                $stmt->bind_param("i", $userLastId);
                $stmt->execute();
                $stmt->close();

                $stmt = $conn->prepare("INSERT INTO tbl_other_drcategory (u_id) VALUES (?)");
                $stmt->bind_param("i", $userLastId);
                $stmt->execute();
                $stmt->close();

                $stmt = $conn->prepare("INSERT INTO tbl_other_council (u_id) VALUES (?)");
                $stmt->bind_param("i", $userLastId);
                $stmt->execute();
                $stmt->close();

                $stmt = $conn->prepare("INSERT INTO tbl_other_committee (u_id) VALUES (?)");
                $stmt->bind_param("i", $userLastId);
                $stmt->execute();
                $stmt->close();

                $stmt = $conn->prepare("INSERT INTO tbl_other_chapter (u_id) VALUES (?)");
                $stmt->bind_param("i", $userLastId);
                $stmt->execute();
                $stmt->close();

                if(!$conn->commit()) {
                    echo "<div class='alert alert-danger'>Failed to register user.</div>";
                    $conn->rollback();
                    exit();
                } else {
                    echo "<div class='alert alert-success'>Registration successful</div>";
                    $_POST = array();
                }

            }
        } else {
            echo "<div class='alert alert-danger'>Failed to register</div>";
        }

    }

    function test_input($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
    }
    $conn->close();
?>