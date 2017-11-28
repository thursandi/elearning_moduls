<?php
class Nilai_belum_input_model extends CI_Model {
    
    function __construct(){
        parent::__construct();
        $this->db_2 = $this->load->database('otherdb', TRUE); 
        
    }

    public $query;
    public $sql;
    private $db_2;
    //LIMIT 5 OFFSET 0
    //$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?"; -- adalah query binding anti sql injection
    //$this->db->query($sql, array(3, 'live', 'Rick'));

    public function get_daftar_nilai()
    {
	/*
        $this->query = $this->db_2->query("SELECT DISTINCT A.*, B.kelas from 
		
		(SELECT DISTINCT A.*, B.nama AS nama_dosen FROM 
                                    (SELECT DISTINCT A.*, IFNULL(B.id_status, 33) as id_status FROM (SELECT DISTINCT A.id_jadual, B.nama, B.thn_akademik, B.periode, A.id_dosen FROM jadual A
                                    INNER JOIN mtk_next B
                                    ON A.id_mtk=B.id_mtk
                                    WHERE A.thn_akademik=(SELECT thn_akademik FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
                                    AND A.periode= (SELECT periode FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
                                    AND A.thn_akademik=B.thn_akademik) A
                                    LEFT JOIN el_kunci_nilai B
                                    ON A.id_jadual=B.id_jadual
                                    WHERE  IFNULL(B.id_status, 0) =0
                                    ) A
                                    INNER JOIN dosen B
                                    ON A.id_dosen=B.id_dosen
                                    WHERE B.nama != '*'
                                    AND B.nama !='**'
									
                                    ORDER BY B.nama ASC, A.id_status DESC) A, krs B
where A.id_jadual=B.id_jadual
GROUP BY A.id_jadual
  ORDER BY A.nama_dosen ASC, A.id_status DESC");
  */
  
		$this->query = $this->db_2->query("SELECT DISTINCT A.*, B.nama as kelas from 
		
		(SELECT DISTINCT A.*, B.nama AS nama_dosen FROM 
									(SELECT DISTINCT A.*, IFNULL(B.id_status, 33) as id_status FROM (SELECT DISTINCT A.id_jadual, B.nama, B.thn_akademik, B.periode, A.id_dosen, A.id_kelas FROM jadual A
                                    INNER JOIN mtk_next B
                                    ON A.id_mtk=B.id_mtk
                                    WHERE A.thn_akademik=(SELECT thn_akademik FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
                                    AND A.periode= (SELECT periode FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
                                    AND A.thn_akademik=B.thn_akademik) A
                                    LEFT JOIN el_kunci_nilai B
                                    ON A.id_jadual=B.id_jadual
                                    WHERE  IFNULL(B.id_status, 0) =0
                                    ) A
                                    INNER JOIN dosen B
                                    ON A.id_dosen=B.id_dosen
                                    WHERE B.nama != '*'
                                    AND B.nama !='**'
									AND B.nama !='***'
									AND B.nama !='****'
                                    ORDER BY B.nama ASC, A.id_status DESC) A
INNER JOIN kelas B
ON A.id_kelas=B.id_kelas
  ORDER BY A.nama_dosen ASC, A.id_status DESC");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }

  
}
?>