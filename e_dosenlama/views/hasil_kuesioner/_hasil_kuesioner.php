
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                       DAFTAR NILAI KUESIONER MAHASISWA
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
							<h4><i class="icon-reorder"></i> Daftar Thn. Akademik / Periode</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                      

                          <!-- Rincian Matkul Dosen -->
                          <div id="url_nilai" ></div>
                          
                          <table class="table table-striped">
                            <tr>
                              <td>Thn. Akademik / Periode</td>
                              <td><div class="controls">
                                        <select class="span7" name="pilihan_periode" id="pilihan_periode">
                                          <option value="0" id="pilih">----pilih----</option>
<?php 
if ( !empty($thn_akademik_kuesioner) )
foreach($thn_akademik_kuesioner->result() as $row)
:
?>


                                            <option value="<?php echo $row->thn_akademik.'_'.$row->periode; ?>" >
                                              <?php 
											  $kt= ( $row->periode == 1) ? 'Ganjil' : 'Genap' ;
											  echo $row->thn_akademik.' --- '.$kt; ?>
                                            </option>
<?php 

endforeach;
?>
                                        </select>
                                    </div>
                              </td>

                            <tr>
                              <td></td>
                             <!-- <td><button type="submit" class="btn blue" id="ok_total" disabled="disabled" onclick="urlUbah();"><i class="icon-ok"></i> RINCIAN MATAKULIAH</button></td>-->
                            </tr>
                          </table>
                          </form>
                          <!-- Rincian Matkul Dosen -->

						  
<script type="text/javascript">

$('#pilihan_periode').on("change",function() {
	
	//loading muncul
    $("#loading").css({ "display": "block" });
	
   //Your code here
   document.getElementById("pilih").disabled = true;
   var a=$("#pilihan_periode").val();
   //alert(a);
   if (a!=0) {

    $.ajax({
                type : "post",
				data: {thn_periode: a ,
                    },   
                url : "<?php echo base_url();?>/e_dosen/hasil_kuesioner/get_mata_kuliah_kues",
                success : function(data) {
					//alert(data);
					$("#loading").css({ "display": "none" });
					
					document.getElementById("demo").innerHTML = data;
                }
            });

   };
          
});

  function urlUbah() {


      var a=$("#pilihan_periode").val();
      if (a!=0) {



        $.ajax({
                type : "post",
                data: {id_jadual: +$("#pilihan_periode").val(),
                      bobot_tugas: +$('input[name=bobot_tugas]').val(),
                      bobot_uts: +$('input[name=bobot_uts]').val(),
                      bobot_uas: +$('input[name=bobot_uas]').val(),
                    },
                    
                url : "<?php echo base_url();?>/e_dosen/cetak_nilai/ubah_url",
                cache : false,
                context: document.body,
                async:false,   //Send Synchronously
                success : function(data) {
                    //alert(data);
                    //$('#url_nilai').attr("action",  data);
                    //$('#url_nilai').html(data);
                    window.open(data, '_blank');
                }
            });




      };

            




    }

$(document).ready(function() {

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

    $(".input-mini").keyup(function() {


      var a=$("#pilihan_periode").val();
      if (a!=0) {


          var sum = parseInt($('input[name=bobot_tugas]').val(), 10);
              sum += parseInt($('input[name=bobot_uts]').val(), 10);
              sum += parseInt($('input[name=bobot_uas]').val(), 10);
              sum = isNaN(sum) ? 'data krg' : sum;
              $("#total").val(sum);
              if (sum==100) {
                total.style.backgroundColor="#4fff75";
                document.getElementById("ok_total").disabled = false;
              }else{
                total.style.backgroundColor="#ffc1c1";
                document.getElementById("ok_total").disabled = true;
              };


      };
              




        
    });


    
});

</script>
<style type="text/css">
  select option[disabled] { background-color: #ffafaf;}
</style>

                            
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE widget-->
               
            </div>

            <!-- END ADVANCED TABLE widget-->


			
			
			
			
			

            <div class="row-fluid">
                <div class="span12">
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Daftar Nilai Kuesioner</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                         
<!--
						 <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
								  <th></th>
                                  <th>No Urut</th>
                                  <th>Cetak</th>
                                  <th>ID Jadual</th>
                                  <th>Mata Kuliah</th>
                                  <th>Kelas</th>
                                  <th>Dosen</th>
                                  <th>Waktu Input Terakhir</th>
                                </tr>
                            </thead>
                            <tbody>


                                </tbody>
                        </table>
 -->
<div id="loading" style="display:none;color:red;" align="left"><p>Mohon tunggu..</p><img src="<?=base_url();?>images/loader33.gif" title="Loading" /></div>

<span id="demo"></span> 
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
   