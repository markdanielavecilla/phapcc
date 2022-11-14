<?php
    include 'connection.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"/>
<div class="row">
    <h1>Hospital Information</h1>

    <hr/>

    <div class="col-4">
        <div class="form-floating mt-1 mb-3">
            <input 
                type="text" 
                class="form-control <?= $errHospitalaff ? 'is-invalid':'' ?>"
                placeholder="Hospital affiliation"
                name="hospitalAffiliation"
                value="<?= isset($_POST['hospitalAffiliation']) ? $_POST['hospitalAffiliation']:'' ?>"
            >
            <label for="Hospital Affiliation">Hospital affiliation <span class="required-field">*</span></label>
            <span class="invalid-feedback"><?= $errHospitalaff?></span>
        </div>
    </div>

    <div class="col-4">
        <div class="form-floating mt-1 mb-3">
            <input 
                type="text"
                class="form-control <?= $errContactno ? 'is-invalid':''?>"
                placeholder="Contact number"
                name="contactNumber"
                value="<?= isset($_POST['contactNumber']) ? $_POST['contactNumber'] : '' ?>"
            >
            <label for="contact" class="form-label">Contact number</label>
            <span class="invalid-feedback"><?= $errContactno?></span>
        </div>
    </div>

    <div class="col-4">
        <div class="form-floating mt-1 mb-3">
            <input 
                type="text" 
                class="form-control <?= $errLandlineno ? 'is-invalid':'' ?>"
                placeholder="Landline number"
                name="landlineNumber"
                value="<?= isset($_POST['landlineNumber']) ? $_POST['landlineNumber']: '' ?>"
            >
            <label for="Landline" class="form-label">Landline number</label>
            <span class="invalid-feedback"><?= $errLandlineno ?></span>
        </div>
    </div>

    <div class="col-4">
        <div class="form-floating mt-1 mb-3">  
            <input type="text" class="form-control <?php echo ($errCityprov) ? 'is-invalid':''  ?>" name="cityProvince" placeholder="City/Province" value="<?= isset($_POST['cityProvince']) ? $_POST['cityProvince'] : '' ?>">
            <label for="City/Province">City/Province <span class="required-field">*</span></label>
            <span class="invalid-feedback"><?php echo $errCityprov ?></span>
        </div>
    </div>

    <div class="col-4">
        <div class="form-floating mt-1 mb-3">
            <input type="text" class="form-control <?php echo ($errHomeAddress) ? 'is-invalid':''  ?>" name="homeAddress" placeholder="Home Address" value="<?= isset($_POST['homeAddress']) ? $_POST['homeAddress'] : '' ?>">
            <label for="BE">Home Address <span class="required-field">*</span></label>
            <span class="invalid-feedback"><?php echo $errHomeAddress ?></span>
        </div>
    </div>
                    
    <div class="col-4">
        <div class="form-floating mt-1 mb-3">
            <input type="text" class="form-control <?php echo ($errPrincipalofc) ? 'is-invalid':'' ?>" name="principalOffice" placeholder="Principal office" value="<?= isset($_POST['principalOffice']) ? $_POST['principalOffice'] :'' ?>">
            <label for="Principal Office">Principal office <span class="required-field">*</span></label>
            <span class="invalid-feedback"><?php echo $errPrincipalofc ?></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <div class="form-floating mt-1 mb-3">
            <input 
                type="text" 
                class="form-control <?= ($errIntAff) ? 'is-invalid':'' ?>"
                placeholder="International Society"
                name="international_society"
                value="<?= isset($_POST['international_society']) ? $_POST['international_society']:'' ?>"
            >
            <label for="International Affiliation">International Society</label>
            <span class="invalid-feedback"><?= $errIntAff ?></span>
        </div>
    </div>
</div>

<!-- CHAPTER -->

<div class="row">
    <div class="col">
        <div class="input-group mt-1 mb-3">
            <div class="input-group-text">
                <label class="form-label" for="Chapter">Chapter <span class="required-field">*</span></label>
            </div>

            <select 
                class="form-control my-select <?= ($errChapter) ? 'is-invalid':'' ?>" 
                id="selectedChapter" 
                name="selectedChapter[]"
                multiple
                data-selected-text-format="count > 2"
            >

                <?php
                    $sch = array();
                    foreach($_POST['selectedChapter'] as $selChap) {
                        $sch[] = $selChap;
                    }
                    $sql = "SELECT * FROM tbl_chapter";
                    $result = $conn->query($sql);
                    while($rows = $result->fetch_assoc()) :
                ?>
                <option value=<?php echo $rows['chapid']; ?> <?= in_array($rows['chapid'], $sch) ? 'selected':'' ?> > <?php echo ucwords($rows['chapter']); ?> </option>
                    <?php endwhile ?>
            </select>
            <span class="invalid-feedback"><?= $errChapter ?></span>
        </div>
    </div>

    <div class="col">
        <div class="input-group mt-1 mb-3">
            <div class="input-group-text">
                <input 
                    type="checkbox" 
                    name="other_chapters" 
                    id="other_chapters"
                    class="form-check-input"
                    <?= isset($_POST['other_chapters']) ? 'checked':'' ?>
                > &nbsp; Other..
            </div>

            <input 
                type="text" 
                disabled 
                placeholder="Other chapter" 
                class="form-control <?= ($errOtherChap)? 'is-invalid':'' ?>" 
                name="other_chapter" 
                id="other_chapter"
                value="<?= isset($_POST['other_chapter']) ? $_POST['other_chapter'] : '' ?>"
            >
            <span class="invalid-feedback"><?= $errOtherChap ?></span>
        </div>
    </div>
</div>

<!-- CATEGORY -->

<div class="row">
    <div class="col">
        <div class="input-group mt-1 mb-3">
            <div class="input-group-text">
                <label class="form-label" for="Category">Category <span class="required-field">*</span></label>
            </div>
            <select 
                class="form-control my-select <?= ($errCategory) ? 'is-invalid':'' ?>"
                multiple 
                id="selectedCategory" 
                name="selectedCategory[]"
                data-selected-text-format="count > 2"
            >
                <?php
                    $sc = array();
                    foreach($_POST['selectedCategory'] as $selCat) {
                        $sc[] = $selCat;
                    }
                    $sql = "SELECT * FROM tbl_drcategory";
                    $result = $conn->query($sql);
                    while($rows = $result->fetch_assoc()) :
                ?>
                <option value=<?php echo $rows['catid']; ?> <?= in_array($rows['catid'], $sc) ? 'selected':'' ?> > <?php echo ucwords($rows['category']); ?> </option>
                <?php endwhile ?>
            </select>
            <span class="invalid-feedback"><?= $errCategory ?></span>
        </div>
    </div>
    
    <div class="col">
        <div class="input-group mt-1 mb-3">
            <div class="input-group-text">
                <input 
                    type="checkbox" 
                    name="other_category" 
                    id="other_category" 
                    class="form-check-input"
                    <?= isset($_POST['other_category']) ? 'checked':'' ?>
                > &nbsp; Other..
            </div>

            <input 
                type="text" 
                name="other_categories" 
                id="other_categories" 
                class="form-control <?= ($errOthercat)? 'is-invalid':'' ?>" 
                placeholder="Other Category" 
                disabled
                value="<?= isset($_POST['other_categories']) ? $_POST['other_categories'] : '' ?>"
            >
            <span class="invalid-feedback"><?= $errOthercat ?></span>
        </div>
    </div>
</div>

<!-- SUBSPECIALTY -->

<div class="row">
    <div class="col">
        <div class="input-group mb-3">
            <div class="input-group-text">
                <label for="Subspecialty" class="form-label">Subspecialty <span class="required-field">*</span></label>            
            </div>
            <select 
                name="subSpecialty[]" 
                id="subSpecialty" 
                multiple 
                class="form-control my-select <?= ($errSubspecialty) ? 'is-invalid':'' ?>"
                data-selected-text-format="count > 2"
                >
                    <?php
                        $sl = array();
                        foreach($_POST['subSpecialty'] as $sub) {
                            $sl[] = $sub;
                        }
                        $sql = "SELECT * FROM tbl_subspecialty";
                        $result = $conn->query($sql);
                        while($rows = $result->fetch_assoc()) :                    
                    ?>
                    <option value="<?= $rows['sub_id'] ?>" <?= in_array($rows['sub_id'], $sl) ? 'selected':'' ?>><?= ucwords($rows['subspecialty'])?></option>
                    <?php endwhile ?>

            </select>
            <span class="invalid-feedback"><?= $errSubspecialty ?></span>
        </div>
    </div>

   <div class="col">
       <div class="input-group mb-3 ">
            <div class="input-group-text">
                <input 
                    class="form-check-input" 
                    value="other" 
                    type="checkbox" 
                    id="othersub" 
                    name="othersub"
                    <?= (isset($_POST['othersub'])) ? 'checked':'' ?>
                > &nbsp; Other..
            </div>

            <input 
                type="text" 
                class="form-control <?= ($errOthersub) ? 'is-invalid':'' ?>" 
                name="other_subspecialty" 
                id="other_subspecialty" 
                disabled 
                placeholder="Other subspecialty" 
                value="<?= isset($_POST['other_subspecialty']) ? $_POST['other_subspecialty']: '' ?>"
            >
            <span class="invalid-feedback"><?= $errOthersub ?></span>
        </div>
    </div>
</div>

<!-- PRACTICE -->

<div class="row">
    <div class="col">
        <div class="input-group mt-1 mb-3">
            <div class="input-group-text">
                <label class="form-label" for="Practice">Practice <span class="required-field">*</span></label>
            </div>
            <select 
                name="practice[]" 
                id="practice" 
                multiple 
                class="form-control my-select <?= ($errPractice) ? 'is-invalid':'' ?>"
                data-selected-text-format="count > 2"
            >
                <?php
                    $pl = array();
                    foreach($_POST['practice'] as $practice) {
                        $pl[] = $practice;
                    }
                    $sql = "SELECT * FROM tbl_practice";
                    $result = $conn->query($sql);
                    while($rows = $result->fetch_assoc()) :
                ?>
                    <option value="<?= $rows['practice_id']?>" <?= in_array($rows['practice_id'], $pl) ? 'selected': '' ?> ><?= ucwords($rows['practice'])?></option>
                <?php endwhile ?>
            </select>
            <span class="invalid-feedback"><?= $errPractice?></span>
        </div>
    </div>

    <div class="col">
        <div class="input-group mt-1 mb-3">
            <div class="input-group-text">
                <input 
                    type="checkbox" 
                    class="form-check-input"
                    value="other"
                    id="other_practice"
                    name="other_practice"
                    <?= isset($_POST['other_practice'])? 'checked':'' ?>
                > &nbsp; Other..
            </div>

            <input 
                type="text" 
                name="otherPractice" 
                id="otherPractice" 
                disabled 
                class="form-control <?= ($errOtherPractice) ? 'is-invalid':'' ?>" 
                placeholder="Other practice"
                value="<?= isset($_POST['otherPractice']) ? $_POST['otherPractice'] : '' ?>"
            >
            <span class="invalid-feedback"><?= $errOtherPractice ?></span>
        </div>
    </div>
</div>

<!-- SPECIAL TRAINING -->

<div class="row">
    <div class="col">
        <div class="input-group mt-1 mb-3">
            <div class="input-group-text">
                <label class="form-label" for="special-training">Special Training <span class="required-field">*</span></label>
            </div>
            <select 
                name="special_training[]" 
                id="special_training" 
                multiple 
                class="form-control my-select"
                data-selected-text-format="count > 2"
            >
                <?php
                    $st = array();
                    foreach($_POST['special_training'] as $special_training) {
                        $st[] = $special_training;
                    }
                    $sql = "SELECT * FROM tbl_special_training";
                    $result = $conn->query($sql) or die($conn->error);
                    while($rows = $result->fetch_assoc()) :
                ?>
                    <option value="<?= $rows['st_id']?>" <?= in_array($rows['special_training'], $pl) ? 'selected': '' ?> ><?= ucwords($rows['special_training'])?></option>
                <?php endwhile ?>
            </select>
        </div>
    </div>

    <div class="col">
        <div class="input-group mt-1 mb-3">
            <div class="input-group-text">
                <input 
                    type="checkbox" 
                    class="form-check-input"
                    value="other"
                    id="other_special_training"
                    name="other_special_training"
                    <?= isset($_POST['other_special_training'])? 'checked':'' ?>
                > &nbsp; Other..
            </div>

            <input 
                type="text" 
                name="otherSpecialTraining" 
                id="otherSpecialTraining" 
                disabled 
                class="form-control <?= ($errOther_st) ? 'is-invalid':'' ?>" 
                placeholder="Other special training"
                value="<?= isset($_POST['otherSpecialTraining']) ? $_POST['otherSpecialTraining'] : '' ?>"
            >
            <span class="invalid-feedback"><?= $errOther_st ?></span>
        </div>    
    </div>
</div>

<!-- COOUNCIL -->

<div class="row">
    <div class="col">
        <div class="input-group mt-1 mb-3">
            <div class="input-group-text">
                <label class="form-label" for="special-training">Council <span class="required-field">*</span></label>
            </div>
            <select 
                name="council[]" 
                id="council" 
                multiple 
                class="form-control my-select"
                data-selected-text-format="count > 2"
            >
                <?php
                    $cncl = array();
                    foreach($_POST['council'] as $council) {
                        $cncl = $council;
                    }
                    $stmt = $conn->prepare("SELECT * FROM tbl_council");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($rows = $result->fetch_assoc()) :
                ?>
                    <option value="<?= $rows['council_id']?>" <?= in_array($rows['council'], $cncl) ? 'selected': '' ?> ><?= ucwords($rows['council'])?></option>
                <?php endwhile ?>
            </select>
        </div>
    </div>

    <div class="col">
        <div class="input-group mt-1 mb-3">
            <div class="input-group-text">
                <input 
                    type="checkbox" 
                    class="form-check-input"
                    value="other"
                    id="other_council"
                    name="other_council"
                    <?= isset($_POST['other_council'])? 'checked':'' ?>
                > &nbsp; Other..
            </div>

            <input 
                type="text" 
                name="otherCouncil" 
                id="otherCouncil" 
                disabled 
                class="form-control <?= ($errOtherCouncil) ? 'is-invalid':'' ?>" 
                placeholder="Other council"
                value="<?= isset($_POST['otherCouncil']) ? $_POST['otherCouncil'] : '' ?>"
            >
            <span class="invalid-feedback"><?= $errOtherCouncil ?></span>
        </div>    
    </div>
</div>

<!-- COMMITTEE -->

<div class="row">
    <div class="col">
        <div class="input-group mt-1 mb-3">
            <div class="input-group-text">
                <label class="form-label" for="special-training">Committee <span class="required-field">*</span></label>
            </div>
            <select 
                name="committee[]" 
                id="committee" 
                multiple 
                class="form-control my-select"
                data-selected-text-format="count > 2"
            >
                <?php
                    $cmt = array();
                    foreach($_POST['committee'] as $committee) {
                        $cmt[] = $committee;
                    }
                    $stmt = $conn->prepare("SELECT * FROM tbl_committee");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($rows = $result->fetch_assoc()) :
                ?>
                    <option value="<?= $rows['cmt_id']?>" <?= in_array($rows['committee'], $cmt) ? 'selected': '' ?> ><?= ucwords($rows['committee'])?></option>
                <?php endwhile ?>
            </select>
        </div>
    </div>

    <div class="col">
        <div class="input-group mt-1 mb-3">
            <div class="input-group-text">
                <input 
                    type="checkbox" 
                    class="form-check-input"
                    value="other"
                    id="other_committee"
                    name="other_committee"
                    <?= isset($_POST['other_committee'])? 'checked':'' ?>
                > &nbsp; Other..
            </div>

            <input 
                type="text" 
                name="otherCommittee" 
                id="otherCommittee" 
                disabled 
                class="form-control <?= ($errOtherComm) ? 'is-invalid':'' ?>" 
                placeholder="Other committee"
                value="<?= isset($_POST['otherCommittee']) ? $_POST['otherCommittee'] : '' ?>"
            >
            <span class="invalid-feedback"><?= $errOtherComm ?></span>
        </div>    
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
<script>

    // SUBSPECIALTY
    const othersub = document.querySelector("#othersub") //checkbox
    const other_subspecialty = document.querySelector('#other_subspecialty') //textfield 

    // CHAPTER
    const otherChapter = document.querySelector('#other_chapters') //checkbox
    const other_chapter = document.querySelector('#other_chapter') //textfield

    // CATEGORIES
    const otherCategory = document.querySelector('#other_category') //checkbox
    const other_category = document.querySelector('#other_categories') //textfield

    // PRACTICE
    const otherPractice = document.querySelector('#other_practice') //checkbox
    const other_practice = document.querySelector('#otherPractice') //textfield

    // SPECIAL TRAINING
    const other_special_training = document.querySelector("#other_special_training") // checkbox
    const otherSt = document.querySelector('#otherSpecialTraining') // textfield

    //COUNCIL
    const other_council = document.querySelector('#other_council') //checkbox
    const otherCouncil = document.querySelector('#otherCouncil') // textfield

    //COMMITTEE
    const other_committee = document.querySelector('#other_committee') //checkbox
    const otherCommittee = document.querySelector('#otherCommittee') //textfield

    othersub.addEventListener('change', () => {
        return (othersub.checked) ? other_subspecialty.removeAttribute('disabled') : other_subspecialty.disabled = true
    })

    otherChapter.addEventListener('change', () => {
        return (otherChapter.checked) ? other_chapter.removeAttribute('disabled') : other_chapter.disabled = true
    })

    otherCategory.addEventListener('change', () => {
        return (otherCategory.checked) ? other_category.removeAttribute('disabled') : other_category.disabled = true
    })

    otherPractice.addEventListener('change', () => {
        return (otherPractice.checked) ? other_practice.removeAttribute('disabled') : other_practice.disabled = true
    })

    other_special_training.addEventListener('change', () => {
        return (other_special_training.checked) ? otherSt.removeAttribute('disabled') : otherSt.disabled = true
    })

    other_council.addEventListener('change', () => {
        return (other_council.checked) ? otherCouncil.removeAttribute('disabled') : otherCouncil.disabled = true
    })

    other_committee.addEventListener('change', () => {
        return (other_committee.checked) ? otherCommittee.removeAttribute('disabled') : otherCommittee.disabled = true
    })

    window.onload = () => {
        if(other_subspecialty.value.length > 0) {
            other_subspecialty.removeAttribute('disabled')
        }

        if(other_chapter.value.length > 0) {
            other_chapter.removeAttribute('disabled')
        }

        if(other_category.value.length > 0) {
            other_category.removeAttribute('disabled')
        }

        if(other_practice.value.length > 0) {
            other_practice.removeAttribute('disabled')
        }
        if(otherSt.value.length > 0) {
            otherSt.removeAttribute('disabled')
        }
        if(otherCouncil.value.length > 0) {
            otherCouncil.removeAttribute('disabled')
        }
        if(otherCommittee.value.length > 0) {
            otherCommittee.removeAttribute('disabled')
        }
    }
</script>