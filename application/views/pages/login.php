<?php
    if($this->session->userdata('login_failed') == "Invalid username"){
        $invalidUsername = " invalid-username";
        $invalidPassword = "";
    } elseif($this->session->userdata('login_failed') == "Invalid password"){
        $invalidUsername = "";
        $invalidPassword = " invalid-password";
    } else{
        $invalidUsername = "";
        $invalidPassword = "";
    }
?>

<?php echo form_open('admin/login'); ?>
    <div class="login-form">
        <h3>Welcome</h3>
        <div class="input-container margin"><input type="text" name="username" class="<?=$invalidUsername;?>" id="name" placeholder="username" spellcheck="false"/><span class="tooltip-username">Invalid username.</span></div>
        <div class="input-container margin"><input type="password" name="password" class="<?=$invalidPassword;?>" id="password" placeholder="password" spellcheck="false"/><span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span><span class="tooltip-password">Invalid password.</span></div>
        <input type="submit" name="submit" class="margin" value="Login" />
    </div>
<?php echo form_close(); ?>