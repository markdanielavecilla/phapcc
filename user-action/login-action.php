<?php
    require_once "./connection/connection.php";

    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        /**
         * @desc Check email if exist and the password is correct
         */
        $stmt = $conn->prepare("SELECT id, email, user_password FROM tbl_credentials WHERE email = ? AND user_password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        /**
         * @desc Get the name of the user
         */
        
        if($result->num_rows > 0) {
            $credRow = $result->fetch_assoc();
            $_SESSION['auth'] = true;
            $_SESSION['user_id'] = $credRow['id'];
            $user_id = $_SESSION['user_id'];
            header("Location: ./user/profile.php?id=$user_id");
               
        } else {
            $_SESSION['client_message'] = "<div class='alert alert-danger'>Email or Password is incorrect.</div>";
        }   
    }
    $conn->close();
?>