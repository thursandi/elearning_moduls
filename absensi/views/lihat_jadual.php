  <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                      Mata Kuliah Aktif
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
                           <h4><i class="icon-user"></i>&nbsp;Mata Kuliah Aktif</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>                    
                        </div>
                        <div class="widget-body">


                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                  <thead>
                                      <tr>
                                        <th>No.</th>
                                        <th>Mata Kuliah</th>
                                        <th>Dosen</th>
                                        <th>Kelas</th>
                                        <th>Hari</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Tahun Akademik</th>
                                        <!--<th>Ruangan</th>-->
                                        <th>Operasi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                              <?php
$no = 1;
foreach ($record->result() as $r ) {
echo "
    <tr >
        <td width='10'>$no</td>
        <td>$r->nm_mtk</td>
        <td>$r->nm_dosen</td>
        <td>$r->kelas</td>
        <td>$r->hari</td>
        <td>$r->jam_mulai</td>
        <td>$r->jam_selesai</td>
        <td>$r->thn_akademik</td>
    <td  >".anchor('absensi/absen_detail/'.$r->id_jadual,'Lihat Detail')."

    </td>
    </tr> 
";
$no++;
}
?>
                                  </tbody>
                              </table>

                        </div>
                  </div>
               </div>
            </div>
            
            </div>
            <!-- END PAGE CONTENT-->         
    
         </div>
         <!-- END PAGE CONTAINER-->
      
      </div>

   <!-- END CONTAINER -->
