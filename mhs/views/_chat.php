<link rel="stylesheet" href="<?=base_url();?>assets/css/admin/alert_panah.css">
<?php
/* data pribadi */
$chat = array(
    'name'  => 'chat',
    'id'    => 'contactName',
    'value' => set_value('chat'),
    'maxlength' => 150,
    'placeholder'=> 'Ketikkan chat anda...',
);

/* data pribadi */

$captcha = array(
    'name'  => 'captcha',
    'id'    => 'captcha',
    'maxlength' => 8,
);

$form_class = array('class' => '');

?>
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                       Chat sesama program studi (trial)
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="<?=base_url();?>"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
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


                        <!-- MULAI CHAT -->



              <!-- BEGIN CHAT PORTLET-->
              <div class="widget" id="chats">
                <div class="widget-title">
                  <h4><i class="icon-comments-alt"></i> Daftar Chat (30 Pesan Terbaru)</h4>
                  <span class="tools">
                  <a href="javascript:;" class="icon-chevron-down"></a>
                  </span>
                </div>
                <div class="widget-body">
                                    <div class="" style="height:500px; overflow: auto;">
									
											<!-- Comment -->
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <div class="text" style="text-align:left;">
                                                        <b style="color:blue;">Admin</b>
                                                        <p>Peraturan dan Etika:<br>
1. Tidak memposting informasi yang bersifat SARA.<br>
2. Tidak diperkenankan mengirimkan pesan dengan kata-kata tidak baik dan kata-kata tidak sopan<br>
3. Dilarang memanfaatkan e-learning ini untuk mempromosikan produk untuk jual-beli.<br>
4. Semua posting yang dibuat oleh user manjadi tanggung jawab pribadi.<br>
5. Admin berhak menghapus pesan apabila melanggar peraturan dan etika yang telah dibuat.<br>
6. Hanya Mahasiswa/i sesama program studi, yang dapat melihat pesan Anda.<br>
7. Gunakan fasilitas ini demi menunjang perkuliahan Anda.<br>
8. Jika ada kesalahan dalam tabel nilai baik besarnya sks ataupun nilai, dimohon tidak memposting disini, tetapi dapat langsung menghubungi bagian pusat data.<br>
Terima kasih</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /comment -->
											
											
											
<?php $x='';$posisi='left';$z=1;
if ( !empty($daftar_chat) )
foreach($daftar_chat->result() as $row):
?>

                                             <!-- Comment -->
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <div class="text" style="text-align:
                                                    <?php 
                                                    if($z==1){
                                                        echo $posisi;
                                                    }else{
                                                        //echo () ? 'left' : 'right';
                                                        if($row->nim==$x){
                                                            echo $posisi;
                                                        }else{
                                                            if($posisi=='left'){
                                                              $posisi='right';
                                                            }else{
                                                              $posisi='left';
                                                            }
                                                            echo $posisi;
                                                        }
                                                    }
                                                    ?>;">
                                                        <p class="attribution">
                                                          <b style="color:blue;"><?php echo $row->nama.' - ['.$row->nim.']'; ?></b> ,<i> 
                                                          <?php echo time_elapsed_string($row->waktu_chat); ?></i></p>
                                                        <p><?php echo $row->isi_chat; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /comment -->

<?php 
$z++;
$x=$row->nim;
endforeach;
?>

                                        </div>


<?php echo form_open($this->uri->uri_string()); ?>
                  <div class="chat-form">
                    <div class="input-cont">
                      

                      <?php echo form_error($chat['name']); ?><?php echo isset($errors[$chat['name']])?$errors[$chat['name']]:''; ?>
                    <?php echo form_input($chat, '', (form_error('chat') ? 'class="tabel_merah"' : '') ); ?>



                    </div>
                    <div class="btn-cont" style="padding:3px;">
                      <button type="submit" name="submit" onclick="show()" class="btn btn-primary">Kirim</button>
                    </div>



        <?php
        if ($use_recaptcha) { ?>

          <?php echo form_error('recaptcha_response_field'); ?><br><br>
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


          <div id = "myDiv" style="display:none" align="center">
                <img id = "myImage" src = "<?=base_url();?>images/loader.gif">
                <p>mohon tunggu...</p>
            </div>

                  </div>
<?php echo form_close(); ?> 

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
              <!-- END CHAT PORTLET-->





                        <!-- END CHAT --> 



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
   