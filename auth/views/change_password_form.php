<?php
$old_password = array(
	'name'	=> 'old_password',
	'id'	=> 'old_password',
	'size' 	=> 30,
    'class'=> 'span6',
);
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
    'class'=> 'span6',
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
    'class'=> 'span6',
);
$form_class = array('class' => 'form-horizontal');
?>

<style type="text/css">
    .tabel_merah {
  border:  1px solid red;
  background-color:#ffe2e2;
}

/* arrow keatas */
.popup {
  float: left;
  width: auto;
  background: #ad1313;
  padding: 4px;
  border-radius: 2px;
  color: #FFF;
  position: relative;
  font-size: 12px;
  line-height: 20px;
}
.popup:after{ /* arrow keatas */
  content:'';
  display:block;
  position:absolute;
  top:-20px; /*should be set to -border-width x 2 */
  left:30px;
  width:0;
  height:0;
  border-color: transparent transparent #ad1313 transparent; /*border color should be same as div div background color*/
  border-style: solid;
  border-width: 10px;
}
/* arrow keatas */
.verify
{
    margin-top: 4px;
    margin-left: 9px;
    position: absolute;
    width: 16px;
    height: 16px;
}
</style>






      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                       UBAH PASSWORD
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="<?=base_url();?>e_dosen"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                       </li>
                       <li>
                           <?php echo str_replace('_', ' ', ucwords($this->uri->segment(2))); ?> <span class="divider-last">&nbsp;</span>
                       </li>
                   </ul>
                   <!-- END PAGE TITLE & BREADCRUMB-->
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
               <div class="span12">
                  <div class="widget">
                        <div class="widget-title">
                           <h4><i class="icon-user"></i>UBAH PASSWORD</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>                    
                        </div>

                         <!-- FORM -->
                        <div class="widget-body form">
      
                                    <div <?php echo $pesan_sukses; ?>>
                                      <div class="alert alert-success">
                                        <button class="close" data-dismiss="alert">×</button>
                                        <strong>Success!</strong> Password telah berhasil di ganti.
                                      </div>
                                    </div>

                                <?php echo form_open($this->uri->uri_string(),$form_class ); ?>

                                    <div class="control-group">
                                        <!-- <?php echo form_label('Old Password', $old_password['id']); ?> -->
                                        
                                        <label for="old_password" class="control-label">   
                                            Password Lama
                                        </label>
                                        <div class="controls">
                                            <?php echo form_password($old_password); ?><br>
                                            <?php echo form_error($old_password['name']); ?><?php echo isset($errors[$old_password['name']])?$errors[$old_password['name']]:''; ?>
                                        </div>
                                    </div>
                                    

                                    <div class="control-group">
                                        <!-- <?php echo form_label('New Password', $old_password['id']); ?> -->
                                        
                                        <label for="old_password" class="control-label">   
                                            Password Baru
                                        </label>
                                        <div class="controls">
                                            <?php echo form_password($new_password); ?><span id="password_verify" class="verify"></span><br>
                                        <?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?>
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <!-- <?php echo form_label('Confirm New Password', $confirm_new_password['id']); ?> -->
                                        
                                        <label for="old_password" class="control-label">   
                                            Konfirmasi Password Baru
                                        </label>
                                        <div class="controls">
                                            <?php echo form_password($confirm_new_password); ?><span id="confrimpwd_verify" class="verify"></span><br>
                                            <?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?>
                                        </div>
                                    </div>
                                        
                                    <div class="control-group">
                                        <div class="controls">
                                            <button type="submit" class="btn">Change Password</button>
                                        </div>
                                    </div>
                                    
                                <?php echo form_close(); ?>
                        </div>
                        <!-- FORM -->
                            
                            <div class="space5"></div>
                        </div>
                  </div>
               </div>
            </div>
            <!-- END PAGE CONTENT-->         
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
   </div>
   <!-- END CONTAINER -->


<script type="text/javascript">
$(document).ready(function(){
    
    $("#new_password").keyup(function(){
        
        if($("#confirm_new_password").val().length >= 4)
        {
            if($("#confirm_new_password").val()!=$("#new_password").val())
            {
                $("#confrimpwd_verify").css({ "background-image": "url('<?php echo base_url();?>images/no.png')" }); 
                $("#password_verify").css({ "background-image": "url('<?php echo base_url();?>images/no.png')" });
                pwd=false;
                register_show();
            }
            else{
                $("#confrimpwd_verify").css({ "background-image": "url('<?php echo base_url();?>images/yes.png')" }); 
                $("#password_verify").css({ "background-image": "url('<?php echo base_url();?>images/yes.png')" });
            }
        }
    });
    
    $("#confirm_new_password").keyup(function(){
        
        if($("#new_password").val().length >=4)
        {
            if($("#confirm_new_password").val()!=$("#new_password").val())
            {
                $("#confrimpwd_verify").css({ "background-image": "url('<?php echo base_url();?>images/no.png')" }); 
                $("#password_verify").css({ "background-image": "url('<?php echo base_url();?>images/no.png')" });
                pwd=false;
                register_show();
            }
            else{
                $("#confrimpwd_verify").css({ "background-image": "url('<?php echo base_url();?>images/yes.png')" }); 
                $("#password_verify").css({ "background-image": "url('<?php echo base_url();?>images/yes.png')" });

            }
        }
    });
});
</script>