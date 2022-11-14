<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/counter.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    
    <!-- NAVIGATION -->
    <?php
        include "./includes/navigation.php";
    ?>

    <!-- CARDS -->
    <div class="container mt-5 mb-3">
        <h1>Dashboard</h1>
        <hr/>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem">
                    <div class="card-body">
                        <h5 class="card-title">All users</h5>
                        <p class="cart-text">Total user: <?= $userRow['totalUser'] ?> </p>
                        <a href="./view-users.php" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Chapters</h5>
                        <p class="card-text">Chapter count: <?= $chapterRow['totalChapter'] ?></p>
                        <a href="./chapter-list.php" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Committee</h5>
                        <p class="card-text">Committee count: <?= $committeeRow['totalCommittee'] ?></p>
                        <a href="./committee-list.php" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Council</h5>
                        <p class="card-text">Council count: <?= $councilRow['totalCouncil'] ?></p>
                        <a href="./council-list.php" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Category</h5>
                        <p class="card-text">Category count: <?= $categoryRow['totalCategory'] ?></p>
                        <a href="./category-list.php" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Practice</h5>
                        <p class="card-text">Practice count: <?= $practiceRow['totalPractice'] ?> </p>
                        <a href="./practice-list.php" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Special Training</h5>
                        <p class="card-text">Special training count: <?= $specialTrainingRow['totalSpecialTraining'] ?></p>
                        <a href="./special-training-list.php" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Subspecialty</h5>
                        <p class="card-text">Subspecialty count: <?= $subspecialtyRow['totalSubspecialty'] ?></p>
                        <a href="./subspecialty-list.php" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>