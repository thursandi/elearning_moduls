<div class="headline-ad container">
        <div class="image_ad">
           <img src="<?=base_url();?>img/logo2.png" alt="Kemenperin dan STMI" />
           <h4>E-Learning | Sekolah Tinggi Manajemen Industri</h4>
        </div>
    </div>  


<div id="intr" class="container">
        <div class="row-fluid">
            <div class="brnews span9">
                <h3>Breaking News</h3>

                        <!-- newsticker -->
                        <ul id="scroller">
                                <?php 
                                $row=NULL;
                                $i=1;
                                if ( !empty($newsticker) ) {
                                $num=$newsticker->num_rows();
                                foreach($newsticker->result() as $row):
                                $path_parts = pathinfo($row->link_thumbnail);
                                ?>

                                    <li><p><a href="<?php echo 'http://stmi.ac.id/'.'berita/tentang/berita_'.$path_parts['filename'].'/'.$row->id_berita.'/'.url_title($row->judul_berita, 'dash', TRUE);?>" title="<?php echo ucwords($row->judul_berita);?>" rel="bookmark"><span class="title"><?php echo date('j/m/Y', strtotime($row->tanggal));?></span> <?php echo ucwords($row->judul_berita);?></a></p></li>
                                    
                                
                                <?php 
                                endforeach;
                                }
                                ?>
                        </ul>
                        <!-- newsticker -->
            </div>
        
        
        </div>
    </div>

  <div id="content" class="container">

    <div id="main" class="row-fluid">
      <div id="main-left" class="span9">





<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
  <thead>
    <tr>
      <th>No.</th>
      <th>Nama Dosen</th>
      <th>URL</th>
      <th>Link</th>
    </tr>
  </thead>
  <tbody>


<?php $i=1;$n='';$m='';
if ( !empty($daftar_blog) ) 
foreach($daftar_blog->result() as $row)
:?>

<?php $z=str_replace('.', '', $row->nama_asli);
      $nm=explode(' ', $z);
      $url_nama= (empty($nm[1]))? strtolower($nm[0]) : strtolower($nm[0]).'-'. strtolower($nm[1]);
?>

    <tr class="even <?php
      if ( $n!=substr($nm[0], 0, 1) ) {
        if ($m=='gradeA') {
          echo 'gradeC';
          $m='gradeC';
        }else{
          echo 'gradeA';
          $m='gradeA';
        }
     }else{
        echo $m;
     } 
     $n=substr($nm[0], 0, 1);
     ;?>">

     <?php



     ?>
      <td><?php echo $i; ?></td>
      <td><?php echo str_replace('*', " <b style='color:blue;'>$row->nama_asli</b>, ", $row->gelar) ;?></td>
      <td><?php echo base_url().'blog/dosen/'.'<b style="color:blue;">'.$url_nama.'</b>'; ?></td>
      <td><a href="<?=base_url();?>blog/dosen/<?php echo $url_nama;?>">link</a></td>
    </tr>

<?php $i++;
endforeach
;?>

  <tfoot>
    <tr>
      <th>No.</th>
      <th>Nama Dosen</th>
      <th>URL</th>
      <th>URL</th>
    </tr>
  </tfoot>
</table>








     
      
      </div><!-- #main-left -->