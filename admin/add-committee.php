<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/add-committee.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Committee</title>
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
                if(isset($_SESSION['message'])) :
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                endif;
            ?>
            <form method="POST" autocomplete="off">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <input 
                            type="text" 
                            class="form-control my-3 <?= $errComm ? 'is-invalid':'' ?>" 
                            autofocus 
                            name="committee-title" 
                            placeholder="Committee"
                            value="<?= isset($_POST['committee-title']) ? $_POST['committee-title'] : '' ?>"
                        >
                        <span class="invalid-feedback"><?= $errComm ?></span>
                        <button name="addCommittee" class="btn btn-primary float-end">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

</body>
</html>