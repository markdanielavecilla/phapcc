<?php
    require_once "../user-action/edit-additional-affiliation-action.php";
    $row = $result->fetch_assoc();

    if(isset($_POST['auth']) && isset($_SESSION['user_id'])) {
        header("Location: ./profile.php?id=".$_SESSION['user_id']);
        exit();
    } else if(!isset($_SESSION['auth']) && !isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit();
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
        <form method="POST" autocomplete="off">
            <div class="container">
                <h2 class="mt-3">Update Affiliation</h2>
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
                                name="update_add_affiliation"
                                class="form-control"
                                placeholder="Hospital affiliation"
                                value="<?= isset($_POST['update_add_affiliation']) ? $_POST['update_add_affiliation'] : $row['hospital_aff'] ?>"
                            />
                            <label for="hospital_aff">Hospital affiliation</label>
                        </div>

                        <div class="form-floating mt-2 mb-2">
                            <input 
                                type="number"
                                name="update_contact_number"
                                class="form-control"
                                placeholder="Contact number"
                                value="<?= isset($_POST['update_contact_number']) ? $_POST['update_contact_number'] : $row['contact'] ?>"
                            />
                            <label for="contact_number">Contact number</label>
                        </div>

                        <div class="form-floating mt-2 mb-2">
                            <input 
                                type="text"
                                name="update_landline"
                                class="form-control"
                                placeholder="Landline number"
                                value="<?= isset($_POST['update_landline']) ? $_POST['update_landline'] : $row['landline'] ?>"
                            />
                            <label for="add_landline">Landline number</label>
                        </div>

                        <button 
                            class="btn btn-success" 
                            name="update_affiliation"
                        >Save</button>
                        <a 
                            class="btn btn-danger"
                            href="./profile.php?id=<?= $USER_ID ?>"
                        >Back</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
</body>
</html>