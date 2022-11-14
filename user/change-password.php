<?php
    session_start();
    if(isset($_POST['auth']) && isset($_SESSION['user_id'])) {
        header("Location: ./profile.php?id=".$_SESSION['user_id']);
        exit();
    } else if(!isset($_SESSION['auth']) && !isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit();
    }
    require_once "../user-action/changepassword.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../index.css">
    <title>Change password</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a href="../index.php" class="navbar-brand">
                <img src="../images/phafinallogo.png" width="350" height="100" alt="Logo" />
            </a>
            <button 
                class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#navbar"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="./profile.php?id=<?= $_GET['id'] ?>" class="nav-link">Profile</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Account</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="./change-password.php?id=<?= $_GET['id'] ?>" class="dropdown-item">Change password</a>
                            </li>
                            <li>
                                <a href="./logout.php" class="dropdown-item">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section>
        <form autocomplete="off" method="post">
            <div class="container">
                <h2 class="mt-3">Change password</h2>
                <hr/>
                <?php
                    if(isset($_SESSION['client_message'])) {
                        echo $_SESSION['client_message'];
                        unset($_SESSION['client_message']);
                    }
                ?>
                <div class="row my-3 justify-content-center">
                    <div class="col-md-6">
                        <div class="input-group my-2">
                            <input 
                                type="password" 
                                class="form-control <?= $errOp ? 'is-invalid' : '' ?>"
                                style="box-shadow:none"
                                name="old_password"
                                placeholder="Old password"
                                value="<?= isset($_POST['old_password']) ? $_POST['old_password'] : '' ?>"
                            />
                            
                            <span class="input-group-text" id="show_oPass"><i class="fa-solid fa-eye"></i></span>
                            <span class="invalid-feedback"><?= $errOp ?></span>
                        </div>

                        <div class="input-group my-3">
                            <input 
                                type="password"
                                class="form-control <?= $errNp ? 'is-invalid' : '' ?>"
                                style="box-shadow:none"
                                id="new_password"
                                name="new_password"
                                placeholder="New password"
                                value="<?= isset($_POST['new_password']) ? $_POST['new_password'] : '' ?>"
                            />
                            <span class="input-group-text"><i class="fa-solid fa-eye"></i></span>
                            <span class="invalid-feedback"><?= $errNp ?></span>
                        </div>

                        <div class="input-group my-3">
                            <input 
                                type="password"
                                class="form-control <?= $errNp ? 'is-invalid' : '' ?>"
                                style="box-shadow:none"
                                id="repeat_password"
                                name="repeat_password"
                                placeholder="Repeat password"
                                value="<?= isset($_POST['repeat_password']) ? $_POST['repeat_password'] : '' ?>"
                            />
                            <span class="input-group-text"><i class="fa-solid fa-eye"></i></span>
                        </div>

                        <button class="btn btn-success float-end" name="savePassword">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>