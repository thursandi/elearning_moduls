<!DOCTYPE html>
<html>
	<head>
		<title>Upload File Biodata Mahasiswa</title>
	</head>
	<body bgcolor="#E0FFFF">
	<h1>Upload File Biodata Mahasiswa</h1>
		<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		include 'koneksi.php';
		if($_POST['simpan']){
			$ekstensi_diperbolehkan	= array('rar','pdf');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];
            
            $nim    = $_POST['nim'];	
            $no_ktp = $_POST['nik'];
            $nm_ibu = $_POST['nm_ibu'];
            
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, 'file/'.$nama);
					$query = mysql_query("INSERT INTO uploaddata VALUES(NULL, '$nim', '$no_ktp', '$nm_ibu', '$nama')");
					if($query){
						echo 'FILE BERHASIL DI UPLOAD';
					}else{
						echo 'GAGAL MENGUPLOAD GAMBAR';
					}
				}else{
					echo 'UKURAN FILE TERLALU BESAR';
				}
			}else{
				echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
			}
		}
		?>

		<br/>
		<br/>
		<a href="index.php">Upload Lagi</a>
		<br/>
		<br/>

		<table>
			<?php 
			//$data = mysql_query("select * from uploaddata");
			//while($d = mysql_fetch_array($data)){
			?>
			<tr>
				<td>
					<img src="<?php //echo "file/".$d['nama_file']; ?>">
				</td>		
			</tr>
			<?php //} ?>
		</table>
	</body>
</html>