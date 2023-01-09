<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/add-contact-person.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contact Person</title>
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
                    Add contact person in case of emergency
                    <a href="./view-user.php?id=<?= $user_id ?>#contact_person" class="btn btn-outline-danger float-end">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
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
                        <div class="form-floating">
                            <input 
                                type="text"
                                name="first_name"
                                class="form-control <?= $errFname ? 'is-invalid' : '' ?>"
                                placeholder="First name"
                                value="<?= isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>"
                                autofocus
                            />
                            <label for="first_name">First name</label>
                            <span class="invalid-feedback"><?= $errFname ?></span>
                        </div>

                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                name="middle_name"
                                class="form-control <?= $errMidName ? 'is-invalid' : '' ?>"
                                placeholder="Middle name"
                                value="<?= isset($_POST['middle_name']) ? $_POST['middle_name'] : '' ?>"
                            />
                            <label for="middle_name">Middle name</label>
                            <span class="invalid-feedback"><?= $errMidName ?></span>
                        </div>

                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                name="last_name"
                                class="form-control <?= $errLname ? 'is-invalid' : '' ?>"
                                placeholder="Last name"
                                value="<?= isset($_POST['last_name']) ? $_POST['last_name'] : '' ?>"
                            />
                            <label for="last_name">Last name</label>
                            <span class="invalid-feedback"><?= $errLname ?></span>
                        </div>

                        <div class="form-floating my-2">
                            <input 
                                type="number"
                                name="mobile"
                                class="form-control <?= $errContact ? 'is-invalid' : '' ?>"
                                placeholder="Mobile number"
                                value="<?= isset($_POST['mobile']) ? $_POST['mobile'] : '' ?>"
                            />
                            <label for="mobile">Mobile number</label>
                            <span class="invalid-feedback"><?= $errContact ?></span>
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