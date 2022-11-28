<?php
    require_once "../user-action/year-as-action.php";

    if(isset($_POST['auth']) && isset($_SESSION['user_id'])) {
        header("Location: ./profile.php?id=".$_SESSION['user_id']);
        exit();
    } else if(!isset($_SESSION['auth']) && !isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit();
    }
    // echo $USER_ID;
    $yearRow = $result->fetch_assoc();

    function yearCheck($data) {
        if($data === 0) {
            return '';
        }
        return $data;
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
    <title>Year as</title>
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
                <h2 class="mt-4">Year as</h2>
                <hr/>
                <?$errorMessage?>
                <div class="row mt-3 mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="number"
                                name="fellow"
                                placeholder="Fellow"
                                class="form-control <?= $errFellow ? 'is-invalid':'' ?>"
                                value="<?= isset($_POST['fellow']) ? $_POST['fellow'] : yearCheck($yearRow['fellow_year']) ?>"
                            />
                            <label for="fellow">Fellow</label>
                            <span class="invalid-feedback"><?= $errFellow ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="number"
                                name="life_fellow"
                                placeholder="Life fellow"
                                class="form-control <?= $errLifefellow ? 'is-invalid' : '' ?>"
                                value="<?= isset($_POST['life_fellow']) ? $_POST['life_fellow'] : yearCheck($yearRow['life_fellow_year']) ?>"
                            />
                            <label for="life_fellow">Life fellow</label>
                            <span class="invalid-feedback"><?= $errLifefellow ?></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3 mt-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="number"
                                name="diplomate"
                                placeholder="Diplomate"
                                class="form-control <?= $errDiplomate ? 'is-invalid' : '' ?>"
                                value="<?= isset($_POST['diplomate']) ? $_POST['diplomate'] : yearCheck($yearRow['diplomate_year']) ?>"
                            />
                            <label for="diplomate">Diplomate</label>
                            <span class="invalid-feedback"><?= $errDiplomate ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="number"
                                name="life_member"
                                placeholder="Life member"
                                class="form-control <?= $errLifemember ? 'is-invalid' : '' ?>"
                                value="<?= isset($_POST['life_member']) ? $_POST['life_member'] : yearCheck($yearRow['life_member_year']) ?>"
                            />
                            <label for="life_member">Life member</label>
                            <span class="invalid-feedback"><?= $errLifemember ?></span>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="number"
                                name="associate_fellow"
                                placeholder="Associate fellow"
                                class="form-control <?= $errAssociatefellow ? 'is-invalid' : '' ?>"
                                value="<?= isset($_POST['associate_fellow']) ? $_POST['associate_fellow'] : yearCheck($yearRow['associate_fellow']) ?>" 
                            />
                            <label for="associate_fellow">Associate fellow</label>
                            <span class="invalid-feedback"><?= $errAssociatefellow ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="number"
                                name="associate"
                                placeholder="associate"
                                class="form-control <?= $errAssociate ? 'is-invalid' : '' ?>"
                                value="<?= isset($_POST['associate']) ? $_POST['associate'] : yearCheck($yearRow['associate']) ?>"
                            />
                            <label for="associate">Associate</label>
                            <span class="invalid-feedback"><?= $errAssociate ?></span>
                        </div>
                    </div>
                </div>
                <button
                    type="submit"
                    name="save"
                    class="body-btn float-end"
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