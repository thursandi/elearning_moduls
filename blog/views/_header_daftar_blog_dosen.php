<!DOCTYPE html>

<!--[if IE 7]>
<html class="ie ie7" lang="en-US">
<![endif]-->

<!--[if IE 8]>
<html class="ie ie8" lang="en-US">
<![endif]-->

<!--[if IE 9]>
<html class="ie ie9" lang="en-US">
<![endif]-->

<!--[if !(IE 7) | !(IE 8) | !(IE 9)  ]><!-->
<html lang="en-US">
<!--<![endif]-->

<head>
<meta charset="UTF-8" />

        <title>stmi.ac.id | <?php echo $title; ?></title>

        <meta name="robots" content="index, follow">

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <meta name="description" content="<?php echo $description; ?>" />
        <meta name="keywords" content="<?php echo $keywords; ?>" />

        <link rel="icon" href="<?=base_url();?>assets/img/stmi.ico">


<link rel='stylesheet' id='magz-style-css'  href='<?=base_url();?>assets/css/elearning_home/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='swipemenu-css'  href='<?=base_url();?>assets/css/elearning_home/swipemenu.css' type='text/css' media='all' />
<link rel='stylesheet' id='flexslider-css'  href='<?=base_url();?>assets/css/elearning_home/flexslider.css' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-css'  href='<?=base_url();?>assets/css/elearning_home/bootstrap.css' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-responsive-css'  href='<?=base_url();?>assets/css/elearning_home/bootstrap-responsive.css' type='text/css' media='all' />
<link rel='stylesheet' id='simplyscroll-css'  href='<?=base_url();?>assets/css/elearning_home/jquery.simplyscroll.css' type='text/css' media='all' />
<link rel='stylesheet' id='jPages-css'  href='<?=base_url();?>assets/css/elearning_home/jPages.css' type='text/css' media='all' />
<link rel='stylesheet' id='rating-css'  href='<?=base_url();?>assets/css/elearning_home/jquery.rating.css' type='text/css' media='all' />
<link rel='stylesheet' id='ie-styles-css'  href='<?=base_url();?>assets/css/elearning_home/ie.css' type='text/css' media='all' />
<link rel='stylesheet' id='Roboto-css'  href='http://fonts.googleapis.com/css?family=Roboto' type='text/css' media='all' />

<script src="<?=base_url();?>assets/js/elearning_home/jquery-1.10.2.min.js"></script>
<script type='text/javascript' src='<?=base_url();?>assets/js/elearning_home/html5.js'></script>
<script type='text/javascript' src='<?=base_url();?>assets/js/elearning_home/bootstrap.min.js'></script>
<script type='text/javascript' src='<?=base_url();?>assets/js/elearning_home/jquery.simplyscroll.js'></script>
<script type='text/javascript' src='<?=base_url();?>assets/js/elearning_home/custom.js'></script>

        <!-- END -->
        <?php  date_default_timezone_set("Asia/Jakarta");?>


        <style type="text/css" title="currentStyle">
            @import "<?=base_url();?>assets/datatables/media/css/demo_page.css";
            @import "<?=base_url();?>assets/datatables/media/css/demo_table.css";
        </style>
        <script type="text/javascript" language="javascript" src="<?=base_url();?>assets/datatables/media/js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="<?=base_url();?>assets/datatables/media/js/jquery.dataTables.js"></script>

        <script>
//mulai noconflict antar jquery
jQuery.noConflict();
(function( $ ) {
  $(function() {
    //isi data
    
            $(document).ready(function() {
                $('#example').dataTable({
                  'iDisplayLength': 50
                });
            } );

    //akhir data
  });
})(jQuery);
</script>


        

</head>

<body>

<div id="page">

    <header id="header" class="container">
        <div id="mast-head">
            <div id="logo">
            <img src="<?=base_url();?>images/logo_1.png" alt="Logo" />
            <img src="<?=base_url();?>images/logo.png" alt="Logo" />
            </div>
        </div>

                
        <nav class="navbar navbar-inverse clearfix nobot">
                        
            <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
            <div class="nav-collapse" id="swipe-menu-responsive">
                
                <?php echo $menu_header; ?>
            
        </nav><!-- /.navbar -->
            
    </header><!-- #masthead -->



