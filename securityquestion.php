<?php
    ob_start();
    session_start();
    require_once "./connection/connection.php";

    // CHECK IF THERE IS EMAIL PRESENT
    if(!isset($_SESSION['user_email'])) {
        header("Location: ./index.php");
        return;
    }
    // SUBMIT ANSWER 
    $errMessage = "";
    if(isset($_POST['submit'])) {
        $secretAnswer = $conn->real_escape_string($_POST['securityAnswer']);
        if($secretAnswer === $_SESSION['user_answer']) {
            header("Location: ./resetpassword.php");
        } else {
            $errMessage = "<div class='alert alert-danger'>Wrong answer</div>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <title>Reset Password</title>
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a href="./index.php" class="navbar-brand">
                    <img src="./images/phafinallogo.png" width="350" height="100" alt="Logo" />
                </a>
            </div>
        </nav>

       <main>
            <div class="container my-5">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <label for="security_question" class="alert alert-success"><strong>SECRET QUESTION:</strong> <?= ucfirst($_SESSION['user_question']) ?></label>
                            <input 
                                type="text" 
                                placeholder="answer" 
                                class="form-control my-3" 
                                name="securityAnswer"
                                autofocus
                            />
                            <button class="btn btn-success float-end" name="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
       </main>
    </div>
    <?php
        include "./footer.php";
    ?>
</body>
</html>
<?php
    ob_end_flush();
?>