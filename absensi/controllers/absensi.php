<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Absensi extends CI_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
/*

			//echo "hellow ci";
 			$this->db_2 = $this->load->database('otherdb', TRUE); 
		    $this->tipe_user = simple_decrypt($this->session->userdata('tipe_user'));
			$this->load->library('tank_auth');
   
			$this->load->model('absensi/absensi');
			$this->load->library('menu_otomatis');

			$this->load->library('menu_otomatis');
			$this->load->library('data_pendukung');
			$this->load->helper(array('form', 'url'));
*/
 			$this->db_2 = $this->load->database('otherdb', TRUE); 
			$this->load->model('absensi/absensi_model');

			$this->load->library('menu_otomatis');
			$this->load->helper(array('form', 'url'));
			date_default_timezone_set("Asia/Jakarta");
		}

		function index()
		{
			
			redirect('/absensi/rps/');

		}

//RPS Dari Prodi
		function rps()
		{
			


				  $data['title'] = 'Absensi';
		          $data['description'] = 'Absensi';
		          $data['keywords'] = 'Absensi Matakuliah';
		          $data['record'] = $this->absensi_model->get_rps();

		          //$data['biodata'] =$this->e_dosen_model->get_biodata_dosen($this->session->userdata('user_id'));
		          //$data['jadwal_mengajar'] =$this->e_dosen_model->get_jadwal_mengajar_dosen($this->session->userdata('nama_asli'));

					//isi konten
					$data['isicontent'] = 'absensi/form';
					$data['menu_header'] = $this->menu_otomatis->create_menu_admin
											(0, 1, 'menu_admin_elearning_dosen');
					$this->load->view('e_dosen/_layout',$data);	
			//===============
		}


function rps_realisasi()

		{
	   			  $id_jadual = $this->uri->segment(3);
	   			  $data['id_jadual'] = $this->uri->segment(3);
				  $data['title'] = 'Absensi';
		          $data['description'] = 'Absensi';
		          $data['keywords'] = 'Absensi Matakuliah';
		          $data['record'] = $this->absensi_model->get_rps_realisasi($id_jadual);

		          //rps kosong
		          if(!$this->uri->segment(4) == null){
		          	$data['rps_kosong'] = $this->uri->segment(4);
		          }

		          //$data['biodata'] =$this->e_dosen_model->get_biodata_dosen($this->session->userdata('user_id'));
		          //$data['jadwal_mengajar'] =$this->e_dosen_model->get_jadwal_mengajar_dosen($this->session->userdata('nama_asli'));

					//isi konten
					$data['isicontent'] = 'absensi/form_rps_realisasi';
					$data['menu_header'] = $this->menu_otomatis->create_menu_admin
											(0, 1, 'menu_admin_elearning_dosen');
					$this->load->view('e_dosen/_layout',$data);	
			//===============
		}

//menampilkan form edit rps realisasi
function rps_realisasi_edit()

		{
	   			  $id_absen = $this->uri->segment(4);
	   			  $id_jadual = $this->uri->segment(3);

	   			  $data['id_jadual'] = $this->uri->segment(3);
				  $data['title'] = 'Absensi';
		          $data['description'] = 'Absensi';
		          $data['keywords'] = 'Absensi Matakuliah';
		          $data['record'] = $this->absensi_model->get_rps_realisasi_edit($id_absen)->row_array();

		          //$data['biodata'] =$this->e_dosen_model->get_biodata_dosen($this->session->userdata('user_id'));
		          //$data['jadwal_mengajar'] =$this->e_dosen_model->get_jadwal_mengajar_dosen($this->session->userdata('nama_asli'));

					//isi konten
					$data['isicontent'] = 'absensi/form_rps_realisasi_edit';
					$data['menu_header'] = $this->menu_otomatis->create_menu_admin
											(0, 1, 'menu_admin_elearning_dosen');
					$this->load->view('e_dosen/_layout',$data);	
			//===============
		}

function simpan_rps_realisasi(){

		$id_jadual = $this->uri->segment(3);
				//real id dosen
		$materi 		= $this->input->post('materi');

		$id_dosen = $this->db_2->like('nama',$this->session->userdata('nama_asli'))
							   ->get('dosen')
							   ->row()
							   ->id_dosen;
		
		$data = array(
						'id_jadual'   => $id_jadual,
						'id_dosen'	  => $id_dosen,
						'status' => 0
						);

		$data_update = array('materi' =>  $materi);
		
		$this->db_2->update('absen_mtk', $data_update, array('id_jadual'  => $id_jadual, 'id_dosen' => $id_dosen, 'status' => 0));
		

		redirect('absensi/rps_realisasi/'.$id_jadual);

}

function edit_rps_realisasi(){

		$id_jadual = $this->uri->segment(3);
				//real id dosen
		$materi 		= $this->input->post('materi');
		$id_absen 		= $this->input->post('id_absen');
			
		$data = array(
						'id_absen'   => $id_absen,
						);
		$this->db_2->update('absen_mtk', array('materi' => $materi ),$data);
		redirect('absensi/absen_detail/'.$id_jadual);

}



		function mahasiswa()
		{

		$id_jadual = $this->uri->segment(3);
		//$id_dosen  = $this->session->userdata('user_id');

		//real id dosen
		$id_dosen = $this->db_2->like('nama',$this->session->userdata('nama_asli'))
							   ->get('dosen')
							   ->row()
							   ->id_dosen;
		
		//mengecek untuk direct ke form edit
		$this->query2 = $this->db_2->query("SELECT * FROM `absen_mtk_detail_mhs` WHERE absen_mtk_detail_mhs.id_absen IN
												( SELECT max(absen_mtk.id_absen) from absen_mtk
										          where absen_mtk.id_jadual = '$id_jadual' AND
										          absen_mtk.id_dosen = '$id_dosen' AND
										          absen_mtk.status = 0)

										    Limit 1");

 		if($this->query2->num_rows() > 0 ){
 			$row = $this->query2->row();
 			$id_absen = $row->id_absen;
			redirect('absensi/mahasiswa_edit/'.$id_jadual.'/'.$id_absen);
 			
		}
		
		//mengecek jadul hari ini sudah di input atau belum
		$this->query = $this->db_2->query("SELECT * FROM `absen_mtk` WHERE id_jadual = '".$id_jadual."' AND status = 0 AND id_dosen = '$id_dosen'");

 		
 		if($this->query->num_rows() == 0){
			
 			//get sks
 			//$sks = $this->absensi_model->get_sks($id_jadual);

			$date = date('Y-m-d	H:i:s');
			$date_selesai = date('Y-m-d H:i:s',strtotime('+ 225 minute'));

			//$data=array('id_jadual'=>$id_jadual,'waktu_input'=>$date,'id_dosen'=>$this->session->userdata('user_id'));
			$data=array('id_jadual'=>$id_jadual,'waktu_input'=>$date,'id_dosen'=>$id_dosen,'waktu_selesai'=>$date_selesai);


			$this->db_2->insert('absen_mtk',$data);
		//	redirect('rps/post');
			}
			
	//mengambil id absen yang status nya 0
	$data['record2'] = $this->db_2->query("SELECT max(id_absen) as id_absen, id_jadual FROM `absen_mtk` WHERE id_jadual = '".$id_jadual."' AND status = 0 ")->row_array();
	
				  $data['id_jadual'] = $this->uri->segment(3);
				  $data['title'] = 'Absensi';
		          $data['description'] = 'Absensi';
		          $data['keywords'] = 'Absensi Matakuliah';
		          $data['record'] = $this->absensi_model->get_mahasiswa($id_jadual)->result();
		          //$data['biodata'] =$this->e_dosen_model->get_biodata_dosen($this->session->userdata('user_id'));
		          //$data['jadwal_mengajar'] =$this->e_dosen_model->get_jadwal_mengajar_dosen($this->session->userdata('nama_asli'));

					//isi konten
					$data['isicontent'] = 'absensi/absen_mhs';
					$data['menu_header'] = $this->menu_otomatis->create_menu_admin
											(0, 1, 'menu_admin_elearning_dosen');
					$this->load->view('e_dosen/_layout',$data);	
			//===============
		}

function simpan_absen(){

		$id_jadual = $this->uri->segment(3);
		$id_absen = $this->input->post('id_absen');

		$data2 = $this->absensi_model->get_mahasiswa($id_jadual)->result();


		$arr_nim 		= $this->input->post('nim');
		$arr_jurusan	= $this->input->post('jurusan');
		$combine 		= array_combine($arr_nim, $arr_jurusan); 
		
		foreach ($combine as $nim => $absen) {
				# code...
				//echo "id jadwal : ".$id_absen."<br>";
				//echo "Nama : ".$nim." Absen : ".$jurusan."<br>";

			$data = array(
							'nim' => $nim,
							'id_absen' => $id_absen,
							'status_absen' => $absen 
					);

			$this->db_2->insert('absen_mtk_detail_mhs',$data);
		}						
		
		redirect('absensi/rps_realisasi/'.$id_jadual);

}

function mahasiswa_edit(){
		$id_jadual = $this->uri->segment(3);
		//$id_dosen  = $this->session->userdata('user_id');
		/*$id_dosen = $this->db_2->like('nama',$this->session->userdata('nama_asli'))
							   ->get('dosen')
							   ->row()
							   ->id_dosen;*/
		$id_absen  = $this->uri->segment(4);
		/*$data['record2'] = $this->db_2->query("SELECT * FROM `absen_mtk` WHERE id_jadual = '".$id_jadual."' AND status = 0 
						AND waktu_input = CURRENT_DATE")->row_array();*/
		//mengambil id absen yang status nya 0
				//$data['record2']  = $query->row_array();	
				//$id_absen = $data['record2']['id_absen'];
				  $data['id_jadual'] = $this->uri->segment(3);
				  $data['title'] = 'Absensi';
		          $data['description'] = 'Absensi';
		          $data['keywords'] = 'Absensi Matakuliah';
		          $data['record']  = $this->absensi_model->edit_mahasiswa($id_absen)->result();
		          $data['record2'] = $this->db_2->get_where('absen_mtk',array('id_absen' => $id_absen))
		          								->row(); 
		          //$data['biodata'] =$this->e_dosen_model->get_biodata_dosen($this->session->userdata('user_id'));
		          //$data['jadwal_mengajar'] =$this->e_dosen_model->get_jadwal_mengajar_dosen($this->session->userdata('nama_asli'));
					//isi konten
					$data['isicontent'] = 'absensi/absen_mhs_edit';
					$data['menu_header'] = $this->menu_otomatis->create_menu_admin
											(0, 1, 'menu_admin_elearning_dosen');
					$this->load->view('e_dosen/_layout',$data);	
}

function mahasiswa_edit_ak(){
		$id_jadual = $this->uri->segment(3);
		//$id_dosen  = $this->session->userdata('user_id');
		/*$id_dosen = $this->db_2->like('nama',$this->session->userdata('nama_asli'))
							   ->get('dosen')
							   ->row()
							   ->id_dosen;*/
		$id_absen  = $this->uri->segment(4);
		/*$data['record2'] = $this->db_2->query("SELECT * FROM `absen_mtk` WHERE id_jadual = '".$id_jadual."' AND status = 0 
						AND waktu_input = CURRENT_DATE")->row_array();*/
		//mengambil id absen yang status nya 0
				//$data['record2']  = $query->row_array();	
				//$id_absen = $data['record2']['id_absen'];
				  $data['id_jadual'] = $this->uri->segment(3);
				  $data['title'] = 'Absensi';
		          $data['description'] = 'Absensi';
		          $data['keywords'] = 'Absensi Matakuliah';
		          $data['record']  = $this->absensi_model->edit_mahasiswa($id_absen)->result();
		          $data['record2'] = $this->db_2->get_where('absen_mtk',array('id_absen' => $id_absen))
		          								->row(); 
		          //$data['biodata'] =$this->e_dosen_model->get_biodata_dosen($this->session->userdata('user_id'));
		          //$data['jadwal_mengajar'] =$this->e_dosen_model->get_jadwal_mengajar_dosen($this->session->userdata('nama_asli'));
					//isi konten
					$data['isicontent'] = 'absensi/absen_mhs_edit_ak';
					$data['menu_header'] = $this->menu_otomatis->create_menu_admin
											(0, 1, 'menu_admin_elearning_dosen');
					$this->load->view('e_dosen/_layout',$data);	
}



	function simpan_absen_edit()
	{
		$id_jadual = $this->uri->segment(3);
		$id_absen = $this->input->post('id_absen');

		//$data2 = $this->absensi_model->get_mahasiswa($id_jadual)->result();
		
		$arr_nim 		= $this->input->post('nim');
		$arr_jurusan	= $this->input->post('jurusan');
		$combine 		= array_combine($arr_nim, $arr_jurusan); 
		

		foreach ($combine as $nim => $absen) {
				# code...
				//echo "id jadwal : ".$id_absen."<br>";
				//echo "Nama : ".$nim." Absen : ".$jurusan."<br>";
			$data = array(
							'nim' => $nim,
							'id_absen' => $id_absen
							
					);

			$this->db_2->update('absen_mtk_detail_mhs', array('status_absen' => $absen) , $data);
		}						
		
		redirect('absensi/mahasiswa_edit/'.$id_jadual.'/'.$id_absen);

	}

	
	function simpan_absen_edit_ak()
	{
		$id_jadual = $this->uri->segment(3);
		$id_absen = $this->input->post('id_absen');

		//$data2 = $this->absensi_model->get_mahasiswa($id_jadual)->result();
		
		$arr_nim 		= $this->input->post('nim');
		$arr_jurusan	= $this->input->post('jurusan');
		$combine 		= array_combine($arr_nim, $arr_jurusan); 
		

		foreach ($combine as $nim => $absen) {
				# code...
				//echo "id jadwal : ".$id_absen."<br>";
				//echo "Nama : ".$nim." Absen : ".$jurusan."<br>";
			$data = array(
							'nim' => $nim,
							'id_absen' => $id_absen
							
					);

			$this->db_2->update('absen_mtk_detail_mhs', array('status_absen' => $absen) , $data);
		}						
		
		redirect('absensi/mahasiswa_edit_ak/'.$id_jadual.'/'.$id_absen);

	}


	function selesai()
	{
		$id_jadual	= $this->uri->segment(3);
		//$id_dosen	= $this->session->userdata('user_id');

		//real id dosen
		$id_dosen = $this->db_2->like('nama',$this->session->userdata('nama_asli'))
							   ->get('dosen')
							   ->row()
							   ->id_dosen;
		//cek rps 
		$where = array(
						'id_jadual' => $id_jadual,
						'id_dosen'  => $id_dosen,
						'materi'	=> ''
						);					   

		$query = $this->db_2->where($where)
							->get('absen_mtk');

		if($query->num_rows() > 0){
			$y = 'y';
			redirect('absensi/rps_realisasi/'.$id_jadual.'/'.$y);
		}					
		//----------------------------------------					   
		


		$query2 = $this->db_2->query("SELECT * FROM `absen_mtk_detail_mhs`, absen_mtk WHERE absen_mtk_detail_mhs.id_absen IN
												( SELECT max(absen_mtk.id_absen) from absen_mtk
										          where absen_mtk.id_jadual = '$id_jadual' AND
										          absen_mtk.id_dosen = '$id_dosen' AND
										          absen_mtk.status = 0)
										         AND
										         absen_mtk.id_absen = absen_mtk_detail_mhs.id_absen 
										    limit 1");
		$q = $query2->row();

 		if(!$query2->num_rows() == 0 ){

 			//cek waktu selessai < now
 			if($q->waktu_selesai < date('Y-m-d H:i:s')){
 				$waktu_mulai = $q->waktu_input;
 				$waktu_selesai = date('Y-m-d H:i:s',strtotime('+30 minute',strtotime($waktu_mulai)));

 			}elseif($q->waktu_selesai > date('Y-m-d H:i:s')){
 				$waktu_selesai = date('Y-m-d H:i:s');
 			}

 			//------------------------
			$data = array(//yang ini buat data nya
						'waktu_selesai' => $waktu_selesai,
						'status'		=> 1
						);

			/*echo $data['id_jadual']."<br>";
			echo $data['id_dosen']."<br>";*/
			$this->db_2->update('absen_mtk', $data, array('status' => 0,'id_dosen'=>$id_dosen,'id_jadual'=>$id_jadual));
			redirect('e_dosen/biodata'); 
					
		}else{
			
			redirect('absensi/mahasiswa/'.$id_jadual);
		}
	}

	//RPS Dari Prodi
		function tampilkan_jadual()
		{
				  $data['title'] = 'Absensi';
		          $data['description'] = 'Absensi';
		          $data['keywords'] = 'Absensi Matakuliah';
		          $data['record'] = $this->absensi_model->get_jadual_mtk();
				 //$data['biodata'] =$this->e_dosen_model->get_biodata_dosen($this->session->userdata('user_id'));
		          //$data['jadwal_mengajar'] =$this->e_dosen_model->get_jadwal_mengajar_dosen($this->session->userdata('nama_asli'));

					//isi konten
					$data['isicontent'] = 'absensi/lihat_jadual';
					$data['menu_header'] = $this->menu_otomatis->create_menu_admin
											(0, 1, 'menu_admin_elearning_dosen');
					$this->load->view('e_dosen/_layout',$data);	
			//===============
		}

	//detail jadual RPS dan absen

	function absen_detail(){
				$id_jadual	= $this->uri->segment(3);
				  $data['title'] = 'Absensi';
		          $data['description'] = 'Absensi';
		          $data['keywords'] = 'Absensi Matakuliah';
		          $data['record'] = $this->absensi_model->absensi_detail($id_jadual);
					//$data['biodata'] =$this->e_dosen_model->get_biodata_dosen($this->session->userdata('user_id'));
		        	//$data['jadwal_mengajar'] =$this->e_dosen_model->get_jadwal_mengajar_dosen($this->session->userdata('nama_asli'));
					//isi konten
				  $data['isicontent'] = 'absensi/absen_rps';
				  $data['menu_header'] = $this->menu_otomatis->create_menu_admin
											(0, 1, 'menu_admin_elearning_dosen');
				  $this->load->view('e_dosen/_layout',$data);	
	}
	
	// buat nampil absen mahasiswa di login mahasiswa
	function tampil_absen_mhs(){

				  $data['title'] = 'Absensi';
		          $data['description'] = 'Absensi';
		          $data['keywords'] = 'Absensi Matakuliah';
		          $data['record'] = $this->absensi_model->tampil_absen_mhs();
					//$data['biodata'] =$this->e_dosen_model->get_biodata_dosen($this->session->userdata('user_id'));
		        	//$data['jadwal_mengajar'] =$this->e_dosen_model->get_jadwal_mengajar_dosen($this->session->userdata('nama_asli'));
					//isi konten
				  $data['isicontent'] = 'absensi/tampil_absen_mhs';
				  $data['menu_header'] = $this->menu_otomatis->create_menu_admin
											(0, 1, 'menu_admin_elearning_dosen');
				  $this->load->view('e_dosen/_layout',$data);	
	}
	

	}


?>