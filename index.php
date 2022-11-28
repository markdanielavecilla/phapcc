<?php
    ob_start();
    session_start();
    // $_SESSION = array();
    if(isset($_SESSION['auth']) && isset($_SESSION['user_id'])) {
        header("Location: ./user/profile.php?id=".$_SESSION['user_id']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"/>
    <link rel="stylesheet" href="index.css">
    <title>PHA Members</title>
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
        <section>
            <div class="container my-4">
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-6 m-auto">
                        <?php
                            include "./login.php"
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include "./footer.php";
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    ob_end_flush();
?>