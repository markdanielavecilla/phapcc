<?php
    ob_start();
    require_once "./includes/connection.php";
    $user_id = $_GET['id'];
    $active_status = 0;

    // GET AFFILIATION
    $sql = "SELECT * FROM tbl_hospital where doctor_id = ?";
    if($hospital = $conn->prepare($sql)) {
        $hospital->bind_param("i", $user_id);
        $hospital->execute();
        $resultHospital = $hospital->get_result();
        $fetchHospital = $resultHospital->fetch_assoc();
        $hospital->close();
    } else {
        $errorHospital = $conn->errno.' '.$conn->error;
        echo $errorHospital;
    }

    // SAVE AFFILIATION
    $flag = true;
    $errors = array();
    $errHospital = $errContactNumber = $errLandlineNumber = $errCityProvince = $errHomeAddress = $errPrincipalOffice = $errInternationalAffiliation = $errOtherSub = $errOtherSpec = $errOtherPrac = $errOtherCat = $errOtherCouncil = $errOtherComm = $errOtherChapter = "";
    if(isset($_POST['save'])) {
        $VALIDATE_NAME = "/^[a-zA-Z\s\-\.]*$/";
        $VALIDATE_CONTACT_NUMBER = "/^((09)[0-9]{9})*$/";
        $VALIDATE_LANDLINE = "/^[a-zA-Z0-9\s\-\(\)]*$/";
        $VALIDATE_OTHER_FIELD = "/^[a-zA-Z\s\,]*$/";
        $status = 0;

        // INPUT FIELD
        $hospitalAffiliation = test_input($_POST['hospital_affiliation']);
        $contactNumber = test_input($_POST['contact_number']);
        $landlineNumber = test_input($_POST['landline_number']);
        $cityProvince = test_input($_POST['city_province']);
        $homeAddress = test_input($_POST['home_address']);
        $principalOffice = test_input($_POST['principal_office']);
        $internationalAffiliation = test_input($_POST['international_affiliation']);

        // OTHERS
        $otherSubspecialty = test_input($_POST['other_subspecialty']);
        $otherSpecialtraining = test_input($_POST['other_specialTraining']);
        $otherPractice = test_input($_POST['other_practice']);
        $otherCategory = test_input($_POST['other_category']);
        $otherCouncil = test_input($_POST['other_council']);
        $otherCommittee = test_input($_POST['other_committee']);
        $otherChapter = test_input($_POST['other_chapter']);

        if(empty($hospitalAffiliation)) {
            $flag = false;
            $errHospital = "Hospital affiliation is required";
            $errors[] = $errHospital;
        } else {
            if(!preg_match($VALIDATE_NAME, $hospitalAffiliation)) {
                $flag = false;
                $errHospital = "Invalid Hospital affiliation name";
                $errors[] = $errHospital;
            }
        }

        if(empty($contactNumber)) {
            $flag = false;
            $errContactNumber = "Contact number is required";
            $errors[] = $errContactNumber;
        } else {
            if(!preg_match($VALIDATE_CONTACT_NUMBER, $contactNumber)) {
                $flag = false;
                $errContactNumber = "Invalid Contact number";
                $errors[] = $errContactNumber;
            }
        }

        if(empty($landlineNumber)) {
            $flag = false;
            $errLandlineNumber = "Landline number is required";
            $errors[] = $errLandlineNumber;
        } else {
            if(!preg_match($VALIDATE_LANDLINE, $landlineNumber)) {
                $flag = false;
                $errLandlineNumber = "Invalid landline number";
                $errors[] = $errLandlineNumber;
            }
        }

        if(empty($cityProvince)) {
            $flag = false;
            $errCityProvince = "City / Province is required";
            $errors[] = $errCityProvince;
        } else {
            if(!preg_match($VALIDATE_NAME, $cityProvince)) {
                $flag = false;
                $errCityProvince = "Invalid City / Province";
                $errors[] = $errCityProvince; 
            }
        }

        if(empty($homeAddress)) {
            $flag = false;
            $errHomeAddress = "Home address is required";
            $errors[] = $errHomeAddress;
        } else {
            if(!preg_match($VALIDATE_NAME, $homeAddress)) {
                $flag = false;
                $errHomeAddress = "Invalid home address";
                $errors[] = $errHomeAddress;
            }
        }

        if(empty($principalOffice)) {
            $flag = false;
            $errPrincipalOffice = "Principal office is required";
            $errors[] = $errPrincipalOffice;
        } else {
            if(!preg_match($VALIDATE_NAME, $principalOffice)) {
                $flag = false;
                $errPrincipalOffice = "Invalid Principal office";
                $errors[] = $errPrincipalOffice;
            }
        }

        if(empty($internationalAffiliation)) {
            $flag = false;
            $errInternationalAffiliation = "International Affiliation is required";
            $errors[] = $errInternationalAffiliation;
        } else {
            if(!preg_match($VALIDATE_NAME, $internationalAffiliation)) {
                $flag = false;
                $errInternationalAffiliation = "Invalid international affiliation";
                $errors[] = $errInternationalAffiliation;
            }
        }

        if(isset($otherSubspecialty)) {
            if(!preg_match($VALIDATE_OTHER_FIELD, $otherSubspecialty)) {
                $flag = false;
                $errOtherSub = "Invalid other subspecialty";
                $errors[] = $errOtherSub;
            } 
            
        }

        
        if(isset($otherSpecialtraining)) {
            if(!preg_match($VALIDATE_OTHER_FIELD, $otherSpecialtraining)) {
                $flag = false;
                $errOtherSpec = "Invalid other special training";
                $errors[] = $errOtherSpec;
            }
        }

        if(isset($otherPractice)) {
            if(!preg_match($VALIDATE_OTHER_FIELD, $otherPractice)) {
                $flag = false;
                $errOtherPrac = "Invalid other practice";
                $errors[] = $errOtherPrac;
            } else {
                $other_practice = explode(",", $otherPractice);
            }
        }

        if(isset($otherCategory)) {
            if(!preg_match($VALIDATE_OTHER_FIELD, $otherCategory)) {
                $flag = false;
                $errOtherCat = "Invalid other category";
                $errors[] = $errOtherCat;
            }
        }

        if(isset($otherCouncil)) {
            if(!preg_match($VALIDATE_OTHER_FIELD, $otherCouncil)) {
                $flag = false;
                $errOtherCouncil = "Invalid other council";
                $errors[] = $errOtherCouncil;
            } else {
                $other_council = explode(",", $otherCouncil);
            }
        }

        if(isset($otherCommittee)) {
            if(!preg_match($VALIDATE_OTHER_FIELD, $otherCommittee)) {
                $flag = false;
                $errOtherComm = "Invalid other committee";
                $errors[] = $errOtherComm;
            }
        }

        if(isset($otherChapter)) {
            if(!preg_match($VALIDATE_OTHER_FIELD, $otherChapter)) {
                $flag = false;
                $errOtherChapter = "Invalid other chapter";
                $errors[] = $errOtherChapter;
            }
        }

        if($flag == false && count($errors) > 0 ) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to update Affiliation information.</div>";
            print_r($errors);
        } else {
            $conn->autocommit(FALSE);

            // AFFILIATION ACTION

            $stmt = $conn->prepare("UPDATE tbl_hospital SET hospital_affiliation = ?, cityprovince = ?, contactno = ?, landlineno = ?, home_address = ?, principal_office = ?, international_affiliation = ? WHERE doctor_id = ?");
            $stmt->bind_param("sssssssi", $hospitalAffiliation, $cityProvince, $contactNumber, $landlineNumber, $homeAddress, $principalOffice, $internationalAffiliation, $user_id);
            $stmt->execute();

            // END AFFILIATION ACTION

            // FOR SUBSPECIALTY, SPECIAL TRAINING, PRACTICE, CATEGORY, COUNCIL, COMMITTEE, CHAPTER DROPDOWN
            /**
             * SUBSPECIALTY START
             * - GET SUBSPECIALTY
             * - INSERT NEW SUBSPECIALTY
             * - DELETE SUBSPECIALTY
             */

            // GET THE LIST OF SUBSPECIALTY
            // if(!empty($_POST['subspecialty'])) {
                $subStmt = $conn->prepare("SELECT * FROM tbl_hospital_subspecialty WHERE information_id = ?");
                $subStmt->bind_param("i", $user_id);
                $subStmt->execute();
                $subResult = $subStmt->get_result();
                $subSpecialtyList = array();
                while($subRow = $subResult->fetch_assoc()) :
                    $subSpecialtyList[] = $subRow['subspecialty_id'];
                endwhile;
    
                // INSERT NEWLY ADDED SUBSPECIALTY IF THERE IS ANY
                foreach($_POST['subspecialty'] as $subspecialty) {
                    if(!in_array($subspecialty, $subSpecialtyList)) {
                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_subspecialty (information_id, subspecialty_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $user_id, $subspecialty);
                        $stmt->execute();
                    }
                }
    
                // DELETE EXISTING SUBSPECIALTY IN THE LIST
                foreach($subSpecialtyList as $listSub) {
                    if(!in_array($listSub, $_POST['subspecialty'])) {
                        $stmt = $conn->prepare("DELETE FROM tbl_hospital_subspecialty WHERE information_id = ? AND subspecialty_id = ?");
                        $stmt->bind_param("ii", $user_id, $listSub);
                        $stmt->execute();
                    }
                }
            // }
            // END OF SUBSPECIALTY UPDATE

            /**
             * SPECIAL TRAINING START
             * - GET SPECIAL TRAINING LIST
             * - INSERT NEW SPECIAL TRAINING
             * - DELETE SPECIAL TRAINING
             */
            
            // GET SPECIAL TRAINING LIST
            if(!empty($_POST['special_training'])) {
                $specialStmt = $conn->prepare("SELECT * FROM tbl_hospital_special_training WHERE information_id = ?");
                $specialStmt->bind_param("i", $user_id);
                $specialStmt->execute();
                $specialResult = $specialStmt->get_result();
                $specialTrainingList = array();
                while($specialRow = $specialResult->fetch_assoc()) :
                    $specialTrainingList[] = $specialRow['special_training_id'];
                endwhile;
                
                // INSERT NEWLY ADDED SPECIAL TRAINING IF THERE IS ANY
                foreach($_POST['special_training'] as $specialTraining) {
                    if(!in_array($specialTraining, $specialTrainingList)) {
                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_special_training (information_id, special_training_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $user_id, $specialTraining);
                        $stmt->execute();
                    }
                }
    
                // DELETE EXISTING SPECIAL TRAINING IN THE LIST
                foreach($specialTrainingList as $stList) {
                    if(!in_array($stList, $_POST['special_training'])) {
                        $stmt = $conn->prepare("DELETE FROM tbl_hospital_special_training WHERE information_id = ? AND special_training_id = ?");
                        $stmt->bind_param("ii", $user_id, $stList);
                        $stmt->execute();
                    }
                }
            }
            // END OF SPECIAL TRAINING

            /**
             * PRACTICE START
             * - GET PRACTICE LIST
             * - INSERT PRACTICE
             * - DELETE PRACTICE
             */
            if(!empty($_POST['practice'])) {
                $practiceStmt = $conn->prepare("SELECT * FROM tbl_hospital_practice WHERE information_id = ?");
                $practiceStmt->bind_param("i", $user_id);
                $practiceStmt->execute();
                $practiceResult = $practiceStmt->get_result();
                $practiceList = array();
                while($practiceRow = $practiceResult->fetch_assoc()) :
                    $practiceList[] = $practiceRow['practice_id'];
                endwhile;
    
                // INSERT NEWLY ADDED PRACTICE IF THERE IS ANY
                foreach($_POST['practice'] as $practice) {
                   if(!in_array($practice, $practiceList)) {
                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_practice (information_id, practice_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $user_id, $practice);
                        $stmt->execute();
                   }
                }
    
                // DELETE EXISTING PRACTICE
                foreach($practiceList as $pracList) {
                    if(!in_array($pracList, $_POST['practice'])) {
                        $stmt = $conn->prepare("DELETE FROM tbl_hospital_practice WHERE information_id = ? AND practice_id = ?");
                        $stmt->bind_param("ii", $user_id, $pracList);
                        $stmt->execute();
                    }
                }
            }
            // END OF PRACTICE UPDATE

            /**
             * CATEGORY START
             * - GET CATEGORY LIST
             * - INSERT CATEGORY
             * - DELETE CATEGORY
             */

            // GET CATEGORY
            if(!empty($_POST['category'])) {
                $catStmt = $conn->prepare("SELECT * FROM tbl_hospital_drcategory WHERE information_id = ?");
                $catStmt->bind_param("i", $user_id);
                $catStmt->execute();
                $catResult = $catStmt->get_result();
                $categoryList = array();
                while($catRow = $catResult->fetch_assoc()) :
                    $categoryList[] = $catRow['category_id'];
                endwhile;
    
                // INSERT NEWLY CATEGORY LIST IF THERE IS ANY
                foreach($_POST['category'] as $category) {
                    if(!in_array($category, $categoryList)) {
                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_drcategory (information_id, category_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $user_id, $category);
                        $stmt->execute();
                    }
                }
    
                // DELETE EXISTING CATEGORY
                foreach($categoryList as $catList) {
                    if(!in_array($catList, $_POST['category'])) {
                        $stmt = $conn->prepare("DELETE FROM tbl_hospital_drcategory WHERE information_id = ? AND category_id = ?");
                        $stmt->bind_param("ii", $user_id, $catList);
                        $stmt->execute();
                    }
                }
            }
            // END OF CATEGORY UPDATE

            /**
             * COUNCIL START
             * - GET COUNCIL LIST
             * - INSERT COUNCIL
             * - DELETE COUNCIL
             */

            // GET COUNCIL LIST
            if(!empty($_POST['council'])) {
                $councilStmt = $conn->prepare("SELECT * FROM tbl_hospital_council WHERE information_id = ?");
                $councilStmt->bind_param("i", $user_id);
                $councilStmt->execute();
                $councilResult = $councilStmt->get_result();
                $councilList = array();
                while($councilRow = $councilResult->fetch_assoc()) :
                    $councilList[] = $councilRow['council_id'];
                endwhile;
    
                // INSERT NEWLY ADDED COUNCIL IF THERE IS ANY
                foreach($_POST['council'] as $council) {
                    if(!in_array($council, $councilList)) {
                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_council (information_id, council_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $user_id, $council);
                        $stmt->execute();
                    }
                }
    
                // DELETE COUNCIL
                foreach($councilList as $counList) {
                    if(!in_array($counList, $_POST['council'])) {
                        $stmt = $conn->prepare("DELETE FROM tbl_hospital_council WHERE information_id = ? AND council_id = ?");
                        $stmt->bind_param("ii", $user_id, $counList);
                        $stmt->execute();
                    }
                }
            }
            // COUNCIL UPDATE END

            /**
             * COMMITTEE START
             * - GET COMMITTEE LIST
             * - INSERT COMMITTEE
             * - DELETE COMMITTEE
             */

            //GET COMMITTEE LIST
            if(!empty($_POST['committee'])) {
                $commStmt = $conn->prepare("SELECT * FROM tbl_hospital_committee WHERE information_id = ?");
                $commStmt->bind_param("i", $user_id);
                $commStmt->execute();
                $commResult = $commStmt->get_result();
                $commList = array();
                while($commRow = $commResult->fetch_assoc()) :
                    $commList[] = $commRow['cmt_id'];
                endwhile;
    
                // INSERT NEWLY ADDED COMMITTEE IF THERE IS ANY
                foreach($_POST['committee'] as $committee) {
                    if(!in_array($committee, $commList)) {
                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_committee (information_id, cmt_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $user_id, $committee);
                        $stmt->execute();
                    }
                }
    
                // DELETE COMMITTEE
                foreach($commList as $cmList) {
                    if(!in_array($cmList, $_POST['committee'])) {
                        $stmt = $conn->prepare("DELETE FROM tbl_hospital_committee WHERE information_id = ? AND cmt_id = ?");
                        $stmt->bind_param("ii", $user_id, $cmList);
                        $stmt->execute();
                    }
                }
            }
            // COMMITTEE UPDATE END

            /**
             * CHAPTER START
             * - GET ALL CHAPTER LIST
             * - INSERT CHAPTER
             * - DELETE CHAPTER
             */

            // GET ALL CHAPTER LIST
            if(!empty($_POST['chapter'])) {
                $chapterStmt = $conn->prepare("SELECT * FROM tbl_hospital_chapter WHERE information_id = ?");
                $chapterStmt->bind_param("i", $user_id);
                $chapterStmt->execute();
                $chapterResult = $chapterStmt->get_result();
                $chapterList = array();
                while($chapterRow = $chapterResult->fetch_assoc()) :
                    $chapterList[] = $chapterRow['chapter_id'];
                endwhile;
    
                // INSERT NEWLY ADDED CHAPTER IF THERE IS ANY
                foreach($_POST['chapter'] as $chapter) {
                    if(!in_array($chapter, $chapterList)) {
                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_chapter (information_id, chapter_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $user_id, $chapter);
                        $stmt->execute();
                    }
                }
    
                // DELETE CHAPTER
                foreach($chapterList as $chap_list) {
                    if(!in_array($chap_list, $_POST['chapter'])) {
                        $stmt = $conn->prepare("DELETE FROM tbl_hospital_chapter WHERE information_id = ? AND chapter_id = ?");
                        $stmt->bind_param("ii", $user_id, $chap_list);
                        $stmt->execute();
                    }
                }
            }
            // CHAPTER UPDATE END

            /**
             * OTHERS UPDATE
             * other_sub
             * other_spec
             * other_practice
             * other_category
             * other_council
             * other_committee
             * other_chapter
             */

            $stmt = $conn->prepare("UPDATE tbl_other_subspecialty SET other_subspecialty = ? WHERE u_id = ?");
            $stmt->bind_param("si", $otherSubspecialty, $user_id);
            $stmt->execute();

            $stmt = $conn->prepare("UPDATE tbl_other_special_training SET other_special_training = ? WHERE u_id = ?");
            $stmt->bind_param("si", $otherSpecialtraining, $user_id);
            $stmt->execute();

            $stmt = $conn->prepare("UPDATE tbl_other_practice SET other_practice = ? WHERE u_id = ?");
            $stmt->bind_param("si", $otherPractice, $user_id);
            $stmt->execute();

            $stmt = $conn->prepare("UPDATE tbl_other_drcategory SET category = ? WHERE u_id = ?");
            $stmt->bind_param("si", $otherCategory, $user_id);
            $stmt->execute();

            $stmt = $conn->prepare("UPDATE tbl_other_council SET other_council = ? WHERE u_id = ?");
            $stmt->bind_param("si", $otherCouncil, $user_id);
            $stmt->execute();

            $stmt = $conn->prepare("UPDATE tbl_other_committee SET other_committee = ? WHERE u_id = ?");
            $stmt->bind_param("si", $otherCommittee, $user_id);
            $stmt->execute();

            $stmt = $conn->prepare("UPDATE tbl_other_chapter SET other_chapter = ? WHERE u_id = ?");
            $stmt->bind_param("si", $otherChapter, $user_id);
            $stmt->execute();

            if(!$conn->commit()) {
                $conn->rollback();
                return;
            } else {
                header("Location: ./view-user.php?id=".$user_id."#affiliation");
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ob_end_flush();
?>