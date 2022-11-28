<?php
    ob_start();
    session_start();
    // CHECK IF THERE IS EMAIL PRESENT
    if(!isset($_SESSION['user_email'])) {
        header("Location: ./index.php");
        return;
    }
    require_once "./user-action/resetpassword.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <title>Reset Password</title>
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a href="./index.php" class="navbar-brand">
                    <img src="./images/phafinallogo.png" width="350" height="100" alt="Logo" />
                </a>
            </div>
        </nav>

       <main>
            <form method="post">
                <div class="container my-5">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <input 
                                type="password" 
                                name="newPassword" 
                                placeholder="New password" 
                                class="form-control my-3"
                                autofocus
                            />
                            <button name="updatePassword" class="btn btn-success float-end">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
       </main>
    </div>
    <?php
        include "./footer.php";
    ?>
</body>
</html>
<?php
    ob_end_flush();
?>