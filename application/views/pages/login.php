<?php echo form_open('users/login'); ?>
    <div class="login-form">
        <h3>Login</h3>
        <input type="text" name="username" class="margin" id="name" placeholder="username" spellcheck="false"/>
        <div class="password-container margin"><input type="password" name="password" id="password" placeholder="password" spellcheck="false"/><span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span></div>
        <input type="submit" name="submit" class="margin" value="Login" />
    </div>
<?php echo form_close(); ?>