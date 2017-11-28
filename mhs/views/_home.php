
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
                        <div class="widget-title">
                           <h4><i class="icon-user"></i> Biodata Mahasiswa</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>                    
                        </div>
                        <div class="widget-body">
                            <div class="span6">
                                <h4><?php echo ucwords($this->session->userdata('nama')); ?> <br/></h4>
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr>
                                        <td class="span2">NIM :</td>
                                        <td>
                                            <?php echo ucwords($this->session->userdata('nim')); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2">Nama :</td>
                                        <td>
                                            <?php echo ucwords($this->session->userdata('nama')); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2">Tempat, Tgl Lahir :</td>
                                        <td>
                                            <?php echo ucwords($this->session->userdata('tempat_lahir')); ?>, <?php echo date('j M Y', strtotime($this->session->userdata('tgl_lahir'))); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2">Alamat :</td>
                                        <td>
                                            <?php echo $this->session->userdata('alamat'); ?>, RT <?php echo $this->session->userdata('rt'); ?>, RW <?php echo $this->session->userdata('rw'); ?>, Kodepos  <?php echo $this->session->userdata('kodepos'); ?>, Kota  <?php echo $this->session->userdata('kota'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2">Golongan Darah :</td>
                                        <td>
                                            <?php if ($this->session->userdata('gol_darah')==0)
                      {
                        echo '-';
                      }else{
                        echo $this->session->userdata('gol_darah');
                      }; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2">Angkatan :</td>
                                        <td>
                                            <?php echo ucwords($this->session->userdata('angkatan')); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2">Jurusan :</td>
                                        <td>
                                            <?php echo ucwords($this->session->userdata('jurusan')); ?>
                                        </td>
                                    </tr>
									
									<tr>
                                        <td class="span2">Dosen Wali :</td>
<?php 
if ( !empty($dosen_wali) )
foreach($dosen_wali->result() as $row)
:?>
                                        <td>
                                            <?php echo str_replace('*', " $row->nama, ", $row->gelar) ;?>
                                        </td>
                                         <td>
                                            <?php echo anchor('absensi/tampil_absen_mhs/','Lihat Detail') ;?>
                                        </td>
                                       
<?php 
endforeach;
?>
                                    </tr>
									
                                    </tbody>
                                </table>
                                
                      
                            </div>

                            
<?php 
if ( !empty($ipk) )
foreach($ipk->result() as $row)
:?>

                      
                        <div data-desktop="span2" data-tablet="span4" class="span2 responsive">
                            <div class="metro-overview green-color clearfix">
                                <div class="display">
                                    <i class="icon-star-empty"></i>
                                </div>
                                <div class="details">
                                    <div class="numbers">IPK: <?php echo round($row->ipk, 2) ; ?></div>
                                    <div class="title">Jumlah SKS: <?php echo $row->sks; ?></div>
                                </div>
                            </div>
                        </div>

<?php 
endforeach;
?>


                            
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
   