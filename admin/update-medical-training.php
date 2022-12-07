<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/update-medical-training.php";

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
    <title>Update medical and training institution</title>
</head>
<body>
    <section>
        <?php 
            include "./includes/navigation.php";
        ?>
    </section>

    <main>
        <form 
            method="post"
            autocomplete="off"
        >
            <div class="container">
                <a href="./view-user.php?id=<?= $user_id ?>" class="btn btn-outline-danger float-end">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
                <h2 class="mt-4">Medical School & Training Institution</h2>
                <hr/>

                <!-- Medical School -->
                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errMschool ? 'is-invalid':'' ?>"
                                name="medical_school"
                                placeholder="Medical School"
                                value="<?= isset($_POST['medical_school']) ? $_POST['medical_school'] : $row['medical_school'] ?>"
                            />
                            <label for="medical_school">Medical School</label>
                            <span class="invalid-feedback"><?= $errMschool ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="number"
                                class="form-control <?= $errMyear ? 'is-invalid':'' ?>"
                                name="medical_year"
                                placeholder="Medical year graduated"
                                value="<?= isset($_POST['medical_year']) ? $_POST['medical_year'] : checkYear($row['year_graduated']) ?>"
                            />
                            <label for="medical_year">Medical Year</label>
                            <span class="invalid-feedback"><?= $errMyear ?></span>
                        </div>
                    </div>
                </div>

                <!-- Training Institution -->
                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errTins ? 'is-invalid':'' ?>"
                                name="training_institution"
                                placeholder="Training Institution"
                                value="<?= isset($_POST['training_institution']) ? $_POST['training_institution'] : $row['training_school'] ?>"
                            />
                            <label for="training_institution">Training Institution</label>
                            <span class="invalid-feedback"><?= $errTins ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="number"
                                class="form-control <?= $errTyear ? 'is-invalid':'' ?>"
                                placeholder="Training year graduated"
                                name="training_year"
                                value="<?= isset($_POST['training_year']) ? $_POST['training_year'] : checkYear($row['year_finish']) ?>"
                            />
                            <label for="training_year">Training year graduated</label>
                            <span class="invalid-feedback"><?= $errTyear ?></span>
                        </div>
                    </div>
                </div>
                <button
                    type="submit"
                    class="btn btn-primary float-end"
                    name="save"
                >
                    Save
                </button>
            </div>
        </form>
    </main>
    
</body>
</html>