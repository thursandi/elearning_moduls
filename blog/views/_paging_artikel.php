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
        
        <!-- search blm aktif 
        <div class="search span3">
          <div class="offset1">
            <form method="get" id="searchform" action="#">
                <p><input type="text" value="Search here..." onfocus="if ( this.value == 'Search here...' ) { this.value = ''; }" onblur="if ( this.value == '' ) { this.value = 'Search here...'; }" name="s" id="s" />
                <input type="submit" id="searchsubmit" value="Search" /></p>
            </form>
          </div>
        </div>
        -->
        </div>
    </div>

  <div id="content" class="container">

    <div id="main" class="row-fluid">
      <div id="main-left" class="span9">









<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
  <thead>
    <tr>
      <th>Rangkuman Blog</th>
    <tr>
  </thead>
  <tbody>

<?php $i=1;$n='';$m='';
if ( !empty($paging_artikel) ) 
foreach($paging_artikel->result() as $row)
:?>
  <tr class="even">
      <td>
        
        <?php $z=str_replace('.', '', $row->nama_asli);
                                              $nm=explode(' ', $z);
                                              $url_nama= (empty($nm[1]))? strtolower($nm[0]) : strtolower($nm[0]).'-'. strtolower($nm[1]);
                                        ?>

         <article class="post">
          <h3 class="post-title"><a href="<?=base_url();?>blog/dosen/<?php echo $url_nama.'/'.my_number_encrypt($row->id_artikel).'/'.url_title($row->judul_artikel, 'dash', TRUE);?>"><?php echo $row->judul_artikel;?></a></h3>
          <div class="entry-meta row-fluid">
            <ul class="clearfix">
              <li><a href="#" rel="author">Ditulis oleh: <b><?php echo str_replace('*', "$row->nama_asli, ", $row->gelar) ;?></b></a></li>
              <li><img src="<?=base_url();?>images/time.png" alt=""><?php echo date('j F Y', strtotime($row->tanggal_input));?></li>
              <li><img src="<?=base_url();?>images/view-bg.png" alt="">Dilihat: <?php echo ((empty($row->view))?'0':$row->view);?> kali</li>
            </ul>
          </div>
          <div class="entry-content">
            <?php if (!empty($row->link_gambar)){?>
            <p><img width="774" height="320" src="<?php echo base_url().'assets/uploads/blog_dosen/'.$row->link_gambar;?>" alt="<?php echo $row->judul_artikel;?>" /></p>
            <?php } ?>
            
            <?php 
                                        // strip tags to avoid breaking any html
                                        $string = strip_tags($row->isi_artikel);
                                        //$string = $row->isi_artikel;s

                                        if (strlen($string) > 100) {

                                            // truncate string
                                            $stringCut = substr($string, 0, 300);

                                            // make sure it ends in a word so assassinate doesn't become ass...
                                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
                                        }
                                        echo $string;
                                         ?>
            <br><br>
            <p class="moretag"><a href="<?=base_url();?>blog/dosen/<?php echo $url_nama.'/'.my_number_encrypt($row->id_artikel).'/'.url_title($row->judul_artikel, 'dash', TRUE);?>"> Baca Selengkapnya</a></p>
          </div>
        </article>

      </td>
  </tr>


<?php $i++;
endforeach
;?>

  </tbody>

</table>








          
      
      </div><!-- #main-left -->