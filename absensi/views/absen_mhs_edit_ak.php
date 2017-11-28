
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
				  
				  
				  
				  
                   <h3 class="page-title">
                       Absensi Mahasiswa Edit
                  </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="<?=base_url();?>e_dosen"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                       </li>
                       <li>
                           Absensi Mahasiswa <span class="divider-last">&nbsp;</span>
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
                            <h4><i class="icon-pencil"></i> Absen Mata Kuliah</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>


                      
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
</script>
<script src="<?=base_url();?>assets/js/forbidden.js"></script>
                            <br>
                             
<?php
echo form_open('absensi/simpan_absen_edit_ak/'.$record2->id_jadual);
?>
<input class="form-control" type="text" name="id_absen"   value="<?php echo $record2->id_absen; ?>" readonly/>
                              <table class="table table-striped table-bordered table-hover" id="">
                                  <thead style="vertical-align:center;">
                                      <tr>
                                        <tr>
                                        <th>Nim</th>
                                        <th>Nama</th>
                                        <th colspan="5">Operasi</th>
                                      </tr>                                      
                                  </thead>
                                  <tbody  >                                    
<?php
$no = 1;
$i=0;
foreach ($record as $r ) {
echo "
  <tr>
    <td><input type= 'hidden' name = 'nim[]' value = '$r->nim' readonly />$r->nim</td>
    <td>$r->nama</td>";

    echo "  <td > <input type= 'radio' name='jurusan[".$i."]' value='1' ";
    if($r->status_absen == '1'){
      echo "checked"; 
    }
      echo "> Masuk </td>";

    echo "  <td > <input type= 'radio' name='jurusan[".$i."]' value='2' ";
    if($r->status_absen == '2'){
      echo "checked"; 
    }
      echo "> Sakit </td>";
      
    echo "  <td > <input type= 'radio' name='jurusan[".$i."]' value='3' ";
    if($r->status_absen == '3'){
      echo "checked"; 
    }
      echo "> Izin </td>";
    
    echo "  <td > <input type= 'radio' name='jurusan[".$i."]' value='4' ";
    if($r->status_absen == '4'){
      echo "checked"; 
    }
      echo "> Terlambat </td>";

    echo "  <td > <input type= 'radio' name='jurusan[".$i."]' value='5' ";
    if($r->status_absen == '5'){
      echo "checked"; 
    }
      echo "> Tanpa Keterangan </td>";        

    
echo "</tr>";

/*echo "
  <tr>
    <td>$r->nim</td>
    <td>$r->nama</td>
    <td ><input type= 'radio' name='jurusan[]' value='1' checked> Masuk </td>
      <td > <input type= 'radio' name='jurusan[]' value='2'> Sakit </td>
      <td > <input type= 'radio' name='jurusan[]' value='3'> Izin </td>
      <td > <input type= 'radio' name='jurusan[]' value='4'> Terlambat </td>
      <td > <input type= 'radio' name='jurusan[]' value='5'> Tanpa Keterangan 
     </td>
  </tr>
";*/
$no++;
$i++;
}
?>

                                  </tbody>
                              </table>
                        </div>


              

<table style="margin:30px 0 50px 80px;width:100%;">

  <tr>
    <td> <button type="submit"  style="background-color:red;" class="btn btn-primary blue"  ><i class="icon-lock"></i>  SIMPAN</button></td>
    <td>   <?php echo anchor('absensi/absen_detail/'.$id_jadual,'Kembali',array('class'=> 'btn btn-primary blue','style'=>'background-color:blue'));?>
  </td> 
  </tr>
</table>
</form>
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
   