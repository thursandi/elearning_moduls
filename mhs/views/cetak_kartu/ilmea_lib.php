<?php
//v2.1

//history :
//- 2004-06-30, add function getAtasan();
//- 2004-06-28, add function toSmiley($s);
//- 2004-06-17, add function printUnitKerja($kd_unitkerja, $level);
//- 2004-03-01, add function getKd_unitkerja_bawahan($kd_unitkerja);
//- 2004-02-29, add funcion is_es3, is_es4, is_pejabat
//- 2004-02-14, add function simpan_series($nip, $tgl1, $tgl2, $status, $ket)
//							function restore_absen_series($nip, $tgl1, $tgl2, $status, $ket)
//							function selisih_hari($tgl1, $tgl2)
//- 2004-02-10, add function write_absen($nip, $tgl, $bln, $thn, $masuk, $pulang, $status, $ket, $updater)
//							add function restore_absen($nip, $tgl, $bln, $thn);
//- 2004-02-09, capitalize konstanta array ($BULAN, $ROMAWI, dll)
//              ganti nama UNIT_ES_I_LONG -> NAMA_UNIT_KERJA_LONG, UNIT_ES_I_SHORT -> NAMA_UNIT_KERJA_SHORT
//- 2003-02-10, variabel global utk UNIT_ES_I_LONG, UNIT_ES_I_SHORT, UNIT_ES_I_CODE
//- 2002-12-31, variabel global utk PATH_INTRANET, DB_SIPEGI, dll
//              add function ddmmyyyy()
//- 2002-12-30, add function is_libur()
//              catat aktivitas user ke table intranet.userlog
//- 2002-10-23, function check_admin
//- 2002-09-06, include MenuBox class, Page class
//- 2002-08-28, add function harikerja()
//- 2002-05-14, versioning

/*
if ($SERVER_PORT==80) {
	header("Location: https://{$SERVER_NAME}{$REQUEST_URI}");
	exit;
}
*/

mysql_connect("","intranet_read","intr4n3t2015");

$PATH_INTRANET="";
$NAMA_UNIT_KERJA_LONG="Sekolah Tinggi Manajemen Industri";
$NAMA_UNIT_KERJA_SHORT="STMI";
$KODE_UNIT_KERJA="001";
$ROWS_PER_PAGE=20;

include "classes/menubox.php";
include "classes/tab.php";
include "stmi_lib.php";

$BULAN = array (1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni",
"Juli", "Agustus", "September", "Oktober", "November", "Desember");

$ROMAWI = array (1=>"I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X",
"XI", "XII");

$HARI = array ("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Ahad"); //mysql equiv func = weekday

 
$SMILEY = array ("O:)"=>"angel_ani.gif", ":))"=>"ngakak.gif", ">:D<"=>"peluk.gif",
	":?"=>"bingung_ani.gif", ':">'=>"merona_ani.gif", ":x"=>"inlove_ani.gif", ":P"=>"ngeledek_ani.gif",
	":O"=>"kaget_ani.gif", "X("=>"marah_ani.gif", "~:>"=>"ayam_ani.gif", "B)"=>"rayban_ani.gif",
	"8)"=>"kacamata_ani.gif", "=;"=>"bye_ani.gif", "|)"=>"tidur_ani.gif", ":o)"=>"badut_ani.gif",
	">:)"=>"setan_ani.gif", "(:|"=>"nguap_ani.gif", ":|"=>"biasa_ani.gif", "\:D/"=>"dancing_ani.gif", 
	":D"=>"nyengir_ani.gif", ";))"=>"hihihi_ani.gif",
	"8>"=>"kacamata.gif", ";;)"=>"genit2_ani.gif", ":>"=>"ngelirik_ani.gif", 
	":-*"=>"sun_ani.gif", "=(("=>"patah_hati_ani.gif", "#:-S"=>"fyuh_ani.gif", 
	":(("=>"nangis_ani.gif", "/:)"=>"ragu_ani.gif", ":-S"=>"grogi_ani.gif",
	"=))"=>"ngakak_abis_ani.gif", "8-|"=>"ragu2_ani.gif", "8|"=>"mual_ani.gif",
	":-$"=>"psst_ani.gif", "[-("=>"ngambek_ani.gif", "8-}"=>"puyeng_ani.gif",
	"<:-P"=>"pesta_ani.gif", "=P~"=>"ngiler_ani.gif",
	":("=>"sedih.gif", ";)"=>"genit_ani.gif", 	
	
	":@)"=>"babi_ani.gif", "3:-O"=>"sapi_ani.gif", ":(|)"=>"monyet_ani.gif",
	"@};-"=>"mawar.gif", "(~~)"=>"pumpkin_ani.gif",
	"~O)"=>"kopi_ani.gif", "*-:)"=>"ide_ani.gif", "8-X"=>"tengkorak_ani.gif",
	"=:)"=>"martian_ani.gif", ">-)"=>"alien_ani.gif", ":-L"=>"frustrasi.gif",
	"[-O<"=>"berdoa_ani.gif", "$-)"=>"mataduitan_ani.gif", ":-\""=>"siul_ani.gif",
	"b-("=>"bonyok_ani.gif", ":)>-"=>"peace.gif", "[-X"=>"ngomel_ani.gif",
	">:/"=>"sinilo_ani.gif", 
	":-@"=>"cuek_ani.gif", "^:)^"=>"nyembah_ani.gif", ":-j"=>"gakcaya_ani.gif",
	"(*)"=>"bintang_ani.gif", "#-o"=>"duh_ani.gif", "=D>"=>"tepuktangan_ani.gif",
	":-SS"=>"grogi_ani.gif", "@-)"=>"hipnotis_ani.gif", ":^o"=>"pinokio_ani.gif",
	":-w"=>"geram_ani.gif", ">:P"=>"wek_ani.gif", ":-<"=>"sebel_ani.gif",
	
	":-)"=>"senyum.gif", ":-("=>"sedih.gif", ";-)"=>"genit.gif", ":-D"=>"nyengir.gif",
	":-?"=>"bingung.gif", ":-x"=>"inlove.gif", ":-P"=>"ngeledek.gif",
	":-O"=>"kaget.gif", "X-("=>"marah.gif", ":->"=>"ngelirik.gif", "B-)"=>"rayban.gif",
	"8-)"=>"kacamata.gif", "|-)"=>"tidur.gif", ":)"=>"senyum.gif", 
	":-|"=>"biasa.gif", "O:-)"=>"angel.gif");

$NEW=" <font size=1 color=\"Red\"><sup>New</sup></font>\n";
	
//user dari luar gedung harus login dulu
//include "authenticate.php";

//======================================== functions
function is_pernah_sms($s, $hp="") {
	//utk mengecek, apakah sms yg mengandung kata $s sudah pernah dikirim hari ini
	$theset=dosql("select * from intranet.log_sms
	where isi like '%$s%' and to_days(tgl_kirim)=to_days(now()) and event<>'REPORT' ".
	($hp ? "and hp='$hp'" : ""));
	
	return mysql_num_rows($theset);
}

function getSisaVoucher($no_hp) {
	$theset=dosql("select sum(sisa) as sisa from intranet.voucher
	where hp='$no_hp'");
	$row=mysql_fetch_array($theset);
	
	return $row[sisa];
}

function getStrSisaVoucher($no_hp) {
	$sisa=getSisaVoucher($no_hp);
	
	return "Sisa poin=$sisa.";
}

function kurangiVoucher($no_hp) {
	$theset=dosql("select * from intranet.voucher 
	where hp='$no_hp' and sisa>0");
	
	if ($row=mysql_fetch_array($theset))
		dosql("update intranet.voucher set sisa=sisa-1
		where id_voucher='$row[0]'");
}
	
function send_sms($no_hp, $isi) {
	if (empty($no_hp) || empty($isi))
		exit;
		
	$HEADER_SMS="*STMI Alert*\n";
	
	if (substr($no_hp,0,1)=="0")
		$no_hp="62".substr($no_hp,1,strlen($no_hp)-1);

	$t=explode(" ",microtime());
	$nama_file="/var/spool/sms/outgoing/".str_replace(".","",$t[1].$t[0]);
	
	if (@$fp=fopen($nama_file, "w")) {
		fputs($fp, "To: $no_hp\n\n".addslashes($HEADER_SMS.$isi));
		fclose($fp);
	}
}

function thumbnail($file, $max_width=100, $max_height=0, $alignment="left") {
	global $DOCUMENT_ROOT, $PATH_INTRANET;
	
	if (!$max_height)
		$max_height=$max_width;
	
	if (!file_exists("{$DOCUMENT_ROOT}/{$PATH_INTRANET}$file"))
		$file="/{$PATH_INTRANET}files/sipegi/foto/not_found.jpg";

	if (function_exists("imagecreatetruecolor") || function_exists("imagecreate"))
		return "<img src=\"/{$PATH_INTRANET}thumbnail.php?file=$file&max_width=$max_width&max_height=$max_height\" align=\"$alignment\" border=0>";
	else
		return "<img src=\"$file\" width=$max_width height=$max_height align=\"$alignment\">";
}

function getStrNamaDanGelar($nama, $gelar) {
	$ar_gelar=explode("*", $gelar);
	
	return ($ar_gelar[0] ? "$ar_gelar[0] " : "")."$nama".($ar_gelar[1] ? ", $ar_gelar[1]" : "");
}

function getNamaDanGelar($nip="") {
	global $_nip;

	if (empty($nip))
		$nip=$_nip;
		
	$theset=dosql("select nama, gelar from pegawai where nip='$nip'");
	$row=mysql_fetch_array($theset);
	
	return getStrNamaDanGelar($row['nama'], $row['gelar']);
}

function getBawahan($nip="") {
	global $_nip;
	
	if (empty($nip))
		$nip=$_nip;
	
	if ($eselon=getEselon($nip)) {
		if ($eselon[level]<4) //ambil data bawahan dari table mst_unitkerja
			$sql="select distinct p.nip, p.kd_unitkerja 
			from sipegi.pegawai p, mst_unitkerja m
			where p.kd_unitkerja=m.kd_unitkerja and p.nip in (pjs, pejabat) and
			m.kd_unitkerja like '{$eselon[kd_unitkerja_bawahan]}%' and 
			m.kd_unitkerja<>'{$eselon[kd_unitkerja]}'
			order by kd_unitkerja";
		else //eselon IV : ambil data dari table pegawai
			$sql="select nip, kd_unitkerja 
			from sipegi.pegawai
			where kd_unitkerja='{$eselon[kd_unitkerja_bawahan]}' and nip<>'$nip'";
		
		$theset=dosql($sql);
		$ar_bawahan=array();
		while ($row=mysql_fetch_array($theset))
			$ar_bawahan[]=$row['nip'];
		
		return $ar_bawahan;
	}
}

function getUkuranFile($nama_file) {
	$i=filesize($nama_file);
	if ($i>=1024*1024) // >= 1 mb
		return " (".number_format($i/(1024*1024),2,",",".")." mb)";
	else if ($i>=1024) // >= 1 kb
		return " (".number_format($i/1024,2,",",".")." kb)";
	else
		return " ($i bytes)";
}

function stabilo($s, $ar_words) {
	while (list($key, $val)=each($ar_words))
		$s=eregi_replace($val, "<span style=\"background:#00ffff\">$val</span>", $s);

	return $s;
}

function lihatProfil($nip, $the_string="") {
	global $page;

	if ($page)
		$page->prepareLihatProfil();
		
	$theset=dosql("select nama from sipegi.pegawai where nip='$nip'");
	$row=mysql_fetch_array($theset);

	return "<a href=\"javascript:lihatProfil('$nip');\">".($the_string ? $the_string : $row['nama'])."</a>";
}

function pickPegawai($nama_elemen="nip", $send_mode=0, $left=10, $top=10, $height=300, $width=350) {
	global $PATH_INTRANET;

	echo "<script language=\"JavaScript\">\n".
	"function pickPegawai() {\n".
	"newWindow=window.open(\"/{$PATH_INTRANET}pickPegawai.php?nama_elemen=$nama_elemen&send_mode=$send_mode\", ".
	"\"winPickPegawai\", \"height=$height, width=$width, left=$left, top=$top, scrollbars=yes\")\n".
	"}\n".
	"</script>\n\n";
}

function pickHPPegawai($nama_elemen="no_hp", $send_mode=0, $left=10, $top=10, $height=300, $width=350) {
	global $PATH_INTRANET;

	echo "<script language=\"JavaScript\">\n".
	"function pickPegawai() {\n".
	"newWindow=window.open(\"/{$PATH_INTRANET}pickHPPegawai.php?nama_elemen=$nama_elemen&send_mode=$send_mode\", ".
	"\"winPickPegawai\", \"height=$height, width=$width, left=$left, top=$top, scrollbars=yes\")\n".
	"}\n".
	"</script>\n\n";
}


function pickSmiley($nama_elemen="tujuan", $left=10, $top=10) {
	global $PATH_INTRANET;

	echo "<script language=\"JavaScript\">\n".
	"function pickSmiley() {\n".
	"newWindow=window.open(\"/{$PATH_INTRANET}pickSmiley.php?nama_elemen=$nama_elemen\", \"winSmiley\", \"height=260, width=450, left=10, top=10, scrollbars=yes\")\n".
	"}\n".
	"</script>\n\n";
}

function toSmiley($s) {
	global $SMILEY, $PATH_INTRANET;

	$smiley=$SMILEY;	
	while (list($key,$val)=each($smiley)) {
		$s=str_replace($key," <img src=\"/{$PATH_INTRANET}smileys/$val\" align=\"absmiddle\" border=0>",$s);
	}
	
	return $s;
}

function getAtasan($nip="") {
	global $KODE_UNIT_KERJA, $_nip;
	
	if (empty($nip))
		$nip=$_nip;

	$theset=dosql("select	kd_unitkerja from sipegi.pegawai
	where nip='$nip'");
	$row=mysql_fetch_array($theset);
	$kd_unitkerja=$row[0];
	
	//cek, apakah pegawai ini adl pejabat	
	$eselon=getEselon($nip);
	if ($eselon[level]) {
		//cari kd_unitkerja atasannya
		if ($eselon[level]<=2)
			$kuk_atasan=substr($eselon['kd_unitkerja'],0,3)."000000000";
		else if ($eselon[level]==3)
			$kuk_atasan=substr($eselon['kd_unitkerja'],0,6)."000000";
		else if ($eselon[level]==4)
			$kuk_atasan=substr($eselon['kd_unitkerja'],0,9)."000";
	}
	else  //staff
		$kuk_atasan=$kd_unitkerja;
	
	$theset=dosql("select p.nama as nama_pejabat, mu.* 
	from sipegi.pegawai p, sipegi.mst_unitkerja mu
	where p.nip=mu.pejabat and mu.kd_unitkerja='$kuk_atasan'");
	$row=mysql_fetch_array($theset);
	
	$atasan=array();
	$atasan["nama_pejabat"]=$row['nama_pejabat'];
	$atasan["nip"]=$row['pejabat'];
	$atasan["nama_jabatan"]=$row['nama'];
	$atasan["singkatan"]=$row['singkatan'];
	$atasan["kd_unitkerja"]=$kuk_atasan;
	
	return $atasan;
}

function printUnitKerja($kd_unitkerja, $level=0, $uraian_panjang=1) {
	$strUnitKerja="";
	if ($level==0) { //tampilkan nama unitkerja dari es1 - es4
		for ($i=1; $i<=4; $i++)
			$strUnitKerja.=printUnitkerja($kd_unitkerja,$i)."<br>";
		return $strUnitKerja;
	}
	else if ($level==1) //nama unitkerja eselon I
		$kd_unitkerja=substr($kd_unitkerja,0,3)."000000000";
	else if ($level==2) //nama unitkerja eselon II
		$kd_unitkerja=substr($kd_unitkerja,0,6)."000000";
	else if ($level==3) //nama unitkerja eselon III
		$kd_unitkerja=substr($kd_unitkerja,0,9)."000";
	
	$theset=dosql("select ".($uraian_panjang ? "nama" : "singkatan")." from mst_unitkerja
	where kd_unitkerja='$kd_unitkerja'");
	$row=mysql_fetch_array($theset);
	
	return $row[0];
}

function getKd_unitkerja_bawahan($kd_unitkerja) {
	if (substr($kd_unitkerja,-9)=="000000000") //es1
		return substr($kd_unitkerja,0,3)."___000000";
	else if (substr($kd_unitkerja,-6)=="000000") //es2
		return substr($kd_unitkerja,0,6)."___000";
	else if (substr($kd_unitkerja,-3)=="000") //es3
		return substr($kd_unitkerja,0,9)."___";
	else
		return $kd_unitkerja;
}

function getEselon($nip="") {
	global $_nip;
	
	if (empty($nip))
		$nip=$_nip;
		
	$eselon=array();
	$theset=dosql("select * from sipegi.mst_unitkerja
	where pejabat='$nip' or pjs='$nip'");

	if (mysql_num_rows($theset))	{
		$row=mysql_fetch_array($theset);
		if (substr($row[kd_unitkerja],-9)=='000000000')
			$eselon[level]=1;
		else if (substr($row[kd_unitkerja],-6)=='000000')
			$eselon[level]=2;
		else if (substr($row[kd_unitkerja],-3)=='000')
			$eselon[level]=3;
		else 
			$eselon[level]=4;
	
		$eselon[kd_unitkerja]=$row[kd_unitkerja];
		$eselon[kd_unitkerja_bawahan]=getKd_unitkerja_bawahan($eselon[kd_unitkerja]);
		
		if ($row[pejabat]==$nip)
			$eselon[status]="pejabat";
		else if ($row[pjs]==$nip)
			$eselon[status]="pjs";
		else if ($row[plt]==$nip)
			$eselon[status]="plt";
		else if ($row[plh]==$nip)
			$eselon[status]="plh";

		return $eselon;		
	}
}

function is_pejabat($nip="") {
	global $_nip;

	if (empty($nip))
		$nip=$_nip;

	if (is_es4($nip))
		return is_es4($nip);
	else if (is_es3($nip))
		return is_es3($nip);
	else if (is_es2($nip))
		return is_es2($nip);
	else if (is_es1($nip))
		return is_es1($nip);
}

function is_es4($nip="") {
	global $_nip;

	if (empty($nip))
		$nip=$_nip;
		
	$theset=dosql("select * from sipegi.mst_unitkerja
	where right(kd_unitkerja,3)<>'000' and pejabat='$nip'");
	$row=mysql_fetch_array($theset);
	
	return $row[kd_unitkerja];
}

function is_es3($nip="") {
	global $_nip;

	if (empty($nip))
		$nip=$_nip;
		
	$theset=dosql("select * from sipegi.mst_unitkerja
	where right(kd_unitkerja,3)='000' and pejabat='$nip'");
	$row=mysql_fetch_array($theset);
	
	return $row[kd_unitkerja];
}

function is_es2($nip="") {
	global $_nip;

	if (empty($nip))
		$nip=$_nip;
		
	$theset=dosql("select * from sipegi.mst_unitkerja
	where right(kd_unitkerja,6)='000000' and pejabat='$nip'");
	$row=mysql_fetch_array($theset);
	
	return $row[kd_unitkerja];
}

function is_es1($nip="") {
	global $_nip;
	
	if (empty($nip))
		$nip=$_nip;
		
	$theset=dosql("select * from sipegi.mst_unitkerja
	where right(kd_unitkerja,9)='000000000' and pejabat='$nip'");
	$row=mysql_fetch_array($theset);

	return $row['kd_unitkerja'];	
}

function strPangkat($kd_pangkat, $print_uraian=0) {
	global $ROMAWI;

	if ($kd_pangkat) {
		if ($print_uraian) {
			$theset=dosql("select uraian from mst_pangkat
			where kd_pangkat='$kd_pangkat'");
			$row=mysql_fetch_array($theset);
		}
		
		if ($print_uraian==1)
			$s=$row[0]." (".$ROMAWI[(substr($kd_pangkat,0,1))]."/".substr($kd_pangkat,-1).")";
		else
			$s=$ROMAWI[(substr($kd_pangkat,0,1))]."/".substr($kd_pangkat,-1);
			
		return $s;
	}
}

function selisih_hari($tgl1, $tgl2) {
	//format $tgl1 dan $tgl2 harus yyyymmdd
	
	//cari jumlah selisih hari antara $tgl2 dan $tgl1
	$theset=dosql("select to_days('$tgl2')-to_days('$tgl1')+1");
	$row=mysql_fetch_row($theset);

	return $row[0];
}

function jml_harikerja($thedate, $elapsed) {
/* 
fungsi :
	menghitung jumlah hari kerja dari tgl $thedate selama $elapsed hari kemudian

variabel :
	$thedate  = tanggal awal, ddmmyyyy
	$elapsed  = jumlah hari kalender

catatan :
	- format penulisan $thedate adl. dd-mm-yyyy atau ddmmyyyy
	- dibuat pd tgl : 28-8-2002
	- revisi : 30-12-2002 (format lain penulisan $thedate = ddmmyyyy)

contoh :
	- harikerja("12-12-2002", 3); -> jumlah hari kerja selama 3 hari semenjak tgl 12-12-2002
		angka 3 bisa dicari melalui function mysql to_days(tglakhir)-to_days($tglawal);
	- harikerja("12122002", 3); -> sda
*/

	if (strlen($thedate)==8) { //ddmmyyyy
		$tgl=substr($thedate,0,2); $bln=substr($thedate,2,2); $thn=substr($thedate,4,4);
	}
	else if (strlen($thedate)==10) { //dd-mm-yyyy
		$tgl=substr($thedate,0,2); $bln=substr($thedate,3,2); $thn=substr($thedate,6,4);
	}
	else
		return 0;

	$n=0;
	for ($i=0; $i<$elapsed; $i++) {
		$day_no=date("w", mktime(0,0,0,$bln,$tgl+$i,$thn));
		$tanggal=date("dmY", mktime(0,0,0,$bln,$tgl+$i,$thn));
		if ($day_no!=0 && $day_no!=6 && !is_libur($tanggal))
			$n++;
	}
	return $n;
}

function harikerja($thedate, $elapsed) {
	return jml_harikerja($thedate, $elapsed);
}

function restore_absen_series($nip, $tgl1, $tgl2) {
	//format $tgl1 dan $tgl2 harus yyyymmdd

	$tgl_awal=substr($tgl1,0,2); $bln_awal=substr($tgl1,2,2); $thn_awal=substr($tgl1,4,4);
	$tgl_akhir=substr($tgl2,0,2); $bln_akhir=substr($tgl2,2,2); $thn_akhir=substr($tgl2,4,4);

	if (date("Ymd", mktime(0,0,0,$bln_akhir,$tgl_akhir,$thn_akhir)) >=
	date("Ymd", mktime(0,0,0,$bln_awal,$tgl_awal,$thn_awal))) {
		//cari selisih hari antara $tgl2 dan $tgl1.  -> utk looping.
		$theset=dosql("select to_days('$thn_akhir$bln_akhir$tgl_akhir')-
		to_days('$thn_awal$bln_awal$tgl_awal')+1");
		$row=mysql_fetch_row($theset);
		$jml_hari=selisih_hari(yyyymmdd($tgl_awal,$bln_awal,$thn_awal), yyyymmdd($tgl_akhir,$bln_akhir,$thn_akhir));

		$jml_hari_bln=date("t", mktime(0,0,0,$bln_awal,1,$thn_awal));
		$tgl=$tgl_awal; $bln=$bln_awal; $thn=$thn_awal;
		
		//looping catat absen
		for ($i=1;$i<=$jml_hari;$i++) { 
			if ($tgl>$jml_hari_bln) { //bulan baru
				$tgl=1;
				if ($bln<12)
					$bln++;
				else { //januari
					$bln=1; $thn++;
				}
				$jml_hari_bln=date("t", mktime(0,0,0,$bln,1,$thn));
			}
	
			restore_absen($nip, $tgl, $bln, $thn);
			
			$tgl++;
		}
		return 1;
	}
	return 0;
}

function write_absen_series($nip, $tgl1, $tgl2, $status, $ket, $updater) {
	/*
		format $tgl1 dan $tgl2 harus ddmmyyyy
	*/
	$tgl_awal=substr($tgl1,0,2); $bln_awal=substr($tgl1,2,2); $thn_awal=substr($tgl1,4,4);
	$tgl_akhir=substr($tgl2,0,2); $bln_akhir=substr($tgl2,2,2); $thn_akhir=substr($tgl2,4,4);

	if (date("Ymd", mktime(0,0,0,$bln_akhir,$tgl_akhir,$thn_akhir)) >=
	date("Ymd", mktime(0,0,0,$bln_awal,$tgl_awal,$thn_awal))) {
		//cari selisih hari antara $tgl2 dan $tgl1.  -> utk looping.
		$theset=dosql("select to_days('$thn_akhir$bln_akhir$tgl_akhir')-
		to_days('$thn_awal$bln_awal$tgl_awal')+1");
		$row=mysql_fetch_row($theset);
		$jml_hari=$row[0];

		$jml_hari_bln=date("t", mktime(0,0,0,$bln_awal,1,$thn_awal));
		$tgl=$tgl_awal; $bln=$bln_awal; $thn=$thn_awal;

		//looping catat absen
		for ($i=1;$i<=$jml_hari;$i++) { 
			if ($tgl>$jml_hari_bln) { //bulan baru
				$tgl=1;
				if ($bln<12)
					$bln++;
				else { //januari
					$bln=1; $thn++;
				}
				$jml_hari_bln=date("t", mktime(0,0,0,$bln,1,$thn));
			}
	
			if (!is_libur(ddmmyyyy($tgl,$bln,$thn)) || $status=="D")
				write_absen($nip, $tgl, $bln, $thn, "00:00", "00:00", "$status", "$ket", "$updater");
				//write_absen($nip, $tgl, $bln, $thn, "08:00", "17:00", "$status", "$ket", "$updater");

			$tgl++;
		}
		return 1;
	}
	return 0;
}

function restore_absen($nip, $tgl, $bln, $thn) {
	//cek dulu, apakah data yg akan di-restore tsb ada ?
	$theset=dosql("select * from sipegi.absensi_buffer
	where nip='$nip' and to_days(masuk)=to_days('".yyyymmdd($tgl,$bln,$thn)."')");

	//hapus data absensi
	dosql("delete from sipegi.absensi 
	where nip='$nip' and to_days(masuk)=to_days('".yyyymmdd($tgl,$bln,$thn)."')");

	//ambil data absensi dari backup
	dosql("insert into sipegi.absensi	
	select * from sipegi.absensi_buffer
	where nip='$nip' and to_days(masuk)=to_days('".yyyymmdd($tgl,$bln,$thn)."')
	order by tgl_update desc limit 1");
	
	//cari tgl_update data yg baru diambil
	$theset=dosql("select tgl_update from sipegi.absensi
	where nip='$nip' and to_days(masuk)=to_days('".yyyymmdd($tgl,$bln,$thn)."')");
	$row=mysql_fetch_array($theset);
	$tgl_update=$row[tgl_update];

	//hapus data backup
	dosql("delete from sipegi.absensi_buffer
	where nip='$nip' and to_days(masuk)=to_days('".yyyymmdd($tgl,$bln,$thn)."') and
	tgl_update='$tgl_update'");
	
	//hapus data keterangan absensi
	dosql("delete from sipegi.ket_absensi 
	where nip='$nip' and to_days(tgl)=to_days('".yyyymmdd($tgl,$bln,$thn)."')");

	//ambil data keterangan absensi dari backup
	dosql("insert into sipegi.ket_absensi	
	select * from sipegi.ket_absensi_buffer
	where nip='$nip' and to_days(tgl)=to_days('".yyyymmdd($tgl,$bln,$thn)."')
	order by tgl_update limit 1");

	//cari tgl_update data yg baru diambil
	$theset=dosql("select tgl_update from sipegi.ket_absensi
	where nip='$nip' and to_days(tgl)=to_days('".yyyymmdd($tgl,$bln,$thn)."')");
	$row=mysql_fetch_array($theset);
	$tgl_update=$row[tgl_update];
	
	//hapus data backup
	dosql("delete from sipegi.ket_absensi_buffer
	where nip='$nip' and to_days(tgl)=to_days('".yyyymmdd($tgl,$bln,$thn)."') and
	tgl_update='$tgl_update'");
}

function write_absen($nip, $tgl, $bln, $thn, $jammasuk, $jampulang, $status, $ket, $updater) {
	if ($status=="R") { //restore absen
		restore_absen($nip, $tgl, $bln, $thn);
		return;
	}

	//apakah data absensi utk tgl tsb sudah ada ?
	$theset=dosql("select * from sipegi.absensi 
	where nip='$nip' and to_days(masuk)=to_days('".yyyymmdd($tgl,$bln,$thn)."')");
	
	if (mysql_num_rows($theset)) { //kalau sudah ada data utk tgl tsb, backup dulu
		$row=mysql_fetch_array($theset);
		
		//simpan data absensi pada tgl tsb ke table absensi_buffer
		dosql("insert into sipegi.absensi_buffer (nip, masuk, pulang, status, terminal_id)
		values ('$row[nip]', '$row[masuk]', '$row[pulang]', '$row[status]', '$row[terminal_id]')");
		
		dosql("delete from sipegi.absensi
		where nip='$nip' and to_days(masuk)=to_days('".yyyymmdd($tgl,$bln,$thn)."')");
		
		//simpan data keterangan absensi tgl tsb ke table ket_absensi_buffer
		$ketabs_set=dosql("select * from sipegi.ket_absensi 
		where nip='$nip' and to_days(tgl)=to_days('".yyyymmdd($tgl,$bln,$thn)."')");
		
		if (mysql_num_rows($ketabs_set)) {
			$ketabs=mysql_fetch_array($ketabs_set);
		
			dosql("insert into sipegi.ket_absensi_buffer (nip, tgl, keterangan_tambahan, updater)
			values ('$ketabs[nip]', '$ketabs[tgl]', '$ketabs[keterangan_tambahan]', '$ketabs[updater]')");

			dosql("delete from sipegi.ket_absensi 
			where nip='$nip' and to_days(tgl)=to_days('".yyyymmdd($tgl,$bln,$thn)."')");
		}
	}

	if ($status!="H") { //bukan utk hapus
		//simpan data yg baru
		dosql("insert into sipegi.absensi (nip, masuk, pulang, status, terminal_id)
		values ('$nip', '$thn/$bln/$tgl $jammasuk', '$thn/$bln/$tgl $jampulang', '$status', 'Inet')");
	
		dosql("insert into sipegi.ket_absensi (nip, tgl, keterangan_tambahan, updater)
		values ('$nip', '$thn/$bln/$tgl', '$ket', '$updater')");
	}	
}

function yyyymmdd($tgl,$bln,$thn) {
	if (strlen($tgl)<2)
		$tgl="0".$tgl;

	if (strlen($bln)<2)
		$bln="0".$bln;

	if (strlen($thn)==2)
		$thn="20".$thn;

	return "$thn$bln$tgl";
}

function ddmmyyyy($tgl,$bln,$thn) {
	if (strlen($tgl)<2)
		$tgl="0".$tgl;

	if (strlen($bln)<2)
		$bln="0".$bln;

	if (strlen($thn)==2)
		$thn="20".$thn;

	return "$tgl$bln$thn";
}

function is_libur($thedate) {
/* 
fungsi :
	mengecek apakah $thedate adl. hari libur.  jika ya, return keterangan hari libur tsb.

variabel :
	$thedate  = tanggal yg akan dicek, ddmmyyyy

catatan :
	- format penulisan $thedate adl. ddmmyyyy atau dd-mm-yyyy
	- daftar hari libur terdapat pada array hari_libur[];
	- dibuat pd tgl : 30-12-2002

contoh :
	- is_libur("01012003")
*/

	if (strlen($thedate)>8) { //format : dd-mm-yyyy
		$tgl=substr($thedate,0,2); $bln=substr($thedate,3,2); $thn=substr($thedate,6,4);
	}
	else { //format : ddmmyyyy
		$tgl=substr($thedate,0,2); $bln=substr($thedate,2,2); $thn=substr($thedate,4,4);
	}

	//utk jaga2, siapa tahu nilai parameter $thedate = 32122003 -> 01012004
	$thedate=date("dmY", mktime(0,0,0,$bln,$tgl,$thn));
	$tgl=substr($thedate,0,2); $bln=substr($thedate,2,2); $thn=substr($thedate,4,4);

/*
	$hari_libur=array("01012002"=>"Tahun baru 2002", "23022002"=>"Idul Adha",
		"15032002"=>"Tahun baru hijriyah", "29032002"=>"Wafat Isa Almasih",
		"13042002"=>"Hari Raya Nyepi", "09052002"=>"Kenaikan Isa Almasih",
		"25052002"=>"Maulid Nabi Muhammad SAW", "26052002"=>"Waisak",
		"17082002"=>"Hari Kemerdekaan RI", "04102002"=>"Isra Miraj",
		"06122002"=>"Idul Fitri", "07122002"=>"Idul Fitri",
		"25122002"=>"Natal",

		"01012003"=>"Tahun Baru 2003", "12022003"=>"Idul Adha",
		"04032003"=>"Tahun Baru Muharam", "02042003"=>"Hari Raya Nyepi",
		"18042003"=>"Wafat Isa Almasih", "14052003"=>"Maulid Nabi Muhammad SAW",
		"16052003"=>"Hari Raya Waisak", "29052003"=>"Kenaikan Isa Almasih",
		"17082003"=>"Hari Kemerdekaan RI", "24092003"=>"Isra Miraj",
		"25112003"=>"Idul Fitri", "25112003"=>"Idul Fitri",
		"25122003"=>"Natal",

		"01012004"=>"Tahun Baru 2004", "22012004"=>"Tahun Baru Imlek",
		"02022004"=>"Libur Idul Adha", "23022004"=>"Libur Tahun Baru Hijriah",
		"22032004"=>"Libur Hari Raya Nyepi", "09042004"=>"Libur Wafat Yesus Kristus",
		"03052004"=>"Libur Maulid Nabi Muhammad SAW", "20052004"=>"Libu Kenaikan Yesus Kristus",
		"03062004"=>"Libur Hari Raya Waisak", "05072004"=>"Pemilu Presiden", "17082004"=>"Hari Kemerdekaan RI",
		"13092004"=>"Libur ISra Mi'raj Nabi Muhammad SAW", "14112004"=>"Libur Hari Raya Idul Fitri",
		"15112004"=>"Libur Hari Raya Idul Fitri", "16112004"=>"Libur Hari Raya Idul Fitri",
		"25122004"=>"Hari Raya Natal"		
	);
*/

	if (date("w", mktime(0,0,0,$bln,$tgl,$thn))==6)
		return "Sabtu";
	else if (date("w", mktime(0,0,0,$bln,$tgl,$thn))==0)
		return "Ahad";

	$theset=dosql("select uraian from intranet.libur 
	where date_format(tanggal, '%d%m%Y')='$tgl$bln$thn'");
	
	if ($row=mysql_fetch_array($theset))
		return $row[uraian];
		
/*
	while (list($tgl, $ket)=each($hari_libur)) {
		if ($tgl==$thedate)
			return $ket;
	}
*/
}

function check_admin($app_name) {
	global $_nip;

	$theset=mysql_query("select * from intranet.admin where nip='$_SESSION[nip]' 
	and app_name='$app_name'");
	
	if ($row=mysql_fetch_array($theset))
		//$status=$row[status];	

	//return $status;
	return $row['status'];
}

function dosql($thequery, $showquery=0) {
/*
fungsi :
	untuk melakukan query ke database

variabel yg diperlukan :
	$thequery    = perintah SQL,
	$showquery   = untuk menampilkan perintah SQL-nya atau merekam sql tsb
*/
	if ($showquery)
		echo "SQL = <b>$thequery</b><br>\n";

	$theset=mysql_query($thequery);
	if (mysql_error()!="") {
		echo "SQL = <b>".nl2br($thequery)."</b><br><br>\n";
		echo "Error = ".mysql_error()." [ErrCode = ".mysql_errno()."]<br><br>\n\n";
	}
	else
		return $theset;
}

function topage($location, $showlink=0) {
/*
fungsi :
	untuk loncat ke page tertentu

variabel yg diperlukan :
	$location  = page yg akan dituju,
	$showlink  = untuk menampilkan link, jika nilainya 0 berarti loncat scr otomatis
*/

	if ($showlink)
		echo "<a href=\"$location".(strpos($location,"?") ? time() : "")."\"><center>>>>>>>>>>> Selesai..! <<<<<<<<<<</center></a>\n";
	else {
		echo "<script language=\"javascript\">\n";
		echo "document.location=\"$location".(strpos($location,"?")==strlen($location)-1 ? time() : "")."\"\n";
		echo "</script>\n";
	}
}

function nbsp($thestring) {
/*
fungsi :
	untuk mem-filter string.  jika string-nya kosong, yg akan di-return adalah &nbsp;.
	biasanya digunakan saat mencetak di dalam <td>..</td>

contoh :
	echo nbsp("abc");
*/

	if (empty($thestring))
		return "&nbsp;";
	else
		return $thestring;
}

function safestr($s) {
	return nl2br(strip_tags($s));
}

function is_super_admin() {
	global $_nip;
//	$ar_super_admin=':090021799:';
	if ($_nip == 090022278){
		$ar_super_admin=':090022278:';
		return strpos($ar_super_admin, $_nip);
	}else{
		$ar_super_admin=':090022279:';
		return strpos($ar_super_admin, $_nip);	
	}
}

function isDosenWali(){
	global $_nip;
	if (!empty($_nip)){
		$theset=mysql_query("select * from sisformik.dosen where nip='$_nip' and dosen_wali=1");
		
		if ($row=mysql_fetch_array($theset)){
			return true;
		}
		else{
			return false;
		}
	}
}

?>
