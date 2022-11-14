<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ../index.php");
    }

    require_once "./includes/connection.php";

    $chapterId = $_GET['id'];

    // get chapter
    $stmt = $conn->prepare("SELECT chapter FROM tbl_chapter WHERE chapid = ?");
    $stmt->bind_param("i", $chapterId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // get user based on chapter
    $stmt = $conn->prepare("SELECT * FROM tbl_information INNER JOIN tbl_hospital_chapter ON tbl_information.id = tbl_hospital_chapter.information_id INNER JOIN tbl_chapter ON tbl_hospital_chapter.chapter_id = tbl_chapter.chapid WHERE chapid = ?");
    $stmt->bind_param('i', $chapterId);
    $stmt->execute();
    $userResult = $stmt->get_result();
    // $userRow = $userResult->fetch_assoc();
    // print_r($userRow);

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
            <h1><?= ucwords($row['chapter']) ?></h1>
            <hr/>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User Full name</th>
                            <th>User Chapter</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($userRow = $userResult->fetch_assoc()) :
                                if($userRow) :
                        ?>
                        <tr>
                            <td><?= $userRow['id'] ?></td>
                            <td><?= ucwords($userRow['first_name']) ?> <?= ucwords($userRow['middle_name']) ?> <?= ucwords($userRow['last_name']) ?></td>
                            <td><?= ucwords($userRow['chapter']) ?></td>
                            <td>
                                <a href="view-user.php?id=<?= $userRow['id'] ?>" class="btn btn-primary">View</a>
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
    </main>
    
</body>
</html>