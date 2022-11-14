<div class="row mb-3">
    <h1>Personal Information</h1>
    <hr/>
    <div class="col d-flex justify-content-center">
        <img src="../images/phalogohd.png" id="imgPreview" name="imgPreview">
    </div>
    <input type="file" name="file" class="form-control" id="imageUpload" style="margin: 10px">
</div>
<div class="row">
    <div class="col">
        <div class="form-floating mt-1 mb-3">  
            <input type="text" class="form-control <?=  ($errFname) ? 'is-invalid' : '' ?>" autofocus id="fname" name="fname" placeholder="First name" value="<?= isset($_POST['fname']) ? $_POST['fname'] : '' ?>">
            <label for="First name" class="form-label">First Name <span class="required-field">*</span></label>
            <span class="invalid-feedback" id="errorfname"><?php echo $errFname?></span>
        </div>
    </div>

    <div class="col">
        <div class="form-floating mt-1 mb-3">  
            <input type="text" class="form-control <?= ($errMname) ? 'is-invalid' : '' ?>" id="midname" name="midName" placeholder="Middle Name" value="<?= isset($_POST['midName']) ? $_POST['midName'] : '' ?>">
            <label for="Middle Name">Middle Name <span class="required-field">*</span></label>
            <span class="invalid-feedback" id="errmname"><?php echo $errMname?></span>
        </div>
    </div>

    <div class="col">
        <div class="form-floating mt-1 mb-3">  
            <input type="text" class="form-control <?= ($errLname) ? 'is-invalid':'' ?>" id="lname" name="lname" placeholder="Last name" value="<?= isset($_POST['lname']) ? $_POST['lname'] : '' ?>">
            <label for="Last name">Last Name <span class="required-field">*</span></label>
            <span id="errlname" class="invalid-feedback"><?php echo $errLname?></span>
        </div>
    </div>

    <div class="col">
        <div class="form-floating mt-1 mb-3">  
            <input type="text" class="form-control <?= ($errSuffix) ? 'is-invalid':''?>" name="suffix" placeholder="Suffix" value="<?= isset($_POST['suffix']) ? $_POST['suffix'] : '' ?>">
            <label for="Suffix">Suffix</label>
            <span class="invalid-feedback"><?= $errSuffix?></span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col">
        <div class="form-floating mt-1 mb-3">  
            <select class="form-select  <?php echo ($errGender) ? 'is-invalid':'' ?>" id="floatingSelect" name="selectedGender" aria-label="Floating label select example" >
                <!-- <option selected></option> -->
                <option value="Male" <?= (isset($_POST['selectedGender']) && $_POST['selectedGender'] == 'Male' ) ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= (isset($_POST['selectedGender']) && $_POST['selectedGender'] == 'Female' ) ? 'selected' : '' ?>>Female</option>
            </select>
            <label for="floatingSelect">Gender <span class="required-field">*</span></label>
            <span class="invalid-feedback"><?php echo $errGender?></span>
        </div>
    </div>

    <div class="col">
        <div class="form-floating mt-1 mb-3">
            <input 
                type="number" 
                class="form-control <?php echo ($errMobilenum) ? 'is-invalid':'' ?>" 
                id="mobileNumber" 
                name="mobileNumber" 
                placeholder="Mobile Number" 
                value="<?= isset($_POST['mobileNumber']) ? $_POST['mobileNumber'] : '' ?>"
            >
            <label for="Mobile Number">Mobile Number <span class="required-field">*</span></label>
            <span class="invalid-feedback"><?php echo $errMobilenum?></span>
        </div>
    </div>

    <div class="col">
        <div class="form-floating mt-1 mb-3">
            <input type="number" class="form-control <?= ($errSecondMobile)? 'is-invalid':''?>" name="second_mobileNumber" placeholder="Mobile Number 2" value="<?= isset($_POST['second_mobileNumber']) ? $_POST['second_mobileNumber']: '' ?>">
            <label for="Mobile Number 2" class="form-label">Mobile Number 2</label>
            <span class="invalid-feedback"><?= $errSecondMobile?></span>
        </div>
    </div>

    <div class="col">
        <div class="form-floating mt-1 mb-3">
            <input type="text" class="form-control <?php echo ($errEmail) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
            <label for="Email">Email <span class="required-field">*</span></label>
            <span class="invalid-feedback"><?php echo $errEmail?></span>
        </div>
    </div>
</div>
                
<div class="row">
    <div class="col">
        <div class="form-floating mt-1 mb-3">
            <input type="number" class="form-control <?php echo ($errPrcno) ? 'is-invalid':''  ?>" id="prcno" name="prcNumber" placeholder="PRC" value="<?= isset($_POST['prcNumber']) ? $_POST['prcNumber'] : '' ?>">
            <label for="PRC">PRC No. <span class="required-field">*</span></label>
            <span class="invalid-feedback"><?php echo $errPrcno ?></span>
        </div>
    </div>

    <div class="col">
        <div class="form-floating mt-1 mb-3">
            <input type="text" class="form-control <?php echo ($errPmano) ? 'is-invalid':''  ?>" id="pmano" name="pmaNumber" placeholder="PMA" value="<?= isset($_POST['pmaNumber']) ? $_POST['pmaNumber'] : '' ?>">
            <label for="PMA">PMA No.</label>
            <span class="invalid-feedback"><?php echo $errPmano ?></span>
        </div>
    </div>

    <div class="col">
        <div class="form-floating mt-1 mb-3">  
            <select class="form-select <?php echo ($errDeceased) ? 'is-invalid': '' ?>" id="floatingSelect" name="isDeceased" aria-label="Floating label select example">
                <!-- <option selected></option> -->
                <option value="No" <?= (isset($_POST['isDeceased']) && $_POST['isDeceased'] == 'No' ) ? 'selected': '' ?>>No</option>
                <option value="Yes" <?= ( isset($_POST['isDeceased']) && $_POST['isDeceased'] == 'Yes' ) ? 'selected':'' ?>>Yes</option>
            </select>
            <label for="floatingSelect">Deceased</label>
            <span class="invalid-feedback"><?php echo $errDeceased?></span>
        </div>
    </div>
</div>

<div class="row">
    <h4>Birthdate</h4>
    <div class="col">
        <div class="form-floating mt-1 mb-3">  
            <select class="form-select <?php echo ($errBirthmonth) ? 'is-invalid':'' ?>" id="month" name="selectedMonth" aria-label="Floating label select example">
                <option value="0">Month</option>
                <?php
                    foreach($months as $month => $val){
                        $selected = '';
                        if($_POST['selectedMonth'] == $month+1) $selected = 'selected';
                ?>
                <option value=<?php echo $month+1; ?> <?= $selected ?>> <?php echo $val; ?> </option>
                    <?php } ?>
            </select>
            <label for="floatingSelect">Month</label>
            <span class="invalid-feedback"><?php echo $errBirthmonth?></span>
        </div>
    </div>

    <div class="col">
        <div class="form-floating mt-1 mb-3">
            <select class="form-select <?php echo ($errBirthday) ? 'is-invalid':''  ?>" id="day" name="selectedDay" aria-label="Floating label select example">
                <option value="0">Day</option>
                <?php 
                    for($i = 1; $i <= 31; $i++){      
                        $selected = '';
                        if(isset($_POST['selectedDay']) && $_POST['selectedDay'] == $i) $selected = 'selected';      
                ?>
                <option value=<?php echo $i; ?> <?= $selected ?> > <?php echo $i; } ?>  </option>
            </select>
            <label for="floatingSelect">Day</label>
            <span class="invalid-feedback"><?php echo $errBirthday ?></span>
        </div>
    </div>

    <div class="col">
        <div class="form-floating mt-1 mb-3">
            <select name="year" id="year" class="form-control">
                <option>Year</option>
                <?php
                    for($i = date("Y"); $i > 1900; $i--){
                        $selected = '';
                        if(isset($_POST['year']) && $_POST['year'] == $i) $selected = 'selected';
                ?>
                <option value="<?php echo $i?>" <?= $selected ?> ><?php echo $i?></option>
                <?php } ?>

            </select>
            <label for="year">Year</label>
        </div>
    </div>

    <div class="col">
        <div class="form-floating mt-1 mb-3">  
            <input type="number" readonly class="form-control <?php echo ($errAge) ? 'is-invalid':'' ?>" name="age" placeholder="Age" id="age"  value="<?= isset($_POST['age']) ? $_POST['age'] : '' ?>">
            <label for="Age">Age</label>
            <span id="errage" class="invalid-feedback"><?php echo $errAge?></span>
        </div>
    </div>
</div>

<hr/>

<div class="row">
    <h4>School</h4>
    <div class="col">
        <div class="form-floating mt-1 mb-3">  
            <input type="text" class="form-control <?php echo ($errMedschool) ? 'is-invalid':'' ?>" id="medSchool" name="medicalSchool" placeholder="Medical School" value="<?= isset($_POST['medicalSchool']) ? $_POST['medicalSchool'] : '' ?>">
            <label for="Medical School">Medical School <span class="required-field">*</span></label>
            <span class="invalid-feedback"><?php echo $errMedschool ?></span>
        </div>
    </div>

    <div class="col">
        <div class="form-floating mt-1 mb-3">  
            <input type="number" class="form-control <?php echo ($errYeargrad) ? 'is-invalid':'' ?>" id="yearGrad" name="yearGraduated" placeholder="Year"  value="<?= isset($_POST['yearGraduated']) ? $_POST['yearGraduated'] : '' ?>">
            <label for="Year Graduated">Year Graduated <span class="required-field">*</span></label>
            <span class="invalid-feedback"><?php echo $errYeargrad ?></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-floating mt-1 mb-3">
            <input type="text" id="schoolTrained" placeholder="School Trained" name="schoolTrained" class="form-control <?php echo ($errSchoolTrained) ? 'is-invalid':'' ?>" value="<?= isset($_POST['schoolTrained']) ? $_POST['schoolTrained'] : '' ?>">
            <label for="School Trained" class="form-label">Training Institution <span class="required-field">*</span></label>
            <span class="invalid-feedback"><?php echo $errSchoolTrained?></span>
        </div>
    </div>

    <div class="col">
        <div class="form-floating mt-1 mb-3">
            <input type="number" name="trainedYearGrad" placeholder="Trained year Graduated" id="trainedYearGrad" class="form-control <?php echo ($errTrainedYearGrad) ? 'is-invalid':'' ?>"  value="<?= isset($_POST['trainedYearGrad']) ? $_POST['trainedYearGrad'] : '' ?>">
            <label for="Year Trained Grad" class="form-label">Year Graduated <span class="required-field">*</span></label>
            <span class="invalid-feedback"><?php echo $errTrainedYearGrad?></span>
        </div>
    </div>
</div>

<script>
    const imgPreview = document.querySelector('#imgPreview')
    const imgUpload = document.querySelector('#imageUpload')
    imgPreview.addEventListener('click', () => {
        imgUpload.click()
    })

    imgUpload.addEventListener('change', (e) => {
        // console.log(e.target.files[0])
        if(e.target.files[0]) {
            const reader = new FileReader()
            reader.onload = (e) => {
                imgPreview.setAttribute('src', e.target.result)
            }
            reader.readAsDataURL(e.target.files[0])
        }
        imgUpload.setAttribute('src', e.target.result)
    })
</script>