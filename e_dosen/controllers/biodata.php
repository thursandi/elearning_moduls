<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HMVC Codeigniter
 *
 * @package    	E_dosen <controller>
 * @copyright  	Copyright (c) 2013, Kasino
 * @author     	Kasino <ezz_chocolate@yahoo.com>
 */
//simple_decrypt()
class Biodata extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

    $this->db_2 = $this->load->database('otherdb', TRUE); 
    $this->tipe_user = simple_decrypt($this->session->userdata('tipe_user'));

		$this->load->helper('url');
		$this->load->library('tank_auth');
    $this->load->model('e_dosen/e_dosen_model');
		$this->load->library('pagination');

		$this->load->library('menu_otomatis');
		$this->load->library('data_pendukung');

    date_default_timezone_set("Asia/Jakarta");

	}

  private $db_2;
  private $tipe_user;


  public function index()
  {

        if (!$this->tank_auth->is_logged_in()) {
          redirect('/auth/login/');
        }

        //cek tipe user
        if( $this->tipe_user != '2'){
          redirect('/e_dosen');
        }

          $data['title'] = 'Biodata Dosen';//replace - menjadi spasi pada judul
          $data['description'] = 'Biodata Dosen STMI';
          $data['keywords'] = 'biodata dosen, stmi dosen';

          $data['biodata'] =$this->e_dosen_model->get_biodata_dosen($this->session->userdata('user_id'));
          $data['jadwal_mengajar'] = $this->e_dosen_model->get_jadwal_mengajar_dosen($this->session->userdata('nama_asli'));

          //cek matkul yg sedang berlangsung
          $data['mtk_aktif'] = $this->e_dosen_model->mtk_aktif($this->session->userdata('nama_asli'));
          //================================


          //isi konten
          $data['isicontent'] = 'e_dosen/_biodata';
          $data['menu_header'] = $this->menu_otomatis->create_menu_admin(0, 1, 'menu_admin_elearning_dosen');
          $this->load->view('e_dosen/_layout',$data); 
  }

}

/* End of file */