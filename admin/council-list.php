<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/get-council.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Council</title>
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
                    <a href="./add-council.php" class="float-end btn btn-primary">Add Council</a>
                </div>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Council ID</th>
                            <th>Council</th>
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
                            <td><?= $row['council_id'] ?></td>
                            <td><?= ucwords($row['council']) ?></td>
                            <td><?= ($row['status'] === 0) ? 'Active' : 'Inactive' ?></td>
                            <td><?= $row['totalCount'] ?></td>
                            <td>
                                <a href="./view-council.php?id=<?= $row['council_id'] ?>" class="btn btn-primary btn-sm">Open</a>
                                <a href="./edit-council.php?id=<?= $row['council_id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="./delete-council.php?id=<?= $row['council_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
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