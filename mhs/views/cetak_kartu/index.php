<?php
include "base.php";

$page->hideLeftPane();
$page->setOnLoad("");
$page->show();
$periode= getLastPeriode();
$thn_akademik = getLastTA();
?>
<font size=3><b>Cetak Kartu</b></font><br><br>

<form target="_blank" action="cetak_save.php" method="post">

<table border=0 width="90%">
<tr><td>Mahasiswa</td><td>NIM mulai 
<input type="text" name="nimmulai" size=7 maxlength=7 > s.d. 
<input type="text" name="nimselesai" size=7 maxlength=7 >
<br>
<font color="#FF0000">Jika hanya satu mahasiswa maka kosongkan field nim yang kedua</font>
</td></tr>
<tr>
	<td>Periode</td><td><select name="periode">
	<option value='1' <?php if ($periode==1) echo "selected"; ?>> Ganjil </option>
	<option value='2' <?php if ($periode==2) echo "selected"; ?>> Genap </option>
	
	</select>
	</td>
</tr>
<tr>
	<td>Tahun Akademik</td>
	<td><select name="thn_akademik">
	<?php 
	$y=date("Y");
	$n = $y-10;
	for ($i=$y;$i>=$n;$i--){
		echo "<option value=$i ";
		if ($thn_akademik==$i) echo "selected";
		echo "> $i </option>";
	}
	?>
	</select>
	</td>
</tr>

</table><br>

<br><br><table border=1 cellpadding=4 cellspacing=0>
<tr bgcolor="red"><td><input type="submit" name="action" value="Cetak_KST"></td><td><input type="submit" name="action" value="Cetak_KHS"></td><td><input type="submit" name="action" value="Cetak_Transkrip"></td><td><input type="submit" name="action" value="Kartu_Ujian"></td></tr>

</table><br>
</form>
<?php
$page->bottom();
?>
