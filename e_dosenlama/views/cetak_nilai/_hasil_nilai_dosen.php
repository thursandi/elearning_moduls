
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                       CETAK NILAI TERKUNCI
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
                            <h4><i class="icon-reorder"></i>Daftar Mata Kuliah Terkunci</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                      

                          <!-- Rincian Matkul Dosen -->
                          <div id="url_nilai" ></div>
                          
                          <table class="table table-striped">
                            <tr>
                              <td>Nama Dosen</td>
                              <td><?php echo str_replace('*', " $nama_asli, ", $gelar) ;?></td>
                            </tr>
                            <tr>
                              <td>Mata Kuliah</td>
                              <td><div class="controls">
                                        <select class="span8" name="pilihan_matkul" id="pilihan_matkul">
                                          <option value="0" id="pilih">----pilih----</option>
<?php 
if ( !empty($mata_kuliah_dosen_terkunci) )
foreach($mata_kuliah_dosen_terkunci->result() as $row)
:?>
                                            <option value="<?php echo $row->id_jadual; ?>">
                                              <?php echo $row->id_jadual.' --- '.$row->nama.' --- '.$row->kelas.' --- '.hari_nama($row->id_hari).', '.$row->jam_mulai.' - '.$row->jam_selesai; ?>
                                            </option>
<?php 
endforeach;
?>
                                        </select>
                                    </div>
                              </td>
                            </tr>
                            <tr>
                              <td>Bobot (dalam %)</td>
                              <td>
                                Tugas <input type="text" name="bobot_tugas" class="input-mini" maxlength="3" value="0" readonly/>&nbsp;&nbsp;&nbsp;&nbsp;  
                                UTS <input type="text" name="bobot_uts" class="input-mini" maxlength="3" value="0" readonly/> &nbsp;&nbsp;&nbsp;&nbsp; 
                                UAS <input type="text" name="bobot_uas" class="input-mini" maxlength="3" value="0" readonly/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                TOTAL <input type="text" style="border:none;background:#ffc1c1;" name="total" class="input-mini" id="total" readonly/>
                
                <div id="loading" style="display:none;color:red;" align="left"><p>Mohon tunggu.. Mohon jangan klik tombol input nilai sebelum loading menghilang...</p><img src="<?=base_url();?>images/loader33.gif" title="Loading" /></div>
                
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td><button type="submit" class="btn blue" id="ok_total" disabled="disabled" onclick="urlUbah();"><i class="icon-ok"></i> Lihat Rincian Nilai Mahasiswa</button></td>
                            </tr>
                          </table>
                          </form>
                          <!-- Rincian Matkul Dosen -->

      
<script type="text/javascript">

$('#pilihan_matkul').on("change",function() {
  
  //loading muncul
    $("#loading").css({ "display": "block" });
    
   //Your code here
   document.getElementById("pilih").disabled = true;
   var a=$("#pilihan_matkul").val();
   if (a!=0) {

    $.ajax({
                type : "post",
                data: {id_jadual: +$("#pilihan_matkul").val(),
                    },   
                url : "<?php echo base_url();?>/e_dosen/hasil_input_nilai_dosen/cek_bobot",
                success : function(data) {
          $("#loading").css({ "display": "none" });
          
                    //alert(data);
                    var bobotPisah = data.split("-");
                    //alert(bobotPisah[0]);
                    $('input[name=bobot_tugas]').val(bobotPisah[0]);
                    $('input[name=bobot_uts]').val(bobotPisah[1]);
                    $('input[name=bobot_uas]').val(bobotPisah[2]);

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



                }
            });

   };
          
});

  function urlUbah() {


      var a=$("#pilihan_matkul").val();
      if (a!=0) {



        $.ajax({
                type : "post",
                data: {id_jadual: +$("#pilihan_matkul").val(),
                      bobot_tugas: +$('input[name=bobot_tugas]').val(),
                      bobot_uts: +$('input[name=bobot_uts]').val(),
                      bobot_uas: +$('input[name=bobot_uas]').val(),
                    },
                    
                url : "<?php echo base_url();?>/e_dosen/hasil_input_nilai_dosen/ubah_url",
                cache : false,
                context: document.body,
                async:false,   //Send Synchronously
                success : function(data) {
                    //alert(data);
                    //$('#url_nilai').attr("action",  data);
                    //$('#url_nilai').html(data);
                    window.open(data, '_self');
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


      var a=$("#pilihan_matkul").val();
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


               </div>
            </div>
            <!-- END PAGE CONTENT-->         
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
   </div>
   <!-- END CONTAINER -->
   