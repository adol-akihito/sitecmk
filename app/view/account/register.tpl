<?php echo $header ?>
<div class="content">
    <div class="registerRow">
        <div class="registerMenuWrap" id="registerMenuWrap">
            <?php if ($err) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert"><?php echo $err ?></div>
            <?php } ?>
            <form action="<?php echo $action; ?>" method="post" class="registerMenu" id="register-form">
                <h4>Register</h4>
                <hr class="line">
                <p>Entry your email
                    <label class="user_login">
                        <input type="email" name="email" class="registerInput" id="register-email-input">
                    </label>
                </p>
                <p>Entry your username
                    <label class="user_login">
                        <input type="text" name="username" class="registerInput" id="register-username-input">
                    </label>
                </p>
                <p>Entry your password
                    <label class="user_login">
                        <input type="password" name="password" class="registerInput" id="register-password-input">
                    </label>
                </p>
                <p>Confirm your password
                    <label class="user_login">
                        <input type="password" name="confirm" class="registerInput" id="register-confirm-input">
                    </label>
                </p>
                <hr class="line">
                <input type="button" class="submit" value="Register" id="register-button">
            </form>
        </div>
    </div>
</div>

<?php echo $footer ?>