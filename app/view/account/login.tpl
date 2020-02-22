<?php echo $header ?>
<h1>Login</h1>
<?php
if($error) {
    echo $error;
}
?>

<div class="content">

    <div class="row" id="row">
        <div class="loginPanelWrap" id="login-panel-wrap">

            <div class="loginPanel">
                <form action="<?php echo $action ?>" method="post" id="login-form">
                    <div class="textWrap">
                        <h4>Login</h4>
                    </div>
                    <p>
                        <label class="user_login">
                            Email
                            <br>
                            <input type="email" class="input" placeholder="Email" id="login-email-input" name="email">
                        </label>
                    </p>
                    <hr class="line">
                    <p>
                        <label class="user_pass">
                            Password
                            <br>
                            <input type="password" class="input" placeholder="Password" id="login-password-input"
                                   name="password">
                        </label>
                    </p>
                    <div>
                        <button type="button" class="submit button" id="login-button">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $footer ?>