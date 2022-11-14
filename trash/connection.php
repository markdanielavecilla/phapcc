<?php

$HOST = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DATABASE = "doctorsdb";

$conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DATABASE) or die(mysqli_error());

?>