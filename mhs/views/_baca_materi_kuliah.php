
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                       E-Learning Mahasiswa
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
               <div class="span12">
                  <div class="widget">

  <!-- -->

                        <div class="widget-title">
                            <h4><i class=" icon-indent-left"></i> Baca Materi Kuliah </h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                        </div>
                        <div class="widget-body" style="font-size:14px;">
                                
                                    <ul class="branch in">
<?php $x='http://e-learning.stmi.ac.id/assets/uploads/materi_kuliah/'.$path_pdf; ?>
<iframe src="http://docs.google.com/viewer?url=<?php echo $x ;?>&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe>


                                    </ul>
									
									<h5><i style="color:red;">- Jika tidak dapat membaca materi yang tercantum (blank putih), harap login ke akun gmail terlebih dahulu  <b>http://mail.google.com/</b> Terima kasih. [ttd Web Master]</i><h5>
                        </div>
  <!-- -->
							
                            
                            <div class="space5"></div>

                        </div>

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
   