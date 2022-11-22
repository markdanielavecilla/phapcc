<?php
    require_once "./connection/connection.php";
    if(isset($_POST['updatePassword'])) {
        $newPassword = $conn->real_escape_string(trim($_POST['newPassword']));
        $userEmail = $_SESSION['user_email'];

        $encryptPw = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE tbl_credentials SET user_password = ? WHERE email = ? LIMIT 1");
        $stmt->bind_param("ss", $encryptPw, $userEmail);
        $stmt->execute();
        unset($_SESSION['user_email']);
        unset($_SESSION['user_question']);
        unset($_SESSION['user_answer']);
        header("Location: ./index.php");
    } else {
        echo "<script>window.location.href='index.php'</script>";
    }
?>