
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                       PROFIL DOSEN
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
                           <h4><i class="icon-user"></i>&nbsp;PROFIL DOSEN</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>                    
                        </div>
                        <div class="widget-body">

<?php 
if ( !empty($biodata) )
foreach($biodata->result() as $row)
:?>

                            <div class="span3">

                                <div class="text-center profile-pic">
                                    <img src="<?=base_url();?>assets/uploads/foto_biodata_dosen/<?php echo ((empty($row->foto))?'no_foto.jpg':$row->foto);?>" alt="">
                                </div>
                                
                            </div>
                            <div class="span6">
                                <h4><?php echo str_replace('*', " $row->nama_asli, ", $row->gelar) ;?></h4>
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr>
                                        <td class="span2">Nama :</td>
                                        <td>
                                            <?php echo ucwords($row->nama_asli);?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2">Tgl Lahir :</td>
                                        <td>
                                            <?php if(!empty($row->tgl_lahir)){
                                              echo date('j F Y', strtotime($row->tgl_lahir));
                                            }
                                            ;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2">Alamat :</td>
                                        <td>
                                            <?php echo ucwords($row->alamat);?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2"> Email :</td>
                                        <td>
                                            <?php echo $row->email;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2"> No. Handphone :</td>
                                        <td>
                                            <?php echo $row->no_hp;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2"> Link Blog :</td>
                                        <td>
<?php $z=str_replace('.', '', $row->nama_asli);
      $nm=explode(' ', $z);
      $url_nama= (empty($nm[1]))? strtolower($nm[0]) : strtolower($nm[0]).'-'. strtolower($nm[1]);
?>
                                            <?php echo base_url().'blog/dosen/'.'<b style="color:blue;">'.$url_nama.'</b>'; ?>                                        </td>
                                    </tr>
                                    </tbody>
                                </table>                              
                            </div>
                            
                            <div class="space5"></div>
<?php 
endforeach;
?>

                        </div>
                  </div>
               </div>
            </div>
            <!-- END PAGE CONTENT-->   



            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
               <div class="span12">
                  <div class="widget">
                        <div class="widget-title">
                           <h4><i class="icon-user"></i>&nbsp;JADWAL MENGAJAR DOSEN</h4>
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
                                        <th>Waktu Mengajar</th>
                                        <th>Ruangan</th>
                                        <th>Kelas</th>
                                        <th>Bobot Tugas</th>
                                        <th>Bobot UTS</th>
                                        <th>Bobot UAS</th>
                                        <th>Thn Akademik</th>
                                        <th>Periode</th>
                                        <th>Lihat Rps</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                 
<?php $i=1;
if ( !empty($jadwal_mengajar) )
foreach($jadwal_mengajar->result() as $row)
:?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <?php
                                        if($mtk_aktif->num_rows == 0){

                                          echo "<td>".anchor( 'absensi/mahasiswa/'.$row->id_jadual,$row->nama)."</td>";

                                        }else{

                                          if($mtk_aktif->row()->id_jadual == $row->id_jadual){

                                              echo "<td>".anchor( 'absensi/mahasiswa/'.$row->id_jadual,$row->nama)."</td>";

                                          }else{

                                              echo "<td>".$row->nama."</td>";
                                          }

                                          
                                        }
                                    ?>            
                                    
                                    <td><?php echo "$row->hari, $row->jam_mulai - $row->jam_selesai"; ?></td>
                                    <td><?php echo $row->ruangan; ?></td>
                                    <td><?php echo $row->kelas; ?></td>
                                    <td><?php echo $row->bobot_tugas; ?></td>
                                    <td><?php echo $row->bobot_uts; ?></td>
                                    <td><?php echo $row->bobot_uas; ?></td>
                                    <td><?php echo $row->thn_akademik; ?></td>
                                    <td><?php echo (($row->periode==1)?'Ganjil':'Genap'); ?></td>
                                    <td><?php echo anchor( 'absensi','Lihat RPS'); ?></td>
                              
                                </tr>

<?php 
$i++;
endforeach;
?>
                                  
                                  </tbody>
                              </table>

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
   