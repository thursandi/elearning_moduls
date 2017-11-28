<?php
class Mhs_model extends CI_Model {
    
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->db_2 = $this->load->database('otherdb', TRUE);
        
    }

    public $query;
    public $sql;
    private $db_2;
	


    public function cek_kuesioner_kampus($nim)
    {
        $this->query = $this->db_2->query("SELECT * FROM el_kuesioner_kampus_mhs
            WHERE nim=$nim 
            AND thn_akademik=(SELECT thn_akademik FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
            AND periode=(SELECT periode FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
            ORDER BY id_kuesioner_kampus_master DESC");
        $row = $this->query->row();

        if($this->query->num_rows >0)
        {
           return $row->id_kuesioner_kampus_master;   
        }else{
            return 0;
        }

    }


	public function cek_status_kuesioner()
    {
		$this->query = $this->db_2->query("SELECT status_kuesioner FROM el_kuesioner_status LIMIT 1");
		$row = $this->query->row();
		//echo $row->name;
        if($this->query->num_rows >0){
            return $row->status_kuesioner;   
        }else{
            return NULL;
        } 
    }
	
    public function cek_kuesioner_matkul($nim)
    {
        $this->query = $this->db_2->query("SELECT DISTINCT * FROM el_kuesioner_mhs A, (SELECT DISTINCT A.nim, B.id_jadual, B.thn_akademik, B.periode 
                    FROM krs A, jadual B
                    WHERE A.id_jadual=B.id_jadual
                    AND A.nim=$nim
                    AND B.thn_akademik=(SELECT thn_akademik FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
                    AND B.periode=(SELECT periode FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)) B
                    WHERE A.nim=B.nim
                    AND A.id_jadual=B.id_jadual
                    GROUP BY A.id_jadual");
					
					

        if($this->query->num_rows >0)
        {
           return $this->query->num_rows;   
        }else{
            return 0;
        }

    }

    public function pertanyaan()
    {
        $this->query = $this->db_2->query("SELECT DISTINCT * FROM el_kuesioner_pertanyaan A, el_kuesioner_master B
            WHERE A.parent_pertanyaan=B.id
             ORDER BY A.id ASC");

        if($this->query->num_rows >0)
        {
            return $this->query;   
        }else{
            return FALSE;
        }

    }


    public function pertanyaan_kampus()
    {
        $this->query = $this->db_2->query("SELECT DISTINCT * FROM el_kuesioner_kampus_master_pertanyaan
             ORDER BY id ASC");

        if($this->query->num_rows >0)
        {
            return $this->query;   
        }else{
            return FALSE;
        }

    }

    public function kues($nim)
    {
        /*
        $this->query = $this->db_2->query("SELECT DISTINCT A.id_mtk, A.id_jadual, B.nama as mata_kuliah, A.periode, A.thn_akademik, C.nama, C.gelar, B.semester, B.sks
            FROM jadual A, mtk_next B, dosen C
            WHERE A.id_mtk=B.id_mtk
            AND A.id_jadual=(SELECT B.id_jadual FROM el_kuesioner_nilai A
                RIGHT JOIN (SELECT DISTINCT A.id_kuesioner_mhs, A.waktu_input, B.* FROM el_kuesioner_mhs A
                RIGHT JOIN (SELECT DISTINCT A.nim, B.id_jadual, B.thn_akademik, B.periode 
                                    FROM krs A, jadual B
                                    WHERE A.id_jadual=B.id_jadual
                                    AND A.nim=$nim
                                    AND B.thn_akademik=(SELECT thn_akademik FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
                                    AND B.periode=(SELECT periode FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)) B
                ON A.id_jadual=B.id_jadual
                AND A.nim=B.nim
                ) B
                ON A.id_jadual=B.id_jadual
                ORDER BY A.jumlah_mhs_input ASC, B.id_jadual ASC
                LIMIT 1)
                AND A.id_dosen=C.id_dosen");
        */
       

       $this->query = $this->db_2->query("SELECT DISTINCT A.id_mtk, A.id_jadual, B.nama as mata_kuliah, A.periode, A.thn_akademik, C.nama, C.gelar, B.semester, B.sks, D.id as sudah_pernah, D.jumlah_mhs_input
			FROM jadual A, mtk_next B, dosen C, ((SELECT B.id_kuesioner_mhs as id, B.id_jadual, A.jumlah_mhs_input FROM el_kuesioner_nilai A
                RIGHT JOIN (SELECT DISTINCT A.id_kuesioner_mhs, A.waktu_input, B.* FROM el_kuesioner_mhs A
                RIGHT JOIN (SELECT DISTINCT A.nim, B.id_jadual, B.thn_akademik, B.periode 
                                    FROM krs A, jadual B
                                    WHERE A.id_jadual=B.id_jadual
                                    AND A.nim=$nim
                                    AND B.thn_akademik=(SELECT thn_akademik FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
                                    AND B.periode=(SELECT periode FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)) B
                ON A.id_jadual=B.id_jadual
                AND A.nim=B.nim
                ) B
                ON A.id_jadual=B.id_jadual
				GROUP BY A.id_jadual
                ORDER BY A.jumlah_mhs_input ASC, B.id_jadual ASC)) D
            WHERE A.id_mtk=B.id_mtk
AND A.id_jadual=D.id_jadual
AND A.id_dosen=C.id_dosen 
AND C.nama != '*'
AND C.nama !='**'
AND C.nama IS NOT NULL
AND D.id IS NULL
GROUP BY A.id_jadual
ORDER BY D.jumlah_mhs_input ASC, A.id_jadual DESC LIMIT 1");


/*

       $this->query = $this->db_2->query("SELECT DISTINCT A.id_mtk, A.id_jadual, B.nama as mata_kuliah, A.periode, A.thn_akademik, C.nama, C.gelar, B.semester, B.sks, D.id as sudah_pernah, D.jumlah_mhs_input
            FROM jadual A, mtk_next B, dosen C, ((SELECT A.id, B.id_jadual, A.jumlah_mhs_input FROM el_kuesioner_nilai A
                RIGHT JOIN (SELECT DISTINCT A.id_kuesioner_mhs, A.waktu_input, B.* FROM el_kuesioner_mhs A
                RIGHT JOIN (SELECT DISTINCT A.nim, B.id_jadual, B.thn_akademik, B.periode 
                                    FROM krs A, jadual B
                                    WHERE A.id_jadual=B.id_jadual
                                    AND A.nim=$nim
                                    AND B.thn_akademik=(SELECT thn_akademik FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
                                    AND B.periode=(SELECT periode FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)) B
                ON A.id_jadual=B.id_jadual
                AND A.nim=B.nim
                ) B
                ON A.id_jadual=B.id_jadual
                ORDER BY A.jumlah_mhs_input ASC, B.id_jadual ASC)) D
            WHERE A.id_mtk=B.id_mtk
AND A.id_jadual=D.id_jadual
AND A.id_dosen=C.id_dosen 
AND C.nama != '*'
AND C.nama !='**'
AND C.nama IS NOT NULL
AND D.id IS NULL
GROUP BY A.id_jadual
ORDER BY D.jumlah_mhs_input ASC, A.id_jadual DESC LIMIT 1");
*/


/*
die ("SELECT DISTINCT A.id_mtk, A.id_jadual, B.nama as mata_kuliah, A.periode, A.thn_akademik, C.nama, C.gelar, B.semester, B.sks, D.id as sudah_pernah, D.jumlah_mhs_input
			FROM jadual A, mtk_next B, dosen C, ((SELECT A.id --/malalahnya nih <<----, B.id_jadual, A.jumlah_mhs_input FROM el_kuesioner_nilai A
                RIGHT JOIN (SELECT DISTINCT A.id_kuesioner_mhs, A.waktu_input, B.* FROM el_kuesioner_mhs A
                RIGHT JOIN (SELECT DISTINCT A.nim, B.id_jadual, B.thn_akademik, B.periode 
                                    FROM krs A, jadual B
                                    WHERE A.id_jadual=B.id_jadual
                                    AND A.nim=$nim
                                    AND B.thn_akademik=(SELECT thn_akademik FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
                                    AND B.periode=(SELECT periode FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)) B
                ON A.id_jadual=B.id_jadual
                AND A.nim=B.nim
                ) B
                ON A.id_jadual=B.id_jadual
                ORDER BY A.jumlah_mhs_input ASC, B.id_jadual ASC)) D
            WHERE A.id_mtk=B.id_mtk
AND A.id_jadual=D.id_jadual
AND A.id_dosen=C.id_dosen 
AND C.nama != '*'
AND C.nama !='**'
AND C.nama IS NOT NULL
AND D.id IS NULL 
GROUP BY A.id_jadual
ORDER BY D.jumlah_mhs_input ASC, A.id_jadual DESC LIMIT 1");
*/


        if($this->query->num_rows >0)
        {
            return $this->query;   
        }else{
            return FALSE;
        }

    }

    public function cek_mhs_aktif($nim,$tgl)
    {
		//query lama
        /*$this->query = $this->db_2->query("SELECT mhs.nim, mhs.nama, mhs.tempat_lahir, mhs.tgl_lahir, mhs.alamat, mhs.gol_darah, mhs.rt, mhs.rw, mhs.kode_pos, mhs.kota, mhs.angkatan, mhs.kd_status,  mst_jurusan.uraian_panjang FROM mhs LEFT OUTER           JOIN mst_jurusan
                        ON mhs.kd_jurusan=mst_jurusan.kd_jurusan
                        WHERE mhs.nim=".$nim." 
                        AND mhs.tgl_lahir='".$tgl."' 
                         LIMIT 1");*/
		//query baru 25 april 2017 (Fadhla)
		$this->query = $this->db_2->query("SELECT mhs.nim, mhs.nama, mhs.tempat_lahir, mhs.tgl_lahir, mhs.alamat, mhs.gol_darah, mhs.rt, mhs.rw, mhs.kode_pos, mhs.kota, mhs.angkatan, mhs.kd_status,  mst_konsentrasi.uraian uraian_panjang FROM mhs LEFT OUTER           JOIN mst_konsentrasi
                        ON mhs.kd_konsentrasi=mst_konsentrasi.kd_konsentrasi
                        WHERE mhs.nim=".$nim." 
                        AND mhs.tgl_lahir='".$tgl."' 
                         LIMIT 1");
                $row = $this->query->row();
//AND mhs.kd_status=1  LIMIT 1
        if($this->query->num_rows >0)
        {
            $this->session->set_userdata(array(
                            'nim' => $row->nim,
                            'nama'  => $row->nama,
                            'tempat_lahir'  => $row->tempat_lahir,
                            'tgl_lahir'  => $row->tgl_lahir,
                            'alamat'  => $row->alamat,
                            'gol_darah'  => $row->gol_darah,
                            'rt'  => $row->rt,
                            'rw'  => $row->rw,
                            'kode_pos'  => $row->kode_pos,
                            'kota'  => $row->kota,
                            'angkatan'  => $row->angkatan,
                            'jurusan' => $row->uraian_panjang,
                            'mhs_log_in'  => 'log_in'
            )); 

            //cek jumlah matkul yg diikuti
            $this->query = $this->db_2->query("SELECT DISTINCT B.id_jadual, B.periode, B.thn_akademik, D.nama as nama_dosen, D.gelar, C.nama FROM krs A, jadual B, mtk_next C, dosen D
                WHERE A.id_jadual=B.id_jadual
                AND B.id_mtk=C.id_mtk
                AND B.id_dosen=D.id_dosen 
                AND A.nim=$nim
                AND D.nama !='*'
                AND D.nama !='**' 
                AND D.nama IS NOT NULL
                AND B.thn_akademik=(SELECT thn_akademik FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
                AND B.periode=(SELECT periode FROM kalender_akademik ORDER BY thn_akademik DESC, periode DESC LIMIT 1)
                GROUP BY B.id_jadual");

            $xyz=0;
            if($this->query->num_rows >0) {
                if ($this->query->num_rows <4) {
                    $xyz=$this->query->num_rows;
                }else{
                    $xyz=4;
                }
            }


            if ($this->cek_kuesioner_matkul($row->nim) >= $xyz) {
                # code...
                $this->session->set_userdata(array(
                            'kuesioner' => 'sudah',
                )); 
            }

            return TRUE;   
        }else{
            return FALSE;
        }
    }

/*--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------*/
    public function log_login_mhs($nim)
    {
        $sql=$this->db_2->query("SELECT nama FROM mhs WHERE nim=$nim LIMIT 1");
        foreach ($sql->result_array() as $value) {
            $nama=$value['nama'];
        }

        $this->query = $this->db->query("SELECT * FROM el_log_login_mhs WHERE nim=$nim");

        if($this->query->num_rows >0){
                //jika ada update data
                $data = array(
                   'ip_address' =>$this->input->ip_address(),
                   'waktu_login' =>date('Y-m-d H:i:s'),
                );

                $this->db->where('nim', $nim);
                $this->db->update('el_log_login_mhs', $data);
        }else{
            //jika tidak ada insert data
                $data = array(
                    'ip_address' =>$this->input->ip_address(),
                    'nim' => $nim,
                    'nama' => $nama,
                );

                $this->db->insert('el_log_login_mhs', $data); 
            
        } 
    }


    /*
    SELECT B.kd_mtk, B.nama AS mata_kuliah, max(B.sks) as sks, min(A.nilai) as nilai, B.semester, max(A.thn_akademik) as thn_akademik, A.periode , max(A.tugas) as tugas, max(A.uts) as uts, max(A.uas) as uas
                        FROM krs A, mtk_next B
                        WHERE A.id_mtk = B.id_mtk
                        AND A.nilai!='' 
                        AND A.nim = '$nim'
                        GROUP BY B.id_mtk
                        ORDER BY thn_akademik, periode ASC
     */
    

/*--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------*/

    public function cek_nilai_mhs($nim)
    {
        $this->query = $this->db_2->query("SELECT daftar_nilai.*,id_status
                FROM (      SELECT daftar_nilai.*,bobot_tugas , bobot_uts, bobot_uas
                            FROM (SELECT B.kd_mtk, B.nama AS mata_kuliah, max(B.sks) as sks, min(A.nilai) as nilai, B.semester, max(A.thn_akademik) as thn_akademik, A.periode , max(A.tugas) as tugas, max(A.uts) as uts, max(A.uas) as uas, max(A.id_jadual) as id_jadual,CONCAT(max(A.thn_akademik), A.periode) AS bilangan_tahun
                                    FROM ( SELECT Distinct A.*
                                        FROM krs AS A
                                        left join (
                                            SELECT MIN(nilai) AS nilai, id_mtk
                                            FROM krs
                                        where nim='$nim' and nilai!=''
                                            GROUP BY id_mtk
                                        ) AS B
                                        ON A.id_mtk=B.id_mtk
                                        WHERE A.nilai= B.nilai
                                        and A.nim='$nim' ) as A, mtk_next B
                                    WHERE A.id_mtk = B.id_mtk
                                    AND A.nilai!='' 
                                    AND A.nim = '$nim'
                                    GROUP BY B.id_mtk
                                    ORDER BY thn_akademik, periode ASC) as daftar_nilai
                            LEFT JOIN jadual
                            ON daftar_nilai.id_jadual=jadual.id_jadual) as daftar_nilai
                LEFT JOIN el_kunci_nilai
                ON daftar_nilai.id_jadual=el_kunci_nilai.id_jadual
                WHERE thn_akademik < 2013

                UNION
                SELECT daftar_nilai.*,id_status
                FROM (      SELECT daftar_nilai.*,bobot_tugas , bobot_uts, bobot_uas
                            FROM (SELECT B.kd_mtk, B.nama as mata_kuliah, B.sks, A.nilai, B.semester, A.thn_akademik, A.periode, 
                                    max(A.tugas) as tugas, max(A.uts) as uts, max(A.uas) as uas, max(A.id_jadual) as id_jadual,CONCAT(max(A.thn_akademik), A.periode) AS bilangan_tahun
                                    FROM ( SELECT Distinct A.*
                                        FROM krs AS A
                                        left join (
                                            SELECT MIN(nilai) AS nilai, id_mtk
                                            FROM krs
                                        where nim='$nim' and nilai!=''
                                            GROUP BY id_mtk
                                        ) AS B
                                        ON A.id_mtk=B.id_mtk
                                        WHERE A.nilai= B.nilai
                                        and A.nim='$nim' ) as A 
                                    LEFT JOIN mtk_next B
                                    ON A.id_mtk = B.id_mtk
                                    WHERE A.nim = '$nim'
                                    AND A.nilai!=''                                
                                    AND A.thn_akademik=B.thn_akademik
                                    GROUP BY A.id_mtk
                                    ORDER BY A.thn_akademik, A.periode ASC) as daftar_nilai
                            LEFT JOIN jadual
                            ON daftar_nilai.id_jadual=jadual.id_jadual) as daftar_nilai
                LEFT JOIN el_kunci_nilai
                ON daftar_nilai.id_jadual=el_kunci_nilai.id_jadual
                WHERE thn_akademik >= 2013
                AND id_status=1
                ORDER BY thn_akademik, periode ASC");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        } 
    }




    public function cek_ipk_mhs($nim)
    {
        $this->query = $this->db_2->query("SELECT  (sum(sks*(CASE WHEN nilai='A' then 4
					WHEN nilai='B+' then 3.5
                    WHEN nilai='B' then 3
					WHEN nilai='C+' then 2.5
                    WHEN nilai='C' then 2
                    WHEN nilai='D' then 1
                                 else 0 END))/(sum( sks))) as ipk, sum(sks) as sks
                    FROM 

                                (SELECT daftar_nilai.*,id_status
                FROM (SELECT B.kd_mtk, B.nama AS mata_kuliah, max(B.sks) as sks, min(A.nilai) as nilai, B.semester, max(A.thn_akademik) as thn_akademik, A.periode , max(A.tugas) as tugas, max(A.uts) as uts, max(A.uas) as uas, max(A.id_jadual) as id_jadual,CONCAT(max(A.thn_akademik), A.periode) AS bilangan_tahun
                        FROM ( SELECT Distinct A.*
                                        FROM krs AS A
                                        left join (
                                            SELECT MIN(nilai) AS nilai, id_mtk
                                            FROM krs
                                        where nim='$nim' and nilai!=''
                                            GROUP BY id_mtk
                                        ) AS B
                                        ON A.id_mtk=B.id_mtk
                                        WHERE A.nilai= B.nilai
                                        and A.nim='$nim' ) as A, mtk_next B
                        WHERE A.id_mtk = B.id_mtk
                        AND A.nilai!='' 
                        AND A.nim = '$nim'
                        GROUP BY B.id_mtk
                        ORDER BY thn_akademik, periode ASC) as daftar_nilai
                LEFT JOIN el_kunci_nilai
                ON daftar_nilai.id_jadual=el_kunci_nilai.id_jadual
                WHERE thn_akademik < 2013

                UNION
                SELECT daftar_nilai.*,id_status
                FROM (SELECT B.kd_mtk, B.nama as mata_kuliah, B.sks , A.nilai, B.semester, A.thn_akademik, A.periode,  max(A.tugas) as tugas, max(A.uts) as uts, max(A.uas) as uas, max(A.id_jadual) as id_jadual,CONCAT(max(A.thn_akademik), A.periode) AS bilangan_tahun
                                    FROM ( SELECT Distinct A.*
                                        FROM krs AS A
                                        left join (
                                            SELECT MIN(nilai) AS nilai, id_mtk
                                            FROM krs
                                        where nim='$nim' and nilai!=''
                                            GROUP BY id_mtk
                                        ) AS B
                                        ON A.id_mtk=B.id_mtk
                                        WHERE A.nilai= B.nilai
                                        and A.nim='$nim' ) as A 
                                    LEFT JOIN mtk_next B
                                    ON A.id_mtk = B.id_mtk
                                    WHERE A.nim = '$nim'
                                    AND A.nilai!=''                                
                                    AND A.thn_akademik=B.thn_akademik
                                    GROUP BY A.id_mtk
                                    ORDER BY A.thn_akademik, A.periode ASC) as daftar_nilai
                LEFT JOIN el_kunci_nilai
                ON daftar_nilai.id_jadual=el_kunci_nilai.id_jadual
                WHERE thn_akademik >= 2013
                AND id_status=1
                ORDER BY thn_akademik, periode ASC) 


                    as daftar_nilai");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        } 
    }

    public function cek_ip_semester($nim)
    {
        $this->query = $this->db_2->query("SELECT  (sum(sks*(CASE WHEN nilai='A' then 4
                    WHEN nilai='B+' then 3.5
                    WHEN nilai='B' then 3
					WHEN nilai='C+' then 2.5
                    WHEN nilai='C' then 2
                    WHEN nilai='D' then 1
                                 else 0 END))/(sum( sks))) as ipk, sum(sks) as sks, semester
                    FROM 
                    

                                (SELECT daftar_nilai.*,id_status
                FROM (SELECT B.kd_mtk, B.nama AS mata_kuliah, max(B.sks) as sks, min(A.nilai) as nilai, B.semester, max(A.thn_akademik) as thn_akademik, A.periode , max(A.tugas) as tugas, max(A.uts) as uts, max(A.uas) as uas, max(A.id_jadual) as id_jadual,CONCAT(max(A.thn_akademik), A.periode) AS bilangan_tahun
                        FROM ( SELECT Distinct A.*
                                        FROM krs AS A
                                        left join (
                                            SELECT MIN(nilai) AS nilai, id_mtk
                                            FROM krs
                                        where nim='$nim' and nilai!=''
                                            GROUP BY id_mtk
                                        ) AS B
                                        ON A.id_mtk=B.id_mtk
                                        WHERE A.nilai= B.nilai
                                        and A.nim='$nim' ) as A, mtk_next B
                        WHERE A.id_mtk = B.id_mtk
                        AND A.nilai!='' 
                        AND A.nim = '$nim'
                        GROUP BY B.id_mtk
                        ORDER BY thn_akademik, periode ASC) as daftar_nilai
                LEFT JOIN el_kunci_nilai
                ON daftar_nilai.id_jadual=el_kunci_nilai.id_jadual
                WHERE thn_akademik < 2013

                UNION
                SELECT daftar_nilai.*,id_status
                FROM (SELECT B.kd_mtk, B.nama as mata_kuliah, B.sks , A.nilai, B.semester, A.thn_akademik, A.periode, max(A.tugas) as tugas, max(A.uts) as uts, max(A.uas) as uas, max(A.id_jadual) as id_jadual,CONCAT(max(A.thn_akademik), A.periode) AS bilangan_tahun
                                    FROM ( SELECT Distinct A.*
                                        FROM krs AS A
                                        left join (
                                            SELECT MIN(nilai) AS nilai, id_mtk
                                            FROM krs
                                        where nim='$nim' and nilai!=''
                                            GROUP BY id_mtk
                                        ) AS B
                                        ON A.id_mtk=B.id_mtk
                                        WHERE A.nilai= B.nilai
                                        and A.nim='$nim' ) as A 
                                    LEFT JOIN mtk_next B
                                    ON A.id_mtk = B.id_mtk
                                    WHERE A.nim = '$nim'
                                    AND A.nilai!=''                                
                                    AND A.thn_akademik=B.thn_akademik
                                    GROUP BY A.id_mtk
                                    ORDER BY A.thn_akademik, A.periode ASC) as daftar_nilai
                LEFT JOIN el_kunci_nilai
                ON daftar_nilai.id_jadual=el_kunci_nilai.id_jadual
                WHERE thn_akademik >= 2013
                AND id_status=1
                ORDER BY thn_akademik, periode ASC) 
                    
                    as daftar_nilai
                    GROUP BY thn_akademik, periode");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        } 
    }
/*--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------*/
    public function get_materi_kuliah()
    {
        $this->query = $this->db->query("SELECT A.nama_asli, A.gelar, B.nama_mata_kuliah, B.keterangan_dokumen, B.lampiran_materi, B.id_dosen FROM users_e_dosen A, el_materi_kuliah B WHERE A.id=B.id_dosen ORDER BY A.nama_asli ASC");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        } 
    }

    public function get_nama_dosen()
    {
        $this->query = $this->db->query("SELECT A.nama_asli, A.gelar
                            FROM users_e_dosen A, el_materi_kuliah B
                            WHERE A.id=B.id_dosen
                            GROUP BY A.id
                            ORDER BY A.nama_asli ASC");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        } 
    }

    public function get_dosen_wali($nim)
    {
        $this->query = $this->db_2->query("SELECT B.nama, B.gelar FROM mhs A
                LEFT JOIN dosen B
                ON A.dosen_wali=B.id_dosen
                WHERE A.nim=$nim
                LIMIT 1");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        } 
    }
    
    public function get_uploadd_dtmhs()
    {
        $this->query = $this->db_2->query("SELECT * FROM uploadd_dtmhs OREDER BY nim ASC");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        } 
    }
  
}

?>