<?php
    require_once "./connection/connection.php";

    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = trim($_POST['password']);

        /**
         * @desc Check if there is an input in email and password
         */

        if(empty($email) && empty($password)) {
            $_SESSION['client_message'] = "<div class='alert alert-danger'>Incorrect email or password.</div>";
            return;
        }

        /**
         * @desc Check email if exist and the password is correct
         */
        $stmt = $conn->prepare("SELECT id, email, user_password FROM tbl_credentials WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        /**
         * @desc Get the name of the user
         */
        
        if($result->num_rows > 0) {
            $credRow = $result->fetch_assoc();
            if(password_verify($password, $credRow['user_password'])) {
                $_SESSION['auth'] = true;
                $_SESSION['user_id'] = $credRow['id'];
                $user_id = $_SESSION['user_id'];
                header("Location: ./user/profile.php?id=$user_id");
            } else {
                $_SESSION['client_message'] = "<div class='alert alert-danger'>Incorrect email or password.</div>";
            }
        } else {
            $_SESSION['client_message'] = "<div class='alert alert-danger'>Incorrect email or password.</div>";
        }   
    }
    $conn->close();
?>