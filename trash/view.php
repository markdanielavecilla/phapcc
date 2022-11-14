<?php
    ob_start();
    include_once('connection.php');
    session_start();
    if(isset($_GET['id'])) :
        $id = $_GET['id'];
        $_SESSION['id'] = $id;
        $stmt = $conn->prepare("SELECT * FROM tbl_information 
            INNER JOIN tbl_school ON tbl_information.id = tbl_school.docid 
            INNER JOIN tbl_hospital ON tbl_information.id = tbl_hospital.doctor_id 
            INNER JOIN tbl_member_year ON tbl_information.id = tbl_member_year.id 
            WHERE tbl_information.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $result ? $rows = $result->fetch_assoc() : die($stmt->error);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./index.css">
    <title>Document</title>
</head>
<body>
    
    <nav>
        <a href="#"><img src="../images/phalogohd.png" alt="PHA Logo"></a>
        <div class="navi-links">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="members.php">Members</a></li>
                <li><a href="update.php?id=<?= $id ?>">Update</a></li>
                <li><a href="excel.php?id=<?= $_GET['id'] ?>">Download</a></li>
            </ul>
        </div>
    </nav>

    <section class="personal-information">
        <div class="wrapper grid grid-2">
            <img 
                src="../images/uploads/<?= $rows['image_url'] ? $rows['image_url']:'phalogohd.png' ?>" 
                alt="<?= $rows['first_name'] ?>"
            >
            <div class="grid grid-2">
                <div>
                    <h1>Information</h1>
                    <p class="text-capitalize">
                        <b>name:</b> <?= $rows['first_name']?> <?= $rows['middle_name']?> <?= $rows['last_name']?> <?= $rows['suffix'] ? $rows['suffix'].'.' : '' ?>
                    </p>
                    <p>
                        <span class="text-capitalize"><b>email:</b> </span> <?= $rows['email']?>
                    </p>
                    <p class="text-capitalize">
                        <b>mobile number:</b> <?= $rows['mobile_number']?>
                    </p>
                    <p class="text-capitalize">
                        <b>mobile number 2:</b> <?= $rows['second_mobile_number']? $rows['second_mobile_number'] : 'N/A' ?>
                    </p>
                    <p class="text-capitalize">
                        <b>birthdate (MM/DD/YYYY):</b> 
                        <?php 
                            $birth_month = $rows['birth_month'];
                            $birth_day = $rows['birth_day'];
                            $birth_year = $rows['birth_year'];
                            echo "$birth_month/$birth_day/$birth_year";
                            // $bdate = strtotime($rows['birthday']);
                            // $format = date("F d, Y", $bdate);
                            // echo $format;
                        ?>
                    </p>
                </div>
                <div style="margin-top: 2.5rem">
                    <p class="text-capitalize">
                        <b>age:</b> <?= $rows['age']?>
                    </p>
                    <p class="text-capitalize">
                        <b>deceased:</b> <?= $rows['deceased']?>
                    </p>
                    <p class="text-uppercase">
                        <b>prc #:</b> <?= $rows['prcno']?>
                    </p>
                    <p class="text-uppercase">
                        <b>pma #:</b> <?= $rows['pmano'] ? $rows['pmano']: 'N/A' ?>
                    </p>
                    <p class="text-capitalize">
                        <b>gender:</b> <?= $rows['gender']?>
                    </p>    
                </div>
            </div>
        </div>
    </section>

    <!-- SCHOOL -->
    <section>
        <div class="container">
            <hr/>
            <div class="row mt-3 mb-3">

                <h2>School</h2>
                
                <div class="col">

                    <p class="text-capitalize">
                        <b>medical school:</b> <?= $rows['medical_school']?>
                    </p>

                    <p class="text-capitalize">
                        <b>year graduated:</b> <?= $rows['year_graduated']?>
                    </p>

                </div>
    
                <div class="col">

                    <p class="text-capitalize">
                        <b>training school:</b> <?= $rows['training_school']?>
                    </p>

                    <p class="text-capitalize">
                        <b>year graduated:</b> <?= $rows['year_finish']?>
                    </p>

                </div>
            </div>
    
            <hr/>

            <!-- CONTACT PERSON IN CASE OF EMERGENCY -->

            <?php
                $stmt = $conn->prepare("SELECT * FROM tbl_contact_person WHERE dr_id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                while($rows3 = $result->fetch_assoc()) :
            ?>

            <div class="row mt-3">
                <h2>Contact person in case of EMERGENCY</h2>
                <div class="col">
                    <p class="text-capitalize">
                        <strong>name:</strong> <?= $rows3['cp_first_name'].' '.$rows3['cp_middle_name'].' '.$rows3['cp_last_name'] ?> <br/>
                        <strong>mobile #:</strong> <?= $rows3['cp_mobile_number'] ?>
                    </p>
                </div>
            </div>

            <?php endwhile; ?>

            <hr/>
            <!-- BENEFICIARIES -->
            <div class="row mt-3 mb-3">
                <h2>Beneficiaries</h2>
                <div class="col">
                    <table class="table table-bordered border-secondary text-center">
                        <thead>
                            <th>Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                                $stmt = $conn->prepare("SELECT * FROM tbl_beneficiaries INNER JOIN tbl_information ON tbl_beneficiaries.dr_id = tbl_information.id WHERE dr_id = ?");
                                $stmt->bind_param("i", $id);
                                $stmt->execute();
                                $result2 = $stmt->get_result();
                                while($rows2 = $result2->fetch_assoc()) :
                                    $_SESSION['beneficiary_id'] = $rows2['dr_id'];
                            ?>
                            <tr>
                                <td>
                                    <?= ucfirst($rows2['ben_first_name']) ?>
                                    <?= ucfirst($rows2['ben_middle_name']) ?>
                                    <?= ucfirst($rows2['ben_last_name']) ?>
                                    <?= $rows2['ben_suffix'] ? ucfirst($rows2['ben_suffix']).'.':'' ?>
                                </td>
                                <td>
                                    <a href="edit-beneficiaries.php?ben_id=<?= $rows2['ben_id'] ?>" class="small-button">Edit</a>
                                    <button class="small-button">Delete</button>
                                </td>
                            </tr>
                            <?php
                                endwhile;
                                $stmt->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr/>
            <!-- AFFILIATION -->
            <div class="row mt-3 mb-3">
                <h2>Affiliation</h2>
                <div class="col">
                    <p class="text-capitalize">
                        <b>hospital affiliation:</b> <?= $rows['hospital_affiliation']?>
                    </p>
                    <p class="text-capitalize">
                        <b>contact #:</b> <?= $rows['contactno']?>
                    </p>
                    <p class="text-capitalize">
                        <b>Landline #:</b> <?= $rows['landlineno']?>
                    </p> 
                    <p class="text-capitalize">
                        <b>city/Province:</b> <?= $rows['cityprovince']?>
                    </p>
                    <p class="text-capitalize">
                        <b>home address:</b> <?= $rows['home_address']?>
                    </p>
                    <p class="text-capitalize">
                        <b>principal office:</b> <?= $rows['principal_office']?>
                    </p>
                    <!-- <a 
                        href="javascript:void(0)" 
                        data-bs-toggle="modal" 
                        data-bs-target="#historyModal" 
                        class="body-btn"
                    >View History</a> -->
                </div>
    
                <div 
                    class="modal fade modal-dialog-scrollable" 
                    id="historyModal"
                    tabindex="-1"
                    aria-hidden="true"
                >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Hospital Affiliation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col">
                    <?php
                        $sql = "SELECT *, 
                                GROUP_CONCAT(DISTINCT tbl_subspecialty.subspecialty SEPARATOR ', ') as sub_list,
                                GROUP_CONCAT(DISTINCT tbl_practice.practice SEPARATOR ', ') as practice_list,
                                GROUP_CONCAT(DISTINCT tbl_drcategory.category SEPARATOR ', ') as category_list,
                                GROUP_CONCAT(DISTINCT tbl_chapter.chapter SEPARATOR ', ') as chapter_list,
                                GROUP_CONCAT(DISTINCT tbl_special_training.special_training SEPARATOR ', ') as special_training_list,
                                GROUP_CONCAT(DISTINCT tbl_council.council SEPARATOR ', ') as council_list,
                                GROUP_CONCAT(DISTINCT tbl_committee.committee SEPARATOR ', ') as committee_list
                                FROM tbl_information
                                INNER JOIN tbl_hospital_subspecialty ON tbl_information.id = tbl_hospital_subspecialty.information_id
                                INNER JOIN tbl_subspecialty ON tbl_hospital_subspecialty.subspecialty_id = tbl_subspecialty.sub_id
                                INNER JOIN tbl_hospital_practice ON tbl_information.id = tbl_hospital_practice.information_id
                                INNER JOIN tbl_practice On tbl_hospital_practice.practice_id = tbl_practice.practice_id
                                INNER JOIN tbl_hospital_drcategory ON tbl_information.id = tbl_hospital_drcategory.information_id
                                INNER JOIN tbl_drcategory ON tbl_hospital_drcategory.category_id = tbl_drcategory.catid
                                INNER JOIN tbl_hospital_chapter ON tbl_information.id = tbl_hospital_chapter.information_id
                                INNER JOIN tbl_chapter ON tbl_hospital_chapter.chapter_id = tbl_chapter.chapid
                                INNER JOIN tbl_hospital_special_training ON tbl_information.id = tbl_hospital_special_training.information_id
                                INNER JOIN tbl_special_training ON tbl_hospital_special_training.special_training_id = tbl_special_training.st_id
                                INNER JOIN tbl_hospital_council ON tbl_information.id = tbl_hospital_council.information_id
                                INNER JOIN tbl_council ON tbl_hospital_council.council_id = tbl_council.council_id
                                INNER JOIN tbl_hospital_committee ON tbl_information.id = tbl_hospital_committee.information_id
                                INNER JOIN tbl_committee ON tbl_hospital_committee.cmt_id = tbl_committee.cmt_id
                                WHERE tbl_information.id = $id
                                ";
                                $res = $conn->query($sql) or die($conn->error);
                                while($rows1 = $res->fetch_assoc()) :
                    ?>
                    <p class="text-capitalize">
                        <strong>subspecialty:</strong> <?= $rows1['sub_list']?>
                    </p>

                    <p class="text-capitalize">
                        <strong>special training:</strong> <?= $rows1['special_training_list'] ?>
                    </p>

                    <p class="text-capitalize">
                        <strong>practice:</strong> <?= $rows1['practice_list']?>
                    </p>
                    
                    <p class="text-capitalize">
                        <strong>category:</strong> <?= $rows1['category_list']?>
                    </p>

                    <p>
                        <strong class="text-capitalize">council:</strong> <?= $rows1['council_list'] ?>
                    </p>

                    <p class="text-capitalize">
                        <strong>committee:</strong> <?= $rows1['committee_list'] ?>
                    </p>

                    <p class="text-capitalize">
                        <strong>international society:</strong> <?= $rows['international_affiliation'] ?>
                    </p>

                    <p class="text-capitalize">
                        <strong>chapter:</strong> <?= $rows1['chapter_list']?>
                    </p>
                </div>
                <?php endwhile ?>
            </div>
            
            <hr/>
    
            <div class="row mt-3 mb-3">
                <h2>Year as</h2>

                <div class="col">

                    <p class="text-capitalize">
                        <strong>fellow:</strong>
                        <?= $rows['fellow_year'] ? $rows['fellow_year'] : 'N/A' ?>
                    </p>

                    <p class="text-capitalize">
                        <strong>life fellow:</strong>
                        <?= $rows['life_fellow_year'] ? $rows['life_fellow_year'] : 'N/A' ?>
                    </p>

                    <p class="text-capitalize">
                        <strong>diplomate:</strong>
                        <?= $rows['diplomate_year'] ? $rows['diplomate_year'] : 'N/A' ?>
                    </p>

                    <p class="text-capitalize">
                        <strong>life member:</strong>
                        <?= $rows['life_member_year'] ? $rows['life_member_year'] : 'N/A' ?>
                    </p>

                    <p class="text-capitalize">
                        <strong>associate fellow:</strong>
                        <?= $rows['associate_fellow'] ? $rows['associate_fellow'] : 'N/A' ?>
                    </p>

                    <p class="text-capitalize">
                        <strong>associate</strong>
                        <?= $rows['associate'] ? $rows['associate'] : 'N/A' ?>
                    </p>

                </div>
            </div>
    
            <hr/>
    
            <div class="row mt-3 mb-3">
                <div class="col">
                    <?php 
                        include "../actions/additional-information-action.php";
                        if($result->num_rows > 0) : 
                    ?>
                    <h2>More Information</h2>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Hospital Affiliation</th>
                                    <th>Contact</th>
                                    <th>Landline</th>
                                    <th>Email</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($rows1 as $row1) : ?>
                                    <tr>
                                        <td><?= ucfirst($row1['hospital_aff']) ?></td>
                                        <td><?= ucfirst($row1['contact']) ?></td>
                                        <td><?= ucfirst($row1['landline']) ?></td>
                                        <td><?= $row1['email'] ?></td>
                                        <td class="text-center">
                                            <a href="edit-extrainformation.php?id=<?= $row1['id'] ?>&drId=<?= $row1['doctors_id'] ?>" class="small-button">Edit</a>
                                            <a href="./actions/delete-extrainfo.php?id=<?= $row1['id'] ?>&drId=<?= $row1['doctors_id'] ?>" name="delete_info" class="small-button">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <hr/>
                        <?php endif; ?>
                </div>
            </div>
    
            <div class="row justify-content-md-end mb-3">
                <div class="col">
                    <a class="body-btn" href="additionalinfo.php?id=<?= $rows['id'] ?>" >Add more info</a>
                    
                </div>
            </div>
    
            <hr/>
            
            <div class="row mt-3 mb-3">
                <h2>Additional Files</h2>
                <div class="col mt-3">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="file" id="addFiles" name="addFiles[]" id="addFiles" multiple>
                        <input type="submit" id="submitFile" name="submitFile" class="body-btn" value="Upload">
                    </form>       
                </div>
            </div>
            <hr/>
            <div class="row mt-3 mb-3">
                <?php 
                        $sql = "SELECT * FROM tbl_files WHERE file_owner_id = $id";
                        $res1 = $conn->query($sql) or die($conn->error);
                        $row2 = $res1->fetch_all(MYSQLI_ASSOC);
                        if($res1->num_rows > 0) :
                ?>
                <h2>Files</h2>
                <div class="col">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>File name</th>
                                <th>Date</th>
                                <th>Download</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($row2 as $r) :
                            ?>
                            <tr>
                                <td><?= $r['file_title'] ?></td>
                                <td>Date</td>
                                <td>
                                    <!-- <a href="./viewPdf.php?v=<?= $r['file_title'] ?>">View</a> -->
                                    <a href="files/<?= $r['file_title'] ?>" download>Download</a>
                                </td>
                                <td>
                                    <a 
                                        href="./deleteFile-action.php?fileid=<?= $r['fileid'] ?>&file_name=<?= $r['file_title'] ?>" 
                                        class="btn btn-danger" 
                                        name="deleteFile">Delete
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                    <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
        endif;
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
    <script>
        const addFile = document.querySelector("#addFiles");
        const submitFile = document.querySelector("#submitFile");

        submitFile.disabled = true

        addFile.addEventListener('change', () => {
            if(addFile.value.length > 0) {
                submitFile.disabled = false
            } else {
                submitFile.disabled = true
            }
        })
    </script>
</body>
</html>
<?php
    if(isset($_POST['submitFile'])) {
        if(!empty($_FILES['addFiles']['name'])) {
            $conn->autocommit(false);
            $userId = $_SESSION['id'];
            $fileCount = $_FILES['addFiles']['name'];
            for($i = 0; $i < count($fileCount); $i++) {
                $extensions = array('jpg', 'png', 'pdf', 'jpeg');
                $filenames = $_FILES['addFiles']['name'][$i];
                $error = $_FILES['addFiles']['error'][$i];
                $size = $_FILES['addFiles']['error']{$i};
                $tmpName = $_FILES['addFiles']['tmp_name'][$i];
                $file_ext = explode('.', $filenames);
                $fileExt = strtolower(end($file_ext));
                if(in_array($fileExt, $extensions)) {
                    if($error === 0) {
                        if($size < 500000) {
                            // $files_new_name = date("Ymd")."_".md5($filenames . microtime()).'.'.$fileExt;
                            $files_new_name = rand(1000, 10000)."-".$filenames;
                            $filePath = "./files/".$files_new_name;
                        } else {
                            echo "<script>alert(file too large)</script>";
                            exit();
                        }
                    } else {
                            echo "<script>alert(failed to add)</script>";
                            exit();
                    }
                }
                $sql = "INSERT INTO tbl_files (file_owner_id, file_title) VALUES ('$userId', '$files_new_name')";
                $conn->query($sql);

                if(!$conn->commit()) {
                    die($conn->error);
                } else {
                    move_uploaded_file($tmpName, $filePath);
                    header("Location: view.php?id=$userId");
                }
            }
        } else {
            echo "<script>alert(no image)</script>";
        }
    }
    ob_end_flush();
?>