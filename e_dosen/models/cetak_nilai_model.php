<?php
class Cetak_nilai_model extends CI_Model {
	
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

    public function get_biodata_dosen($jadual='')
    {
        $this->query = $this->db_2->query("SELECT nama, gelar FROM dosen WHERE
         id_dosen=(SELECT id_dosen  FROM jadual WHERE id_jadual=$jadual limit 1)");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }


/*--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------*/
    public function get_mata_kuliah_terkunci()
    {
        

//melihat nilai terkunci semester sebelumnya genap
       $this->query = $this->db_2->query("SELECT A.id_mtk, A.id_jadual, A.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, A.kelas, el_kunci_nilai.id_status as status, A.nama_dosen, A.gelar_dosen, A.jumlah_cetak, el_kunci_nilai.waktu_input
            FROM (
                    SELECT A.id_mtk, A.id_jadual, B.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, C.kelas, D.nama AS nama_dosen, D.gelar as gelar_dosen, E.jumlah_cetak as jumlah_cetak
                    FROM jadual A, mtk B, krs C, dosen D, el_jumlah_cetak E
                    WHERE A.id_mtk=B.id_mtk
                    AND A.id_jadual=C.id_jadual
                    AND A.id_dosen=D.id_dosen
                    AND A.id_jadual=E.id_jadual
                    AND A.thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1,1)
                    AND A.periode=(select periode from jadual where thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1,1) group by periode ORDER BY periode DESC LIMIT 1)
                    GROUP BY id_jadual ) as A

                LEFT JOIN  el_kunci_nilai
                ON A.id_jadual= el_kunci_nilai.id_jadual 
            WHERE id_status=1 ORDER BY waktu_input DESC, id DESC");


//melihat nilai terkunci semester sebelumnya ganjil
/*        $this->query = $this->db_2->query("SELECT A.id_mtk, A.id_jadual, A.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, A.kelas, el_kunci_nilai.id_status as status, A.nama_dosen, A.gelar_dosen, A.jumlah_cetak, el_kunci_nilai.waktu_input
            FROM (
                    SELECT A.id_mtk, A.id_jadual, B.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, C.kelas, D.nama AS nama_dosen, D.gelar as gelar_dosen, E.jumlah_cetak as jumlah_cetak
                    FROM jadual A, mtk B, krs C, dosen D, el_jumlah_cetak E
                    WHERE A.id_mtk=B.id_mtk
                    AND A.id_jadual=C.id_jadual
                    AND A.id_dosen=D.id_dosen
                    AND A.id_jadual=E.id_jadual
                    AND A.thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1)
                    AND A.periode=(select periode from jadual where thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1) group by periode ORDER BY periode DESC LIMIT 1,1)
                    GROUP BY id_jadual ) as A

                LEFT JOIN  el_kunci_nilai
                ON A.id_jadual= el_kunci_nilai.id_jadual 
            WHERE id_status=1 ORDER BY waktu_input DESC, id DESC");
*/

//melihat nilai terkunci semester saat ini
/*
       $this->query = $this->db_2->query("SELECT A.id_mtk, A.id_jadual, A.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, A.kelas, el_kunci_nilai.id_status as status, A.nama_dosen, A.gelar_dosen, A.jumlah_cetak, el_kunci_nilai.waktu_input
            FROM (
                    SELECT A.id_mtk, A.id_jadual, B.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, C.kelas, D.nama AS nama_dosen, D.gelar as gelar_dosen, E.jumlah_cetak as jumlah_cetak
                    FROM jadual A, mtk B, krs C, dosen D, el_jumlah_cetak E
                    WHERE A.id_mtk=B.id_mtk
                    AND A.id_jadual=C.id_jadual
                    AND A.id_dosen=D.id_dosen
                    AND A.id_jadual=E.id_jadual
                    AND A.thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1)
                    AND A.periode=(select periode from jadual where thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1) group by periode ORDER BY periode DESC LIMIT 1)
                    GROUP BY id_jadual ) as A

                LEFT JOIN  el_kunci_nilai
                ON A.id_jadual= el_kunci_nilai.id_jadual 
            WHERE id_status=1 ORDER BY waktu_input DESC, id DESC");

*/
        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }

    public function get_nama_mata_kuliah($id_jadual='')
    {
        $this->query = $this->db_2->query("SELECT B.kd_mtk, B.nama, C.kelas
            FROM jadual A, mtk B, krs C
            WHERE A.id_mtk=B.id_mtk
            AND C.id_jadual=A.id_jadual
            AND A.id_jadual=$id_jadual LIMIT 1");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }

    public function get_cek_bobot($id_jadual='')
    {
        $this->query = $this->db_2->query("SELECT bobot_tugas, bobot_uts, bobot_uas
            FROM jadual
            WHERE id_jadual=$id_jadual LIMIT 1");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }


    public function daftar_mhs($id_jadual='')
    {
        $this->query = $this->db_2->query("SELECT A.nama, B.nim, B.tugas, B.uts, B.uas, B.nilai
            FROM mhs A, krs B
            WHERE A.nim=B.nim
            AND B.id_jadual=$id_jadual
            ORDER BY B.nim ASC");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }


	
	//update cetak nilai
    public function update_cetak_nilai($id='')
    {
        $this->query = $this->db_2->query("SELECT * FROM el_jumlah_cetak WHERE id_jadual=$id LIMIT 1");
        if($this->query->num_rows >0)
        {
            foreach ($this->query->result_array() as $row)
            {
                $y= $row['jumlah_cetak'];
				//$waktu=$row['waktu_input'];

            }
        }else{
            return NULL;
        }
        //update view
       

        $this->db_2->query("UPDATE el_jumlah_cetak SET jumlah_cetak = $y +1  WHERE id_jadual=$id");

    }
  
}
?>