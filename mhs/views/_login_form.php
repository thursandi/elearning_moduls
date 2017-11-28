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
	  .span5 { border: 1px solid #ddd;  -webkit-box-shadow: 0 0 8px #D0D0D0;  }
        #isi_border{
          border:1px solid #999;
          padding:10px;
        }
        .judul{
          float:left;
          padding:0 5px;
          margin:-20px 0 0 30px;
          background:#fff;
        }
    </style>
</head>
<body>
<?php
/* data pribadi */
$nim = array(
    'name'  => 'nim',
    'id'    => 'contactName',
    'value' => set_value('nim'),
    'maxlength' => 7,
    'placeholder'=> 'NIM Anda',
    'class'=> 'span4',
);

$tgl = array(
    'name'  => 'tgl',
    'id'    => 'contactName',
    'value' => set_value('tgl'),
    'maxlength' => 2,
    'placeholder'=> 'dd (01)',
    'style'=> 'width: 100px',
);

$bln = array(
    'name'  => 'bln',
    'id'    => 'contactName',
    'value' => set_value('bln'),
    'maxlength' => 2,
    'placeholder'=> 'mm (01)',
    'style'=> 'width: 100px',
);

$thn = array(
    'name'  => 'thn',
    'id'    => 'contactName',
    'value' => set_value('thn'),
    'maxlength' => 4,
    'placeholder'=> 'yyyy (1990)',
    'style'=> 'width: 100px',
);

/* data pribadi */

$captcha = array(
    'name'  => 'captcha',
    'id'    => 'captcha',
    'maxlength' => 8,
);

$form_class = array('class' => '');

?>



<div class="container">
    <div class="row">
        <div class="span5 offset4 well">
            <legend>Login E-Learning Mahasiswa<img src="<?=base_url();?>img/logo2.png" width="130" height="200" align="absmiddle" /> </legend>
            
            <div <?php echo $error_bukan_mahasiswa;?>>
                <div class="alert alert-error"><i>Maaf, Field NIM atau Tanggal Lahir Anda salah. Terima kasih.</i></div>
            </div>

            <?php echo form_open($this->uri->uri_string()); ?>

        <div id="isi_border">
        <div class="judul">Data Mahasiswa</div>
            <table>
                <tr>
                    <td><label>NIM<em style="color:red;">*</em>:</label><br></td>
                    <td colspan="3"><?php echo form_error($nim['name']); ?><?php echo isset($errors[$nim['name']])?$errors[$nim['name']]:''; ?>
                    <?php echo form_input($nim, '', (form_error('nim') ? 'class="tabel_merah"' : '') ); ?></td>
                    
                </tr>
                <tr>
                    <td><label>Tgl Lahir<em style="color:red;">*</em>:</label></td>
                    <td><?php echo form_error($tgl['name']); ?><?php echo isset($errors[$tgl['name']])?$errors[$tgl['name']]:''; ?><br />
                    <?php echo form_input($tgl, '', (form_error('tgl') ? 'class="tabel_merah"' : '') ); ?>&nbsp;/ <br /></td>
                    <td><?php echo form_error($bln['name']); ?><?php echo isset($errors[$bln['name']])?$errors[$bln['name']]:''; ?><br />
                    <?php echo form_input($bln, '', (form_error('bln') ? 'class="tabel_merah"' : '') ); ?>&nbsp;/ <br /></td>
                    <td><?php echo form_error($thn['name']); ?><?php echo isset($errors[$thn['name']])?$errors[$thn['name']]:''; ?><br />
                    <?php echo form_input($thn, '', (form_error('thn') ? 'class="tabel_merah"' : '') ); ?><br /></td>
                </tr>
            </table>
        </div>
            
         
            
        <br>
        <div id="isi_border">
        <div class="judul">Kode Keamanan<em style="color:red;">*</em></div>
            
				<?php
				if ($use_recaptcha) { ?>

					<?php echo form_error('recaptcha_response_field'); ?>
					<?php echo $recaptcha_html; ?>

				<?php } else { ?>
					<table>
					<tr>
						<td>
							<?php echo $captcha_html; ?>
						</td>
					</tr>
					<tr>
						<td><?php echo form_error($captcha['name']); ?><br>
							<?php echo form_input($captcha); ?>
						</td>
					</tr>
					</table>
				<?php 
				} ?>
		
        </div>

			<!--
            <hr>
			<div >
                <div class="alert alert-error"><i>Mohon maaf kode keamanan sedang perbaikan, untuk sementara tidak dapat login </i></div>
            </div>
			-->
			<hr>
            <div >
                <div class="alert"><i>NB: Hanya Mahasiswa STMI yang masih aktiflah yang dapat login <br>
				Jangan lupa untuk <b>enable cookies</b><br>
				- Google Chrome <a target="_blank" href="https://support.google.com/accounts/answer/61416?hl=en">klik disini</a><br>
				- Mozilla Firefox <a target="_blank" href="https://support.mozilla.org/en-US/kb/enable-and-disable-cookies-website-preferences">klik disini</a></i></div>
            </div>
			
			<div id = "myDiv" style="display:none" align="center">
                <img id = "myImage" src = "<?=base_url();?>images/loader.gif">
                <p>mohon tunggu...</p>
            </div>
			
            <button type="submit" name="submit" onclick="show()" class="btn btn-info btn-block">Sign in</button>
            <?php echo form_close(); ?> 
			<a href="<?=base_url();?>"><i class="icon-home"> kembali ke home</i></a>

<script type = "text/javascript">
function show() {
document.getElementById("myDiv").style.display="block";
setTimeout("hide()", 200000);  // 5 seconds
}

function hide() {
document.getElementById("myDiv").style.display="none";
}
</script>			

        </div>
    </div>
</div>
<!-- /container -->

</body>
<footer align="center">
    <p><img src="<?=base_url();?>images/stmi.gif" width="20" height="20" align="absmiddle" /> Copyright © 2016 | Pusdata Politeknik STMI | Hak Cipta Dilindungi oleh Undang-undang | Best viewed in <a href="https://www.google.com/intl/id/chrome/browser/">Chrome v.31++</a> | Page rendered in {elapsed_time} seconds</p>
</footer>
</html>
