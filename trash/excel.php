<?php

    include_once('connection.php');
    $id = $_GET['id'];
    
    $output = '';

    $sql = "SELECT *,
                GROUP_CONCAT(DISTINCT tbl_drcategory.category SEPARATOR ', ') as category_list,
                GROUP_CONCAT(DISTINCT tbl_chapter.chapter SEPARATOR ', ') as chapter_list,
                GROUP_CONCAT(DISTINCT tbl_practice.practice SEPARATOR ', ') as practice_list,
                GROUP_CONCAT(DISTINCT tbl_subspecialty.subspecialty SEPARATOR ', ') as sub_list
                FROM tbl_information 
                INNER JOIN tbl_hospital ON tbl_information.id = tbl_hospital.doctor_id
                INNER JOIN tbl_school ON tbl_information.id = tbl_school.docid
                INNER JOIN tbl_member_year ON tbl_information.id = tbl_member_year.id
                INNER JOIN tbl_hospital_drcategory ON tbl_information.id = tbl_hospital_drcategory.information_id
                INNER JOIN tbl_drcategory ON tbl_hospital_drcategory.category_id = tbl_drcategory.catid
                INNER JOIN tbl_hospital_chapter ON tbl_information.id = tbl_hospital_chapter.information_id
                INNER JOIN tbl_chapter ON tbl_hospital_chapter.chapter_id = tbl_chapter.chapid
                INNER JOIN tbl_hospital_practice ON tbl_information.id = tbl_hospital_practice.information_id
                INNER JOIN tbl_practice ON tbl_hospital_practice.practice_id = tbl_practice.practice_id
                INNER JOIN tbl_hospital_subspecialty ON tbl_information.id = tbl_hospital_subspecialty.information_id
                INNER JOIN tbl_subspecialty ON tbl_hospital_subspecialty.subspecialty_id = tbl_subspecialty.sub_id
                WHERE tbl_information.id = $id
            ";

    $result = $conn->query($sql) or die($conn->error);
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    // print_r($rows);
    
    $output .= "
        <table border='1'>
            <tr>
                <th>ID</th>
                <th>First name</th>
                <th>Middle name</th>
                <th>Last name</th>
                <th>Suffix</th>
                <th>Gender</th>
                <th>Mobile number 1</th>
                <th>Mobile number 2</th>
                <th>Email</th>
                <th>PRC #</th>
                <th>PMA #</th>
                <th>Deceased</th>
                <th>Birth Month</th>
                <th>Birth Day</th>
                <th>Birth Year</th>
                <th>Age</th>
                <th>Medical School</th>
                <th>Year Graduated</th>
                <th>Training School</th>
                <th>Year Graduated</th>
                <th>Hospital Affiliation</th>
                <th>City/Province</th>
                <th>Contact #</th>
                <th>Landline #</th>
                <th>Home address</th>
                <th>Principal office</th>
                <th>Fellow year</th>
                <th>Life fellow year</th>
                <th>Diplomate</th>
                <th>Life member year</th>
                <th>Associate Fellow Year</th>
                <th>Associate Year</th>
            </tr>
    ";

    foreach($rows as $row) :

        $ids = $row['id'];
        $fname = $row['first_name'];
        $mname = $row['middle_name'];
        $lname = $row['last_name'];
        $suffix = $row['suffix'];
        $gender = $row['gender'];
        $mobile1 = $row['mobile_number'];
        $mobile2 = $row['second_mobile_number'];
        $email = $row['email'];
        $prc = $row['prcno'];
        $pma = $row['pmano'];
        $deceased = $row['deceased'];
        $month = $row['birth_month'];
        $day = $row['birth_day'];
        $year = $row['birth_year'];
        $age = $row['age'];
        $medical_school = $row['medical_school'];
        $year_graduated = $row['year_graduated'];
        $training_school = $row['training_school'];
        $year_finish = $row['year_finish'];
        $hospital = $row['hospital_affiliation'];
        $cityprovince = $row['cityprovince'];
        $contact = $row['contactno'];
        $landline = $row['landlineno'];
        $home_address = $row['home_address'];
        $principal = $row['principal_office'];
        $fellowYear = $row['fellow_year'];
        $lifeFellowYear = $row['life_fellow_year'];
        $diplomateYear = $row['diplomate_year'];
        $lifeMemberYear = $row['life_member_year'];
        $associateFellow = $row['associate_fellow'];
        $associate = $row['associate'];
    
    $output .= "
            <tr>
                <td>$ids</td>
                <td>$fname</td>
                <td>$mname</td>
                <td>$lname</td>
                <td>$suffix</td>
                <td>$gender</td>
                <td>$mobile1</td>
                <td>$mobile2</td>
                <td>$email</td>
                <td>$prc</td>
                <td>$pma</td>
                <td>$deceased</td>
                <td>$month</td>
                <td>$day</td>
                <td>$year</td>
                <td>$age</td>
                <td>$medical_school</td>
                <td>$year_graduated</td>
                <td>$training_school</td>
                <td>$year_finish</td>
                <td>$hospital</td>
                <td>$cityprovince</td>
                <td>$contact</td>
                <td>$landline</td>
                <td>$home_address</td>
                <td>$principal</td>
                <td>$fellowYear</td>
                <td>$lifeFellowYear</td>
                <td>$diplomateYear</td>
                <td>$lifeMemberYear</td>
                <td>$associateFellow</td>
                <td>$associate</td>
            </tr>
    ";

    endforeach;

    $output .= "</table>";

    header("Content-Type: application/xlsx");
    header("Content-Disposition: attachment; filename=test.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    echo $output;

    exit();

?>