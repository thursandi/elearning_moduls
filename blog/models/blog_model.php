<?php
class Blog_model extends CI_Model {
	
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


/*--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------*/

    function cek_nama_dosen($nama)
    {
        $this->query = $this->db->query("SELECT id FROM users_e_dosen WHERE nama_asli like '%$nama%'");
        
        if($this->query->num_rows >0){
            return TRUE;   
        }else{
            return FALSE;
        }    
    }

    function cek_artikel_valid($id,$nama)
    {
        $this->query = $this->db->query("SELECT *
            FROM users_e_dosen,el_blog_dosen   
            WHERE el_blog_dosen.penulis=users_e_dosen.id 
            AND el_blog_dosen.penulis=(SELECT id FROM users_e_dosen WHERE nama_asli like '%$nama%' LIMIT 1)
            AND el_blog_dosen.id_artikel=$id
                ORDER BY tanggal_input DESC");
        
        if($this->query->num_rows >0){
            return TRUE;   
        }else{
            return FALSE;
        }    
    }

    function get_artikel_dosen_paging($nama)
    {
        $this->query = $this->db->query("SELECT users_e_dosen.nama_asli, users_e_dosen.gelar, el_blog_dosen.judul_artikel, el_blog_dosen.isi_artikel, el_blog_dosen.tanggal_input, el_blog_dosen.view, el_blog_dosen.id_artikel
            FROM users_e_dosen,el_blog_dosen   
            WHERE el_blog_dosen.penulis=users_e_dosen.id 
            AND el_blog_dosen.penulis=(SELECT id FROM users_e_dosen WHERE nama_asli like '%$nama%' LIMIT 1)
                ORDER BY tanggal_input DESC");
        
        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }


    //rincian artikel dosen
    function rincian_artikel_dosen($id,$nama)
    {
        $this->query = $this->db->query("SELECT users_e_dosen.nama_asli, users_e_dosen.gelar, el_blog_dosen.judul_artikel, el_blog_dosen.isi_artikel, el_blog_dosen.tanggal_input, el_blog_dosen.view, el_blog_dosen.link_gambar FROM users_e_dosen,el_blog_dosen   
            WHERE el_blog_dosen.penulis=users_e_dosen.id
            AND el_blog_dosen.id_artikel=$id
            AND el_blog_dosen.penulis=(SELECT id FROM users_e_dosen WHERE nama_asli like '%$nama%' LIMIT 1)
                ORDER BY tanggal_input desc limit 1");
        
        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }


    function get_biodata_dosen($nama)
    {
        $this->query = $this->db->query("SELECT nama_asli, gelar, email, tgl_lahir, alamat, no_hp, foto 
            FROM users_e_dosen
            WHERE nama_asli like '%$nama%'
            LIMIT 1");
        
        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }


    function get_blog_dosen()
    {
        $this->query = $this->db->query("SELECT nama_asli, gelar
            FROM users_e_dosen
            WHERE nama_asli != '' AND nama_asli != 'kubri06' AND nama_asli != 'iqbal' AND nama_asli != 'Web Master' AND username != 'admin_stmi' AND username != 'staff_print' AND username != 'staff'
            ORDER BY nama_asli ASC");
        
        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }



  
}
?>