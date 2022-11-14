<?php

    /**
     * @include action.php -> include the action.php file
     * @$months -> array of months provided in month dropdown in action.php file
     */

    include './action.php';
    $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"/>
    <link rel="stylesheet" href="./index.css">
    <title>Add Member</title>
</head>
<body>
    
    <nav>
        <a href="#"><img src="../images/phalogohd.png" alt="PHA Logo"></a>
        <div class="navi-links">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="members.php">Members</a></li>
            </ul>
        </div>
    </nav>

    <section class="mt-5">
        <div class="container">
            <!-- 
                The $message variable will be called 
                whenever the inserting data is success or fail
             -->
            <?= $message ?>
            <form id="form" method="post" autocomplete="off" enctype="multipart/form-data">
                
                <!-- 
                    PERSONAL INFORMATION
                    This code includes the personal-information.php file
                    to fill up by the user
                -->
                <?php include 'personal-information.php' ?>

                <!--
                    HOSPITAL
                    This code includes the hospital.php file
                    to fill up by the user
                 -->
                <?php include 'hospital.php' ?>
                
                <hr/>

                <!-- 
                    MEMBERSHIP YEAR
                    This code includes the membership.php file 
                    to fill up by the user
                 -->
                <?php include 'membership.php'?>

                <hr/>

                <!-- 
                    BENEFICIARIES 
                    This code includes the beneficiaries.php file
                    to fill up by the user
                -->

                <?php include 'beneficiaries.php' ?>

                <!-- 
                    CONTACT PERSON IN CASE OF EMERGENCY
                    This code includes the contact-person file
                    to fill up by the user
                 -->

                <?php include 'contact-person.php' ?>

                <hr/>

                <div class="row justify-content-md-end">
                    <div class="col-lg-1 mb-3">
                        <input type="submit" name="save" id="save" value="Save" class="body-btn">                    
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
    <script src="index.js"></script>
    </body>
</html>

