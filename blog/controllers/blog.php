<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HMVC Codeigniter
 *
 * @package    	baca <controller>
 * @copyright  	Copyright (c) 2013, Kasino
 * @author     	Kasino <ezz_chocolate@yahoo.com>
 */

class Blog extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('pagination');
		$this->load->model('home/berita_model');
		$this->load->model('blog/blog_model');
		$this->load->library('menu_otomatis');
		$this->load->library('data_pendukung');
	}


	public function dosen($nama,$id='',$judul='')
	{
			//inisiasi awal data website dari libraries
			$data=$this->data_pendukung->artikel_pendukung_web();
			//inisiasi awal data website dari libraries
			
			
			$data['title'] = 'Artikel Blog Dosen STMI';
			$data['description'] = 'artikel dosen, stmi dosen, blog dosen';
			$data['keywords'] = 'artikel, blog, dosen stmi, artkel';
			$data['menu_header'] = $this->menu_otomatis->create_menu_biasa(0, 1, 'menu_home_elearning');

				
			if (!empty($id)) {
				if (!is_numeric(my_number_decrypt($id))) {
				redirect('home/error404');
				}
			}
			
			//nama dipecah
			$nama=ucwords(str_replace('-', ' ', $nama));
			$n=explode(' ',  $nama);
			
			//ubah URL ke nama
			if (empty($n[1])) {
				$z=$n[0];
			}else{
					if ( strlen($n[1])==1 ) {

						if ($n[0]=='Tb') {
								$z='TB. M. Zaffuad';
						}else{
								$z=$n[0];
						}
						
					}else{

							$z=$n[0].'%'.$n[1];
							if ($n[0]=='Esrom') {
										$z=$n[0];					
							}else{
								if($this->blog_model->cek_nama_dosen($z))
								{
									$z=$z;
								}else{
										$z=$n[1];
								}

							}
						
					
					}
			}
			//END ubah URL ke nama


			//biodata dosen
			$data['biodata']=$this->blog_model->get_biodata_dosen($z);
			if (empty($data['biodata'])) {
				redirect('home/error404');
			}

			if (is_numeric($nama) || empty($nama)) {
				redirect('home/error404');
			}

			if (empty($id) && empty($judul)) {
				
				$data['paging_artikel']=$this->blog_model->get_artikel_dosen_paging($z);
				
				$data['isicontent'] = 'blog/_paging_artikel';
				//isi konten
				$this->load->view('blog/_layout_rincian',$data);	
				

			}else{

					//$judul=explode('-', $url_judul);
					$id_artikel=my_number_decrypt($id);
					
					//cek artikel valid
					if($this->blog_model->cek_artikel_valid($id_artikel,$z))
					{
									
						//url dipecah
						
						$data['artikel']=$this->blog_model->rincian_artikel_dosen($id_artikel,$z);

						$this->blog_model->update_artikel_dosen($id_artikel);

						if (empty($data['artikel'])) {
								redirect('home/error404');
						}
						$data['isicontent'] = 'blog/_rincian_artikel';
						//isi konten
						$this->load->view('blog/_layout',$data);	

					}else{
										
							redirect('home/error404');

					}
					//end cek artikel valid

			}

			
					
	}


	public function daftar_blog_dosen()
	{		
			//inisiasi awal data website dari libraries
			$data=$this->data_pendukung->artikel_pendukung_web();
			//inisiasi awal data website dari libraries
			
			$data['daftar_blog']=$this->blog_model->get_blog_dosen();
			$data['isicontent'] = 'blog/_daftar_blog_dosen';
			$data['title'] = 'Artikel Blog Dosen STMI';
			$data['description'] = 'artikel dosen, stmi dosen, blog dosen';
			$data['keywords'] = 'artikel, blog, dosen stmi, artkel';
			$data['menu_header'] = $this->menu_otomatis->create_menu_biasa(0, 1, 'menu_home_elearning');
			//isi konten
			$this->load->view('blog/_layout_daftar',$data);	

	}


	public function pengumuman($id, $judul)
	{
			//inisiasi awal data website dari libraries
			$data=$this->data_pendukung->artikel_pendukung_web();
			//inisiasi awal data website dari libraries
			//
			
			if (!is_numeric($id) || $id==NULL) {
				redirect('home/error404');
			}


						$data['pengumuman']=$this->berita_model->get_rincian_pengumuman($id);

						if(empty($data['pengumuman'])){ redirect('home/error404');}

						$this->berita_model->update_artikel_dosen($id);
						$data['title'] = 'Pengumuman E-Learning STMI';
						$data['description'] = 'pengumuman, artikel dosen, stmi dosen, blog dosen';
						$data['keywords'] = 'pengumuman, rtikel, blog, dosen stmi, artkel';

						$data['isicontent'] = 'blog/_rincian_pengumuman';
						
			      

			$data['menu_header'] = $this->menu_otomatis->create_menu_biasa(0, 1, 'menu_home_elearning');
			//isi konten
			$this->load->view('home/_layout',$data);
	}

}

/* End of file */
