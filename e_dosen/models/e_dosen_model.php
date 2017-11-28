<?php
class E_dosen_model extends CI_Model {
	
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

    public function get_all_artikel()
    {
        $this->query = $this->db->query("SELECT * FROM berita_kampus");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }

    public function get_biodata_dosen($id='')
    {
        $this->query = $this->db->query("SELECT nama_asli,gelar,email,tgl_lahir,alamat,no_hp,foto FROM users_e_dosen WHERE id=$id LIMIT 1");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }


    public function get_jadwal_mengajar_dosen($nama='')
    {
        $nama2 = str_replace("'","''", $nama);
        $this->query = $this->db_2->query("SELECT A.id_mtk, A.id_jadual, B.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, D.uraian as hari, D.id_hari, A.jam_mulai, A.jam_selesai, C.kelas, E.nama as ruangan
            FROM jadual A, mtk B, krs C, mst_hari D, ruangan E
            WHERE A.id_mtk=B.id_mtk
            AND A.id_jadual=C.id_jadual
            AND A.id_hari=D.id_hari
            AND A.id_ruangan=E.id_ruangan
            AND A.id_dosen=(select id_dosen from dosen where nama like '$nama2%' LIMIT 1)
            AND A.thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1)
            AND A.periode=(select periode from jadual where thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1) group by periode ORDER BY periode DESC LIMIT 1)
            GROUP BY id_jadual
            ORDER BY id_hari, jam_mulai ASC");
		
		/*
		$this->query = $this->db_2->query("SELECT A.id_mtk, A.id_jadual, B.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, D.uraian as hari, D.id_hari, A.jam_mulai, A.jam_selesai, C.kelas, E.nama as ruangan
            FROM jadual A, mtk B, krs C, mst_hari D, ruangan E
            WHERE A.id_mtk=B.id_mtk
            AND A.id_jadual=C.id_jadual
            AND A.id_hari=D.id_hari
            AND A.id_ruangan=E.id_ruangan
            AND A.id_dosen=(select id_dosen from dosen where nama like '$nama2%' LIMIT 1)
            AND A.thn_akademik=2016
            AND A.periode=2
            GROUP BY id_jadual
            ORDER BY id_hari, jam_mulai ASC");
		*/
        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }



/*--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------*/
    public function get_mata_kuliah_terakhir($nama='')
    {
		
	//normal
	
         $nama2 = str_replace("'","''", $nama);
		 /*
         $this->query = $this->db_2->query("SELECT A.id_mtk, A.id_jadual, B.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, C.kelas
            FROM jadual A, mtk B, krs C
            WHERE A.id_mtk=B.id_mtk
            AND A.id_jadual=C.id_jadual
            AND A.id_dosen=(select id_dosen from dosen where nama like '$nama2%' LIMIT 1)
            AND A.thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1)
            AND A.periode=(select periode from jadual where thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1) group by periode ORDER BY periode DESC LIMIT 1)
            GROUP BY id_jadual");
     */
    
	
	//test normal
	
	/*		$this->query = $this->db_2->query("SELECT A.id_mtk, A.id_jadual, A.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, A.kelas, el_kunci_nilai.id_status as status
            FROM (
                    SELECT A.id_mtk, A.id_jadual, B.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, C.kelas
                    FROM jadual A, mtk B, krs C
                    WHERE A.id_mtk=B.id_mtk
                    AND A.id_jadual=C.id_jadual
                    AND A.id_dosen=(select id_dosen from dosen where nama like '$nama2%' LIMIT 1)
                    AND A.thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1)
                    AND A.periode=(select periode from jadual where thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1) group by periode ORDER BY periode DESC LIMIT 1)
                    GROUP BY id_jadual ) as A
	
            LEFT JOIN  el_kunci_nilai
            ON A.id_jadual= el_kunci_nilai.id_jadual");
	*/	
	//semester tertentu
	
         $this->query = $this->db_2->query("SELECT A.id_mtk, A.id_jadual, A.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, A.kelas, el_kunci_nilai.id_status as status
            FROM (
				SELECT A.id_mtk, A.id_jadual, B.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, C.kelas
				FROM jadual A, mtk B, krs C
				WHERE A.id_mtk=B.id_mtk
				AND A.id_jadual=C.id_jadual
				AND A.id_dosen=(select id_dosen from dosen where nama like '$nama2%' LIMIT 1)
				AND A.thn_akademik=2016
				AND A.periode= 2
				GROUP BY id_jadual ) as A

            LEFT JOIN  el_kunci_nilai
            ON A.id_jadual= el_kunci_nilai.id_jadual");
        

	//sem ganjil ke sem genap
	/*
      		$this->query = $this->db_2->query("SELECT A.id_mtk, A.id_jadual, A.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, A.kelas, el_kunci_nilai.id_status as status
            FROM (
                    SELECT A.id_mtk, A.id_jadual, B.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, C.kelas
                    FROM jadual A, mtk B, krs C
                    WHERE A.id_mtk=B.id_mtk
                    AND A.id_jadual=C.id_jadual
                    AND A.id_dosen=(select id_dosen from dosen where nama like '$nama%' LIMIT 1)
                    AND A.thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1)
                    AND A.periode=(select periode from jadual where thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1) group by periode ORDER BY periode DESC LIMIT 1)
                    GROUP BY id_jadual ) as A

            LEFT JOIN  el_kunci_nilai
            ON A.id_jadual= el_kunci_nilai.id_jadual
			
			UNION
			
			SELECT A.id_mtk, A.id_jadual, A.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, A.kelas, el_kunci_nilai.id_status as status
            FROM (
                    SELECT A.id_mtk, A.id_jadual, B.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, C.kelas
                    FROM jadual A, mtk B, krs C
                    WHERE A.id_mtk=B.id_mtk
                    AND A.id_jadual=C.id_jadual
                    AND A.id_dosen=(select id_dosen from dosen where nama like '$nama%' LIMIT 1)
                    AND A.thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1)
                    AND A.periode=(select periode from jadual where thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1) group by periode ORDER BY periode DESC LIMIT 1,1)
                    GROUP BY id_jadual ) as A

            LEFT JOIN  el_kunci_nilai
            ON A.id_jadual= el_kunci_nilai.id_jadual");
			
	*/	
	//sem genap ke sem ganjil
	/*
       $this->query = $this->db_2->query("SELECT A.id_mtk, A.id_jadual, A.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, A.kelas, el_kunci_nilai.id_status as status
            FROM (
                    SELECT A.id_mtk, A.id_jadual, B.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, C.kelas
                    FROM jadual A, mtk B, krs C
                    WHERE A.id_mtk=B.id_mtk
                    AND A.id_jadual=C.id_jadual
                    AND A.id_dosen=(select id_dosen from dosen where nama like '$nama%' LIMIT 1)
                    AND A.thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1)
                    AND A.periode=(select periode from jadual where thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1) group by periode ORDER BY periode DESC LIMIT 1)
                    GROUP BY id_jadual ) as A

            LEFT JOIN  el_kunci_nilai
            ON A.id_jadual= el_kunci_nilai.id_jadual
			
			UNION
			
			SELECT A.id_mtk, A.id_jadual, A.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, A.kelas, el_kunci_nilai.id_status as status
            FROM (
                    SELECT A.id_mtk, A.id_jadual, B.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, A.id_hari, A.jam_mulai, A.jam_selesai, C.kelas
                    FROM jadual A, mtk B, krs C
                    WHERE A.id_mtk=B.id_mtk
                    AND A.id_jadual=C.id_jadual
                    AND A.id_dosen=(select id_dosen from dosen where nama like '$nama%' LIMIT 1)
                    AND A.thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1,1)
                    AND A.periode=(select periode from jadual where thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1,1) group by periode ORDER BY periode DESC LIMIT 1)
                    GROUP BY id_jadual ) as A

            LEFT JOIN  el_kunci_nilai
            ON A.id_jadual= el_kunci_nilai.id_jadual");
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


    public function kunci_tabel_nilai($id_jadual,$nama)
    {
        $this->query = $this->db_2->query("SELECT * FROM el_kunci_nilai WHERE id_jadual=$id_jadual");

        if($this->query->num_rows >0){
                //jika ada update data
                $data = array(
                   'id_status' => 1,
                );

                $this->db_2->where('id_jadual', $id_jadual);
                $this->db_2->update('el_kunci_nilai', $data);
        }else{
            //jika tidak ada insert data
                $data = array(
                   'id_status' => 1,
                   'id_jadual' => $id_jadual,
                   'nama'=>$nama,
                );

                $data2 = array(
                   'id_jadual' => $id_jadual,
                );

                $this->db_2->insert('el_kunci_nilai', $data); 
                $this->db_2->insert('el_jumlah_cetak', $data2); 
            
        }    
    }
	
	public function daftar_username_dosen()
    {
        $this->query = $this->db->query("SELECT username, nama_asli, gelar, password, email FROM users_e_dosen ORDER BY nama_asli ASC");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }

    public function mtk_aktif($nama)
    {
        $id_dosen = $this->db_2->like('nama',$this->session->userdata('nama_asli'))
                               ->get('dosen')
                               ->row()
                               ->id_dosen;

        //query update mtk aktif jika waktu selesai < now
            $cek =  $this->db_2->get_where('absen_mtk',array('status'=> 0, 'id_dosen' => $id_dosen));
            
            if($cek->num_rows != 0){
                
                $wk_selesai = $cek->row()->waktu_selesai;
                //$waktu_aktif = $wk_selesai;
                $wk_input = $cek->row()->waktu_input;
                //date('Y-m-d H:i:s',strtotime('+225 minute',strtotime($waktu_input)));
                if($wk_selesai < date('Y-m-d H:i:s')){
                    //update 
                    $waktu_selesai = date('Y-m-d H:i:s',strtotime('+30 minute',strtotime($wk_input)));
                    $data = array('status'=>1,'waktu_selesai'=>$waktu_selesai);
                    $this->db_2->where(array('id_dosen'=>$id_dosen,'status'=>0));
                    $this->db_2->update('absen_mtk',$data);
                }

            }                 
        //----------------------                       

        $query = $this->db_2->get_where('absen_mtk',array('status'=> 0, 'id_dosen' => $id_dosen));

        return $query;
    }
  
}
?>