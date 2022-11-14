<?php
    ob_start();
    session_start();
    if(isset($_SESSION['admin_auth'])) {
        header("Location: ./dashboard.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <title>Admin Panel</title>
</head>
<body>

    <section>
        <?php
            include "./includes/navigation.php";
        ?>
    </section>

    <main>
        <?php
            include "./admin-component/admin-login.php";
        ?>
    </main>
</body>
</html>
<?php
    ob_end_flush();
?>