<?php
if ($use_username) {
    $username = array(
        'name'  => 'username',
        'id'    => 'username',
        'value' => set_value('username'),
        'maxlength' => $this->config->item('username_max_length', 'tank_auth'),
        'size'  => 30,
        'class'=> 'span6',
    );
}

$nama_asli = array(
    'name'  => 'nama_asli',
    'id'    => 'nama_asli',
    'value' => set_value('nama_asli'),
    'maxlength' => 80,
    'size'  => 30,
    'class'=> 'span6',
);

$email = array(
    'name'  => 'emailz',
    'id'    => 'emailz',
    'value' => set_value('email'),
    'maxlength' => 80,
    'size'  => 30,
    'class'=> 'span6',
);
$password = array(
    'name'  => 'password',
    'id'    => 'password',
    'value' => set_value('password'),
    'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    'size'  => 30,
    'class'=> 'span6',
);
$confirm_password = array(
    'name'  => 'confirm_password',
    'id'    => 'confirm_password',
    'value' => set_value('confirm_password'),
    'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    'size'  => 30,
    'class'=> 'span6',
);

$cbo = array(
    '1'  => 'Super Administrator',
    '2'  => 'Administrator',
     
);

$captcha = array(
    'name'  => 'captcha',
    'id'    => 'captcha',
    'maxlength' => 8,
);
$form_class = array('class' => 'form-horizontal');
?>


<div class="row">
    <div class="span6">

            <?php echo form_open($this->uri->uri_string(),$form_class ); ?>
                <?php if ($use_username) { ?>
                <div class="control-group">
                    <!-- <?php echo form_label('Username', $username['id']); ?> -->
                    
                    <label for="username" class="control-label">   
                        Username
                    </label>
                    <div class="controls">
                        <?php echo form_input($username); ?><span id="usr_verify" class="verify"></span><br>
                        <?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?>
                    </div>
                </div>
                <?php } ?>


                <div class="control-group">
                    <!-- <?php echo form_label('nama_asli', $nama_asli['id']); ?> -->
                    
                    <label for="nama_asli" class="control-label">   
                        Nama Asli
                    </label>
                    <div class="controls">
                        <?php echo form_input($nama_asli); ?><br>
                        <?php echo form_error($nama_asli['name']); ?><?php echo isset($errors[$nama_asli['name']])?$errors[$nama_asli['name']]:''; ?>
                    </div>
                </div>

                <div class="control-group">
                    <!-- <?php echo form_label('nama_asli', $nama_asli['id']); ?> -->
                    
                    <label for="nama_asli" class="control-label">   
                        Tipe User
                    </label>
                    <div class="controls">
                        <?php echo form_dropdown('pilihan',$cbo,'2','class=""'); ?>
                    </div>
                </div>

                <div class="control-group">
                    <!-- <?php echo form_label('Email Address', $email['id']); ?> -->
                    
                    <label for="email" class="control-label">   
                        Email Address 
                    </label>
                    <div class="controls">
                        <?php echo form_input($email); ?><span id="email_verify" class="verify"></span><br>
                    <?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
                    </div>
                </div>


                <div class="control-group">
                    <!-- <?php echo form_label('Password', $password['id']); ?> -->
                    
                    <label for="password" class="control-label">   
                        Password 
                    </label>
                    <div class="controls">
                        <?php echo form_password($password); ?><span id="password_verify2" class="verify"></span><br>
                        <?php echo form_error($password['name']); ?>
                    </div>
                </div>

                <div class="control-group">
                    <!-- <?php echo form_label('Confirm Password', $confirm_password['id']); ?> -->
                    
                    <label for="confirm_password" class="control-label">   
                        Confirm Password 
                    </label>
                    <div class="controls">
                        <?php echo form_password($confirm_password); ?><span id="confrimpwd_verify2" class="verify"></span><br>
                        <?php echo form_error($confirm_password['name']); ?>
                    </div>
                </div>
                    

                <?php if ($captcha_registration) {
                    if ($use_recaptcha) { ?>

                <div class="control-group">
                    <label for="confirm_password" class="control-label">   
                        Enter the reCaptcha
                    </label>
                    <div class="controls">
                        <?php echo $recaptcha_html; ?>
                    </div>
                </div>
                        <?php echo form_error('recaptcha_response_field'); ?>
                    <!--
                <div class="control-group">
                        <div id="recaptcha_image"></div>
                    <div class="controls">
                        <a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
                        <div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
                        <div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
                    </div>
                </div>
                <div class="control-group">
                        <div class="recaptcha_only_if_image">Enter the words above</div>
                        <div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
                    <div class="controls">
                        <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
                        
                        
                    </div>
                </div>
            -->
                <?php } else { ?>
                <div class="control-group">
                    <div class="controls">
                        <p>Enter the code exactly as it appears:</p>
                        <?php echo $captcha_html; ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <?php echo form_label('Confirmation Code', $captcha['id']); ?>
                        <?php echo form_input($captcha); ?>
                        <?php echo form_error($captcha['name']); ?>
                    </div>
                </div>
                <?php }
                } ?>

                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn">Register</button>
                    </div>
                </div>
                
            <?php echo form_close(); ?>
    </div> <!-- .span8 -->
</div>


<script type="text/javascript">
$(document).ready(function(){
    $("#username").keyup(function(){
        
        if($("#username").val().length >= 4)
        {
        
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>/owner/check_user",
            data: "name="+$("#username").val(),
            success: function(msg){
                if(msg=="true")
                {
                    $("#usr_verify").css({ "background-image": "url('<?php echo base_url();?>images/yes.png')" });
                }
                else
                {
                    $("#usr_verify").css({ "background-image": "url('<?php echo base_url();?>images/no.png')" });
                }
            }
        });
         
        }
        else 
        {
            $("#usr_verify").css({ "background-image": "none" });
        }
    });
    
    $("#emailz").keyup(function(){
        var email = $("#emailz").val();
        
        if(email != 0)
        {
         
            if(isValidEmailAddress(email))
            {
               $("#email_verify").css({ "background-image": "url('<?php echo base_url();?>images/yes.png')" });
               email_con=true;
               register_show();
            } else {
               
                $("#email_verify").css({ "background-image": "url('<?php echo base_url();?>images/no.png')" });
            }
 
        }
        else {
            $("#email_verify").css({ "background-image": "none" });
        }

    });
    
    $("#password").keyup(function(){
        
        if($("#confirm_password").val().length >= 4)
        {
            if($("#confirm_password").val()!=$("#password").val())
            {
                $("#confrimpwd_verify2").css({ "background-image": "url('<?php echo base_url();?>images/no.png')" }); 
                $("#password_verify2").css({ "background-image": "url('<?php echo base_url();?>images/no.png')" });
                pwd=false;
                register_show();
            }
            else{
                $("#confrimpwd_verify2").css({ "background-image": "url('<?php echo base_url();?>images/yes.png')" }); 
                $("#password_verify2").css({ "background-image": "url('<?php echo base_url();?>images/yes.png')" });
            }
        }
    });
    
    $("#confirm_password").keyup(function(){
        
        if($("#password").val().length >=4)
        {
            if($("#confirm_password").val()!=$("#password").val())
            {
                $("#confrimpwd_verify2").css({ "background-image": "url('<?php echo base_url();?>images/no.png')" }); 
                $("#password_verify2").css({ "background-image": "url('<?php echo base_url();?>images/no.png')" });
                pwd=false;
                register_show();
            }
            else{
                $("#confrimpwd_verify2").css({ "background-image": "url('<?php echo base_url();?>images/yes.png')" }); 
                $("#password_verify2").css({ "background-image": "url('<?php echo base_url();?>images/yes.png')" });

            }
        }
    });
});
function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    };
</script>