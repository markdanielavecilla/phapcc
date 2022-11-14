<?php
    session_start();
    if(isset($_SESSION['auth'])) {
        unset($_SESSION['auth']);
        unset($_SESSION['user_id']);
    }
    header("Location: ../index.php");
?>