<?php
    require_once "./includes/connection.php";

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        /**
         * @Desc Checks if there is an input on username and password
         */

        if(empty($username) && empty($password)) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Incorrect username or password</div>";
            return;
        }

        $stmt = $conn->prepare("SELECT * FROM tbl_admin WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['admin_password'])) {
                $_SESSION['admin_auth'] = true;
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['admin_username'] = $row['username'];
    
                header("Location: ./dashboard.php");

            } else {
                $_SESSION['message'] = "<div class='alert alert-danger'>Incorrect username or password</div>";
                return;
            }

        } else {
            $_SESSION['message'] = "<div class='alert alert-danger'>Incorrect username or password</div";
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    }
?>