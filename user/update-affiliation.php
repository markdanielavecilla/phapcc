<?php
    require_once "../user-action/affiliation-action.php";
    if(isset($_POST['auth']) && isset($_SESSION['user_id'])) {
        header("Location: ./profile.php?id=".$_SESSION['user_id']);
        exit();
    } else if(!isset($_SESSION['auth']) && !isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit();
    }
    $status = 0;
    // echo $USER_ID;
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
    <title>Document</title>
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
                        <a href="./profile.php?id=<?= $_GET['id'] ?>" class="nav-link">Profile</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Account</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#" class="dropdown-item">Change password</a>
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

    <section>
        <form
            method="POST"
            autocomplete="off" 
        >
            <div class="container">
                <h2 class="mt-4">Affiliation</h2>
                <hr/>
                <?php
                    if(isset($_SESSION['message'])) :
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    endif;
                ?>
                <div class="row mt-3 mb-3">
                    
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errHospital ? 'is-invalid' : '' ?>"
                                name="hospital_affiliation"
                                placeholder="Hospital affiliation"
                                value="<?= isset($_POST['hospital_affiliation']) ? $_POST['hospital_affiliation'] : $row['hospital_affiliation'] ?>"
                            />
                            <label for="hospital_affiliation">Hospital Affiliation</label>
                            <span class="invalid-feedback"><?= $errHospital ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input 
                                type="number"
                                class="form-control <?= $errContactNumber ? 'is-invalid' : '' ?>"
                                name="contact_number"
                                placeholder="Contact number"
                                value="<?= isset($_POST['contact_number']) ? $_POST['contact_number'] : $row['contactno'] ?>" 
                            />
                            <label for="contact_number">Contact number</label>
                            <span class="invalid-feedback"><?= $errContactNumber ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errLandlineNumber ? 'is-invalid' : '' ?>"
                                name="landline_number"
                                placeholder="Landline number"
                                value="<?= isset($_POST['landline_number']) ? $_POST['landline_number'] : $row['landlineno'] ?>"
                            />
                            <label for="landline_number">Landline number</label>
                            <span class="invalid-feedback"><?= $errLandlineNumber ?></span>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-3">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errCityProvince ? 'is-invalid' : '' ?>"
                                name="city_province"
                                placeholder="City/Province"
                                value="<?= isset($_POST['city_province']) ? $_POST['city_province'] : $row['cityprovince'] ?>"
                            />
                            <label for="city_province">City/Province</label>
                            <span class="small"><strong>Note:</strong> Main City or Province of Practice</span>
                            <span class="invalid-feedback"><?= $errCityProvince ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errHomeAddress ? 'is-invalid' : '' ?>"
                                name="home_address"
                                placeholder="Home_address"
                                value="<?= isset($_POST['home_address']) ? $_POST['home_address'] : $row['home_address'] ?>"
                            />
                            <label for="home_address">Home Address</label>
                            <span class="invalid-feedback"><?= $errHomeAddress ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errPrincipalOffice ? 'is-invalid' : '' ?>"
                                name="principal_office"
                                placeholder="Address of Principal clinic"
                                value="<?= isset($_POST['principal_office']) ? $_POST['principal_office'] : $row['principal_office'] ?>"
                            />
                            <label for="principal_office">Address of Principal clinic</label>
                            <span class="invalid-feedback"><?= $errPrincipalOffice ?></span>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-3">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errInternationalAffiliation ? 'is-invalid' : '' ?>"
                                name="international_affiliation"
                                placeholder="International affiliation"
                                value="<?= isset($_POST['international_affiliation']) ? $_POST['international_affiliation'] : $row['international_affiliation'] ?>"
                            />
                            <label for="international_affiliation">International Affiliation</label>
                            <span class="invalid-feedback"><?= $errInternationalAffiliation ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-3 mb-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-text">
                                <label for="subspecialty">Subspecialty</label>
                            </div>
                            <select 
                                name="subspecialty[]" 
                                id="subspecialty"
                                multiple
                                class="form-control my-select"
                                data-selected-text-format="count > 2"
                            >
                                <?php
                                    $stmt = $conn->prepare("SELECT * FROM tbl_hospital_subspecialty WHERE information_id = ?");
                                    $stmt->bind_param("i", $USER_ID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $subspecialty = array();
                                    while($subspecialtyRow = $result->fetch_assoc()) {
                                        $subspecialty[] = $subspecialtyRow['subspecialty_id'];
                                    }
                                    $stmt->close();

                                    $stmt = $conn->prepare("SELECT * FROM tbl_subspecialty WHERE status = ?");
                                    $stmt->bind_param("i", $status);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $stmt->close();

                                    while($subRow = $result->fetch_assoc()) :
                                ?>
                                <option 
                                    value="<?= $subRow['sub_id'] ?>"
                                    <?= in_array($subRow['sub_id'], $subspecialty) ? 'selected' : '' ?>
                                >
                                    <?= ucwords($subRow['subspecialty']) ?>
                                </option>
                                <?php endwhile ?>
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <?php
                            $stmt = $conn->prepare("SELECT u_id, other_subspecialty FROM tbl_other_subspecialty WHERE u_id = ?");
                            $stmt->bind_param("i", $USER_ID);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $otherSubRow = $result->fetch_assoc();
                        ?>
                        <input 
                            type="text"
                            class="form-control <?= $errOtherSub ? 'is-invalid' : '' ?>"
                            name="other_subspecialty"
                            placeholder="Other subspecialty"
                            value="<?= isset($_POST['other_subspecialty']) ? $_POST['other_subspecialty'] : $otherSubRow['other_subspecialty'] ?>"
                        >
                        <span class="invalid-feedback"><?= $errOtherSub ?></span>
                        <span class="small"><strong>Note:</strong> If more than one subspecialty, put comma (,) to separate it. (e.g. Cardiac Rehab, Echochardiography, etc...) </span>
                    </div>

                </div>

                <!-- SPECIAL TRAINING -->
                <div class="row mt-3 mb-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-text">
                                <label for="special_training">Special Training</label>
                            </div>
                            <select 
                                name="special_training[]" 
                                id="special_training"
                                multiple
                                class="form-control my-select"
                                data-selected-text-format="count > 2"
                            >
                                <?php
                                    $stmt = $conn->prepare("SELECT * FROM tbl_hospital_special_training WHERE information_id = ?");
                                    $stmt->bind_param("i", $USER_ID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $specialTraining = array();
                                    while($stRow = $result->fetch_assoc()) {
                                        $specialTraining[] = $stRow['special_training_id'];
                                    }
                                    $stmt->close();

                                    $stmt = $conn->prepare("SELECT * FROM tbl_special_training WHERE status = ?");
                                    $stmt->bind_param("i", $status);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $stmt->close();
                                    
                                    while($stRow = $result->fetch_assoc()) :
                                ?>
                                    <option 
                                        value="<?= $stRow['st_id'] ?>"
                                        <?= in_array($stRow['st_id'], $specialTraining) ? 'selected' : '' ?>
                                    >
                                        <?= $stRow['special_training'] ?>
                                    </option>
                                <?php endwhile ?>
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <?php
                            $stmt = $conn->prepare("SELECT u_id, other_special_training FROM tbl_other_special_training WHERE u_id = ?");
                            $stmt->bind_param("i", $USER_ID);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $otherSt_row = $result->fetch_assoc();
                        ?>
                        <input 
                            type="text"
                            class="form-control <?= $errOtherSpec ? 'is-invalid' : '' ?>"
                            name="other_specialTraining"
                            placeholder="Other special training"
                            value="<?= isset($_POST['other_specialTraining']) ? $_POST['other_specialTraining'] : $otherSt_row['other_special_training'] ?>"
                        >
                        <span class="invalid-feedback"><?= $errOtherSpec ?></span>
                        <span class="small"><strong>Note:</strong> If more than one special training, put comma (,) to separate it. (e.g. MD, FPCP, etc...)</span>
                    </div>

                </div>

                <!-- PRACTICE -->
                <div class="row mt-3 mb-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-text">
                                <label for="practice">Practice</label>
                            </div>
                            <select 
                                name="practice[]" 
                                id="practice"
                                multiple
                                class="form-control my-select"
                                data-selected-text-format="count > 2"
                            >
                                <?php
                                    $stmt = $conn->prepare("SELECT * FROM tbl_hospital_practice WHERE information_id = ?");
                                    $stmt->bind_param("i", $USER_ID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $practice = array();
                                    while($practiceRow = $result->fetch_assoc()) {
                                        $practice[] = $practiceRow['practice_id'];
                                    }
                                    $stmt->close();

                                    $stmt = $conn->prepare("SELECT * FROM tbl_practice WHERE status = ?");
                                    $stmt->bind_param("i", $status);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $stmt->close();
                                    while($prRow = $result->fetch_assoc()) :
                                ?>
                                <option 
                                    value="<?= $prRow['practice_id'] ?>"
                                    <?= in_array($prRow['practice_id'], $practice) ? 'selected' : '' ?>

                                >
                                    <?= ucwords($prRow['practice']) ?>
                                </option>    
                                <?php endwhile ?>
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <?php
                            $stmt = $conn->prepare("SELECT u_id, other_practice FROM tbl_other_practice WHERE u_id = ?");
                            $stmt->bind_param("i", $USER_ID);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $otherPractice = $result->fetch_assoc();
                            $stmt->close();
                        ?>
                        <input 
                            type="text"
                            class="form-control <?= $errOtherPrac ? 'is-invalid' : '' ?>"
                            name="other_practice"
                            placeholder="Other practice"
                            value="<?= isset($_POST['other_practice']) ? $_POST['other_practice'] : $otherPractice['other_practice'] ?>"
                        >
                        <span class="invalid-feedback"><?= $errOtherPrac ?></span>
                        <span class="small"><strong>Note:</strong> If more than one practice, put comma (,) to separate it. (e.g. Adult, Pedia, etc...)</span>
                    </div>

                </div>

                <!-- CATEGORY -->
                <div class="row mt-3 mb-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-text">
                                <label for="category">Category</label>
                            </div>
                            <select 
                                name="category[]" 
                                id="category"
                                multiple
                                class="form-control my-select"
                                data-selected-text-format="count > 2"
                            >
                                <?php
                                    $stmt = $conn->prepare("SELECT * FROM tbl_hospital_drcategory WHERE information_id = ?");
                                    $stmt->bind_param("i", $USER_ID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $stmt->close();
                                    $category = array();
                                    while($catRow = $result->fetch_assoc()) {
                                        $category[] = $catRow['category_id'];
                                    }

                                    $stmt = $conn->prepare("SELECT * FROM tbl_drcategory WHERE status = ?");
                                    $stmt->bind_param("i", $status);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $stmt->close();
                                    while($caRow = $result->fetch_assoc()) :
                                ?>
                                <option 
                                    value="<?= $caRow['catid'] ?>"
                                    <?= in_array($caRow['catid'], $practice) ? 'selected' : '' ?>

                                >
                                    <?= ucwords($caRow['category']) ?>
                                </option>    
                                <?php endwhile ?>
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <?php
                            $stmt = $conn->prepare("SELECT u_id, category FROM tbl_other_drcategory WHERE u_id = ?");
                            $stmt->bind_param("i", $USER_ID);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $category = $result->fetch_assoc();
                        ?>
                        <input 
                            type="text"
                            class="form-control <?= $errOtherCat ? 'is-invalid' : '' ?>"
                            name="other_category"
                            placeholder="Other category"
                            value="<?= isset($_POST['other_category']) ? $_POST['other_category'] : $category['category'] ?>"
                        >
                        <span class="invalid-feedback"><?= $errOtherCat ?></span>
                        <span class="small"><strong>Note:</strong> If more than one category, put comma (,) to separate it. (e.g. Fellow, Life fellow, etc...)</span>
                    </div>

                </div>

                <!-- COUNCIL -->
                <div class="row mt-3 mb-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-text">
                                <label for="council">Council</label>
                            </div>
                            <select 
                                name="council[]" 
                                id="council"
                                multiple
                                class="form-control my-select"
                                data-selected-text-format="count > 2"
                            >
                                <?php
                                    $stmt = $conn->prepare("SELECT * FROM tbl_hospital_council WHERE information_id = ?");
                                    $stmt->bind_param("i", $USER_ID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $stmt->close();
                                    $council = array();
                                    while($cRow = $result->fetch_assoc()) {
                                        $council[] = $cRow['council_id'];
                                    }

                                    $stmt = $conn->prepare("SELECT * FROM tbl_council WHERE status = ?");
                                    $stmt->bind_param("i", $status);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $stmt->close();
                                    while($councilRow = $result->fetch_assoc()) :
                                ?>
                                <option 
                                    value="<?= $councilRow['council_id'] ?>"
                                    <?= in_array($councilRow['council_id'], $council) ? 'selected' : '' ?>

                                >
                                    <?= ucwords($councilRow['council']) ?>
                                </option>    
                                <?php endwhile ?>
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <?php
                            $stmt = $conn->prepare("SELECT u_id, other_council FROM tbl_other_council WHERE u_id = ?");
                            $stmt->bind_param("i", $USER_ID);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $council = $result->fetch_assoc();
                            $stmt->close();
                        ?>
                        <input 
                            type="text"
                            class="form-control <?= $errOtherCouncil ? 'is-invalid' : '' ?>"
                            name="other_council"
                            placeholder="Other council"
                            value="<?= isset($_POST['other_council']) ? $_POST['other_council'] : $council['other_council'] ?>"
                        >
                        <span class="invalid-feedback"><?= $errOtherCouncil ?></span>
                        <span class="small"><strong>Note:</strong> If more than one council, put comma (,) to separate it.</span>
                    </div>
                    
                </div>

                <!-- COMMITTEE -->
                <div class="row mt-3 mb-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-text">
                                <label for="committee">Committee</label>
                            </div>
                            <select 
                                name="committee[]" 
                                id="committee"
                                multiple
                                class="form-control my-select"
                                data-selected-text-format="count > 2"
                            >
                                <?php
                                    $stmt = $conn->prepare("SELECT * FROM tbl_hospital_committee WHERE information_id = ?");
                                    $stmt->bind_param("i", $USER_ID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $stmt->close();
                                    $committee = array();
                                    while($commRow = $result->fetch_assoc()) {
                                        $committee[] = $commRow['cmt_id'];
                                    }

                                    $stmt = $conn->prepare("SELECT * FROM tbl_committee WHERE status = ?");
                                    $stmt->bind_param("i", $status);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $stmt->close();
                                    while($committeeRow = $result->fetch_assoc()) :
                                ?>
                                <option 
                                    value="<?= $committeeRow['cmt_id'] ?>"
                                    <?= in_array($committeeRow['cmt_id'], $committee) ? 'selected' : '' ?>

                                >
                                    <?= ucwords($committeeRow['committee']) ?>
                                </option>    
                                <?php endwhile ?>
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <?php
                            $stmt = $conn->prepare("SELECT u_id, other_committee FROM tbl_other_committee WHERE u_id = ?");
                            $stmt->bind_param("i", $USER_ID);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $ocRow = $result->fetch_assoc();
                            $stmt->close();
                        ?>
                        <input 
                            type="text"
                            class="form-control <?= $errOtherComm ? 'is-invalid' : '' ?>"
                            name="other_committee"
                            placeholder="Other committee"
                            value="<?= isset($_POST['other_committee']) ? $_POST['other_committee'] : $ocRow['other_committee'] ?>"
                        >
                        <span class="invalid-feedback"><?= $errOtherComm ?></span>
                        <span class="small"><strong>Note:</strong> If more than one committee, put comma (,) to separate it</span>
                    </div>
                </div>

                <!-- CHAPTER -->
                <div class="row mt-3 mb-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-text">
                                <label for="chapter">Chapter</label>
                            </div>
                            <select 
                                name="chapter[]"
                                id="chapter"
                                multiple
                                class="form-control my-select"
                                data-selected-text-format="count > 2"
                            >
                                <?php
                                    $stmt = $conn->prepare("SELECT * FROM tbl_hospital_chapter WHERE information_id = ?");
                                    $stmt->bind_param("i", $USER_ID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $stmt->close();
                                    $chapterArray = array();
                                    while($chapRow = $result->fetch_assoc()) {
                                        $chapterArray[] = $chapRow['chapter_id'];
                                    }

                                    $stmt = $conn->prepare("SELECT * FROM tbl_chapter WHERE status = ?");
                                    $stmt->bind_param("i", $status);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $stmt->close();
                                    while($chapterRow = $result->fetch_assoc()) :
                                ?>
                                <option 
                                    value="<?= $chapterRow['chapid'] ?>"
                                    <?= in_array($chapterRow['chapid'], $chapterArray) ? 'selected' : '' ?>

                                >
                                    <?= ucwords($chapterRow['chapter']) ?>
                                </option>    
                                <?php endwhile ?>
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <?php
                            $stmt = $conn->prepare("SELECT u_id, other_chapter FROM tbl_other_chapter WHERE u_id = ?");
                            $stmt->bind_param("i", $USER_ID);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $chapter = $result->fetch_assoc();
                            $stmt->close();
                        ?>
                        <input 
                            type="text"
                            class="form-control <?= $errOtherChapter ? 'is-invalid' : '' ?>"
                            name="other_chapter"
                            placeholder="Other chapter"
                            value="<?= isset($_POST['other_chapter']) ? $_POST['other_chapter'] : $chapter['other_chapter']  ?>"
                        >
                        <span class="invalid-feedback"><?= $errOtherChapter ?></span>
                        <span class="small"><strong>Note:</strong> If more than one chapter, put comma (,) to separate it. (e.g. Abroad, Bicol, etc...)</span>
                    </div>
                </div>

                <button
                    type="submit"
                    class="body-btn float-end mb-3"
                    name="save"
                >
                    Save
                </button>
            </div>
        </form>
    </section>
    <br/><br/><br/>
    <?php
        include "../footer.php";
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
    <script src="../js/select.js"></script>
</body>
</html>