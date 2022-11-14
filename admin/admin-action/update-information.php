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
?>