<?php
    require_once "../connection/connection.php";
    session_start();
    $USER_ID = $_SESSION['user_id'];

    // GET YEAR
    $stmt = $conn->prepare("SELECT * FROM tbl_member_year WHERE id = ?");
    $stmt->bind_param("i", $USER_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    //UPDATE YEAR
    $flag = true;
    $errors = array();
    $errorMessage = "";
    $errFellow = $errLifefellow = $errDiplomate = $errLifemember = $errAssociatefellow = $errAssociate = "";
    if(isset($_POST['save'])) {

        $VALID_YEAR = "/^((19|20)[0-9]{2})*$/";

        $fellow = test_input($_POST['fellow']);
        $lifeFellow = test_input($_POST['life_fellow']);
        $diplomate = test_input($_POST['diplomate']);
        $lifeMember = test_input($_POST['life_member']);
        $associateFellow = test_input($_POST['associate_fellow']);
        $associate = test_input($_POST['associate']);

        if(isset($fellow)) {
            if(!preg_match($VALID_YEAR, $fellow)) {
                $flag = false;
                $errFellow = "Invalid fellow year";
                $errors[] = $errFellow;
            }
        }

        if(isset($lifeFellow)) {
            if(!preg_match($VALID_YEAR, $lifeFellow)) {
                $flag = false;
                $errLifefellow = "Invalid Life fellow year";
                $errors[] = $errLifefellow;
            }
        }

        if(isset($diplomate)) {
            if(!preg_match($VALID_YEAR, $diplomate)) {
                $flag = false;
                $errDiplomate = "Invalid Diplomate year";
                $errors[] = $errDiplomate;
            }
        }

        if(isset($lifeMember)) {
            if(!preg_match($VALID_YEAR, $lifeMember)) {
                $flag = false; 
                $errLifemember = "Invalid Life member year";
                $errors[] = $errLifemember;
            }
        }

        if(isset($associateFellow)) {
            if(!preg_match($VALID_YEAR, $associateFellow)) {
                $flag = false;
                $errAssociatefellow = "Invalid Associate fellow year";
                $errors[] = $errAssociatefellow;
            }
        }

        if(isset($associate)) {
            if(!preg_match($VALID_YEAR, $associate)) {
                $flag = false;
                $errAssociate = "Invalid Associate Year";
                $errors[] = $errAssociate;
            }
        }

        if($flag) {
            if(count($errors) > 0) {
                $errorMessage = "<div class='alert alert-danger'>So many errors</div>";
                // echo "So many errors";
                // print_r($errors);
            } else {
                $conn->autocommit(false);
                
                $stmt = $conn->prepare("UPDATE tbl_member_year SET fellow_year = ?, life_fellow_year = ?, diplomate_year = ?, life_member_year = ?, associate_fellow = ?, associate = ? WHERE id = ?");
                $stmt->bind_param("iiiiiii", $fellow, $lifeFellow, $diplomate, $lifeMember, $associateFellow, $associate, $USER_ID);
                $stmt->execute();
                $stmt->close();

                if(!$conn->commit()) {
                    $errorMessage = "<div class='alert alert-danger'>".trigger_error($conn->error)."</div>";
                } else {
                    header("Location: ./profile.php?id=$USER_ID");
                }
            }
        } else {
            $errorMessage = "<div class='alert alert-danger'>So many errors</div>";
        }

    }

    function test_input($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $conn->close();

?>