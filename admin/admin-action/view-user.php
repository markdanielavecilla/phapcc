<?php
    require_once "./includes/connection.php";
    $user_id = $_GET['id'];

    // INFORMATION
    $userInfo = $conn->prepare("SELECT * FROM tbl_information WHERE id = ?");
    $userInfo->bind_param("i", $user_id);
    $userInfo->execute();
    $infoResult = $userInfo->get_result();
    $userRow = $infoResult->fetch_assoc();
    $userInfo->close();

    // UID
    $uid = $conn->prepare("SELECT * FROM tbl_uid WHERE userid = ?");
    $uid->bind_param("i", $user_id);
    $uid->execute();
    $uidResult = $uid->get_result();
    $uidRow = $uidResult->fetch_assoc();
    $uid->close();

    // TRAINING INSTITUTION & MEDICAL SCHOOL
    $userSchool = $conn->prepare("SELECT * FROM tbl_school WHERE docid = ?");
    $userSchool->bind_param("i", $user_id);
    $userSchool->execute();
    $schoolResult = $userSchool->get_result();
    $schoolRow = $schoolResult->fetch_assoc();
    $userSchool->close();

    // AFFILIATION
    $affiliation = $conn->prepare("SELECT * FROM tbl_hospital WHERE doctor_id = ?");
    $affiliation->bind_param("i", $user_id);
    $affiliation->execute();
    $affResult = $affiliation->get_result();
    $affRow = $affResult->fetch_assoc();
    $affiliation->close();

    $subspecialty = $conn->prepare("SELECT tbl_information.id, GROUP_CONCAT(DISTINCT tbl_subspecialty.subspecialty SEPARATOR ', ') as sub_list FROM tbl_information INNER JOIN tbl_hospital_subspecialty ON tbl_information.id = tbl_hospital_subspecialty.information_id INNER JOIN tbl_subspecialty ON tbl_hospital_subspecialty.subspecialty_id = tbl_subspecialty.sub_id WHERE tbl_information.id = ?");
    $subspecialty->bind_param("i", $user_id);
    $subspecialty->execute();
    $subResult = $subspecialty->get_result();
    $subspecialty->close();

    $practice = $conn->prepare("SELECT tbl_information.id, GROUP_CONCAT(DISTINCT tbl_practice.practice SEPARATOR ', ') as practice_list FROM tbl_information INNER JOIN tbl_hospital_practice ON tbl_information.id = tbl_hospital_practice.information_id INNER JOIN tbl_practice ON tbl_hospital_practice.practice_id = tbl_practice.practice_id WHERE tbl_information.id = ?");
    $practice->bind_param("i", $user_id);
    $practice->execute();
    $practiceResult = $practice->get_result();
    $practice->close();

    $specialTraining = $conn->prepare("SELECT tbl_information.id, GROUP_CONCAT(DISTINCT tbl_special_training.special_training SEPARATOR ', ') as training_list FROM tbl_information INNER JOIN tbl_hospital_special_training ON tbl_information.id = tbl_hospital_special_training.information_id INNER JOIN tbl_special_training ON tbl_hospital_special_training.special_training_id = tbl_special_training.st_id WHERE tbl_information.id = ?");
    $specialTraining->bind_param("i", $user_id);
    $specialTraining->execute();
    $trainingResult = $specialTraining->get_result();
    $specialTraining->close();

    $category = $conn->prepare("SELECT tbl_information.id, GROUP_CONCAT(DISTINCT tbl_drcategory.category SEPARATOR ', ') as category_list FROM tbl_information INNER JOIN tbl_hospital_drcategory ON tbl_information.id = tbl_hospital_drcategory.information_id INNER JOIN tbl_drcategory ON tbl_hospital_drcategory.category_id = tbl_drcategory.catid WHERE tbl_information.id = ?");
    $category->bind_param("i", $user_id);
    $category->execute();
    $catResult = $category->get_result();
    $category->close();

    $council = $conn->prepare("SELECT tbl_information.id, GROUP_CONCAT(DISTINCT tbl_council.council SEPARATOR ', ') as council_list FROM tbl_information INNER JOIN tbl_hospital_council ON tbl_information.id = tbl_hospital_council.information_id INNER JOIN tbl_council ON tbl_hospital_council.council_id = tbl_council.council_id WHERE tbl_information.id = ?");
    $council->bind_param("i", $user_id);
    $council->execute();
    $councilResult = $council->get_result();
    $council->close();

    $committee = $conn->prepare("SELECT tbl_information.id, GROUP_CONCAT(DISTINCT tbl_committee.committee SEPARATOR ', ') as committee_list FROM tbl_information INNER JOIN tbl_hospital_committee ON tbl_information.id = tbl_hospital_committee.information_id INNER JOIN tbl_committee ON tbl_hospital_committee.cmt_id = tbl_committee.cmt_id WHERE tbl_information.id = ?");
    $committee->bind_param("i", $user_id);
    $committee->execute();
    $committeeResult = $committee->get_result();
    $committee->close();

    $chapter = $conn->prepare("SELECT tbl_information.id, GROUP_CONCAT(DISTINCT tbl_chapter.chapter SEPARATOR ', ') as chapter_list FROM tbl_information INNER JOIN tbl_hospital_chapter ON tbl_information.id = tbl_hospital_chapter.information_id INNER JOIN tbl_chapter ON tbl_hospital_chapter.chapter_id = tbl_chapter.chapid WHERE tbl_information.id = ?");
    $chapter->bind_param("i", $user_id);
    $chapter->execute();
    $chapterResult = $chapter->get_result();
    $chapter->close();

    // OTHERS :
    // OTHER SUBSPECIALTY
    $otherSubspecialty = $conn->prepare("SELECT other_subspecialty FROM tbl_other_subspecialty WHERE u_id = ?");
    $otherSubspecialty->bind_param("i", $user_id);
    $otherSubspecialty->execute();
    $otherSubResult = $otherSubspecialty->get_result();
    $otherSubRow = $otherSubResult->fetch_assoc();
    $otherSubspecialty->close();

    // OTHER SPECIAL TRAINING
    $otherSpecialTraining = $conn->prepare("SELECT other_special_training FROM tbl_other_special_training WHERE u_id = ?");
    $otherSpecialTraining->bind_param("i", $user_id);
    $otherSpecialTraining->execute();
    $otherSpecialTrainingResult = $otherSpecialTraining->get_result();
    $otherSpecialTrainingRow = $otherSpecialTrainingResult->fetch_assoc();
    $otherSpecialTraining->close();

    // OTHER PRACTICE
    $otherPractice = $conn->prepare("SELECT other_practice FROM tbl_other_practice WHERE u_id = ?");
    $otherPractice->bind_param("i", $user_id);
    $otherPractice->execute();
    $otherPracticeResult = $otherPractice->get_result();
    $otherPracticeRow = $otherPracticeResult->fetch_assoc();
    $otherPractice->close();

    // OTHER CATEGORY
    $otherCategory = $conn->prepare("SELECT category FROM tbl_other_drcategory WHERE u_id = ?");
    $otherCategory->bind_param("i", $user_id);
    $otherCategory->execute();
    $otherCategoryResult = $otherCategory->get_result();
    $otherCategoryRow = $otherCategoryResult->fetch_assoc();
    $otherCategory->close();

    // OTHER COUNCIL
    $otherCouncil = $conn->prepare("SELECT other_council FROM tbl_other_council WHERE u_id = ?");
    $otherCouncil->bind_param("i", $user_id);
    $otherCouncil->execute();
    $otherCouncilResult = $otherCouncil->get_result();
    $otherCouncilRow = $otherCouncilResult->fetch_assoc();
    $otherCouncil->close();

    // OTHER COMMITTEE
    $otherCommittee = $conn->prepare("SELECT other_committee FROM tbl_other_committee WHERE u_id = ?");
    $otherCommittee->bind_param("i", $user_id);
    $otherCommittee->execute();
    $otherCommitteeResult = $otherCommittee->get_result();
    $otherCommitteeRow = $otherCommitteeResult->fetch_assoc();
    $otherCommittee->close();

    // OTHER CHAPTER
    $otherChapter = $conn->prepare("SELECT other_chapter FROM tbl_other_chapter WHERE u_id = ?");
    $otherChapter->bind_param("i", $user_id);
    $otherChapter->execute();
    $otherChapterResult = $otherChapter->get_result();
    $otherChapterRow = $otherChapterResult->fetch_assoc();
    $otherChapter->close();

    // EXTRA INFO
    $otherInfo = $conn->prepare("SELECT id, hospital_aff, contact, landline FROM tbl_extrainformation WHERE doctors_id = ? order by id desc");
    $otherInfo->bind_param("i", $user_id);
    $otherInfo->execute();
    $otherInfoResult = $otherInfo->get_result();
    $otherInfo->close();

    // YEAR AS
    $year = $conn->prepare("SELECT * FROM tbl_member_year WHERE id = ?");
    $year->bind_param("i", $user_id);
    $year->execute();
    $yearResult = $year->get_result();
    $yearRow = $yearResult->fetch_assoc();
    $year->close();
?>