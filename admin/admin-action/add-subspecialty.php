<?php
    require_once "./includes/connection.php";

    // ADD SUBSECIALTY
    $errSub = "";
    if(isset($_POST['addSubspecialty'])) {
        $subspecialty = $_POST['subspecialty-title'];
        $status = 0;

        $conn->autocommit(FALSE);

        //check if input is empty
        if(empty($subspecialty)) {
            $errSub = "This field is required";
            return;
        }

        //check if subspecialty exist
        $sub = $conn->prepare("SELECT subspecialty from tbl_subspecialty where subspecialty = ?");
        $sub->bind_param("s", $subspecialty);
        $sub->execute();
        $resultSub = $sub->get_result();
        if($resultSub->num_rows > 0) {
            $errSub = "Subspecialty already exist";
            $_SESSION['message'] = "<div class='alert alert-danger'>$errSub</div>";
            return;
        }
        $sub->close();

        $stmt = $conn->prepare("INSERT INTO tbl_subspecialty (subspecialty, status) VALUES (?, ?)");
        $stmt->bind_param("si", $subspecialty, $status);
        $stmt->execute();

        if(!$conn->commit()) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to add subspecialty.</div>";
            $conn->rollback();
            return;
        } else {
            $_SESSION['message'] = "<div class='alert alert-success'>Successfully added subspecialty</div>";
            return;
        }
    }
?>