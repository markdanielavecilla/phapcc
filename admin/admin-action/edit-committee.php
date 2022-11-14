<?php
    require_once "./includes/connection.php";

    // GET COMMITTEE BY ID
    $committeeId = $_GET['id'];

    $stmt = $conn->prepare("SELECT committee FROM tbl_committee WHERE cmt_id = ?");
    $stmt->bind_param("i", $committeeId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // UPDATE COMMITTEE
    $errCommittee = "";
    if(isset($_POST['editCommittee'])) {
        $flag = true;
        $newCommittee = $_POST['committee'];
        $error = array();

        if(!preg_match("/^[a-zA-Z\s\-]*$/", $newCommittee)) {
            $flag = false;
            $errCommittee = "Committee must contain letters only.";
            $error[] = $errCommittee;
        }

        if($flag === false && count($error) > 0) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to update Committee</div>";
        } else {
            $committee = $conn->prepare("UPDATE tbl_committee SET committee = ? WHERE cmt_id =?");
            $committee->bind_param("si", $newCommittee, $committeeId);
            $committee->execute();
            $committee->close();
            $_SESSION['message'] = "<div class='alert alert-success'>Successfully updated committee</div>";
        }
    }
?>