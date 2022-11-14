<?php
    require_once "./includes/connection.php";

    // GET SUBPSPECIALTY BY ID
    $subspecialtyId = $_GET['id'];

    $stmt = $conn->prepare("SELECT subspecialty FROM tbl_subspecialty WHERE sub_id = ?");
    $stmt->bind_param("i", $subspecialtyId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // UPDATE SUBSPECIALTY
    $errSubspecialty = "";
    if(isset($_POST['editSubspecialty'])) {
        $flag = true;
        $newSubspecialty = $_POST['subspecialty'];
        $error = array();

        if(!preg_match("/^[a-zA-Z\s\-]*$/", $newSubspecialty)) {
            $flag = false;
            $errSubspecialty = "Subspecialty must contain letters only.";
            $error[] = $errSubspecialty;
        }

        if($flag === false && count($error) > 0) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to update subspecialty</div>";
        } else {
            $subspecialty = $conn->prepare("UPDATE tbl_subspecialty SET subspecialty = ? WHERE sub_id = ?");
            $subspecialty->bind_param("si", $newSubspecialty, $subspecialtyId);
            $subspecialty->execute();
            $subspecialty->close();
            $_SESSION['message'] = "<div class='alert alert-success'>Successfully updated subspecialty</div>";
        }
    }
?>