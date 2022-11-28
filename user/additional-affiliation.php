<?php
    require_once "../user-action/additional-affiliation-action.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <form method="POST" autocomplete="off">
            <div class="container">
                <h2 class="mt-3">Additional Affiliation</h2>
                <hr/>
                <?php
                    if(isset($_SESSION['client_message'])) {
                        echo $_SESSION['client_message'];
                        unset($_SESSION['client_message']);
                    }
                ?>
                <div class="row mt-3 mb-2 justify-content-center">
                    <div class="col-md-6">
                        <div class="form-floating mt-2 mb-2">
                            <input 
                                type="text"
                                name="add_affiliation"
                                class="form-control <?= $errAddAffiliation ? 'is-invalid' : '' ?>"
                                placeholder="Hospital affiliation"
                            />
                            <label for="hospital_affiliation">Hospital affiliation</label>
                            <span class="invalid-feedback"><?= $errAddAffiliation ?></span>
                        </div>

                        <div class="form-floating mt-2 mb-2">
                            <input 
                                type="number"
                                name="add_contact_number"
                                class="form-control <?= $errAddContact ? 'is-invalid' : '' ?>"
                                placeholder="Contact number"
                            />
                            <label for="contact_number">Contact number</label>
                            <span class="invalid-feedback"><?= $errAddContact ?></span>
                        </div>

                        <div class="form-floating mt-2 mb-2">
                            <input 
                                type="text"
                                name="add_landline"
                                class="form-control <?= $errAddLandline ? 'is-invalid' : '' ?>"
                                placeholder="Landline number"
                            />
                            <label for="add_landline">Landline number</label>
                            <span class="invalid-feedback"><?= $errAddLandline ?></span>
                        </div>

                        <button 
                            class="btn btn-success float-end" 
                            name="save_additionalAffiliation"
                        >Save</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <?php
        include "../footer.php";
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>