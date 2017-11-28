<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="kz_ino icon" href="assets/img/kz.ico">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/admin/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/admin/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/admin/bootstrap-responsive.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/admin/alert_panah.css">
    <link rel="kz_ino icon" href="<?=base_url();?>assets/img/stmi.ico">
    <script src="<?=base_url();?>assets/js/admin/jquery.js"></script>
    <script src="<?=base_url();?>assets/js/admin/bootstrap-alert.js"></script>

    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
      }
	  
	  .span4 { border: 1px solid #ddd;  -webkit-box-shadow: 0 0 8px #D0D0D0;  }
    </style>
</head>
<body>
<?php
$login = array(
    'name'  => 'login',
    'id'    => 'login',
    'value' => set_value('login'),
    'maxlength' => 80,
    'size'  => 30,
    'class'=> 'span4',
    'placeholder'=> 'Username',
);
if ($login_by_username AND $login_by_email) {
    $login_label = 'Login';
} else if ($login_by_username) {
    $login_label = 'Login';
} else {
    $login_label = 'Email';
}
$password = array(
    'name'  => 'password',
    'id'    => 'password',
    'size'  => 30,
    'class'=> 'span4',
    'placeholder'=> 'Password',
);
$remember = array(
    'name'  => 'remember',
    'id'    => 'remember',
    'value' => 1,
    'checked'   => set_value('remember'),
    'style' => 'margin:0;padding:0',
);
$captcha = array(
    'name'  => 'captcha',
    'id'    => 'captcha',
    'maxlength' => 8,
);
?>


<div class="container">
    <div class="row">
        <div class="span4 offset4 well">
            <legend>Login E-Learning Dosen<img src="<?=base_url();?>img/logo2.png" width="130" height="200" align="absmiddle" /> </legend>

            <?php echo form_open($this->uri->uri_string()); ?>

                
                
            
            <?php echo form_label($login_label, $login['id']); ?>


            

            <?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
            <?php echo form_input($login); ?>
            
            <?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
            <?php echo form_password($password); ?>

            <?php if ($show_captcha) {
            if ($use_recaptcha) { ?>

                <div class="control-group">
                    <label for="confirm_password" class="control-label">   
                        Enter the reCaptcha
                    </label>
                    <div class="controls">
                        <?php echo $recaptcha_html; ?>
                    </div>
                </div>

                    <!--
                <div id="recaptcha_image"></div>
                <a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
                <div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
                <div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
                <div class="recaptcha_only_if_image">Enter the words above</div>
                <div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
                <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
                <div style="color: red"><?php echo form_error('recaptcha_response_field'); ?></div>
                <?php echo $recaptcha_html; ?>
                    
                -->


            <?php } else { ?>
                <p>Enter the code exactly as it appears:</p>
                <?php echo $captcha_html; ?>
                <?php echo form_label('Confirmation Code', $captcha['id']); ?>
                <?php echo form_input($captcha); ?>
                <div style="color: red"><?php echo form_error($captcha['name']); ?></div>
            <?php }
            } ?>


            <button type="submit" name="submit" class="btn btn-info btn-block">Sign in</button>
            <?php echo form_close(); ?>  
			<a href="<?=base_url();?>"><i class="icon-home"> kembali ke home</i></a>
			
			<!--
			<hr>
            <div >
                 <div class="alert alert-error"><i>Informasi Penting!:<br>Dimohon untuk menggunakan <a href="https://www.google.com/intl/id/chrome/browser/"> Browser Google Chrome</a> saja untuk saat ini. Terima kasih.</i></div>
            </div>
			-->

        </div>
    </div>
</div>
<!-- /container -->

</body>
<footer align="center">
    <p><img src="<?=base_url();?>images/stmi.gif" width="20" height="20" align="absmiddle" /> Copyright © 2016 | Pusdata Politeknik STMI | Hak Cipta Dilindungi oleh Undang-undang | Best viewed in <a href="https://www.google.com/intl/id/chrome/browser/">Chrome v.31++</a> | Page rendered in {elapsed_time} seconds</p>
</footer>
</html>
