<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/view-user.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"/>
    <title>User view</title>
</head>
<body>

    <section>
        <?php
            include "./includes/navigation.php";
        ?>
    </section>

    <main class="mt-5">
        <div class="container">
            <div class="accordion mb-3">
                <!-- INFORMATION -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#user_information">
                            Information
                        </button>
                    </h2>
                    <div class="accordion collapse collapse show" id="user_information">
                        <div class="container">
                            <div class="row my-4">
                                <div class="col-md-4">
                                    <img 
                                        src="../images/uploads/<?= $userRow['image_url'] ? $userRow['image_url'] : 'default-img.png' ?>" 
                                        alt="<?= $userRow['image_url'] ?>" class="profile_img" 
                                        width="250px"
                                        class="profile_img"
                                    >
                                </div>

                                <div class="col-md-4">
                                    <!-- UID -->
                                    <p class="text-capitalize">
                                        <strong>UID:</strong> <?= $uidRow['user_uid'] ?>
                                    </p>
                                    <!-- FULL NAME -->
                                    <p class="text-capitalize">
                                        <strong>name:</strong> <?= $userRow['first_name'] ?> <?= $userRow['middle_name'] ?> <?= $userRow['last_name'] ?> <?= $userRow['suffix'] ? $userRow['suffix'].'.' : '' ?>
                                    </p>
                                    <!-- EMAIL -->
                                    <p>
                                        <strong class="text-capitalize">email:</strong> <?= $userRow['email'] ?>
                                    </p>
                                    <!-- MOBILE NUMBER -->
                                    <p class="text-capitalize">
                                        <strong>mobile number:</strong> <?= $userRow['mobile_number'] ? $userRow['mobile_number'] : 'N/A' ?>
                                    </p>
                                    <!-- BIRTH DATE -->
                                    <p class="text-capitalize">
                                        <strong>birth date(MM/DD/YYYY)</strong> <?php
                                            $birthMonth = $userRow['birth_month'];
                                            $birthDay = $userRow['birth_day'];
                                            $birthYear = $userRow['birth_year'];

                                            $month = ($birthMonth < 10) ? "0".$birthMonth : $birthMonth;

                                            echo "$month/$birthDay/$birthYear";
                                        ?>
                                    </p>
                                    <!-- AGE -->
                                    <p class="text-capitalize">
                                        <strong>age:</strong> <?= $userRow['age'] ?>
                                    </p>
                                </div>
                                <div class="col-md-4 my-4">
                                    <!-- GENDER -->
                                    <p class="text-capitalize">
                                        <strong>gender:</strong> <?= $userRow['gender'] ? $userRow['gender'] : 'N/A' ?>
                                    </p>
                                    <!-- OTHER MOBILE NUMBER -->
                                    <p class="text-capitalize">
                                        <strong>second mobile number:</strong> <?= $userRow['second_mobile_number'] ? $userRow['second_mobile_number'] : 'N/A' ?>
                                    </p>
                                    <!-- PRC -->
                                    <p class="text-capitalize">
                                        <strong>PRC:</strong> <?= $userRow['prcno'] ? $userRow['prcno'] : 'N/A' ?>
                                    </p>
                                    <!-- PMA -->
                                    <p class="text-capitalize">
                                        <strong>PMA:</strong> <?= $userRow['pmano'] ? $userRow['pmano'] : 'N/A' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col">
                                    <a href="./update-information.php?id=<?= $userRow['id'] ?>" class="btn btn-primary float-end">Update</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MEDICAL & TRAINING INSTITUTION -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#school">Medical School & Training Institution</button>
                    </h2>
                    <div class="accordion collapse collapse show" id="school">
                        <div class="container">
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <p class="text-capitalize">
                                        <strong>medical school:</strong> <?= $schoolRow['medical_school'] ?>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                   <p class="text-capitalize">
                                        <strong>year graduated:</strong> <?= $schoolRow['year_graduated'] ?>
                                   </p> 
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-md-6">
                                    <p class="text-capitalize">
                                        <strong>training institution:</strong> <?= $schoolRow['training_school'] ?>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-capitalize">
                                        <strong>year finished</strong> <?= $schoolRow['year_finish'] ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col">
                                    <a href="./update-medical-training.php?id=<?= $userRow['id'] ?>" class="btn btn-primary float-end">Update</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AFFILIATION -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#affiliation">Affiliation</button>
                    </h2>
                    <div class="accordion collapse collapse show" id="affiliation">
                        <div class="container">
                            <div class="row my-3">
                                <div class="col-md-4">
                                    <p class="text-capitalize">
                                        <strong>hospital affiliation:</strong> <?= $affRow['hospital_affiliation'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>contact number:</strong> <?= $affRow['contactno'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>landline number</strong> <?= $affRow['landlineno'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>main city/province of practice</strong> <?= $affRow['cityprovince'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>home address:</strong> <?= $affRow['home_address'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>address principal clinic</strong> <?= $affRow['principal_office'] ?>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p class="text-capitalize">
                                        <?php
                                            while($subRow = $subResult->fetch_assoc()):
                                        ?>
                                        <strong>subspecialty:</strong> <?= $subRow['sub_list'] ?>
                                        <?php endwhile; ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <?php
                                            while($trainRow = $trainingResult->fetch_assoc()) :
                                        ?>
                                        <strong>special training:</strong> <?= $trainRow['training_list'] ?>
                                        <?php endwhile; ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <?php
                                            while($practiceRow = $practiceResult->fetch_assoc()) :
                                        ?>
                                        <strong>practice:</strong> <?= $practiceRow['practice_list'] ?>
                                        <?php endwhile; ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <?php 
                                            while($categoryRow = $catResult->fetch_assoc()) :
                                        ?>
                                        <strong>category:</strong> <?= $categoryRow['category_list'] ?>
                                        <?php endwhile; ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <?php
                                            while($councilRow = $councilResult->fetch_assoc()) :
                                        ?>
                                        <strong>council:</strong> <?= $councilRow['council_list'] ?>
                                        <?php endwhile; ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <?php 
                                            while($committeeRow = $committeeResult->fetch_assoc()) :
                                        ?>
                                        <strong>committee:</strong> <?= $committeeRow['committee_list'] ?>
                                        <?php endwhile; ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>international affiliation:</strong> <?= $affRow['international_affiliation'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <?php
                                            while($chapterRow = $chapterResult->fetch_assoc()) :
                                        ?>
                                        <strong>chapter:</strong> <?= $chapterRow['chapter_list'] ?>
                                        <?php endwhile; ?>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p class="text-capitalize">
                                        <strong>other subspecialty:</strong> <?= $otherSubRow['other_subspecialty'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>other special training:</strong> <?= $otherSpecialTrainingRow['other_special_training'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>other practice:</strong> <?= $otherPracticeRow['other_practice'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>other category:</strong> <?= $otherCategoryRow['category'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>other council:</strong> <?= $otherCouncilRow['other_council'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>other committee:</strong> <?= $otherCommitteeRow['other_committee'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>other chapter:</strong> <?= $otherChapterRow['other_chapter'] ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col">
                                    <a href="./update-affiliation.php?id=<?= $userRow['id'] ?>" class="btn btn-primary float-end">Update</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#otherAffiliation">Other Affiliation</button>
                    </h2>
                    <div class="accordion collapse collapse show" id="otherAffiliation">
                        <div class="container">
                            <div class="row my-3">
                                <div class="col">
                                    <a href="./add-affiliation.php?id=<?= $userRow['id'] ?>" class="btn btn-primary float-end">Add</a>
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="col">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Hospital Affiliation</th>
                                                <th>Mobile number</th>
                                                <th>Landline number</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($infoRow = $otherInfoResult->fetch_assoc()) :
                                            ?>
                                            <tr>
                                                <td><?= $infoRow['hospital_aff'] ?></td>
                                                <td><?= $infoRow['contact'] ?></td>
                                                <td><?= $infoRow['landline'] ?></td>
                                                <td><a href="./update-additional-affiliation.php?id=<?= $infoRow['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                                <a href="./delete-additional-affiliation.php?id=<?= $infoRow['id'] ?>" class="btn btn-danger btn-sm">Delete</a></td>
                                            </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- YEAR AS -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#year_as">
                            Year as
                        </button>
                    </h2>
                    <div class="accordion collapse collapse show" id="year_as">
                        <div class="container">
                            <div class="row my-3">
                                <div class="col">
                                    <p class="text-capitalize">
                                        <strong>fellow:</strong> <?= $yearRow['fellow_year'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>life fellow:</strong> <?= $yearRow['life_fellow_year'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>diplomate:</strong> <?= $yearRow['diplomate_year'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>life member:</strong> <?= $yearRow['life_member_year'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>associate fellow:</strong> <?= $yearRow['associate_fellow'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>associate:</strong> <?= $yearRow['associate'] ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col">
                                    <a href="./update-year.php?id=<?= $userRow['id'] ?>" class="btn btn-primary float-end">Update</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BENEFICIARIES -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button 
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#beneficiaries"
                        >
                            Beneficiaries
                        </button>
                    </h2>
                    <div class="accordion collapse collapse show" id="beneficiaries">
                        <div class="container">
                            <div class="row my-3">
                                <div class="col">
                                    <a 
                                        href="./add-beneficiary.php?id=<?= $userRow['id'] ?>"
                                        class="btn btn-primary btn-sm float-end"
                                    >Add</a>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($rowBeneficiaries = $resultBeneficiaries->fetch_assoc()) :
                                                    if($rowBeneficiaries) :
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $rowBeneficiaries['ben_first_name'] ?>
                                                    <?= $rowBeneficiaries['ben_middle_name'] ?>
                                                    <?= $rowBeneficiaries['ben_last_name'] ?>
                                                    <?= $rowBeneficiaries['ben_suffix'] ? $rowBeneficiaries['ben_suffix'].'.' : '' ?>
                                                </td>
                                                <td>
                                                    <a href="./update-beneficiary.php?id=<?= $rowBeneficiaries['ben_id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <a href="./delete-beneficiary.php?id=<?= $rowBeneficiaries['ben_id'] ?>" name="delete-ben" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                            <?php
                                                    endif;
                                                endwhile;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CONTACT PERSON IN CASE OF EMERGENCY -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#contact_person"
                        >
                            Contact person in case of emergency
                        </button>
                    </h2>
                    <div class="accordion collapse collapse show" id="contact_person">
                        <div class="container">
                            <div class="row my-3">
                                <div class="col">
                                    <a href="./add-contact-person.php?id=<?= $userRow['id'] ?>" class="btn btn-primary btn-sm float-end">Add</a>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Mobile number</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($rowCp = $resultCp->fetch_assoc()) :
                                                    if($rowCp) :
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $rowCp['cp_first_name'] ?>
                                                    <?= $rowCp['cp_middle_name'] ?>
                                                    <?= $rowCp['cp_last_name'] ?>
                                                </td>
                                                <td>
                                                    <?= $rowCp['cp_mobile_number'] ?>
                                                </td>
                                                <td>
                                                    <a href="./update-contact-person.php?id=<?= $rowCp['cp_id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <a href="./delete-contact-person.php?id=<?= $rowCp['cp_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                            <?php
                                                    endif;
                                                endwhile;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>