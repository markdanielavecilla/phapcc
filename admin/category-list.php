<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/get-category.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
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
                    <a href="./add-category.php" class="float-end btn btn-primary">Add Category</a>
                </div>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Category ID</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row = $result->fetch_assoc()) :
                        ?>
                        <tr>
                            <td><?= $row['catid'] ?></td>
                            <td><?= ucwords($row['category']) ?></td>
                            <td><?= ($row['status'] === 0) ? 'Active' : 'Inactive' ?></td>
                            <td>
                                <a href="./view-category.php?id=<?= $row['catid'] ?>" class="btn btn-primary">Open</a>
                                <a href="./edit-category.php?id=<?= $row['catid'] ?>" class="btn btn-success">Edit</a>
                                <a href="./delete-category.php?id=<?= $row['catid'] ?>" class="btn btn-danger">Delete</a>
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