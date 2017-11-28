
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                       CETAK DAFTAR NILAI TERKUNCI
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
               
                  <!-- BEGIN ADVANCED TABLE widget-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN EXAMPLE TABLE widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i>Daftar Nilai</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body"  id="cetak">
                          <table class="table table-striped">
                            <tr>
                              <td>Nama Dosen</td>
                              <td>:</td>
                              <td><?php echo str_replace('*', " $nama_asli, ", $gelar) ;?></td>
                            </tr>
                            <tr>
                              <td>Mata Kuliah</td>
                              <td>:</td>
                              <td><?php echo $id_mtk.' --- '.$nama.' --- '.$kelas;?></td>
                            </tr>
                            <tr>
                              <td>Status Bobot</td>
                              <td>:</td>
                              <td>TUGAS=<?php echo simple_decrypt($this->session->userdata('persen_tugas')); ?>% &nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp; UTS=<?php echo simple_decrypt($this->session->userdata('persen_uts')); ?>% &nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp; UAS=<?php echo simple_decrypt($this->session->userdata('persen_uas')); ?>% </td>
                            </tr>
                            <tr>
                              <td>Keterangan</td>
                              <td>:</td>
                              <td>0-44=E&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;45-55=D&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;56-61=C&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;62-67=C+&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;68-73=B&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;74-79=B+&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;80-100=A</td>
                            </tr>
                          </table>

               
<script type="text/javascript">



function cetak_data() {


        $.ajax({
                type : "post",
                data: {id_jadual: <?php echo $this->session->userdata('id_jadual'); ?>,
                    },
                    
                url : "<?php echo base_url();?>/e_dosen/cetak_nilai/jumlah_update_cetak",
                cache : false,
                context: document.body,
                async:false,   //Send Synchronously
                success : function(data) {
                    //alert(data);
                    printDiv('cetak');
                }
            });


    }

function printDiv(divID) {
        //Get the HTML of div
        var divElements = document.getElementById(divID).innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;

        //Reset the page's HTML with div's HTML only
        document.body.innerHTML = 
          "<html><head><title></title></head><body>" + 
          divElements + "</body>";

        //Print Page
        window.print();

        //Restore orignal HTML
        document.body.innerHTML = oldPage;


}


$(document).ready(function() {

  $("#pesan_sukses").css({ "display": "none" });

  $(".input-mini").keydown(function(event){

             if (event.shiftKey == true) {
                  event.preventDefault();
              }

              if ((event.keyCode >= 48 && event.keyCode <= 57) || 
                  (event.keyCode >= 96 && event.keyCode <= 105) || 
                  event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
                  event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190 || event.keyCode == 13) {

              } else {
                  event.preventDefault();
              }

              if($(this).val().indexOf('.') !== -1 && event.keyCode == 190){
                  event.preventDefault(); 
              }


         });


 document.getElementById( 'sums' ).addEventListener( 'keyup', function ( event ) {
    
    if( event.target.name.substr( 0, 5) == 'nilai' ) {
        
        var jumlah_baris=<?php echo $daftar_mhs->num_rows(); ?>;
        var tugas=<?php echo simple_decrypt($this->session->userdata('persen_tugas')); ?>;
        var uts=<?php echo simple_decrypt($this->session->userdata('persen_uts')); ?>;
        var uas=<?php echo simple_decrypt($this->session->userdata('persen_uas')); ?>;
        var index = event.target.name.substr( 6, 2 ),
            inputs = document.querySelectorAll( 'input[name^="nilai\[' + index + '"]' ),
            value = 0;
        
        for ( var i = 0; i < inputs.length; i++ ) {
            //value += window.Number( inputs[i].value ) || 0;
            if (i==0) {
                value += window.Number( inputs[i].value )*tugas/100 || 0;
            }else if (i==1) {
                value += window.Number( inputs[i].value )*uts/100 || 0;
            }else if(i==2){
                value += window.Number( inputs[i].value )*uas/100 || 0;
            };

        };
        value=Math.round(value);
        document.getElementsByName( 'sum[' + index + ']' )[0].value = value;
            var huruf='';
            if (value>=80) {
                huruf='A';
            }else if (value>=68 && value<=79) {
                huruf='B';
            }else if(value>=56 && value<=67){
                huruf='C';
            }else if(value>=45 && value<=55){
                huruf='D';
            }else if(value>=0 && value<=44){
               huruf='E';
            };
          document.getElementsByName( 'huruf[' + index + ']' )[0].value = huruf;
        
    };
                                                    
}, false );
   



    
});

</script>
<style>

input[type="text"]:focus{
    border-color: rgba(82, 168, 236, 0.8);
   outline: 0;
   outline: thin dotted  \9;
   -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
   -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
   box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6)
}

.table tbody tr:hover td, .table tbody tr:hover th {
    background-color: #d8eeff;
}
</style>


                            <br>
                              
                               <form id="sums">
                              <table class="table table-striped table-bordered table-hover" id="">
                                  <thead>
                                      <tr>
                                        <th>No.</th>
                                        <th>NIM</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Tugas</th>
                                          <th>UTS</th>
                                          <th>UAS</th>
                                          <th>Angka / Huruf</th>
                                      </tr>
                                  </thead>
                                  <tbody  id="hasil_pencarian">
                                 
<?php $i=1;$y='';$z=0;
if ( !empty($daftar_mhs) )
foreach($daftar_mhs->result() as $row)
:?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row->nim; ?></td>
                                    <td><?php echo $row->nama; ?></td>
                                    <td><?php echo $row->tugas; ?></td>
                                    <td><?php echo $row->uts; ?></td>
                                    <td><?php echo $row->uas; ?></td>
                                    <td><?php echo 
                                      round( ( simple_decrypt($this->session->userdata('persen_tugas')) * $row->tugas / 100) +
                                        ( simple_decrypt($this->session->userdata('persen_uts')) * $row->uts / 100) +
                                        ( simple_decrypt($this->session->userdata('persen_uas')) * $row->uas / 100) 
                                      )
                                      ;?> &nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp; <?php echo (empty($row->nilai))? 'E':$row->nilai; ?></td>
                                </tr>

<?php 
$i++;
endforeach;
?>
                                  
                                  </tbody>
                              </table>

                              </form>


                              <!-- ttd dosen -->
                              <table align="right" style="margin-right:100px;">
                                <tr align="center">
                                  <td><b>Dosen Mata Kuliah</b></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr align="center">
                                  <td><b>( <?php echo str_replace('*', " $nama_asli, ", $gelar) ;?> )</b></td>
                                </tr>
                              </table>
                              <!-- -->

                        </div>
                        

                  


<table style="margin:30px 0 50px 100px;width:100%;">

  <tr>
    <td><button type="submit" title="cetak" class="btn btn-primary blue" id="ok_total" onclick="cetak_data();"><i class="icon-print"></i> CETAK</button></td>
    <td><button type="submit" title="selesai" class="btn btn-primary blue" id="ok_total" onclick="location.href='<?=base_url();?>e_dosen/cetak_nilai'"><i class="icon-share"></i> SELESAI</button></td>
  </tr>
</table>
<br>

                  

                    </div>
                    <!-- END EXAMPLE TABLE widget-->
               
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
   