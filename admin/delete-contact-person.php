<?php
    session_start();
    require_once "./includes/connection.php";
    $user_id = $_SESSION['admin_user_id'];
    $cp_id = $_GET['id'];
    $inactive_status = 1;

    echo $user_id;

    // DELETE CONTACT
    $sql = "UPDATE tbl_contact_person SET status = ? where cp_id = ? LIMIT 1";
    if($deleteContact = $conn->prepare($sql)) {
        $deleteContact->bind_param("ii", $inactive_status, $cp_id);
        $deleteContact->execute();
        $deleteContact->close();
        header("Location: ./view-user.php?id=$user_id#contact_person");
    } else {
        $deleteError = $conn->errno.' '.$conn->error;
        $_SESSION['message'] = "<div class='alert alert-danger'>$deleteError</div>";
        return;
    }
?>