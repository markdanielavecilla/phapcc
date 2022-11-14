<?php
    require_once "user-action/login-action.php";
    if(isset($_SESSION['client_message'])) :
        echo $_SESSION['client_message'];
        unset($_SESSION['client_message']);
    endif;
?>
<form autocomplete="off" method="POST">
    <div class="txt_field">
        <input 
            type="text" 
            name="email"
            placeholder="Email"
            value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>"
            autofocus
        />
        <br/>
        <span class="blockquote-footer"><strong>Enter the email you used in creating the account</strong></span>
    </div>

    <div class="txt_field">
        <input 
            type="password"
            name="password"
            placeholder="Password"
        />
        <br/>
        <span class="blockquote-footer"><strong>Enter the password you used in creating the account</strong></span>
    </div>
    <div class="pass">
        <a href="./forgotpassword.php">Forgot password?</a>
    </div>            
    <input 
        type="submit" 
        value="Login" 
        name="login"
        class="body-btn"
    />
    
    <div class="signup_link">
        <a href="register.php">Sign up</a>
    </div>
</form>