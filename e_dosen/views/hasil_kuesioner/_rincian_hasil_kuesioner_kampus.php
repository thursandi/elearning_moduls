
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


</style>	
				  
				  
                   <h3 class="page-title">
                       Kuesioner Penilaian Kinerja STMI
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="<?=base_url();?>e_dosen"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                       </li>
                       <li>
                           Kuesioner Penilaian Kinerja STMI <span class="divider-last">&nbsp;</span>
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

                              <h3 align="center"> <?php echo strtoupper("KUISIONER TINGKAT $tipe_kues_pertanyaan<br> MAHASISWA TERHADAP KINERJA SEKOLAH TINGGI MANAJEMEN INDUSTRI<br>TAHUN AKADEMIK $thn_akademik PERIODE ").($periode==1? 'GANJIL' : 'GENAP' );
                              ?></h3>

                              
                        <div class="widget-body"  id="cetak">
                         


<script type="text/javascript">

function simpan() {

        //loading muncul
        $("#loading").css({ "display": "block" });

        //var nilai = new Object();
        var kues = $('#sums').serializeArray(); 
        //var azz = $('#azz').serializeArray(); 
        //alert(JSON.stringify(azz));

        $.ajax({
                type : "post",
                data: {id_jadual: <?php echo ($jumlah_kuesioner_kampus+1); ?>,
                        nim: <?php echo $this->session->userdata('nim'); ?>,
                        kues: kues,
                       // azz: azz,
                    }, 
                    
                url : "<?php echo base_url();?>mhs/simpan_kues_kampus",
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
if (nilai.length !=27) {
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
</script>
<script src="<?=base_url();?>assets/js/forbidden.js"></script>

 
                            <br>
                               <form id="sums">
                              <table class="table table-striped table-bordered table-hover" id="">
                                  <thead style="vertical-align:center;">
                                      <tr>
                                        <th rowspan="2"><h4>No.</h4></th>
                                        <th rowspan="2"><h4>Aspek yang dinilai</h4></th>
                                        <th>Nilai</th>
                                      </tr>
                                  </thead>
                                  <tbody  id="hasil_pencarian">
                                 
<?php $i=1;$y='';
//$z=1;
if ( !empty($pertanyaan) )
foreach($pertanyaan->result() as $row)
:?>

                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row->isi_pertanyaan; ?> <em style="color:red;">*</em></td>
                                    <td>
									<?php echo $nilai[$i]; ?>
									</td>
                                </tr>


<?php 
$i++;
//$z=$row->parent_pertanyaan;
endforeach;
?>
								<tr class="odd gradeX">
									<td colspan="2"><h4>Subtotal</h4></td>
									<td><h4><?php echo $subtotal[27]; ?></h4></td>
                                </tr>
                                  
                                  </tbody>
                              </table>
                              </form>
</div>
                        </div>



 <table style="margin:30px 0 50px 100px;width:100%;">
  <tr>
    <td><button type="submit" title="cetak" class="btn btn-primary blue" id="ok_total" onclick="printDiv('cetak');"><i class="icon-print"></i> CETAK</button></td>
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
   