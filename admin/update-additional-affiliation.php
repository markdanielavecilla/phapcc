<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/update-additional-affiliation.php";

    // print_r($_SESSION[]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Additional Information</title>
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
                    Update Affiliation
                    <span>
                        <a href="./view-user.php?id=<?= $_SESSION['admin_user_id'] ?>" class="btn btn-outline-danger float-end">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </a>
                    </span>
                </h2>

                <hr/>

                <div class="row my-3 justify-content-center">
                    <div class="col-md-6">
                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                name="update_add_affiliation"
                                class="form-control"
                                placeholder="Hospital Affiliation"
                                value="<?= isset($_POST['update_add_affiliation']) ? $_POST['update_add_affiliation'] : $rowAff['hospital_aff'] ?>"
                            />
                            <label for="hospital_aff">Hospital Affiliation</label>
                        </div>
    
                        <div class="form-floating my-2">
                            <input 
                                type="number"
                                name="update_contact_number"
                                class="form-control"
                                placeholder="Contact number"
                                value="<?= isset($_POST['update_contact_number']) ? $_POST['update_contact_number'] : $rowAff['contact'] ?>"
                            />
                            <label for="contact_number">Contact number</label>
                        </div>
    
                        <div class="form-floating my-2">
                            <input 
                                type="text"
                                name="update_landline"
                                class="form-control"
                                placeholder="Landline number"
                                value="<?= isset($_POST['update_landline']) ? $_POST['update_landline'] : $rowAff['landline'] ?>"
                            />
                            <label for="update_landline">Landline number</label>
                        </div>
    
                        <button
                            class="btn btn-success"
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