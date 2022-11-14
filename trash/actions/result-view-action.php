<?php
    include_once('./connection.php');

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $_SESSION['user_id'] = $id;
        $sql = "SELECT *
                FROM tbl_information
                INNER JOIN tbl_hospital ON tbl_information.id = tbl_hospital.doctor_id
                INNER JOIN tbl_school ON tbl_information.id = tbl_school.docid
                INNER JOIN tbl_member_year ON tbl_information.id = tbl_member_year.id
                WHERE tbl_information.id = $id
                ";
                $result = $conn->query($sql) or die($conn->error);
                $rows = $result->fetch_assoc();
    }

?>