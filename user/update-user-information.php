<?php
    session_start();
    require_once "../user-action/user-profile-action.php";
    if(isset($_POST['auth']) && isset($_SESSION['user_id'])) {
        header("Location: ./profile.php?id=".$_SESSION['user_id']);
        exit();
    } else if(!isset($_SESSION['auth']) && !isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit();
    }
    // print_r($infoRow);
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
        enctype="multipart/form-data"
        >
            <div class="container">
                <h2 class="mt-4">Information</h2>
                <hr/>
                <?php
                    if(isset($_SESSION['client_message'])) {
                        echo $_SESSION['client_message'];
                        unset($_SESSION['client_message']);
                    }
                ?>
                <!--  -->
                <div class="row mt-3 mb-3">
                    <div class="col-md-4 col-sm-4">
                        <img 
                            src="../images/uploads/<?= $infoRow['image_url'] ? $infoRow['image_url'] : 'default-img.png'?>"
                            id="image_preview"
                            alt="<?= $infoRow['first_name'] ?>"
                        >
                        <input 
                            type="file" 
                            id="user_image"
                            name="user_image"
                            style="display:none"
                        />
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input 
                                        type="text"
                                        class="form-control <?= $errFirstname ? 'is-invalid' : '' ?>"
                                        name="first_name"
                                        placeholder="First name"
                                        value="<?= isset($_POST['first_name']) ? $_POST['first_name'] : $infoRow['first_name'] ?>"
                                    />
                                    <label for="first_name">First name</label>
                                    <span class="invalid-feedback"><?= $errFirstname ?></span>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input 
                                        type="text"
                                        class="form-control <?= $errMiddlename ? 'is-invalid' : '' ?>"
                                        name="middle_name"
                                        placeholder="Middle name"
                                        value="<?= isset($_POST['middle_name']) ? $_POST['middle_name'] : $infoRow['middle_name'] ?>"
                                    />
                                    <label for="middle_name">Middle name</label>
                                    <span class="invalid-feedback"><?= $errMiddlename ?></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input 
                                        type="text"
                                        class="form-control <?= $errLastname ? 'is-invalid' : '' ?>"
                                        name="last_name"
                                        placeholder="Last name"
                                        value="<?= isset($_POST['last_name']) ? $_POST['last_name'] : $infoRow['last_name'] ?>" 
                                    />
                                    <label for="last_name">Last name</label>
                                    <span class="invalid-feedback"><?= $errLastname ?></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input 
                                        type="text"
                                        class="form-control <?= $errSuffix ? 'is-invalid' : '' ?>"
                                        name="suffix"
                                        placeholder="Suffix"
                                        value="<?= isset($_POST['suffix']) ? $_POST['suffix'] : $infoRow['suffix'] ?>"
                                    />
                                    <label for="suffix">Suffix</label>
                                    <span class="invalid-feedback"><?= $errSuffix ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-3">
                    <!-- GENDER -->
                    <div class="col">
                        <div class="form-floating">
                            <select 
                                name="gender"
                                class="form-select" 
                            >
                                <option 
                                    value="Male" 
                                    <?php if($infoRow['gender'] == "Male"){ echo "selected"; } ?>
                                >
                                    Male
                                </option>

                                <option 
                                    value="Female"
                                    <?php if($infoRow['gender'] == "Female"){ echo "selected"; } ?>
                                >
                                    Female
                                </option>

                            </select>
                            <label for="gender">Gender</label>
                        </div>
                    </div>

                    <!-- MOBILE NUMBER -->
                    <div class="col">
                        <div class="form-floating">
                            <input
                                type="number"
                                class="form-control <?= $errMobilenum ? 'is-invalid' : '' ?>"
                                name="mobile_number"
                                placeholder="Mobile number"
                                value="<?= isset($_POST['mobile_number']) ? $_POST['mobile_number'] : $infoRow['mobile_number'] ?>"
                            />
                            <label for="mobile_number">Mobile number</label>
                            <span class="invalid-feedback"><?= $errMobilenum ?></span>
                        </div>
                    </div>

                    <!-- SECOND MOBILE NUMBER -->
                    <div class="col">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control"
                                name="s_mobile_number"
                                placeholder="Second mobile number"
                                value="<?= isset($_POST['s_mobile_number']) ? $_POST['s_mobile_number'] : $infoRow['second_mobile_number'] ?>"
                            />
                            <label for="s_mobile_number">Second mobile number</label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-3">

                    <!-- EMAIL -->
                    <div class="col">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control"
                                name="email"
                                placeholder="Email"
                                value="<?= isset($_POST['email']) ? $_POST['email'] : $infoRow['email'] ?>"
                            />
                            <label for="email">Email</label>
                        </div>
                    </div>

                    <!-- PRCNO -->
                    <div class="col">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errPrc ? 'is-invalid' : '' ?>"
                                name="prc"
                                placeholder="PRC"
                                value="<?= isset($_POST['prc']) ? $_POST['prc'] : $infoRow['prcno'] ?>"
                            />
                            <label for="PRC">PRC</label>
                            <span class="invalid-feedback"><?= $errPrc ?></span>
                        </div>
                    </div>

                    <!-- PMANO -->
                    <div class="col">
                        <div class="form-floating"> 
                            <input 
                                type="text"
                                class="form-control <?= $errPma ? 'is-invalid' : '' ?>"
                                name="pma"
                                placeholder="PMA"
                                value="<?= isset($_POST['pma']) ? $_POST['pma'] : $infoRow['pmano'] ?>"
                            />
                            <label for="PMA">PMA</label>
                            <span class="invalid-feedback"><?= $errPma ?></span>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-3">
                    <!-- BIRTH MONTH -->
                    <div class="col">
                        <div class="form-floating">
                            <select 
                                name="month"
                                id="month"
                                class="form-select"
                            >
                                <option value="0">Month</option>
                                <?php
                                    $bmonth = $infoRow['birth_month'];
                                    $day = $infoRow['birth_day'];
                                    $year = $infoRow['birth_year'];

                                    foreach($months as $month => $val) {
                                        $selected = '';
                                        if($bmonth == $month+1)
                                            $selected = "selected";
                                    
                                ?>
                                <option 
                                    value="<?= $month+1 ?>"
                                    <?= $selected ?>
                                >
                                    <?= $val ?>
                                </option>
                                <?php } ?>
                            </select>
                            <label for="month">Month</label>
                        </div>
                    </div>

                    <!-- BIRTH DAY -->
                    <div class="col">
                        <div class="form-floating">
                            <select 
                                name="day"
                                id="day" 
                                class="form-select"
                            >
                                <option value="0">Day</option>
                                <?php
                                    for($i = 1; $i <= 31; $i++) {
                                        $selected = "";
                                        if($day == $i) $selected = "selected";
                                ?>
                                <option 
                                    value="<?= $i ?>"
                                    <?= $selected ?>
                                >
                                    <?= $i ?>
                                </option>
                                <?php } ?>
                            </select>
                            <label for="day">Day</label>
                        </div>
                    </div>

                    <!-- BIRTH YEAR -->
                    <div class="col">
                        <div class="form-floating">
                            <select 
                                name="year"
                                id="year" 
                                class="form-select"
                            >
                                <option value="0">Year</option>
                                <?php
                                    for($i = date("Y"); $i > 1900; $i--) {
                                        $selected = '';
                                        if($year == $i) $selected = "selected";
                                    
                                ?>
                                <option 
                                    value="<?= $i ?>"
                                    <?= $selected ?>
                                >
                                    <?= $i ?>
                                </option>
                                <?php } ?>
                            </select>
                            <label for="year">Year</label>
                        </div>
                    </div>

                    <!-- AGE -->
                    <div class="col">
                        <div class="form-floating">
                            <input 
                                type="number" 
                                name="age"
                                id="age"
                                class="form-control"
                                placeholder="Age"
                                value="<?= $infoRow['age'] ?>"
                                readonly
                            />
                            <label for="age">Age</label>
                        </div>
                    </div>
                </div>
                <button 
                    type="submit"
                    class="body-btn float-end"
                    name="save"
                >
                    Save
                </button>
            </div>
       </form> 
    </section>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
    <script src="../js/age.js"></script>
    <script src="../js/image-preview.js"></script>
    <!-- <script>
        const form = document.querySelector('form')
        form.addEventListener('submit', (e) => {
            if(!form.checkValidity()) {
                e.preventDefault()
            }
            form.classList.add('was-validated')
        })
    </script> -->
</body>
</html>