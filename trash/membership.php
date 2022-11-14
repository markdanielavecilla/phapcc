<?php
    // include 'action.php';
?>

<div class="row justify-content-md-center">
    <h2>Year as</h2>
    <div class="row">
        <div class="col">
            <div class="form-floating mt-1 mb-3">
                <input type="number"  class="form-control <?= ($errFellow) ? 'is-invalid':'' ?>" name="fellowYear" placeholder="Membership year" value="<?= isset($_POST['fellowYear']) ? $_POST['fellowYear'] : '' ?>">
                <label for="fellow">Fellow</label>
                <span class="invalid-feedback"><?= $errFellow ?></span>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mt-1 mb-3">
                <input type="number"  class="form-control <?= ($errLifefellow) ? 'is-invalid':'' ?>" name="lifeFellowYear" placeholder="Diplomate year" value="<?= isset($_POST['lifeFellowYear']) ? $_POST['lifeFellowYear'] : '' ?>">
                <label for="life fellow year">Life Fellow</label>
                <span class="invalid-feedback"><?= $errLifefellow ?></span>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mt-1 mb-3">
                <input type="number" class="form-control <?= ($errDiplomate) ? 'is-invalid':''  ?>" name="diplomateYear" placeholder="Fellow year" value="<?= isset($_POST['diplomateYear']) ? $_POST['diplomateYear'] : '' ?>">
                <label for="diplomate year">Diplomate</label>
                <span class="invalid-feedback"><?= $errDiplomate  ?></span>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col">
            <div class="form-floating mt-1 mb-3">
                <input type="number"  class="form-control <?= ($errLifemember) ? 'is-invalid':'' ?>" name="lifeMemberYear" placeholder="Life Fellow year" value="<?= isset($_POST['lifeMemberYear']) ? $_POST['lifeMemberYear'] : '' ?>">
                <label for="life member year">Life Member</label>
                <span class="invalid-feedback"><?= $errLifemember  ?></span>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mt-1 mb-3">
                <input type="number"  class="form-control <?= ($errAssociateFellow) ? 'is-invalid':''  ?>" name="associateFellowYear" placeholder="Life Member year" value="<?= isset($_POST['associateFellowYear']) ? $_POST['associateFellowYear'] : '' ?>">
                    <label for="associate fellow year">Associate Fellow</label>
                    <span class="invalid-feedback"><?= $errAssociateFellow  ?></span>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mt-1 mb-3">
                <input type="number" name="associateYear" placeholder="Associate" class="form-control <?= ($errAssociate) ? 'is-invalid': '' ?>" value="<?= isset($_POST['associateYear']) ? $_POST['associateYear'] : '' ?>">
                <label for="associate" class="form-label">Associate</label>
                <span class="invalid-feedback"><?= $errAssociate ?></span>
            </div>
        </div>
    </div>
    
</div>
