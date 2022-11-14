<?php
    $HOST = 'localhost';
    $USERNAME = 'root';
    $PASSWORD = '';
    $DATABASE = 'doctorsdb';

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DATABASE) or trigger_error(mysqli_error());
?>