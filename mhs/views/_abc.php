
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
				  
				  
				  
				  
                   <h3 class="page-title">
                       Kuesioner Matakuliah Penilaian Dosen
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
               
			   
			   <div class="alert alert-info">
					<blink>
					<i>Harap mengisi Kuesioner terlebih dahulu agar dapat mengakses E-Learning. <br>Jumlah Kuesioner yang harus Anda isi: </i>
					<b> <?php echo $jumlah_kuesioner_telah_diisi;?>/<?php echo $jumlah_kuesioner_harus_diisi;?></b>
					</blink>
                  </div>
				  
				  
				  
                  <!-- BEGIN ADVANCED TABLE widget-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN EXAMPLE TABLE widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-pencil"></i> Kuesioner Mata Kuliah</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>


                              <h3 align="center">KUESIONER PENILAIAN DOSEN OLEH MAHASISWA</h3>
                        <div class="widget-body"  id="cetak">
                          <table class="table table-striped">
                            <tr>
                              <td>Program Studi</td>
                              <td>:</td>
                              <td><?php echo ucwords($this->session->userdata('jurusan')); ?></td>
                            </tr>
                            <tr>
                              <td>Nama Dosen</td>
                              <td>:</td>
                              <td><b><?php echo ucwords($nama_dosen); ?></b></td>
                            </tr>
                            <tr>
                              <td>Mata Kuliah</td>
                              <td>:</td>
                              <td><b><?php echo ucwords($mata_kuliah); ?></b></td>
                            </tr>
                            <tr>
                              <td>Semester/SKS</td>
                              <td>:</td>
                              <td><b>Semester <?php echo ucwords($semester); ?> SKS</b></td>
                            </tr>
                            <tr>
                              <td>Keterangan</td>
                              <td>:</td>
                              <td>1. Isilah Kuesioner ini sesuai kondisi yang Anda alami. Masukan Anda sangat berguna untuk meningkatkan kualitas perkuliahan.<br>
                                2. Pilihlah salah satu pada skor yang Anda pilih<br>
                                3. Setiap pernyataan diberikan 4 pilihan dengan keterangan sebagai berikut<br>
                                <b>1=tidak puas, 2=cukup puas, 3=puas, 4=sangat puas</b></td>
                            </tr>
                          </table>

<script type="text/javascript">

function simpan() {

        //loading muncul
        $("#loading").css({ "display": "block" });

        //var nilai = new Object();
        var kues = $('#sums').serializeArray(); 
        var azz = $('#azz').serializeArray(); 
        //alert(JSON.stringify(azz));

        $.ajax({
                type : "post",
                data: {id_jadual: <?php echo $id_jadual; ?>,
                        nim: <?php echo $this->session->userdata('nim'); ?>,
                        kues: kues,
                        azz: azz,
                    }, 
                    
                url : "<?php echo base_url();?>mhs/simpan_kues_mhs",
                success : function(data) {
                    //alert(data);
                    $("#loading").css({ "display": "none" });
                    $("#pesan_sukses").css({ "display": "block" });
                    //alert(JSON.stringify(data));
                    //alert(data.join("\n"));
                    //window.open(data, '_self');
                    location.reload();
                }
            });



}
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

input[type="radio"]{
  cursor: pointer;
}

.radio input[type="radio"],
.checkbox input[type="checkbox"] {
  float: left;
  margin-left: 0px;
}

#msg {display:none; position:absolute; z-index:200; background:url(images/msg_arrow.gif) left center no-repeat; padding-left:7px}
#msgcontent {display:block; background:#f3e6e6; border:2px solid #924949; border-left:none; padding:5px; min-width:150px; max-width:250px}
</style>


<script>
function myFunction()
{
var nilai = $('#sums').serializeArray(); 

//alert(nilai.length);
if (nilai.length !=31) {
  //alert('Pilihan Score Kuesioner harus diisi. Silahkan cek kembali inputan Anda!'); 
  //loading muncul
  $("#pesan_gagal").css({ "display": "block" });
}else{
  //alert('sudah diinput semua');
  simpan();
};
//alert(JSON.stringify(nilai));
//alert(nilai[12]['value']);

}


function checkAlphaNumeric(e) {
            //alert( "keyCode for the key pressed: " + e.keyCode + "\n" );
            if (e.keyCode == 8 || e.keyCode == 32 || e.keyCode == 44 || e.keyCode == 144 ||  e.keyCode == 188 || 
              (e.keyCode >= 48 && e.keyCode <= 57) ||
               (e.keyCode >= 65 && e.keyCode <= 90) ||
               (e.keyCode >= 97 && e.keyCode <= 122))
            {
                  return true;
            }else{
                   return false;
            }              

           
}
</script>
<script src="<?=base_url();?>assets/js/forbidden.js"></script>

 
                            <br>
                               <form id="sums">
                              <table class="table table-striped table-bordered table-hover" id="">
                                  <thead style="vertical-align:center;">
                                      <tr>
                                        <th rowspan="2"><h4>No.</h4></th>
                                        <th rowspan="2"><h4>Aspek yang dinilai</h4></th>
                                        <th colspan="4">Skor</th>
                                      </tr>
                                      <tr>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                      </tr>
                                  </thead>
                                  <tbody  id="hasil_pencarian">
                                    <tr class="odd gradeX">
                                    <td colspan="6" style="background:#E5E5E5;"><h4>Kompetensi Andragogik</h4></td>
                                </tr>
                                 
<?php $i=1;$y='';$z=1;
if ( !empty($pertanyaan) )
foreach($pertanyaan->result() as $row)
:?>


      <?php if ($row->parent_pertanyaan !=$z) {
      
      ?>

                                <tr class="odd gradeX">
                                    <td colspan="6" style="background:#E5E5E5;"><h4><?php echo $row->master; ?></h4></td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row->isi_pertanyaan; ?> <em style="color:red;">*</em></td>
                                    <td><input type="radio" name="pilihan[<?php echo $i; ?>]" value="1" id="pilihan[<?php echo $i; ?>]"></td>
                                    <td><input type="radio" name="pilihan[<?php echo $i; ?>]" value="2" id="pilihan[<?php echo $i; ?>]"></td>
                                    <td><input type="radio" name="pilihan[<?php echo $i; ?>]" value="3" id="pilihan[<?php echo $i; ?>]"></td>
                                    <td><input type="radio" name="pilihan[<?php echo $i; ?>]" value="4" id="pilihan[<?php echo $i; ?>]"></td>
                                </tr>

      <?php
        } else {
      ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row->isi_pertanyaan; ?> <em style="color:red;">*</em></td>
                                    <td><input type="radio" name="pilihan[<?php echo $i; ?>]" value="1" id="pilihan[<?php echo $i; ?>]"></td>
                                    <td><input type="radio" name="pilihan[<?php echo $i; ?>]" value="2" id="pilihan[<?php echo $i; ?>]"></td>
                                    <td><input type="radio" name="pilihan[<?php echo $i; ?>]" value="3" id="pilihan[<?php echo $i; ?>]"></td>
                                    <td><input type="radio" name="pilihan[<?php echo $i; ?>]" value="4" id="pilihan[<?php echo $i; ?>]"></td>
                                </tr>

      <?php
        }
      ?>

<?php 
$i++;
$z=$row->parent_pertanyaan;
endforeach;
?>
                                  
                                  </tbody>
                              </table>
                              </form>

                              <form id="azz">
                              <table>
                                <tr>
                                  <td></td>
                                  <td>Saran dan kritik Anda berkaitan dengan aspek suasana perkuliahan (optional)<br><i>jika anda tidak dapat input pada textbox silahkan gunakan browser chrome</i></td>
                                </tr>
                                <tr>
                                  <td>1.</td>
                                  <td>Sarana prasarana</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>
                                    <input type="text" name="1"  maxlength="200" onkeypress="return checkAlphaNumeric(event);" style="width:100%;height:100px;">
                                  </td>
                                </tr>
                                <tr>
                                  <td>2.</td>
                                  <td>Materi dan proses pembelajaran</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>
                                    <input type="text" name="2"  maxlength="200" onkeypress="return checkAlphaNumeric(event);" style="width:100%;height:100px;">
                                  </td>
                                </tr>
                                <tr>
                                  <td>3.</td>
                                  <td>Metode evaluasi dan sistem penilaian</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>
                                    <input type="text" name="3"  maxlength="200" onkeypress="return checkAlphaNumeric(event);" style="width:100%;height:100px;">
                                  </td>
                                </tr>
                              </table>
                              </form>

                        </div>



                  <div id="loading" style="display:none;" align="center"><p>Mohon tunggu, data nilai Mahasiswa sedang diproses</p><img src="<?=base_url();?>images/loader.gif" title="Loading" /></div>

                  <div class="alert alert-error" id="pesan_gagal" style="display:none;">
                    <button class="close" onclick="document.getElementById('pesan_gagal').style.display='none';return false;">×</button>
                    <strong>Input Gagal!</strong> Masih ada kuesioner yang belum dipilih, Silahkan cek kembali!
                  </div>

<table style="margin:30px 0 50px 80px;width:100%;">

  <tr>
    <td><button type="submit" title="simpan" style="background-color:red;" class="btn btn-primary blue" id="kunci" onclick="myFunction();"><i class="icon-lock"></i>  SIMPAN</button></td>
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
   