<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/get-special-training.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <title>Special Training</title>
</head>
<body>

    <section>
        <?php
            include "./includes/navigation.php";
        ?>
    </section>

    <main>
        <div class="container my-5">
            <div class="row">
                <div class="col mb-3">
                    <a href="./dashboard.php" class="btn btn-outline-danger">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
                    <a href="./add-special-training.php" class="float-end btn btn-primary">Add Special training</a>
                </div>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Special Training ID</th>
                            <th>Special Training</th>
                            <th>Status</th>
                            <th>User count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row = $result->fetch_assoc()) :
                        ?>
                        <tr>
                            <td><?= $row['st_id'] ?></td>
                            <td><?= ucwords($row['special_training']) ?></td>
                            <td><?= ($row['status'] === 0) ? 'Active' : 'Inactive' ?></td>
                            <td><?= $row['totalCount'] ?></td>
                            <td>
                                <a href="./view-special-training.php?id=<?= $row['st_id'] ?>" class="btn btn-primary">Open</a>
                                <a href="./edit-special-training.php?id=<?= $row['st_id'] ?>" class="btn btn-success">Edit</a>
                                <a href="./delete-special-training.php?id=<?= $row['st_id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php
                            endwhile;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    
</body>
</html>