<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Contoh extends CI_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			//echo "hellow ci";
			$this->load->library('menu_otomatis');
			$this->load->helper(array('form', 'url'));
		}

		function index()
		{
			
			redirect('/contoh/tes/');

		}

		function tes()
		{
			

			//form validation
				$this->form_validation->set_rules('nama');
				$this->form_validation->set_rules('jurusan');
				if($this->form_validation->run()){
					foreach ($this->input->post('nama') as $nm) {
						# code...
						echo $nm."<br>";
					}
					foreach ($this->input->post('jurusan') as $jur) {
						# code...
						echo $jur."<br>";
					}
				}else{

				  $data['title'] = 'Absensi';
		          $data['description'] = 'Absensi';
		          $data['keywords'] = 'Absensi Matakuliah';

		          //$data['biodata'] =$this->e_dosen_model->get_biodata_dosen($this->session->userdata('user_id'));
		          //$data['jadwal_mengajar'] =$this->e_dosen_model->get_jadwal_mengajar_dosen($this->session->userdata('nama_asli'));

					//isi konten
					$data['isicontent'] = 'contoh/form';
					$data['menu_header'] = $this->menu_otomatis->create_menu_admin
											(0, 1, 'menu_admin_elearning_dosen');
					$this->load->view('e_dosen/_layout',$data);	
				}
			//===============
		}

		function tes2()
		{
			

			//form validation
				$this->form_validation->set_rules('nama');
				$this->form_validation->set_rules('jurusan');
				if($this->form_validation->run()){
					foreach ($this->input->post('nama') as $nm) {
						# code...
						echo $nm."<br>";
					}
					foreach ($this->input->post('jurusan') as $jur) {
						# code...
						echo $jur."<br>";
					}
				}else{

				  $data['title'] = 'Absensi';
		          $data['description'] = 'Absensi';
		          $data['keywords'] = 'Absensi Matakuliah';

		          //$data['biodata'] =$this->e_dosen_model->get_biodata_dosen($this->session->userdata('user_id'));
		          //$data['jadwal_mengajar'] =$this->e_dosen_model->get_jadwal_mengajar_dosen($this->session->userdata('nama_asli'));

					//isi konten
					$data['isicontent'] = 'contoh/form';
					$data['menu_header'] = $this->menu_otomatis->create_menu_admin
											(0, 1, 'menu_admin_elearning_dosen');
					$this->load->view('e_dosen/_layout',$data);	
				}
			//===============
		}
	}

	

?>