
<div class="container">
    <h2 class="mt-4">
        Affiliation
        <span>
            <a 
                href="./view-user.php?id=<?= $user_id ?>#affiliation" 
                class="btn btn-outline-danger float-end"
                >
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        </span>
    </h2>
    <hr/>
    <?php
        if(isset($_SESSION['message'])) :
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        endif;
    ?>
    <div class="row my-3">
        <div class="col-md-4">
            <div class="form-floating">
                <input 
                    type="text"
                    class="form-control"
                    name="hospital_affiliation"
                    placeholder="Hospital affiliation"
                    value="<?= isset($_POST['hospital_affiliation']) ? $_POST['hospital_affiliation'] : $fetchHospital['hospital_affiliation'] ?>"
                />
                <label for="hospital_affiliation">Hospital Affiliation</label>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-floating">
                <input 
                    type="number"
                    class="form-control"
                    name="contact_number"
                    placeholder="Contact number"
                    value="<?= isset($_POST['contact_number']) ? $_POST['contact_number'] : $fetchHospital['contactno'] ?>"
                />
                <label for="contact_number">Contact number</label>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-floating">
                <input 
                    type="text"
                    class="form-control"
                    name="landline_number"
                    placeholder="Landline number"
                    value="<?= isset($_POST['landline_number']) ? $_POST['landline_number'] : $fetchHospital['landlineno'] ?>"
                />
                <label for="landline_number">Landline number</label>
            </div>
        </div>

    </div>

    <div class="row my-3">
        <div class="col-md-4">
            <div class="form-floating">
                <input 
                    type="text"
                    class="form-control"
                    name="city_province"
                    placeholder="City/Province"
                    value="<?= isset($_POST['city_province']) ? $_POST['city_province'] : $fetchHospital['cityprovince'] ?>"
                />
                <label for="city_province">City/Province</label>
                <span class="small"><strong>Note:</strong> Main City or Province of practice</span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-floating">
                <input 
                    type="text"
                    class="form-control"
                    name="home_address"
                    placeholder="Home address"
                    value="<?= isset($_POST['home_address']) ? $_POST['home_address'] : $fetchHospital['home_address'] ?>"
                />
                <label for="home_address">Home address</label>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-floating">
                <input 
                    type="text"
                    class="form-control"
                    name="principal_office"
                    placeholder="Address of Principal Clinic"
                    value="<?= isset($_POST['principal_office']) ? $_POST['principal_office'] : $fetchHospital['principal_office'] ?>"
                />
                <label for="principal_office">Address of Principal clinic</label>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <div class="col-md-4">
            <div class="form-floating">
                <input 
                    type="text"
                    class="form-control"
                    name="international_affiliation"
                    placeholder="International affiliation"
                    value="<?= isset($_POST['international_affiliation']) ? $_POST['international_affiliation'] : $fetchHospital['international_affiliation'] ?>"
                />
                <label for="international_affiliation">International Affiliation</label>
            </div>
        </div>
    </div>
</div>