
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                       CETAK NILAI
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
       

            <!-- START PILIHAN CETAK-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN EXAMPLE TABLE widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Daftar mata kuliah yang belum diinput dan yang masih status terbuka</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                  <th></th>
                                  <th>No.</th>
                                  <th>ID Dosen</th>
                                  <th>Nama Dosen</th>
                                  <th>ID Jadual</th>
								  <th>Kelas</th>
                                  <th>Mata Kuliah</th>
                                  <th>Thn Akademik</th>
                                  <th>Periode</th>
								  <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

<?php $i=1;$y='';$z=0;
if ( !empty($nilai_belum_input) )
foreach($nilai_belum_input->result() as $row)
:?>
                                <tr class="odd gradeX">
                                    <td></td>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row->id_dosen; ?></td>
                                    <td><?php echo $row->nama_dosen; ?></td>
                                    <td><?php echo $row->id_jadual; ?></td>
									<td><?php echo $row->kelas; ?></td>
                                    <td><?php echo $row->nama; ?></td>
                                    <td><?php echo $row->thn_akademik; ?></td>
                                    <td><?php echo $row->periode; ?></td>
									<td><?php echo ($row->id_status==0) ?  'Terbuka' : 'Belum Pernah Diinput' ;?></td>
                                </tr>

<?php 
$i++;
endforeach;
?>
                                </tbody>
                        </table>
            
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE widget-->
                </div>
            </div>

            <!-- END PILIHAN CETAK-->







               </div>
            </div>
            <!-- END PAGE CONTENT-->         
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
   </div>
   <!-- END CONTAINER -->
   