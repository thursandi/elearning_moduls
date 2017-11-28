<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HMVC Codeigniter
 *
 * @package    	Input_nilai <controller>
 * @copyright  	Copyright (c) 2013, Kasino
 * @author     	Kasino <ezz_chocolate@yahoo.com>
 */

class Input_nilai extends CI_Controller
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

          $data['title'] = 'Input Nilai';//replace - menjadi spasi pada judul
          $data['description'] = 'Biodata Dosen STMI';
          $data['keywords'] = 'biodata dosen, stmi dosen';

          $data['mata_kuliah_terakhir'] =$this->e_dosen_model->get_mata_kuliah_terakhir($this->session->userdata('nama_asli'));
          $data['biodata'] =$this->e_dosen_model->get_biodata_dosen($this->session->userdata('user_id'));
          foreach ($data['biodata']->result_array() as $value) {
            $data['nama_asli']=$value['nama_asli'];
            $data['gelar']=$value['gelar'];
          }
          //isi konten
          $data['isicontent'] = 'e_dosen/input_nilai/_input_nilai';
          $data['menu_header'] = $this->menu_otomatis->create_menu_admin(0, 1, 'menu_admin_elearning_dosen');
          $this->load->view('e_dosen/_layout',$data); 
  }

  //daftar mhs
  public function input_nilai_rincian($id_jadual='')
  {
        if (!$this->tank_auth->is_logged_in()) {
          redirect('/auth/login/');
        }

        if( $this->tipe_user != '2' || empty($id_jadual)){
          redirect('/e_dosen');
        }

        $id_jadual=my_number_decrypt($id_jadual);

        if (!is_numeric($id_jadual)) {
          redirect('/e_dosen');
        }

          $data['title'] = 'Input Nilai';//replace - menjadi spasi pada judul
          $data['description'] = 'Biodata Dosen STMI';
          $data['keywords'] = 'biodata dosen, stmi dosen';

          
          $data['biodata'] =$this->e_dosen_model->get_biodata_dosen($this->session->userdata('user_id'));
          foreach ($data['biodata']->result_array() as $value) {
            $data['nama_asli']=$value['nama_asli'];
            $data['gelar']=$value['gelar'];
          }

          $data['daftar_mhs'] =$this->e_dosen_model->daftar_mhs($id_jadual);
          $result=$this->e_dosen_model->get_nama_mata_kuliah($id_jadual)->result_array();
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
          $data['isicontent'] = 'e_dosen/input_nilai/_input_nilai_rincian_mhs';
          $data['menu_header'] = $this->menu_otomatis->create_menu_admin(0, 1, 'menu_admin_elearning_dosen');
          $this->load->view('e_dosen/_layout',$data);


  }

  public function ubah_url()
  {
        if (!$this->tank_auth->is_logged_in()) {
          redirect('/auth/login/');
        }

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

        
        //<form action="" method="post" id="url_nilai" target="_blank">
        $data=base_url().'e_dosen/input_nilai/input_nilai_rincian/'.my_number_encrypt($id_jadual);
        echo $data;

  } 


  public function cek_bobot()
  {
        if (!$this->tank_auth->is_logged_in()) {
          redirect('/auth/login/');
        }

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


  public function kunci_tabel_nilai()
  {
        if (!$this->tank_auth->is_logged_in()) {
          redirect('/auth/login/');
        }

        if( $this->tipe_user != '2'){
          redirect('/e_dosen');
        }

        $id_jadual=$this->input->post('id_jadual');
        $nama=$this->input->post('nama');
        $data='';
        //<form action="" method="post" id="url_nilai" target="_blank">
        $this->e_dosen_model->kunci_tabel_nilai($id_jadual,$nama);

        $data=base_url().'e_dosen/input_nilai';
        echo $data;

  } 


/*-----------------------------------------------------------------------*/
 public function simpan_nilai_mhs()
  {
        if (!$this->tank_auth->is_logged_in()) {
          redirect('/auth/login/');
        }

        if( $this->tipe_user != '2'){
          redirect('/e_dosen');
        }

        //penambahan
        $bobot_tugas=$this->input->post('bobot_tugas');
        $bobot_uts=$this->input->post('bobot_uts');
        $bobot_uas=$this->input->post('bobot_uas');
        //penambahan end

        $id_jadual=$this->input->post('id_jadual');
        $data='';

        $post = $this->input->post('nilai');
        //tugas $post[0] +5
        //uts $post[1]
        //uas $post[2]
        //nilai $post[4]
    
        //print_r($post);
        //echo print_r($post[149]);
        //echo count($post);
        //echo $id_jadual;
        //echo $post[0]['value'];
        
        $baris['tugas'] = $baris['uts'] = $baris['uas'] = $baris['huruf']=0;
        $temp['tugas'] = $temp['uts'] = $temp['uas'] = $temp['huruf']=0;
        $tugas = $uts = $uas = $huruf=array();
        //$temp['tugas'],$temp['uts'],$temp['uas'],$temp['nilai']='';


        for ($i=0; $i < count($post); $i++) { 
              # code...
              if ( $i==0 || $i==($temp['tugas']+5) ) {

                ( empty($post[$i]['value']) ) ? $post[$i]['value']=0 : $post[$i]['value'];

                $tugas[$baris['tugas']]=$post[$i]['value'];
                $baris['tugas']++;
                $temp['tugas']=$i;

              }elseif ( $i==1 || $i==($temp['uts']+5) ) {

                ( empty($post[$i]['value']) ) ? $post[$i]['value']=0 : $post[$i]['value'];

                $uts[$baris['uts']]=$post[$i]['value'];
                $baris['uts']++;
                $temp['uts']=$i;


              }elseif ( $i==2 || $i==($temp['uas']+5) ) {

                ( empty($post[$i]['value']) ) ? $post[$i]['value']=0 : $post[$i]['value'];

                $uas[$baris['uas']]=$post[$i]['value'];
                $baris['uas']++;
                $temp['uas']=$i;


              }elseif ( $i==4 || $i==($temp['huruf']+5) ) {

                ( empty($post[$i]['value']) ) ? $post[$i]['value']=0 : $post[$i]['value'];

                $huruf[$baris['huruf']]=$post[$i]['value'];
                $baris['huruf']++;
                $temp['huruf']=$i;

              }
        }

        //echo print_r($nilai);

        $this->db_2->query("UPDATE jadual SET bobot_tugas=$bobot_tugas, bobot_uts=$bobot_uts, bobot_uas=$bobot_uas
                            WHERE id_jadual=$id_jadual");

        $data_mhs=$this->db_2->query("SELECT nim
                                      FROM krs 
                                      WHERE id_jadual=$id_jadual
                                      ORDER BY nim ASC");
        $i=0;
        foreach ($data_mhs->result_array() as $value) {
            $nim_mhs[$i]=$value['nim'];
            $i++;
        }

        //echo print_r($nim_mhs);
        //echo print_r($huruf);

        /*
        UPDATE Customers
        SET ContactName='Alfred Schmidt', City='Hamburg'
        WHERE CustomerName='Alfreds Futterkiste';

        //bobot
        UPDATE jadual
        SET bobot_tugas= ,
            bobot_uts= ,
            bobot_uas= 
        WHERE id_jadual=$id_jadual

        //nilai
        UPDATE krs
        SET tugas= ,
            uts= ,
            uas= ,
            nilai= 
        WHERE nim=

        UPDATE [STORESQL].[dbo].[RPT_ITM_D] SET F1301='1.29' WHERE F01='0000000000001'
        UPDATE [STORESQL].[dbo].[RPT_ITM_D] SET F1301='1.30' WHERE F01='0000000000002'

        UPDATE [STORESQL].[dbo].[RPT_ITM_D] 
        SET   F1301 = 
              CASE  F01 
                WHEN '0000000000001' THEN '1.29'
                WHEN '0000000000002' THEN '1.30'
              END
        WHERE   LASTNAME IN ('AAA', 'CCC', 'EEE')
        
        UPDATE tablename
        SET col1 = CASE WHEN name = 'name1' THEN 5 
                        WHEN name = 'name2' THEN 3 
                        ELSE 0 
                   END
         , col2 = CASE WHEN name = 'name1' THEN '' 
                       WHEN name = 'name2' THEN 'whatever' 
                       ELSE '' 
                  END
        ;
         */
        
        /*
        $tugas[]
        $uts[]
        $uas[]
        $huruf[]
        $nim_mhs[]
         */
        $sql_nilai = 'UPDATE krs ';


        $sql_nilai .= 'SET tugas = CASE ';
        for ($i=0; $i < count($nim_mhs) ; $i++) { 
            $sql_nilai .= 'WHEN nim='.$nim_mhs[$i].' THEN '.$tugas[$i].' ';
        }
        $sql_nilai .= ' END ';


        $sql_nilai .= ' , uts = CASE ';
        for ($i=0; $i < count($nim_mhs) ; $i++) { 
            $sql_nilai .= 'WHEN nim='.$nim_mhs[$i].' THEN '.$uts[$i].' ';
        }
        $sql_nilai .= ' END ';


        $sql_nilai .= ' , uas = CASE ';
        for ($i=0; $i < count($nim_mhs) ; $i++) { 
            $sql_nilai .= 'WHEN nim='.$nim_mhs[$i].' THEN '.$uas[$i].' ';
        }
        $sql_nilai .= ' END ';


        $sql_nilai .= ' , nilai = CASE ';
        for ($i=0; $i < count($nim_mhs) ; $i++) { 
            $sql_nilai .= "WHEN nim=".$nim_mhs[$i]." THEN '".$huruf[$i]."' ";
        }

        $sql_nilai .= ' END ';
        


        //penambahan updater
        $updater=strval($this->session->userdata('username'));

        if ( empty( $updater ) ) {
            $updater='kosong';
        }else{
          $pisah_username=explode('_', $updater);
            
            if ( empty($pisah_username[1]) ) {
              $updater=$updater;
            }else{
              $updater=$pisah_username[2].'_'.$pisah_username[3];
            }

        }

        $sql_nilai .= ' , updater = CASE ';
        for ($i=0; $i < count($nim_mhs) ; $i++) { 
            $sql_nilai .= "WHEN nim=".$nim_mhs[$i]." THEN '".$updater."' ";
        }

        //end penambahan updater


        $sql_nilai .= ' END WHERE id_jadual='.$id_jadual;


        $this->db_2->query($sql_nilai);
        
        //echo $sql_nilai;
        echo TRUE;

  } 


}

/* End of file */