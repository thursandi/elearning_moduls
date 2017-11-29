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
                <div id="slider" class="clearfix">
                    <div id="slide" class="flexslider">
                        <ul class="slides">

                        
<?php 
$i=1;
if ( !empty($gambar_slider_awal) ) 
foreach($gambar_slider_awal->result() as $row):

                        $tags = explode(' ' , $row->title);
                        $ket[$i]='';$link_dari_gambar[$i]='';
                        foreach($tags as $asd) {
                            if(filter_var($asd, FILTER_VALIDATE_URL)){ 
                              $link_dari_gambar[$i]= $asd;
                            }else{
                                $ket[$i] .= "$asd ";
                            }
                        }

?>
                            <li data-thumb="http://stmi.ac.id/assets/uploads/slider_awal/thumb__<?php echo $row->url; ?>">


                            <?php
                                    if (empty($link_dari_gambar[$i])) {
                            ?>

                            <img width="770" height="364" src="http://stmi.ac.id/assets/uploads/slider_awal/<?php echo $row->url; ?>" alt="<?php echo $ket[$i]; ?>" />
                            
                            <?php  
                            }else{
                            ?>

                            <a href="<?php echo $link_dari_gambar[$i];?>" target="_blank">
                                <img width="770" height="364" src="http://stmi.ac.id/assets/uploads/slider_awal/<?php echo $row->url; ?>" alt="<?php echo $ket[$i]; ?>" />
                            </a>
                            
                            <?php
                            }
                            ?>

                                <div class="entry">
                                    <h4><?php echo $ket[$i]; ?></h4>
                                </div>
                            </li>
<?php 
$i++;
endforeach
;?>
                        </ul>
                    </div>
                </div>
        
                
                
                <div id="home-middle" class="clearfix">
                    <div class="left span12">
                        <h3 class="title"><a href="#" title="Pengumunan E-Elearning Terbaru"><span>Pengumunan E-Elearning Terbaru</span></a></h3>
                        
                        <ul id="itemContainerPengumuman">

<?php $i=1;
if ( !empty($pengumuman) ) 
foreach($pengumuman->result() as $row)
:?>
                            <li>
                                <h3 class="post-title"><a href="<?=base_url();?>blog/pengumuman/<?php echo $row->id_pengumuman.'/'.url_title($row->judul_pengumuman, 'dash', TRUE);?>"><?php echo $row->judul_pengumuman; ?></a></h3>
                                <p>
                                    <?php 
                                        // strip tags to avoid breaking any html
                                        $string = strip_tags($row->isi_pengumuman);
                                        //$string = $row->isi_artikel;s

                                        if (strlen($string) > 100) {

                                            // truncate string
                                            $stringCut = substr($string, 0, 200);

                                            // make sure it ends in a word so assassinate doesn't become ass...
                                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
                                        }
                                        echo $string;
                                         ?>
                                </p>
                                <div class="clearfix"></div> 
                                <div style="height:1px;background:#E9ECEE;border-bottom:1px solid #E9ECEE;"></div>               
                            </li>
<?php $i++;
endforeach
;?>

                        </ul>
                                        
                            <script type="text/javascript">
                                jQuery(document).ready(function($){

                                    /* initiate the plugin */
                                    $("div.holder").jPages({
                                    containerID  : "itemContainerPengumuman",
                                    perPage      : 3,
                                    startPage    : 1,
                                    startRange   : 1,
                                    links        : "blank"
                                    });
                                });     
                            </script>

                        
                        
                        <div class="holder clearfix"></div>
                        <div class="clear"></div>

                    </div>
                </div>

                <div id="home-middle" class="clearfix">    

                    <div class="right span12">


                        <div class="widget widget_latestpost">
                                


                                <h3 class="title"><a href="#" title="Artikel Dosen Terbaru"><span>Artikel Dosen Terbaru</span></a></h3>
                        
                                <ul id="itemContainerDosen">

<?php $i=1;
if ( !empty($artikel_dosen_terbaru) ) 
foreach($artikel_dosen_terbaru->result() as $row)
:?>
                                    <li><?php $z=str_replace('.', '', $row->nama_asli);
                                              $nm=explode(' ', $z);
                                              $url_nama= (empty($nm[1]))? strtolower($nm[0]) : strtolower($nm[0]).'-'. strtolower($nm[1]);
                                        ?>
                                        <h3 class="post-title"><a href="<?=base_url();?>blog/dosen/<?php echo $url_nama.'/'.my_number_encrypt($row->id_artikel).'/'.url_title($row->judul_artikel, 'dash', TRUE);?>"><?php echo $row->judul_artikel;?></a></h3>
                                        <p>
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
                                        </p>
                                       
                                        <div class="post-time"><i>Ditulis oleh: <b><?php echo str_replace('*', " $row->nama_asli, ", $row->gelar) ;?></b></i></div>
                                        <div class="post-time"><i><?php echo date('j F Y', strtotime($row->tanggal_input));?></i></div>
                                        
                                        <div class="clearfix"></div>  
                                        <div style="height:1px;background:#E9ECEE;border-bottom:1px solid #E9ECEE;"></div> 
                                    </li>
<?php $i++;
endforeach
;?>

                                </ul>
                                                
                                    <script type="text/javascript">
                                        jQuery(document).ready(function($){

                                            /* initiate the plugin */
                                            $("div.holder2").jPages({
                                            containerID  : "itemContainerDosen",
                                            perPage      : 10,
                                            startPage    : 1,
                                            startRange   : 1,
                                            links        : "blank"
                                            });
                                        });     
                                    </script>

                                
                                
                                <div class="holder2 clearfix"></div>
                                <div class="clear"></div>



                        </div>


                    </div>

                </div>

                

            </div><!-- #main-left -->
