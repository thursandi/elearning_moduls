  <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                      RPS Realisasi
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
                           <h4><i class="icon-user"></i>RPS Realisasi</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>                    
                        </div>

                         <!-- FORM -->
                        <div class="widget-body form">
                      <?php
echo form_open('absensi/simpan_rps_realisasi/'.$id_jadual);
?>
                                    <div class="control-group">
                                        <!-- <label for="old_password">Old Password</label> -->
                                        
                                        <label for="Materi Kuliah" class="control-label">   
                                Materi Kuliah 
                                        </label>
                                        <div class="controls">
                                            <textarea  name="materi"   size="30" class="span6"  /> </textarea><br>
                                        </div>
                                    </div>
                                      <div class="control-group">
                                        <div class="controls">
                                            <button type="submit" class="btn">Simpan Realisasi RPS</button>
                                        </div>
                                    </div>
                                </form> 

                        </div>
                        <!-- FORM -->
                            
                            <div class="space5"></div>
                        </div>
                  </div>
               </div>
     

            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
               <div class="span12">
                  <div class="widget">
                        <div class="widget-title">
                           <h4><i class="icon-user"></i>&nbsp;Realisasi RPS</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>                    
                        </div>
                        <div class="widget-body">


                              <table class="table table-striped table-bordered table-hover" id="">
                                  <thead>
                                      <tr>
                                        <th>Pertemuan</th>
                                        <th>Tanggal Pertemuan</th>
                                        <th>Materi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                              <?php
$no = 1;
foreach ($record->result() as $r ) {
echo "
    <tr >
        <td width='10'>$no</td>
        <td>$r->waktu_input</td>
        <td>$r->materi</td>
    </tr>
";
$no++;
}
?>
<tr>
    <td colspan="2" align="left">   <?php echo anchor('absensi/mahasiswa/'.$id_jadual,'Kembali',array('class'=> 'btn btn-primary blue','style'=>'background-color:blue'));?>

    <td  align="left">   <?php echo anchor('absensi/selesai/'.$id_jadual,'Selesai Mata Kuliah',array('class'=> 'btn btn-primary blue','style'=>'background-color:green'));?>

    <?php
      if(isset($rps_kosong)){
        echo "<span color=red>Isi rps terlebih dahulu</span>";
      }
    ?>

</tr>
                                  
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
