
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   

            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
		
<style type="text/css" media="print">


body {
color: #000;
font-family: 'Arial';
padding: 0px !important;
margin: 0px !important;
font-size: 1px;
}

.print {
     position: fixed;
     overflow: auto;
     width: 100%;
     height: 100%;
     z-index: 100000; /* CSS doesn't support infinity */

     /* Any other Print Properties */
}
</style>		  



				  
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
               

								  
				  
                  <!-- BEGIN ADVANCED TABLE widget-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN EXAMPLE TABLE widget-->
                    <div class="widget">
                        <div class="widget-title">
							<h4><i class="icon-pencil"></i> Rincian Nilai Kuesioner</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
<div class="widget-body"  id="cetak">  


                              <h3 align="center">SEKOLAH TINGGI MANAJEMEN INDUSTRI <br> KUESIONER PENILAIAN DOSEN OLEH MAHASISWA</h3>
                        <div class="widget-body"  id="cetak">
                          <table class="table table-striped">
						  <tr>
                              <td>Program Studi</td>
                              <td>:</td>
                              <td><b><?php echo ucwords($jurusan); ?></b></td>
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
                              <td><b> <?php echo ucwords($semester); ?> / <?php echo ucwords($sks); ?> SKS</b></td>
                            </tr>
							
							<tr>
                              <td>Rata-rata</td>
                              <td>:</td>
                              <td><b> <?php echo $total; ?>  </b></td>
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


<script>
function Print(divID) {
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
</script> 
<script src="<?=base_url();?>assets/js/forbidden.js"></script>

 
                            <br>
                               <form id="sums">
                              <table class="table table-striped table-bordered table-hover" id="">
                                  <thead style="vertical-align:center;">
                                      <tr>
                                        <th rowspan="2"><h4>No.</h4></th>
                                        <th rowspan="2"><h4>Aspek yang dinilai</h4></th>
										<th >Nilai</th>
                                      </tr>
                                  </thead>
                                  <tbody  id="hasil_pencarian">
                                    <tr class="odd gradeX">
                                    <td colspan="3" style="background:#E5E5E5;"><h4>Kompetensi Andragogik</h4></td>
                                </tr>
                                 
<?php $i=1;$y='';$z=1;
if ( !empty($pertanyaan) )
foreach($pertanyaan->result() as $row)
:?>


      <?php if ($row->parent_pertanyaan !=$z) {
      
      ?>
	
								</tr>
								 <tr class="odd gradeX">
									<td colspan="2"><h4>Subtotal</h4></td>
									<td><h4><?php echo $subtotal[$i-1]; ?></h4></td>
                                </tr>
								
                                <tr class="odd gradeX">
                                    <td colspan="3" style="background:#E5E5E5;"><h4><?php echo $row->master; ?></h4></td>
                                </tr>
								
								
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row->isi_pertanyaan; ?> <em style="color:red;">*</em></td>
                                    <td>
									<?php echo $nilai[$i]; ?>
									</td>
                                </tr>

      <?php
        } else {
      ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
									<td><?php echo $row->isi_pertanyaan; ?> <em style="color:red;">*</em></td>
									<td>
									<?php echo $nilai[$i]; ?>
									</td>
                                </tr>
								

      <?php
        }
      ?>
								
								 
<?php 
$i++;
$z=$row->parent_pertanyaan;
endforeach;
?>
                                  <tr class="odd gradeX">
									<td colspan="2"><h4>Subtotal</h4></td>
									<td><h4><?php echo $subtotal[31]; ?></h4></td>
                                </tr>
								
                                  </tbody>
                              </table>
                              </form>

                              <form id="azz">
                              <table>
                                <tr>
                                  <td></td>
                                  <td>Saran dan kritik Anda berkaitan dengan aspek suasana perkuliahan (optional)<br></td>
                                </tr>
                                <tr>
                                  <td>1.</td>
                                  <td>Sarana prasarana</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>
									<?php echo ( empty($op[1]) ) ? '<i>Keterangan Optional Tidak Tersedia</i><br>' : $op[1]; ?><br>
                                  </td>
                                </tr>
                                <tr>
                                  <td>2.</td>
                                  <td>Materi dan proses pembelajaran</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>
                                     <?php echo ( empty($op[2]) ) ? '<i>Keterangan Optional Tidak Tersedia</i><br>' : $op[2]; ?><br>
                                  </td>
                                </tr>
                                <tr>
                                  <td>3.</td>
                                  <td>Metode evaluasi dan sistem penilaian</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>
                                     <?php echo ( empty($op[3]) ) ? '<i>Keterangan Optional Tidak Tersedia</i><br>' : $op[3]; ?><br>
                                  </td>
                                </tr>
                              </table>
                              </form>

</div>
                        </div>
 <table style="margin:30px 0 50px 100px;width:100%;">
  <tr>
	<td><button type="submit" title="cetak" class="btn btn-primary blue" id="ok_total"  onclick="javascript:Print('cetak')" ><i class="icon-print"></i> CETAK</button></td>
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
   