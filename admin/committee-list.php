<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/get-committee.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <title>Committee</title>
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
                    <a href="./add-committee.php" class="float-end btn btn-primary">Add Committee</a>
                </div>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <th>Committee ID</th>
                        <th>Committee</th>
                        <th>Status</th>
                        <th>User count</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            while($row = $result->fetch_assoc()) :
                        ?>
                        <tr>
                            <td><?= $row['cmt_id'] ?></td>
                            <td><?= ucwords($row['committee']) ?></td>
                            <td><?= ($row['status'] === 0) ? 'Active' : 'Inactive' ?></td>
                            <td><?= $row['totalCount'] ?></td>
                            <td>
                                <a href="./view-committee.php?id=<?= $row['cmt_id'] ?>" class="btn btn-primary">Open</a>
                                <a href="./edit-committee.php?id=<?= $row['cmt_id'] ?>" class="btn btn-success">Edit</a>
                                <a href="./delete-committee.php?id=<?= $row['cmt_id'] ?>" class="btn btn-danger">Delete</a>
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