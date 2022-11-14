<?php
    require_once "./includes/connection.php";

    // ADD COUNCIL
    if(isset($_POST['addCouncil'])) {
        $council = $_POST['council-title'];

        $conn->autocommit(FALSE);

        $stmt = $conn->prepare("INSERT INTO tbl_council (council) VALUES (?)");
        $stmt->bind_param("s", $council);
        $stmt->execute();

        if(!$conn->commit()) {
            $_SESSION['message'] = "Failed to add council";
            $conn->rollback();
            return;
        } else {
            $_SESSION['message'] = "Successfully added council";
        }
    }
?>