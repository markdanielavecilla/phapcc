<?php
    require_once "../connection/connection.php";

    // GET USER PASSWORD
    $user_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT user_password FROM tbl_credentials WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
    else {
        $_SESSION['client_message'] = "<div class='alert alert-danger'>No Data Found.</div>";
        return;
    }
    $stmt->close();
 
    // SET NEW PASSWORD
    $errOp = $errNp = "";
    if(isset($_POST['savePassword'])) {
        $old_password = $conn->real_escape_string($_POST['old_password']);
        $new_password = $conn->real_escape_string($_POST['new_password']);
        $repeat_password = $conn->real_escape_string($_POST['repeat_password']);

        // echo "old: $old_password new: $new_password repeat: $repeat_password";

        if($old_password !== $row['user_password']) {
             $errOp = "Incorrect password";
             $_SESSION['client_message'] = "<div class='alert alert-danger'>$errOp</div>";
             return;
        }

        if($new_password !== $repeat_password) {
            $errNp = "New password doesn't match to the repeat password.";
            $_SESSION['client_message'] = "<div class='alert alert-danger'>$errNp</div>";
            return;
        }
        
        $password = $conn->prepare("UPDATE tbl_credentials SET user_password = ? WHERE id = ? LIMIT 1");
        $password->bind_param("si", $new_password, $user_id);
        $password->execute();
        $password->close();
        header("Location: ./profile.php?id=$user_id");
    }
?>