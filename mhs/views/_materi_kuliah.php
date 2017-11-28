
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
<?php
$i=0;
if ( !empty($nama_dosen_materi) ){

  foreach($nama_dosen_materi->result() as $row):

    $m_nama[$i]=$row->nama_asli;
    $m_gelar[$i]=$row->gelar;

    $i++;
  endforeach;

  $i=0;$n=0;$x='';
  foreach($materi_kuliah->result() as $row):

    if ($x!=$row->id_dosen) {
        
        if (empty($x)) {
            $m_mata_kuliah[$i][$n]=$row->nama_mata_kuliah;
			$m_keterangan_dokumen[$i][$n]=$row->keterangan_dokumen;
            $m_link[$i][$n]=$row->lampiran_materi;
            $n++;
        }else{
            $i++;$n=0;
            $m_mata_kuliah[$i][$n]=$row->nama_mata_kuliah;
			$m_keterangan_dokumen[$i][$n]=$row->keterangan_dokumen;
            $m_link[$i][$n]=$row->lampiran_materi;
            $n++;
        }
        

    }else{

        $m_mata_kuliah[$i][$n]=$row->nama_mata_kuliah;
		$m_keterangan_dokumen[$i][$n]=$row->keterangan_dokumen;
        $m_link[$i][$n]=$row->lampiran_materi;
        $n++;
        

    }
    $x=$row->id_dosen;
    
  endforeach;







}


?>
                        <div class="widget-title">
                            <h4><i class=" icon-indent-left"></i>Daftar Materi Kuliah</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                        </div>
                        <div class="widget-body" style="font-size:14px;">
                                
                                    <ul class="branch in">

<?php 
if ( !empty($m_nama) )
for ($i=0; $i <count($m_nama) ; $i++) { 
?>
                                        <li>
                                            <a data-toggle="branch" class="tree-toggle closed" data-role="branch" href=""><i style="color:grey;">Nama Dosen: </i><b><?php 
											if	(empty($m_gelar[$i])) {
												echo $m_nama[$i];
											}else{
												echo str_replace('*', $m_nama[$i].', ', $m_gelar[$i]) ;
											}
											?></b>
                                            </a>
                                            <ul class="branch">

                                  <?php 
                                  for ($j=0; $j <count($m_mata_kuliah[$i]) ; $j++) { 
                                  ?>
                                              <li><i class="icon-file"></i> <b><?php echo $m_mata_kuliah[$i][$j].' ('.$m_keterangan_dokumen[$i][$j].') '; ?></b> --------------- <a href="<?php echo base_url().'assets/uploads/materi_kuliah/'.$m_link[$i][$j]; ?>"><i style="color:blue;">download dokumen</i></a> -- <a href="<?php echo base_url().'mhs/baca_materi_kuliah/'.$m_link[$i][$j]; ?>"><i style="color:blue;">baca dokumen</i></a></li>

                                  <?php 
                                  }
                                  ?>
                                            </ul>
                                        </li>
<?php 
}
?>

                                    </ul>
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
   