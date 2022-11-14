<?php
    include 'action.php';
    $_SESSION['addId'] = $_GET['id'];
    // $page = $_GET['page'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./index.css">
    <title>Additional Information</title>
</head>
    <body>
        
    <nav>
        <a href="#"><img src="../images/phalogohd.png" alt="PHA Logo"></a>
        <div class="navi-links">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="members.php">Members</a></li>
                <li><a href="view.php?id=<?= $_SESSION['addId'] ?>">Go back</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-3 mb-2">
            <div class="col">
                <?= $message ?>
            </div>
        </div>
        <form method="POST" autocomplete="off">
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input 
                            type="text" 
                            name="addHospitalAff" 
                            placeholder="Hospital Affiliation" 
                            class="form-control <?= ($errAddHospital)? 'is-invalid':'' ?>"
                            value="<?= isset($_POST['addHospitalAff']) ? $_POST['addHospitalAff'] : '' ?>"
                        >
                        <label for="Hospital Affiliation" class="form-label">Hospital Affiliation</label>
                        <span class="invalid-feedback"><?= $errAddHospital?></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input 
                            type="number" 
                            name="addContactNumber" 
                            class="form-control <?= ($errAddContact)? 'is-invalid':'' ?>" 
                            placeholder="ContactNumber"
                            value="<?= isset($_POST['addContactNumber'])? $_POST['addContactNumber'] : '' ?>"
                        >
                        <label for="Contact Number" class="form-label">Contact Number</label>
                        <span class="invalid-feedback"><?= $errAddContact ?></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input 
                            type="text" 
                            name="addLandlineNumber" 
                            placeholder="Landline number" 
                            class="form-control <?= ($errAddLandline)? 'is-invalid':'' ?>"
                            value="<?= isset($_POST['addLandlineNumber'])? $_POST['addLandlineNumber'] : '' ?>"
                        >
                        <label for="Landline number" class="form-label">Landline number</label>
                        <span class="invalid-feedback"><?= $errAddLandline ?></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input 
                            type="text" 
                            name="addEmail" 
                            id="addEmail" 
                            placeholder="Email" 
                            class="form-control <?= ($errAddEmail) ? 'is-invalid':'' ?>"
                            value="<?= isset($_POST['addEmail'])? $_POST['addEmail'] : '' ?>"
                        >
                        <label for="email" class="form-label">Email</label>
                        <span class="invalid-feedback"><?= $errAddEmail ?></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button type="submit" name="addMoreInfo" id="addMoreInfo" class="body-btn">Save</button>
                </div>
            </div>
        </form>
    </div>
    </body>
</html>