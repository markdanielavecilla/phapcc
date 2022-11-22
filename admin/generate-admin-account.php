<?php
    require_once "./includes/connection.php";
    $username = "admin";
    $password = "pha123";

    $encryptPw = password_hash($password, PASSWORD_DEFAULT);

    $admin = $conn->prepare("INSERT into tbl_admin (username, admin_password) values (?, ?)");
    $admin->bind_param("ss", $username, $encryptPw);
    $admin->execute();

    echo "<script>window.location.href='index.php'</script>";
?>