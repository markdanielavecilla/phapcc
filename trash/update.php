<?php
    include_once('connection.php');
    include './action.php';
    // include "./actions/update-action.php";
    $id = $_GET['id'];
    // $page = $_GET['page'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"/>
    <link rel="stylesheet" href="./index.css">
    <title>Update information</title>
</head>
<body>
    <nav>
        <a href="#"><img src="../images/phalogohd.png" alt="PHA Logo"></a>
        <div class="navi-links">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="members.php">Members</a></li>
                <li><a href="view.php?id=<?= $id ?>">Go Back</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <?= $message ?>
            </div>
        </div>
        <h1>Update Information</h1>
        <form method="POST" enctype="multipart/form-data">
            <?php 
                $sql = "SELECT * FROM tbl_information
                    INNER JOIN tbl_school ON tbl_information.id = tbl_school.docid
                    INNER JOIN tbl_hospital ON tbl_information.id = tbl_hospital.doctor_id
                    INNER JOIN tbl_member_year ON tbl_information.id = tbl_member_year.id
                    WHERE tbl_information.id = $id";

                $result = $conn->query($sql) or die($conn->error);
                if($result->num_rows > 0){
                    $rows = $result->fetch_assoc();
                    $_SESSION['hospital_aff'] = $rows['hospital_affiliation'];
                    $_SESSION['contact'] = $rows['contactno'];
                    $_SESSION['landline'] = $rows['landlineno'];
                    $_SESSION['current_image'] = $rows['image_url'];
                
            ?>
            <div class="row">
                <div class="col d-flex justify-content-center mb-3">
                    <img 
                        src="../images/uploads/<?= $rows['image_url'] ? $rows['image_url'] : 'phalogohd.png'?>" 
                        id="update_imgPreview" 
                        name="update_imgPreview"
                    >

                    <input 
                        type="file" 
                        name="update_file" 
                        id="update_imageUpload"
                        style="display: none"
                    >
                </div>
                
                <hr/>

                <!-- FIRST NAME -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input 
                            type="text" 
                            class="form-control <?= ($errFname) ? 'is-invalid':''  ?>" 
                            placeholder="First name" 
                            name="updateFname" 
                            value="<?php echo $rows['first_name']?>" 
                        >
                        <label for="first name" class="form-label">First name</label>
                        <span class="invalid-feedback"><?= $errFname ?></span>
                    </div>
                </div>

                <!-- MIDDLE NAME -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Middle name" 
                            name="updateMname" 
                            value="<?php echo $rows['middle_name']?>"
                        >
                        <label for="Middle Name" class="form-label">Middle ame</label>
                    </div>
                </div>

                <!-- LAST NAME -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Last name" 
                            name="updateLname" 
                            value="<?php echo $rows['last_name']?>"
                        >
                        <label for="Last name" class="form-label">Last name</label>
                    </div>
                </div>

                <!-- SUFFIX -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Suffix" 
                            name="updateSuffix" 
                            value="<?php echo $rows['suffix']?>"
                        >
                        <label for="Suffix" class="form-label">Suffix</label>
                    </div>
                </div>
            </div>
                            
            <!-- GENDER -->
            <div class="row">
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <select 
                            name="updateGender" 
                            id="updateGender" 
                            class="form-select"
                        >
                            <option 
                                value="Male" <?php if($rows['gender']=="Male"){echo "selected";} ?>>Male
                            </option>
                            <option 
                                value="Female" <?php if($rows['gender']=="Female"){echo "selected";} ?>>Female
                            </option>

                        </select>
                        <label for="Gender" class="form-label">Gender</label>
                    </div>
                </div>

                <!-- MOBILE NUMBER -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input 
                            type="number" 
                            placeholder="Mobile Number" 
                            name="updateMobile" 
                            class="form-control" 
                            value="<?php echo $rows['mobile_number']?>"
                        >
                        <label for="Mobile number" class="form-label">Mobile Number</label>
                    </div>
                </div>

                <!-- OTHER MOBILE NUMBER -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input 
                            type="number" 
                            name="updateSecondMobile" 
                            class="form-control" placeholder="Second mobile number" 
                            value="<?= $rows['second_mobile_number']?>"
                        >
                        <label for="Second Mobile number" class="form-label">Second mobile number</label>
                    </div>
                </div>

                <!-- EMAIL -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input 
                            type="text" 
                            placeholder="Email" 
                            name="updateEmail" 
                            class="form-control" 
                            value="<?php echo $rows['email']?>"
                        >
                        <label for="Email" class="form-label">Email</label>
                    </div>
                </div>
            </div>

            <!-- PRC NUMBER -->
            <div class="row">
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input 
                            type="number" 
                            placeholder="PRC No" 
                            name="updatePRC" 
                            class="form-control" 
                            value="<?php echo $rows['prcno']?>"
                        >
                        <label for="PRC No" class="form-label">PRC No.</label>
                    </div>
                </div>

                <!-- PMA NUMBER -->
                <div class="col-3">
                    <div class="form-floating mt-1 mb-3">
                        <input 
                            type="text" 
                            placeholder="PMA No" 
                            name="updatePMA" 
                            class="form-control" 
                            value="<?php echo $rows['pmano']?>"
                        >
                        <label for="PMA No" class="form-label">PMA No.</label>
                    </div>
                </div>
                
                <!-- DECEASED -->
                <div class="col-3">
                    <div class="form-floating mt-1 mb-3">
                        <select name="updateDeceased" id="updateDeceased" class="form-select">
                            <option value="No" <?php if($rows['deceased'] == "No" || $rows['deceased'] == "no"){echo "selected"; } ?>>No</option>
                            <option value="Yes" <?php if($rows['deceased'] == "Yes" || $rows['deceased'] == "yes"){echo "selected"; } ?> >Yes</option>
                        </select>
                        <label for="Deceased" class="form-label">Deceased</label>
                    </div>
                </div>
            </div>

            <!-- BIRTHDAY -->
            <div class="row">
                <h4>Birthdate</h4>
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <select name="updateMonth" id="updateMonth" class="form-select">
                            <?php 
                                $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                                // $birthday = $rows['birthday'];
                                // list($bmonth, $day, $year) = explode("/", $birthday);
                                // echo $bmonth;
                                $bmonth = $rows['birth_month'];
                                $day = $rows['birth_day'];
                                $year = $rows['birth_year'];
                                
                                foreach($months as $month => $val){
                                    $selected = '';
                                    if($bmonth == $month+1) $selected = "selected";
                            ?>
                                <option value="<?php echo $month+1 ?>" <?php echo $selected  ?> ><?php echo $val;?></option>
                            <?php  } ?>
                        </select>
                        <label for="Month" class="form-label">Month</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <select name="updateDay" id="updateDay" class="form-select">
                            <?php
                                for($i = 1; $i <= 31; $i++){ 
                                    $selected = '';
                                    if($day == $i) $selected = "selected";                   
                            ?>
                                <option value="<?php echo $i?>" <?php echo $selected?> ><?php echo $i ?></option>
                            <?php } ?>
                        </select>
                        <label for="Day" class="form-label">Day</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <select name="updateYear" id="updateYear" class="form-select">
                            <?php
                                for($i = date("Y"); $i > 1900; $i--){
                                    $selected = '';
                                    if($year == $i) $selected = 'selected';
                            ?>
                                <option value="<?php echo $i?>" <?php echo $selected?> ><?php echo $i?></option>
                            <?php } ?>
                        </select>
                        <label for="updateYear" class="form-label">Year</label>
                    </div>
                </div>

                <!-- AGE -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="number" placeholder="age" id="updateAge" name="updateAge" readonly class="form-control" value="<?php echo $rows['age']?>">
                        <label for="Age" class="form-label">Age</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <h4>School</h4>
                
                <!-- MEDICAL SCHOOL -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="text" placeholder="Medical school" name="updateSchool" class="form-control" value="<?php echo $rows['medical_school']?>">
                        <label for="school" class="form-label">Medical School</label>
                    </div>
                </div>

                <!-- YEAR GRADUATED -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="number" name="updateSY" placeholder="year" class="form-control" value="<?php echo $rows['year_graduated']?>">
                        <label for="Year graduated" class="form-label">Year Graduated</label>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- TRAINING INSTITUTION -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="text" placeholder="Training institution" name="updateSchooltrained" class="form-control" id="updateSchoolTrained" value="<?php echo $rows['training_school']?>" >
                        <label for="Training Institution" class="form-label">Training Institution</label>
                    </div>
                </div>
                
                <!-- YEAR FINISHED -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="number" placeholder="Year finish" name="updateYearFinish" id="updateYearFinish" class="form-control" value="<?php echo $rows['year_finish']?>">
                        <label for="year finish" class="form-label">Year Finish</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <h2>Hospital Information</h2>
                <hr/>

                <!-- HOSPITAL AFFILIATION -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="text" name="updateHospital" placeholder="Hospital Affiliation" class="form-control" value="<?php echo $rows['hospital_affiliation']?>">
                        <label for="Hospital Affiliation" class="form-label">Hospital Affiliation</label> 
                    </div>
                </div>

                <!-- CITY / PROVINCE -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="text" name="updatedCP" placeholder="City/Province" class="form-control" value="<?php echo $rows['cityprovince']?>">
                        <label for="cityProvince" class="form-label">City/Province</label>
                    </div>
                </div>

                <!-- CONTACT NUMBER -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="number" name="updateContact" placeholder="Contact No." class="form-control" value="<?php echo $rows['contactno']?>">
                        <label for="ContactNo" class="form-label">Contact No.</label>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- LANDLINE NUMBER -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="text" name="updateLandline" placeholder="Landline No." class="form-control" value="<?php echo $rows['landlineno']?>">
                        <label for="Landline" class="form-label">Landline No.</label>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- HOME ADDRESS -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="text" name="updateHomeAddress" placeholder="Home Address" class="form-control" value="<?php echo $rows['home_address']?>">
                        <label for="be" class="form-label">Home Address</label>
                    </div>
                </div>

                <!-- PRINCIPAL OFFICE -->
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="text" name="updatedPrincipaloffice" placeholder="principal office" class="form-control" value="<?php echo $rows['principal_office']?>">
                        <label for="Principal office" class="form-label">Principal Office</label>
                    </div>
                </div>

                <!-- INTERNATIONAL AFFILIATION -->
                <div class="col-4">
                    <div class="form-floating mt-1 mb-3">
                        <input type="text" name="update_int_society" placeholder="International Society" class="form-control" value="<?= $rows['international_affiliation'] ?>">
                        <label for="International_society">International Society</label>
                    </div>
                </div>
            </div>

            

            <!-- CATEGORY -->
            <div class="row">
                <div class="col">
                    <div class="input-group mt-1 mb-3">
                        <div class="input-group-text">
                            <label class="form-label" for="Category">Category</label>
                        </div>
                        <?php
                            $sql = "SELECT * FROM tbl_hospital_drcategory WHERE information_id = $id";
                            $result = $conn->query($sql) or die($conn->error);
                            // $row = $result->fetch_assoc();
                            $category = array();
                            while($row = $result->fetch_assoc()){
                                $category[] = $row['category_id'];
                            }
                            
                        ?>
                        <select 
                            name="updateCategory[]" 
                            id="updateCategory" 
                            multiple 
                            class="form-select my-select"
                            data-selected-text-format="count > 2"
                        >
                            <?php
                                $sql = "SELECT * FROM tbl_drcategory";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0):
                                    while($row = $result->fetch_assoc()):
                            ?>

                            <option value="<?php echo $row['catid']?>" <?= in_array($row['catid'], $category) ? 'selected':'' ?> ><?php echo ucwords($row['category']) ?></option>
                            <?php
                                    endwhile;
                                endif;
                            ?>
                        </select>
                    </div>  
                </div>

                <div class="col">
                    <div class="input-group mt-1 mb-3">
                        <div class="input-group-text">
                            <input 
                                type="checkbox" 
                                name="update_other_category" 
                                id="update_other_category" 
                                class="form-check-input"
                            > &nbsp; Other category
                        </div>

                        <input 
                            type="text" 
                            name="update_other_cat" 
                            id="update_other_cat" 
                            class="form-control"
                            placeholder="Other category"
                            disabled
                        >
                    </div>
                </div>
            </div>

            <!-- CHAPTER -->
            <div class="row">
                <div class="col">
                    <div class="input-group mt-1 mb-3">
                        <div class="input-group-text">
                            <label for="Chapter" class="form-label">Chapter</label>
                        </div>
                        <?php
                            $sql = "SELECT * FROM tbl_hospital_chapter WHERE information_id = $id";
                            $result = $conn->query($sql) or die($conn->error);
                            $chapter = array();
                            while($row = $result->fetch_assoc()){
                                $chapter[] = $row['chapter_id'];
                            }
                        ?>
                        <select 
                            name="updateChapter[]" 
                            id="updateChapter" 
                            multiple 
                            class="form-select my-select"
                            data-selected-text-format="count > 2"
                        >
                            <?php 
                                $sql = "SELECT * FROM tbl_chapter";
                                $result = $conn->query($sql) or die($conn->error);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                            ?>
                            <option value="<?php echo $row['chapid'] ?>" <?= in_array($row['chapid'], $chapter) ? 'selected':'' ?> ><?php echo ucwords($row['chapter']) ?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="input-group mt-1 mb-3">
                        <div class="input-group-text">
                            <input 
                                type="checkbox" 
                                name="update_other_chapter" 
                                id="update_other_chapter" 
                                class="form-check-input"
                            > &nbsp; Other Chapter
                        </div>

                        <input 
                            type="text" 
                            name="update_other_chap" 
                            id="update_other_chap" 
                            placeholder="Other chapter" 
                            class="form-control"
                            disabled
                        >
                    </div>
                </div>
            </div>

            <!-- SUBSPECIALTY -->
            <div class="row">
                <div class="col">
                    <div class="input-group mt-1 mb-3">
                        <div class="input-group-text">
                            <label for="subspecialty" class="form-label">Subspecialty</label>
                        </div>
                        <?php
                            $sql = "SELECT * FROM tbl_hospital_subspecialty WHERE information_id = $id";
                            $result = $conn->query($sql) or die($conn->error);
                            $subspecialty = array();
                            while($row = $result->fetch_assoc()){
                                $subspecialty[] = $row['subspecialty_id'];
                            }
                        ?>
                        <select 
                            name="update_subspecialty[]" 
                            id="update_subspecialty" 
                            multiple 
                            class="form-select my-select"
                            data-selected-text-format="count > 2"
                        >
                            <?php
                                $sql = "SELECT * FROM tbl_subspecialty";
                                $result = $conn->query($sql) or die($conn->error);
                                if($result->num_rows > 0) :
                                    while($row = $result->fetch_assoc()) :
                            ?>
                            <option 
                                value="<?= $row['sub_id']?>" 
                                <?= in_array($row['sub_id'], $subspecialty) ? 'selected':'' ?>
                            >
                                <?= ucwords($row['subspecialty']) ?>
                            </option>
                            <?php
                                    endwhile;
                                endif;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="input-group mt-1 mb-3">
                        <div class="input-group-text">
                            <input 
                                type="checkbox" 
                                name="update_other_subspecialty" 
                                id="update_other_subspecialty" 
                                class="form-check-input"
                            > &nbsp; Other subspecialty
                        </div>

                        <input 
                            type="text" 
                            name="update_other_sub" 
                            id="update_other_sub" 
                            class="form-control"
                            placeholder="Other subspecialty"
                            disabled
                        >
                    </div>
                </div>
            </div>

            <!-- PRACTICE -->
            <div class="row">
                <div class="col">
                    <div class="input-group mt-1 mb-3">
                        <div class="input-group-text">
                            <label for="Practice" class="form-label">Practice</label>
                        </div>
                        <?php
                            $sql = "SELECT * FROM tbl_hospital_practice WHERE information_id = $id";
                            $result = $conn->query($sql) or die($conn->error);
                            $practice = array();
                            while($row = $result->fetch_assoc()){
                                $practice[] = $row['practice_id'];
                            }
                        ?>
                        <select 
                            name="updatePractice[]" 
                            id="updatePractice" 
                            multiple 
                            class="form-select my-select"
                            data-selected-text-format="count > 2"
                        >
                            <?php
                                $sql = "SELECT * FROM tbl_practice";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0) :
                                    while($row = $result->fetch_assoc()) :
                            ?>
                                <option value="<?= $row['practice_id'] ?>" <?= in_array($row['practice_id'], $practice) ? 'selected':'' ?> ><?= ucwords($row['practice']) ?></option>
                            <?php
                                    endwhile; 
                                endif;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="input-group mt-1 mb-3">
                        <div class="input-group-text">
                            <input 
                                type="checkbox" 
                                name="update_other_practice" 
                                id="update_other_practice" 
                                class="form-check-input"
                            > &nbsp; Other practice
                        </div>

                        <input 
                            type="text" 
                            name="update_other_practices" 
                            id="update_other_practices" 
                            class="form-control"
                            placeholder="Other practice"
                            disabled
                        >
                    </div>
                </div>
            </div>

            <!-- SPECIAL TRAINING -->
            <div class="row">
                <div class="col">
                    <div class="input-group mt-1 mb-3">
                        <div class="input-group-text">
                            <label for="special-training" class="form-label">Special Training</label>
                        </div>
                        <?php
                            $stmt = $conn->prepare("SELECT * FROM tbl_hospital_special_training WHERE information_id = ?");
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $special_t = array();
                            while($row = $result->fetch_assoc()) :
                                $special_t[] = $row['special_training_id'];
                            endwhile;
                        ?>
                        <select 
                            name="updateSpecialTraining[]" 
                            id="updateSpecialTraining" 
                            multiple 
                            class="form-select my-select"
                            data-selected-text-format="count > 2"
                        >
                            <?php
                                $stmt = $conn->prepare("SELECT * FROM tbl_special_training");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if($result->num_rows > 0) :
                                    while($row = $result->fetch_assoc()) :
                            ?>
                                <option value="<?= $row['st_id'] ?>" <?= in_array($row['st_id'], $special_t) ? 'selected':'' ?> ><?= ucwords($row['special_training']) ?></option>
                            <?php
                                    endwhile; 
                                endif;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="input-group mt-1 mb-3">
                        <div class="input-group-text">
                            <input 
                                type="checkbox"  
                                id="update_other_special_training" 
                                class="form-check-input"
                            > &nbsp; Other..
                        </div>

                        <input 
                            type="text" 
                            name="upOtherSpecialTraining" 
                            id="upOtherSpecialTraining"
                            class="form-control"
                            placeholder="Special training"
                            disabled
                        >
                    </div>
                </div>
            </div>

            <!-- COUNCIL -->
            <div class="row">
                <div class="col">
                    <div class="input-group mt-1 mb-3">
                        <div class="input-group-text">
                            <label for="council" class="form-label">Council</label>
                        </div>
                        <?php
                            $stmt = $conn->prepare("SELECT * FROM tbl_hospital_council WHERE information_id = ?");
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $council = array();
                            while($row = $result->fetch_assoc()) :
                                $council[] = $row['council_id'];
                            endwhile;
                        ?>
                        <select 
                            name="updateCouncil[]" 
                            id="updateCouncil" 
                            multiple 
                            class="form-select my-select"
                            data-selected-text-format="count > 2"
                        >
                            <?php
                                $stmt = $conn->prepare("SELECT * FROM tbl_council");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if($result->num_rows > 0) :
                                    while($row = $result->fetch_assoc()) :
                            ?>
                                <option value="<?= $row['council_id'] ?>" <?= in_array($row['council_id'], $council) ? 'selected':'' ?> ><?= ucwords($row['council']) ?></option>
                            <?php
                                    endwhile; 
                                endif;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="input-group mt-1 mb-3">
                        <div class="input-group-text">
                            <input 
                                type="checkbox"  
                                id="update_other_council" 
                                class="form-check-input"
                            > &nbsp; Other..
                        </div>

                        <input 
                            type="text" 
                            name="updateOtherCouncil"
                            id="updateOtherCouncil" 
                            class="form-control"
                            placeholder="Council"
                            disabled
                        >
                    </div>
                </div>
            </div>

            <!-- COMMITTEE -->
            <div class="row">
                <div class="col">
                    <div class="input-group mt-1 mb-3">
                        <div class="input-group-text">
                            <label for="committee" class="form-label">Committee</label>
                        </div>
                        <?php
                            $stmt = $conn->prepare("SELECT * FROM tbl_hospital_committee WHERE information_id = ?");
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $committee = array();
                            while($row = $result->fetch_assoc()) :
                                $committee[] = $row['cmt_id'];
                            endwhile;
                        ?>
                        <select 
                            name="updateCommittee[]" 
                            id="updateCommittee" 
                            multiple 
                            class="form-select my-select"
                            data-selected-text-format="count > 2"
                        >
                            <?php
                                $stmt = $conn->prepare("SELECT * FROM tbl_committee");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if($result->num_rows > 0) :
                                    while($row = $result->fetch_assoc()) :
                            ?>
                                <option value="<?= $row['cmt_id'] ?>" <?= in_array($row['cmt_id'], $committee) ? 'selected':'' ?> ><?= ucwords($row['committee']) ?></option>
                            <?php
                                    endwhile; 
                                endif;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="input-group mt-1 mb-3">
                        <div class="input-group-text">
                            <input 
                                type="checkbox"  
                                id="update_other_committee" 
                                class="form-check-input"
                            > &nbsp; Other..
                        </div>

                        <input 
                            type="text" 
                            name="updateOtherCommittee"
                            id="updateOtherCommittee"
                            class="form-control"
                            placeholder="Committee"
                            disabled
                        >
                    </div>
                </div>
            </div>

            <hr/>

            <div class="row">
                <h2>Year as</h2>
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="number" name="updateFellow" placeholder="Fellow" class="form-control" value="<?= ($rows['fellow_year'] == 0) ? '': $rows['fellow_year']  ?>">
                        <label for="Fellow" class="form-label">Fellow</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="number" name="updateLifeFellow" placeholder="Life fellow" class="form-control" value="<?= ($rows['life_fellow_year'] == 0) ? '': $rows['life_fellow_year'] ?>">
                        <label for="Life Fellow">Life fellow</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="number" placeholder="Diplomate" name="updateDiplomate" class="form-control" value="<?= ($rows['diplomate_year'] == 0) ? '': $rows['diplomate_year'] ?>">
                        <label for="Diplomate">Diplomate</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="number" name="updateLifeMember" placeholder="Life member" class="form-control" value="<?= ($rows['life_member_year'] == 0)? '': $rows['life_member_year'] ?>">
                        <label for="Life member">Life member</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="number" name="updateAssociateFellow" placeholder="Associate fellow" class="form-control" value="<?= ($rows['associate_fellow'] == 0)? '': $rows['associate_fellow']  ?>">
                        <label for="associate fellow">Associate fellow</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input type="number" name="updateAssociate" placeholder="Associate" class="form-control" value="<?= ($rows['associate'] == 0) ? '' : $rows['associate'] ?>">
                        <label for="associate">Associate</label>
                    </div>
                </div>
            </div>
            <hr/>
            <?php } ?>
            <div class="row justify-content-md-end">
                <div class="col-lg-1 mb-3">
                    <input type="submit" class="body-btn" name="update" id="update" value="Save">  
                </div>
            </div>
        </form>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
    <script src="index.js"></script>
</body>
</html>