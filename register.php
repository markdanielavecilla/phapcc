<?php
    session_start();

    if(isset($_SESSION['auth']) && isset($_SESSION['user_id'])) {
        header("Location: ./user/profile.php?id=".$_SESSION['user_id']);
    }

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
    <title>Register</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a href="./index.php" class="navbar-brand">
                <img src="./images/phafinallogo.png" width="350" height="100" alt="Logo" />
            </a>
            <button 
                class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#navbar"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="./index.php" class="nav-link">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section>
        <form method="POST" autocomplete="off">
            <div class="mt-2 container">
                <?php
                    require_once './user-action/register-action.php';
                ?>
                <div class="row mt-3 mb-3">
                    <h2 class="mt-2 mb-3">Create an account for this website</h2>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errFirstname ? 'is-invalid':'' ?>"
                                placeholder="First name"
                                name="firstname"
                                value="<?= isset($_POST['firstname']) ? $_POST['firstname']: '' ?>"
                                autofocus
                            />
                            <label for="firstname">First Name</label>
                            <span class="invalid-feedback"><?= $errFirstname ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errMiddlename ? 'is-invalid':'' ?>"
                                placeholder="Middle name"
                                name="middlename"
                                value="<?= isset($_POST['middlename']) ? $_POST['middlename']: '' ?>"
                            />
                            <label for="middlename">Middle name</label>
                            <span class="invalid-feedback"><?= $errMiddlename ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating" >
                            <input 
                                type="text"
                                class="form-control <?= $errLastname ? 'is-invalid':'' ?>"
                                placeholder="Last name"
                                name="lastname"
                                value="<?= isset($_POST['lastname']) ? $_POST['lastname']: '' ?>"
                            />
                            <label for="lastname">Last Name</label>
                            <span class="invalid-feedback"><?= $errLastname ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errSuffix ? 'is-invalid':'' ?>"
                                placeholder="Suffix"
                                name="suffix"
                                value="<?= isset($_POST['suffix']) ? $_POST['suffix']: '' ?>"
                            />
                            <label for="suffix">Suffix</label>
                            <span class="invalid-feedback"><?= $errSuffix ?></span>
                        </div>
                    </div>
                </div>

                <!-- BIRTHDATE -->
                <div class="row mt-3 mb-3">
                    <!-- MONTH -->
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select 
                                name="month" 
                                id="month" 
                                class="form-select"
                            >
                                <option value="0">Month</option>
                                <?php
                                    foreach($months as $month => $val) :
                                        $selected = '';
                                        if($_POST['month'] == $month+1) $selected = 'selected';
                                ?>
                                <option 
                                    value="<?= $month+1 ?>"
                                    <?= $selected ?>
                                >
                                    <?= $val ?>
                                </option>
                                <?php endforeach ?>
                            </select>
                            <label for="month">Month</label>
                        </div>
                    </div>

                    <!-- DAY -->
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select 
                                name="day" 
                                id="day" 
                                class="form-select"
                            >
                                <option value="0">Day</option>
                                <?php
                                    for($i = 1; $i <= 31; $i++) :
                                        $selected = '';
                                        if(isset($_POST['day']) && $_POST['day'] == $i ) $selected = "selected";
                                ?>
                                <option 
                                    value="<?= $i ?>"
                                    <?= $selected ?>
                                >  
                                    <?= $i ?>
                                </option>
                                <?php endfor ?>
                            </select>
                            <label for="day">Day</label>
                        </div>
                    </div>
                    
                    <!-- YEAR -->
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select 
                                name="year" 
                                id="year" 
                                class="form-select"
                            >
                                <option value="year">Year</option>
                                <?php
                                    for($i = date("Y"); $i > 1900; $i-- ) :
                                        $selected = '';
                                        if(isset($_POST['year']) && $_POST['year'] == $i ) $selected = "selected";
                                ?>
                                <option 
                                    value="<?= $i ?>"
                                    <?= $selected ?>
                                >
                                    <?= $i ?>
                                </option>
                                <?php endfor ?>
                            </select>
                            <label for="year">Year</label>
                        </div>
                    </div>

                    <!-- AGE -->
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input 
                                type="number"
                                class="form-control <?= $errAge ? 'is-invalid':'' ?>"
                                placeholder="Age"
                                name="age"
                                id="age"
                                value="<?= isset($_POST['age']) ? $_POST['age'] : '' ?>"
                                readonly
                            />
                            <label for="age">Age</label>
                            <span class="invalid-feedback"><?= $errAge ?></span>
                        </div>
                    </div>
                </div>

                <!-- GENDER AND NUMBER -->
                <div class="row mt-3 mb-3">
                    <!-- GENDER -->
                    <div class="col">
                        <div class="form-floating">
                            <select 
                                name="gender" 
                                class="form-select"
                            >
                                <option 
                                    value="Male"
                                    <?= (isset($_POST['gender']) && $_POST['gender'] == "Male") ? 'selected':'' ?>
                                >
                                    Male
                                </option>
                                <option 
                                    value="Female"
                                    <?= (isset($_POST['gender']) && $_POST['gender'] == "Female") ? 'selected':'' ?>
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
                                name="mobilenumber"
                                class="form-control <?= $errMobilenumber ? 'is-invalid': '' ?>"
                                placeholder="Mobile number"
                                value="<?= isset($_POST['mobilenumber']) ? $_POST['mobilenumber'] : '' ?>"
                            />
                            <label for="mobilenumber">Mobile number</label>
                            <span class="invalid-feedback"><?= $errMobilenumber ?></span>
                        </div>
                    </div>
                </div>

                <!-- CREDENTIALS -->
                <div class="row mt-3 mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errEmail ? 'is-invalid':'' ?>"
                                placeholder="Email address"
                                name="email"
                                value="<?= isset($_POST['email']) ? $_POST['email']: '' ?>"
                            />
                            <label for="email">Email address</label>
                            <span class="small"><strong>Note:</strong> This will be your username for this website</span>
                            <span class="invalid-feedback"><?= $errEmail ?></span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-floating">
                            <input 
                                type="password"
                                class="form-control <?= $errPassword ? 'is-invalid':'' ?>"
                                placeholder="Enter your preferred password for this website"
                                name="password"
                                value="<?= isset($_POST['password']) ? $_POST['password']: '' ?>"
                            />
                            <label for="password">Password</label>
                            <span class="small"><strong>Note:</strong> Enter your preferred password for this website</span>
                            <span class="invalid-feedback"><?= $errPassword ?></span>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-3">
                    <!-- SECRET QUESTION -->
                    <div class="col">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errSecretQuestion ? 'is-invalid':'' ?>"
                                placeholder="Secret question"
                                name="secretquestion"
                                value="<?= isset($_POST['secretquestion']) ? $_POST['secretquestion']: '' ?>" 
                            />
                            <label for="secretquestion">Secret Question</label>
                            <span class="invalid-feedback"><?= $errSecretQuestion ?></span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-floating">
                            <input 
                                type="text"
                                class="form-control <?= $errSecretAnswer ? 'is-invalid':'' ?>"
                                placeholder="Secret answer"
                                name="secretanswer"
                                value="<?= isset($_POST['secretanswer']) ? $_POST['secretanswer']: '' ?>" 
                            />
                            <label for="secretanswer">Secret Answer</label>
                            <span class="invalid-feedback"><?= $errSecretAnswer ?></span>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-3">
                    <div class="col">
                        <div class="form-check">
                            <input 
                                type="checkbox" 
                                name="agree"
                                class="form-check-input <?= $errChkBx ? 'is-invalid':'' ?>"
                                value="1"
                            />
                            <label for="agree">I have read and understand the <a href="policy.php">Policy</a></label>
                            <span class="invalid-feedback"><?= $errChkBx ?></span>
                        </div>
                    </div>
                </div>
                <button 
                    type="submit" 
                    name="register" 
                    class="body-btn">Register</button>
            </div>
        </form>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
    <script src="./js/age.js"></script>
</body>
</html>