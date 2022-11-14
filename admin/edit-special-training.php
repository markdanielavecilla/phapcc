<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/edit-special-training.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit special training</title>
</head>
<body>
    <section>
        <?php
            include "./includes/navigation.php";
        ?>
    </section>
    <div class="container my-5">
        <?php
            if(isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
            }
        ?>
        <form autocomplete="off" method="post">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <input 
                        type="text"
                        class="form-control my-5 <?= $errSpecialTraining ? 'is-invalid' : '' ?>"
                        name="special_training"
                        placeholder="Special training"
                        value="<?= isset($_POST['special_training']) ? $_POST['special_training'] : $row['special_training'] ?>"
                        autofocus 
                    />
                    <span class="invalid-feedback"><?= $errSpecialTraining ?></span>
                    <button name="editSpecialTraining" class="btn btn-primary float-end">Save</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>