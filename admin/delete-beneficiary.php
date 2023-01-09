<?php
    // TODO: Search if ID is exist
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./includes/connection.php";
    $ben_id = $_GET['id'];
    $user_id = $_SESSION['admin_user_id'];
    $status = 1;

    $sql = "UPDATE tbl_beneficiaries SET status = ? where ben_id = ?";
    if($update_ben = $conn->prepare($sql)) {
        $update_ben->bind_param("ii", $status, $ben_id);
        $update_ben->execute();
        $update_ben->close();
        header("Location: ./view-user.php?id=$user_id#beneficiaries");
    } else {
        $updateError = $conn->errno.' '.$conn->error;
        $_SESSION['message'] = "<div class='alert alert-danger'>$updateError</div>";
        return;
    }

?>