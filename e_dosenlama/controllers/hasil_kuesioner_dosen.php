<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HMVC Codeigniter
 *
 * @package    	Cetak_nilai <controller>
 * @copyright  	Copyright (c) 2013, Kasino
 * @author     	Kasino <ezz_chocolate@yahoo.com>
 */

class Hasil_kuesioner_dosen extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

    $this->db_2 = $this->load->database('otherdb', TRUE); 
    $this->tipe_user = simple_decrypt($this->session->userdata('tipe_user'));

		$this->load->helper('url');
		$this->load->library('tank_auth');
    $this->load->model('e_dosen/e_dosen_model');
	 $this->load->model('mhs/mhs_model');
    $this->load->model('e_dosen/hasil_kuesioner_model');
		$this->load->library('pagination');

		$this->load->library('menu_otomatis');
		$this->load->library('data_pendukung');

    date_default_timezone_set("Asia/Jakarta");


    $this->load->config('tank_auth', TRUE);

    $this->load->library('session');
    $this->load->database();
    $this->load->model('auth/users');

    //global vars
    $this->load->vars(array(
        'user_id' =>  $this->session->userdata('user_id'),
        'username' =>  $this->session->userdata('username'),
        'tipe_user' =>  $this->session->userdata('tipe_user'),
        'nama_asli' =>  $this->session->userdata('nama_asli'),
        'email' =>  $this->session->userdata('email'),
    ));
    //global vars


	}

  private $db_2;


  public function index()
  {

        if (!$this->tank_auth->is_logged_in()) {
          redirect('/auth/login/');
        }

        //cek tipe user
		if( $this->tipe_user != '2'){
          redirect('/e_dosen');
        }

          $data['title'] = 'Kuesioner Penilaian Mahasiswa';//replace - menjadi spasi pada judul
          $data['description'] = 'Kuesioner Dosen STMI';
          $data['keywords'] = 'Kuesioner dosen, stmi dosen';

          $data['thn_akademik_kuesioner'] =$this->hasil_kuesioner_model->thn_akademik_kuesioner();
          
          //isi konten
          $data['isicontent'] = 'e_dosen/hasil_kuesioner_dosen/_hasil_kuesioner_dosen';
          $data['menu_header'] = $this->menu_otomatis->create_menu_admin(0, 1, 'menu_admin_elearning_dosen');
          $this->load->view('e_dosen/_layout',$data); 
  }

  
  public function get_mata_kuliah_kues()
  {
        if (!$this->tank_auth->is_logged_in()) {
          redirect('/auth/login/');
        }

		if( $this->tipe_user != '2'){
          redirect('/e_dosen');
        }

        $thnperiode=$this->input->post('thn_periode');
		//echo 'aaaaaaaaaa';
//echo $thnperiode;
		
        $y=$this->hasil_kuesioner_model->get_mata_kuliah_kues_dosen($thnperiode, $this->session->userdata('nama_asli'));
		//echo $y;
		$tabel=' <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                  <th>No Urut</th>
                                  <th>Thn. Akademik</th>
                                  <th>Periode</th>
                                  <th>Kode MTK</th>
                                  <th>Nama Matakuliah</th>
								   <th>Nama Dosen</th>
									<th>&Sigma; Nilai Kuesioner<br>Skala 0-4</th>
									<th>Cetak </th>
									
                                </tr>
                            </thead>
                            <tbody>';
		
		$n=1;		
		foreach ($y->result_array() as $row) {
            $tabel.='<tr>
					<td>'.$n.'</td>
					<td>'.$row['thn_akademik'].'</td>
					<td>'.$row['periode'].'</td>
					<td>'.$row['kd_mtk'].'</td>
					<td>'.$row['nama_matkul'].'</td>
					<td>'.str_replace('*', $row['nama_dosen'].', ', $row['gelar_dosen']) .'</td>
					<td>'.$row['total_nilai_kuesioner'].'</td>
					<td><a target="_blank" href="'.base_url().'e_dosen/hasil_kuesioner_dosen/rincian_data_kuesioner/'.my_number_encrypt($row['id_jadual']).' ">cetak</a></td>
					</tr>';
			
			$n++;
        }

        $tabel .='         </tbody>
		
                   </table>';
        
		
		
		
        echo $tabel;
		echo "test";
	
	
  } 
  
  //daftar mhs
  public function rincian_data_kuesioner($id_jadual='')
  {
        if (!$this->tank_auth->is_logged_in()) {
          redirect('/auth/login/');
        }

		if( ( $this->tipe_user != '2')|| empty($id_jadual)){
          redirect('/e_dosen');
        }

        $id_jadual=my_number_decrypt($id_jadual);
		//die ( $id_jadual );
		if ( !is_numeric($id_jadual) || strlen($id_jadual) < 5 ) {
          redirect('/e_dosen');
        }

          $data['title'] = 'Input Nilai';//replace - menjadi spasi pada judul
          $data['description'] = 'Biodata Dosen STMI';
          $data['keywords'] = 'biodata dosen, stmi dosen';

         //daftar nilai
          $x =$this->hasil_kuesioner_model->get_nilai_hasil_kues($id_jadual);
		  
		
		
		  $n=1;$w=1;$nn=0;
		   foreach ($x->result_array() as $value) {
			$nilai[ $value['id_pertanyaan'] ]= round( $value['nilai_kuesioner']/$value['sigma'] ,2);	
			$data['jumlah_mhs_input']=$value['sigma'];
			$nn += $nilai[ $value['id_pertanyaan'] ] ;
			if ( $n==13 || $n==20 || $n==26 || $n== 31)
			{
				//$subtotal[$n]= "$nn / $w =". round( $nn/$w,2 );
				$subtotal[$n]= round( $nn/$w,2 );
				$nn=0;
				$w=0;
			}
			$w++;
			$n++;
			
          }
		   $data['nilai']=$nilai;
		   //print_r($subtotal);
		   $data['subtotal']=$subtotal;
		  
		  $data['jumlah_mhs_input']=$value['sigma'];
		  
		  
		  
		  
		  
		   $data['optional'] =$this->hasil_kuesioner_model->get_optional_hasil_kues($id_jadual);
		   $op[1]=''; $op[2]=''; $op[3]='';
		   if ( !empty ( $data['optional'] ) ) {
		   
				  foreach ($data['optional']->result_array() as $value) {
					  if( $value['kode_pertanyaan']==1 )
					  {
							$op[1] .= '- '. $value['keterangan'].'<br>';
					  
					  }else if ( $value['kode_pertanyaan']==2 ){
							$op[2] .= '- '. $value['keterangan'].'<br>';
					  
					  
					  
					  }else if ( $value['kode_pertanyaan']==3 ) {
							$op[3] .= '- '. $value['keterangan'].'<br>';
					  
					  }
				  
				  
				  }
			}
		  $data['op']=$op;
		  
		  //keterangan cetak
		  
		  $data['ket'] =$this->hasil_kuesioner_model->get_ket_hasil_kues($id_jadual);
		  
          foreach ($data['ket']->result_array() as $value) {
            $data['nama_asli']=$value['nama_dosen'];
            $data['gelar']=$value['gelar_dosen'];
			$data['jurusan']=$value['jurusan'];
			$data['mata_kuliah']=$value['nama_matkul'];
			$data['sks']=$value['sks'];
			$data['semester']= ( $value['periode'] == 2 ) ? 'Genap': 'Ganjil' ;
			$data['total']=$value['total_nilai_kuesioner'];
			
          }
			
			 $data['nama_dosen'] = str_replace ( '*', $data['nama_asli'].', ' ,$data['gelar'] );
			 

			$data['pertanyaan']=$this->mhs_model->pertanyaan();
          
          //isi konten
          $data['isicontent'] = 'e_dosen/hasil_kuesioner/_rincian_hasil_kuesioner';
          $data['menu_header'] = $this->menu_otomatis->create_menu_admin(0, 1, 'menu_admin_elearning_dosen');
          $this->load->view('e_dosen/_layout',$data); 


  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
/*-----------------------------------------------------------------------*/
 


}

/* End of file */