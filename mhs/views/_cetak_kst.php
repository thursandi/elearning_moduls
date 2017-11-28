<?php 
echo "<style type=\"text/css\">
	td {font-family:\"arial\"; font-size:10pt}
	a {text-decoration:none;}
	table{
		border-collapse:collapse;	
	}
	a:hover {color:red}
	textarea {font-family:\"arial\"; font-size:9pt}
	input {font-family:\"arial\"; font-size:9pt}
	.style1 {border: 1px solid black;}
	.style2 {page-break-after:always;
	border: 1px solid black;}
	</style>"
?>

<?php
include "base.php";



if (!$_SESSION['login_tmp']){
	session_destroy();
	header("Location:http://intranet.stmi.ac.id/sisformik/krs/init.php");
	exit();
}

$___nim = $_SESSION['nim_tmp'];
$___nama = $_SESSION['nama_tmp'];


//$prodi=getAngkatan($___nim);
$lastIP=number_format(getLastIPS($___nim, $PERIODE, $TA),2,",",".");

//if ($lastIP >= 3){
	//header("Location:http://intranet.stmi.ac.id/sisformik/krs_tmp/");
	//topage("./?");
//}else{
	//header("Location:http://intranet.stmi.ac.id/sisformik/krs/");
	//topage("./?");
//}

$jml_sks=getJmlSKS()+0;
$jatah=getJatahSKS();

$masih_boleh_ambil=($jml_sks<$jatah);
$str_periode=getStrPeriodeTA($PERIODE, $TA);
$date=date('dmY');
if (empty($date)){
	$date = "";
}else{
$tgl = $date;
}

function getJurusan($___nim){
	if ((substr($___nim,1,1)==1) or (substr($___nim,1,1)==2)) {
		$data =  "Teknik dan Manajemen Industri";
	}else if ((substr($___nim,1,1)==3) or (substr($___nim,1,1)==4)) {
		$data = "Sistem Informasi";
	}else if ((substr($___nim,1,1)==5) or (substr($___nim,1,1)==6))  {
		$data =  "Teknologi Kimia Industri";
	}else if ((substr($___nim,1,1)==7) or (substr($___nim,1,1)==8))  {
		$data =  "Manajemen Bisnis Industri";
	} else {
		$data = "Tenaga Penyuluh Lapangan";
	}
	return $data;
}
?>
<center>
<table border=0 width="650" cellpadding=0 cellspacing=0>
			<tr><td rowspan=5><img src="../images/logo_stmi.jpg" width=70 height=70>
			</td><td align="center"><b>KEMENTERIAN PERINDUSTRIAN R.I.</b></td></tr>
			<tr><td align="center" ><b>POLITEKNIK STMI JAKARTA</b></td></tr>
			<tr><td align="center" ><b>d.h. SEKOLAH TINGGI MANAJEMEN INDUSTRI</b></td></tr>
			<tr><td align="center">Jl. Letjen Suprapto No. 26 Cempaka Putih, Jakarta 10510. Telp. (021)42886064 Fax:(021)42888206</td></tr>	
			<tr><td align="center">www.stmi.ac.id , e-learning.stmi.ac.id</td></tr>
		</table>
</center>
<hr width="650">
<center><b><font size=2>Kartu Studi Tetap</font></b><br>
<center><b><font size=2><?=$str_periode?></font></b><br>

<table border=0 cellpadding=0 cellspacing=0 width="650"><tr valign="bottom">
<tr><td>
<img src="/barcode/wrapper.php?p_bcType=1&p_text=<?=$tgl?>&p_xDim=1&p_w2n=3&p_charGap=1&p_invert=N&p_charHeight=30&p_type=1&p_label=N&p_rotAngle=0&p_checkDigit=N"><br>
<br></td></tr>
<td align="left"><font size=2>Nama Mahasiswa = <b><?=$___nama?></b><br></td><td align="right"><font size=2>Program Studi = <b><?php echo getJurusan($___nim);?><br></b></td>
</i></td>
<tr><td align="left"><font size=2>NIM = <b><?=$___nim?></b></i></td></td></tr><br>
</tr></table><br>

<table border=0 cellpadding=0 cellspacing=0 width="650"><tr bgcolor=0><td>
  <table border=1 cellpadding=1 cellspacing=1 width="100%" font size=2>
	<tr bgcolor="#99ccff" align="center"><td width="6%"><font size=2><b>No.</b></font></td><td width="13%"><font size=2><b>Kode</b></font></td>
	<td width="30%"><font size=2><b>Nama Mata Kuliah</b></font></td><td width="5%"><font size=2><b>SKS</b></font></td>
	<td width="7%"><font size=2><b>Kelas</b></font></td><td width="17%"><font size=2><b>Ruang</b></font></td><td width="25%"><font size=2><b>Waktu Kuliah</b></font></td>
<?php
//mata kuliah yg sudah diambil
$theset=dosql("select k.id_krs, m.kd_mtk, m.nama as nama_mtk, m.sks, kls.nama as nama_kelas, r.nama as nm_ruangan,
j.id_hari, time_format(j.jam_mulai, '%H:%i') as jammulai, j.id_jadual,
time_format(j.jam_selesai, '%H:%i') as jamselesai, m.praktikum, k.validasi 
from krs_tmp k, jadual j, mtk m, kelas kls, ruangan r 
where k.id_jadual=j.id_jadual and j.id_mtk=m.id_mtk and kls.id_kelas=j.id_kelas and j.id_ruangan=r.id_ruangan and
nim='$___nim' and k.thn_akademik='$TA' and k.periode='$PERIODE'
and k.status=1
order by id_krs");

if (mysql_num_rows($theset)) {
	$no=1;
	while ($row=mysql_fetch_array($theset)) {
	echo "<tr bgcolor=\"white\" align=\"center\" valign=\"top\"><td align=\"center\"><font size=2>$no</td>".
		"<td><font size=2>$row[kd_mtk]</td><td align=\"left\"><font size=2>$row[nama_mtk] ".($row['praktikum'] ? "*" : "")."</td>".
		"<td><font size=2>$row[sks]</td><td><font size=2>$row[nama_kelas]</td><td><font size=2>$row[nm_ruangan]</td>".
		"<td><font size=2>{$HARI[$row['id_hari']]}, $row[jammulai] - $row[jamselesai]</td></tr>\n";
		$no++;
		}
	echo "<tr bgcolor=\"white\"><td colspan=3 align=\"center\"><font size=2><b>Total</b></td>".
	"<td align=\"center\"><font size=2><b>$jml_sks</b></td><td bgcolor=\"#aaaaaa\" align=\"center\" colspan=4>&nbsp;</td></tr>\n";
	
}
else{
	echo "<tr bgcolor=\"white\"><td colspan=8 align=\"center\"><font size=2><br><b>K o s o n g<b><br><br></td></tr>\n";
}
$date_ctk = date('D, d-M-Y');
?>
	</table>
</td>
</tr></table>
</center><br>
<hr width="650">

<table border=0 cellpadding=0 cellspacing=0 width="650"><tr valign="bottom">
<tr>
<td align="right"><font size=1>Kabag. Adm. Akademik dan Kemahasiswaan<br></b></td>
<tr><td align="right"><font size=1>KRS Online v2.0 .:.(BETA) &copy; Pusdata STMI <b>(<? echo"$date_ctk"; ?>)</b> sign HD, Disarankan Menggunakan Chrome V.3++<br></b></td>
</tr></table><br>
<?php
$vw="<script language=javascript> 
function prints() {
bV = parseInt(navigator.appVersion); 
if (bV >= 4) window.print();
PageFormat.PMOrientation;}
prints(); 
</script>";
echo $vw; 
?>
