<?php
session_start();
include "ilmea_lib.php";
//include "{$DOCUMENT_ROOT}/classes/page.php";

if (!empty($tahun)){
	$tahun=$_GET['tahun'];
}

$level_admin_bak=check_admin("bak")+check_admin("klta"); 
$level_admin_nilai=check_admin("nilai");
$level_admin_keu=check_admin("keu");
$level_admin_baa=check_admin("baa");
$level_admin_klta=check_admin("klta");
if (!empty($_wali)){$is_wali = 1;}else{$is_wali = 0;}
if (!($level_admin_bak+$level_admin_nilai+$level_admin_keu+$level_admin_baa+$level_admin_klta+$is_wali)) {
  topage("/?");
	exit();
}

mysql_select_db("sisformik");

$ROWS_PER_PAGE=25;
$AWAL_GANJIL=9; $BATAS_BAYAR_GANJIL=11;
$AWAL_GENAP=3;  $BATAS_BAYAR_GENAP=5;

class pgSIA extends Page {
  var $visibleLeftPane;
	
  function pgSIA() {
	  $this->setTitle("Bagian Kemahasiswaan");
		$this->addBreadCrumb("Sisformik", "/sisformik/");
		$this->addBreadCrumb("Cetak Kartu ", "/sisformik/baa/cetak_kartu");
		$this->visibleLeftPane=1;
	}
	
	function content() {
	  global $nama_mhs, $nim, $tahun;
		if ($this->visibleLeftPane) {
  	  echo "<td width=\"25%\" align=\"center\"><br>\n";

      $mb=new MenuBox();
      $mb->reset();
		  $mb->setJudul("Search Mahasiswa");
		  $mb->addMessage("<form action=\"index.php\">\n".
		  "Nama/NIM mahasiswa <input type=\"text\" name=\"nama_mhs\" size=15 value=\"$nama_mhs\"><br><br>\n".
			"Angkatan <select name=\"tahun\">\n".
			"<option value=\"\">All</option>\n");
			
			$theset=dosql("select distinct mid(nim,3,2) as tahun, 
			if(mid(nim,3,2)>='90', concat('19',mid(nim,3,2)), concat('20',mid(nim,3,2))) as angkatan
			from mhs order by 2");
			while ($row=mysql_fetch_array($theset))
				$mb->addMessage("<option value=$row[tahun]".($row[tahun]==$tahun ? " selected" : "").">$row[angkatan]</option>\n");
				
			$mb->addMessage("</select><br><br>\n".
		  "<input type=\"submit\" value=\"Cari\">\n".
		  "</form>\n");
		  $mb->show();

  		echo "</td><td><br>\n";
		}
		else
		  echo "<td style=\"padding-left:20pt\"><br>\n";
	}
	
	function bottom() {
		//$this->tab->bottom();
	  Page::bottom();
	}
	
	function hideLeftPane() {
	  $this->visibleLeftPane=0;
	}
}

$page=new pgSIA();

function isUangSidangOK() {
	global $_nim;
	
	$theset=dosql("select * from keuangan 
	where nim='$_nim' and kd_bayar=5");
	
	return mysql_num_rows($theset);
}

function cariTemanBareng() {
	global $_nim;
	
	$nim=array();
	//cari dari nim_1
	$theset=dosql("select * from perusahaan_ta_bareng where nim_1='$_nim'");
	while ($row=mysql_fetch_array($theset))
		$nim[]=$row[nim_2];
}

function getNamaDosen($id_dosen) {
	$theset=dosql("select nama, gelar from dosen 
	where id_dosen='$id_dosen'");
	$row=mysql_fetch_array($theset);

	return strtoupper(getStrNamaDanGelar($row[nama], $row[gelar]));
}

function getNamaMhs($nim) {
	$theset=dosql("select nama from mhs 
	where nim='$nim'");
	$row=mysql_fetch_array($theset);

	return $row['nama'];
}

function getJurusan($_nim){
	if ((substr($_nim,1,1)==1) or (substr($_nim,1,1)==2)) {
		$data =  "Teknik dan Manajemen Industri";
	}else if ((substr($_nim,1,1)==3) or (substr($_nim,1,1)==4)) {
		$data = "Sistem Informasi";
	}else if ((substr($_nim,1,1)==5) or (substr($_nim,1,1)==6))  {
		$data =  "Teknologi Kimia Industri";
	}else if ((substr($_nim,1,1)==7) or (substr($_nim,1,1)==8))  {
		$data =  "Manajemen Bisnis Industri";
	} else {
		$data = "Tenaga Penyuluh Lapangan";
	}
	return $data;
}

function isLunas($nim,$PERIODE,$TA){
	$islunas = false;
	$totalHutang=getTotalHutang($nim,0); //hitung juga semester berjalan 
	$cicilanSPP=getCicilanSPP($nim, $TA, $PERIODE, 1);
	$biayaSPP=getBiayaSPP($nim, $TA, $PERIODE);
	$totalHutang = $totalHutang+($biayaSPP-$cicilanSPP); // total hutang sem sebelumnya+biaya sekarang
	if (($totalHutang == 0) || (substr($nim,1,1) == 9)){
		$islunas=true;
	}
	return $islunas;
}

function TulisPeriode($periode){
	if ($periode==1) {
		$data =  "Ganjil";
	}else {
		$data = "Genap";
	}
	return $data;
}

function cetakHeader(){
	echo "
		<table border=0 width=650 cellpadding=0 cellspacing=0>
			<tr><td rowspan=4><img src=\"/sisformik/images/logo_stmi.jpg\" width=70 height=70>
			</td><td align=\"center\"><b>KEMENTERIAN PERINDUSTRIAN R.I.</b></td></tr>
			<tr><td align=\"center\" ><b>SEKOLAH TINGGI MANAJEMEN INDUSTRI</b></td></tr>
			<tr><td align=\"center\">Jl. Letjen Suprapto No. 26 Cempaka Putih, Jakarta 10510. Telp. (021)42886064 Fax:(021)42888206</td></tr>	
			<tr><td align=\"center\">www.stmi.ac.id , e-learning.stmi.ac.id</td></tr>
			<tr><td colspan = 2><hr></td></tr>	
		</table>
	";

}  

function cetakTranskrip($nim){
	global $BULAN;
	$sort_by = 0;
	$theset=dosql("select distinct m.id_mtk from mtk m, krs k
	where k.id_mtk=m.id_mtk and k.nim='$nim' and k.status>0 and nama not like 'praktikum%' and nama not like 'praktek.%'
	order by ".($sort_by ? "m.nama,4" : "substring(m.kd_mtk,4)"));
	
	$detail1="";
	$detail2="";
	if (mysql_num_rows($theset)) {
		$no=1; $total_sks=0; $total_mutu=0; 
		while ($row=mysql_fetch_array($theset)) {
			$detail_prak = '';
			//cari nilai terbaik, termasuk pada saat SP
			$nilai_set=dosql("select k.id_krs, k.id_jadual, mu.mutu, m.kd_mtk, m.nama, m.sks, 
			min(k.nilai) as nilai
			from krs k, mutu mu, mtk m
			where k.id_mtk='$row[id_mtk]' and mu.huruf=k.nilai and k.nim='$nim' and k.nilai<>''
			and m.id_mtk = k.id_mtk  
			group by k.id_mtk order by k.nilai");
			$nilai=mysql_fetch_array($nilai_set);
			if (!$nilai['id_krs'])
				continue;
			
			//lihat sks dari mata kuliah tersebut tergantung pada saat pertama kali mengambil tersebut
			$sks_set=dosql("select m.sks, m.kd_mtk, m.nama, k.id_jadual, k.periode, k.thn_akademik
			from krs k, mtk_next m
			where k.id_mtk = '$row[id_mtk]' and k.nim='$nim' and k.id_mtk=m.id_mtk
			and k.periode=m.periode and k.thn_akademik = m.thn_akademik
			order by thn_akademik,periode ");
			if ($sks_mtk = mysql_fetch_array($sks_set)){	
	
				// untuk melihat sks praktikum
				 $sks_prak_set = dosql("select m.sks, p.id_jadual, p.id_jadual_prak from jadual j, mtk_next m, praktikum p where p.id_jadual =
				 '$sks_mtk[id_jadual]' and p.id_jadual_prak = j.id_jadual and j.id_mtk = m.id_mtk and m.periode=".$sks_mtk['periode']." and m.thn_akademik= ".$sks_mtk['thn_akademik']);
		
				 if(mysql_num_rows($sks_prak_set)>0) {
					 $sks_prak = mysql_fetch_array($sks_prak_set);
					 //melihat apakah praktikumnya ada nilai //ditambahkan oleh ulil - 5 November 2014
					 $prak_set = dosql("select m.id_mtk, m.kd_mtk, m.nama, k.nilai, k.id_krs, k.periode, k.thn_akademik, mu.mutu from mtk  m, krs k, mutu mu where k.id_jadual =
					 '$sks_prak[id_jadual_prak]' and m.id_mtk = k.id_mtk and k.nilai <> '' and mu.huruf=k.nilai and k.nim='$nim'");
					 //echo "select m.kd_mtk, m.nama, k.nilai, k.id_krs, k.periode, k.thn_akademik, mu.mutu from mtk  m, krs k, mutu mu where k.id_jadual =
					 //'$sks_prak[id_jadual_prak]' and m.id_mtk = k.id_mtk and k.nilai <> '' and mu.huruf=k.nilai and k.nim='$_nim'";
					 if(mysql_num_rows($prak_set)) {
						 $prak = mysql_fetch_array($prak_set);
						 $max_prak=dosql("select k.id_krs, mu.mutu, min(k.nilai) as nilai from krs k, mutu mu, mtk m
						 where k.id_mtk='$prak[id_mtk]' and mu.huruf=k.nilai and k.nim='$nim' and k.nilai<>''
						 and m.id_mtk = k.id_mtk  
						 group by k.id_mtk order by k.nilai");
						 $max_prak_set=mysql_fetch_array($max_prak);
	
						 $mutu_prak = $max_prak_set['mutu']*$sks_prak['sks'];
						 //simpan data praktikum untuk ditampilkan
						$detail_prak="<td class='style1'>"."$prak[kd_mtk]</a></td>".
						"<td align=\"left\" class='style1'>$prak[nama]</td><td class='style1'>$sks_prak[sks]</td><td class='style1'>$max_prak_set[nilai]</td>".
						"<td class='style1'>$mutu_prak</td></tr>\n";
						$total_sks+=$sks_prak['sks']; $total_mutu+=$mutu_prak;
					 }else{
							$sks_mtk['sks'] = $sks_mtk['sks'] + $sks_prak['sks'];
					 }
				} 
	
	
				$mutu = $sks_mtk['sks']*$nilai['mutu'];
				/* jika tidak bs melakukan perubahan nilai
				$detail.="<tr bgcolor=\"white\" align=\"center\"><td align=\"right\">$no</td>".
				"<td>$sks_mtk[kd_mtk]</td>".
				"<td align=\"left\">$sks_mtk[nama]</td><td>$sks_mtk[sks]</td><td>$nilai[nilai]</td>".
				"<td>$mutu</td></tr>\n";
				*/
				if ($no<=40){			
					$detail1.="<tr bgcolor=\"white\" align=\"center\"><td align=\"left\" class='style1'>$no.</td>".
					"<td class='style1'>"."$nilai[kd_mtk]</a></td>".
					"<td align=\"left\" class='style1'>$nilai[nama]</td><td class='style1'>$sks_mtk[sks]</td><td class='style1'>$nilai[nilai]</td>".
					"<td class='style1'>$mutu</td></tr>\n";
					if ($detail_prak <> ''){
						$no++;
						$detail1.="<tr bgcolor=\"white\" align=\"center\"><td align=\"left\" class='style1'>$no</td>".$detail_prak;
					}
				}else{
					$detail2.="<tr bgcolor=\"white\" align=\"center\"><td align=\"left\" class='style1'>$no.</td>".
					"<td class='style1'>"."$nilai[kd_mtk]</a></td>".
					"<td align=\"left\" class='style1'>$nilai[nama]</td><td class='style1'>$sks_mtk[sks]</td><td class='style1'>$nilai[nilai]</td>".
					"<td class='style1'>$mutu</td></tr>\n";
					if ($detail_prak <> ''){
						$no++;
						$detail2.="<tr bgcolor=\"white\" align=\"center\"><td align=\"left\" class='style1'>$no</td>".$detail_prak;
					}
				}
				
				$no++; 
				
				if ($nilai['nilai']!="") {
					$total_sks+=$sks_mtk['sks']; $total_mutu+=$mutu;
				}
				
			} else { // else mk belum terekam sebagai mtk_next
			$mutu = $nilai['sks']*$nilai['mutu'];
			if ($no<=40){
			$detail1.="<tr bgcolor=\"white\" align=\"center\"><td align=\"left\" class='style1'>&nbsp;$no.</td>".
			"<td class='style1'>"."$nilai[kd_mtk]</a></td>".
			"<td align=\"left\" class='style1'>$nilai[nama]</td><td class='style1'>$nilai[sks]</td><td class='style1'>$nilai[nilai]</td>".
			"<td class='style1'>$mutu</td></tr>\n";
			}else{
			$detail2.="<tr bgcolor=\"white\" align=\"center\"><td align=\"left\" class='style1'>$no.</td>".
			"<td class='style1'>"."$nilai[kd_mtk]</a></td>".
			"<td align=\"left\" class='style1'>$nilai[nama]</td><td class='style1'>$nilai[sks]</td><td class='style1'>$nilai[nilai]</td>".
			"<td class='style1'>$mutu</td></tr>\n";
			}
			$no++; 
	
	
			if ($nilai['nilai']!="") {
				$total_sks+=$nilai['sks']; $total_mutu+=$mutu;
			}
			
			}
		}
	}
	
	
	if (!empty($detail1)){	
		//cek apakah sudah sidang?
		$theset=dosql("select 
		if(tgl_sidang<>'0000/00/00',1,0) as tgl_sidang_ok, judul
		from ta where nim='$nim'");
		$row=mysql_fetch_array($theset);
		$lulus = false;
		if ($row['tgl_sidang_ok']) {
			$lulus = true;
			if (substr($nim,1,1)=='5' or substr($nim,1,1)=='6'){
				$theset=dosql("select 
				judul 
				from pra_rp where nim='$_nim'");
				$row_rp=mysql_fetch_array($theset);
				$judul_rp = $row_rp['judul'];
			}	
			$judul = $row['judul'];
		}
		
		@$ip=$total_mutu/$total_sks;
		$ipk=getIPK($nim);
		
		echo "
			<br><br><br><br><br><br><br>
			<table border=0 width=650 cellpadding=0 cellspacing=0>
				<tr><td colspan='2' align=\"center\"><u>TRANSKRIP NILAI</u></td></tr>
				<tr><td  align=\"left\" width=\"50%\">Nama : ".getNamaMhs($nim)."</td>
					<td  align=\"right\">Jurusan : ".getJurusan($nim)."</td> </tr>
				<tr><td  align=\"left\">NIM  : ".$nim."</td>
				<td  align=\"left\"></td> </tr>	
			</table>	
		";
		
		echo "<br>
			<table border=1 cellpadding=1 cellspacing=0 width=650 ";	
			if ($no>30){
			echo " class='style2'";}
		echo ">";
		echo "
				<tr bgcolor=\"white\" align=\"center\"><td width=\"7%\" class='style1'><b>No.</b></td>
				<td width=\"15%\" class='style\'><b>Kode</b></td>
				<td width=\"40%\" class='style1'><b>Mata Kuliah</b></td>
				<td width=\"10%\" class='style1'><b>SKS</b></td><td width=\"10%\" class='style1'><b>Nilai</b></td>
				<td class='style1'><b>NilaixSKS</b></td></tr>
		";
		echo $detail1;
		echo '</table>';
	
		if ($no>30){
		echo "
		<br><br><br><br><br><br><br>
		<table border=0 width=650 cellpadding=0 cellspacing=0>
			<tr><td colspan='2' align=\"center\"><u>TRANSKRIP NILAI</u></td></tr>
			<tr><td  align=\"left\" width=\"50%\">Nama : ".getNamaMhs($nim)."</td>
				<td  align=\"right\">Jurusan : ".getJurusan($nim)."</td> </tr>
			<tr><td  align=\"left\">NIM  : ".$nim."</td>
			<td  align=\"left\"></td> </tr>	
		</table>";
		}
	
	if ($no>41){
		echo"<br>
		<table border=1 cellpadding=1 cellspacing=0 width=650>
			<tr bgcolor=\"white\" align=\"center\"><td width=\"7%\" class='style1'><b>No.</b></td>
			<td width=\"15%\" class='style1'><b>Kode</b></td>
			<td width=\"40%\" class='style1'><b>Mata Kuliah</b></td>
			<td width=\"10%\" class='style1'><b>SKS</b></td><td width=\"10%\" class='style1'><b>Nilai</b></td>
			<td class='style1'><b>NilaixSKS</b></td></tr>".
			$detail2.
			"</table>";
	   }
	
	
	echo "
		<table border=1  cellpadding=1 cellspacing=0 width=\"650\" class='style1'><tr><td>
		  <table width=\"648\">
			<tr bgcolor=\"white\" align=\"center\"><td  align=\"left\" width=\"50%\">&nbsp;</td>
				<td  align=\"left\" >Total SKS yang telah diperoleh: ".$total_sks." </td> </tr>
			<tr bgcolor=\"white\" align=\"center\"><td  align=\"left\"></td>
			<td  align=\"left\">Indeks Prestasi Kumulatif : ".$ipk['ipk']."</td> </tr>
			</table></td></tr>
		</table>
		<br>
		
	<table border=0 width=650 cellpadding=0 cellspacing=0>
		<tr><td colspan='2' align=\"center\"></td></tr>
		<tr><td width=\"50%\" align=\"left\">Nilai D = ".$ipk['nilaiD']." SKS<br>
		Nilai E = ".$ipk['nilaiE']." SKS <br><br>";
		if ($lulus){
			if (substr($nim,1,1) == 5 || substr($nim,1,1) == 6){
				echo "Judul Pra Rancangan Pabrik:<br>".strtoupper($judul_rp)."\" <br><br>";;
			}
			echo "Judul Tugas Akhir/Skripsi:<br>\" ".strtoupper($judul)."\" <br> ";
		
		
		}
		else{ 
		echo "Catatan: Mahasiswa Tersebut Belum Dinyatakan Lulus Sebagai Mahasiswa STMI";
		}
		$tgl=(date("d")+0)." ".$BULAN[(date("n"))]." ".date("Y");
	echo "
		</td>
			<td align=\"center\">Jakarta, ".$tgl."<br><b>Ketua</b><br><br><br><br><br><br>
	
	
	
			  <b><u>Drs. Achmad Zawawi, MA.MM</u></b><br>
			   NIP: 195811171984031003</td></tr>
		<tr><td align=\"left\">
		
		<img src=\"/barcode/wrapper.php?p_bcType=1&p_text=".$nim."&p_xDim=1&p_w2n=3&p_charGap=1&p_invert=N&p_charHeight=30&p_type=1&p_label=N&p_rotAngle=0&p_checkDigit=N\">
		</td><td></td></tr>
	</table>
		
		";
	}//end of if not empty detail
}//end of function


function cetakKHS($nim,$periode,$thn_akademik){
	global $BULAN;

$theset=dosql("select * from krs
where thn_akademik='$thn_akademik' and periode='$periode' and status=1 and nim='$nim'
order by id_krs");

if (mysql_num_rows($theset)) {
	$no=1; $total_sks=0; $total_mutu=0;
	$detil = '';
	while ($row=mysql_fetch_array($theset)) {
		$mtk_set=dosql("select * from mtk_next where id_mtk='$row[id_mtk]' and periode='$periode' and thn_akademik='$thn_akademik'");
		$mtk=mysql_fetch_array($mtk_set);
		//cari kelas
		$kelas_set=dosql("select k.nama from kelas k, jadual j
		where k.id_kelas=j.id_kelas and j.id_jadual='$row[id_jadual]'");
		$kelas=mysql_fetch_array($kelas_set);
		//cari nilai terbaik
		$nilai_set=dosql("select k.id_krs, k.id_mtk, min(k.nilai) as nilai, m.mutu  
		from krs k, mutu m
		where k.id_mtk='$row[id_mtk]' and k.nim='$nim' and k.nilai<>'' and k.nilai = m.huruf 
		group by k.id_mtk");
		$nilai=mysql_fetch_array($nilai_set);
		if (!empty($nilai['id_krs']))
			$str_id=$nilai['id_krs'];
		else
			$str_id=$row['id_krs'];
		$detil = $detil."<tr bgcolor=\"white\" align=\"center\"><td align=\"right\" class='style1'>$no</td>".
		"<td class='style1'>$mtk[kd_mtk]</td>".
		"<td align=\"left\" class='style1'>$mtk[nama] </td><td class='style1'>$mtk[sks]</td>".
		"<td class='style1'>$nilai[nilai]</td>".
		"<td class='style1'>".($nilai['mutu']*$mtk['sks'])."</td></tr>\n";
		$total_mutu+=($nilai['mutu']*$mtk['sks']);
		$no++; $total_sks+=$mtk['sks'];
	}//end while
} //end if



	if (!empty($detil)){	
		echo cetakHeader();


		echo "
			<br>
			<table border=0 width=650 cellpadding=0 cellspacing=0>
				<tr><td colspan='2' align=\"center\"><u>Kartu Hasil Studi</u><br>Semester ".TulisPeriode($periode)." Tahun Akademik $thn_akademik</td></tr>
				<tr><td  align=\"left\" width=\"50%\">Nama : ".getNamaMhs($nim)."</td>
					<td  align=\"right\">Jurusan : ".getJurusan($nim)."</td> </tr>
				<tr><td  align=\"left\">NIM  : ".$nim."</td>
				<td  align=\"left\"></td> </tr>	
			</table>	
		";
		
	
		echo" <br>
		<table border=1 cellpadding=1 cellspacing=0 width=650>
			<tr bgcolor=\"white\" align=\"center\"><td width=\"7%\" class='style1'><b>No.</b></td>
			<td width=\"15%\" class='style1'><b>Kode</b></td>
			<td width=\"40%\" class='style1'><b>Mata Kuliah</b></td>
			<td width=\"10%\" class='style1'><b>SKS</b></td>
			<td width=\"10%\" class='style1'><b>Nilai</b></td>
			<td class='style1'><b>NilaixSKS</b></td></tr>".
			$detil.
			"</table>";
	   
		
		echo "
			<table border=0 width=650 cellpadding=0 cellspacing=0>
			<tr><td colspan='2' align=\"center\"></td></tr>
			<tr><td width=\"50%\" align=\"left\">Total SKS = ".$total_sks." SKS<br>
			Total Mutu = ".$total_mutu."<br>
			IPS = ".getIPS($nim, $thn_akademik, $periode)."<br><br>";
			
			$tgl=(date("d")+0)." ".$BULAN[(date("n"))]." ".date("Y");
		
		echo "
			</td>
				<td align=\"center\">
					<br><br><br>
					Jakarta, ".$tgl."<br><b>Kabag. Adm. Akademik dan Kemahasiswaan</b><br><br><br><br><br><br>
		
		
		
				  <b><u>Iqbal Faisal Ohorella</u></b><br>
				   NIP: 195905171982031005</td></tr>
			<tr><td align=\"left\">
			
			<img src=\"/barcode/wrapper.php?p_bcType=1&p_text=".$nim."&p_xDim=1&p_w2n=3&p_charGap=1&p_invert=N&p_charHeight=30&p_type=1&p_label=N&p_rotAngle=0&p_checkDigit=N\">
			</td><td></td></tr>
		</table>
			
			";
	}//end of if not empty detil		
}//end of function

function cetakKST($nim,$periode,$thn_akademik){
	global $BULAN;
	global $HARI;
	
	$detil = "";
	$theset=dosql("select k.id_krs, m.kd_mtk, m.nama as nama_mtk, m.sks, kls.nama as nama_kelas, 
	j.id_hari, time_format(j.jam_mulai, '%H:%i') as jammulai, j.id_jadual,
	time_format(j.jam_selesai, '%H:%i') as jamselesai, m.praktikum, r.nama as nama_ruang 
	from krs k, jadual j, mtk m, kelas kls, ruangan r 
	where k.id_jadual=j.id_jadual and j.id_mtk=m.id_mtk and kls.id_kelas=j.id_kelas and
	nim='$nim' and k.thn_akademik='$thn_akademik' and k.periode='$periode'
	and k.status=1 and j.id_ruangan = r.id_ruangan 
	order by id_krs");
	
	if (mysql_num_rows($theset)) {
		$no=1;
		$jml_sks=0;
		while ($row=mysql_fetch_array($theset)) {
//			$prak_set=dosql("select * from praktikum where id_jadual_prak='$row[id_jadual]'");
			//if (!mysql_num_rows($prak_set))
//				$str_hapus="<a href=\"krs_save.php?id=$row[id_krs]&action=Hapus\"><font color=\"red\">[ Hapus ]</a>";
			//else
				//$str_hapus="&nbsp;";
			$hr = $row['id_hari'];
			$detil=$detil."<tr bgcolor=\"white\" align=\"center\" valign=\"top\"><td align=\"right\" class='style1'>$no</td>".
			"<td class='style1'>$row[kd_mtk]</td><td align=\"left\" class='style1'>$row[nama_mtk] </td>".
			"<td class='style1'>$row[sks]</td><td class='style1'>$row[nama_kelas]</td><td class='style1'>$row[nama_ruang]</td>
			<td class='style1' align=\"left\" >{$HARI[$hr]}, $row[jammulai] - $row[jamselesai]</td>".
			"</tr>\n";
			$no++;
			$jml_sks = $jml_sks+$row['sks'];
		}
		$detil=$detil."<tr bgcolor=\"white\"><td colspan=3 align=\"center\"><b>Total</b></td>".
		"<td align=\"center\"><b>$jml_sks</b></td><td colspan=3>&nbsp;</td></tr>\n";
	}

	if (!empty($detil)){	
		echo cetakHeader();
	
		echo "
			<br>
			<table border=0 width=650 cellpadding=0 cellspacing=0>
				<tr><td colspan='2' align=\"center\"><u>Kartu Studi Tetap</u><br>Semester ".TulisPeriode($periode)." Tahun Akademik $thn_akademik</td></tr>
				<tr><td  align=\"left\" width=\"50%\">Nama : ".getNamaMhs($nim)."</td>
					<td  align=\"right\">Jurusan : ".getJurusan($nim)."</td> </tr>
				<tr><td  align=\"left\">NIM  : ".$nim."</td>
				<td  align=\"left\"></td> </tr>	
			</table>	
		";
	
		echo"<br>
		<table border=1 cellpadding=1 cellspacing=0 width=650>
			<tr bgcolor=\"white\" align=\"center\"><td width=\"7%\" class='style1'><b>No.</b></td>
			<td width=\"13%\" class='style1'><b>Kode</b></td>
			<td width=\"30%\" class='style1'><b>Mata Kuliah</b></td>
			<td width=\"5%\" class='style1'><b>SKS</b></td>
			<td width=\"7%\" class='style1'><b>Kelas</b></td>
			<td width=\"17%\" class='style1'><b>Ruang</b></td>
			<td class='style1'><b>Jadwal</b></td></tr>".
			$detil.
			"</table>";
	   
		
		echo "
			<table border=0 width=650 cellpadding=0 cellspacing=0>
			<tr><td colspan='2' align=\"center\"></td></tr>
			<tr><td width=\"50%\" align=\"left\">";
		echo "	<img src=\"/barcode/wrapper.php?p_bcType=1&p_text=".$nim."&p_xDim=1&p_w2n=3&p_charGap=1&p_invert=N&p_charHeight=30&p_type=1&p_label=N&p_rotAngle=0&p_checkDigit=N\">";
			
			$tgl=(date("d")+0)." ".$BULAN[(date("n"))]." ".date("Y");
		
		echo "
			</td>
				<td align=\"center\">
					<br><br><br>
					Jakarta, ".$tgl."<br><b>Kabag. Adm. Akademik dan Kemahasiswaan</b><br><br><br><br><br><br>
		
		
		
				  <b><u>Iqbal Faisal Ohorella</u></b><br>
				   NIP: 195905171982031005</td></tr>
		</table>
			
			";
	}//end of not empty detil		
}//end of function


function cetakKartuUjian($nim,$periode,$thn_akademik){
	global $BULAN;
	global $HARI;
	
	$detil = "";
	$theset=dosql("select k.id_krs, m.kd_mtk, m.nama as nama_mtk, m.sks, kls.nama as nama_kelas, 
	j.id_hari, time_format(j.jam_mulai, '%H:%i') as jammulai, j.id_jadual,
	time_format(j.jam_selesai, '%H:%i') as jamselesai, m.praktikum 
	from krs k, jadual j, mtk_next m, kelas kls 
	where k.id_jadual=j.id_jadual and j.id_mtk=m.id_mtk and kls.id_kelas=j.id_kelas and
	nim='$nim' and k.thn_akademik='$thn_akademik' and k.periode='$periode'
	and k.status=1 and m.periode=k.periode and m.thn_akademik=k.thn_akademik and m.nama not like '%praktikum%' and m.nama not like '%praktek.%' 
	order by id_krs");
	
	if (mysql_num_rows($theset)) {
		$no=1;
		//$jml_sks=0;
		while ($row=mysql_fetch_array($theset)) {
//			$prak_set=dosql("select * from praktikum where id_jadual_prak='$row[id_jadual]'");
			//if (!mysql_num_rows($prak_set))
//				$str_hapus="<a href=\"krs_save.php?id=$row[id_krs]&action=Hapus\"><font color=\"red\">[ Hapus ]</a>";
			//else
				//$str_hapus="&nbsp;";
				$sks = $row['sks'];
				$sks_prak_set = dosql("select m.sks, p.id_jadual, p.id_jadual_prak from jadual j, mtk_next m, praktikum p where p.id_jadual =
				 '$row[id_jadual]' and p.id_jadual_prak = j.id_jadual and j.id_mtk = m.id_mtk and m.periode='$periode' and m.thn_akademik= '$thn_akademik'");
		
				 if(mysql_num_rows($sks_prak_set)>0) {
					 $sks_prak = mysql_fetch_array($sks_prak_set);
					 $sks = $sks + $sks_prak['sks'];
				 }
			
			$detil=$detil."<tr bgcolor=\"white\" align=\"center\" valign=\"top\"><td align=\"right\" class='style1'>$no</td>".
			"<td class='style1'>$row[kd_mtk]</td><td align=\"left\" class='style1'>$row[nama_mtk] </td>".
			"<td class='style1'>$sks</td><td class='style1'>$row[nama_kelas]</td><td class='style1'><table>";
			if ($no%2 == 1){ 
				$detil=$detil."<tr><td ><br>............................</td><td width=100></td></tr>";
			}else{
				$detil=$detil."<tr><td width=100></td><td><br>............................</td></tr>";
			}
			$detil=$detil."</table></td></tr>\n";
			$no++;
			//$jml_sks = $jml_sks+$row[sks];
		}
	}
	
	
	if (!empty($detil)){	

		echo cetakHeader();
	
		echo "
			<br>
			<table border=0 width=650 cellpadding=0 cellspacing=0>
				<tr><td colspan='2' align=\"center\"><u>KARTU UJIAN</u><br>Semester ".TulisPeriode($periode)." Tahun Akademik $thn_akademik<br><br></td></tr>
				<tr><td  align=\"left\" width=\"50%\">Nama : ".getNamaMhs($nim)."</td>
					<td  align=\"right\">Jurusan : ".getJurusan($nim)."</td> </tr>
				<tr><td  align=\"left\">NIM  : ".$nim."</td>
				<td  align=\"left\"></td> </tr>	
			</table>	
		";
	
		echo"
		<table border=1 cellpadding=1 cellspacing=0 width=650>
			<tr bgcolor=\"white\" align=\"center\"><td width=\"7%\" class='style1'><b>No.</b></td>
			<td width=\"13%\" class='style1'><b>Kode</b></td>
			<td width=\"30%\" class='style1'><b>Mata Kuliah</b></td>
			<td width=\"5%\" class='style1'><b>SKS</b></td>
			<td width=\"7%\" class='style1'><b>Kelas</b></td>
			<td class='style1' ><b>TTD Pengawas</b></td></tr>".
			$detil.
			"</table>";
	   
			$tgl=(date("d")+0)." ".$BULAN[(date("n"))]." ".date("Y");
		
		echo "
			<table border=0 width=650 cellpadding=0 cellspacing=0>
			<tr><td colspan='2' align=\"center\"></td></tr>
			<tr><td align=\"left\"><br><br>
			<table><tr><td class='style1' width=100 height=100 align=\"center\">Pas photo<br> 3x4 <td></tr></table></td><td align=\"center\">
					<br><br><br>
					Jakarta, ".$tgl."<br><b>Kabag. Adm. Akademik dan Kemahasiswaan</b><br><br><br><br><br><br>
		
		
		
				  <b><u>Iqbal Faisal Ohorella</u></b><br>
				   NIP: 195905171982031005</td></tr>
			<tr><td width=\"50%\" align=\"left\">";
		echo "	<img src=\"/barcode/wrapper.php?p_bcType=1&p_text=".$nim."&p_xDim=1&p_w2n=3&p_charGap=1&p_invert=N&p_charHeight=30&p_type=1&p_label=N&p_rotAngle=0&p_checkDigit=N\">";
			
		
		echo "
			</td><td></td>
				</tr>
		</table>
			
			";
	}//end of not empty detil		
}//end of function

?>
