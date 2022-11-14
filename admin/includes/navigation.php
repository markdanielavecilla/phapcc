<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"/>
    <title>Document</title>
</head>
<body>


    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
        <div class="container">
            <a class="navbar-brand" href="./index.php">
                Admin Panel
            </a>

            <ul class="navbar-nav d-flex">
                <?php
                    if(isset($_SESSION['admin_auth'])) :
                ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./dashboard.php">Home</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="./chapter-list.php">Chapters</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Special Training</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="./includes/logout.php">Logout</a>
                    </li>
                <?php
                    endif;
                ?>
            </ul>
            
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>