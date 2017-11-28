  <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                      Absensi Mahasiswa dan RPS Detail
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
                           <h4><i class="icon-user"></i>&nbsp;Absensi Mahasiswa dan RPS Detail</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>                    
                        </div>
                        <div class="widget-body">
                              <table class="table table-striped table-bordered table-hover" id="">
                                  <thead>
                                      <tr>
                                        <th>No.</th>
                                        <th>Mata Kuliah</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Materi</th>
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
        <td>$r->nama</td>
        <td>$r->waktu_input</td>
        <td>$r->waktu_selesai</td>
        <td>$r->materi</td>
        
    <td  >".anchor('absensi/mahasiswa_edit_ak/'.$r->id_jadual.'/'.$r->id_absen,'Edit Absen Mahasiswa')." | 
         ".anchor('absensi/rps_realisasi_edit/'.$r->id_jadual.'/'.$r->id_absen,'Edit RPS Realisasi')."
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
