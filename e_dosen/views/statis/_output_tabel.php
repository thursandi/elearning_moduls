
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                       <?php echo str_replace('_', ' ', strtoupper($this->uri->segment(2))); ?>
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
                           <h4><i class="icon-user"></i>&nbsp;<?php echo str_replace('_', ' ', strtoupper($this->uri->segment(2))); ?></h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>                    
                        </div>
                        <div class="widget-body">

                            <?php echo (($this->uri->segment(2)=='log_login_dosen')? '
                            <table >
                              <tr>
                                <td>pass default dosen</td>
                                <td>:</td>
                                <td><b>sayainidosen2325 (sebelum diganti)</b></td>
                              </tr>
                              <tr>
                                <td>username login dosen</td>
                                <td>:</td>
                                <td><b>bisa dengan <u>username</u> atau <u>email</u></b></td>
                              </tr>
                            </table>
                            ' :''); ?>
                            <hr>
                            
                            
                            <?php echo $output; ?>
                            
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
   