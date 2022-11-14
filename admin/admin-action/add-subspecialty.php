<?php
    require_once "./includes/connection.php";

    // ADD SUBSECIALTY
    if(isset($_POST['addSubspecialty'])) {
        $subspecialty = $_POST['subspecialty-title'];

        $conn->autocommit(FALSE);

        $stmt = $conn->prepare("INSERT INTO tbl_subspecialty (subspecialty) VALUES (?)");
        $stmt->bind_param("s", $subspecialty);
        $stmt->execute();

        if(!$conn->commit()) {
            $_SESSION['message'] = "Failed to add subspecialty.";
            $conn->rollback();
            return;
        } else {
            $_SESSION['message'] = "Successfully added subspecialty";
        }
    }
?>