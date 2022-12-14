<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/update-beneficiary.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Beneficiary</title>
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
                    Update Beneficiary
                    <a href="./view-user.php?id=<?= $user_id ?>#beneficiaries" class="btn btn-outline-danger float-end">
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
                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                class="form-control"
                                name="first_name"
                                placeholder="First name"
                                value="<?= isset($_POST['first_name']) ? $_POST['first_name'] : $rowBen['ben_first_name'] ?>"
                            />
                            <label for="first_name">First name</label>
                        </div>

                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                class="form-control"
                                name="middle_name"
                                placeholder="Middle name"
                                value="<?= isset($_POST['middle_name']) ? $_POST['middle_name'] : $rowBen['ben_middle_name'] ?>"
                            />
                            <label for="middle_name">Middle name</label>
                        </div>

                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                class="form-control"
                                name="last_name"
                                placeholder="Last name"
                                value="<?= isset($_POST['last_name']) ? $_POST['last_name'] : $rowBen['ben_last_name'] ?>"
                            />
                            <label for="last_name">Last name</label>
                        </div>

                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                class="form-control"
                                name="suffix"
                                placeholder="Suffix"
                                value="<?= isset($_POST['suffix']) ? $_POST['suffix'] : $rowBen['ben_suffix'] ?>"
                            />
                            <label for="suffix">Suffix</label>
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