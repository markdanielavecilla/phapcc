<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/update-contact-person.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Contact person</title>
</head>
<body>
    <section>
        <?php
            include "./includes/navigation.php";
        ?>
    </section>
    <main>
        <form method="post">
            <div class="container">
                <h2 class="mt-3">
                    Update Emergency contact
                    <span>
                        <a href="./view-user.php?id=<?= $_SESSION['admin_user_id'] ?>" class="btn btn-outline-danger float-end">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </a>
                    </span>
                </h2>
                <hr/>
                <?php
                    if(isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                ?>
                <div class="row my-3 justify-content-center">
                    <div class="col-md-6">
                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                class="form-control <?= $errFname ? 'is-invalid' : '' ?>"
                                name="first_name"
                                placeholder="First name"
                                value="<?= isset($_POST['first_name']) ? $_POST['first_name'] : $rowContact['cp_first_name'] ?>"
                            />
                            <label for="first_name">First name</label>
                            <span class="invalid-feedback"><?= $errFname ?></span>
                        </div>

                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                class="form-control <?= $errMidName ? 'is-invalid' : '' ?>"
                                name="middle_name"
                                placeholder="Middle name"
                                value="<?= isset($_POST['middle_name']) ? $_POST['middle_name'] : $rowContact['cp_middle_name'] ?>"
                            />
                            <label for="middle_name">Middle name</label>
                            <span class="invalid-feedback"><?= $errMidName ?></span>
                        </div>

                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                class="form-control <?= $errLname ? 'is-invalid' : '' ?>"
                                name="last_name"
                                placeholder="Last name"
                                value="<?= isset($_POST['last_name']) ? $_POST['last_name'] : $rowContact['cp_last_name'] ?>"
                            />
                            <label for="last_name">Last name</label>
                            <span class="invalid-feedback"><?= $errLname ?></span>
                        </div>

                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                class="form-control <?= $errMobile ? 'is-invalid' : '' ?>"
                                name="mobile"
                                placeholder="Mobile number"
                                value="<?= isset($_POST['mobile']) ? $_POST['mobile'] : $rowContact['cp_mobile_number'] ?>"
                            />
                            <label for="mobile">Mobile number</label>
                            <span class="invalid-feedback"><?= $errMobile ?></span>
                        </div>

                        <button 
                            class="btn btn-success float-end"
                            name="save"
                        >
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </main>
</body>
</html>