<?php
    require_once "./user-action/forgotpassword.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <title>Forgot Password</title>
</head>
<body>
    <div class="bg">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a href="./index.php" class="navbar-brand">
                    <img src="./images/phafinallogo.png" width="350" height="100" alt="Logo" />
                </a>
            </div>
        </nav>
       </nav>

       <section>
            <form method="post" autocomplete="off">
                <div class="container my-5">
                    <?php
                        if(isset($_SESSION['client_status'])) {
                            echo $_SESSION['client_status'];
                            unset($_SESSION['client_status']);
                        }
                    ?>
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <input 
                                type="text" 
                                class="form-control my-3 <?= $errEmail ? 'is-invalid' : '' ?>" 
                                name="email" 
                                placeholder="Email" autofocus
                            />
                            <span class="invalid-feedback alert alert-danger"><?= $errEmail ?></span>
                            <button name="verifyEmail" class="btn btn-success float-end">Verify</button>
                        </div>
                    </div>
                </div>
            </form>
       </section>
    </div>
</body>
</html>