<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/edit-committee.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Committee</title>
</head>
<body>
    <section>
        <?php
            include "./includes/navigation.php";
        ?>
    </section>
    <main>
        <div class="container my-5">
            <?php
                if(isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
            ?> 
            <form method="POST" autocomplete="off">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <input 
                            type="text"
                            class="form-control my-3 <?= $errCommittee ? 'is-invalid' : '' ?>"
                            name="committee"
                            placeholder="Committee"
                            value="<?= isset($_POST['committee']) ? $_POST['committee'] : $row['committee'] ?>" 
                        />
                        <span class="invalid-feedback"><?= $errCommittee ?></span>
                        <button name="editCommittee" class="btn btn-primary float-end">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>