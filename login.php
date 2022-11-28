<?php
    require_once "user-action/login-action.php";
?>

<div class="card p-3">
    <div class="card-body">
        <form method="post">
            <?php
                if(isset($_SESSION['client_message'])) :
                    echo $_SESSION['client_message'];
                    unset($_SESSION['client_message']);
                endif;
            ?>
            <div class="form-group my-3">
                <input 
                    type="text" 
                    name="email"
                    class="form-control"
                    placeholder="Email"
                    autofocus
                />
                <span class="blockquote-footer">Enter the email you used in creating an account.</span>
            </div>

            <div class="form-group my-3">
                <input 
                    type="password" 
                    name="password"
                    id="password"
                    class="form-control"
                    placeholder="Password" 
                />
                <input 
                    type="checkbox"
                    class="mt-2"
                    id="show-password" 
                /> Show password
                <br/>
                <span class="blockquote-footer">Enter the password you used in creating an account.</span>
            </div>
            <div class="text-center mt-2">
                <input 
                    type="submit" 
                    value="Login"
                    name="login"
                    class="body-btn my-3" 
                />
                <div>
                    <span>
                        <a href="./register.php">Sign up</a> <br/>
                        <a href="./forgotpassword.php">Forgot password?</a>
                    </span>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const showPassword = document.getElementById('show-password')
    const passwordInput = document.getElementById('password');
    showPassword.addEventListener('change', () => {
        if(showPassword.checked) {
            passwordInput.setAttribute('type', 'text');
        } else {
            passwordInput.setAttribute('type', 'password');
        }
    })
</script>