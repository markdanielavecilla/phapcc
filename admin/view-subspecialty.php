<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ../index.php");
    }
    require_once "./includes/connection.php";
    $subspecialtyId = $_GET['id'];

    // GET SUBSPECIALTY
    $stmt = $conn->prepare("SELECT subspecialty FROM tbl_subspecialty WHERE sub_id = ?");
    $stmt->bind_param("i", $subspecialtyId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // GET USER BASED ON SUBSPECIALTY OPENED
    $subspecialty = $conn->prepare("SELECT * FROM tbl_information INNER JOIN tbl_hospital_subspecialty ON tbl_information.id = tbl_hospital_subspecialty.information_id INNER JOIN tbl_subspecialty ON tbl_hospital_subspecialty.subspecialty_id = tbl_subspecialty.sub_id WHERE subspecialty_id = ?");
    $subspecialty->bind_param("i", $subspecialtyId);
    $subspecialty->execute();
    $subspecialtyResult = $subspecialty->get_result();
    $subspecialty->close();
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
            <h1><?= ucwords($row['subspecialty']) ?></h1>
            <hr/>
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Full name</th>
                                <th>User Subspecialty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($subspecialtyRow = $subspecialtyResult->fetch_assoc()) :
                                    if($subspecialtyRow) :
                            ?>
                            <tr>
                                <td>
                                    <?= $subspecialtyRow['id'] ?>
                                </td>
                                <td>
                                    <?= ucwords($subspecialtyRow['first_name']) ?>
                                    <?= ucwords($subspecialtyRow['middle_name']) ?>
                                    <?= ucwords($subspecialtyRow['last_name']) ?>
                                </td>
                                <td>
                                    <?= ucwords($subspecialtyRow['subspecialty']) ?>
                                </td>
                                <td>
                                    <a href="./view-user.php?id=<?= $subspecialtyRow['id'] ?>" class="btn btn-primary">View</a>
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