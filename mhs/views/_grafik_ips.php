
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


               </div>
            </div>
            <!-- END PAGE CONTENT-->         
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
   </div>
   <!-- END CONTAINER -->
   