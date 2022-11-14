<?php
    require_once '../actions/beneficiary-action.php';
    // require_once '../actions/update-beneficiary-action.php';
    // echo $_SESSION['beneficiary_id'];
    $row = $result->fetch_assoc();
    // echo $row['ben_first_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <title>Update Beneficiaries</title>
</head>
    <body>
        
    <nav>
        <a href="#"><img src="../images/phalogohd.png" alt="PHA Logo"></a>
        <div class="navi-links">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="members.php">Members</a></li>
                <li><a href="view.php?id=<?= $_SESSION['beneficiary_id'] ?>">Go back</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <form method="POST" autocomplete="off">
            <div class="row mt-5 justify-content-md-center">
                <div class="col-5">
                <h2 class="mb-3">Update Beneficiary</h2>
                    <div class="form-floating mt-2 mb-3">
                        <input 
                            type="text" 
                            name="firstname" 
                            class="form-control <?= $errFirstname ? 'is-invalid' : '' ?>"
                            placeholder="First name"
                            value="<?= $row['ben_first_name'] ?>"
                        />
                        <label for="firstname" class="form-label">First name</label>
                        <span class="invalid-feedback"><?= $errFirstname ?></span>
                    </div>

                    <div class="form-floating mt-2 mb-3">
                        <input 
                            type="text" 
                            name="middlename" 
                            class="form-control <?= $errMiddlename ? 'is-invalid': '' ?>"
                            placeholder="Middle name"
                            value="<?= $row['ben_middle_name'] ?>"
                        />
                        <label for="edit_ben_fname" class="form-label">Middle name</label>
                        <span class="invalid-feedback"><?= $errMiddlename ?></span>
                    </div>

                    <div class="form-floating mt-2 mb-3">
                        <input 
                            type="text" 
                            name="lastname" 
                            class="form-control <?= $errLastname ? 'is-invalid': '' ?>"
                            placeholder="Last name"
                            value="<?= $row['ben_last_name'] ?>"
                        />
                        <label for="edit_ben_fname" class="form-label">Last name</label>
                        <span class="invalid-feedback"><?= $errLastname ?></span>
                    </div>

                    <div class="form-floating mt-2 mb-3">
                        <input 
                            type="text" 
                            name="suffix" 
                            class="form-control <?= $errSuffix ? 'is-invalid': '' ?>"
                            placeholder="Suffix"
                            value="<?= $row['ben_suffix'] ?>"
                        />
                        <label for="suffix" class="form-label">Suffix</label>
                        <span class="invalid-feedback"><?= $errSuffix ?></span>
                    </div>

                    <button 
                        class="body-btn"
                        name="save_beneficiaries"
                        type="submit"
                    >Save
                    </button>

                </div>
            </div>
        </form> 
    </div>

    </body>
</html>