<?php
    session_start();
    require_once "./connection/connection.php";
    $errEmail = "";
    if(isset($_POST['verifyEmail'])) {
        $flag = false;
        $error = array();
        $email = $conn->real_escape_string($_POST['email']);
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $flag = false;
            $errEmail = "Invalid email";
            $error[] = $errEmail;
        }

        if($flag === false && count($error) > 0) {
            $_SESSION['client_status'] = "<div class='alert alert-danger'>Something went wrong</div>";
            return;
        } else {
            $stmt = $conn->prepare("SELECT * FROM tbl_credentials WHERE email = ? LIMIT 1");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
    
            if($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_question'] = $row['secret_question'];
                $_SESSION['user_answer'] = $row['secret_answer'];
                header("Location: ./securityquestion.php");
            } else {
                $errEmail = "Email doesn't exist";
                return;
            }
        }
    } else {
        echo "<script>window.location.href='index.php'</script>";
    }
?>