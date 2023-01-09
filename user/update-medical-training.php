<?php
    require_once "../user-action/medical-training-action.php";

    if(isset($_POST['auth']) && isset($_SESSION['user_id'])) {
        header("Location: ./profile.php?id=".$_SESSION['user_id']);
        exit();
    } else if(!isset($_SESSION['auth']) && !isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit();
    }

    $sRow = $result->fetch_assoc();
    
    function checkYear($year) {
        if($year === 0) {
            return '';
        }
        return $year;
    }

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

    <section>
        <form
            method="POST"
            autocmplete="off" 
        >
            <div class="container">
                <h2 class="mt-4">Medical School & Training Institution</h2>
                <hr/>
                <?php
                    if(isset($_SESSION['client_message'])) {
                        echo $_SESSION['client_message'];
                        unset($_SESSION['client_message']);
                    }
                ?>
                <!-- MEDICAL SCHOOL -->
                <div class="row mt-3 mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errMedSchool ? 'is-invalid' : '' ?>"
                                name="medical_school"
                                placeholder="Medical School"
                                value="<?= isset($_POST['medical_school']) ? $_POST['medical_school'] : $sRow['medical_school'] ?>"
                            />
                            <label for="medical_school">Medical school</label>
                            <span class="invalid-feedbac"><?= $errMedSchool ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="number" 
                                class="form-control <?= $errMedYear ? 'is-invalid' : '' ?>"
                                name="medical_year"
                                placeholder="Medical year graduated"
                                value="<?= isset($_POST['medical_year']) ? $_POST['medical_year'] : checkYear($sRow['year_graduated']) ?>"
                            />
                            <label for="mecical_year">Medical year graduated</label>
                            <span class="invalid-feedback"><?= $errMedYear ?></span>
                        </div>
                    </div>
                </div>

                <!-- TRAINING INSTITUTION -->
                <div class="row mt-3 mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errTrainInst ? 'is-invalid' : '' ?>"
                                name="training_institution"
                                placeholder="Training institution"
                                value="<?= isset($_POST['training_institution']) ? $_POST['training_institution'] : $sRow['training_school'] ?>" 
                            />
                            <label for="training_institution">Training institution</label>
                            <span class="invalid-feedback"><?= $errTrainInst ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="number"
                                class="form-control <?= $errTrainYear ? 'is-invalid' : '' ?>"
                                name="training_year"
                                placeholder="Training year graduated"
                                value="<?= isset($_POST['training_year']) ? $_POST['training_year'] : checkYear($sRow['year_finish']) ?>"
                            />
                            <label for="training_year">Training year graduated</label>
                            <span class="invalid-feedback"><?= $errTrainYear ?></span>
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
    <br/><br/><br/>
    <?php
        include "../footer.php";
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
</body>
</html>