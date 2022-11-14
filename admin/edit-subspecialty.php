<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/edit-subspecialty.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit subspecialty</title>
</head>
<body>
    <section>
        <?php
            include "./includes/navigation.php";
        ?>
    </section>
    <main>
        <div class="container my-5">
            <form autocomplete="off" method="post">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <input 
                            type="text"
                            class="form-control my-3 <?= $errSubspecialty ? 'is-invalid' : '' ?>"
                            name="subspecialty"
                            placeholder="Subspecialty"
                            value="<?= isset($_POST['subspecialty']) ? $_POST['subspecialty'] : $row['subspecialty'] ?>"
                            autofocus
                        />
                        <span class="invalid-feedback"><?= $errSubspecialty ?></span>
                        <button name="editSubspecialty" class="btn btn-primary float-end">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>