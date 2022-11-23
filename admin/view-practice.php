<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ../index.php");
    }
    require_once "./includes/connection.php";

    $practiceId = $_GET['id'];

    // GET PRACTICE
    $stmt = $conn->prepare("SELECT practice FROM tbl_practice WHERE practice_id = ?");
    $stmt->bind_param("i", $practiceId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // GET USER BASED ON PRACTICE OPENED
    $practice = $conn->prepare("SELECT * FROM tbl_information INNER JOIN tbl_hospital_practice ON tbl_information.id = tbl_hospital_practice.information_id INNER JOIN tbl_practice ON tbl_hospital_practice.practice_id = tbl_practice.practice_id WHERE tbl_hospital_practice.practice_id = ?");
    $practice->bind_param("i", $practiceId);
    $practice->execute();
    $practiceResult = $practice->get_result();
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
                <?= ucwords($row['practice']) ?>
                <span>
                    <a href="./practice-list.php" class="btn btn-outline-danger float-end">
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
                                <th>User Practice</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($practiceRow = $practiceResult->fetch_assoc()) :
                                    if($practiceRow) :
                            ?>
                                <td><?= $practiceRow['id'] ?></td>
                                <td><?= ucwords($practiceRow['first_name']) ?> <?= ucwords($practiceRow['middle_name']) ?> <?= ucwords($practiceRow['last_name']) ?> </td>
                                <td><?= $practiceRow['practice'] ?></td>
                                <td>
                                    <a href="./view-user.php?id=<?= $practiceRow['id'] ?>" class="btn btn-primary">View</a>
                                </td>
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