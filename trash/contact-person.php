<div class="row">
    <h2>Contact person in case of emergency</h2>

    <hr/>

    <div class="col">
        <div class="form-floating mt-1 mb-3">
            <input 
                type="text"
                class="form-control <?= $errContact_fname ? 'is-invalid':'' ?>"
                placeholder="First name"
                name="contact_fname" 
            />
            <label for="contact_fname">First name</label>
            <span class="invalid-feedback"><?= $errContact_fname ?></span>
        </div>
    </div>

    <div class="col">
        <div class="form-floating mt-1 mb-3">
            <input 
                type="text"
                class="form-control <?= $errContact_mname ? 'is-invalid':'' ?>"
                placeholder="Middle name"
                name="contact_mname"
                value="<?= isset($_POST['contact_mname']) ? $_POST['contact_mname']:'' ?>"
            />
            <label for="contact_mname">Middle name</label>
            <span class="invalid-feedback"><?= $errContact_mname ?></span>
        </div>
    </div>

    <div class="col">
        <div class="form-floating mt-1 mb-3">
            <input 
                type="text"
                class="form-control <?= $errContact_lname ? 'is-invalid':'' ?>"
                placeholder="Last name"
                name="contact_lname" 
            />
            <label for="contact_lname">Last name</label>
            <span class="invalid-feedback"><?= $errContact_lname ?></span>
        </div>
    </div>

    <div class="col">
        <div class="form-floating mt-1 mb-3">
            <input 
                type="number"
                class="form-control"
                placeholder="Mobile number"
                name="contact_mobilenumber" 
            />
            <label for="contact_mobilenumber">Mobile number</label>
        </div>
    </div>

</div>