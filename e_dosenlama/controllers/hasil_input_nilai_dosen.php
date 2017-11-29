<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HMVC Codeigniter
 *
 * @package    	Cetak_nilai <controller>
 * @copyright  	Copyright (c) 2013, Kasino
 * @author     	Kasino <ezz_chocolate@yahoo.com>
 */

class Hasil_input_nilai_dosen extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

    $this->db_2 = $this->load->database('otherdb', TRUE); 
    $this->tipe_user = simple_decrypt($this->session->userdata('tipe_user'));

		$this->load->helper('url');
		$this->load->library('tank_auth');
    $this->load->model('e_dosen/e_dosen_model');
    $this->load->model('e_dosen/cetak_nilai_model');
    $this->load->model('e_dosen/hasil_input_nilai_model');
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

          $data['title'] = 'Cetak Nilai';//replace - menjadi spasi pada judul
          $data['description'] = 'Biodata Dosen STMI';
          $data['keywords'] = 'biodata dosen, stmi dosen';
          
          $data['mata_kuliah_dosen_terkunci'] =$this->hasil_input_nilai_model->mata_kuliah_dosen_terkunci($this->session->userdata('nama_asli'));
          $data['biodata'] =$this->e_dosen_model->get_biodata_dosen($this->session->userdata('user_id'));
          foreach ($data['biodata']->result_array() as $value) {
            $data['nama_asli']=$value['nama_asli'];
            $data['gelar']=$value['gelar'];
          }
          
          //isi konten
          $data['isicontent'] = 'e_dosen/cetak_nilai/_hasil_nilai_dosen';
          $data['menu_header'] = $this->menu_otomatis->create_menu_admin(0, 1, 'menu_admin_elearning_dosen');
          $this->load->view('e_dosen/_layout',$data); 
  }

  //daftar mhs
  public function rincian_data_nilai($id_jadual='')
  {
        if (!$this->tank_auth->is_logged_in()) {
          redirect('/auth/login/');
        }

        //cek tipe user
        if( $this->tipe_user != '2'){
          redirect('/e_dosen');
        }

        $id_jadual=my_number_decrypt($id_jadual);

        if (!is_numeric($id_jadual)) {
          redirect('/e_dosen');
        }

          $data['title'] = 'Input Nilai';//replace - menjadi spasi pada judul
          $data['description'] = 'Biodata Dosen STMI';
          $data['keywords'] = 'biodata dosen, stmi dosen';

          
          $data['biodata'] =$this->cetak_nilai_model->get_biodata_dosen($id_jadual);
          foreach ($data['biodata']->result_array() as $value) {
            $data['nama_asli']=$value['nama'];
            $data['gelar']=$value['gelar'];
          }

          $data['daftar_mhs'] =$this->cetak_nilai_model->daftar_mhs($id_jadual);
          $result=$this->cetak_nilai_model->get_nama_mata_kuliah($id_jadual)->result_array();
          foreach ($result as $value) {
            # code...
            $data['id_mtk']=$value['kd_mtk'];
            $data['nama']=$value['nama'];
            $data['kelas']=$value['kelas'];
          }
          /*
          $data['persen_tugas']=$this->input->post('bobot_tugas');
          $data['persen_uts']=$this->input->post('bobot_uts');
          $data['persen_uas']=$this->input->post('bobot_uas');
          */

          //isi konten
          $data['isicontent'] = 'e_dosen/cetak_nilai/_hasil_nilai_dosen_rincian';
          $data['menu_header'] = $this->menu_otomatis->create_menu_admin(0, 1, 'menu_admin_elearning_dosen');
          $this->load->view('e_dosen/_layout',$data);


  }

  public function ubah_url()
  {
        if (!$this->tank_auth->is_logged_in()) {
          redirect('/auth/login/');
        }

        //cek tipe user
        if( $this->tipe_user != '2'){
          redirect('/e_dosen');
        }

        $id_jadual=$this->input->post('id_jadual');
        $this->session->set_userdata(array(
                'persen_tugas' => simple_encrypt($this->input->post('bobot_tugas')),
                'persen_uts'  => simple_encrypt($this->input->post('bobot_uts')),
                'persen_uas' => simple_encrypt($this->input->post('bobot_uas')),
                'id_jadual'=>$id_jadual,
            ));

        //$this->cetak_nilai_model->update_cetak_nilai($id_jadual);
        //<form action="" method="post" id="url_nilai" target="_blank">
        $data=base_url().'e_dosen/hasil_input_nilai_dosen/rincian_data_nilai/'.my_number_encrypt($id_jadual);
        echo $data;

  } 


  public function cek_bobot()
  {
        if (!$this->tank_auth->is_logged_in()) {
          redirect('/auth/login/');
        }

        //cek tipe user
        if( $this->tipe_user != '2'){
          redirect('/e_dosen');
        }

        $id_jadual=$this->input->post('id_jadual');
        $data='';
        //<form action="" method="post" id="url_nilai" target="_blank">
        $result=$this->e_dosen_model->get_cek_bobot($id_jadual)->result_array();
          foreach ($result as $value) {
            # code...
            $data.=$value['bobot_tugas'].'-'.$value['bobot_uts'].'-'.$value['bobot_uas'];
          }
        
        
        echo $data;

  } 




/*-----------------------------------------------------------------------*/
 


}

/* End of file */