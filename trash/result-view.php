<?php
    include "./actions/result-view-action.php";    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>

    <nav>
        <a href="#"><img src="images/logo.png" alt="PHA Logo"></a>
        <div class="navi-links">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="members.php">Members</a></li>
                <!-- <li><a href="excel.php?id=<?= $_GET['id'] ?>">Download</a></li>
                <li><a href="members.php?page=<?= $_GET['page'] ?>">Go back</a></li> -->
            </ul>
        </div>
    </nav>

    <section class="personal-information">
        <div class="wrapper grid grid-2">
            <img 
                src="./images/uploads/<?= $rows['image_url'] ? $rows['image_url'] : 'hdlogopha.png' ?>"
                alt="<?= $rows['first_name'] ?>" 
            >
            <div class="grid grid-2">
                <div>
                    <h1>Information</h1>
                    <p class="text-capitalize">
                        <strong>name:</strong> 
                        <?= $rows['first_name'] ?>
                        <?= $rows['middle_name'] ?>
                        <?= $rows['last_name'] ?>
                        <?= $rows['suffix'] ? $rows['suffix'].'.' :'' ?>
                    </p>
                    <p>
                        <strong class="text-capitalize">email:</strong> <?= $rows['email'] ?>
                    </p>
                    <p class="text-capitalize">
                        <strong>mobile number 1:</strong> 
                        <?= $rows['mobile_number'] ?>
                    </p>
                    <p class="text-capitalize">
                        <strong>mobile number 2:</strong>
                        <?= $rows['second_mobile_number']? $rows['second_mobile_number']:'N/A' ?>
                    </p>
                    <p class="text-capitalize">
                        <strong>birthdate:</strong>
                        <?php
                            $bdate = strtotime($rows['birthday']);
                            $format = date("F d, Y", $bdate);
                            echo $format;
                        ?>
                    </p>
                </div>
                <div>
                    <!-- <h1></h1> -->
                    <p class="text-capitalize">
                        <strong>age:</strong> <?= $rows['age'] ?>
                    </p>
                    <p class="text-capitalized">
                        <strong>deceased:</strong> <?= $rows['deceased'] ?>
                    </p>
                    <p class="text-uppercase">
                        <strong>prc #:</strong> <?= $rows['prcno'] ?>
                    </p>
                    <p class="text-uppercase">
                        <strong>pma #:</strong> <?= $rows['pmano'] ? $rows['pmano']: 'N/A' ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
