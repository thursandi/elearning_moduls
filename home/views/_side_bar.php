
        <div id="sidebar" class="span3">

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


       