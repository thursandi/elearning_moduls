
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                       DAFTAR USERNAME DOSEN
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
               

			
			
			
			

            <div class="row-fluid">
                <div class="span12">
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Daftar Username Dosen</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
						<i>informasi: Status berwarna orange menandakan password masih belum dirubah. Password default dapat ditanyakan kepada admin (Ibu Ulil)</i><hr>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
								  <th></th>
                                  <th>No.</th>
                                  <th>Nama Dosen</th>
								  <th>Username</th>
                                  <th>Email</th>
                                  <th>Status Password</th>
								  <!--
                                  <th>Cetak Nilai</th>
								  -->
                                </tr>
                            </thead>
                            <tbody>

<?php $zz=1;;
if ( !empty($daftar_username) )
foreach($daftar_username->result() as $row)
:?>
                                <tr class="odd gradeX">
									<th></th>
                                    <td><b><?php echo $zz; ?></b></td>
									<td><?php 
									if(!empty( $row->gelar )) {
										echo str_replace('*', " $row->nama_asli, ", $row->gelar);
									}else{
										echo $row->nama_asli;
									}
									?></td>
									<th><?php echo $row->username; ?></th>
                                    <td><?php echo $row->email; ?></td>
                                    <td>
									<?php
									if ($row->password=='$2a$08$lOKZ/TLglxdY2EGwGksOlOcn.SR9WcIJWprrj6kfTlYQXRYocN0Zy')
									{
										echo '<span class="label label-warning">Password default belum dirubah</span>';
									}else{
										echo '<span class="label label-info">Password telah dirubah</span>';
									}
									
									?>
									</td>
                                </tr>

<?php 
$zz++;
endforeach;
?>
                                </tbody>
                        </table>
            
                        </div>
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
   