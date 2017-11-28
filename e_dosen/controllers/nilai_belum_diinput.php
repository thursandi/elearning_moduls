<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HMVC Codeigniter
 *
 * @package    	Cetak_nilai <controller>
 * @copyright  	Copyright (c) 2013, Kasino
 * @author     	Kasino <ezz_chocolate@yahoo.com>
 */

class Nilai_belum_diinput extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

    $this->db_2 = $this->load->database('otherdb', TRUE); 
    $this->tipe_user = simple_decrypt($this->session->userdata('tipe_user'));

		$this->load->helper('url');
		$this->load->library('tank_auth');
    $this->load->model('e_dosen/e_dosen_model');
    $this->load->model('e_dosen/nilai_belum_input_model');
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
        //1 = super admin, 2= staff_print
        if( $this->tipe_user != '1' && $this->tipe_user != '3' ){
          redirect('/e_dosen');
        }

          $data['title'] = 'Daftar nilai belum diinput';//replace - menjadi spasi pada judul
          $data['description'] = 'Daftar nilai belum diinput';
          $data['keywords'] = 'stmi, elearning';

          $data['nilai_belum_input'] =$this->nilai_belum_input_model->get_daftar_nilai();
         // $data['nilai_belum_input'] =NULL;
          
          //isi konten
          $data['isicontent'] = 'e_dosen/cetak_nilai/_nilai_belum_input';
          $data['menu_header'] = $this->menu_otomatis->create_menu_admin(0, 1, 'menu_admin_elearning_dosen');
          $this->load->view('e_dosen/_layout',$data); 
  }

/*-----------------------------------------------------------------------*/
 


}

/* End of file */