<!-- BEGIN BODY -->
<body class="fixed-top" onload="noBack();" onunload="">
   <!-- BEGIN HEADER -->
   <div id="header" class="navbar navbar-inverse navbar-fixed-top">
       <!-- BEGIN TOP NAVIGATION BAR -->
       <div class="navbar-inner">
           <div class="container-fluid">
               <!-- BEGIN LOGO -->
               <a class="brand">
                   <img src="<?=base_url();?>images/logo.png" alt="E-Learnig STMI" />
               </a>
               <!-- END LOGO -->
               <!-- BEGIN RESPONSIVE MENU TOGGLER -->
               <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="arrow"></span>
               </a>
               <!-- END RESPONSIVE MENU TOGGLER -->
               
               <div class="top-nav ">
                   <ul class="nav pull-right top-menu" >
                      <div id="top_menu" class="nav notify-row">
                        <img src="<?=base_url();?>images/logo_1.png" alt="E-Learnig STMI" />
                        <img src="<?=base_url();?>images/logo.png" alt="E-Learnig STMI" />


                      </div>
                       <!-- BEGIN USER LOGIN DROPDOWN -->
                       <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <span class="username">Selamat datang, <?php echo $this->session->userdata('nama_asli');?></span>
                               <b class="caret"></b>
                           </a>
                           <ul class="dropdown-menu">
                               <li><a href="<?php echo site_url('auth/change_password')?>"><i class="icon-user"></i> Ubah Password</a></li>
<?php $z=str_replace('.', '', $this->session->userdata('nama_asli'));
      $nm=explode(' ', $z);
      $url_nama= (empty($nm[1]))? strtolower($nm[0]) : strtolower($nm[0]).'-'. strtolower($nm[1]);
?>
                               <li><a href="<?php echo base_url().'blog/dosen/'.$url_nama; ?>" target="_blank"><i class="icon-tasks"></i> Blog Saya</a></li>
                               <li class="divider"></li>
                               <li><a href="<?php echo site_url('auth/logout')?>"><i class="icon-key"></i> Log Out</a></li>
                           </ul>
                       </li>
                       <!-- END USER LOGIN DROPDOWN -->
                   </ul>
                   <!-- END TOP NAVIGATION MENU -->
               </div>
           </div>
       </div>
       <!-- END TOP NAVIGATION BAR -->
   </div>
   <!-- END HEADER -->


      <!-- BEGIN CONTAINER -->
   <div id="container" class="row-fluid">
      <!-- BEGIN SIDEBAR -->
      <div id="sidebar" class="nav-collapse collapse">

         <div class="sidebar-toggler hidden-phone"></div>   
          
         <!-- BEGIN SIDEBAR MENU -->
          <?php echo $data['menu_header']; ?>
         <!-- END SIDEBAR MENU -->
        <br>
         <div align="center"><img src="<?=base_url();?>img/logo_2_white.png" alt="E-Learnig STMI" height="140" width="140"></div>


      </div>
      <!-- END SIDEBAR -->
