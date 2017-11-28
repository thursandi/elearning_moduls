
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

<!-- MULAI GRAFIK -->
                  <div class="widget">
                        <div class="widget-title">
                           <h4><i class="icon-list-alt"></i>&nbsp;Grafik IPS Anda</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>                    
                        </div>
                        <div class="widget-body">
<script>
//Data IP Per Semester 
$(function () {
        $('#container_grafik').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'IPS | <?php echo ucwords($this->session->userdata('nama')); ?>'
            },
            subtitle: {
                text: 'Source: Pusat Data STMI'
            },
            xAxis: {
                categories: [
<?php $i=1;
if ($ip_per_semester!=NULL)
foreach($ip_per_semester->result() as $row):
   echo $i.', ';
    $i++;
endforeach;
?>   
                    
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Nilai IPS'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">Semester {point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'IP',
                data: [
<?php
if ($ip_per_semester!=NULL)
foreach($ip_per_semester->result() as $row):
  echo round($row->ipk,2).', ';
endforeach;
?>               ]
    
            }]
        });
    });
    

    
</script>
                        <div id="container_grafik" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

                        </div>
                  </div>
<!-- END GRAFIK -->
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
                            <table class="table table-striped table-bordered" id="sample_1">
                            <thead>
                                <tr>
                                  <th>No.</th>
                                  <th>Thn Akademik</th>
                                  <th>Periode</th>
                                  <th>Semester</th>
                                    <th>Kode MK</th>
                                    <th>Nama Mata Kuliah</th>
                  <th>Tugas</th>
                  <th>UTS</th>
                  <th>UAS</th>
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
                  <td><?php echo $row->tugas;?></td>
                  <td><?php echo $row->uts;?></td>
                  <td><?php echo $row->uas;?></td>
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
            <h5 style="color:red;"><i>Catatan:<br> - Nilai E yang tercantum menandakan bahwa nilai tersebut belum fix, hal tersebut tidak berlaku bagi mahasiswa/i yang tidak mengikuti tugas/uts/uas.</i><br>
            <i style="color:blue;">- Jika ada kritik maupun saran terhadap e-learning mahasiswa ini, dapat mengirimkan email ke <b>ezz_chocolate@yahoo.com</b> Terima kasih. [ttd Web Master]</i><h5>
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
   