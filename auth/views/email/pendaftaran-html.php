<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sistem Pendaftaran Online Mahasiswa Baru <?php echo $site_name; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
  <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
    <tr>
      <td style="padding: 10px 0 30px 0;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
          <tr>
            <td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
              <img src="<?php echo base_url();?>images/logo_stmi.png" alt="Creating Email Magic" width="210" height="230" style="display: block;" />
            </td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
                    <b>Sistem PMB Online <?php echo $site_name; ?></b>
                  </td>
                </tr>
                <tr>
                  <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                    Selamat datang di sistem PMB Online <?php echo $site_name; ?>. Terima kasih telah mendaftar pada <?php echo $site_name; ?>. Kami akan segera memproses berkas dokumen yang Anda lampirkan.
                  </td>
                </tr>

                <tr>
                  <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                    Informasi mengenai pendaftaran Anda:
                  </td>
                </tr>

                <tr>
                  <td>
                    
                    <table style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                      <tr>
                        <td>No. Seri</td>
                        <td>:</td>
                        <td><?php echo $no_seri; ?></td>
                      </tr>
                      <tr>
                        <td>Nama Calon Mahasiswa</td>
                        <td>:</td>
                        <td><?php echo $nama; ?></td>
                      </tr>
                      <tr>
                        <td>Program Studi yang dipilih</td>
                        <td>:</td>
                        <td><?php echo $prodi; ?></td>
                      </tr>
                      <tr>
                        <td>Waktu Kuliah yang dipilih</td>
                        <td>:</td>
                        <td><?php echo $waktu_kuliah; ?></td>
                      </tr>
                    </table>

                  </td>
                </tr>

                <tr>
                  <td style="padding: 20px 0 30px 0;color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                    Catatan: <i>Bebas ujian test masuk, khusus bagi pendaftar yang berprestasi (ranking 1-10)
                  </td>
                </tr>

                <tr>
                  <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                    Untuk informasi seputar Pendaftaran Mahasiswa Baru di STMI, silahkan kunjungi link berikut:<br />
<nobr><a href="<?php echo base_url();?>berita/arsip/berita_pmb" style="color: #3366cc;"><?php echo base_url();?>berita/arsip/berita_pmb</a></nobr>
                  </td>
                </tr>

                <tr>
                  <td style="padding: 20px 0 30px 0;color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                    Untuk kritik dan saran, silahkan kunjungi link berikut:<br />
<nobr><a href="<?php echo base_url();?>kontak" style="color: #3366cc;"><?php echo base_url();?>kontak</a></nobr>
                  </td>
                </tr>

                <tr>
                  <td style="padding: 20px 0 30px 0;color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                    
                      
                      <hr>
                      Demikian informasi yang kami sampaikan. Terima kasih.
                  </td>
                </tr>

              </table>
            </td>
          </tr>
          <tr>
            <td bgcolor="#3C4B7C" style="padding: 30px 30px 30px 30px;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
                     <i> Web Master <?php echo $site_name; ?>,</i> Copyright © 2013 | Pusdata STMI<br/>
                    <a href="<?php echo base_url();?>" style="color: #ffffff;"><font color="#ffffff">stmi.ac.id</font></a> Sekolah Tinggi Manajemen Industri
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>