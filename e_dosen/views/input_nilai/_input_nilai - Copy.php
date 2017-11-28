
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                       Input Nilai Mahasiswa
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
               

                  <!-- BEGIN ADVANCED TABLE widget-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN EXAMPLE TABLE widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i>Tabel Input Nilai</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                          <table class="table table-striped">
                            <tr>
                              <td>Nama Dosen</td>
                              <td><?php echo $this->session->userdata('nama_asli');?></td>
                            </tr>
                            <tr>
                              <td>Mata Kuliah</td>
                              <td><div class="controls">
                                        <select class="span6" name="pilihan_matkul" id="pilihan_matkul">
<?php 
if ( !empty($mata_kuliah_terakhir) )
foreach($mata_kuliah_terakhir->result() as $row)
:?>
                                            <option value="<?php echo $row->id_jadual; ?>"><?php echo $row->nama; ?></option>
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
                                Tugas <input type="text" name="bobot_tugas" class="input-mini" maxlength="3" value="0"/>  
                                UTS <input type="text" name="bobot_uts" class="input-mini" maxlength="3" value="0"/>  
                                UAS <input type="text" name="bobot_uas" class="input-mini" maxlength="3" value="0"/> 
                                TOTAL <input type="text" style="border:none;background:#ffc1c1;" name="total" class="input-mini" id="total" readonly/>
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td><button type="submit" class="btn blue" id="ok_total" disabled="disabled" onclick="searchDetails();"><i class="icon-ok"></i> Cek Data Mahsiswa</button></td>
                            </tr>
                          </table>
                          
<script type="text/javascript">

  function searchDetails() {

            $.ajax({
                type : "post",
                data: "id_jadual="+$("#pilihan_matkul").val(),
                url : "<?php echo base_url();?>/e_dosen/input_nilai/check_mhs_list",
                cache : false,
                success : function(data) {
                    //alert(data);
                    //$('#hasil_pencarian table > tbody:first').append(data);
                    $('#hasil_pencarian').html(data);

                }
            });

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
        
    });


    
});

</script>
                          <hr>
                            <table class="table table-striped table-bordered" id="sample_1">
                            <thead>
                                <tr>
                                  <th>No.</th>
                                  <th>NIM</th>
                                  <th>Nama Mahasiswa</th>
                                  <th>Tugas</th>
                                    <th>UTS</th>
                                    <th>UAS</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody id="hasil_pencarian">
                              <tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr><tr class="odd gradeX">
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                                    <td>s</td>
                              <tr>


                            </tbody>
                        </table>
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
   