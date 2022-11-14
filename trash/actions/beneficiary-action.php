<?php
    include './connection.php';
    session_start();
    $dr_id = $_SESSION['beneficiary_id'];
    $ben_id = $_GET['ben_id'];

    //GET BENEFICIARY DATA
    $stmt = $conn->prepare("SELECT * FROM tbl_beneficiaries WHERE ben_id = ?");
    $stmt->bind_param("i", $ben_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // update beneficiaries

    $flag = true;
    $VALIDATE_INPUT_REGEX = "/^[a-zA-Z\s\-\.]*$/";
    
    $errors = [];
    $errorCounter = array();
    $errFirstname = $errMiddlename = $errLastname = $errSuffix = '';
    if(isset($_POST['save_beneficiaries'])) {
        $firstname = test_input($_POST['firstname']);
        $middlename = test_input($_POST['middlename']);
        $lastname = test_input($_POST['lastname']);
        $suffix = test_input($_POST['suffix']);

        if(!preg_match($VALIDATE_INPUT_REGEX, $firstname)) {
            $errFirstname = addError('firstname', 'First name shouldn\'t contain numbers');
            $errorCounter[] = $errFirstname;
            $flag = false;
        }
        if(!preg_match($VALIDATE_INPUT_REGEX, $middlename)){
            $errMiddlename = addError('middlename', 'Middle name shouldn\'t contain numbers');
            $errorCounter[] = $errMiddlename;
            $flag = false;
        }
        if(!preg_match($VALIDATE_INPUT_REGEX, $lastname)){
            $errLastname = addError('lastname', 'Last name shouldn\'t contain numbers');
            $errorCounter[] = $errLastname;
            $flag = false;
        }
        if(!preg_match($VALIDATE_INPUT_REGEX, $suffix)){
            $errSuffix = addError('suffix', 'suffix shouldn\'t contain numbers');
            $errorCounter[] = $errSuffix;
            $flag = false;
        }

        if($flag === true) {
            if(count($errorCounter) > 0) {
                echo "Failed";
            } else {
                $conn->autocommit(false);

                $stmt = $conn->prepare("UPDATE tbl_beneficiaries SET ben_first_name = ?, ben_middle_name = ?, ben_last_name = ?, ben_suffix = ? WHERE ben_id = ?");
                $stmt->bind_param("ssssi", $firstname, $middlename, $lastname, $suffix, $ben_id);
                $stmt->execute();

                if(!$conn->commit()) {
                    echo $stmt->error;
                } else {
                    header("Location: view.php?id=$dr_id");
                }
            }
        } else {
            echo "Failed";
        }

    }

    function addError($key, $val) {
        return $errors[$key] = $val;
    }


    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    


    // class userValidator {
    //     private $data;
    //     private $errors = [];
    //     private $STRING_VALIDATE = "/^[a-zA-Z\s\-\.]*$/";
    //     public static $fields = ['firstname', 'middlename', 'lastname', 'suffix'];

    //     public function __construct($post_data) {
    //         $this->data = $post_data;
    //     }

    //     public function validateForm() {
    //         foreach(self::$fields as $field) {
    //             if(!array_key_exists($field, $this->data)) {
    //                 trigger_error("$field is not present in data");
    //                 return;
    //             }
    //         }
    //         $this->validateFname();
    //         $this->validateMname();
    //         $this->validateLname();
    //         $this->validateSuffix();
    //         return $this->errors;
    //     }

    //     private function validateFname() {
    //         $fName = $this->test_input($this->data['firstname']);
    //         if(empty($fName)) {
    //             $this->addError('firstName', 'First name cannot be empty');
    //         } else {
    //             if(!preg_match($this->STRING_VALIDATE, $fName)) {
    //                 $this->addError('firstName', "Invalid first name");
    //             }
    //         }
    //         return $fName;
    //     }

    //     private function validateMname() {
    //         $mName = $this->test_input($this->data['middlename']);
    //         if(empty($mName)) {
    //             $this->addError('middleName', 'Middle name cannot be empty');
    //         } else {
    //             if(!preg_match($this->STRING_VALIDATE, $mName)) {
    //                 $this->addError('middleName', 'Invalid middle name');
    //             }
    //         }
    //     }

    //     private function validateLname() {
    //         $lName = $this->test_input($this->data['lastname']);
    //         if(empty($lName)) {
    //             $this->addError('lastName', 'Last name cannot be empty');
    //         } else {
    //             if(!preg_match($this->STRING_VALIDATE, $lName)) {
    //                 $this->addError('lastName', 'Invalid last name');
    //             }
    //         }
    //     }

    //     private function validateSuffix() {
    //         $suffix = $this->test_input($this->data['suffix']);
    //         if(empty($suffix)) {
    //             $this->addError('suffix', 'Suffix cannot be empty');
    //         } else {
    //             if(!preg_match($this->STRING_VALIDATE, $suffix)) {
    //                 $this->addError('suffix', 'Invalid suffix');
    //             }
    //         }
    //     }

    //     private function addError($key, $val) {
    //         $this->errors[$key] = $val;
    //     }

    //     private function test_input($data) {
    //         $data = trim($data);
    //         $data = stripslashes($data);
    //         $data = htmlspecialchars($data);
    //         return $data;
    //     }
    // }
?>