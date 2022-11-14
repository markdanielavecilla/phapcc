<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/get-chapter-lists.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chapter Lists</title>
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
                    <a href="./add-chapter.php" class="float-end btn btn-primary">Add Chapter</a>
                </div>
            </div>

            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Chapter ID</th>
                            <th>Chapter name</th>
                            <th>Status</th>
                            <th>User count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // while($userRow = $userResult->fetch_assoc()) :
                            while($row = $result->fetch_assoc()) :
                        ?>
                        <tr>
                            <td><?= $row['chapid'] ?></td>
                            <td><?= ucwords($row['chapter']) ?></td>
                            <td><?= ($row['status'] === 0) ? 'Active' : 'Inactive' ?></td>
                            <td><?= ($row['totalCount'] < 1) ? '0' : $row['totalCount'] ?></td>
                            <td>
                                <a href="./view-chapter.php?id=<?= $row['chapid'] ?>" class="btn btn-primary">Open</a>
                                <a href="./edit-chapter.php?id=<?= $row['chapid'] ?>" class="btn btn-success">Edit</a>
                                <a href="./delete-chapter.php?id=<?= $row['chapid'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php
                                // endwhile;
                            endwhile;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>


</body>
</html>