<?php
class Hasil_kuesioner_kampus_model extends CI_Model {
	
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


	
	 public function thn_akademik_kuesioner()
    {
        $this->query = $this->db_2->query("select DISTINCT thn_akademik, periode from el_kuesioner_kampus_nilai 
				GROUP BY id_kuesioner_kampus_master, thn_akademik, periode
				ORDER BY id_kuesioner_kampus_nilai ASC");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }

	public function get_kues_kampus($n='')
    {
        $n=explode('_',$n);
		$thn_akademik=$n[0];
		$periode=$n[1];
		
		$this->query = $this->db_2->query("select b.id_kuesioner_kampus_master as tipe_number,
(SELECT master FROM el_kuesioner_kampus_master WHERE id_kuesioner_kampus_master=a.id_kuesioner_kampus_master) as tipe_kues_kampus,
a.thn_akademik, a.periode,
 sum(a.nilai_kuesioner) as nilai_kues, sum(a.jumlah_mhs_input) as jumlah_mhs_input, ROUND( sum(a.nilai_kuesioner) / sum(a.jumlah_mhs_input) ,2 ) as total_nilai_kuesioner, a.jumlah_mhs_input as sigma
from el_kuesioner_kampus_nilai a
left join el_kuesioner_kampus_master b ON a.id_kuesioner_kampus_master= b.id_kuesioner_kampus_master

WHERE a.thn_akademik=$thn_akademik
AND a.periode=$periode
			
GROUP BY a.id_kuesioner_kampus_master
ORDER BY total_nilai_kuesioner DESC");



        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }
	
	
	 public function get_nilai_hasil_kues($id_jadual, $thn_akademik, $periode )
    {



$this->query = $this->db_2->query("
select 
b.master as tipe_kues_kampus,
a.thn_akademik, a.periode, a.nilai_kuesioner, a.id_pertanyaan, a.jumlah_mhs_input AS sigma
from el_kuesioner_kampus_nilai a
left join el_kuesioner_kampus_master b ON a.id_kuesioner_kampus_master= b.id_kuesioner_kampus_master

WHERE a.thn_akademik=$thn_akademik
AND a.periode=$periode
AND a.id_kuesioner_kampus_master=$id_jadual
			
ORDER BY a.id_pertanyaan ASC");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }
	
	
	public function get_ket_hasil_kues($id_jadual='')
    {
        $this->query = $this->db_2->query("select 
a.id_jadual, b.thn_akademik, b.periode, c.kd_mtk, c.nama as nama_matkul,  d.nama as nama_dosen, d.gelar as gelar_dosen, sum(a.nilai_kuesioner) as nilai_kues, sum(a.jumlah_mhs_input) as jumlah_mhs_input, ROUND( sum(a.nilai_kuesioner) / sum(a.jumlah_mhs_input) ,2 ) as total_nilai_kuesioner, a.jumlah_mhs_input as sigma, e.uraian as jurusan, c.sks
from el_kuesioner_nilai a
left join jadual b ON a.id_jadual= b.id_jadual
left join mtk c  ON b.id_mtk= c.id_mtk
left join dosen d  ON b.id_dosen=d.id_dosen
left join mst_konsentrasi e  ON e.kd_konsentrasi=c.kd_konsentrasi

WHERE a.id_jadual=$id_jadual
			
GROUP BY a.id_jadual
ORDER BY total_nilai_kuesioner DESC LIMIT 1");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }
	
	
	
	public function get_optional_hasil_kues($id_jadual='')
    {
		$this->query = $this->db_2->query("select * from el_kuesioner_nilai_optional
		WHERE id_jadual=$id_jadual");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }

/*--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------*/
   
  
}
?>