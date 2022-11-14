<?php
    require_once "../user-action/add-beneficiaries.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../index.css">
    <title>Add beneficiaries</title>
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
        <form method="post">
            <div class="container">
                <h2 class="mt-3">Add Beneficiaries</h2>
                <hr/>
                <?php
                    if(isset($_SESSION['client_message'])) {
                        echo $_SESSION['client_message'];
                        unset($_SESSION['client_message']);
                    }
                ?>
                <div class="row my-3 justify-content-center">
                    <div class="col-md-6">
                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                name="first_name"
                                class="form-control <?= $errFname ? 'is-invalid' : '' ?>"
                                placeholder="First name"
                                value="<?= isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>"
                                autofocus
                            />
                            <span class="invalid-feedback"><?= $errFname ?></span>
                            <label for="first_name">First name</label>
                        </div>

                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                name="middle_name"
                                class="form-control <?= $errMidName ? 'is-invalid' : '' ?>"
                                placeholder="Middle name"
                                value="<?= isset($_POST['middle_name']) ? $_POST['middle_name'] : '' ?>"
                            />
                            <span class="invalid-feedback"><?= $errMidName ?></span>
                            <label for="Middle_name">Middle name</label>
                        </div>

                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                name="last_name"
                                class="form-control <?= $errLname ? 'is-invalid' : '' ?>"
                                placeholder="Last name"
                                value="<?= isset($_POST['last_name']) ? $_POST['last_name'] : '' ?>"
                            />
                            <span class="invalid-feedback"><?= $errLname ?></span>
                            <label for="last_name">Last name</label>
                        </div>

                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                name="suffix"
                                class="form-control <?= $errSuffix ? 'is-invalid' : '' ?>"
                                placeholder="Suffix"
                                value="<?= isset($_POST['suffix']) ? $_POST['suffix'] : '' ?>"
                            />
                            <span class="invalid-feedback"><?= $errSuffix ?></span>
                            <label for="suffix">Suffix</label>
                        </div>

                        <button class="btn btn-success float-end" name="addBeneficiaries">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>