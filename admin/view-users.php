<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ../index.php");
    }
    require_once "./includes/connection.php";

    // GET ALL USERS
    $stmt = $conn->prepare("SELECT * FROM tbl_information INNER JOIN tbl_uid ON tbl_information.id = tbl_uid.userid");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All users</title>
</head>
<body>
    <section>
        <?php
            include "./includes/navigation.php";
        ?>
    </section>
    <main>
        <div class="container my-5">
            <h1>All users</h1>
            <hr/>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User UID</th>
                            <th>User Full name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row = $result->fetch_assoc()) :
                                if($row) :
                        ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['user_uid'] ?></td>
                            <td>
                                <?= $row['first_name'] ?>
                                <?= $row['middle_name'] ?>
                                <?= $row['last_name'] ?>
                                <?= $row['suffix'] ? $row['suffix'].'.' : $row['suffix'] ?>
                            </td>
                            <td><a href="./view-user.php?id=<?= $row['id'] ?>" class="btn btn-primary">Open</a></td>
                        </tr>
                        <?php
                                endif;
                            endwhile;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>