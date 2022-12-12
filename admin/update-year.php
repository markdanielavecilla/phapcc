<?php
    session_start();
    if(!isset($_SESSION['admin_auth'])) {
        header("Location: ./index.php");
    }
    require_once "./admin-action/update-year.php";
    function checkYear($year) {
        if($year === 0) {
            return '';
        }
        return $year;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update year</title>
</head>
<body>
    <section>
        <?php
            include "./includes/navigation.php";
        ?>
    </section>
    <main>
        <form method="post">
            <div class="container">
                <h2 class="mt-4">
                    Year as
                    <span>
                        <a href="./view-user.php?id=<?= $user_id ?>#year_as" class="btn btn-outline-danger float-end">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </a>
                    </span>
                </h2>
                <hr/>
                <div class="row my-3">
                    <?php
                        if(isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                    ?>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="number"
                                name="fellow"
                                placeholder="Fellow"
                                class="form-control <?= $errF ? 'is-invalid':'' ?>"
                                value="<?= isset($_POST['fellow']) ? $_POST['fellow'] : checkYear($rowYear['fellow_year']) ?>"
                            />
                            <label for="fellow">Fellow</label>
                            <span class="invalid-feedback"><?= $errF ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="number"
                                name="life_fellow"
                                class="form-control <?= $errLF ? 'is-invalid':'' ?>"
                                placeholder="Life fellow"
                                value="<?= isset($_POST['life_fellow']) ? $_POST['life_fellow'] : checkYear($rowYear['life_fellow_year']) ?>"
                            />
                            <label for="life_fellow">Life fellow</label>
                            <span class="invalid-feedback"><?= $errLF ?></span>
                        </div>    
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="number"
                                name="diplomate"
                                placeholder="Diplomate"
                                class="form-control <?= $errD ? 'is-invalid':'' ?>"
                                value="<?= isset($_POST['diplomate']) ? $_POST['diplomate'] : checkyear($rowYear['diplomate_year']) ?>"
                            />
                            <label for="diplomate">Diplomate</label>
                            <span class="invalid-feedback"><?= $errD ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="number"
                                name="life_member"
                                placeholder="Life member"
                                class="form-control <?= $errLM ? 'is-invalid':'' ?>"
                                value="<?= isset($_POST['life_member']) ? $_POST['life_member'] : checkYear($rowYear['life_member_year']) ?>"
                            />
                            <label for="life_member">Life member</label>
                            <span class="invalid-feedback"><?= $errLM ?></span>
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="number"
                                name="associate_fellow"
                                placeholder="Associate fellow"
                                class="form-control <?= $errAF ? 'is-invalid':'' ?>"
                                value="<?= isset($_POST['associate_fellow']) ? $_POST['associate_fellow'] : checkYear($rowYear['associate_fellow']) ?>"
                            />
                            <label for="associate_fellow">Associate fellow</label>
                            <span class="invalid-feedback"><?= $errAF ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input 
                                type="number"
                                name="associate"
                                placeholder="associate"
                                class="form-control <?= $errA ? 'is-invalid':'' ?>"
                                value="<?= isset($_POST['associate']) ? $_POST['associate'] : checkYear($rowYear['associate']) ?>"
                            />
                            <label for="associate">Associate</label>
                            <span class="invalid-feedback"><?= $errA ?></span>
                        </div>
                    </div>
                </div>
                <button
                    type="submit"
                    name="save"
                    class="btn btn-success float-end"
                >
                    Save
                </button>
            </div>
        </form>
    </main>
</body>
</html>