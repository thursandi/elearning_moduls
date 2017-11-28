
                <div class="wrapper">
                    
                    <div class="column c-67 clearfix">
                        <div class="box contactUs ">
                            <h4><span>Pendaftaran Mahasiswa Baru Online</span></h4>
                                <div class="boxInfo contactForm">

                                    <div <?php echo $status;?>>
                                        <div class="alert alert-success"><i>Data pendaftaran online telah kami diterima. Untuk informasi lanjutan Penerimaan Mahasiswa Baru dapat dilihat di <b>menu Berita Penerimaan Mahasiswa Baru dan email Anda</b>. Terima Kasih.</i></div>
                                    </div>
									
									 <div <?php echo $status2;?>>
										<div class="alert alert-error"><i>Anda telah melakukan pendaftaran online, Anda hanya bisa satu kali mendaftarkan diri Anda. Terima Kasih.</i></div>
                                    </div>


<?php
/* data pribadi 
$nik = array(
    'name'  => 'nik',
    'id'    => 'contactName',
    'value' => set_value('nik'),
    'maxlength' => 16,
    'placeholder'=> 'Nomor Induk Kependudukan Anda',
);
$nama = array(
    'name'  => 'nama',
    'id'    => 'contactName',
    'value' => set_value('nama'),
    'maxlength' => 30,
    'placeholder'=> 'Nama Anda',
);
$npwp = array(
    'name'  => 'npwp',
    'id'    => 'contactName',
    'value' => set_value('npwp'),
    'maxlength' => 15,
    'placeholder'=> 'Nomor Pokok Wajib Pajak (Opsional, diisi angka, tanpa spasi)',
);

$jenis_kelamin = array(
    '' => '---pilih---',
    'P'  => 'Perempuan',
    'L'  => 'Laki-laki',
     
);

$tempat_lahir = array(
    'name'  => 'tempat_lahir',
    'id'    => 'contactName',
    'value' => set_value('tempat_lahir'),
    'maxlength' => 30,
    'placeholder'=> 'Tempat Lahir Anda',
);

$tgl_lahir = array(
    'name'  => 'tgl_lahir',
    'id'    => 'datepicker',
    'readonly'=>'true',
    'placeholder'=> 'Tanggal Lahir Anda',
    //'type'=> 'date',
);

$agama = array(
    '' => '---pilih---',
    '1'  => 'Islam',
    '2'  => 'Kristen Protestan',
    '3'  => 'Kristen Katolik',
    '4'  => 'Hindu',
    '5'  => 'Buddha',
    '6'  => 'Konghuchu',
     
);

$golongan_darah = array(
    '' => '---pilih---',
    'A'  => 'A',
    'B'  => 'B',
    'AB'  => 'AB',
    'O'  => 'O',
     
);

$nama_ortu = array(
    'name'  => 'nama_ortu',
    'id'    => 'contactName',
    'value' => set_value('nama_ortu'),
    'maxlength' => 30,
    'placeholder'=> 'Nama Orang Tua/Wali Anda',
);

$alamat = array(
    'name'  => 'alamat',
    'id'    => 'contactMessage',
    'value' => set_value('alamat'),
    'maxlength' => 255,
	'placeholder'=> 'Alamat Lengkap Rumah Anda (tanpa enter)',

);

$rt = array(
    'name'  => 'rt',
    'id'    => 'contactName',
    'value' => set_value('rt'),
    'maxlength' => 3,
    'placeholder'=> 'Nomor RT Alamat Anda',
    'style'=> 'width:250px',
);

$rw = array(
    'name'  => 'rw',
    'id'    => 'contactName',
    'value' => set_value('rw'),
    'maxlength' => 3,
    'placeholder'=> 'Nomor RW Alamat Anda',
    'style'=> 'width:250px',
);

$kota = array(
    'name'  => 'kota',
    'id'    => 'contactName',
    'value' => set_value('kota'),
    'maxlength' => 30,
    'placeholder'=> 'Nama Kota Alamat Anda',
    'style'=> 'width:250px',
);

$kodepos = array(
    'name'  => 'kodepos',
    'id'    => 'contactName',
    'value' => set_value('kodepos'),
    'maxlength' => 5,
    'placeholder'=> 'Nomor Kodepos Alamat Anda',
    'style'=> 'width:250px',
);

$telepon = array(
    'name'  => 'telepon',
    'id'    => 'contactName',
    'value' => set_value('telepon'),
    'maxlength' => 20,
    'placeholder'=> 'Nomor Telepon Anda (tanpa spasi)',
);

$handphone = array(
    'name'  => 'handphone',
    'id'    => 'contactName',
    'value' => set_value('handphone'),
    'maxlength' => 15,
    'placeholder'=> 'Nomor Handphone Anda (tanpa spasi)',
);

$email = array(
    'name'  => 'email',
    'id'    => 'contactName',
    'value' => set_value('email'),
    'maxlength' => 100,
    'placeholder'=> 'Email Anda',
);

/* data pribadi */

/* data sekolah 

$asal_sekolah = array(
    'name'  => 'asal_sekolah',
    'id'    => 'contactName',
    'value' => set_value('asal_sekolah'),
    'maxlength' => 70,
    'placeholder'=> 'Asal Sekolah Anda',
);

$alamat_sekolah = array(
    'name'  => 'alamat_sekolah',
    'id'    => 'contactMessage',
    'value' => set_value('alamat_sekolah'),
    'maxlength' => 100,
	'placeholder'=> 'Alamat Lengkap Sekolah Anda (tanpa enter)',
);

$kota_sekolah = array(
    'name'  => 'kota_sekolah',
    'id'    => 'contactName',
    'value' => set_value('kota_sekolah'),
    'maxlength' => 30,
    'placeholder'=> 'Kota Asal Sekolah Anda',
);

$jurusan_sekolah = array(
    'name'  => 'jurusan_sekolah',
    'id'    => 'contactName',
    'value' => set_value('jurusan_sekolah'),
    'maxlength' => 50,
    'placeholder'=> 'Jurusan Sekolah Anda',
);


$tahun_ijazah_sekolah = array(
    'name'  => 'tahun_ijazah_sekolah',
    'id'    => 'contactName',
    'value' => set_value('tahun_ijazah_sekolah'),
    'maxlength' => 4,
    'placeholder'=> 'Tahun Ijazah Anda',
);

$ranking_sekolah = array(
    'name'  => 'ranking_sekolah',
    'id'    => 'contactName',
    'value' => set_value('ranking_sekolah'),
    'maxlength' => 4,
    'placeholder'=> 'Ranking Terkahir Anda',
);

/* data sekolah */

/* data pemilihan jurusan */

$jurusan_kuliah = array(
    '' => '---pilih---',
    'tmi'  => 'Teknik Industri Otomotif',
    'si'  => 'Sistem Informasi Industri Otomotif',
    'mbi'  => 'Administrasi Bisnis Otomotif',
    'tki'  => 'Teknik Kimia Polimer',
     
);

$sumberinfo_kuliah = array(
    '' => '---pilih---',
    '1'  => 'brosur/leaflet',
    '2'  => 'spanduk',
    '3'  => 'internet',
    '4'  => 'iklan koran',
    '5'  => 'teman',
    '6'  => 'keluarga',
    '7'  => 'kunjungan/presentasi di sekolah',
    '8'  => 'pameran',
     
);

$waktu_kuliah = array(
    '' => '---pilih---',
    '1'  => 'Pagi/Siang',
     
);
/* data pemilihan jurusan */

$upload_dokumen = array(
    'name' => 'upload_dokumen', 

    );
$upload_foto = array(
    'name' => 'upload_foto', 

    );
$form_class = array('class' => '');

?>


                                    <?php echo form_open_multipart($this->uri->uri_string(),$form_class ); ?>

<!-- start data pribadi 
<div style="border:1px solid #bababa;padding:7px;"><h5>Data Pribadi:</h5>
                                        <div>
                                            <label>NIK<em style="color:red;">*</em>:</label>
                                            <?php //echo form_input($nik, '', (form_error('nik') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($nik['name']); ?><?php //echo isset($errors[$nik['name']])?$errors[$nik['name']]:''; ?>
                                        </div>
										<div>
                                            <label>Nama<em style="color:red;">*</em>:</label>
                                            <?php //echo form_input($nama, '', (form_error('nama') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($nama['name']); ?><?php //echo isset($errors[$nama['name']])?$errors[$nama['name']]:''; ?>
                                        </div>
										 <div>
                                            <label>NPWP:</label>
                                            <?php //echo form_input($npwp, '', (form_error('npwp') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($npwp['name']); ?><?php //echo isset($errors[$npwp['name']])?$errors[$npwp['name']]:''; ?>
                                        </div>

                                        <div>
                                            <label>Jenis Kelamin<em style="color:red;">*</em>:</label>
                                            <?php //echo form_dropdown('jenis_kelamin',$jenis_kelamin,'',(form_error('jenis_kelamin') ? 'id="contactName" class="tabel_merah"' : 'id="contactName"') ); ?><br>
                                            <?php //echo form_error('jenis_kelamin'); ?>
                                        </div>

                                        <div>
                                            <label>Tempat Lahir<em style="color:red;">*</em>:</label>
                                            <?php //echo form_input($tempat_lahir, '', (form_error('tempat_lahir') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($tempat_lahir['name']); ?><?php //echo isset($errors[$tempat_lahir['name']])?$errors[$tempat_lahir['name']]:''; ?>
                                        </div>

                                        <div>
                                            <label>Tanggal Lahir<em style="color:red;">*</em>:</label>
                                            <?php //echo form_input($tgl_lahir, '', (form_error('tgl_lahir') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($tgl_lahir['name']); ?><?php //echo isset($errors[$tgl_lahir['name']])?$errors[$tgl_lahir['name']]:''; ?>
                                        </div>

                                        <div>
                                            <label>Agama<em style="color:red;">*</em>:</label>
                                            <?php //echo form_dropdown('agama',$agama,'',(form_error('agama') ? 'id="contactName" class="tabel_merah"' : 'id="contactName"') ); ?><br>
                                            <?php //echo form_error('agama'); ?>
                                        </div>

                                        <div>
                                            <label>Golongan Darah<em style="color:red;">*</em>:</label>
                                            <?php //echo form_dropdown('golongan_darah',$golongan_darah,'',(form_error('golongan_darah') ? 'id="contactName" class="tabel_merah"' : 'id="contactName"') ); ?><br>
                                            <?php //echo form_error('golongan_darah'); ?>
                                        </div>

                                        <div>
                                            <label>Nama Ibu Kandung<em style="color:red;">*</em>:</label>
                                            <?php //echo form_input($nama_ortu, '', (form_error('nama_ortu') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($nama_ortu['name']); ?><?php //echo isset($errors[$nama_ortu['name']])?$errors[$nama_ortu['name']]:''; ?>
                                        </div>

                                        <div>
                                            <label>Alamat<em style="color:red;">*</em>:</label>
                                            <?php //echo form_textarea($alamat, '', (form_error('alamat') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($alamat['name']); ?><?php //echo isset($errors[$alamat['name']])?$errors[$alamat['name']]:''; ?>
                                        </div>


                                        <div>
                                            <label>RT:</label>
                                            <?php //echo form_input($rt, '', (form_error('rt') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($rt['name']); ?><?php //echo isset($errors[$rt['name']])?$errors[$rt['name']]:''; ?>
                                        </div>

                                        <div>
                                            <label>RW:</label>
                                            <?php //echo form_input($rw, '', (form_error('rw') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($rw['name']); ?><?php //echo isset($errors[$rw['name']])?$errors[$rw['name']]:''; ?>
                                        </div>

                                        <div>
                                            <label>Kota<em style="color:red;">*</em>:</label>
                                            <?php //echo form_input($kota, '', (form_error('kota') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($kota['name']); ?><?php //echo isset($errors[$kota['name']])?$errors[$kota['name']]:''; ?>
                                        </div>

                                        <div>
                                            <label>Kodepos:</label>
                                            <?php //echo form_input($kodepos, '', (form_error('kodepos') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($kodepos['name']); ?><?php //echo isset($errors[$kodepos['name']])?$errors[$kodepos['name']]:''; ?>
                                        </div>

                                        <div>
                                            <label>No. Telepon:</label>
                                            <?php //echo form_input($telepon, '', (form_error('telepon') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($telepon['name']); ?><?php //echo isset($errors[$telepon['name']])?$errors[$telepon['name']]:''; ?>
                                        </div>

                                        <div>
                                            <label>No. Handphone<em style="color:red;">*</em>:</label>
                                            <?php //echo form_input($handphone, '', (form_error('handphone') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($handphone['name']); ?><?php //echo isset($errors[$handphone['name']])?$errors[$handphone['name']]:''; ?>
                                        </div>

                                        <div>
                                            <label>Email Aktif<em style="color:red;">*</em>:</label>
                                            <?php //echo form_input($email, '', (form_error('email') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($email['name']); ?><?php //echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
                                        </div>

</div>
<!-- end data pribadi -->


<!-- start data sekolah 
<div style="border:1px solid #bababa;padding:7px;"><h5>Data Sekolah:</h5>
                                        <div>
                                            <label>Asal Sekolah<em style="color:red;">*</em>:</label>
                                            <?php //echo form_input($asal_sekolah, '', (form_error('asal_sekolah') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($asal_sekolah['name']); ?><?php //echo isset($errors[$asal_sekolah['name']])?$errors[$asal_sekolah['name']]:''; ?>
                                        </div>

                                        <div>
                                            <label>Alamat Sekolah<em style="color:red;">*</em>:</label>
                                            <?php //echo form_textarea($alamat_sekolah, '', (form_error('alamat_sekolah') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($alamat_sekolah['name']); ?><?php //echo isset($errors[$alamat_sekolah['name']])?$errors[$alamat_sekolah['name']]:''; ?>
                                        </div>

                                        <div>
                                            <label>Kota Asal Sekolah<em style="color:red;">*</em>:</label>
                                            <?php //echo form_input($kota_sekolah, '', (form_error('kota_sekolah') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($kota_sekolah['name']); ?><?php //echo isset($errors[$kota_sekolah['name']])?$errors[$kota_sekolah['name']]:''; ?>
                                        </div>

                                        <div>
                                            <label>Jurusan<em style="color:red;">*</em>:</label>
                                            <?php //echo form_input($jurusan_sekolah, '', (form_error('jurusan_sekolah') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($jurusan_sekolah['name']); ?><?php //echo isset($errors[$jurusan_sekolah['name']])?$errors[$jurusan_sekolah['name']]:''; ?>
                                        </div>

                                        <div>
                                            <label>Tahun Ijazah<em style="color:red;">*</em>:</label>
                                            <?php //echo form_input($tahun_ijazah_sekolah, '', (form_error('tahun_ijazah_sekolah') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($tahun_ijazah_sekolah['name']); ?><?php //echo isset($errors[$tahun_ijazah_sekolah['name']])?$errors[$tahun_ijazah_sekolah['name']]:''; ?>
                                        </div>

                                        <div>
                                            <label>Ranking Waktu Sekolah:</label>
                                            <?php //echo form_input($ranking_sekolah, '', (form_error('ranking_sekolah') ? 'class="tabel_merah"' : '') ); ?><br>
                                            <?php //echo form_error($ranking_sekolah['name']); ?><?php //echo isset($errors[$ranking_sekolah['name']])?$errors[$ranking_sekolah['name']]:''; ?>
                                        </div>

</div>
<!-- end data sekolah -->

<!-- start data jurusan -->
<div style="border:1px solid #bababa;padding:7px;"><h5>Data Pemilihan Jurusan:</h5>
                                        <div>
                                            <label>Jurusan yang dipilih<em style="color:red;">*</em>:</label>
                                            <?php echo form_dropdown('jurusan_kuliah',$jurusan_kuliah,'',(form_error('jurusan_kuliah') ? 'id="contactName" class="tabel_merah"' : 'id="contactName"') ); ?><br>
                                            <?php echo form_error('jurusan_kuliah'); ?>
                                        </div>

                                        <div>
                                            <label>Waktu Kuliah<em style="color:red;">*</em>:</label>
                                            <?php echo form_dropdown('waktu_kuliah',$waktu_kuliah,'',(form_error('waktu_kuliah') ? 'id="contactName" class="tabel_merah"' : 'id="contactName"') ); ?><br>
                                            <?php echo form_error('waktu_kuliah'); ?>
                                        </div>

                                        <div>
                                            <label>Sumber Informasi<em style="color:red;">*</em>:</label>
                                            <?php echo form_dropdown('sumberinfo_kuliah',$sumberinfo_kuliah,'',(form_error('sumberinfo_kuliah') ? 'id="contactName" class="tabel_merah"' : 'id="contactName"') ); ?><br>
                                            <?php echo form_error('sumberinfo_kuliah'); ?>
                                        </div>


										<!-- start upload foto-->
                                        <div>
                                                <label>
													Upload Foto (nama file: Nama_TglBlnThnlahir | irine_08121995.jpg) <em style="color:red;">*</em>:
													<br>
													- <b>Pas Foto Berwarna Terbaru 3x4</b> (*.jpg & ukuran file < 300Kb)<br>
                                                <br>
                                                </label>
                                                <?php echo form_upload($upload_foto); ?>
												<div align="right">
                                                    <p>
                                                        <?php echo form_error('upload_foto'); ?><?php echo $errors;?>
                                                    </p>
                                                </div>
                                        </div>
                                        <!-- end upload foto-->

                                    
                                        <!-- start upload -->
                                        <div>
                                                <label>
													Upload (zip/rar) (nama file: Nama_TglBlnThnlahir | irine_08121995.rar)<em style="color:red;">*</em>:
													<br>
													Rincian isi dari zip/rar (ukuran file < 2MB):<br>
                                                    - <b>Scan Asli/Fotocopy Ijazah</b><br>
													- <b>Scan Asli/Fotocopy Transkrip Nilai</b><br>
													- <b>Scan Bukti Transfer Pembayaran Uang Pendaftaran</b><br>
													- <b>Scan Asli/Fotocopy Kartu Keluarga</b><br>
													- <b>Scan Asli/Fotocopy KTP</b><br>
													- <b>Scan Asli/Fotocopy NPWP</b><br>
												<br>
                                                </label>
                                                <?php echo form_upload($upload_dokumen); ?>
                                                <div>
                                                    <p>
                                                        <?php echo form_error('upload_dokumen'); ?><?php echo $errors;?>
                                                    </p>
                                                </div>
                                        </div>
                                        <!-- end upload -->

</div>
<!-- end data jurusan -->


<!-- start kode keamanan -->
<div style="border:1px solid #bababa;padding:7px;"><h5>Kode Keamanan:</h5>

                                        <div class="c-67">
                                                <?php echo $recaptcha_html; ?>
                                                <div><p><?php echo form_error('recaptcha_response_field'); ?></p></div>
                                        </div>
</div>
<!-- end kode keamanan -->
                                    <div>
                                        <input id="contactSubmit" class=" c-33" type="submit" value="Kirim" onclick="show()"/>
                                    </div>
                                
                                <?php echo form_close(); ?>
                                
                                <div id = "myDiv" style="display:none">
                                    <img id = "myImage" src = "<?=base_url();?>images/loader.gif">
                                    <p>data sedang diproses</p>
                                </div>
<script type = "text/javascript">
function show() {
document.getElementById("myDiv").style.display="block";
setTimeout("hide()", 200000);  // 5 seconds
}

function hide() {
document.getElementById("myDiv").style.display="none";
}
</script>
                                
                            </div>
                        </div>
                    </div>