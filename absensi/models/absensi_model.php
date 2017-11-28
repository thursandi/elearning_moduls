<?php
class Absensi_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
        $this->db_2 = $this->load->database('otherdb', TRUE); 
		
	}

    public $query;
    public $sql;
    private $db_2;


    public function get_rps()
    {
        $this->query = $this->db_2->query("SELECT * FROM rps, rps_detil WHERE rps.id_rps = rps_detil.id_rps");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }

     public function get_rps_realisasi_edit($id_absen)
    {
        $this->query = $this->db_2->query("SELECT * FROM absen_mtk where id_absen = '".$id_absen."'");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }

    public function get_rps_realisasi($id_jadual)
    {
        $this->query = $this->db_2->query("SELECT * FROM absen_mtk where id_jadual = '".$id_jadual."'  ORDER by id_absen asc ");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }    
    }

    function get_mahasiswa($id_jadual){
        //return $this->db->get('mhs');
         $this->query = $this->db_2->query("SELECT A.nama, B.nim, B.tugas, B.uts, B.uas, B.nilai FROM mhs A, krs B WHERE A.nim=B.nim AND B.id_jadual= '".$id_jadual."' ORDER BY B.nim ASC");
        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }
    }  
    
    //melihat jadula untuk akademik
    function get_jadual_mtk(){
        //return $this->db->get('mhs');
        /*$this->query = $this->db_2->query("SELECT A.id_mtk, A.id_jadual, B.nama, A.bobot_tugas, A.bobot_uts, A.bobot_uas, A.periode, A.thn_akademik, D.uraian as hari, D.id_hari, A.jam_mulai, A.jam_selesai, C.kelas, E.nama as ruangan FROM jadual A, mtk B, krs C, mst_hari D, ruangan E WHERE A.id_mtk=B.id_mtk AND A.id_jadual=C.id_jadual AND A.id_hari=D.id_hari AND A.id_ruangan=E.id_ruangan
         AND A.id_dosen=(select id_dosen from dosen where nama like 'Ulil Hamida' LIMIT 1) AND A.thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1) AND A.periode=(select periode from jadual where thn_akademik=(select thn_akademik from jadual group by thn_akademik order by thn_akademik desc LIMIT 1) group by periode ORDER BY periode DESC LIMIT 1) GROUP BY id_jadual ORDER BY id_hari, jam_mulai ASC");*/
         $this->query = $this->db_2->query("SELECT 
                                                absen_mtk.id_jadual,
                                                absen_mtk.id_dosen,
                                                jadual.periode,
                                                krs.thn_akademik,
                                                mtk.nama as nm_mtk,
                                                mtk.id_mtk,
                                                jadual.jam_mulai,
                                                jadual.jam_selesai,
                                                jadual.periode,
                                                kelas.nama as kelas,
                                                dosen.nama as nm_dosen,
                                                mst_hari.uraian as hari
                                            FROM `absen_mtk`,jadual,mtk,krs,kelas,dosen,mst_hari
                                            WHERE
                                              absen_mtk.id_jadual = jadual.id_jadual AND
                                              absen_mtk.id_jadual = krs.id_jadual AND
                                              krs.id_mtk = mtk.id_mtk AND
                                              jadual.id_kelas = kelas.id_kelas AND
                                              absen_mtk.id_dosen = dosen.id_dosen AND
                                              mst_hari.id_hari = jadual.id_hari
                                            GROUP BY absen_mtk.id_jadual
                                            ORDER BY absen_mtk.id_jadual DESC");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }
    }  
    
    //edit absen mahasiswa
    function edit_mahasiswa($id_absen){
        //return $this->db->get('mhs');
        //$this->query = $this->db_2->query("SELECT * FROM absen_mtk_detail_mhs, mhs WHERE absen_mtk_detail_mhs.nim = mhs.nim AND absen_mtk_detail_mhs.id_absen = '".$id_absen."' ORDER BY absen_mtk_detail_mhs.nim ASC");
        
        $query = $this->db_2->select('*')
                            ->from('absen_mtk_detail_mhs')
                            ->join('mhs','mhs.nim = absen_mtk_detail_mhs.nim')
                            ->where('id_absen',$id_absen)
                            ->get();

        if($query->num_rows >0){
            return $query;   
        }else{
            return NULL;
        }

    }  
//  SELECT * FROM absen_mtk, jadual, mtk WHERE absen_mtk.id_jadual = jadual.id_jadual AND jadual.id_mtk = mtk.id_mtk AND absen_mtk.id_jadual = '34232' 

    //edit absen mahasiswa
    function absensi_detail($id_jadual){
    //return $this->db->get('mhs');
    //$this->query = $this->db_2->query("SELECT * FROM absen_mtk_detail_mhs, mhs WHERE absen_mtk_detail_mhs.nim = mhs.nim AND absen_mtk_detail_mhs.id_absen = '".$id_absen."' ORDER BY absen_mtk_detail_mhs.nim ASC");
         $this->query = $this->db_2->query("SELECT * FROM absen_mtk, jadual, mtk WHERE absen_mtk.id_jadual = jadual.id_jadual AND jadual.id_mtk = mtk.id_mtk AND absen_mtk.id_jadual = '".$id_jadual."' and absen_mtk.status != 0  ORDER BY absen_mtk.id_absen ASC");
        if($this->query->num_rows >0){
            return $this->query;   
            }else{
            return NULL;
        }

    }  

     function tampil_absen_mhs(){
    //return $this->db->get('mhs');
    //$this->query = $this->db_2->query("SELECT * FROM absen_mtk_detail_mhs, mhs WHERE absen_mtk_detail_mhs.nim = mhs.nim AND absen_mtk_detail_mhs.id_absen = '".$id_absen."' ORDER BY absen_mtk_detail_mhs.nim ASC");
         $this->query = $this->db_2->query("SELECT k.id_krs,m.kd_mtk,m.nama as nama_mtk,m.sks,kls.nama as 
nama_kelas,j.id_hari, time_format(j.jam_selesai,'%H:%i') AS jamselesai, m.praktikum, 
r.nama as nama_ruang from krs k,jadual j, mtk m,kelas kls, ruangan r WHERE k.id_jadual = 
j.id_jadual and j.id_mtk = m.id_mtk and kls.id_kelas = j.id_kelas and nim = '1715114' and 
k.thn_akademik = '2017' and k.periode = '1' and k.status = 1 and j.id_ruangan = r.id_ruangan order by id_krs
");
        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        }

    }

    function absen_mhs($nim)
    {
        $query = $this->db_2->query("SELECT absen_mtk.id_jadual,COUNT(absen_mtk_detail_mhs.nim) as jml, 
                                      COUNT(CASE WHEN absen_mtk_detail_mhs.status_absen = 1 THEN absen_mtk_detail_mhs.status_absen else null end) as jml_masuk,
                                          COUNT(CASE WHEN absen_mtk_detail_mhs.status_absen = 2 THEN absen_mtk_detail_mhs.status_absen else null end) as jml_sakit,
                                          COUNT(CASE WHEN absen_mtk_detail_mhs.status_absen = 3 THEN absen_mtk_detail_mhs.status_absen else null end) as jml_izin,
                                          COUNT(CASE WHEN absen_mtk_detail_mhs.status_absen = 4 THEN absen_mtk_detail_mhs.status_absen else null end) as jml_terlambat,
                                          COUNT(CASE WHEN absen_mtk_detail_mhs.status_absen = 5 THEN absen_mtk_detail_mhs.status_absen else null end) as jml_alfa,
                                          mtk.nama as nm_matkul, 
                                          jadual.periode, 
                                          mtk.id_mtk, 
                                          krs.semester, 
                                          krs.thn_akademik

                                     FROM `absen_mtk`, absen_mtk_detail_mhs,jadual, mtk, krs
                                     
                                     where absen_mtk.id_absen IN
                                    (SELECT absen_mtk_detail_mhs.id_absen FROM absen_mtk_detail_mhs WHERE
                                     absen_mtk_detail_mhs.nim = '$nim')
                                     AND
                                     absen_mtk.id_absen = absen_mtk_detail_mhs.id_absen
                                     AND
                                     absen_mtk_detail_mhs.nim = '$nim'
                                     AND
                                     jadual.id_jadual = absen_mtk.id_jadual
                                     AND
                                     jadual.id_mtk = mtk.id_mtk
                                     AND
                                     krs.id_jadual = absen_mtk.id_jadual
                                     AND
                                     krs.nim = '$nim'
                                     GROUP BY absen_mtk.id_jadual
                                     ORDER BY absen_mtk.id_jadual DESC");

        if($query->num_rows >0){
            return $query;   
        }else{
            return NULL;
        }
    }

}
    ?>