<?php
    require_once "./includes/connection.php";
    
    // ADD COMMITTEE
    $errComm = "";
    if(isset($_POST['addCommittee'])) {
        $committee = $_POST['committee-title'];
        $status = 0;

        //check if input is empty
        if(empty($committee)) {
            $errComm = "This field is required";
            return;
        }

        // check if committee is already exist
        $comm = $conn->prepare("SELECT committee from tbl_committee where committee = ?");
        $comm->bind_param("s", $committee);
        $comm->execute();
        $resultComm = $comm->get_result();
        if($resultComm->num_rows > 0) {
            $errComm = "Committee already exist";
            $_SESSION['message'] = "<div class='alert alert-danger'>$errComm</div>";
            return;
        }
        $comm->close();

        $stmt = $conn->prepare("INSERT INTO tbl_committee (committee, status) VALUES (?, ?)");
        $stmt->bind_param("si", $committee, $status);
        $stmt->execute();

        if(!$conn->commit()) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to add committee</div>";
            $conn->rollback();
            return;
        } else {
            $_SESSION['message'] = "<div class='alert alert-success'>Successfully added committee</div>";
        }
    }
?>