<?php
    session_start();
    require_once "../connection/connection.php";

    $USER_ID = $_SESSION['user_id'];

    // echo $USER_ID;
    $info_id = $_GET['info_id'];

    // GET EXISTING ADDITIONAL AFFILIATION
    $stmt = $conn->prepare("SELECT hospital_aff, contact, landline FROM tbl_extrainformation WHERE id = ?");
    $stmt->bind_param("i", $info_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    // UPDATE EXISTING ADDITIONAL AFFILIATION

    if(isset($_POST['update_affiliation'])) {
        /**
         * update_add_affiliation
         * update_contact_number
         * update_landline
         */
        $add_affiliation = test_input($update_add_affiliation);
        $contact_number = test_input($update_contact_number);
        $landline_number = test_input($update_landline);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>