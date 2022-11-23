<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>

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
                <li class="nav-item">
                    <a class="nav-link" href="./includes/logout.php">Logout</a>
                </li>
            <?php
                endif;
            ?>
        </ul>  
    </div>
</nav>