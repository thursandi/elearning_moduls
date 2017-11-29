
        <div id="sidebar" class="span3">




            <div class="widget widget_latestpost"><h3 class="title"><span>Biodata Dosen</span></h3>
                <div class="latest-posts">


<?php
if ( !empty($biodata) ) 
{
foreach($biodata->result() as $row)
:?>

                <table class="table table-striped">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?php echo str_replace('*', " $row->nama_asli, ", $row->gelar) ;?></td>
                        <td rowspan="2" width="100">
                            <?php if(empty($row->foto)) {?>
                                <img src="http://e-learning.stmi.ac.id/assets/uploads/foto_biodata_dosen/no_foto.jpg" alt="">
                            <?php }else{ ?>
                                <img src="http://e-learning.stmi.ac.id/assets/uploads/foto_biodata_dosen/<?php echo $row->foto; ?>" alt="">
                            <?php };?>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir</td>
                        <td>:</td>
                        <td><?php echo (empty($row->tgl_lahir))?'tidak diketahui':date('j F Y', strtotime($row->tgl_lahir));?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td colspan="2"><?php echo (empty($row->alamat))?'tidak diketahui':$row->alamat;?></td>
                    </tr>
                    <tr>
                        <td>No.Hp</td>
                        <td>:</td>
                        <td colspan="2"><?php echo (empty($row->no_hp))?'tidak diketahui':$row->no_hp;?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td colspan="2"><?php $x=explode('_', $row->email);
                        if ($x[0]=='silahkan') {
                            echo 'tidak diketahui';
                        }else{
                            echo $row->email;
                        }
                        ?></td>
                    </tr>
                </table>
<?php 
endforeach;
}
?> 
                </div>
            </div>



            <div class="widget widget_latestpost"><h3 class="title"><span>Link Akademik</span></h3>
                <div class="latest-posts">

<div align="center">                 
<?php
if ( !empty($banner_link) ) 
{
foreach($banner_link->result() as $row)
:?>


<a href="<?php echo $row->link ?>" target="_blank" title="<?php echo $row->judul; ?>"><img src="http://stmi.ac.id/assets/uploads/banner_link/<?php echo $row->link_gambar ?>" alt="<?php echo $row->judul;?>"/></a>

<?php 
endforeach;
}
?> 
</div>
                </div>
            </div>
            

            <div class="widget widget_latestpost"><h3 class="title"><span>Link Lainnya</span></h3>
                <div class="latest-posts">
                        <ul>
                
<?php
if ( !empty($link_website) ) 
{
foreach($link_website->result() as $row)
:?>



<li><a href="<?php echo $row->link;?>"><h4  class="post-title"><?php echo ucwords($row->judul);?></h4></a></li>

<?php 
endforeach;
}
?> 
                        </ul>
                </div>
            </div>
            
            
                        
        </div><!-- sidebar -->
        
        <div class="clearfix"></div>


       