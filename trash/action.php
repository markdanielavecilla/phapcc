<?php
    include_once 'connection.php';
    session_start();

    /**
     * @These are variables for storing error message
     */
    $errFname = $errMname = $errLname = $errGender = $errSuffix = $errMobilenum = $errSecondMobile = $errEmail = $errPrcno = $errPmano = $errDeceased = $errBirthmonth = $errBirthday = $errBirthyear = $errAge = $errMedschool = $errYeargrad = $errHospitalaff = $errCityprov = $errContactno = $errLandlineno = $errPractice = $errSubspecialty = $errHomeAddress = $errPrincipalofc = $errCategory = $errChapter = $errFellow = $errLifefellow = $errDiplomate = $errLifemember = $errAssociateFellow = $errAssociate = $errSchoolTrained = $errTrainedYearGrad = $errOthersub = $errOthercat = $errOtherChap = $errOtherPractice = $imgErr = $errOther_st = $errOtherCouncil = $errOtherComm = $errSpecialtraining = $errUpOtCommittee = $errUpOtherCouncil = '';

    /**
     * @These are variables for storing error message
     */
    $errAddHospital = $errAddContact = $errAddLandline = $errAddMobile = $errAddEmail = '';

    /**
     * @ BOOL $flag
     * @ TRUE if there is no error on user input
     * @ FALSE if there is an error on user input
     * @ $message variable is where the result message stores
     * @ $errMessages is an array that collects all error messages
     * @ $errors is an array that counts the number of errors 
     */
    $flag = true;
    // $success = false;
    $message = '';
    $errMessages = array();
    $errors = array();

    /**
     * @ Checks if the button named 'save' is clicked
     */
    if(isset($_POST['save'])){

        /**
         * @desc checks if there is a value entered
         * @param value that handles the first name entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['fname'])) {
            $errFname = "First name is required";
            $flag = false;
            $errors[] = $errFname;
        } else {
            $firstName = test_input($_POST['fname']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-\.]*$/", $firstName)) {
                $errFname = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errFname;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the middle name entered by the user
         * @$errMname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['midName'])) {
            $errMname = "Middle name is required";
            $flag = false;
            $errors[] = $errMname;
        } else {
            $middleName = test_input($_POST['midName']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-\.]*$/", $middleName)) {
                $errMname = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errMname;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the last name entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['lname'])) {
            $errLname = "Last name is required";
            $flag = false;
            $errors[] = $errLname;
        } else {
            $lastName = test_input($_POST['lname']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-\.]*$/", $lastName)) {
                $errLname = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errLname;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the gender entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['selectedGender'])) {
            $errGender = "Please select a gender";
            $flag = false;
            $errors[] = $errGender;
        } else {
            $gender = test_input($_POST['selectedGender']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s]*$/", $gender)) {
                $errGender = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errGender;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the suffix entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['suffix'])) {
            $suffix = test_input($_POST['suffix']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s]*$/", $suffix)) {
                $errSuffix = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errSuffix;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the mobile number entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['mobileNumber'])) {
            $errMobilenum = "Mobile number is required";
            $flag = false;
            $errors[] = $errMobilenum;
        } else {
            $mobileNumber = test_input($_POST['mobileNumber']);
            $flag = true;
            if(!preg_match("/^[0-9]*$/", $mobileNumber)) {
                $errMobilenum = "Only numbers are allowed in this field";
                $flag = false;
                $errors[] = $errMobilenum;
            }
            if(strlen($mobileNumber) > 11 || strlen($mobileNumber) < 11) {
                $errMobilenum = "Mobile number must be exact 11 digits";
                $flag = false;
                $errors[] = $errMobilenum;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the second mobile number entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['second_mobileNumber'])) {
            $second_mobileNumber = test_input($_POST['second_mobileNumber']);
            $flag = true;
            if(!preg_match("/^[0-9]*$/", $second_mobileNumber)) {
                $errSecondMobile = "Invalid second mobile number";
                $flag = false;
                $errors[] = $errSecondMobile;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the email entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['email'])) {
            $errEmail = "Email is required";
            $flag = false;
            $errors[] = $errEmail;
        } else {
            $email = test_input($_POST['email']);
            $flag = true;
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errEmail = "Invalid email";
                $flag = false;
                $errors[] = $errEmail;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the PRC number entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['prcNumber'])) {
            $errPrcno = "PRC No. is required";
            $flag = false;
            $errors[] = $errPrcno;
        } else {
            $prcNumber = test_input($_POST['prcNumber']);
            $flag = true;
            if(!preg_match("/^[0-9]*$/", $prcNumber)) {
                $errPrcno = "Only numbers are required in this field";
                $flag = false;
                $errors[] = $errPrcno;
            }
            if(strlen($prcNumber) > 6 || strlen($prcNumber) < 5) {
                $errPrcno = "PRC No. range between 5 or 6 numbers";
                $flag = false;
                $errors[] = $errPrcno;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the PMA number entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['pmaNumber'])) {
            $pmaNumber = test_input($_POST['pmaNumber']);
            $flag = true;
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the deceased entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['isDeceased'])) {
            $errDeceased = "Please select if the person is alive or dead";
            $flag = false;
            $errors[] = $errDeceased;
        } else {
            $isDeceased = test_input($_POST['isDeceased']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s]*$/", $isDeceased)) {
                $errDeceased = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errDeceased;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the birth month entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['selectedMonth'])) {
            $errBirthmonth = "Please select a month";
            $flag = false;
            $errors[] = $errBirthmonth;
        } else {
            $birthMonth = test_input($_POST['selectedMonth']);
            $flag = true;
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the birth day entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['selectedDay'])) {
            $errBirthday = "Please select a day";
            $flag = false;
            $errors[] = $errBirthday;
        } else {
            $birthDay = test_input($_POST['selectedDay']);
            $flag = true;
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the birth year entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['year'])) {
            print_r($_POST['year']);
            $errBirthyear = "Please select a year";
            $flag = false;
            $errors[] = $errBirthyear;
        } else {
            $birthYear = test_input($_POST['year']);
            $flag = true;
            if(!preg_match("/^[0-9]*$/", $birthYear)) {
                $errBirthyear = "Only numbers are allowed in this field";
                $flag = false;
                $errors[] = $errBirthyear;
            }
            if(strlen($birthYear) > 4 || strlen($birthYear) < 4) {
                $errBirthyear = "Not a valid year";
                $flag = false;
                $errors[] = $errBirthyear;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the age entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['age'])) {
            $errAge = "Age is required";
            $flag = false;
            $errors[] = $errAge;
        } else {
            $age = test_input($_POST['age']);
            $flag = true;
            if(!preg_match("/^[0-9]*$/", $age)) {
                $errAge = "Only numbers are allowed in this field";
                $flag = false;
                $errors[] = $errAge;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the medical school entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */
        
        if(empty($_POST['medicalSchool'])) {
            $errMedschool = "Medical school is required";
            $flag = false;
            $errors[] = $errMedschool;
        } else {
            $medicalSchool = test_input($_POST['medicalSchool']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-\.]*$/", $medicalSchool)) {
                $errMedschool = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errMedschool;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the year graduated entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['yearGraduated'])) {
            $errYeargrad = "Year Graduated is required";
            $flag = false;
            $errors[] = $errYeargrad;
        } else {
            $yearGraduated = test_input($_POST['yearGraduated']);
            $flag = true;
            if(!preg_match("/^(19|20)[0-9][0-9]\d*$/", $yearGraduated) || strlen($yearGraduated) > 4) {
                $errYeargrad = "Invalid year";
                $flag = false;
                $errors[] = $errYeargrad;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the school trained entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['schoolTrained'])) {
            $errSchoolTrained = "Training institution is required";
            $flag = false;
            $errors[] = $errSchoolTrained;
        } else {
            $schoolTrained = test_input($_POST['schoolTrained']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-\.]*$/", $schoolTrained)) {
                $errSchoolTrained = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errSchoolTrained;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the year graduated entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['trainedYearGrad'])) {
            $errTrainedYearGrad = "Training year graduated is required";
            $flag = false;
            $errors[] = $errTrainedYearGrad;
        } else {
            $trainedYearGrad = test_input($_POST['trainedYearGrad']);
            $flag = true;
            if(!preg_match("/^(19|20)[0-9][0-9]\d*$/", $trainedYearGrad) || strlen($trainedYearGrad) > 4) {
                $errTrainedYearGrad = "Invalid year";
                $flag = false;
                $errors[] = $errTrainedYearGrad;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the city/province entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['cityProvince'])) {
            $errCityprov = "City/Province is required";
            $flag = false;
            $errors[] = $errCityprov;
        } else {
            $cityProvince = test_input($_POST['cityProvince']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-\.]*$/", $cityProvince)) {
                $errCityprov = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errCityprov;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the home address entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['homeAddress'])) {
            $errHomeAddress = "Home Address is required";
            $flag = false;
            $errors[] = $errHomeAddress;
        } else {
            $homeAddress = test_input($_POST['homeAddress']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z0-9\s\-\.]*$/", $homeAddress)) {
                $errHomeAddress = "Invalid home address";
                $flag = false;
                $errors[] = $errHomeAddress;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the principal office entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['principalOffice'])) {
            $errPrincipalofc = "Principal Office is required";
            $flag = false;
            $errors[] = $errPrincipalofc;
        } else {
            $principalOffice = test_input($_POST['principalOffice']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z0-9\s\-\.]*$/", $principalOffice)) {
                $errPrincipalofc = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errPrincipalofc;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the hospital affiliation entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['hospitalAffiliation'])) {
            $errHospitalaff = "Hospital affiliation is required";
            $flag = false;
            $errors[] = $errHospitalaff;
        } else {
            $hospitalAff = test_input($_POST['hospitalAffiliation']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-\.]*$/", $hospitalAff)) {
                $errHospitalaff = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errHospitalaff;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the contact number entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['contactNumber'])) {
            $errContactno = "Contact number is required";
            $flag = false;
            $errors[] = $errContactno;
        } else {
            $contactNumber = test_input($_POST['contactNumber']);
            $flag = true;
            if(!preg_match("/^[0-9]*$/", $contactNumber)) {
                $errContactno = "Only numbers are allowed";
                $flag = false;
                $errors[] = $errContactno;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the landline number entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(empty($_POST['landlineNumber'])) {
            $errLandlineno = "Landline number is required";
            $flag = false;
            $errors[] = $errLandlineno;
        } else {
            $landlineNumber = test_input($_POST['landlineNumber']);
            $flag = true;
            if(!preg_match("/^[0-9\s\(\)\-]*$/", $landlineNumber)){
                $errLandlineno = "Invalid landline";
                $flag = false;
                $errors[] = $errLandlineno;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the subspecialty entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['subSpecialty'])) {
            $arr = array();
            forEach($_POST['subSpecialty'] as $subspecialty => $val){
                $arr[] = test_input($val);
                $flag = true;
            }   
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the other subspecialty entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['other_subspecialty'])) {
            $other_sub = test_input($_POST['other_subspecialty']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s]*$/", $other_sub)) {
                $errOthersub = "Other subspecialty - Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errOthersub;
            }    
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the selected category entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['selectedCategory'])) {
            $category = array();
            foreach($_POST['selectedCategory'] as $selectedCategory => $val){
                $category[] = test_input($val);
                $flag = true;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the other categories entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */
        
        if(isset($_POST['other_categories'])){
            $other_cat = test_input($_POST['other_categories']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s]*$/", $other_cat)) {
                $errOthercat = "Other Category - Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errOthercat;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the selected chapter entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['selectedChapter'])) {
            $chapter = array();
            foreach($_POST['selectedChapter'] as $selectedChapter => $val){
                $chapter[] = test_input($val);
                $flag = true;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the other chapter entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['other_chapters'])) {
            $other_chap = test_input($_POST['other_chapters']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s]*$/", $other_chap)) {
                $errOtherChap = "Other Chapter - Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errOtherChap;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the practice entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['practice'])){
            $practice = array();
            foreach($_POST['practice'] as $selectedPractice => $val){
                $practice[] = $val;
                $flag = true;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the other practice entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['otherPractice'])) {
            $other_prac = test_input($_POST['otherPractice']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s]*$/", $other_prac)) {
                $errOtherPractice = "Other Practice - Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errOtherPractice;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the special training entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['special_training'])) {
            $spec_t = array();
            foreach($_POST['special_training'] as $special_training => $val) {
                $spec_t[] = $val;
                $flag = true;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the other special training entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['otherSpecialTraining'])) {
            $other_st = test_input($_POST['otherSpecialTraining']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s]*$/", $other_st)) {
                $errOther_st = "Other Special Training - Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errOther_st;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the committee entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['committee'])){
            $committee = array();
            foreach($_POST['committee'] as $comm => $val) {
                $committee[] = $val;
                $flag = true;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the other committee entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['otherCommittee'])) {
            $otherCommittee = test_input($_POST['otherCommittee']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-]*$/", $otherCommittee)) {
                $errOtherComm = "Invalid Committee";
                $flag = false;
                $errors[] = $errOtherComm;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the council entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['council'])) {
            $council = array();
            foreach($_POST['council'] as $councl => $val) {
                $council[] = $val;
                $flag = true;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the other council entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['otherCouncil'])) {
            $otherCouncil = test_input($_POST['otherCouncil']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-]*$/", $otherCouncil)) {
                $errOtherCouncil = "Invalid council";
                $flag = false;
                $errors[] = $errOtherCouncil;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the fellow year entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['fellowYear'])) {
            $fellowYear = test_input($_POST['fellowYear']);
            $flag = true;
            if(!preg_match("/^((19|20)[0-9][0-9])*$/", $fellowYear) || strlen($fellowYear) > 4) {
                $errFellow = "Fellow year is invalid";
                $flag = false;
                $errors[] = $errFellow;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the life fellow year entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['lifeFellowYear'])) {
            $lifeFellowYear = test_input($_POST['lifeFellowYear']);
            $flag = true;
            if(!preg_match("/^((19|20)[0-9][0-9])*$/", $lifeFellowYear) || strlen($lifeFellowYear) > 4) {
                $errLifefellow = "Life Fellow year is invalid";
                $flag = false;
                $errors[] = $errLifefellow;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the diplomate year entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['diplomateYear'])) {
            $diplomateYear = test_input($_POST['diplomateYear']);
            $flag = true;
            if(!preg_match("/^((19|20)[0-9][0-9])*$/", $diplomateYear) || strlen($diplomateYear) > 4) {
                $errDiplomate = "Diplomate year is invalid";
                $flag = false;
                $errors[] = $errDiplomate;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the life member year entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['lifeMemberYear'])) {
            $lifeMemberYear = test_input($_POST['lifeMemberYear']);
            $flag = true;
            if(!preg_match("/^((19|20)[0-9][0-9])*$/", $lifeMemberYear) || strlen($lifeMemberYear) > 4) {
                $errLifemember = "Life member year is Invalid";
                $flag = false;
                $errors[] = $errLifemember;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the associate fellow year entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['associateFellowYear'])) {
            $associateFellowYear = test_input($_POST['associateFellowYear']);
            $flag = true;
            if(!preg_match("/^((19|20)[0-9][0-9])*$/", $associateFellowYear) || strlen($associateFellowYear) > 4) {
                $errAssociateFellow = "Associate fellow year is invalid";
                $flag = false;
                $errors[] = $errAssociateFellow;
            }
        }

        /**
         * @desc checks if there is a value entered
         * @param value that handles the associate year entered by the user
         * @$errFname a variable the sets the error message if there is no value present
         * $flag set to false if there is no value present
         * $errors {array} collects the error messages
         */

        if(isset($_POST['associateYear'])) {
            $associateYear = test_input($_POST['associateYear']);
            $flag = true;
            if(!preg_match("/^((19|20)[0-9][0-9])*$/", $associateYear) || strlen($associateYear) > 4) {
                $errAssociate = "Associate year is invalid";
                $flag = false;
                $errors[] = $errAssociate;
            }
        }


        /**
         * @ $file_new_name will handle the new name of the image file
         * @ $tmpName will handle the tmp name
         * @ $filePath will handle the file path
         * @ check if file name is not empty
         * @ $filename handle the name of file
         * @ $size handle the size of file
         * @ $error handle errors if there is a file error
         * @ $type handle file type
         * @ $fileExt separate the extension from the filename
         * @ $file_extension set the file extension to lower case
         * @ $allowedExtension {array} List of accepted extensions
         * @@param in_array checks if the value existing in an array
         * 
         */

        $file_new_name = '';
        $tmpName = '';
        $filePath = '';
        if(!empty($_FILES['file']['name'])) {
            $filename = $_FILES['file']['name'];
            $tmpName = $_FILES['file']['tmp_name'];
            $size = $_FILES['file']['size'];
            $error = $_FILES['file']['error'];
            $type = $_FILES['file']['type'];
            
            $fileExt = explode('.', $filename);
            
            $file_extension = strtolower(end($fileExt));

            $allowedExtension = array("jpg", "png", "jpeg", "pdf");

            if(in_array($file_extension, $allowedExtension)) {
                if($error === 0) {
                    if($size < 1500000) {
                        $file_new_name = uniqid('', true).'.'.$file_extension;
                        $filePath = './images/uploads/'.$file_new_name;
                        // move_uploaded_file($tmpName, $filePath);                       
                    } else {
                        $imgErr = "File too large.";
                        $flag = false;
                        $errors[] = $imgErr;
                    }
                } else {
                    $imgErr = "There was an error uploading your file.";
                    $flag = false;
                    $errors[] = $imgErr;
                }
            } else {
                $imgErr = "Invalid file type.";
                $flag = false;
                $errors[] = $imgErr;
            }
        }

        $bFname = $_POST['bFname'];
        $bMname = $_POST['bMname'];
        $bLname = $_POST['bLname'];
        $bSuffix = $_POST['bSuffix'];

        

        $errContact_fname = $errContact_mname = $errContact_lname = $errContact_mobilenumber = "";

        /**
         * @desc checks if there is value entered by the user
         * @param value that handles the contact_fname entered by the user
         * @errContact_fname handles the error message if there is an error
         * entered by the user
         * @$flag will set the value to false if the input failed
         * @$errors an array where $errContact_fname will be stored
         */

        if(isset($_POST['contact_fname'])) {
            $contact_fname = test_input($_POST['contact_fname']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-]*$/", $contact_fname)) {
                $errContact_fname = "Invalid contact first name";
                $flag = false;
                $errors[] = $errContact_fname;
            }
        }

        /**
         * @desc checks if there is value entered by the user
         * @param value that handles the contact_mname entered by the user
         * @$errContact_mname handles the error message if there is an error entered by the user
         * @$flag will set the value to false if the input failed
         * @$errors an array where $errContact_fname will be stored
         */

        if(isset($_POST['contact_mname'])) {
            $contact_mname = test_input($_POST['contact_mname']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-]*$/", $contact_mname)) {
                $errContact_mname = "Invalid contact middle name";
                $flag = false;
                $errors[] = $errContact_mname;
            }
        }

        /**
         * @desc checks if there is value entered by the user
         * @param value that handles the contact_lname entered by the user
         * @$errContact_lname handles the error message if there is an error entered by the user
         * @$flag will set the value to false if the input failed
         * @$errors an array where $errContact_fname will be stored
         */

        if(isset($_POST['contact_lname'])) {
            $contact_lname = test_input($_POST['contact_lname']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-]*$/", $contact_lname)) {
                $errContact_lname = "Invalid contact last name";
                $flag = false;
                $errors[] = $errContact_lname;
            }
        }

        /**
         * @desc checks if there is value entered by the user
         * @param value that handles the contact_mobilenumber entered by the user
         * @$errContact_mobilenumber handles the error message if there is an error entered by the user
         * @$flag will set the value to false if the input failed
         * @$errors an array where $errContact_mobilenumber will be stored
         */

        if(isset($_POST['contact_mobilenumber'])) {
            $contact_mobilenumber = test_input($_POST['contact_mobilenumber']);
            $flag = true;
            if(!preg_match("/^[0-9]*$/", $contact_mobilenumber)) {
                $errContact_mobilenumber = "Invalid contact mobile number";
                $flag = false;
                $errors[] = $errContact_mobilenumber;
            }
        }

        // INTERNATIONAL AFFILIATION
        $errIntAff = '';
        if(isset($_POST['international_society'])) {
            $intSoc = test_input($_POST['international_society']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-\.]*$/", $intSoc)) {
                $errIntAff = "Invalid international affiliation";
                $flag = false;
                $errors[] = $errIntAff;
            }
        }

        if($flag) { //if flag is true, it will execute the following code
            if(count($errors) > 0) { //if there is errors
                $message .= "
                            <div class='alert alert-danger'>
                                <h2>Error! Please fill up the following.</h2>
                                <ul class='list-group-numbered'>
                            ";
                foreach($errors as $error) :
                    // $message = "<div class='alert alert-danger'>$error</div></br>";
                    $message .= "<li class='list-group-item list-group-item-danger'>$error,</li>";
                endforeach;
                $message .= "
                                </ul>
                            </div>
                            ";
                // $message = "<div class='alert alert-danger'>Fill up the required fields</div>";
            } else { //if there is no error
                $conn->autocommit(false);

                /* 
                   @ SAVE Data to database
                */

                //INSERT DATA TO DATABASE
                //PREPARING DATA for tbl_information
                $stmt = $conn->prepare("INSERT INTO tbl_information (first_name, middle_name, last_name, suffix, gender, mobile_number, second_mobile_number, email, prcno, pmano, deceased, birth_month, birth_day, birth_year, age, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                //Bind data
                $stmt->bind_param("ssssssisissiiiis", $firstName, $middleName, $lastName, $suffix, $gender, $mobileNumber, $second_mobileNumber, $email, $prcNumber, $pmaNumber, $isDeceased, $birthMonth, $birthDay, $birthYear, $age, $file_new_name);
                //Store Data
                $stmt->execute();

                // $conn->query($sql) or die($conn->error); //STORING DATA
                $drLastID = $conn->insert_id; //Get the last id of data inserted

                //Generate unique ID
                $currYear = date("Y");
                $genUid = str_pad($drLastID, 5, '0', STR_PAD_LEFT);
                $uid = $currYear.$genUid;

                /**
                 * Prepare sql statement
                 * Binding parameters
                 * Execute the sql statement
                 */

                $stmt = $conn->prepare("INSERT INTO tbl_contact_person (dr_id, cp_first_name, cp_middle_name, cp_last_name, cp_mobile_number) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("issss", $drLastID, $contact_fname, $contact_mname, $contact_lname, $contact_mobilenumber);
                $stmt->execute();

                $stmt = $conn->prepare("INSERT INTO tbl_uid (userid, user_uid) VALUES (?, ?)");
                $stmt->bind_param("ii", $drLastID, $uid);
                $stmt->execute();

                // PREPARING DATA for tbl_member_year
                $stmt = $conn->prepare("INSERT INTO tbl_member_year (id, fellow_year, life_fellow_year, diplomate_year, life_member_year, associate_fellow, associate) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iiiiiii", $drLastID, $fellowYear, $lifeFellowYear, $diplomateYear, $lifeMemberYear, $associateFellowYear, $associateYear);
                $stmt->execute();
            
                //PREPARING DATA for tbl_school
                $stmt = $conn->prepare("INSERT INTO tbl_school (docid, medical_school, year_graduated, training_school, year_finish) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("isisi", $drLastID, $medicalSchool, $yearGraduated, $schoolTrained, $trainedYearGrad);
                $stmt->execute();
                
                //PREPARING DATA for tbl_hospital
                $stmt = $conn->prepare("INSERT INTO tbl_hospital (doctor_id, hospital_affiliation, cityprovince, contactno, landlineno, home_address, principal_office, international_affiliation) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssssss", $drLastID, $hospitalAff, $cityProvince, $contactNumber, $landlineNumber, $homeAddress, $principalOffice, $intSoc);
                $stmt->execute();
                
                /* 
                    FOREACH LOOPING THROUGH ARRAY OF PRACTICE
                */

                foreach($practice as $p => $v) {
                    //PREPARING DATA for tbl_hospital_practice
                    $stmt = $conn->prepare("INSERT INTO tbl_hospital_practice (information_id, practice_id) VALUES (?, ?)");
                    $stmt->bind_param("ii", $drLastID, $v);
                    $stmt->execute();
                }

                /* 
                    PREPARING DATA for other tbl_practice
                */

                if(!empty($other_prac)){
                    $stmt = $conn->prepare("INSERT INTO tbl_practice (practice) VALUES (?)");
                    $stmt->bind_param("s", $other_prac);
                    $result = $stmt->execute();

                    if($result) {
                        $practiceLastID = $conn->insert_id; //Getting the last ID of data inserted in tbl_practice
                        
                    //PREPARING NEW DATA for tbl_hospital_practice
                    $stmt = $conn->prepare("INSERT INTO tbl_hospital_practice (information_id, practice_id) VALUES (?, ?)");
                    $stmt->bind_param("ii", $drLastID, $practiceLastID);
                    $stmt->execute();
                    }
                }

                /*
                    FOREACH LOOPING THROUGH ARRAY OF CATEGORY
                */

                foreach($category as $c => $v){
                    //PREPARING DATA for tbl_hospital_drcategory
                    $stmt = $conn->prepare("INSERT INTO tbl_hospital_drcategory (information_id, category_id) VALUES (?, ?)");
                    $stmt->bind_param("ii", $drLastID, $v);
                    $stmt->execute();
                }

                //PREPARING DATA FOR other tbl_drcategory
                if(!empty($other_cat)) {
                    $stmt = $conn->prepare("INSERT INTO tbl_drcategory (category) VALUES (?)");
                    $stmt->bind_param("s", $other_cat);
                    $result = $stmt->execute();

                    if($result) {
                        $categoryLastID = $conn->insert_id; //Getting the last id of data inserted in tbl_drcategory

                        //PREPARING NEW DATA for tbl_hospital_drcategory
                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_drcategory (information_id, category_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $drLastID, $categoryLastID);
                        $stmt->execute();
                    }
                }
                
                /*
                *   FOREACH LOOPING THROUGH ARRAY VALUES OF CHAPTER
                */

                foreach($chapter as $ch => $v) {
                    //PREPARING DATA for tbl_hospital_chapter
                    $stmt = $conn->prepare("INSERT INTO tbl_hospital_chapter (information_id, chapter_id) VALUES (?, ?)");
                    $stmt->bind_param("ii", $drLastID, $v);
                    $stmt->execute();
                }

                //PREPARING DATA for other tbl_chapter
                if(!empty($other_chap)) {
                    $stmt = $conn->prepare("INSERT INTO tbl_chapter VALUES (?)");
                    $stmt->bind_param("s", $other_chap);
                    $result = $stmt->execute();
                    
                    if($result) {
                        $chapterLastID = $conn->insert_id;

                        //PREPARING NEW DATA for tbl_hospital_chapter
                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_chapter (information_id, chapter_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $drLastID, $chapterLastID);
                        $stmt->execute();
                    }
                }
                
                /**
                 * FOREACH LOOPING THRUGH ARRAY VALUES OF SUBSPECIALTY
                 */
                foreach($arr as $s => $v) {
                    //PREPARING DATA FOR tbl_hospital_subspecialty
                    $stmt = $conn->prepare("INSERT INTO tbl_hospital_subspecialty (information_id, subspecialty_id) VALUES (?, ?)");
                    $stmt->bind_param("ii", $drLastID, $v);
                    $stmt->execute();
                }

                //PREPARING DATA FOR other tbl_subspecialty
                if(!empty($other_sub)) {
                    $stmt = $conn->prepare("INSERT INTO tbl_subspecialty (subspecialty) VALUES (?)");
                    $stmt->bind_param("s", $other_sub);
                    $result = $stmt->execute();

                    if($result) {
                        $subspecialtyLastID = $conn->insert_id;

                        //PREPARING NEW DATA for tbl_hospital_subspecialty
                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_subspecialty (information_id, subspecialty_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $drLastID, $subspecialtyLastID);
                        $stmt->execute();
                    }
                }

                /**
                 * FOREACH LOOPING THROUGH ARRAY OF SPECIAL TRAINING
                 */
                foreach($spec_t as $st => $v) {
                    $stmt = $conn->prepare("INSERT INTO tbl_hospital_special_training (information_id, special_training_id) VALUES (?, ?)");
                    $stmt->bind_param("ii", $drLastID, $v);
                    $stmt->execute();
                }

                if(!empty($other_st)) {
                    $stmt = $conn->prepare("INSERT INTO tbl_special_training (special_training) VALUES (?)");
                    $stmt->bind_param("s", $other_st);
                    $result = $stmt->execute();

                    if($result) {
                        $other_st_LastID = $conn->insert_id;

                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_special_training (information_id, special_training_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $drLastID, $other_st_LastID);
                        $stmt->execute();
                    }
                }

                /**
                 * FOREACH LOOPING THROUGH ARRAY OF COUNCIL
                 */
                foreach($council as $cl => $v) {
                    $stmt = $conn->prepare("INSERT INTO tbl_hospital_council (information_id, council_id) VALUES (?, ?)");
                    $stmt->bind_param("ii", $drLastID, $v);
                    $stmt->execute();
                }

                if(!empty($otherCouncil)) {
                    $stmt = $conn->prepare("INSERT INTO tbl_council (council) VALUES (?)");
                    $stmt->bind_param("s", $otherCouncil);
                    $result = $stmt->execute();

                    if($result) {
                        $other_council_lastID = $conn->insert_id;

                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_council (information_id, council_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $drLastID, $other_council_lastID);
                        $stmt->execute();
                    }
                }

                /**
                 * FOREACH LOOPING THROUGH ARRAY OF COMMITTEE
                 */
                foreach($committee as $comm => $v){
                    $stmt = $conn->prepare("INSERT INTO tbl_hospital_committee (information_id, cmt_id) VALUES (?, ?)");
                    $stmt->bind_param("ii", $drLastID, $v);
                    $stmt->execute();
                }

                if(!empty($otherCommittee)) {
                    $stmt = $conn->prepare("INSERT INTO tbl_committee (committee) VALUES (?)");
                    $stmt->bind_param("s", $otherCommittee);
                    $result = $stmt->execute();

                    if($result) {
                        $other_committee_lastID = $conn->insert_id;

                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_committee (information_id, cmt_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $drLastID, $other_committee_lastID);
                        $stmt->execute();
                    }
                }

                foreach($bFname as $index => $values) {
                    $stmt = $conn->prepare("INSERT INTO tbl_beneficiaries (dr_id, ben_first_name, ben_middle_name, ben_last_name, ben_suffix) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("issss", $drLastID, $values, $bMname[$index], $bLname[$index], $bSuffix[$index]);
                    $stmt->execute();
                }
                
                if(!$conn->commit()) {
                    die($conn->error);
                } else {
                    move_uploaded_file($tmpName, $filePath);                       
                    $message = "<div class='alert alert-success'>Add Success</div>";
                    $stmt->close();
                    $conn->close(); //close database connection
                    $_POST = array(); // clear table if data is added
                }
            }
        } else {
            $message = "<div class='alert alert-danger'>Failed to add</div>"; // failed to add
        }
    }
    //update a user
    if(isset($_POST['update'])){
        $id = $_GET['id'];

        if(empty($_POST['updateFname'])) {
            $errFname = "First name is required";
            $flag = false;
            $errors[] = $errFname;
        } else {
            $fname = test_input($_POST['updateFname']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-\.]*$/", $fname)) {
                $errFname = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errFname;
            }
        }

        if(empty($_POST['updateMname'])) {
            $errMname = "Middle name is required";
            $flag = false;
            $errors[] = $errMname;
        } else {
            $midName = test_input($_POST['updateMname']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-\.]*$/", $midName)) {
                $errMname = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errMname;
            }
        }

        if(empty($_POST['updateLname'])) {
            $errLname = "Last name is required";
            $flag = false;
            $errors[] = $errLname;
        } else {
            $lastName = test_input($_POST['updateLname']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-\.]*$/", $lastName)) {
                $errLname = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errLname;
            }
        }

        if(isset($_POST['updateSuffix'])) {
            $suffix = test_input($_POST['updateSuffix']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-\.]*$/", $suffix)) {
                $errSuffix = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errSuffix;
            }
        }

        if(isset($_POST['updateGender'])) {
            $gender = test_input($_POST['updateGender']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z]*$/", $gender)) {
                $errGender = "Please select a gender";
                $flag = false;
                $errors[] = $errGender;
            }
        }

        if(empty($_POST['updateMobile'])) {
            $errMobilenum = "Mobile number is required";
            $flag = false;
            $errors[] = $errMobilenum;
        } else {
            $mobileNumber = test_input($_POST['updateMobile']);
            $flag = true;
            if(!preg_match("/^[0-9]*$/", $mobileNumber)) {
                $errMobilenum = "Only numbers are allowed in this field";
                $flag = false;
                $errors[] = $errMobilenum;
            }
            if(strlen($mobileNumber) > 11 || strlen($mobileNumber) < 11) {
                $errMobilenum = "Mobile number must have 11 digits";
                $flag = false;
                $errors[] = $errMobilenum;
            }
        }

        if(isset($_POST['updateSecondMobile'])) {
            $second_mobileNumber = test_input($_POST['updateSecondMobile']);
            $flag = true;
            if(!preg_match("/^[0-9]*$/", $second_mobileNumber)) {
                $errSecondMobile = "Only numbers are allowed in this field";
                $flag = false;
                $errors[] = $errSecondMobile;
            }
            // if(strlen($second_mobileNumber) > 11 || strlen($second_mobileNumber) < 11) {
            //     $errMobilenum = "Second mobile number must have 11 digits";
            //     $flag = false;
            //     $errors[] = $errMobilenum;
            // }
        }

        if(empty($_POST['updateEmail'])) {
            $errEmail = "Email is required";
            $flag = false;
            $errors[] = $errEmail;
        } else {
            $email = test_input($_POST['updateEmail']);
            $flag = true;
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errEmail = "Invalid email";
                $flag = false;
                $errors[] = $errEmail;
            }
        }

        if(empty($_POST['updatePRC'])) {
            $errPrcno = "PRC is required";
            $flag = false;
            $errors[] = $errPrcno;
        } else {
            $prcno = test_input($_POST['updatePRC']);
            $flag = true;
            if(!preg_match("/^[0-9]*$/", $prcno)) {
                $errPrcno = "Only numbers are allowed in this field";
                $flag = false;
                $errors[] = $errPrcno;
            }
            if(strlen($prcno) > 6 || strlen($prcno) < 5) {
                $errPrcno = "PRC must have 5 digits";
                $flag = false;
                $errors[] = $errPrcno;
            }
        }

        if(isset($_POST['updatePMA'])) {
            $pmano = test_input($_POST['updatePMA']);
            $flag = true;
        }

        if(isset($_POST['updateDeceased'])) {
            $deceased = test_input($_POST['updateDeceased']);
            $flag = true;
        }

        if(empty($_POST['updateMonth'])) {
            $errBirthmonth = "Please select a month";
            $flag = false;
            $errors[] = $errBirthmonth;
        } else {
            $month = test_input($_POST['updateMonth']);
            $flag = true;
        }

        if(empty($_POST['updateDay'])) {
            $errBirthday = "Please select a day";
            $flag = false;
            $errors[] = $errBirthday;
        } else {
            $day = test_input($_POST['updateDay']);
            $flag = true;
        }

        if(empty($_POST['updateYear'])) {
            $errBirthyear = "Please select a year";
            $flag = false;
            $errors[] = $errBirthyear;
        } else {
            $year = test_input($_POST['updateYear']);
            $flag = true;
        }

        if(empty($_POST['updateAge'])) {
            $errAge = "Age is required";
            $flag = false;
            $errors[] = $errAge;
        } else {
            $age = test_input($_POST['updateAge']);
            $flag = true;
            if(!preg_match("/^[0-9]*$/", $age)) {
                $errAge = "Only numbers are allowed in this field";
                $flag = false;
                $errors[] = $errAge;
            }
        }

        if(empty($_POST{'updateSchool'})) {
            $errMedschool = "Medical school is required";
            $flag = false;
            $errors[] = $errMedschool;
        } else {
            $medSchool = test_input($_POST['updateSchool']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-\.]*$/", $medSchool)) {
                $errMedschool = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errMedschool;
            }
        }

        if(empty($_POST['updateSY'])) {
            $errYeargrad = "Year graduated is required";
            $flag = false;
            $errors[] = $errYeargrad;
        } else {
            $yearGrad = test_input($_POST['updateSY']);
            $flag = true;
            if(!preg_match("/^(19|20)[0-9][0-9]*$/", $yearGrad) || strlen($yearGrad) > 4){
                $errYeargrad = "Invalid year";
                $flag = false;
                $errors[] = $errYeargrad;
            }
        }

        if(empty($_POST['updateSchooltrained'])) {
            $errSchoolTrained = "Training institution is required";
            $flag = false;
            $errors[] = $errSchoolTrained;
        } else {
            $updateSchooltrained = test_input($_POST['updateSchooltrained']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s]*$/", $updateSchooltrained)) {
                $errSchoolTrained = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errSchoolTrained;
            }
        }

        if(empty($_POST['updateYearFinish'])) {
            $errTrainedYearGrad = "Year finish for training institution is required";
            $flag = false;
            $errors[] = $errTrainedYearGrad;
        } else {
            $updateYearFinish = test_input($_POST['updateYearFinish']);
            $flag = true;
            if(!preg_match("/^(19|20)[0-9][0-9]*$/", $updateYearFinish) || strlen($updateYearFinish) > 4) {
                $errTrainedYearGrad = "Invalid Year";
                $flag = false;
                $errors[] = $errTrainedYearGrad;
            }
        }

        if(empty($_POST['updateHospital'])) {
            $errHospitalaff = "Hospital affiliation is required";
            $flag = false;
            $errors[] = $errHospitalaff;
        } else {
            $HospitalAff = test_input($_POST['updateHospital']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-\.]*$/", $HospitalAff)) {
                $errHospitalaff = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errHospitalaff;
            }
        }

        if(empty($_POST['updatedCP'])) {
            $errCityprov = "City/Province is required";
            $flag = false;
            $errors[] = $errCityprov;
        } else {
            $cityProvince = test_input($_POST['updatedCP']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z0-9\s\-\.]*$/", $cityProvince)) {
                $errCityprov = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errCityprov;
            }
        }

        if(empty($_POST['updateContact'])) {
            $errContactno = "Contact number is required";
            $flag = false;
            $errors[] = $errContactno;
        } else {
            $contactno = test_input($_POST['updateContact']);
            $flag = true;
            if(!preg_match("/^[0-9]*$/", $contactno)) {
                $errContactno = "Only numbers are required in this field";
                $flag = false;
                $errors[] = $errContactno;
            }
            // if(strlen($contactno) > 11 || strlen($contactno) < 11) {
            //     $errContactno = "Contact number must have exact 11 digits";
            //     $flag = false;
            //     $errors[] = $errContactno;
            // }
        }

        if(empty($_POST['updateLandline'])) {
            $errLandlineno = "Landline number is required";
            $flag = false;
            $errors[] = $errLandlineno;
        } else {
            $landline = test_input($_POST['updateLandline']);
            $flag = true;
            if(!preg_match("/^[0-9\(\)\-]*$/", $landline)) {
                $errLandline = "No letters are allowed in this field";
                $flag = false;
                $errors[] = $errLandline;
            }
        }

        if(empty($_POST['updateHomeAddress'])) {
            $errHomeAddress = "Home address is required";
            $flag = false;
            $errors[] = $errHomeAddress;
        } else {
            $homeAddress = test_input($_POST['updateHomeAddress']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z0-9\s\-\.]*$/", $homeAddress)){
                $errHomeAddress = "Invalid address";
                $flag = false;
                $errors[] = $errHomeAddress;
            }
        }

        if(empty($_POST['updatedPrincipaloffice'])) {
            $errPrincipalofc = "Principal office is required";
            $flag = false;
            $errors[] = $errPrincipalofc;
        } else {
            $principal = test_input($_POST['updatedPrincipaloffice']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z0-9\s\-\.]*$/", $principal)){
                $errPrincipalofc = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errPrincipalofc;
            }
        }

        /**
         * international society
         */

        if(isset($_POST['update_int_society'])) {
            $update_int_soc = test_input($_POST['update_int_society']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-\.]*$/", $update_int_soc)) {
                $errIntAff = "Invalid international society";
                $flag = false;
                $errors[] = $errIntAff;
            }
        }

        /**
         * UPDATING CATEGORY
         * METHOD: POST
         */

        if(isset($_POST['updateCategory'])) {
            $update_cat = array();
            foreach($_POST['updateCategory'] as $cat => $v){
                $update_cat[] = test_input($v);
                $flag = true;
            }
        }

        if(isset($_POST['update_other_cat'])){
            $update_other_cat = test_input($_POST['update_other_cat']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s]*$/", $update_other_cat)) {
                $errOthercat = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errOthercat;
            }
        }

        /**
         * UPDATING CHAPTER
         * METHOD: POST
        */ 

        if(isset($_POST['updateChapter'])) {
            $update_chap = array();
            foreach($_POST['updateChapter'] as $chap => $v) {
                $update_chap[] = test_input($v);
                $flag = true;
            }
        }

        if(isset($_POST['update_other_chap'])) {
            $update_other_chap = test_input($_POST['update_other_chap']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s]*$/", $update_other_chap)) {
                $errOtherChap = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errOtherChap;
            }
        }

        /**
         * UPDATING PRACTICE
         * METHOD: POST
         */

        if(isset($_POST['updatePractice'])) {
            $update_prac = array();
            foreach($_POST['updatePractice'] as $prac => $v) {
                $update_prac[] = test_input($v);
                $flag = true;
            }
        }

        if(isset($_POST['update_other_practices'])){
            $update_other_practices = test_input($_POST['update_other_practices']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s]*$/", $update_other_practices)) {
                $errOtherPractice = "Invalid practice.";
                $flag = false;
                $errors[]= $errOtherPractice;
            }
        }

        /**
         * UPDATING SUBSPECIALTY
         * METHOD: POST
         */

        if(isset($_POST['update_subspecialty'])) {
            $update_sub = array();
            foreach($_POST['update_subspecialty'] as $updateSub => $v) {
                $update_sub[] = test_input($v);
                $flag = true;
            }
            
        }

        if(isset($_POST['update_other_sub'])) {
            $update_other_sub = test_input($_POST['update_other_sub']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-]*$/", $update_other_sub)) {
                $errOthersub = "Invalid subspecialty";
                $flag = false;
                $errors[] = $errOthersub;
            }
        }

        /**
         * UPDATING SPECIAL TRAINING
         * METHOD: POST
         */

        if(isset($_POST['updateSpecialTraining'])) {
            $specialTraining = array();
            foreach($_POST['updateSpecialTraining'] as $ust => $val) {
                $specialTraining[] = $val;
                $flag = true;
            }
        }

        if(isset($_POST['upOtherSpecialTraining'])) {
            $upOtherSpecTrain = test_input($_POST['upOtherSpecialTraining']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-]*$/", $upOtherSpecTrain)) {
                $errSpecialtraining = "Invalid special training";
                $flag = false;
                $errors[] = $errSpecialtraining;
            }
        }

        /**
         * UPDATING COUNCIL
         * METHOD: POST
         */

        if(isset($_POST['updateCouncil'])) {
            $council = array();
            foreach($_POST['updateCouncil'] as $cncl => $val) {
                $council[] = $val;
                $flag = true;
            }
        }

        if(isset($_POST['updateOtherCouncil'])) {
            $updateOtherCouncil = test_input($_POST['updateOtherCouncil']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-]*$/", $updateOtherCouncil)) {
                $errUpOtherCouncil = "Invalid Other council";
                $flag = false;
                $errors[] = $errUpOtherCouncil;
            }
        }

        /**
         * UPDATING COMMITTEE
         * METHOD: POST
         */

        if(isset($_POST['updateCommittee'])) {
            $committee = array();
            foreach($_POST['updateCommittee'] as $comm => $val) {
                $committee[] = $val;
                $flag = true;
            }
        }

        if(isset($_POST['updateOtherCommittee'])) {
            $updateOtherCommittee = test_input($_POST['updateOtherCommittee']);
            $flag = true;
            if(!preg_match("/^[a-zA-Z\s\-]*$/", $updateOtherCommittee)) {
                $errUpOtCommittee = "Invalid other committee";
                $flag = false;
                $errors[] = $errUpOtCommittee;
            }
        }

        //Fellow
        if(isset($_POST['updateFellow'])) {
            $updateFellow = test_input($_POST['updateFellow']);
            $flag = true;
            if(!preg_match("/^((19|20)[0-9][0-9])*$/", $updateFellow) || strlen($updateFellow) > 4) {
                $errFellow = "Fellow year is invalid";
                $flag = false;
                $errors[] = $errFellow;
            }
        }

        //Life fellow
        if(isset($_POST['updateLifeFellow'])) {
            $updateLifeFellow = test_input($_POST['updateLifeFellow']);
            $flag = true;
            if(!preg_match("/^((19|20)[0-9][0-9])*$/", $updateLifeFellow) || strlen($updateLifeFellow) > 4) {
                $errLifefellow = "Life fellow is invalid";
                $flag = false;
                $errors[] = $errLifefellow;
            }
        }

        //diplomate
        if(isset($_POST['updateDiplomate'])) {
            $updateDiplomate = test_input($_POST['updateDiplomate']);
            $flag = true;
            if(!preg_match("/^((19|20)[0-9][0-9])*$/", $updateDiplomate) || strlen($updateDiplomate) > 4) {
                $errDiplomate = "Diplomate year is invalid";
                $flag = false;
                $errors[] = $errDiplomate;
            }
        }

        //Life member
        if(isset($_POST['updateLifeMember'])) {
            $updateLifeMember = test_input($_POST['updateLifeMember']);
            $flag = true;
            if(!preg_match("/^((19|20)[0-9][0-9])*$/", $updateLifeMember) || strlen($updateLifeMember) > 4) {
                $errLifemember = "Life member year is invalid";
                $flag = false;
                $errors[] = $errLifemember;
            }
        }

        //Associate fellow
        if(isset($_POST['updateAssociateFellow'])) {
            $updateAssociateFellow = test_input($_POST['updateAssociateFellow']);
            $flag = true;
            if(!preg_match("/^((19|20)[0-9][0-9])*$/", $updateAssociateFellow) || strlen($updateAssociateFellow) > 4) {
                $errAssociateFellow = "Associate fellow year is invalid";
                $flag = false;
                $errors[] = $errAssociateFellow;
            }
        }

        //Associate
        if(isset($_POST['updateAssociate'])) {
            $updateAssociate = test_input($_POST['updateAssociate']);
            $flag = true;
            if(!preg_match("/^((19|20)[0-9][0-9])*$/", $updateAssociate) || strlen($updateAssociate) > 4) {
                $errAssociate = "Associate year is invalid";
                $flag = false;
                $errors[] = $errAssociateFellow;
            }
        }

        $file_new_name = '';
        $tmpName = '';
        $filePath = '';
        if(!empty($_FILES['update_file']['name'])) {
            $filename = $_FILES['update_file']['name'];
            $tmpName = $_FILES['update_file']['tmp_name'];
            $size = $_FILES['update_file']['size'];
            $error = $_FILES['update_file']['error'];
            $type = $_FILES['update_file']['type'];
            
            $fileExt = explode('.', $filename);
            
            $file_extension = strtolower(end($fileExt));

            $allowedExtension = array("jpg", "png", "jpeg", "pdf");

            if(in_array($file_extension, $allowedExtension)) {
                if($error === 0) {
                    if($size < 1500000) {
                        $file_new_name = uniqid('', true).'.'.$file_extension;
                        $filePath = './images/uploads/'.$file_new_name;                      
                    } else {
                        $imgErr = "File too large.";
                        $flag = false;
                        $errors[] = $imgErr;
                    }
                } else {
                    $imgErr = "There was an error uploading your file.";
                    $flag = false;
                    $errors[] = $imgErr;
                }
            } else {
                $imgErr = "Invalid file type.";
                $flag = false;
                $errors[] = $imgErr;
            }
        } else {
            $file_new_name = $_SESSION['current_image'];
        }

        if($flag) {
            if(count($errors) > 0) {
                $message = "<div class='alert alert-danger'>Update Failed</div>";
                print_r($errors);
            } else {
                $conn->autocommit(false);

                $sql = "UPDATE tbl_information
                        INNER JOIN tbl_school ON tbl_information.id = tbl_school.docid
                        INNER JOIN tbl_hospital ON tbl_information.id = tbl_hospital.doctor_id
                        INNER JOIN tbl_member_year ON tbl_information.id = tbl_member_year.id
                        SET first_name = '$fname', middle_name = '$midName', last_name = '$lastName', suffix = '$suffix', gender = '$gender', mobile_number = '$mobileNumber', second_mobile_number = '$second_mobileNumber', email = '$email', prcno = '$prcno', pmano = '$pmano', deceased = '$deceased', birth_month = '$month', birth_day = '$day', birth_year = '$year', age = '$age', image_url = '$file_new_name', medical_school = '$medSchool', year_graduated = '$yearGrad', training_school = '$updateSchooltrained', year_finish = '$updateYearFinish', hospital_affiliation = '$HospitalAff', cityprovince = '$cityProvince', contactno = '$contactno', landlineno = '$landline', principal_office = '$principal', international_affiliation = '$update_int_soc', fellow_year = '$updateFellow', life_fellow_year = '$updateLifeFellow', diplomate_year = '$updateDiplomate', life_member_year = '$updateLifeMember', associate_fellow = '$updateAssociateFellow', associate = '$updateAssociate' WHERE tbl_information.id = $id
                    ";
                $conn->query($sql) or die($conn->error);

                //DROPDOWN UPDATE

                //for category START
                $sql = "SELECT * FROM tbl_hospital_drcategory WHERE information_id = $id";
                $result = $conn->query($sql) or die($conn->error);
                $cat_list = array();
                while($rows = $result->fetch_assoc()){
                    $cat_list[] = $rows['category_id'];
                }
                
                //insert update for category
                foreach($update_cat as $uc){
                    if(!in_array($uc, $cat_list)){
                        $sql = "INSERT INTO tbl_hospital_drcategory (information_id, category_id) VALUES ('$id', '$uc')";
                        $conn->query($sql) or die($conn->error);
                    }
                }

                //other insert for category
                if(!empty($update_other_cat)) {
                    $sql = "INSERT INTO tbl_drcategory (category) VALUES ('$update_other_cat')";
                    $result = $conn->query($sql) or die($conn->error);
                    if($result) {
                        $other_cat_lastID = $conn->insert_id;
                        $sql = "INSERT INTO tbl_hospital_drcategory (information_id, category_id) VALUES ('$id', '$other_cat_lastID')";
                        $conn->query($sql) or die($conn->error);
                    }
                }

                //deleteing update
                foreach($cat_list as $uc) {
                    if(!in_array($uc, $update_cat)) {
                        $sql = "DELETE FROM tbl_hospital_drcategory WHERE information_id = $id AND category_id = $uc";
                        $conn->query($sql) or die($conn->error);
                    }
                }
                //END FOR CATEGORY UPDATE

                //chapter update
                $sql = "SELECT * FROM tbl_hospital_chapter WHERE information_id = $id";
                $result = $conn->query($sql) or die($conn->error);
                $chap_list = array();
                while($rows = $result->fetch_assoc()) {
                    $chap_list[] = $rows['chapter_id'];
                }

                //insert update
                foreach($update_chap as $uch) {
                    if(!in_array($uch, $chap_list)) {
                        $sql = "INSERT INTO tbl_hospital_chapter (information_id, chapter_id) VALUES ('$id', '$uch')";
                        $conn->query($sql) or die($conn->error);
                    }
                }

                //delete update
                foreach($chap_list as $chl) {
                    if(!in_array($chl, $update_chap)) {
                        $sql = "DELETE FROM tbl_hospital_chapter WHERE information_id = $id AND chapter_id = $chl";
                        $conn->query($sql) or die($conn->error);
                    }
                }

                //other update for chapter
                if(!empty($update_other_chap)) {
                    $sql = "INSERT INTO tbl_chapter (chapter) VALUES ('$update_other_chap')";
                    $result = $conn->query($sql) or die($conn->error);
                    if($result) {
                        $update_chapter_lastID = $conn->insert_id;
                        $sql = "INSERT INTO tbl_hospital_chapter (information_id, chapter_id) VALUES ('$id', '$update_chapter_lastID')";
                        $conn->query($sql) or die($conn->error);
                    }
                }

                //chapter end
                //subspecialty update
                $sql = "SELECT * FROM tbl_hospital_subspecialty WHERE information_id = $id";
                $result = $conn->query($sql) or die($conn->error);
                $subspecialty_list = array();
                while($rows = $result->fetch_assoc()) {
                    $subspecialty_list[] = $rows['subspecialty_id'];
                }

                //insert update
                foreach($update_sub as $ups) {
                    if(!in_array($ups, $subspecialty_list)) {
                        $sql = "INSERT INTO tbl_hospital_subspecialty (information_id, subspecialty_id) VALUES ('$id', '$ups')";
                        $conn->query($sql) or die($conn->error);
                    }
                }

                //delete update
                foreach($subspecialty_list as $spl) {
                    if(!in_array($spl, $update_sub)) {
                        $sql = "DELETE FROM tbl_hospital_subspecialty WHERE information_id = $id AND subspecialty_id = $spl";
                        $conn->query($sql) or die($conn->error);
                    }
                }

                //other sub update
                if(!empty($update_other_sub)) {
                    $sql = "INSERT INTO tbl_subspecialty (subspecialty) VALUES ('$update_other_sub')";
                    $result = $conn->query($sql) or die($conn->error);
                    if($result) {
                        $update_sub_lastID = $conn->insert_id;

                        $sql = "INSERT INTO tbl_hospital_subspecialty (information_id, subspecialty_id) VALUES ('$id', '$update_sub_lastID')";
                        $conn->query($sql) or die($conn->error);
                    }
                }

                //end subspecialty
                
                //practice start
                $sql = "SELECT * FROM tbl_hospital_practice WHERE information_id = $id";
                $result = $conn->query($sql) or die($conn->error);
                $practice_list = array();
                while($rows = $result->fetch_assoc()) {
                    $practice_list[] = $rows['practice_id'];
                }

                //insert update
                // print_r($update_prac);
                foreach($update_prac as $up) {
                    if(!in_array($up, $practice_list)) {
                        $sql = "INSERT INTO tbl_hospital_practice (information_id, practice_id) VALUES ('$id', '$up')";
                        $conn->query($sql) or die($conn->error);
                    }
                }

                //delete update
                foreach($practice_list as $pl) {
                    if(!in_array($pl, $update_prac)) {
                        $sql = "DELETE FROM tbl_hospital_practice WHERE information_id = $id AND practice_id = $pl";
                        $conn->query($sql) or die($conn->error);
                    }
                }

                //other practice
                if(!empty($update_other_practices)) {
                    $sql = "INSERT INTO tbl_practice (practice) VALUES ('$update_other_practices')";
                    $result = $conn->query($sql) or die($conn->error);
                    if($result) {
                        $practice_lastID = $conn->insert_id;

                        $sql = "INSERT INTO tbl_hospital_practice (information_id, practice_id) VALUES ('$id', '$practice_lastID')";
                        $conn->query($sql) or die($conn->error);
                    }
                }

                //end practice

                /**
                 * arrays: 
                 * $specialTraining,
                 * $council,
                 * $committee
                 */

                /**
                 * UPDATE SPECIAL TRAINING
                */
                $stmt = $conn->prepare("SELECT * FROM tbl_hospital_special_training WHERE information_id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $st_list = array();
                while($rows = $result->fetch_assoc()) {
                    $st_list[] = $rows['special_training_id'];
                }

                foreach($specialTraining as $st) {
                    if(!in_array($st, $st_list)) {
                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_special_training (information_id, special_training_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $id, $st);
                        $stmt->execute();
                    }
                }

                foreach($st_list as $str) {
                    if(!in_array($str, $specialTraining)) {
                        $stmt = $conn->prepare("DELETE FROM tbl_hospital_special_training WHERE information_id = ? AND special_training_id = ?");
                        $stmt->bind_param("ii", $id, $str);
                        $stmt->execute();
                    }
                }

                if(!empty($upOtherSpecTrain)) {
                    $stmt = $conn->prepare("INSERT INTO tbl_special_training (special_training) VALUES (?) ");
                    $stmt->bind_param("s", $upOtherSpecTrain);
                    $result = $stmt->execute();

                    if($result) {
                        $st_lastID = $conn->insert_id;
                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_special_training (information_id, special_training_id) VALUES (?,?)");
                        $stmt->bind_param("ii", $id, $st_lastID);
                        $stmt->execute();
                    }
                }

                /**
                 * UPDATE COUNCIL
                 * $updateOtherCouncil
                 */

                $stmt = $conn->prepare("SELECT * FROM tbl_hospital_council WHERE information_id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $council_list = array();
                while($rows = $result->fetch_assoc()) {
                    $council_list[] = $rows['council_id'];
                }
                foreach($council as $cn) {
                    if(!in_array($cn, $council_list)) {
                        $stmt = $conn->prepare("INSERT INTO tbl_hosptal_council (information_id, council_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $id, $cn);
                        $stmt->execute();
                    }
                }

                foreach($council_list as $cl) {
                    if(!in_array($cl, $council)) {
                        $stmt = $conn->prepare("DELETE FROM tbl_hospital_council WHERE information_id = ? AND council_id = ?");
                        $stmt->bind_param("ii", $id, $cl);
                        $stmt->execute();
                    }
                }

                if(!empty($$updateOtherCouncil)) {
                    $stmt = $conn->prepare("INSERT INTO tbl_council (council) VALUES (?)");
                    $stmt->bind_param("s", $updateOtherCouncil);
                    $result = $stmt->execute();
                    if($result) {
                        $cnl_lastID = $conn->insert_id;
                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_council (information_id, council_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $id, $cnl_lastID);
                        $stmt->execute();
                    }
                }

                /**
                 * UPDATE COMMITTEE
                 */

                $stmt = $conn->prepare("SELECT * FROM tbl_hospital_committee WHERE information_id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $comm_list = array();
                while($rows = $result->fetch_assoc()) {
                    $comm_list[] = $rows['cmt_id'];
                }

                foreach($committee as $cmt) {
                    if(!in_array($cmt, $comm_list)) {
                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_committee (information_id, cmt_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $id, $cmt);
                        $stmt->execute();
                    }
                }

                foreach($comm_list as $cml) {
                    if(!in_array($cml, $committee)) {
                        $stmt = $conn->prepare("DELETE FROM tbl_hospital_committee WHERE information_id = ? AND cmt_id = ?");
                        $stmt->bind_param("ii", $id, $cml);
                        $stmt->execute();
                    }
                }

                if(!empty($updateOtherCommittee)) {
                    $stmt = $conn->prepare("INSERT INTO tbl_committee (committee) VALUES (?)");
                    $stmt->bind_param("s", $updateOtherCommittee);
                    $result = $stmt->execute();
                    if($result) {
                        $committee_lastID = $conn->insert_id;
                        $stmt = $conn->prepare("INSERT INTO tbl_hospital_committee (information_id, cmt_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $id, $committee_lastID);
                        $stmt->execute();
                    }
                }

                //get hospital, contact, and lineline for history

                $sql = "SELECT hospital_affiliation, contactno, landlineno FROM tbl_hospital WHERE doctor_id = $id";
                $res = $conn->query($sql);
                $row = $res->fetch_assoc();
                $hospital = $_SESSION['hospital_aff'];
                $contact = $_SESSION['contact'];
                $landline = $_SESSION['landline'];

                if(strtolower($row['hospital_affiliation']) !== strtolower($hospital) &&
                    strtolower($row['contactno']) !== strtolower($contact) &&
                    strtolower($row['landlineno']) !== strtolower($landline)
                ) {
                    $sql = "INSERT INTO tbl_history (doctor_id, hospital_affiliation, contact, landline) VALUES ('$id', '$hospital', '$contact', '$landline')";
                    $conn->query($sql) or die($conn->error);
                }

                if(!$conn->commit()) {
                    die($stmt->error);
                } else {
                    if(move_uploaded_file($tmpName, $filePath)) {
                        $current_image = $_SESSION['current_image'];
                        $path = "./images/uploads/$current_image";
                        if(is_file($path)) unlink($path);
                    }
                    $message = "<div class='alert alert-success'>Update success!</div>";
                    header("Location: view.php?id=$id");
                }
            }
        } else {
            $message = "<div class='alert alert-danger'>".$conn->error."</div>";
        }
    }

    //Insert Additional Information
    if(isset($_POST['addMoreInfo'])){
        $userId = $_SESSION['addId'];
        // print_r($userId);

        if(empty($_POST['addHospitalAff'])){
            $errAddHospital = "Hospital Affiliation is required";
            $flag = false;
            $errors[] = $errAddHospital;
        } else {
            $addHospital = test_input($_POST['addHospitalAff']);
            $flag = true;
            if(!preg_match("/^[a-z-A-Z\s\.]*$/", $addHospital)) {
                $errAddHospital = "Only letters are allowed in this field";
                $flag = false;
                $errors[] = $errAddHospital;
            }
        }

        if(empty($_POST['addContactNumber'])){
            $errAddContact = "Contact Number is required";
            $flag = false;
            $errors[] = $errAddContact;
        } else {
            $addContact = test_input($_POST['addContactNumber']);
            $flag = true;
            if(!preg_match("/^[0-9]*$/", $addContact)) {
                $errAddContact = "Invalid contact number";
                $flag = false;
                $errors[] = $errAddContact;
            }
            if(strlen($addContact) > 11 || strlen($addContact) < 11){
                $errAddContact = "Contact number must be exact 11 digits";
                $flag = false;
                $errors[] = $errAddContact;
            }
        }

        if(empty($_POST['addLandlineNumber'])){
            $errAddLandline = "Landline number is required";
            $flag = false;
            $errors[] = $errAddLandline;
        } else {
            $addLandline = test_input($_POST['addLandlineNumber']);
            $flag = true;
            if(!preg_match("/^[0-9\(\)\-]*$/", $addLandline)) {
                $errAddLandline = "Invalid landline number";
                $flag = false;
                $errors[] = $errAddLandline;
            }
        }

        if(empty($_POST['addEmail'])) {
            $errAddEmail = "Email is required";
            $flag = false;
            $errors[] = $errAddEmail;
        } else  {
            $addEmail = test_input($_POST['addEmail']);
            $flag = true;
            if(!filter_var($addEmail, FILTER_VALIDATE_EMAIL)){
                $errAddEmail = "Invalid email";
                $flag = false;
                $errors[] = $errAddEmail;
            }

        }
        
        if($flag) {
            if(count($errors) > 0) {
                $message =  "<div class='alert alert-danger'>Failed to insert additional information</div>";
            } else {
                $conn->autocommit(false);

                $stmt = $conn->prepare("INSERT INTO tbl_extrainformation (doctors_id, hospital_aff, contact, landline, email) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("isiss", $userId, $addHospital, $addContact, $addLandline, $addEmail);
                $stmt->execute();
                // $sql = "INSERT INTO tbl_extrainformation (doctors_id, hospital_aff, contact, landline) VALUES ('$userId', '$addHospital', '$addContact', '$addLandline')";
                // $conn->query($sql) or die($conn->error);

                if(!$conn->commit()){
                    die($conn->error);
                } else {
                    $message = "<div class='alert alert-success'>Information successfully added</div>";
                    header("Location: view.php?id=$userId");
                    exit();
                }
            }
        } else {
            $message =  "<div class='alert alert-danger'>Failed to insert additional information</div>";
        }
    }
    //CHECK USER INPUT
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
