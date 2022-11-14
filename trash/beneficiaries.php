<div class="row justify-content-md-center">
    <div class="row">
        <div class="col">
            <h2>Beneficiaries</h2>
        </div>
        <div class="col text-end">
            <a href="javascipt:void(0)" class="add-form body-btn">Add more</a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div class="form-floating mt-1 mb-3">
                <input 
                    type="text"
                    class="form-control"
                    name="bFname[]"
                    placeholder="First name"
                />
                <label for="bFname">First name</label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mt-1 mb-3">
                <input 
                    type="text" 
                    class="form-control"
                    name="bMname[]"
                    placeholder="Middle name"
                />
                <label for="bMname">Middle name</label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mt-1 mb-3">
                <input 
                    type="text"
                    class="form-control"
                    name="bLname[]"
                    placeholder="Last name" 
                />
                <label for="bLname">Last name</label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mt-1 mb-3">
                <input 
                    type="text"
                    class="form-control"
                    name="bSuffix[]"
                    placeholder="Suffix" 
                />
                <label for="bSuffix">Suffix</label>
            </div>
        </div>

        <!-- <div class="col"></div> -->
    </div>

    <div id="new-form"></div>
</div>

<script>
    $(document).ready(() => {

        const NEW_FORM = `
            <div class="main-from row">
                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input 
                            type="text"
                            class="form-control"
                            name="bFname[]"
                            placeholder="First name"
                        />
                        <label for="bFname">First name</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input 
                            type="text" 
                            class="form-control"
                            name="bMname[]"
                            placeholder="Middle name"
                        />
                        <label for="bMname">Middle name</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input 
                            type="text"
                            class="form-control"
                            name="bLname[]"
                            placeholder="Last name" 
                        />
                        <label for="bLname">Last name</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mt-1 mb-3">
                        <input 
                            type="text"
                            class="form-control"
                            name="bsuffix[]"
                            placeholder="Suffix" 
                        />
                        <label for="bSuffix">Suffix</label>
                    </div>
                </div>

                <div class="col">
                    <button 
                        type="button" 
                        class="remove-btn body-btn"
                        onclick="return $(this).closest('.main-from').remove()"
                    >
                        Remove
                    </button>
                </div>
            </div>
        `

        

        $('.add-form').click(() => {
            $('#new-form').append(NEW_FORM)
        })
    })
</script>