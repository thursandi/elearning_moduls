<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HMVC Codeigniter
 *
 * @package    	Mhs <controller>
 * @copyright  	Copyright (c) 2013, Kasino
 * @author     	Kasino <ezz_chocolate@yahoo.com>
 */
//simple_decrypt()
class Mhs extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

    $this->db_2 = $this->load->database('otherdb', TRUE); 
    $this->mhs_log_in = $this->session->userdata('mhs_log_in');
    $this->nim_2 = $this->session->userdata('nim');

    $this->load->model('mhs/mhs_model');


    $this->load->library('form_validation');
    $this->load->helper('security');
    $this->load->library('tank_auth');
    $this->lang->load('tank_auth');

    date_default_timezone_set("Asia/Jakarta");

	}

  private $db_2;
  private $mhs_log_in;
  private $nim_2;

  function index()
  {
    if ($this->mhs_log_in == 'log_in') {
       //redirect('mhs/biodata');
       if ($this->session->userdata('kuesioner_kampus') == 'sudah') {
           redirect('mhs/biodata');
        }else{
          redirect('mhs/kuesioner_matakuliah');
        }

    }else{
      redirect('mhs/login');
    }
  }

  
/*-----------------------------------------------------------------------*/
  public function simpan_kues_mhs()
  {
        if( $this->mhs_log_in != 'log_in'){
          redirect('mhs/login');
        }


        $nim=$this->input->post('nim');
        $id_jadual=$this->input->post('id_jadual');
        $data='';

        $post = $this->input->post('kues');
        $optional = $this->input->post('azz');
        //echo print_r($post);

        //cek apakah id_jadual pada data kuesioner
        $this->query = $this->db_2->query("SELECT DISTINCT * FROM el_kuesioner_nilai 
          WHERE id_jadual=$id_jadual LIMIT 1");

        if($this->query->num_rows >0){

          //apabila data pada id_jadual ada
          
                  //update data nilai kuesioner
                  $sql_kues = 'UPDATE el_kuesioner_nilai ';

                  $sql_kues .= 'SET nilai_kuesioner = CASE ';
                  for ($i=0; $i < count($post) ; $i++) { 
                      $sql_kues .= 'WHEN id_pertanyaan='.($i+1).' THEN nilai_kuesioner+'.$post[$i]["value"].' ';
                  }

                  $sql_kues .= ' END ';

                  $sql_kues .= ' , jumlah_mhs_input = CASE ';
                  for ($i=0; $i < count($post) ; $i++) { 
                      $sql_kues .= 'WHEN id_pertanyaan='.($i+1).' THEN jumlah_mhs_input+1 ';
                  }


                  $sql_kues .= ' END WHERE id_jadual='.$id_jadual;

                  //echo $sql_kues;
                  $this->db_2->query($sql_kues);
            // END update data nilai kuesioner
            

            //Start pertanyaan kritik saran
            $sql='';
            $sql = array(); 
            //$x=0;$y=1;$z=1;
            foreach ($optional as $row) {
              if (empty($row['value'])) continue;
              $this->db_2->query("INSERT INTO el_kuesioner_nilai_optional (id_jadual, keterangan, kode_pertanyaan) VALUES ($id_jadual, '".$this->db->escape_str($row['value'])."', '".$this->db->escape_str($row['name'])."')");
            }
            //End pertanyaan kritik saran
            //$this->db->escape_str($title)
 
        }else{

          //insert pertama kali data nilai kuesioner
          
          //data tidak ada
          $sql='';
          $sql = array(); 
          $x=0;$y=1;$z=1;
          foreach ($post as $row) {
            // $sql[] = '("'.mysql_real_escape_string($row['text']).'", '.$row['category_id'].')';
              $sql[] = '('.$id_jadual.', '.$y.', '.$post[$x]['value'].', '.$z.')';
              $x++;
              $y++;
          }
            //mysql_query('INSERT INTO el_kuesioner_nilai (id_jadual, id_pertanyaan, nilai_kuesioner, jumlah_mhs_input) VALUES '.implode(',', $sql));
            $this->db_2->query('INSERT INTO el_kuesioner_nilai (id_jadual, id_pertanyaan, nilai_kuesioner, jumlah_mhs_input) VALUES '.implode(',', $sql));

            //END insert pertama kali data nilai kuesioner
            
          //start
          $sql='';
          $sql = array(); 
          //$x=0;$y=1;$z=1;
          foreach ($optional as $row) {
             if (empty($row['value'])) continue;
              $this->db_2->query("INSERT INTO el_kuesioner_nilai_optional (id_jadual, keterangan, kode_pertanyaan) VALUES ($id_jadual, '".$this->db->escape_str($row['value'])."', '".$this->db->escape_str($row['name'])."')");
          }
          //END

        } 

        $this->db_2->query("INSERT INTO el_kuesioner_mhs (nim, id_jadual) VALUES 
              ($nim, $id_jadual)");
        
        //echo print_r($nilai);

        echo TRUE;
        //echo print_r($xf);
        

    }


/*-----------------------------------------------------------------------*/
  public function simpan_kues_kampus()
  {
        if( $this->mhs_log_in != 'log_in'){
          redirect('mhs/login');
        }


        $nim=$this->input->post('nim');
        $id_jadual=$this->input->post('id_jadual');
        $data='';

        $post = $this->input->post('kues');
       // $optional = $this->input->post('azz');
        //echo print_r($post);

        //cek apakah id_jadual pada data kuesioner
        $this->query = $this->db_2->query("SELECT DISTINCT * FROM el_kuesioner_kampus_nilai 
          WHERE id_kuesioner_kampus_master=$id_jadual
          AND thn_akademik=(SELECT thn_akademik FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
          AND periode=(SELECT periode FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1) 
           LIMIT 1");

        if($this->query->num_rows >0){

          //apabila data pada id_jadual ada
          
                  //update data nilai kuesioner kampus
                  $sql_kues = 'UPDATE el_kuesioner_kampus_nilai ';

                  $sql_kues .= 'SET nilai_kuesioner = CASE ';
                  for ($i=0; $i < count($post) ; $i++) { 
                      $sql_kues .= 'WHEN id_pertanyaan='.($i+1).' THEN nilai_kuesioner+'.$post[$i]["value"].' ';
                  }

                  $sql_kues .= ' END ';

                  $sql_kues .= ' , jumlah_mhs_input = CASE ';
                  for ($i=0; $i < count($post) ; $i++) { 
                      $sql_kues .= 'WHEN id_pertanyaan='.($i+1).' THEN jumlah_mhs_input+1 ';
                  }


                  $sql_kues .= ' END WHERE id_kuesioner_kampus_master='.$id_jadual.' 
                          AND thn_akademik=(SELECT thn_akademik FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
                           AND periode=(SELECT periode FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1) ';

                  //echo $sql_kues;
                  $this->db_2->query($sql_kues);
            // END update data nilai kuesioner
            
            /*keterangan optional start 
            //Start pertanyaan kritik saran
            $sql='';
            $sql = array(); 
            //$x=0;$y=1;$z=1;
            foreach ($optional as $row) {
              if (empty($row['value'])) continue;
              $this->db_2->query("INSERT INTO el_kuesioner_nilai_optional (id_jadual, keterangan, kode_pertanyaan) VALUES ($id_jadual, '".$this->db->escape_str($row['value'])."', '".$this->db->escape_str($row['name'])."')");
            }
            //End pertanyaan kritik saran
            //$this->db->escape_str($title)
            keterangan optional end*/
        }else{

          //insert pertama kali data nilai kuesioner kampus
          
          //data tidak ada
          $sql='';
          $sql = array(); 
          $x=0;$y=1;$z=1;
          foreach ($post as $row) {
            // $sql[] = '("'.mysql_real_escape_string($row['text']).'", '.$row['category_id'].')';
              $sql[] = '('.$id_jadual.', '.$y.', '.$post[$x]['value'].', '.$z.
                ', (SELECT thn_akademik FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)'.
                ', (SELECT periode FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)'.')';
              $x++;
              $y++;
          }
            //mysql_query('INSERT INTO el_kuesioner_nilai (id_jadual, id_pertanyaan, nilai_kuesioner, jumlah_mhs_input) VALUES '.implode(',', $sql));
            $this->db_2->query('INSERT INTO el_kuesioner_kampus_nilai (id_kuesioner_kampus_master, id_pertanyaan, nilai_kuesioner, jumlah_mhs_input, thn_akademik, periode) VALUES '.implode(',', $sql));

            //END insert pertama kali data nilai kuesioner
           
          /*keterangan optional start 
          //start
          $sql='';
          $sql = array(); 
          //$x=0;$y=1;$z=1;
          foreach ($optional as $row) {
             if (empty($row['value'])) continue;
              $this->db_2->query("INSERT INTO el_kuesioner_nilai_optional (id_jadual, keterangan, kode_pertanyaan) VALUES ($id_jadual, '".$this->db->escape_str($row['value'])."', '".$this->db->escape_str($row['name'])."')");
          }
          //END
          keterangan optional end*/

        } 

        $this->db_2->query("INSERT INTO el_kuesioner_kampus_mhs (nim, id_kuesioner_kampus_master, thn_akademik, periode) VALUES 
              ($nim, $id_jadual".
                ", (SELECT thn_akademik FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)".
                ", (SELECT periode FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)".")");
        
        //echo print_r($nilai);

        echo TRUE;
        //echo print_r($xf);
        

    }


  public function kuesioner_matakuliah()
  {

    //cek tipe user
        if( $this->mhs_log_in != 'log_in'){
          redirect('mhs/login');
        }


            //cek jumlah matkul yg diikuti
            $this->query = $this->db_2->query("SELECT DISTINCT B.id_jadual, B.periode, B.thn_akademik, D.nama as nama_dosen, D.gelar, C.nama FROM krs A, jadual B, mtk_next C, dosen D
                WHERE A.id_jadual=B.id_jadual
                AND B.id_mtk=C.id_mtk
                AND B.id_dosen=D.id_dosen 
                AND A.nim=$this->nim_2
                AND D.nama !='*'
                AND D.nama !='**' 
                AND D.nama IS NOT NULL
                AND B.thn_akademik=(SELECT thn_akademik FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
                AND B.periode=(SELECT periode FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
                GROUP BY B.id_jadual");

            $xyz=0;
            if($this->query->num_rows >0) {
                if ($this->query->num_rows <4) {
                    $xyz=$this->query->num_rows;
                }else{
                    $xyz=4;
                }
				$data['jumlah_kuesioner_harus_diisi'] = $xyz;
				$data['jumlah_kuesioner_telah_diisi']=$this->mhs_model->cek_kuesioner_matkul($this->nim_2);

        $data['jumlah_kuesioner_kampus']=$this->mhs_model->cek_kuesioner_kampus($this->nim_2);
            }else{
				//jika tidak ada matakuliah di bypass
				$this->session->set_userdata(array(
                            'kuesioner' => 'sudah',
                )); 
				 $this->session->set_userdata(array(
                            'kuesioner_kampus' => 'sudah',
                )); 
				
				redirect('mhs/biodata');
			}


		//if ($this->mhs_model->cek_kuesioner_matkul($this->nim_2) >= $xyz || $this->mhs_model->cek_status_kuesioner()==1) {
		if ( $data['jumlah_kuesioner_telah_diisi'] >= $xyz || $this->mhs_model->cek_status_kuesioner()==1) {
                # code...
                $this->session->set_userdata(array(
                            'kuesioner' => 'sudah',
                )); 

                if ( $data['jumlah_kuesioner_kampus']>=2 || $this->mhs_model->cek_status_kuesioner()==1 )
                {
                    $this->session->set_userdata(array(
                            'kuesioner_kampus' => 'sudah',
                    )); 
                }
        }


        //jika sudah kuesioner kampus
        if ($this->session->userdata('kuesioner_kampus') == 'sudah') {
          redirect('mhs/biodata');
        }


        if ($this->session->userdata('kuesioner') == 'sudah') {

          //masuk ke kuesioner kampus
          $data['title'] = 'E Learning Mahasiswa';
          $data['description'] = 'E Learning Mahasiswa';
          $data['keywords'] = 'e learning, mhs, mahasiswa stmi, stmi';

          $data['pertanyaan']=$this->mhs_model->pertanyaan_kampus();
		  
		  /*
          $result=$this->mhs_model->kues($this->session->userdata('nim'));
          
          if (!empty($result)) {
            foreach ($result->result_array() as $value) {
              # code...
              $data['id_jadual']=$value['id_jadual'];
              $data['mata_kuliah']=$value['mata_kuliah'];
              $data['semester']=$value['semester'].' / '.$value['sks'];
              $data['nama_dosen']=str_replace('*', $value['nama'].', ' , $value['gelar']);
            }
          }else{
            //redirect('mhs/logout');
			
			$this->session->set_userdata(array(
                            'kuesioner' => 'sudah',
                )); 
				 $this->session->set_userdata(array(
                            'kuesioner_kampus' => 'sudah',
                )); 
				
            redirect('mhs/biodata');
          }
		  */
// $data['pertanyaan']=$this->mhs_model->pertanyaan();
          //isi konten
          
          $tipe_kues_kampus=intval($data['jumlah_kuesioner_kampus']+1);
          
          if ( $tipe_kues_kampus == 1)
          {
              $kode=" </tr>
                              <td>SKOR</td>
                              <td>:</td>
                              <td><b>
                                1 =  Tidak Penting<br>
                                2 = Cukup Penting<br>
                                3 = Penting<br>
                                4 = Sangat Penting<br>
                                </b>
                            </tr>";

                $data['tipe_kues_pertanyaan']='KEPENTINGAN';
          }else{
               $kode=" </tr>
                              <td>SKOR</td>
                              <td>:</td>
                              <td><b>
                                1 = Tidak Puas<br>
                                2 = Cukup Puas<br>
                                3 = Puas<br>
                                4 = Sangat Puas<br>
                                </b>
                            </tr>";
                $data['tipe_kues_pertanyaan']='KEPUASAN';
          }
          $data['skor']=$kode;

          $data['isicontent'] = 'mhs/_kuesioner_kampus';
          $this->load->view('mhs/_layout',$data); 



        }else{


          //masuk ke kuesioner mata kuliah
          $data['title'] = 'E Learning Mahasiswa';
          $data['description'] = 'E Learning Mahasiswa';
          $data['keywords'] = 'e learning, mhs, mahasiswa stmi, stmi';

          $data['pertanyaan']=$this->mhs_model->pertanyaan();
          $result=$this->mhs_model->kues($this->session->userdata('nim'));
          
          if (!empty($result)) {
            foreach ($result->result_array() as $value) {
              # code...
              $data['id_jadual']=$value['id_jadual'];
              $data['mata_kuliah']=$value['mata_kuliah'];
              $data['semester']=$value['semester'].' / '.$value['sks'];
              $data['nama_dosen']=str_replace('*', $value['nama'].', ' , $value['gelar']);
            }
          }else{
            //redirect('mhs/logout');
			
			
			 $this->session->set_userdata(array(
                            'kuesioner' => 'sudah',
                )); 
				 $this->session->set_userdata(array(
                            'kuesioner_kampus' => 'sudah',
                )); 
				
            redirect('mhs/biodata');
          }

          //isi konten
          $data['isicontent'] = 'mhs/_abc';
          $this->load->view('mhs/_layout',$data); 

        }
  }

  public function login()
  {
	
     if ($this->mhs_log_in == 'log_in') {
       redirect('mhs/biodata');
     }
	 
    $data['use_recaptcha'] = $this->config->item('use_recaptcha', 'tank_auth');
     if ($data['use_recaptcha']) {
          $data['recaptcha_html'] = $this->_create_recaptcha();
        } else {
          $data['captcha_html'] = $this->_create_captcha();
        }


        if ($data['use_recaptcha']){
          //keamanan
    //      $this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
        }else{
     //     $this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
        }

      //data pribadi
      $this->form_validation->set_rules('nim', 'NIM', 'trim|required|xss_clean|min_length[7]|numeric');
      $this->form_validation->set_rules('tgl', 'Tgl', 'trim|required|xss_clean|min_length[2]|numeric');
      $this->form_validation->set_rules('bln', 'Thn', 'trim|required|xss_clean|min_length[2]|numeric');
      $this->form_validation->set_rules('thn', 'Thn', 'trim|required|xss_clean|min_length[4]|numeric');
     
        

      $data['error_bukan_mahasiswa'] = 'style="display:none;"';

      if ($this->form_validation->run()) {                // validation ok

              $data['nim']=$this->input->post('nim');
              $data['tgl_lahir']=$this->input->post('thn').'-'.$this->input->post('bln').'-'.$this->input->post('tgl');

            
              if ($this->mhs_model->cek_mhs_aktif($data['nim'],$data['tgl_lahir']))
              {
                $this->mhs_model->log_login_mhs($data['nim']);
                redirect('mhs/biodata');
              
              }
              else
              {
                  $data['error_bukan_mahasiswa'] ='';
              }
        
      }

      //$data['recaptcha_html'] = $this->_create_recaptcha();
      
      
      
      $data['title'] = 'E Learning Mahasiswa';
      $data['description'] = 'E Learning Mahasiswa';
      $data['keywords'] = 'e learning, mhs, mahasiswa stmi, stmi';

      $this->load->view('mhs/_login_form',$data); 
  }



  public function biodata()
  {

    //cek tipe user
        if( $this->mhs_log_in != 'log_in'){
          redirect('mhs/login');
        }

        if ($this->session->userdata('kuesioner_kampus') != 'sudah') {
          redirect('mhs/kuesioner_matakuliah');
        }

          $data['title'] = 'E Learning Mahasiswa';
          $data['description'] = 'E Learning Mahasiswa';
          $data['keywords'] = 'e learning, mhs, mahasiswa stmi, stmi';

          $data['ipk']=$this->mhs_model->cek_ipk_mhs($this->nim_2);
    		  $data['dosen_wali']=$this->mhs_model->get_dosen_wali($this->nim_2);

          //isi konten
          $data['isicontent'] = 'mhs/_home';
          $this->load->view('mhs/_layout',$data); 

  }

  public function grafik_ips()
  {

    //cek tipe user
        if( $this->mhs_log_in != 'log_in'){
          redirect('mhs/login');
        }

        if ($this->session->userdata('kuesioner_kampus') != 'sudah') {
          redirect('mhs/kuesioner_matakuliah');
        }

          $data['title'] = 'E Learning Mahasiswa';
          $data['description'] = 'E Learning Mahasiswa';
          $data['keywords'] = 'e learning, mhs, mahasiswa stmi, stmi';

          $data['ip_per_semester']=$this->mhs_model->cek_ip_semester($this->nim_2);

          //isi konten
          $data['isicontent'] = 'mhs/_grafik_ips';
          $this->load->view('mhs/_layout',$data); 

  }

  public function nilai()
  {

    //cek tipe user
        if( $this->mhs_log_in != 'log_in'){
          redirect('mhs/login');
        }

        if ($this->session->userdata('kuesioner_kampus') != 'sudah') {
          redirect('mhs/kuesioner_matakuliah');
        }

          $data['title'] = 'E Learning Mahasiswa';
          $data['description'] = 'E Learning Mahasiswa';
          $data['keywords'] = 'e learning, mhs, mahasiswa stmi, stmi';

          $data['nilai']=$this->mhs_model->cek_nilai_mhs($this->nim_2);

          //isi konten
          $data['isicontent'] = 'mhs/_nilai';
          $this->load->view('mhs/_layout',$data); 

  }

  public function logout()
  {

    // See http://codeigniter.com/forums/viewreply/662369/ as the reason for the next line
    //$this->session->set_userdata(array('user_id' => '', 'username' => '', 'status' => ''));
    $this->session->set_userdata(array(
                            'nim' => '',
                            'nama'  => '',
                            'angkatan'  => '',
                            'jurusan' => '',
                            'mhs_log_in'  => '',
     ));

    $this->session->sess_destroy();
    redirect('mhs');
  }


  public function download_materi_kuliah()
  {

    //cek tipe user
        if( $this->mhs_log_in != 'log_in'){
          redirect('mhs/login');
        }

        if ($this->session->userdata('kuesioner_kampus') != 'sudah') {
          redirect('mhs/kuesioner_matakuliah');
        }

          $data['title'] = 'E Learning Mahasiswa';
          $data['description'] = 'E Learning Mahasiswa';
          $data['keywords'] = 'e learning, mhs, mahasiswa stmi, stmi';

          $data['materi_kuliah']=$this->mhs_model->get_materi_kuliah();
          $data['nama_dosen_materi']=$this->mhs_model->get_nama_dosen();


          //isi konten
          $data['isicontent'] = 'mhs/_materi_kuliah';
          $this->load->view('mhs/_layout',$data); 

  }


  function download_materi($link)
    {
        $this->load->helper('download');
        
        $path = $this->config->item('base_url') . "assets/uploads/materi_kuliah/".$link;
        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename=$link");
        ob_clean();
        flush();
        readfile($path);
    }

	
	public function baca_materi_kuliah($nama_pdf='')
  {

    //cek tipe user
        if( $this->mhs_log_in != 'log_in'){
          redirect('mhs/login');
        }

        if ($this->session->userdata('kuesioner_kampus') != 'sudah') {
          redirect('mhs/kuesioner_matakuliah');
        }
		
		$filename = 'assets/uploads/materi_kuliah/'.$nama_pdf;
		$exists = file_exists($filename);
		if(!$exists) {
			 redirect('home/error404');
		}

          $data['title'] = 'E Learning Mahasiswa';
          $data['description'] = 'E Learning Mahasiswa';
          $data['keywords'] = 'e learning, mhs, mahasiswa stmi, stmi';

          $data['path_pdf']=$nama_pdf;
		  


          //isi konten
          $data['isicontent'] = 'mhs/_baca_materi_kuliah';
          $this->load->view('mhs/_layout',$data); 

  }

  public function cetak_kst()
  {

    //cek tipe user
        if( $this->mhs_log_in != 'log_in'){
          redirect('mhs/login');
        }

        if ($this->session->userdata('kuesioner_kampus') != 'sudah') {
          redirect('mhs/kuesioner_matakuliah');
        }

          $data['title'] = 'E Learning Mahasiswa';
          $data['description'] = 'E Learning Mahasiswa';
          $data['keywords'] = 'e learning, mhs, mahasiswa stmi, stmi';

          $data['ipk']=$this->mhs_model->cek_ipk_mhs($this->nim_2);
		  $data['dosen_wali']=$this->mhs_model->get_dosen_wali($this->nim_2);

          //isi konten
          $data['isicontent'] = 'mhs/cetak_kartu/cetak_save';
          $this->load->view('mhs/_layout',$data); 

  }


/*-------------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------*/


  public function chat()
  {
      //cek tipe user
        if( $this->mhs_log_in != 'log_in'){
          redirect('mhs/login');
        }

        if ($this->session->userdata('kuesioner_kampus') != 'sudah') {
          redirect('mhs/kuesioner_matakuliah');
        }

        $this->load->model('mhs/chat_model');
        $data['daftar_chat']=$this->chat_model->get_chat(ucwords($this->session->userdata('jurusan')));

   
     $data['use_recaptcha'] = $this->config->item('use_recaptcha', 'tank_auth');
     if ($data['use_recaptcha']) {
          $data['recaptcha_html'] = $this->_create_recaptcha();
        } else {
          $data['captcha_html'] = $this->_create_captcha();
        }


        if ($data['use_recaptcha']){
          //keamanan
          $this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
        }else{
          $this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
        }

      //data chat
      $this->form_validation->set_rules('chat', 'Chat', 'trim|required|xss_clean|max_length[250]|strip_tags');
     
        

      //$data['error_bukan_mahasiswa'] = 'style="display:none;"';

      if ($this->form_validation->run()) {                // validation ok

          $data['chat']=$this->input->post('chat');

        /*
              if ($this->mhs_model->cek_mhs_aktif($data['nim'],$data['tgl_lahir']))
              {
                $this->mhs_model->log_login_mhs($data['nim']);
                redirect('mhs/chat');
              
              }
              else
              {
                  $data['error_bukan_mahasiswa'] ='';

              }
        */

              $this->chat_model->insert_chat($data['chat'],$this->session->userdata('nim'));
              redirect('mhs/chat');
        
      }

      $data['recaptcha_html'] = $this->_create_recaptcha();
      
      
      
      $data['title'] = 'E Learning Mahasiswa';
      $data['description'] = 'E Learning Mahasiswa';
      $data['keywords'] = 'e learning, mhs, mahasiswa stmi, stmi';
 
       //isi konten
          $data['isicontent'] = 'mhs/_chat';
          $this->load->view('mhs/_layout',$data); 
  }























/*-------------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------*/

  function _alpha_dash_space($str)
  {
    return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
  } 




/*-------------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------*/
  /**
   * Create reCAPTCHA JS and non-JS HTML to verify user as a human
   *
   * @return  string
   */
  function _create_recaptcha()
  {
    $this->load->helper('recaptcha');

    // Add custom theme so we can get only image
    $options = "<script>var RecaptchaOptions = {theme : 'clean'};</script>\n";

    // Get reCAPTCHA JS and non-JS HTML
    $html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'tank_auth'));

    return $options.$html;
  }

  /**
   * Callback function. Check if reCAPTCHA test is passed.
   *
   * @return  bool
   */
  function _check_recaptcha()
  {
    $this->load->helper('recaptcha');

    $resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'tank_auth'),
        $_SERVER['REMOTE_ADDR'],
        $_POST['recaptcha_challenge_field'],
        $_POST['recaptcha_response_field']);

    if (!$resp->is_valid) {
      $this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
      return FALSE;
    }
    return TRUE;
  }

/*-------------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------*/



  /**
   * Create CAPTCHA image to verify user as a human
   *
   * @return  string
   */
  function _create_captcha()
  {
    $this->load->helper('captcha');

    $cap = create_captcha(array(
      'img_path'    => './'.$this->config->item('captcha_path', 'tank_auth'),
      'img_url'   => base_url().$this->config->item('captcha_path', 'tank_auth'),
      'font_path'   => './'.$this->config->item('captcha_fonts_path', 'tank_auth'),
      'font_size'   => $this->config->item('captcha_font_size', 'tank_auth'),
      'img_width'   => $this->config->item('captcha_width', 'tank_auth'),
      'img_height'  => $this->config->item('captcha_height', 'tank_auth'),
      'show_grid'   => $this->config->item('captcha_grid', 'tank_auth'),
      'expiration'  => $this->config->item('captcha_expire', 'tank_auth'),
    ));

    // Save captcha params in session
    $this->session->set_flashdata(array(
        'captcha_word' => $cap['word'],
        'captcha_time' => $cap['time'],
    ));

    return $cap['image'];
  }

  /**
   * Callback function. Check if CAPTCHA test is passed.
   *
   * @param string
   * @return  bool
   */
  function _check_captcha($code)
  {
    $time = $this->session->flashdata('captcha_time');
    $word = $this->session->flashdata('captcha_word');

    list($usec, $sec) = explode(" ", microtime());
    $now = ((float)$usec + (float)$sec);

    if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
      $this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
      return FALSE;

    } elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
        $code != $word) OR
        strtolower($code) != strtolower($word)) {
      $this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
      return FALSE;
    }
    return TRUE;
  }

}

/* End of file */