<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HMVC Codeigniter
 *
 * @package    	E_dosen <controller>
 * @copyright  	Copyright (c) 2013, Kasino
 * @author     	Kasino <ezz_chocolate@yahoo.com>
 */
//simple_decrypt()
class E_dosen extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

    $this->db_2 = $this->load->database('otherdb', TRUE); 
    $this->tipe_user = simple_decrypt($this->session->userdata('tipe_user'));
    $this->id_user = $this->session->userdata('user_id');

		$this->load->helper('url');
		$this->load->library('tank_auth');
    $this->load->model('e_dosen/e_dosen_model');
    $this->load->model('e_dosen/grocery_crud_model');
	$this->load->model('e_dosen/tambahan_model');
		$this->load->library('pagination');

		$this->load->library('menu_otomatis');
		$this->load->library('data_pendukung');

    $this->load->library('grocery_CRUD');
    $this->load->library('image_CRUD');
    $this->load->helper('file');

    date_default_timezone_set("Asia/Jakarta");

	}

  private $db_2;
  private $tipe_user;
  private $id_user;

  public function index()
  {
        if (!$this->tank_auth->is_logged_in()) {
            redirect('/auth/login/');
        } else {
            //cek tipe user
              if( $this->tipe_user == '1'){
                redirect('/e_dosen/log_login_dosen');
              }elseif ($this->tipe_user == '2') {
                redirect('/e_dosen/biodata');
              }elseif ($this->tipe_user == '3') {
                redirect('/e_dosen/daftar_username_dosen');
              }elseif ($this->tipe_user == '4') {
                redirect('/e_dosen/hasil_kuesioner');
              }
            $this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
        
        } 
  }

  private function _example_output($output = null)
  {
    //menyisipkan data lain ke dalam _view $output
      $data['menu_header'] = $this->menu_otomatis->create_menu_admin(0, 1, 'menu_admin_elearning_dosen');

      $data['title'] = 'E-learning STMI';//replace - menjadi spasi pada judul
      $data['description'] = 'E-learning STMII';
      $data['keywords'] = 'E-learning STMI';

      $data['artikel'] =$this->e_dosen_model->get_all_artikel();

    $output->data=$data;
    //menyisipkan data lain ke dalam _view $output
    $this->load->view('e_dosen/_layout_statis',$output);  
  }

/*---------------------------------------------------------------*/
  public function input_blog()
  {
    if (!$this->tank_auth->is_logged_in()) {
      redirect('/auth/login/');
    }
       //cek tipe user
        if( $this->tipe_user != '2'){
          redirect('/e_dosen');
      }

      $crud = new grocery_CRUD();

      $crud->set_theme('datatables');

              $crud->set_table('el_blog_dosen');
              $crud->where('penulis',$this->session->userdata('user_id'));
              $crud->display_as('view','Halaman Dilihat');

              $crud->columns('tanggal_input','judul_artikel','isi_artikel','view');
              
              $crud->display_as('link_gambar','Gambar/File Dokumen Lampiran');
              $crud->fields('judul_artikel','link_gambar','isi_artikel');
              $crud->required_fields('judul_artikel','isi_artikel');

              $crud->set_field_upload('link_gambar','assets/uploads/blog_dosen/');

              $crud->callback_after_insert(array($this, 'log_user_after_insert_blog_dosen'));

              $crud->callback_before_delete(array($this,'crud_delete_file_blog_dosen'));
      
      $output = $crud->render();

      $this->_example_output($output);
  }

  public function log_user_after_insert_blog_dosen($post_array,$primary_key)
  {

      $user_logs_insert = array(
          'penulis' => $this->session->userdata('user_id'),
		  'tanggal_input'    => date('Y-m-d H:i:s'),
      );
   
      //$this->db->insert('informasi',$user_logs_insert);
      $this->db->where('id_artikel', $primary_key);
      $this->db->update('el_blog_dosen', $user_logs_insert); 
   
      return true;
  }

  //menghapus gambar yg telah di upload sebelumnya.
  public function crud_delete_file_blog_dosen($primary_key)
  {
    $row = $this->db->where('id_artikel',$primary_key)->get('el_blog_dosen')->row();

     unlink('assets/uploads/blog_dosen/'.$row->link_gambar);
   
    return true;
  }

/*---------------------------------------------------------------*/

  public function log_login_dosen()
  {
    if (!$this->tank_auth->is_logged_in()) {
      redirect('/auth/login/');
    }

      //cek tipe user
      if( $this->tipe_user != '1'){
          redirect('/e_dosen');
      }

      $crud = new grocery_CRUD();

      $crud->set_theme('flexigrid');
      $crud->set_table('users_e_dosen');
      //$crud->order_by('modified','desc');
      $crud->display_as('modified','Waktu Login Terakhir');

      $crud->columns('username','nama_asli','email','last_ip','modified','jenis_user');
      //$crud->fields('activated','banned');
      //relation (field_foreign_key, nama tabel_primarykey relasi lawanya, field_tabel_relasi yg dimunculkan)
      //$crud->set_relation('jenis_user','master_jenis_user',' {keterangan} - {abc}');
      $crud->set_relation('jenis_user','master_jenis_user_elearning','keterangan');
      $crud->set_rules('email','Email','trim|required|xss_clean|valid_email');
      $crud->set_rules('username','Username','trim|required|xss_clean|min_length[5]');


      $crud->fields('username','nama_asli','email','password','jenis_user');
      $crud->required_fields('username','nama_asli','email','password','jenis_user');


      $crud->callback_before_insert(array($this,'encrypt_password_callback'));
      $crud->callback_before_update(array($this,'encrypt_password_callback'));
      $crud->callback_after_insert(array($this, 'data_user_dosen'));
      
      
      //$crud->unset_add();
          //$crud->unset_edit();
        $output = $crud->render();

      $this->_example_output($output);
  }

  public function data_user_dosen($post_array,$primary_key)
  {

      $user_logs_insert = array(
          'gelar' => '',
          'role'    => 1,
          'created'    => date('Y-m-d H:i:s'),
          'activated'    => 1,
          'last_ip' => $this->input->ip_address(),
      );


   
      //$this->db->insert('informasi',$user_logs_insert);
      $this->db->where('id', $primary_key);
      $this->db->update('users_e_dosen', $user_logs_insert); 
   
      return true;
  }

  function encrypt_password_callback($post_array, $primary_key = null)
  {
        $this->load->config('tank_auth', TRUE);
        $this->load->library('session');
        $this->load->database();
        $this->load->model('auth/users');
   
      $hasher = new PasswordHash($this->config->item('phpass_hash_strength', 'tank_auth'),
      $this->config->item('phpass_hash_portable', 'tank_auth'));

      $hashed_password = $hasher->HashPassword($post_array['password']);

      $post_array['password'] = $hashed_password;
      return $post_array;
  }


/*-----------------------------------------------------------------------------------*/
  public function log_login_mahasiswa()
  {
    if (!$this->tank_auth->is_logged_in()) {
      redirect('/auth/login/');
    }

      //cek tipe user
      if( $this->tipe_user != '1'){
          redirect('/e_dosen');
      }

      $crud = new grocery_CRUD();

      $crud->set_theme('flexigrid');
      $crud->set_table('el_log_login_mhs');
      //$crud->order_by('modified','desc');

      
      $crud->unset_add();
      $crud->unset_edit();
      $crud->unset_delete();
        $output = $crud->render();

      $this->_example_output($output);
  }
/*-----------------------------------------------------------------------------------*/
  public function pengumuman()
  {
    if (!$this->tank_auth->is_logged_in()) {
      redirect('/auth/login/');
    }

      //cek tipe user
      if( $this->tipe_user != '1'){
          redirect('/e_dosen');
      }

      $crud = new grocery_CRUD();

      $crud->set_theme('flexigrid');
      $crud->set_table('el_pengumuman');
      $crud->order_by('tanggal_input','desc');
      $crud->fields('judul_pengumuman','isi_pengumuman');

      
      //$crud->unset_add();
      //$crud->unset_edit();
      //$crud->unset_delete();
        $output = $crud->render();

      $this->_example_output($output);
  }
/*-----------------------------------------------------------------------------------*/

	function status_kuesioner_dosen()
	{
		if (!$this->tank_auth->is_logged_in()) {
		  redirect('/auth/login/');
		}

		  //cek tipe user
		  if( $this->tipe_user != '1'){
			  redirect('/e_dosen');
		  }

		$this->db = $this->load->database('otherdb',true);
		$crud = new grocery_CRUD();

		  $crud->set_theme('datatables');
		  $crud->set_table('el_kuesioner_status');
		   $crud->display_as('status_kuesioner','Status Kuesioner (Terkunci=non aktif) (Terbuka=aktif)');
		  //$crud->required_fields('lastName');
		  
		  //$crud->columns('ip','tanggal','hits','online','time');
		  $crud->unset_add();
		  $crud->unset_delete();
				//$crud->unset_edit();
			$output = $crud->render();

		  $this->db = $this->load->database('default',true);
      $this->_example_output($output);
	  }
  
  
  //status kunci tabel nilai
  public function status_kunci_tabel_nilai()
  {
    if (!$this->tank_auth->is_logged_in()) {
      redirect('/auth/login/');
    }

      //cek tipe user
      if( $this->tipe_user != '1' && $this->tipe_user != '3' ){
          redirect('/e_dosen');
      }

      $this->db = $this->load->database('otherdb',true);
      $crud = new grocery_CRUD();
      $crud->set_model('tambahan_model');
      $crud->set_table('el_kunci_nilai'); //Change to your table name
      //$crud->set_theme('datatables');
	  $crud->set_theme('flexigrid');
      $crud->basic_model->set_query_str("SELECT DISTINCT A.*, B.nama AS nama_dosen FROM 
(SELECT DISTINCT A.*, B.id_dosen FROM (SELECT DISTINCT A.*, B.kelas, B.thn_akademik, B.periode FROM el_kunci_nilai A
LEFT JOIN krs B ON A.id_jadual=B.id_jadual) A
LEFT JOIN jadual B ON A.id_jadual=B.id_jadual) A
LEFT JOIN dosen B
ON A.id_dosen=B.id_dosen
WHERE A.thn_akademik=(SELECT thn_akademik FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
AND A.periode= (SELECT periode FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
ORDER BY B.nama ASC, A.id_status DESC"); //Query text here

      $crud->field_type('id_jadual','readonly');
      $crud->field_type('nama','readonly');
      $crud->display_as('id_status','Status');
      //$crud->display_as('kd_mtk','Mata Kuliah');
      $crud->columns('id_jadual','nama_dosen','nama','kelas','id_status','waktu_input','thn_akademik','periode');
	  //$crud->columns('id_jadual','nama_dosen','nama','kelas','id_status','waktu_input');
      $crud->fields('id_jadual','nama','id_status');
       $crud->unset_add();
      $output = $crud->render();
      $this->db = $this->load->database('default',true);
      $this->_example_output($output);


      /*
      $crud = new grocery_CRUD();
      $crud->set_table('el_kunci_nilai');
      $crud->set_theme('flexigrid');
      */
      //$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
      /*
      The name of the field that we have the relation in the basic table (officeCode )
      The relation table (offices)
      The 'title' field that we want to use to recognize the relation ( in this example the city)
       
      //$crud->set_relation('kd_mtk','mtk','status');
      $crud->set_relation('id_status','el_status_kunci_nilai','rincian');
      //$crud->set_relation('id_jadual','jadual','{id_jadual} - {id_kelas}');
      $crud->set_relation('id_jadual','krs','{id_jadual} - {id_krs}');
      // $crud->set_relation('id_dosen','dosen','nama');
      $crud->order_by('id_jadual','desc');
      //$crud->set_relation('id_jadual','jadual','id_mtk');
      $crud->field_type('id_jadual','readonly');
      $crud->field_type('nama','readonly');
      $crud->display_as('id_status','Status (Terkunci/Terbuka)');
      //$crud->display_as('kd_mtk','Mata Kuliah');
      $crud->columns('id_jadual','id_jadual2','nama','id_status');
      $crud->fields('id_jadual','nama','id_status');
      //$crud->set_table('el_log_login_mhs');
      //$crud->columns('customerName','phone','addressLine1','creditLimit');

      
      $crud->unset_add();
      //$crud->unset_edit();
      //$crud->unset_delete();
        $output = $crud->render();
        $this->db = $this->load->database('default',true);
      $this->_example_output($output);

      */
  }



/*-----------------------------------------------------------------------------------*/

  public function input_biodata()
  {
    if (!$this->tank_auth->is_logged_in()) {
      redirect('/auth/login/');
    }
       //cek tipe user
        if( $this->tipe_user != '2'){
          redirect('/e_dosen');
      }

      $crud = new grocery_CRUD();

      $crud->set_theme('datatables');

              $crud->set_table('users_e_dosen');
              $crud->where('id',$this->session->userdata('user_id'));

              $crud->columns('tgl_lahir','alamat','no_hp','email');
              
              $crud->fields('tgl_lahir','alamat','no_hp','email','foto');
              $crud->required_fields('email');
              $crud->set_rules('email','Email','trim|required|xss_clean|valid_email');

              //$crud->unset_add();
              
              $crud->unset_add();  
              $crud->unset_delete();

              $crud->set_field_upload('foto','assets/uploads/foto_biodata_dosen/');

              $crud->callback_before_delete(array($this,'crud_delete_file_foto_dosen'));


      
      $output = $crud->render();

      $this->_example_output($output);
  }

  //menghapus gambar yg telah di upload sebelumnya.
  public function crud_delete_file_foto_dosen($primary_key)
  {
    $row = $this->db->where('id',$primary_key)->get('users_e_dosen')->row();

     unlink('assets/uploads/foto_biodata_dosen/'.$row->foto);
   
    return true;
  }

/*
  public function log_user_after_insert_biodata_dosen($post_array,$primary_key)
  {

      $user_logs_insert = array(
          'kd_user' => $this->session->userdata('user_id'),
          'ip_address' =>$this->input->ip_address(),
      );
   
      //$this->db->insert('informasi',$user_logs_insert);
      $this->db->where('id_biodata', $primary_key);
      $this->db->update('el_biodata_dosen', $user_logs_insert); 
   
      return true;
  }
*/

/*---------------------------------------------------------------*/


 public function upload_materi()
  {
    if (!$this->tank_auth->is_logged_in()) {
      redirect('/auth/login/');
    }
       //cek tipe user
        if( $this->tipe_user != '2'){
          redirect('/e_dosen');
      }

      $crud = new grocery_CRUD();

      $crud->set_theme('flexigrid');

              $crud->set_table('el_materi_kuliah');
              $crud->where('id_dosen',$this->session->userdata('user_id'));

              $crud->columns('nama_mata_kuliah','keterangan_dokumen','lampiran_materi');
              $crud->required_fields('nama_mata_kuliah','lampiran_materi');
              $crud->fields('nama_mata_kuliah','keterangan_dokumen','lampiran_materi');
              
              $crud->display_as('lampiran_materi','Upload Materi Kuliah');
              
              

              $crud->set_field_upload('lampiran_materi','assets/uploads/materi_kuliah/');

              $crud->callback_after_insert(array($this, 'log_user_after_insert_materi_kuliah'));

              $crud->callback_before_delete(array($this,'crud_delete_file_materi_kuliah'));
      
      $output = $crud->render();

      $this->_example_output($output);
  }

  public function log_user_after_insert_materi_kuliah($post_array,$primary_key)
  {

      $user_logs_insert = array(
          'id_dosen' => $this->session->userdata('user_id'),
      );
   
      //$this->db->insert('informasi',$user_logs_insert);
      $this->db->where('id', $primary_key);
      $this->db->update('el_materi_kuliah', $user_logs_insert); 
   
      return true;
  }

  //menghapus gambar yg telah di upload sebelumnya.
  public function crud_delete_file_materi_kuliah($primary_key)
  {
    $row = $this->db->where('id',$primary_key)->get('el_materi_kuliah')->row();

     unlink('assets/uploads/materi_kuliah/'.$row->lampiran_materi);
   
    return true;
  }
  
  
 /*---------------------------------------------- materi super user ------------*/
 
 

 public function materi_kuliah()
  {
    if (!$this->tank_auth->is_logged_in()) {
      redirect('/auth/login/');
    }
       //cek tipe user
        if( $this->tipe_user != '1'){
          redirect('/e_dosen');
      }

      $crud = new grocery_CRUD();

      $crud->set_theme('flexigrid');

              $crud->set_table('el_materi_kuliah');

              //$crud->columns('nama_mata_kuliah','lampiran_materi');
              //$crud->required_fields('nama_mata_kuliah','lampiran_materi');
              //$crud->fields('nama_mata_kuliah','lampiran_materi');
              
              //$crud->display_as('lampiran_materi','Upload Materi Kuliah');
              
			  $crud->display_as('id_dosen','Nama Dosen');
			  $crud->set_relation('id_dosen','users_e_dosen','nama_asli');
              

              $crud->set_field_upload('lampiran_materi','assets/uploads/materi_kuliah/');
			  
	$crud->unset_add();
    $crud->unset_edit();
    $crud->unset_delete();

      
      $output = $crud->render();

      $this->_example_output($output);
  }
  
  
  
 public function daftar_chat_mhs()
  {
    if (!$this->tank_auth->is_logged_in()) {
      redirect('/auth/login/');
    }
       //cek tipe user
        if( $this->tipe_user != '1'){
          redirect('/e_dosen');
      }
		

			  
			 $this->db = $this->load->database('otherdb',true);
      $crud = new grocery_CRUD();
      $crud->set_table('el_tabel_chat'); //Change to your table name
     // $crud->set_theme('datatables');
	 
	  $crud->set_theme('flexigrid');

              //$crud->columns('nama_mata_kuliah','lampiran_materi');
              //$crud->required_fields('nama_mata_kuliah','lampiran_materi');
              //$crud->fields('isi_chat', 'nim');
              
              //$crud->display_as('lampiran_materi','Upload Materi Kuliah');
              
              

			  
	$crud->fields('isi_chat','nim');
       $crud->unset_add();
      $output = $crud->render();
      $this->db = $this->load->database('default',true);
      $this->_example_output($output);
  }


  

}

/* End of file */