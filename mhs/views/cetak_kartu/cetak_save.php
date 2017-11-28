<?php
include "base.php";
//include "../base.php";

$periode = $_POST['periode'];
$thn_akademik = $_POST['thn_akademik'];
?>

<html>
<title>Transkrip Nilai</title>
<?php 
if ($action == "Cetak_Transkrip"){
	echo "<style type=\"text/css\">
	td {font-family:\"arial\"; font-size:8pt}
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
	</style>";
}else{
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
	</style>";

}
?>
</HEAD>
<body bgcolor="white"><center>

<?php
$nimmulai = $id;
if ($nimmulai <> ""){
	if ($nimselesai == ""){
		$nimselesai = $nimmulai;
	} else{
		if ((substr($nimmulai,1,4)) != (substr($nimselesai,1,4))){
			exit;
		}
	}
	if ($action == "Cetak_Transkrip"){
		echo cetakTranskrip($nimmulai);
		$i = $nimmulai +1;
		while ($i <=$nimselesai){
			//echo "\n";
			echo "<p style=\"page-break-after:always;\"></p>";
			echo cetakTranskrip($i);
			$i++;
		}
	}else if ($action == "Cetak_KHS"){
	    //echo "thn = $thn_akademik, periode = $periode";
		if (isMahasiswaAktif($nimmulai,$thn_akademik,$periode)){
			echo cetakKHS($nimmulai,$periode,$thn_akademik);}
		$i = $nimmulai +1;
		while ($i <=$nimselesai){
			if (isMahasiswaAktif($i,$thn_akademik,$periode)){			
				echo "<p style=\"page-break-after:always;\"></p>";
				echo cetakKHS($i,$periode,$thn_akademik);
			}
			$i++;
		}
	
	}else if ($action == "Cetak_KST"){
	
		if (isMahasiswaAktif($nimmulai,$thn_akademik,$periode))
		echo cetakKST($nimmulai,$periode,$thn_akademik);
		$i = $nimmulai +1;
		while ($i <=$nimselesai){
			if (isMahasiswaAktif($i,$thn_akademik,$periode)){			
				echo "<p style=\"page-break-after:always;\"></p>";
				echo cetakKST($i,$periode,$thn_akademik);
			}
			$i++;
		}
	
	}else if ($action == "Kartu_Ujian"){
		//echo isLunas($nimmulai,$thn_akademik,$periode);
		if (isMahasiswaAktif($nimmulai,$thn_akademik,$periode) && isLunas($nimmulai,$thn_akademik,$periode))
			echo cetakKartuUjian($nimmulai,$periode,$thn_akademik);
		$i = $nimmulai +1;
		while ($i <=$nimselesai){
			if (isMahasiswaAktif($i,$thn_akademik,$periode)&& isLunas($i,$thn_akademik,$periode)){			
				echo "<p style=\"page-break-after:always;\"></p>";
				echo cetakKartuUjian($i,$periode,$thn_akademik);
			}
			$i++;
		}
	
	}

}
?>
</center>
</body>
