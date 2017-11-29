<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HMVC Codeigniter
 *
 * @package    	Cetak_nilai <controller>
 * @copyright  	Copyright (c) 2013, Kasino
 * @author     	Kasino <ezz_chocolate@yahoo.com>
 */

class Hasil_kuesioner_kampus extends CI_Controller
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
    $this->load->model('e_dosen/hasil_kuesioner_kampus_model');
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
		if( $this->tipe_user != '1'  && $this->tipe_user != '4' ){
          redirect('/e_dosen');
        }

          $data['title'] = 'Kuesioner Penilaian Mahasiswa';//replace - menjadi spasi pada judul
          $data['description'] = 'Kuesioner Dosen STMI';
          $data['keywords'] = 'Kuesioner dosen, stmi dosen';

          $data['thn_akademik_kuesioner'] =$this->hasil_kuesioner_kampus_model->thn_akademik_kuesioner();
          
          //isi konten
          $data['isicontent'] = 'e_dosen/hasil_kuesioner/_hasil_kuesioner_kampus';
          $data['menu_header'] = $this->menu_otomatis->create_menu_admin(0, 1, 'menu_admin_elearning_dosen');
          $this->load->view('e_dosen/_layout',$data); 
  }

  
  public function get_kues_kampus()
  {
        if (!$this->tank_auth->is_logged_in()) {
          redirect('/auth/login/');
        }

		if( $this->tipe_user != '1' && $this->tipe_user != '4'){
          redirect('/e_dosen');
        }

        $thnperiode=$this->input->post('thn_periode');
		//echo 'aaaaaaaaaa';
//echo $thnperiode;

        $y=$this->hasil_kuesioner_kampus_model->get_kues_kampus($thnperiode);
		//echo $y;
		$tabel=' <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                  <th>No Urut</th>
                                  <th>Tipe Kuesioner</th>
                                  <th>Thn. Akademik</th>
                                  <th>Periode</th>
								    <th>&Sigma; Mahasiswa</th>
									<th>&Sigma; Nilai Kuesioner</th>
									<th>Cetak </th>
									
                                </tr>
                            </thead>
                            <tbody>';
		
		$n=1;		
		foreach ($y->result_array() as $row) {
            $tabel.='<tr>
					<td>'.$n.'</td>
					<td>'.$row['tipe_kues_kampus'].'</td>
					<td>'.$row['thn_akademik'].'</td>
					<td>'.$row['periode'].'</td>
					<td>'.$row['sigma'].'</td>
					<td>'.$row['total_nilai_kuesioner'].'</td>
					<td><a target="_blank" href="'.base_url().'e_dosen/hasil_kuesioner_kampus/rincian_data_kuesioner/'.my_number_encrypt($row['tipe_number'].'_'.$row['thn_akademik'].'_'.$row['periode'].'_'.$row['tipe_kues_kampus']).' ">cetak</a></td>
					</tr>';
			
			$n++;
        }

        $tabel .='         </tbody>
                   </table>';
        
		
		
		
        echo $tabel;
	
	
	
  } 
  
  //daftar mhs
  public function rincian_data_kuesioner($id_jadual='')
  {
        if (!$this->tank_auth->is_logged_in()) {
          redirect('/auth/login/');
        }

		if( ( $this->tipe_user != '1'  && $this->tipe_user != '4' )|| empty($id_jadual)){
          redirect('/e_dosen');
        }

        $id_jadual=my_number_decrypt($id_jadual);
		
		$mm= explode("_", $id_jadual);
		
		//die ( print_r($mm) );
		
		//echo count($mm) ;
		//die();
		
		$id_jadual		= $mm[0];
		$thn_akademik	= $mm[1];
		$periode		= $mm[2];
		
		
		$data['tipe_kues_pertanyaan']	= $mm[3];
		$data['thn_akademik']			= $mm[1];
		$data['periode']				= $mm[2];
//die ( $id_jadual );
		if ( !is_numeric($id_jadual) || count($mm) !=4 || ( $mm[3] != 'Penilaian Tingkat Kepuasan' && $mm[3] != 'Penilaian Tingkat Kepentingan') ) {
          redirect('/e_dosen');
        }

          $data['title'] = 'Input Nilai';//replace - menjadi spasi pada judul
          $data['description'] = 'Biodata Dosen STMI';
          $data['keywords'] = 'biodata dosen, stmi dosen';

         //daftar nilai
          $x =$this->hasil_kuesioner_kampus_model->get_nilai_hasil_kues($id_jadual, $thn_akademik, $periode );
		  $n=1;$w=1;$nn=0;
		   foreach ($x->result_array() as $value) {
			$nilai[ $value['id_pertanyaan'] ]= round( $value['nilai_kuesioner']/$value['sigma'] ,2);	
			$data['jumlah_mhs_input']=$value['sigma'];
			$nn += $nilai[ $value['id_pertanyaan'] ] ;
			if ( $n==27 )
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
		  
		  
		

			$data['pertanyaan']=$this->mhs_model->pertanyaan_kampus();
          
          //isi konten
          $data['isicontent'] = 'e_dosen/hasil_kuesioner/_rincian_hasil_kuesioner_kampus';
          $data['menu_header'] = $this->menu_otomatis->create_menu_admin(0, 1, 'menu_admin_elearning_dosen');
          $this->load->view('e_dosen/_layout',$data); 


  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
/*-----------------------------------------------------------------------*/
 


}

/* End of file */