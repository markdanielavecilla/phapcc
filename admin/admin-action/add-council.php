<?php
    require_once "./includes/connection.php";

    // ADD COUNCIL
    $errCouncil = "";
    if(isset($_POST['addCouncil'])) {
        $council = $_POST['council-title'];
        $status = 0;

        $conn->autocommit(FALSE);

        //check if input is empty
        if(empty($council)) {
            $errCouncil = "This field is required";
            return;
        }

        // Check if council is exist
        $coun = $conn->prepare("SELECT council from tbl_council where council = ?");
        $coun->bind_param("s", $council);
        $coun->execute();
        $resultCoun = $coun->get_result();
        if($resultCoun->num_rows > 0) {
            $errCouncil = "Council already exist";
            $_SESSION['message'] = "<div class='alert alert-danger'>$errCouncil</div>";
            return;
        }
        $coun->close();

        // INSERT NEW COUNCIL 
        $stmt = $conn->prepare("INSERT INTO tbl_council (council, status) VALUES (?, ?)");
        $stmt->bind_param("si", $council, $status);
        $stmt->execute();

        if(!$conn->commit()) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to add council</div>";
            $conn->rollback();
            return;
        } else {
            $_SESSION['message'] = "<div class='alert alert-success'>Successfully added council</div>";
            return;
        }
    }
?>