<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ../index.php");
    }
    require_once "./includes/connection.php";

    $categoryId = $_GET['id'];

    // GET CATEGORY
    $stmt = $conn->prepare("SELECT category from tbl_drcategory WHERE catid = ?");
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // GET USER BASED ON CATEGORY OPENED
    $category = $conn->prepare("SELECT * FROM tbl_information INNER JOIN tbl_hospital_drcategory ON tbl_information.id = tbl_hospital_drcategory.information_id INNER JOIN tbl_drcategory ON tbl_hospital_drcategory.category_id = tbl_drcategory.catid WHERE category_id = ?");
    $category->bind_param("i", $categoryId);
    $category->execute();
    $categoryResult = $category->get_result();
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
            <h1><?= ucwords($row['category']) ?></h1>
            <hr/>
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Full name</th>
                                <th>User Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while ($categoryRow = $categoryResult->fetch_assoc()) :
                                    if($categoryRow) :
                            ?>
                            <tr>
                                <td><?= $categoryRow['id'] ?></td>
                                <td><?= ucwords($categoryRow['first_name']) ?> <?= ucwords($categoryRow['middle_name']) ?> <?= ucwords($categoryRow['last_name']) ?></td>
                                <td><?= ucwords($categoryRow['category']) ?></td>
                                <td>
                                    <a href="./view-user.php?id=<?= $categoryRow['id'] ?>" class="btn btn-primary">View</a>
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