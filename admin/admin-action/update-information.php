<?php
    require_once "./includes/connection.php";
    $user_id = $_GET['id'];

    // MONTHS
    $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    // GET USER INFORMATION BASE ON ID
    $userInfo = $conn->prepare("SELECT * FROM tbl_information WHERE id = ?");
    $userInfo->bind_param("i", $user_id);
    $userInfo->execute();
    $userResult = $userInfo->get_result();
    $userRow = $userResult->fetch_assoc();
    $userInfo->close();


    // UPDATE USER INFORMATION
    $errFname = $errMname = $errLname = $errSuffix = $errGender = $errFmobile = $errSmobile = $errEmail = $errPrc = $errPma = $errMonth = $errDay = $errYear = $errAge = $imgErr = "";
    $errors = array();
    if(isset($_POST['save'])) {
        $fname = $conn->real_escape_string($_POST['first_name']);
        $mname = $conn->real_escape_string($_POST['middle_name']);
        $lname = $conn->real_escape_string($_POST['last_name']);
        $suffix = $conn->real_escape_string($_POST['suffix']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $fmobile = $conn->real_escape_string($_POST['mobile_number']);
        $smobile = $conn->real_escape_string($_POST['s_mobile_number']);
        $email = $conn->real_escape_string($_POST['email']);
        $prc = $conn->real_escape_string($_POST['prc']);
        $pma = $conn->real_escape_string($_POST['pma']);
        $month = $conn->real_escape_string($_POST['month']);
        $day = $conn->real_escape_string($_POST['day']);
        $year = $conn->real_escape_string($_POST['year']);
        $age = $conn->real_escape_string($_POST['age']);

        $STRING_VALIDATE = "/^[a-zA-Z\s\-\.]*$/";
        $INT_VALIDATE = "/^[0-9]*$/";
        $DECEASED = 1;
        $MIN_RANGE = 5;
        $MAX_RANGE = 6;
        $MOBILE_NUMBER_VALIDATE = "/^((09)[0-9]{9})*$/";
        $flag = true;

        if(empty($fname)) {
            $flag = false;
            $errFname = "First name is required";
            $errors[] = $errFname;
        } else {
            if(!preg_match($STRING_VALIDATE, $fname)) {
                $flag = false;
                $errFname = "Invalid First name";
                $errors[] = $errFname;
            }
        }

        if(empty($mname)) {
            $flag = false;
            $errMname = "Middle name is required";
            $errors[] = $errMname;
        } else {
            if(!preg_match($STRING_VALIDATE, $mname)) {
                $flag = false;
                $errMname = "Invalid middle name";
                $errors[] = $errMname;
            }
        }

        if(empty($lname)) {
            $flag = false;
            $errLname = "Last name is required";
            $errors[] = $errLname;
        } else {
            if(!preg_match($STRING_VALIDATE, $lname)) {
                $flag = false;
                $errLname = "Invalid last name";
                $errors[] = $errLname;
            }
        }

        if(!preg_match($STRING_VALIDATE, $suffix)) {
            $flag = false;
            $errSuffix = "Invalid suffix";
            $errors[] = $errSuffix;
        }

        if(empty($fmobile)) {
            $flag = false;
            $errFmobile = "Mobile number is required";
            $errors[] = $errFmobile;
        } else {
            if(!preg_match($MOBILE_NUMBER_VALIDATE, $fmobile)) {
                $flag = false;
                $errFmobile = "Invalid mobile number";
                $errors[] = $errFmobile;
            }
        }

        if(!preg_match($MOBILE_NUMBER_VALIDATE, $smobile)) {
            $flag = false;
            $errSmobile = "Invalid second mobile number";
            $errors[] = $errSmobile;
        }

        if(empty($email)) {
            $flag = false;
            $errEmail = "Email is required";
            $errors[] = $errEmail;
        } else {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $flag = false;
                $errEmail = "Invalid email";
                $errors[] = $errEmail;
            }
        }

        if(empty($prc)) {
            $flag = false;
            $errPrc = "Prc is required";
            $errors[] = $errPrc;
        } else {
            if(strlen($prc) > $MAX_RANGE || strlen($prc) < $MIN_RANGE) {
                $flag = false;
                $errPrc = "Prc number range is invalid. It should be in 5 to 6 digits";
                $errors[] = $errPrc;
            }
        }

        if(!preg_match("/^[a-zA-Z0-9\-]*$/", $pma)) {
            $flag = false;
            $errPma = "Invalid PMA number";
            $errors[] = $errPma;
        }

        $tmpName = "";
        $filePath = "";
        $newFileName = "";
        if(!empty($_FILES['user_image']['name'])) {
            $fileName = $_FILES['user_image']['name'];
            $tmpName = $_FILES['user_image']['tmp_name'];
            $size = $_FILES['user_image']['size'];
            $error = $_FILES['user_image']['error'];
            $type = $_FILES['user_image']['type'];

            // Turn filename and extension into array
            $fileExtension = explode('.', $fileName);

            // Turn file extension into lowercase
            $file_extension = strtolower(end($fileExtension));

            // Extensions allowed to upload
            $allowedExtension = array("jpg", "png", "jpeg", "gif");

            // Check if file extension is allowed for uploading
            if(in_array($file_extension, $allowedExtension)) {
                if($error === 0) {
                    if($size < 1500000) {
                        $newFileName = uniqid('', true).'.'.$file_extension;
                        $filePath = "../images/uploads/$newFileName";
                    } else {
                        $flag = false;
                        $imgErr = "File too large";
                        $errors[] = $imgErr;
                    }
                } else {
                    $flag = false;
                    $imgErr = "There is an error uploading the image";
                }
            } else {
                $flag = false;
                $imgErr = "The file you're trying to upload is not an image";
                $errors[] = $imgErr;
            }
        } else {
            $newFileName = $userRow['image_url'];
        }

        if($flag) {
            if(count($errors) > 0) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Failed to update information.</div>";
                return;
            } else {
                $conn->autocommit(false);

                $stmt = $conn->prepare("UPDATE tbl_information SET first_name = ?, middle_name = ?, last_name = ?, suffix = ?, gender = ?, mobile_number = ?, second_mobile_number = ?, email = ?, prcno = ?, pmano = ?, birth_month = ?, birth_day = ?, birth_year = ?, age = ?, image_url = ? WHERE id = ?");
                $stmt->bind_param("ssssssssisiiiisi", $fname, $mname, $lname, $suffix, $gender, $fmobile, $smobile, $email, $prc, $pma, $month, $day, $year, $age, $newFileName, $user_id);
                $stmt->execute();

                if(!$conn->commit()) {
                    $_SESSION['message'] = "<div class='alert alert-danger'>Cannot update the information.</div>";
                    return;
                } else {
                    if(move_uploaded_file($tmpName, $filePath)) {
                        $currImg = $userRow['image_url'];
                        $path = "../images/uploads/$currImg";
                        if(is_file($path)) unlink($path);
                    }
                    header("Location: ./view-user.php?id=$user_id#user_information");
                }
            }
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failedxxx to update information</div>";
            return;
        }
    }
    $conn->close();
?>