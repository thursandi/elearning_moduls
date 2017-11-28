<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HMVC Codeigniter
 *
 * @package    	baca <controller>
 * @copyright  	Copyright (c) 2013, Kasino
 * @author     	Kasino <ezz_chocolate@yahoo.com>
 */

class Baca extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('pagination');
		$this->load->model('home/berita_model');
		$this->load->library('menu_otomatis');
		$this->load->library('data_pendukung');
	}

	public function artikel($id, $judul)
	{
			//inisiasi awal data website dari libraries
			$data=$this->data_pendukung->artikel_pendukung_web();
			//inisiasi awal data website dari libraries
			//
			
			if (!is_numeric($id) || $id==NULL) {
				redirect('home/error404');
			}


						$data['artikel']=$this->berita_model->rincian_artikel_dosen($id);

						if(empty($data['artikel'])){ redirect('home/error404');}

						$this->berita_model->update_artikel_dosen($id);
						$data['title'] = 'Artikel Blog Dosen STMI';
						$data['description'] = 'artikel dosen, stmi dosen, blog dosen';
						$data['keywords'] = 'artikel, blog, dosen stmi, artkel';

						$data['isicontent'] = 'baca/_rincian_artikel';
						
			      

			$data['menu_header'] = $this->menu_otomatis->create_menu_biasa(0, 1, 'menu_home_elearning');
			//isi konten
			$this->load->view('home/_layout',$data);
	}


}

/* End of file */
