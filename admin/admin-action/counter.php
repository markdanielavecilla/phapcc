<?php
    require_once "./includes/connection.php";
    $deceased = 0;
    $status = 0;

    // GET TOTAL COUNT OF ALL USERS ALIVE
    $user = $conn->prepare("SELECT COUNT(*) as totalUser FROM tbl_information WHERE deceased = ?");
    $user->bind_param("i", $deceased);
    $user->execute();
    $userResult = $user->get_result();
    $userRow = $userResult->fetch_assoc();
    $user->close();

    // GET TOTAL COUNT OF ACTIVE CHAPTERS
    $chapter = $conn->prepare("SELECT COUNT(*) as totalChapter FROM tbl_chapter WHERE status = ?");
    $chapter->bind_param("i", $status);
    $chapter->execute();
    $chapterResult = $chapter->get_result();
    $chapterRow = $chapterResult->fetch_assoc();
    $chapter->close();

    // GET TOTAL COUNT OF ACTIVE COMMITTEE
    $committee = $conn->prepare("SELECT COUNT(*) as totalCommittee FROM tbl_committee WHERE status = ?");
    $committee->bind_param("i", $status);
    $committee->execute();
    $committeeResult = $committee->get_result();
    $committeeRow = $committeeResult->fetch_assoc();
    $committee->close();

    // GET TOTAL COUNT OF ACTIVE COUNCIL
    $council = $conn->prepare("SELECT COUNT(*) as totalCouncil FROM tbl_council WHERE status = ?");
    $council->bind_param("i", $status);
    $council->execute();
    $councilResult = $council->get_result();
    $councilRow = $councilResult->fetch_assoc();
    $council->close();

    // GET TOTAL COUNT OF ACTIVE CATEGORY
    $category = $conn->prepare("SELECT COUNT(*) as totalCategory FROM tbl_drcategory WHERE status = ?");
    $category->bind_param("i", $status);
    $category->execute();
    $categoryResult = $category->get_result();
    $categoryRow = $categoryResult->fetch_assoc();
    $category->close();

    // GET TOTAL COUNT OF ACTIVE PRACTICE
    $practice = $conn->prepare("SELECT COUNT(*) as totalPractice FROM tbl_practice WHERE status = ?");
    $practice->bind_param("i", $status);
    $practice->execute();
    $practiceResult = $practice->get_result();
    $practiceRow = $practiceResult->fetch_assoc();
    $practice->close();

    // GET TOTAL COUNT OF ACTIVE SPECIAL TRAINING
    $specialTraining = $conn->prepare("SELECT COUNT(*) as totalSpecialTraining FROM tbl_special_training WHERE status = ?");
    $specialTraining->bind_param("i", $status);
    $specialTraining->execute();
    $specialTrainingResult = $specialTraining->get_result();
    $specialTrainingRow = $specialTrainingResult->fetch_assoc();
    $specialTraining->close();

    // GET TOTAL COUNT OF ACTIVE SUBSPECIALTY
    $subspecialty = $conn->prepare("SELECT COUNT(*) as totalSubspecialty FROM tbl_subspecialty WHERE status = ?");
    $subspecialty->bind_param("i", $status);
    $subspecialty->execute();
    $subspecialtyResult = $subspecialty->get_result();
    $subspecialtyRow = $subspecialtyResult->fetch_assoc();
    $subspecialty->close();
?>