<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./includes/connection.php";

    $councilId = $_GET['id'];

    // GET COUNCIL
    $stmt = $conn->prepare("SELECT council FROM tbl_council WHERE council_id = ?");
    $stmt->bind_param("i", $councilId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // GET USER BASED ON COUNCIL OPENED
    $council = $conn->prepare("SELECT * FROM tbl_information INNER JOIN tbl_hospital_council ON tbl_information.id = tbl_hospital_council.information_id INNER JOIN tbl_council ON tbl_hospital_council.council_id = tbl_council.council_id WHERE tbl_hospital_council.council_id = ?");
    $council->bind_param("i", $councilId);
    $council->execute();
    $councilResult = $council->get_result();

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
                <?= ucwords($row['council'])?>
                <span>
                    <a href="./council-list.php" class="btn btn-outline-danger float-end">
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
                                <th>User Council</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($councilRow = $councilResult->fetch_assoc()) :
                                    if($councilRow) :
                            ?>
                            <tr>
                                <td><?= $councilRow['id'] ?></td>
                                <td>
                                    <?= ucwords($councilRow['first_name']) ?> <?= ucwords($councilRow['middle_name']) ?> <?= ucwords($councilRow['last_name']) ?>
                                </td>
                                <td><?= ucwords($councilRow['council']) ?></td>
                                <td>
                                    <a href="./view-user.php?id=<?= $councilRow['id'] ?>" class="btn btn-primary">View</a>
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