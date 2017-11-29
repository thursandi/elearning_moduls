<?
//include "Koneksi.php";
//include "cekSession.php";
//$query=mysql_query("SELECT MAX(id_user) as max_id FROM user");
//$result=mysql_fetch_array($query);
//$maxid=$result['max_id'];
//$no_urut=substr($maxid,-3);
//$new_urut=$no_urut+1;
//$id_user="U".sprintf("%03s",$new_urut);
?>


<script language="javascript">
    function hanyaAngka(e, decimal) {
    var key;
    var keychar;
     if (window.event) {
         key = window.event.keyCode;
     } else
     if (e) {
         key = e.which;
     } else return true;
   
    keychar = String.fromCharCode(key);
    if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
        return true;
    } else
    if ((("0123456789").indexOf(keychar) > -1)) {
        return true;
    } else
    if (decimal && (keychar == ".")) {
        return true;
    } else return false;
    }
</script>


<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
include "Header.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<?php
//include "menu.php";
?>
<div id="konten">
<h3 align="center">Input Penambahan Biodata Mahasiswa</h3>
<form id="form1" name="form1" method="post" action="aksi.php" enctype="multipart/form-data">
  <table align="center" width="300" border="0" cellpadding="3" cellspacing="2">
    <tr>
      <td>NIM</td>
      <td><tabel>:</tabel></td>
      <td><input type="text" name="nim" id="nim" maxlength="7" onkeypress="return hanyaAngka(event, false)" value="<?php //echo $id_user; ?>"/></td>
    </tr>
    <tr>
      <td>No. KTP (NIK)</td>
      <td><tabel>:</tabel></td>
      <td><input type="text" name="nik" id="nik" maxlength="16" onkeypress="return hanyaAngka(event, false)" /></td>
    </tr>
    <tr>
      <td>Nama Ibu Kandung</td>
      <td><label for="nm_ibu">:</label></td>
      <td><input type="text" name="nm_ibu" id="nm_ibu" /></td>
    </tr>
    <td></td><td><td><br />Upload File KTP, Akte Kelahiran, Ijazah (SD, SMP, SMA/SMK)
    <tr>
      <td>
      <td></td><td><input type="file" name="file"/></td>
      <!--td><input type="submit" name="upload" value="Upload"/></td></tr-->
    </tr>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="simpan" id="simpan" value="Simpan" /></td>
    </tr>
  </table>
</form>
</div>
<?php
include "Footer.php";
?>
</body>
</html>