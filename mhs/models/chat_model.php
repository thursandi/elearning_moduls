<?php
class Chat_model extends CI_Model {
    
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->db_2 = $this->load->database('otherdb', TRUE);
        
    }

    public $query;
    public $sql;
    private $db_2;


/*--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------*/
    public function insert_chat($isi,$nim)
    {
        $data = array(
           'isi_chat' => $isi ,
           'nim' => $nim
        );

        $this->db_2->insert('el_tabel_chat', $data); 

    }

    public function get_chat($jurusan)
    {
        $this->query = $this->db_2->query("SELECT DISTINCT A.*, B.uraian_panjang FROM (SELECT DISTINCT A.*, B.nama, B.kd_jurusan FROM el_tabel_chat A
                LEFT JOIN mhs B
                ON A.nim=B.nim
                WHERE B.kd_jurusan=(SELECT kd_jurusan FROM mst_jurusan WHERE uraian_panjang like '%$jurusan%' LIMIT 1)
                ORDER BY A.waktu_chat DESC LIMIT 30) as A
                LEFT JOIN mst_jurusan B
                ON A.kd_jurusan=B.kd_jurusan
                ORDER BY A.waktu_chat ASC LIMIT 30");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        } 
    }
  
}

?>