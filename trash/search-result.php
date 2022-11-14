<?php
    include "./actions/search-action.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>

    <nav>
        <a href="#"><img src="images/phalogohd.png" alt="PHA Logo"></a>
        
        <div class="navi-links">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="members.php">Members</a></li>
                <li><a href="add.php">New Members</a></li>
            </ul>
        </div>
    </nav>

    <section class="result mt-3 mb-4">
        <div class="container">
            <?= $msgRes ?> 
        </div>
        <div class="container">
            <?php
                while($rows = $result->fetch_assoc()) :
            ?>
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img 
                            src="./images/uploads/<?= $rows['image_url']? $rows['image_url']: 'phalogohd.png' ?>" 
                            alt="<?= $rows['first_name'] ?>"
                        >
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize">
                                <?= $rows['first_name'] ?>
                                <?= $rows['middle_name'] ?>
                                <?= $rows['last_name'] ?>
                                <?= $rows['suffix'] ? $rows['suffix'].'.':'' ?>
                            </h5>
                            <p class="card-text">
                                <strong>Unique ID:</strong> <?= "PHA".$rows['user_uid'] ?> <br/>
                                <strong>PRC #:</strong> <?= $rows['prcno'] ?>
                            </p>
                        </div>
                        <ul class="list-group list-group-flush mt-1">
                            <li class="list-group-item text-capitalize"><?= $rows['chapter_list'] ?></li>
                            <li class="list-group-item text-capitalize"><?= $rows['category_list'] ?></li>
                            <li class="list-group-item text-capitalize"><?= $rows['practice_list'] ?></li>
                            <li class="list-group-item text-capitalize"><?= $rows['sub_list'] ?></li>
                        </ul>

                        <div class="mt-4 card-footer">
                            <a href="view.php?id=<?= $rows['id'] ?>" class="btn-card">View info</a>
                            <a href="update.php?id=<?= $rows['id'] ?>" class="btn-card">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                endwhile;
            ?>
        </div>
    </section>

    <section class="pagination">
        <div class="container">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a href="search-result.php?page=<?= $previous ?>" style="<?= ($page <= 1) ? 'pointer-events:none': '' ?>" class="page-link">Previous</a>
                </li>

                <?php for($i = 1; $i <= $pages; $i++) : ?>
                    <li class="page-item <?= ($_GET['page'] == $i) ? 'active':'' ?> ">
                        <a href="#" class="page-link active"><?= $i ?></a>
                    </li>
                <?php endfor ?>

                <li class="page-item">
                    <a href="search-result.php?page=<?= $next ?>" style="<?= ($page > $pages - 1) ? 'pointer-events:none':'' ?>" class="page-link">Next</a>
                </li>
            </ul>
        </div>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
</body>
</html>