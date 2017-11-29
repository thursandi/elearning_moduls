<?php
class Berita_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
        
	}

    public $query;
    public $sql;
    public $view_data;


/*--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------*/

    //update view data artikel dosen
    public function update_artikel_dosen($id)
    {
        $this->query = $this->db->query("SELECT view FROM el_blog_dosen WHERE id_artikel=$id LIMIT 1");
        if($this->query->num_rows >0)
        {
            foreach ($this->query->result_array() as $row)
            {
                $this->view_data= $row['view'];

            }
        }else{
            return NULL;
        }
        //update view
       

        $this->db->query("UPDATE el_blog_dosen SET view = $this->view_data +1 WHERE id_artikel=$id");

    }

    //artikel pengumuman
    function get_pengumuman()
    {
        $this->query = $this->db->query("SELECT * FROM el_pengumuman ORDER BY tanggal_input DESC LIMIT 6");
        
        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }


    function get_rincian_pengumuman($id)
    {
        $this->query = $this->db->query("SELECT * FROM el_pengumuman WHERE id_pengumuman=$id ORDER BY tanggal_input DESC LIMIT 1");
        
        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }


/*--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------*/

//berita terpopuler dan terbaru

    function get_artikel_dosen_terbaru()
    {
        $this->query = $this->db->query("SELECT users_e_dosen.nama_asli, users_e_dosen.gelar, el_blog_dosen.judul_artikel, el_blog_dosen.isi_artikel, el_blog_dosen.tanggal_input, el_blog_dosen.view, el_blog_dosen.id_artikel FROM users_e_dosen,el_blog_dosen   
            WHERE el_blog_dosen.penulis=users_e_dosen.id
                ORDER BY tanggal_input desc limit 20");
        
        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }


    //rincian artikel dosen
    function rincian_artikel_dosen($id)
    {
        $this->query = $this->db->query("SELECT users_e_dosen.nama_asli, users_e_dosen.gelar, el_blog_dosen.judul_artikel, el_blog_dosen.isi_artikel, el_blog_dosen.tanggal_input, el_blog_dosen.view, el_blog_dosen.link_gambar FROM users_e_dosen,el_blog_dosen   
            WHERE el_blog_dosen.penulis=users_e_dosen.id
            AND el_blog_dosen.id_artikel=$id
                ORDER BY tanggal_input desc limit 1");
        
        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }


    function get_terpopuler()
    {
        $this->query = $this->db->query("SELECT * FROM berita_kampus, kategori_thumbnail_berita 
                WHERE kategori_thumbnail_berita.id_kategori_thumbnail_berita=berita_kampus.id_thumbnail_berita  
                UNION
                SELECT * FROM berita_ukm, kategori_thumbnail_berita 
                WHERE kategori_thumbnail_berita.id_kategori_thumbnail_berita=berita_ukm.id_thumbnail_berita    
                ORDER BY view desc limit 3");
        
        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }     
    }

    //newsticker
    function get_newsticker()
    {
        $this->query = $this->db->query("SELECT * FROM berita_kampus, kategori_thumbnail_berita 
                WHERE kategori_thumbnail_berita.id_kategori_thumbnail_berita=berita_kampus.id_thumbnail_berita  
                UNION
                SELECT * FROM berita_ukm, kategori_thumbnail_berita 
                WHERE kategori_thumbnail_berita.id_kategori_thumbnail_berita=berita_ukm.id_thumbnail_berita   
                ORDER BY tanggal desc limit 10");
        
        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }


  
}
?>