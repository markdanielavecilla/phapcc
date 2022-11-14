<?php
    require_once "./includes/connection.php";
    
    // ADD COMMITTEE
    if(isset($_POST['addCommittee'])) {
        $committee = $_POST['committee-title'];

        $stmt = $conn->prepare("INSERT INTO tbl_committee (committee) VALUES (?)");
        $stmt->bind_param("s", $committee);
        $stmt->execute();

        if(!$conn->commit()) {
            $_SESSION['message'] = "Failed to add committee";
            $conn->rollback();
            return;
        } else {
            $_SESSION['message'] = "Successfully added committee";
        }
    }
?>