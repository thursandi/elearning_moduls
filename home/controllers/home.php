<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HMVC Codeigniter
 *
 * @package    	home <controller>
 * @copyright  	Copyright (c) 2013, Kasino
 * @author     	Kasino <ezz_chocolate@yahoo.com>
 */

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('pagination');

		$this->load->library('menu_otomatis');
		$this->load->library('data_pendukung');
	}

	public function index()
	{
			//inisiasi awal data website dari libraries
			$data=$this->data_pendukung->artikel_pendukung_web();
			//inisiasi awal data website dari libraries

			//isi konten
			$data['title'] = 'E-Learning Politeknik STMI';
			$data['description'] = 'e-learning politeknik stmi, e-learning, politeknik stmi';
			$data['keywords'] = 'e-learning politeknik stmi, politeknik stmi, politeknik stmi jakarta, sekolah tinggi kejuruan, sekolah tinggi D4, D4, diploma 4';

			
			$data['isicontent'] = 'home/_home';
			$data['menu_header'] = $this->menu_otomatis->create_menu_biasa(0, 1, 'menu_home_elearning');
      $this->load->view('home/_layout',$data);
	}

	public function error404()
	{
      $this->load->view('home/_error404');
	}

}

/* End of file */
