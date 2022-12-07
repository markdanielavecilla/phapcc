<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/add-affiliation.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add other affiliation</title>
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
                <a href="./view-user.php?id=<?= $user_id ?>" class="btn btn-outline-danger float-end">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
                <h2 class="mt-3">Additional Affiliation</h2>
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
                                name="add_affiliation"
                                class="form-control"
                                placeholder="Hospital Affiliation"
                                value="<?= isset($_POST['add_affiliation']) ? $_POST['add_affiliation'] : '' ?>"
                            />
                            <label for="hospital_affiliation">Hospital Affiliation</label>
                        </div>

                        <div class="form-floating my-2">
                            <input 
                                type="number"
                                name="add_contact_number"
                                class="form-control"
                                placeholder="Contact number"
                                value="<?= isset($_POST['add_contact_number']) ? $_POST['add_contact_number'] : '' ?>"
                            />
                            <label for="contact_number">Contact number</label>
                        </div>

                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                name="add_landline"
                                class="form-control"
                                placeholder="Landline number"
                                value="<?= isset($_POST['add_landline']) ? $_POST['add_landline'] : '' ?>"
                            />
                            <label for="add_landline">Landline number</label>
                        </div>

                        <button
                            class="btn btn-success float-end"
                            name="save"
                        >Save</button>
                    </div>
                </div>
            </div>
        </form>
    </main>
</body>
</html>