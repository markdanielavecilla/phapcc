<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/update-information.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./index.css">
    <title>Update Information</title>
</head>
<body>
    <section>
        <?php
            include "./includes/navigation.php";
        ?>
    </section>
    <main>
        <form enctype="multipart/form-data" method="post">
            <div class="container">
                <a href="./view-user.php?id=<?= $userRow['id'] ?>" class="btn btn-outline-danger float-end">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
                <h2 class="mt-4">Update Information</h2>
                <hr/>
                <?php
                    if(isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                ?>
                <div class="row my-3">
                    <div class="col-md-4 col-sm-4">
                        <img 
                            src="../images/uploads/<?= $userRow['image_url'] ? $userRow['image_url'] : 'default-img.png' ?>" 
                            id="image_preview" 
                            alt="<?= $userRow['first_name'] ?>"
                        />
                        <input 
                            type="file" 
                            name="user_image" 
                            id="user_image" 
                        />
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input 
                                        type="text"
                                        class="form-control <?= $errFname ? 'is-invalid':'' ?>"
                                        name="first_name"
                                        placeholder="First name"
                                        value="<?= isset($_POST['first_name']) ? $_POST['first_name'] : $userRow['first_name'] ?>"
                                    />
                                    <label for="first_name">First name</label>
                                    <span class="invalid-feedback"><?= $errFname ?></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input 
                                        type="text"
                                        class="form-control <?= $errMname ? 'is-invalid':'' ?>"
                                        name="middle_name"
                                        placeholder="Middle name"
                                        value="<?= isset($_POST['middle_name']) ? $_POST['middle_name'] : $userRow['middle_name'] ?>"
                                    />
                                    <label for="middle_name">Middle name</label>
                                    <span class="invalid-feedback"><?= $errMname ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input 
                                        type="text"
                                        class="form-control <?= $errLname ? 'is-invalid':'' ?>"
                                        name="last_name"
                                        placeholder="Last name"
                                        value="<?= isset($_POST['last_name']) ? $_POST['last_name'] : $userRow['last_name'] ?>"
                                    />
                                    <label for="last_name">Last name</label>
                                    <span class="invalid-feedback"><?= $errLname ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input 
                                        type="text"
                                        class="form-control <?= $errSuffix ? 'is-invalid':'' ?>"
                                        name="suffix"
                                        placeholder="Suffix"
                                        value="<?= isset($_POST['suffix']) ? $_POST['suffix'] : $userRow['suffix'] ?>"
                                    />
                                    <label for="suffix">Suffix</label>
                                    <span class="invalid-feedback"><?= $errSuffix ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <!-- GENDER -->
                    <div class="col">
                        <div class="form-floating">
                            <select 
                                name="gender"
                                class="form-select"
                            >
                                <option 
                                    value="Male"
                                    <?php if($userRow['gender']=== "Male") { echo "selected"; } ?>
                                >
                                    Male
                                </option>
                                <option 
                                    value="Female"
                                    <?php if($userRow['gender']=== "Female") { echo "selected"; } ?>
                                >
                                    Female
                                </option>
                            </select>
                            <label for="gender">Gender</label>
                        </div>
                    </div>
                    <!-- MOBILE NUMBER -->
                    <div class="col">
                        <div class="form-floating">
                            <input 
                                type="number" 
                                class="form-control <?= $errFmobile ? 'is-invalid':'' ?>"
                                name="mobile_number"
                                placeholder="Mobile number"
                                value="<?= isset($_POST['mobile_number']) ? $_POST['mobile_number'] : $userRow['mobile_number'] ?>"
                            />
                            <label for="mobile_number">Mobile number</label>
                            <span class="invalid-feedback"><?= $errFmobile ?></span>
                        </div>
                    </div>
                    <!-- SECOND MOBILE NUMBER -->
                    <div class="col">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errSmobile ? 'is-invalid':'' ?>"
                                name="s_mobile_number"
                                placeholder="Second mobile number"
                                value="<?= isset($_POST['s_mobile_number']) ? $_POST['s_mobile_number'] : $userRow['second_mobile_number'] ?>"
                            />
                            <label for="s_mobile_number">Second mobile number</label>
                            <span class="invalid-feedback"><?= $errSmobile ?></span>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <!-- EMAIL -->
                    <div class="col">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errEmail ? 'is-invalid':'' ?>"
                                name="email"
                                placeholder="Email"
                                value="<?= isset($_POST['email']) ? $_POST['email'] : $userRow['email'] ?>"
                            />
                            <label for="email">Email</label>
                            <span class="invalid-feedback"><?= $errEmail ?></span>
                        </div>
                    </div>
                    <!-- PRCNO -->
                    <div class="col">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errPrc ? 'is-invalid':'' ?>"
                                name="prc"
                                placeholder="PRC"
                                value="<?= isset($_POST['prc']) ? $_POST['prc'] : $userRow['prcno'] ?>"
                            />
                            <label for="PRC">PRC</label>
                            <span class="invalid-feedback"><?= $errPrc ?></span>
                        </div>
                    </div>
                    <!-- PMANO -->
                    <div class="col">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errPma ? 'is-invalid':'' ?>"
                                name="pma"
                                placeholder="PMA"
                                value="<?= isset($_POST['pma']) ? $_POST['pma'] : $userRow['pmano'] ?>"
                            />
                            <label for="PMA">PMA</label>
                            <span class="invalid-feedback"><?= $errPma ?></span>
                        </div>
                    </div>
                    <div class="row my-3">
                        <!-- BIRTH MONTH -->
                        <div class="col">
                            <div class="form-floating">
                                <select 
                                    name="month"
                                    class="form-select" 
                                    id="month"
                                >
                                    <option value="0">Month</option>
                                    <?php
                                        $bmonth = $userRow['birth_month'];
                                        $day = $userRow['birth_day'];
                                        $year = $userRow['birth_year'];

                                        foreach($months as $month => $val) {
                                            $selected = '';
                                            if($bmonth === $month+1) {
                                                $selected = "selected";
                                            }
                                    ?>
                                    <option
                                        value="<?= $bmonth+1 ?>"
                                        <?= $selected ?>
                                    >
                                        <?= $val ?>
                                    </option>
                                    <?php } ?>
                                </select>
                                <label for="month">Month</label>
                            </div>
                        </div>
                        <!-- BIRTH DAY -->
                        <div class="col">
                            <div class="form-floating">
                                <select 
                                    name="day" 
                                    id="day"
                                    class="form-select"
                                >
                                    <option value="0">Day</option>
                                    <?php
                                        for($i = 1; $i <= 31; $i++){
                                            $selected = "";
                                            if($day === $i) $selected = "selected"
                                    ?>
                                    <option 
                                        value="<?= $i ?>"
                                        <?= $selected ?>
                                    >
                                        <?= $i ?>
                                    </option>
                                    <?php } ?>
                                </select>
                                <label for="day">Day</label>
                            </div>
                        </div>
                        <!-- BIRTH YEAR -->
                        <div class="col">
                            <div class="form-floating">
                                <select 
                                    name="year" 
                                    id="year"
                                    class="form-select"
                                >
                                    <option value="0">Year</option>
                                    <?php
                                        for($i = date("Y"); $i > 1900; $i--){
                                            $selected = "";
                                            if($year === $i)
                                                $selected = "selected";
                                    ?>
                                        <option 
                                            value="<?= $i ?>"
                                            <?= $selected ?>
                                        >
                                            <?= $i ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <label for="year">Year</label>
                            </div>
                        </div>
                        <!-- AGE -->
                        <div class="col">
                            <div class="form-floating">
                                <input 
                                    type="number"
                                    name="age"
                                    id="age"
                                    class="form-control <?= $errAge ? 'is-invalid':'' ?>"
                                    placeholder="Age"
                                    value="<?= $userRow['age'] ?>"
                                    readonly
                                />
                                <label for="age">Age</label>
                                <span class="invalid-feedback"><?= $errAge ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <button
                    type="submit"
                    class="btn btn-primary float-end"
                    name="save"
                >
                    Save
                </button>
            </div>
        </form>
    </main>
    <br><br><br>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
    <script src="../js/age.js"></script>
    <script src="../js/image-preview.js"></script>
</body>
</html>