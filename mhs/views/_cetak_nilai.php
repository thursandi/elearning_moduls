
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
                  <!-- BEGIN ADVANCED TABLE widget-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN EXAMPLE TABLE widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Daftar Nilai Anda</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                  <th>No.</th>
                                  <th>Thn Akademik</th>
                                  <th>Periode</th>
                                  <th>Semester</th>
                                    <th>Kode MK</th>
                                    <th>Nama Mata Kuliah</th>
                  <th>Tugas <sub>[% tugas]</sub></th>
                  <th>UTS <sub>[% UTS]</sub></th>
                  <th>UAS <sub>[% UAS]</sub></th>
                  <th></th>
                                    <th>SKS</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>

<?php $i=1;$y='';$z=0;
if ( !empty($nilai) )
foreach($nilai->result() as $row)
:?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row->thn_akademik; ?></td>
                                    <td><?php echo (($row->periode==1)? 'Ganjil': 'Genap'); ?></td>
                                    <td><?php 
                                    if($y!=$row->periode){
                                      $z=$z+1;
                                      echo $z;
                                    }else{
                                      echo $z;
                                    }
                                    $y=$row->periode;
                                     ?></td>
                                    
                                    <td><?php echo $row->kd_mtk;?></td>
                                    <td><?php echo $row->mata_kuliah;?></td>
                  <td><?php echo $row->tugas;?> 
                    <sub>[<?php echo ( empty($row->bobot_tugas) ? '-' : $row->bobot_tugas );?>%]</sub>
                  </td>
                  <td><?php echo $row->uts;?> 
                    <sub>[<?php echo ( empty($row->bobot_uts) ? '-' : $row->bobot_uts );?>%]</sub>
                  </td>
                  <td><?php echo $row->uas;?> 
                    <sub>[<?php echo ( empty($row->bobot_uas) ? '-' : $row->bobot_uas );?>%]</sub>
                  </td>
                  <td></td>
                                    <td><?php echo $row->sks;?></td>
                                    <td><?php echo $row->nilai;?></td>
                                </tr>

<?php 
$i++;
endforeach;
?>
                                </tbody>
                        </table>
            <hr>
            <h5 style="color:red;"><i>Catatan:<br> - Update terbaru (16 Feb 2014): </i><br>
			- Mulai tahun akademik 2013 periode ganjil, nilai matakuliah yang mempunyai praktikum akan dipisah menjadi 2 Nilai.<br>
			- Database dalam tahap perbaikan, jika ada perbedaan SKS antara kertas IPK dan yang tercantum pada E-Learning, maka kertas IPK lah yang benar untuk menjadi acuan. Harap Maklum. Terima kasih.</i><br><br>
			
			<h5 style="color:red;"><i>Catatan:<br> - Update terbaru (14 September 2014): </i><br>
			- PERCOBAAN Revisi jumlah SKS tiap mata kuliah.</i><br><br>
			
			<i style="color:blue;">- Jika ada kritik maupun saran terhadap e-learning mahasiswa ini serta perbedaan SKS, dapat mengirimkan email ke <b>ulil-h@kemenperin.go.id</b> beserta melampirkan Screenshot error yang dimaksud.Terima kasih. [ttd Web Master]</i><h5>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE widget-->
                </div>
            </div>

            <!-- END ADVANCED TABLE widget-->


               </div>
            </div>
            <!-- END PAGE CONTENT-->         
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
   </div>
   <!-- END CONTAINER -->

<!-- CETAK -->   
<?php
$vw="<script language=javascript> 
function prints() {
bV = parseInt(navigator.appVersion); 
if (bV >= 4) window.print();
PageFormat.PMOrientation;}
prints(); 
</script>";
echo $vw; 
?>
   