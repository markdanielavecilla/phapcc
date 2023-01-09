<?php
    require __DIR__ . "/vendor/autoload.php";

    // DATABASE CONNECTION
    require_once "./connection/connection.php";

    // ID OF USER
    $user_id = $_GET['id'];
    $status = 0;
    
    // USER INFORMATION
    $information = $conn->prepare("SELECT * FROM tbl_information WHERE id = ?");
    $information->bind_param("i", $user_id);
    $information->execute();
    $infoResult = $information->get_result();
    if($infoResult->num_rows > 0) {
        $informationRow = $infoResult->fetch_assoc();
        $image = $informationRow['image_url'];
        $fname = $informationRow['first_name'];
        $mname = $informationRow['middle_name'];
        $lname = $informationRow['last_name'];
        $suffix = $informationRow['suffix'];
        $email = $informationRow['email'];
        $mobile = $informationRow['mobile_number'];
        $smobile = $informationRow['second_mobile_number'];
        $birthdate = $informationRow['birth_month'].'/'.$informationRow['birth_day'].'/'.$informationRow['birth_year'];
        $age = $informationRow['age'];
        $gender = $informationRow['gender'];
        $prc = $informationRow['prcno'];
        $pma = $informationRow['pmano'];
        $image = $informationRow['image_url'] ? $informationRow['image_url'] : 'default-img.png';
    }
    $information->close();

    // GET SCHOOL
    $school = $conn->prepare("SELECT * FROM tbl_school WHERE docid = ?");
    $school->bind_param("i", $user_id);
    $school->execute();
    $schoolResult = $school->get_result();
    if($schoolResult->num_rows > 0) {
        $schoolRow = $schoolResult->fetch_assoc();
        $medSchool = $schoolRow['medical_school'];
        $yearGrad = $schoolRow['year_graduated'];
        $training = $schoolRow['training_school'];
        $yearFin = $schoolRow['year_finish'];
    }
    $school->close();

    // GET BENEFICIARIES
    $beneficiaries = $conn->prepare("SELECT * FROM tbl_beneficiaries WHERE dr_id = ?");
    $beneficiaries->bind_param("i", $user_id);
    $beneficiaries->execute();
    $benResult = $beneficiaries->get_result();
    $beniRow = "";
    if($benResult->num_rows > 0){
        while($benRow = $benResult->fetch_assoc()) {
            $beniRow = $beniRow."
                <tr>
                    <td>".$benRow["ben_first_name"]."</td>
                    <td>".$benRow["ben_middle_name"]."</td>
                    <td>".$benRow["ben_last_name"]."</td>
                    <td>".$benRow["ben_suffix"]."</td>
                </tr>
            ";
        }
    }
    $beneficiaries->close();

    // GET CONTACT PERSON OF THE USER
    $contactPerson = $conn->prepare("SELECT * FROM tbl_contact_person WHERE cp_id = ?");
    $contactPerson->bind_param("i", $user_id);
    $contactPerson->execute();
    $contactResult = $contactPerson->get_result();
    $contact = "";
    if($contactResult->num_rows > 0) {
        while($contactRow = $contactResult->fetch_assoc()) {
            $contact = $contact."
                <tr>
                    <td>".$contactRow['cp_first_name']."</td>
                    <td>".$contactRow['cp_middle_name']."</td>
                    <td>".$contactRow['cp_last_name']."</td>
                    <td>".$contactRow['cp_mobile_number']."</td>
                </tr>
            ";
        }
    }
    $contactPerson->close();
    
    // GET HOSPITAL AFFILIATION OF THE USER
    $affiliation = $conn->prepare("SELECT * FROM tbl_hospital WHERE doctor_id = ?");
    $affiliation->bind_param("i", $user_id);
    $affiliation->execute();
    $affiliationResult = $affiliation->get_result();
    $affiliate = "";
    if($affiliationResult->num_rows > 0) {
        while($affiliationRow = $affiliationResult->fetch_assoc()) {
            $affiliate = $affiliate."
                <tr>
                    <td>".$affiliationRow['hospital_affiliation']."</td>
                    <td>".$affiliationRow['contactno']."</td>
                    <td>".$affiliationRow['landlineno']."</td>
                    <td>".$affiliationRow['cityprovince']."</td>
                    <td>".$affiliationRow['home_address']."</td>
                    <td>".$affiliationRow['principal_office']."</td>
                    <td>".$affiliationRow['international_affiliation']."</td>
                </tr>
            ";
        }
    }
    $affiliation->close();
    
    // GET SUBSPECIALTY OF USER
    $subspecialty = $conn->prepare("SELECT subspecialty FROM tbl_information JOIN tbl_hospital_subspecialty ON tbl_information.id = tbl_hospital_subspecialty.information_id JOIN tbl_subspecialty ON tbl_hospital_subspecialty.subspecialty_id = tbl_subspecialty.sub_id WHERE tbl_information.id = ? AND status = ?");
    $subspecialty->bind_param("ii", $user_id, $status);
    $subspecialty->execute();
    $subResult = $subspecialty->get_result();
    $sub = "";
    if($subResult->num_rows > 0) {
        while($subRow = $subResult->fetch_assoc()) {
            $sub = $sub."
                <li>".ucwords($subRow['subspecialty'])."</li>  
            ";
        }
    }
    $subspecialty->close();

    // GET OTHER SUBSPECIALTY
    $otherSub = $conn->prepare("SELECT other_subspecialty FROM tbl_other_subspecialty WHERE u_id = ?");
    $otherSub->bind_param("i", $user_id);
    $otherSub->execute();
    $otherSubRes = $otherSub->get_result();
    if($otherSubRes->num_rows > 0) {
        $otherSubRow = $otherSubRes->fetch_assoc();
        $otherSubspecialty = $otherSubRow['other_subspecialty'];
    }
    $otherSub->close();

    // GET SPECIAL TRAINING OF USER
    $st = $conn->prepare("SELECT special_training from tbl_information join tbl_hospital_special_training ON tbl_information.id = tbl_hospital_special_training.information_id join tbl_special_training on tbl_hospital_special_training.special_training_id = tbl_special_training.st_id where id = ? and status = ?");
    $st->bind_param("ii", $user_id, $status);
    $st->execute();
    $stResult = $st->get_result();
    $specT = "";
    if($stResult->num_rows > 0) {
        while($stRow = $stResult->fetch_assoc()) {
            $specT = $specT."
                <li>".ucwords($stRow['special_training'])."</li>
            ";
        }
    }
    $st->close();

    // GET OTHER SPECIAL TRAINING
    $ost = $conn->prepare("SELECT other_special_training from tbl_other_special_training where u_id = ?");
    $ost->bind_param("i", $user_id);
    $ost->execute();
    $ostRes = $ost->get_result();
    if($ostRes->num_rows > 0) {
        $ostRow = $ostRes->fetch_assoc();
        $otherSpecT = $ostRow['other_special_training'];
    }
    $ost->close();

    // GET PRACTICE OF USER
    $practice = $conn->prepare("SELECT practice from tbl_information join tbl_hospital_practice on tbl_information.id = tbl_hospital_practice.information_id join tbl_practice on tbl_hospital_practice.practice_id = tbl_practice.practice_id where id = ? and status = ?");
    $practice->bind_param("ii", $user_id, $status);
    $practice->execute();
    $prac = "";
    $practiceResult = $practice->get_result();
    if($practiceResult->num_rows > 0) {
        while($practiceRow = $practiceResult->fetch_assoc()) {
            $prac = $prac."
                <li>".$practiceRow['practice']."</li>
            ";
        }
    }
    $practice->close();

    // GET OTHER PRACTICE
    $op = $conn->prepare("SELECT other_practice from tbl_other_practice where u_id = ?");
    $op->bind_param("i", $user_id);
    $op->execute();
    $opResult = $op->get_result();
    if($opResult->num_rows > 0) {
        $opRow = $opResult->fetch_assoc();
        $otherPractice = $opRow['other_practice'];
    }
    $op->close();

    // GET CATEGORY OF USER
    $category = $conn->prepare("SELECT category from tbl_information join tbl_hospital_drcategory on tbl_information.id = tbl_hospital_drcategory.information_id join tbl_drcategory on tbl_hospital_drcategory.category_id = tbl_drcategory.catid where id = ? and status = ?");
    $category->bind_param("ii", $user_id, $status);
    $category->execute();
    $categories = "";
    $catResult = $category->get_result();
    if($catResult->num_rows > 0) {
        while($catRow = $catResult->fetch_assoc()) {
            $categories = $categories."
                <li>".ucwords($catRow['category'])."</li>
            ";
        }
    }
    $category->close();

    // GET OTHER CATEGORY
    $oc = $conn->prepare("SELECT category from tbl_other_drcategory where u_id = ?");
    $oc->bind_param("i", $user_id);
    $oc->execute();
    $ocResult = $oc->get_result();
    if($ocResult->num_rows > 0) {
        $ocRow = $ocResult->fetch_assoc();
        $otc = $ocRow['category'];
    }
    $oc->close();


    // GET COUNCIL OF USER
    $council = $conn->prepare("SELECT council from tbl_information join tbl_hospital_council on tbl_information.id = tbl_hospital_council.information_id join tbl_council on tbl_hospital_council.council_id = tbl_council.council_id where id = ? and status = ?");
    $council->bind_param("ii", $user_id, $status);
    $council->execute();
    $councils = "";
    $resultCouncil = $council->get_result();
    if($resultCouncil->num_rows > 0) {
        while($rowCouncil = $resultCouncil->fetch_assoc()) {
            $councils = $councils."
                <li>".ucwords($rowCouncil['council'])."</li>
            ";
        }
    }
    $council->close();

    // GET OTHER COUNCIL
    $otherCouncil = $conn->prepare("SELECT other_council from tbl_other_council where u_id = ?");
    $otherCouncil->bind_param("i", $user_id);
    $otherCouncil->execute();
    $otherCR = $otherCouncil->get_result();
    if($otherCR->num_rows > 0) {
        $rowOtherC = $otherCR->fetch_assoc();
        $otherCnl = $rowOtherC['other_council'];
    }
    $otherCouncil->close();

    // GET COMMITTEE OF USER
    $committee = $conn->prepare("SELECT committee from tbl_information join tbl_hospital_committee on tbl_information.id = tbl_hospital_committee.information_id join tbl_committee on tbl_hospital_committee.cmt_id = tbl_committee.cmt_id where id = ? and status = ?");
    $committee->bind_param("ii", $user_id, $status);
    $committee->execute();
    $cmt = "";
    $resultCmt = $committee->get_result();
    if($resultCmt->num_rows > 0) {
        while($rowCmt = $resultCmt->fetch_assoc()) {
            $cmt = $cmt."
                <li>".ucwords($rowCmt['committee'])."</li>
            ";
        }
    }
    $committee->close();
    
    // GET OTHER COMMITTEE
    $ocmt = $conn->prepare("SELECT other_committee from tbl_other_committee where u_id = ?");
    $ocmt->bind_param("i", $user_id);
    $ocmt->execute();
    $ocmtResult = $ocmt->get_result();
    if($ocmtResult->num_rows > 0) {
        $ocmtRow = $ocmtResult->fetch_assoc();
        $otherCmt = $ocmtRow['other_committee'];
    }
    $ocmt->close();

    // GET CHAPTERS OF USER
    $chapters = $conn->prepare("SELECT chapter from tbl_information join tbl_hospital_chapter on tbl_information.id = tbl_hospital_chapter.information_id join tbl_chapter on tbl_hospital_chapter.chapter_id = tbl_chapter.chapid where id = ? and status = ?");
    $chapters->bind_param("ii", $user_id, $status);
    $chapters->execute();
    $chapter = "";
    $resultChapter = $chapters->get_result();
    if($resultChapter->num_rows > 0) {
        while($rowChapter = $resultChapter->fetch_assoc()) {
            $chapter = $chapter."
                <li>".ucwords($rowChapter['chapter'])."</li>
            ";
        }
    }
    $chapters->close();

    // GET OTHER CHAPTER
    $otCh = $conn->prepare("SELECT other_chapter from tbl_other_chapter where u_id = ?");
    $otCh->bind_param("i", $user_id);
    $otCh->execute();
    $otChResult = $otCh->get_result();
    if($otChResult->num_rows > 0) {
        $rowOtherChapter = $otChResult->fetch_assoc();
        $otherChapter = $rowOtherChapter['other_chapter'];
    }
    $otCh->close();

    // OTHER AFFILIATION
    $oa = $conn->prepare("SELECT * FROM tbl_extrainformation where doctors_id = ? and status = ?");
    $oa->bind_param("ii", $user_id, $status);
    $oa->execute();
    $otherA = "";
    $resultOa = $oa->get_result();
    if($resultOa->num_rows > 0) {
        while($rowOa = $resultOa->fetch_assoc()) {
            $otherA = $otherA."
                <tr>
                    <td>".$rowOa['hospital_aff']."</td>
                    <td>".$rowOa['contact']."</td>
                    <td>".$rowOa['landline']."</td>
                </tr>
            ";
        }
    }
    $oa->close();

    // YEAR AS
    $ya = $conn->prepare("SELECT * from tbl_member_year where id = ?");
    $ya->bind_param("i", $user_id);
    $ya->execute();
    $resultYa = $ya->get_result();
    if($resultYa->num_rows > 0) {
        $rowYa = $resultYa->fetch_assoc();
        $fellow = $rowYa['fellow_year'];
        $lifeFellow = $rowYa['life_fellow_year'];
        $diplomate = $rowYa['diplomate_year'];
        $lifeMember = $rowYa['life_member_year'];
        $associateFellow = $rowYa['associate_fellow'];
        $associate = $rowYa['associate'];
    }
    $ya->close();

    use Dompdf\Dompdf;
    use Dompdf\Options;

    $options = new Options;
    $options->setChroot(__DIR__);
    $options->setIsRemoteEnabled(true);
    $dompdf = new Dompdf($options);
    $dompdf->setPaper("A4", "portrait");

    $html = file_get_contents('pdf-template.php');

    $html = str_replace(
        [
        '{{ picture }}', '{{ firstname }}', '{{ middlename }}', '{{ lastname }}', '{{ suffix }}', '{{ email }}', '{{ mobilenumber }}', '{{ smobilenumber }}', '{{ birthdate }}', '{{ age }}', '{{ gender }}', '{{ prc }}', '{{ pma }}', '{{ medschool }}', '{{ yeargrad }}', '{{ training }}', '{{ yearfin }}', '{{ beneficiary }}', '{{ contact }}', '{{ affiliation }}', '{{ sublist }}', '{{ othersublist }}', '{{ specialtraining }}', '{{ ost }}', '{{ practicelist }}', '{{ optherpractice }}', '{{ categories }}', '{{ othercategory }}', '{{ council }}', '{{ othercouncil }}', '{{ committee }}', '{{ othercommittee }}', '{{ chapter }}', '{{ otherchapter }}', '{{ otheraff }}', '{{ fellow }}', '{{ lifefellow }}', '{{ diplomate }}', '{{ lifemember }}', '{{ associatefellow }}', '{{ associate }}'
        ], 
        [$image, $fname, $mname, $lname, $suffix, $email, $mobile, $smobile, $birthdate, $age, $gender, $prc, $pma, $medSchool, $yearGrad, $training, $yearFin, $beniRow, $contact, $affiliate, $sub, $otherSubspecialty, $specT, $otherSpecT, $prac, $otherPractice, $categories, $otc, $councils, $otherCnl, $cmt, $otherCmt, $chapter, $otherChapter, $otherA, $fellow, $lifeFellow, $diplomate, $lifeMember, $associateFellow, $associate],
        $html);

    $dompdf->loadHtml($html);
 
    $dompdf->render();

    $dompdf->stream(time(), ["Attachment" => 0]);
?>
