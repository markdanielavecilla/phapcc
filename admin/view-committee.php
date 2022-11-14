<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ../index.php");
    }
    require_once "./includes/connection.php";

    $committeeId = $_GET['id'];

    // get committee
    $stmt = $conn->prepare("SELECT committee FROM tbl_committee WHERE cmt_id = ?");
    $stmt->bind_param("i", $committeeId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // GET USER BASED ON COMMITTEE OPENED
    $committee = $conn->prepare("SELECT * FROM tbl_information INNER JOIN tbl_hospital_committee ON tbl_information.id = tbl_hospital_committee.information_id INNER JOIN tbl_committee ON tbl_hospital_committee.cmt_id = tbl_committee.cmt_id WHERE tbl_hospital_committee.cmt_id = ?");
    $committee->bind_param("i", $committeeId);
    $committee->execute();
    $cmtResult = $committee->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Views</title>
</head>
<body>
    <section>
        <?php
            include "./includes/navigation.php";
        ?>
    </section>

    <main>
        <div class="container my-5">
            <h1><?= ucwords($row['committee']) ?></h1>
            <hr/>
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Full name</th>
                                <th>User Committee</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                while($cmtRow = $cmtResult->fetch_assoc()) :
                                    if($cmtRow) :
                            ?>
                            <tr>
                                <td><?= $cmtRow['id'] ?></td>
                                <td>
                                    <?= ucwords($cmtRow['first_name']) ?> <?= ucwords($cmtRow['middle_name']) ?> <?= ucwords($cmtRow['last_name']) ?>
                                </td>
                                <td><?= ucwords($cmtRow['committee']) ?></td>
                                <td>
                                    <a href="./view-user.php?id=<?= $cmtRow['id'] ?>" class="btn btn-primary">View</a>
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