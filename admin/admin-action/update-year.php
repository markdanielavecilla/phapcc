<?php
    require_once "./includes/connection.php";
    $user_id = $_GET['id'];

    // GET YEARS
    $year = $conn->prepare("SELECT * FROM tbl_member_year where id = ?");
    $year->bind_param("i", $user_id);
    $year->execute();
    $resultYear = $year->get_result();
    $rowYear = $resultYear->fetch_assoc();
    $year->execute();
    $year->close();

    // UPDATE YEARS
    $errF = $errLF = $errD = $errLM = $errAF = $errA = "";
    $errors = array();
    if(isset($_POST['save'])) {
        $flag = true;
        $YEAR_VALIDATE = "/^((19|20)[0-9]{2})*$/";

        $fellow = $conn->real_escape_string($_POST['fellow']);
        $life_fellow = $conn->real_escape_string($_POST['life_fellow']);
        $diplomate = $conn->real_escape_string($_POST['diplomate']);
        $life_member = $conn->real_escape_string($_POST['life_member']);
        $associate_fellow = $conn->real_escape_string($_POST['associate_fellow']);
        $associate = $conn->real_escape_string($_POST['associate']);

        if(isset($fellow)) {
            if(!preg_match($YEAR_VALIDATE, $fellow)) {
                $flag = false;
                $errF = "Invalid year";
                $errors[] = $errF;
            }

            if($fellow > date("Y")) {
                $flag = false;
                $errF = "Year cannot exceed the current year.";
                $errors[] = $errF;
            }
        }

        if(isset($life_fellow)) {
            if(!preg_match($YEAR_VALIDATE, $life_fellow)) {
                $flag = false;
                $errLF = "Invalid year";
                $errors[] = $errLF;
            }

            if($life_fellow > date("Y")) {
                $flag = false;
                $errLF = "Year cannot exceed the current year.";
                $errors[] = $errLF;
            }
        }

        if(isset($diplomate)) {
            if(!preg_match($YEAR_VALIDATE, $diplomate)) {
                $flag = false;
                $errD = "Invalid year";
                $errors[] = $errD;
            }

            if($diplomate > date("Y")) {
                $flag = false;
                $errD = "Year cannot exceed the current year.";
                $errors[] = $errD;
            }
        }

        if(isset($life_member)) {
            if(!preg_match($YEAR_VALIDATE, $life_member)) {
                $flag = false;
                $errLM = "Invalid year";
                $errors[] = $errLM;
            }

            if($life_member > date("Y")) {
                $flag = false;
                $errLM = "Year cannot exceed the current year.";
                $errors[] = $errLM;
            }
        }

        if(isset($associate_fellow)) {
            if(!preg_match($YEAR_VALIDATE, $associate_fellow)) {
                $flag = false;
                $errAF = "Invalid year";
                $errors[] = $errAF;
            }

            if($associate_fellow > date("Y")) {
                $flag = false;
                $errAF = "Year cannot exceed the current year.";
                $errors[] = $errAF;
            }
        }

        if(isset($associate)) {
            if(!preg_match($YEAR_VALIDATE, $associate)) {
                $flag = false;
                $errA = "Invalid year";
                $errors[] = $errA;
            }

            if($associate > date("Y")) {
                $flag = false;
                $errA = "Year cannot exceed the current year.";
                $errors[] = $errA;
            }
        }

        if($flag) {
            if(count($errors) > 0) {
                $_SESSION['message'] = "<div class='alert alert-danger'>Failed to update year</div>";
                return;    
            } else {
                $conn->autocommit(false);

                $sql = "UPDATE tbl_member_year SET fellow_year = ?, life_fellow_year = ?, diplomate_year = ?, life_member_year = ?, associate_fellow = ?, associate = ? WHERE id = ?";

                if($updtYr = $conn->prepare($sql)) {
                    $updtYr->bind_param("iiiiiii", $fellow, $life_fellow, $diplomate, $life_member, $associate_fellow, $associate, $user_id);
                    $updtYr->execute();
                    $updtYr->close();
                } else {
                    $error = $conn->errno.' '.$conn->error;
                    $_SESSION['message'] = "<div class='alert alert-danger'>$error</div>";
                }

                if(!$conn->commit()) {
                    $conn->rollback();
                    $return;
                } else {
                    header("Location: ./view-user.php?id=$user_id#year_as");
                }
            }
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to update year</div>";
            return;
        }
    }
    $conn->close();
?>