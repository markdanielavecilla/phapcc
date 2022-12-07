<?php
    session_start();
    
    if(isset($_SESSION['admin_auth'])) {
        unset($_SESSION['admin_auth']);
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_username']);
        unset($_SESSION['admin_user_id']);
    }

    header("Location: ../index.php");
?>