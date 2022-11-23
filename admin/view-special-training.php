<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ../index.php");
    }
    require_once "./includes/connection.php";

    $specialTrainingId = $_GET['id'];

    // GET SPECIAL TRAINING
    $stmt = $conn->prepare("SELECT special_training FROM tbl_special_training WHERE st_id = ?");
    $stmt->bind_param("i", $specialTrainingId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // GET USER BASED ON SPECIAL TRAINING OPENED
    $specialTraining = $conn->prepare("SELECT * FROM tbl_information INNER JOIN tbl_hospital_special_training ON tbl_information.id = tbl_hospital_special_training.information_id INNER JOIN tbl_special_training ON tbl_hospital_special_training.special_training_id = tbl_special_training.st_id WHERE special_training_id = ?");
    $specialTraining->bind_param("i", $specialTrainingId);
    $specialTraining->execute();
    $specialTrainingResult = $specialTraining->get_result();
    $specialTraining->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
</head>
<body>
    <section>
        <?php
            include "./includes/navigation.php";
        ?>
    </section>
    <main>
        <div class="container my-5">
            <h2>
                <?= ucwords($row['special_training']) ?>
                <span>
                    <a href="./special-training-list.php" class="btn btn-outline-danger float-end">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </span>
            </h2>
            <hr/>
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Full name</th>
                                <th>User Special training</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($specialTrainingRow = $specialTrainingResult->fetch_assoc()) :
                                    if($specialTrainingRow) :
                            ?>
                            <tr>
                                <td><?= $specialTrainingRow['id'] ?></td>
                                <td>
                                    <?= ucwords($specialTrainingRow['first_name']) ?>
                                    <?= ucwords($specialTrainingRow['middle_name']) ?>
                                    <?= ucwords($specialTrainingRow['last_name']) ?>
                                </td>
                                <td><?= ucwords($specialTrainingRow['special_training']) ?></td>
                                <td>
                                    <a href="./view-user.php?id=<?= $specialTrainingRow['id'] ?>" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                            <?php
                                    endif;
                                endwhile;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>