<?php
    session_start();
    
    if(isset($_SESSION['admin_auth'])) {
        unset($_SESSION['admin_auth']);
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_username']);
    }

    header("Location: ../index.php");
?>