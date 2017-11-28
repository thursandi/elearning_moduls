<?php
	/**
	* 
	*/
	class Mhs_absensi extends CI_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->db_2 = $this->load->database('otherdb', TRUE); 
			$this->mhs_log_in = $this->session->userdata('mhs_log_in');
			$this->nim_2 = $this->session->userdata('nim');
			$this->load->model('absensi/absensi_model');
		}

		private $mhs_log_in;
		private $nim_2;

		function index()
		{
			if( $this->mhs_log_in != 'log_in'){
          		redirect('mhs/login');
        	}

        	  $data['title'] = 'E Learning Mahasiswa';
	          $data['description'] = 'E Learning Mahasiswa';
	          $data['keywords'] = 'e learning, mhs, mahasiswa stmi, stmi';

	          $data['absensi']=$this->absensi_model->absen_mhs($this->nim_2);

	          //isi konten
	          $data['isicontent'] = 'absensi/_data_absen_mhs';
	          $this->load->view('mhs/_layout',$data);																				
			


        } 
	}
	
?>