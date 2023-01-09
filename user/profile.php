<?php
    session_start();
    // print_r($_SESSION);
    if(isset($_POST['auth']) && isset($_SESSION['user_id'])) {
        header("Location: ./profile.php?id=".$_SESSION['user_id']);
        exit();
    } else if(!isset($_SESSION['auth']) && !isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit();
    }
    require_once "../user-action/user-profile-action.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"/>
    <link rel="stylesheet" href="../index.css">
    <title>Profile</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a href="../index.php" class="navbar-brand">
                <img src="../images/phafinallogo.png" width="350" height="100" alt="Logo" />
            </a>
            <button 
                class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#navbar"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="./profile.php?id=<?= $_SESSION['user_id'] ?>" class="nav-link">Profile</a>
                    </li>
                    <li class="nav-item"><a href="../generate-pdf.php?id=<?= $_SESSION['user_id'] ?>" class="nav-link">Download</a></li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Account</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="./change-password.php?id=<?= $_SESSION['user_id'] ?>" class="dropdown-item">Change password</a>
                            </li>
                            <li>
                                <a href="./logout.php" class="dropdown-item">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="mt-3">
        <div class="container">
            <div class="accordion mb-3">

                <!-- INFORMATION -->
                <div class="accordion-item">
                    <h2 class="accorion-header" id="panelOne">
                        <button 
                            class="accordion-button" 
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#user_information"
                        >
                            Information
                        </button>
                    </h2>
                    <div class="accordion collapse collapse show" id="user_information">
                        <div class="container">
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <img 
                                        src="../images/uploads/<?= $infoRow['image_url'] ? $infoRow['image_url'] : 'default-img.png'?>" 
                                        width="250px" 
                                        alt="<?= $infoRow['image_url'] ?>"
                                        class="profile_img"
                                    >
                                </div>

                                <div class="col-md-4 mt-3">
                                    <!-- UID -->
                                    <p class="text-capitalize">
                                        <strong>UID:</strong> <?= $uid_row['user_uid'] ?>
                                    </p>
                                    <!-- FULL NAME -->
                                    <p class="text-capitalize">
                                        <strong>name:</strong> <?= $infoRow['first_name'] ?> <?= $infoRow['middle_name'] ?> <?= $infoRow['last_name'] ?> <?= $infoRow['suffix'] ? $infoRow['suffix'].'.' : '' ?>
                                    </p>

                                    <!-- EMAIL -->
                                    <p>
                                        <strong class="text-capitalize">email:</strong> <?= $infoRow['email'] ?>
                                    </p>

                                    <!-- MOBILE NUMBER -->
                                    <p class="text-capitalize">
                                        <strong>mobile number:</strong> <?= $infoRow['mobile_number'] ? $infoRow['mobile_number'] : 'N/A' ?>
                                    </p>

                                    <!-- BIRTHDATE -->
                                    <p class="text-capitalize">
                                        <strong>birthdate (MM/DD/YYYY):</strong> 
                                        <?php
                                            $birthMonth = $infoRow['birth_month'];
                                            $birthDay = $infoRow['birth_day'];
                                            $birthYear = $infoRow['birth_year'];

                                            $month = ($birthMonth < 10)? "0".$birthMonth : $birthMonth ;
                                            echo "$month/$birthDay/$birthYear";
                                        ?>
                                    </p>

                                    <!-- AGE -->
                                    <p class="text-capitalize">
                                        <strong>age:</strong> <?= $infoRow['age'] ?>
                                    </p>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <!-- GENDER -->
                                    <p class="text-capitalize">
                                        <strong>gender:</strong> <?= $infoRow['gender'] ? $infoRow['gender'] : 'N/A' ?>
                                    </p>

                                    <!-- OTHER MOBILE NUMBER -->
                                    <p class="text-capitalize">
                                        <strong>second mobile number:</strong> <?= $infoRow['second_mobile_number'] ? $infoRow['second_mobile_number'] : 'N/A' ?>
                                    </p>

                                    <!-- PRC -->
                                    <p class="text-capitalize">
                                        <strong>PRC:</strong> <?= $infoRow['prcno'] ? $infoRow['prcno'] : 'N/A' ?>
                                    </p>

                                    <!-- PMA -->
                                    <p class="text-capitalize">
                                        <strong>PMA:</strong> <?= $infoRow['pmano'] ? $infoRow['pmano'] : 'N/A' ?>
                                    </p>
                                </div>
                            </div>

                            <div class="row mb-2 mt-2 ">
                                <div class="col">
                                    <a 
                                        class="small-button float-end"
                                        href="update-user-information.php?id=<?= $_SESSION['user_id'] ?>"
                                        >
                                        Update
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MEDICAL & TRAINING INSTITUTION -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button 
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#school"
                        >
                            Medical School & Training Institution
                        </button>
                    </h2>
                    <div class="accordion collapse collapse show" id="school">
                        <div class="container">
                            <div class="row">
                                <div class="col mt-3">
                                    <p class="text-capitalize">
                                        <strong>medical school:</strong> <?= $schoolRow['medical_school'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>year graduated:</strong> <?= $schoolRow['year_graduated'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>training institution:</strong> <?= $schoolRow['training_school'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>year finished: </strong> <?= $schoolRow['year_finish'] ?>
                                    </p>
                                </div>
                            </div>

                            <div class="row mt-3 mb-3">
                                <div class="col">
                                    <a
                                        class="small-button float-end" 
                                        href="./update-medical-training.php?id=<?= $_SESSION['user_id'] ?>"
                                    >
                                        Update
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AFFILIATION -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#user_affiliation"
                        >
                            Affiliation
                        </button>
                    </h2>
                    <div class="accordion collapse collapse show" id="user_affiliation">
                        <div class="container">
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <p class="text-capitalize">
                                        <strong>hospital affiliation:</strong> <?= $affRow['hospital_affiliation'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>contact number: </strong> <?= $affRow['contactno'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>landline number: </strong> <?= $affRow['landlineno'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>main city or province of practice :</strong> <?= $affRow['cityprovince'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>home address:</strong> <?= $affRow['home_address'] ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>address principal clinic: </strong> <?= $affRow['principal_office'] ?>
                                    </p>
                                </div>

                                <div class="col-md-4">
                                    <p class="text-capitalize">
                                        <?php
                                            while($subListRow = $subListResult->fetch_assoc()) :
                                        ?>
                                        <strong>subspecialty:</strong> <?= $subListRow['sub_list'] ?>
                                        <?php endwhile; ?>
                                    </p>

                                    <p class="text-capitalize">
                                        <?php
                                            while($specRow = $specResult->fetch_assoc()) :
                                        ?>
                                        <strong>special training:</strong> <?= $specRow['special_training'] ?>
                                        <?php endwhile; ?>
                                    </p>

                                    <p class="text-capitalize">
                                        <?php
                                            while($pracRow = $pracResult->fetch_assoc()) :
                                        ?>
                                        <strong>practice:</strong> <?= $pracRow['practice_list'] ?>
                                        <?php endwhile; ?>
                                    </p>
                                    
                                    <p class="text-capitalize">
                                        <?php
                                            while($catRow = $catResult->fetch_assoc()) :
                                        ?>
                                        <strong>category:</strong> <?= $catRow['category_list'] ?>
                                        <?php endwhile; ?>
                                    </p>

                                    <p>
                                        <?php 
                                            while($councilRow = $councilResult->fetch_assoc()) :
                                        ?>
                                        <strong class="text-capitalize">council:</strong> <?= $councilRow['council_list'] ?>
                                        <?php endwhile; ?>
                                    </p>

                                    <p class="text-capitalize">
                                        <?php 
                                            while($commRow = $commResult->fetch_assoc()) :
                                        ?>
                                        <strong>committee:</strong> <?= $commRow['committee_list'] ?>
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
                                        <strong>other subspecialty:</strong> <?= $otherSubRow['other_subspecialty'] ? $otherSubRow['other_subspecialty'] : 'N/A' ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>other special training:</strong> <?= $other_stRow['other_special_training'] ? $other_stRow['other_special_training'] : 'N/A' ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>other practice:</strong> <?= $otherPracRow['other_practice'] ?  $otherPracRow['other_practice'] : 'N/A' ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>other category:</strong> <?= $otherCatRow['category'] ? $otherCatRow['category'] : 'N/A' ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>other council:</strong> <?= $otherCouncilRow['other_council'] ? $otherCouncilRow['other_council'] : 'N/A' ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>other committee:</strong> <?= $otherCommRow['other_committee'] ? $otherCommRow['other_committee'] : 'N/A' ?>
                                    </p>
                                    <p class="text-capitalize">
                                        <strong>other chapter:</strong> <?= $otherChapRow['other_chapter'] ? $otherChapRow['other_chapter'] : 'N/A' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row mb-2 mt-2">
                                <div class="col">
                                    <a 
                                        href="update-affiliation.php?id=<?= $_SESSION['user_id'] ?>"
                                        class="small-button float-end"
                                    >
                                        Update
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- OTHER AFFILIATION -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#other_affiliation"
                        >
                            Other affiliation
                        </button>
                    </h2>
                    <div class="accordion collapse collapse show" id="other_affiliation">
                        <div class="container">
                            <div class="row mb-2 mt-3">
                                <div class="col">
                                    <a
                                        href="./additional-affiliation.php"
                                        class="small-button float-end"
                                    >Add</a>
                                </div>
                            </div>

                            <div class="row mt-3 mb-3">
                                <div class="col">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Hospital affiliation</th>
                                                <th>Mobile number</th>
                                                <th>Landline number</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                                while($extraRow = $extraResult->fetch_assoc()) :
                                            ?>
                                            <tr>
                                                <td><?= $extraRow['hospital_aff'] ?></td>
                                                <td><?= $extraRow['contact'] ?></td>
                                                <td><?= $extraRow['landline'] ?></td>
                                                <td>
                                                    <a href="edit-additional-affiliation.php?info_id=<?= $extraRow['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <a href="../user-action/delete-affiliation-action.php?info_id=<?= $extraRow['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
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
                        <button 
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#year_as"
                        >
                            Year as
                        </button>
                    </h2>
                    <div class="accordion collapse collapse show" id="year_as">
                        <div class="container">
                            <div class="row mt-3">
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
                                </div>
                                <div class="col">
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
                            <div class="row mt-2 mb-2">
                                <div class="col">
                                    <a 
                                        href="./year-as.php?id=<?= $_SESSION['user_id'] ?>"
                                        class="small-button float-end"
                                    >
                                        Update
                                    </a>
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
                                    <a href="./add-beneficiaries.php?id=<?= $_SESSION['user_id'] ?>" class="small-button float-end">Add</a>
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
                                                while($benRow = $beneficiariesResult->fetch_assoc()) :
                                                    if($benRow) :
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $benRow['ben_first_name'] ?>
                                                    <?= $benRow['ben_middle_name'] ?>
                                                    <?= $benRow['ben_last_name'] ?>
                                                    <?= $benRow['ben_suffix'] ? $benRow['ben_suffix'].'.' : '' ?>
                                                </td>
                                                <td>
                                                    <a href="./edit-beneficiaries.php?id=<?= $benRow['ben_id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <a href="./delete-beneficiaries.php?id=<?= $benRow['ben_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
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
                                    <a href="./add-emergency.php" class="small-button float-end">Add</a>
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
                                                while($cpRow = $contactPersonResult->fetch_assoc()) :
                                                    if($cpRow) :
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $cpRow['cp_first_name'] ?>
                                                    <?= $cpRow['cp_middle_name'] ?>
                                                    <?= $cpRow['cp_last_name'] ?>
                                                </td>
                                                <td><?= $cpRow['cp_mobile_number'] ?></td>
                                                <td>
                                                    <a href="./edit-emergency.php?id=<?= $cpRow['cp_id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <a href="./delete-emergency.php?id=<?= $cpRow['cp_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
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
    </section>
    <?php
        include "../footer.php";
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
</body>
</html>