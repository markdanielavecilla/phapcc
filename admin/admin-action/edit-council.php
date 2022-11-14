<?php
    require_once "./includes/connection.php";

    // GET COUNCIL BY ID
    $councilId = $_GET['id'];

    $stmt = $conn->prepare("SELECT council FROM tbl_council where council_id = ?");
    $stmt->bind_param("i", $councilId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // UPDATE COUNCIL
    $errCouncil = "";
    if(isset($_POST['editCouncil'])) {
        $flag = true;
        $newCouncil = $_POST['council'];
        $error = array();

        if(!preg_match("/^[a-zA-Z\s\-]*$/", $newCouncil)) {
            $flag = false;
            $errCouncil = "Council must contain letters only.";
            $error[] = $errCouncil;
        }

        if($flag === false && count($error) > 0) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to update Council</div>";
        } else {
            $council = $conn->prepare("UPDATE tbl_council SET council = ? WHERE council_id = ?");
            $council->bind_param("si", $newCouncil, $councilId);
            $council->execute();
            $council->close();
            $_SESSION['message'] = "<div class='alert alert-success'>Successfully updated council</div>";
        }
    }
?>