<?php
    require_once "../connection/connection.php";

    // GETTING ACTIVE LISTS
    $status = 0;

    // GET USER INFORMATION
    $USER_ID = $_SESSION['user_id'];
    $sql = "SELECT * FROM tbl_information WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $USER_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $infoRow = $result->fetch_assoc();
    $stmt->close();

    // YEAR AS
    $yStmt = $conn->prepare("SELECT * FROM tbl_member_year WHERE id = ?");
    $yStmt->bind_param("i", $USER_ID);
    $yStmt->execute();
    $yResult = $yStmt->get_result();
    $yearRow = $yResult->fetch_assoc();
    $yStmt->close();

    // GET MEDICAL SCHOOL AND TRAINING INSTITUTION
    $schoolStmt = $conn->prepare("SELECT * FROM tbl_school WHERE docid = ?");
    $schoolStmt->bind_param("i", $USER_ID);
    $schoolStmt->execute();
    $schoolResult = $schoolStmt->get_result();
    $schoolRow = $schoolResult->fetch_assoc();
    $schoolStmt->close();

    // GET AFFILIATION
    $affStmt = $conn->prepare("SELECT * FROM tbl_hospital WHERE doctor_id = ?");
    $affStmt->bind_param("i", $USER_ID);
    $affStmt->execute();
    $affResult = $affStmt->get_result();
    $affRow = $affResult->fetch_assoc();
    $affStmt->close();

    //GET THE UNIQUE ID OF USER
    $sql = "SELECT * FROM tbl_uid WHERE userid = ?";
    $stmt = $conn->prepare($sql) or die($conn->error);
    $stmt->bind_param("i", $USER_ID);
    $stmt->execute();
    $uid_result = $stmt->get_result();
    $uid_row = $uid_result->fetch_assoc();
    $stmt->close();

    // GET BENEFICIARIES
    $beneficiaryStatus = 0;
    $beneficiaries = $conn->prepare("SELECT * FROM tbl_beneficiaries WHERE dr_id = ? AND status = ?");
    $beneficiaries->bind_param("ii", $USER_ID, $beneficiaryStatus);
    $beneficiaries->execute();
    $beneficiariesResult = $beneficiaries->get_result();
    $beneficiaries->close();

    // GET CONTACT PERSON IN CASE OF EMERGENCY
    $contactPersonStatus = 0;
    $contactPerson = $conn->prepare("SELECT * FROM tbl_contact_person WHERE dr_id = ? AND status = ?");
    $contactPerson->bind_param("ii", $USER_ID, $contactPersonStatus);
    $contactPerson->execute();
    $contactPersonResult = $contactPerson->get_result();
    $contactPerson->close();

    // GET SUBSPECIALTY LISTS
    $subListStmt = $conn->prepare("SELECT tbl_information.id, GROUP_CONCAT(DISTINCT tbl_subspecialty.subspecialty SEPARATOR ', ') as sub_list FROM tbl_information INNER JOIN tbl_hospital_subspecialty ON tbl_information.id = tbl_hospital_subspecialty.information_id INNER JOIN tbl_subspecialty ON tbl_hospital_subspecialty.subspecialty_id = tbl_subspecialty.sub_id WHERE tbl_information.id = ? AND status = ?");
    $subListStmt->bind_param("ii", $USER_ID, $status);
    $subListStmt->execute();
    $subListResult = $subListStmt->get_result();
    $subListStmt->close();

    // GET SPECIAL TRAINING LISTS
    $specStmt = $conn->prepare("SELECT tbl_information.id, GROUP_CONCAT(DISTINCT tbl_special_training.special_training SEPARATOR ', ') as special_training FROM tbl_information INNER JOIN tbl_hospital_special_training ON tbl_information.id = tbl_hospital_special_training.information_id INNER JOIN tbl_special_training ON tbl_hospital_special_training.special_training_id = tbl_special_training.st_id where tbl_information.id = ? AND status = ?");
    $specStmt->bind_param("ii", $USER_ID, $status);
    $specStmt->execute();
    $specResult = $specStmt->get_result();
    $specStmt->close();

    // GET PRACTICE LISTS
    $pracStmt = $conn->prepare("SELECT tbl_information.id, GROUP_CONCAT(DISTINCT tbl_practice.practice SEPARATOR ', ') as practice_list FROM tbl_information INNER JOIN tbl_hospital_practice ON tbl_information.id = tbl_hospital_practice.information_id INNER JOIN tbl_practice ON tbl_hospital_practice.practice_id = tbl_practice.practice_id WHERE tbl_information.id = ? AND status = ?");
    $pracStmt->bind_param("ii", $USER_ID, $status);
    $pracStmt->execute();
    $pracResult = $pracStmt->get_result();
    $pracStmt->close();

    // GET CATEGORY LIST
    $catStmt = $conn->prepare("SELECT tbl_information.id, GROUP_CONCAT(DISTINCT tbl_drcategory.category SEPARATOR ', ') as category_list FROM tbl_information INNER JOIN tbl_hospital_drcategory ON tbl_information.id = tbl_hospital_drcategory.information_id INNER JOIN tbl_drcategory ON tbl_hospital_drcategory.category_id = tbl_drcategory.catid WHERE tbl_information.id = ? AND status = ?");
    $catStmt->bind_param("ii", $USER_ID, $status);
    $catStmt->execute();
    $catResult = $catStmt->get_result();
    $catStmt->close();

    // GET COUNCIL LIST
    $councilStmt = $conn->prepare("SELECT tbl_information.id, GROUP_CONCAT(DISTINCT tbl_council.council SEPARATOR ', ') as council_list FROM tbl_information INNER JOIN tbl_hospital_council ON tbl_information.id = tbl_hospital_council.information_id INNER JOIN tbl_council ON tbl_hospital_council.council_id = tbl_council.council_id WHERE tbl_information.id = ? AND status = ?");
    $councilStmt->bind_param("ii", $USER_ID, $status);
    $councilStmt->execute();
    $councilResult = $councilStmt->get_result();
    $councilStmt->close();

    // GET COMMITTEE LIST
    $commStmt = $conn->prepare("SELECT tbl_information.id, GROUP_CONCAT(DISTINCT tbl_committee.committee SEPARATOR ', ') as committee_list FROM tbl_information INNER JOIN tbl_hospital_committee ON tbl_information.id = tbl_hospital_committee.information_id INNER JOIN tbl_committee ON tbl_hospital_committee.cmt_id = tbl_committee.cmt_id WHERE tbl_information.id = ? AND status = ?");
    $commStmt->bind_param("ii", $USER_ID, $status);
    $commStmt->execute();
    $commResult = $commStmt->get_result();
    $commStmt->close();

    // GET CHAPTER LIST
    $chapterStmt = $conn->prepare("SELECT tbl_information.id, GROUP_CONCAT(DISTINCT tbl_chapter.chapter SEPARATOR ', ') as chapter_list FROM tbl_information INNER JOIN tbl_hospital_chapter ON tbl_information.id = tbl_hospital_chapter.information_id INNER JOIN tbl_chapter ON tbl_hospital_chapter.chapter_id = tbl_chapter.chapid WHERE tbl_information.id = ? AND status = ?");
    $chapterStmt->bind_param("ii", $USER_ID, $status);
    $chapterStmt->execute();
    $chapterResult = $chapterStmt->get_result();
    $chapterStmt->close();

    /**
     * OTHERS (ADDITIONAL INFO)
     * 
    */

    // OTHER SUBSPECIALTY
    $otherSubStmt = $conn->prepare("SELECT other_subspecialty FROM tbl_other_subspecialty WHERE u_id = ?");
    $otherSubStmt->bind_param("i", $USER_ID);
    $otherSubStmt->execute();
    $otherSubResult = $otherSubStmt->get_result();
    $otherSubRow = $otherSubResult->fetch_assoc();
    $otherSubStmt->close();

    // OTHER SPECIAL TRAINING
    $other_stStmt = $conn->prepare("SELECT other_special_training FROM tbl_other_special_training WHERE u_id = ?");
    $other_stStmt->bind_param("i", $USER_ID);
    $other_stStmt->execute();
    $other_stResult = $other_stStmt->get_result();
    $other_stRow = $other_stResult->fetch_assoc();
    $other_stStmt->close();

    // OTHER PRACTICE
    $otherPracStmt = $conn->prepare("SELECT other_practice FROM tbl_other_practice WHERE u_id = ?");
    $otherPracStmt->bind_param("i", $USER_ID);
    $otherPracStmt->execute();
    $otherPracResult = $otherPracStmt->get_result();
    $otherPracRow = $otherPracResult->fetch_assoc();
    $otherPracStmt->close();

    // OTHER CATEGORY
    $otherCatStmt = $conn->prepare("SELECT category FROM tbl_other_drcategory WHERE u_id = ?");
    $otherCatStmt->bind_param("i", $USER_ID);
    $otherCatStmt->execute();
    $otherCatResult = $otherCatStmt->get_result();
    $otherCatRow = $otherCatResult->fetch_assoc();
    $otherCatStmt->close();

    // OTHER COUNCIL
    $otherCouncilStmt = $conn->prepare("SELECT other_council FROM tbl_other_council WHERE u_id = ?");
    $otherCouncilStmt->bind_param("i", $USER_ID);
    $otherCouncilStmt->execute();
    $otherCouncilResult = $otherCouncilStmt->get_result();
    $otherCouncilRow = $otherCouncilResult->fetch_assoc();
    $otherCouncilStmt->close();

    // OTHER COMMITTEE
    $otherCommStmt = $conn->prepare("SELECT other_committee FROM tbl_other_committee WHERE u_id = ?");
    $otherCommStmt->bind_param("i", $USER_ID);
    $otherCommStmt->execute();
    $otherCommResult = $otherCommStmt->get_result();
    $otherCommRow = $otherCommResult->fetch_assoc();
    $otherCommStmt->close();

    // OTHER CHAPTER
    $otherChapStmt = $conn->prepare("SELECT other_chapter FROM tbl_other_chapter WHERE u_id = ?");
    $otherChapStmt->bind_param("i", $USER_ID);
    $otherChapStmt->execute();
    $otherChapResult = $otherChapStmt->get_result();
    $otherChapRow = $otherChapResult->fetch_assoc();
    $otherChapStmt->close();

    //GET EXTRA INFORMATION
    $activeStatus = 0;
    $extraStmt = $conn->prepare("SELECT id, hospital_aff, contact, landline FROM tbl_extrainformation WHERE doctors_id = ? AND status = ? ORDER BY id desc");
    $extraStmt->bind_param("ii", $USER_ID, $activeStatus);
    $extraStmt->execute();
    $extraResult = $extraStmt->get_result();
    $extraStmt->close();

    /**
     * FOR INFORMATION UPDATE
     */
    
    // Months
    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    // ERROR VARIABLES
    $errFirstname = $errMiddlename = $errLastname = $errSuffix = $errGender = $errMobilenum = $errSmobilenum = $errEmail = $errPrc = $errPma = $errMonth = $errDay = $errYear = $errAge = $imageError = "";
    
    //ERROR COLLECTION 
    $errors = array();


    // UPDATE USER INFORMATION
    if(isset($_POST['save'])) {
        $STRING_VALIDATE = "/^[a-zA-Z\s\-\.]*$/";
        $INT_VALIDATE = "/^[0-9]*$/";
        $DECEASED = 1;
        $MIN_RANGE = 5;
        $MAX_RANGE = 6;
        $MOBILE_NUMBER_VALIDATE = "/^((09)[0-9]{9})*$/";
        $flag = true;

        $firstName = test_input($_POST['first_name']);
        $middleName = test_input($_POST['middle_name']);
        $lastName = test_input($_POST['last_name']);
        $suffix = test_input($_POST['suffix']);
        $gender = test_input($_POST['gender']);
        $mobileNum = test_input($_POST['mobile_number']);
        $s_mobileNum = test_input($_POST['s_mobile_number']);
        $email = test_input($_POST['email']);
        $prc = test_input($_POST['prc']);
        $pma = test_input($_POST['pma']);
        $month = test_input($_POST['month']);
        $day = test_input($_POST['day']);
        $year = test_input($_POST['year']);
        $age = test_input($_POST['age']);

        if(empty($firstName)) {
            $flag = false;
            $errFirstname = "First name is required";
            $errors[] = $errFirstname;
        } else {
            if(!preg_match($STRING_VALIDATE, $firstName)) {
                $flag = false;
                $errFirstname = "Invalid first name";
                $errors[] = $errFirstname;
            }
        }

        if(empty($middleName)) {
            $flag = false;
            $errMiddlename = "Middle name is required";
            $errors[] = $errMiddlename;
        } else {
            if(!preg_match($STRING_VALIDATE, $middleName)) {
                $flag = false;
                $errMiddlename = "Invalid middle name";
                $errors[] = $errMiddlename;
            }
        }

        if(empty($lastName)) {
            $flag = false;
            $errLastname = "Last name is required";
            $errors[] = $errLastname;
        } else {
            if(!preg_match($STRING_VALIDATE, $lastName)) {
                $flag = false;
                $errLastname = "Invalid last name";
                $errors[] = $errLastname;
            }
        }

        if(!preg_match($STRING_VALIDATE, $suffix)) {
            $flag = false;
            $errSuffix = "Invalid suffix";
            $errors[] = $errSuffix;
        }

        if(empty($mobileNum)) {
            $flag = false;
            $errMobilenum = "Mobile number is required";
            $errors[] = $errMobilenum;
        } else {
            if(!preg_match($MOBILE_NUMBER_VALIDATE, $mobileNum)) {
                $flag = false;
                $errMobilenum = "Invalid mobile number";
                $errors[] = $errMobilenum;
            }
        }

        if(!preg_match($MOBILE_NUMBER_VALIDATE, $s_mobileNum)) {
            $flag = false;
            $errSmobilenum = "Invalid Second mobile number";
            $errors[] = $errSmobilenum;
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
            $errPrc = "Prc number is required.";
            $errors[] = $errPrc;
        } else {
            if(!preg_match($INT_VALIDATE, $prc)) {
                $flag = false;
                $errPrc = "Invalid PRC number";
                $errors[] = $errPrc;
            }
            if(strlen($prc) > $MAX_RANGE || strlen($prc) < $MIN_RANGE) {
                $flag = false;
                $errPrc = "PRC number range is invalid. It should be in 5 to 6 digits.";
                $errors[] = $errPrc;
            }
        }

        if(!preg_match("/^[a-zA-Z0-9\-]*$/", $pma)) {
            $flag = false;
            $errPma = "Invalid PMA number";
            $errors[] = $errPma;
            
        }

        // print_r($_FILES['user_image']);
        $tmpName = "";
        $filePath = "";
        $newFileName = "";
        if(!empty($_FILES['user_image']['name'])) {
            $fileName = $_FILES['user_image']['name'];
            $tmpName = $_FILES['user_image']['tmp_name'];
            $size = $_FILES['user_image']['size'];
            $error = $_FILES['user_image']['error'];
            $type = $_FILES['user_image']['type'];
            
            // Separate the filename and its extension through array
            $fileExtension = explode('.', $fileName);
            
            // Getting the file extension and turning it to lower case
            $file_extension = strtolower(end($fileExtension));
            
            //array of allowed extension of file upload
            $allowedExtension = array("jpg", "png", "jpeg", "gif");

            // compare the file extension of uploading file and allowed extension
            if(in_array($file_extension, $allowedExtension)) {
                if($error === 0) {
                    if($size < 1500000) {
                        $newFileName = uniqid('', true).'.'.$file_extension;
                        $filePath = "../images/uploads/$newFileName";
                    } else {
                        $flag = false;
                        $imageError = "File too large";
                        $errors[] = $imageError;
                    }
                } else {
                    $flag = false;
                    $imageError = "There is an error uploading the image";
                    $errors[] = $imageError;
                }
            } else {
                $flag = false;
                $imageError = "The file you're trying to upload is not an image";
                $errors[] = $imageError;
            }
        } else {
            $newFileName = $infoRow['image_url'];
        }

        if($flag) {
            if(count($errors) > 0) {
                $_SESSION['client_message'] = "<div class='alert alert-danger'>Failed to update information</div>";
                return;
            } else {
                $conn->autocommit(false);

                $stmt = $conn->prepare("UPDATE tbl_information SET first_name = ?, middle_name = ?, last_name = ?, suffix = ?, gender = ?, mobile_number = ?, second_mobile_number = ?, email = ?, prcno = ?, pmano = ?, birth_month = ?, birth_day = ?, birth_year = ?, age = ?, image_url = ? WHERE id = ?");
                $stmt->bind_param("ssssssssisiiiisi", $firstName, $middleName, $lastName, $suffix, $gender, $mobileNum, $s_mobileNum, $email, $prc, $pma, $month, $day, $year, $age, $newFileName, $USER_ID);
                $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);

                if(!$conn->commit()) {
                    trigger_error($conn->error, E_USER_ERROR);
                } else {
                    if(move_uploaded_file($tmpName, $filePath)){
                        $currentImage = $infoRow['image_url'];
                        $path = "../images/uploads/$currentImage";
                        if(is_file($path)) unlink($path);
                    }
                    header("Location: profile.php?id=$USER_ID#user_information");
                }
            }
        } else {
            $_SESSION['client_message'] = "<div class='alert alert-danger'>Failed to update information</div>";
            return;
        }

    }

    function test_input($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $conn->close();
?>