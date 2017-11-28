
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
                               <span class="username">Selamat datang, <?php echo $this->session->userdata('nama');?></span>
                               <b class="caret"></b>
                           </a>
                           <ul class="dropdown-menu">
                               <li><a href="<?php echo site_url('mhs/logout')?>"><i class="icon-share"></i> Log Out</a></li>
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
          <ul class="sidebar-menu">
              
              <li class="has-sub">
                  <a href="javascript:;" class="">
                      <span class="icon-box"> <i class="icon-book"></i></span> Menu Mahasiswa
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li><a class="" href="<?php echo site_url('mhs/biodata')?>">Biodata Mahasiswa</a></li>
                      <li><a class="" href="<?php echo site_url('mhs/grafik_ips')?>">Grafik IPS</a></li>
                      <li><a class="" href="<?php echo site_url('mhs/nilai')?>">Nilai Mahasiswa</a></li>
                      <li><a class="" href="<?php echo site_url('mhs/download_materi_kuliah')?>">Download Materi Kuliah</a></li>
					  <li><a class="" href="<?php echo site_url('mhs/chat')?>">Forum Tanya Jawab Program Studi</a></li>
					  <li><a class="" href="http://intranet.stmi.ac.id/krsonline" target="_blank">KRS ONLINE</a></li>
            <li><a class="" href="<?php echo site_url('absensi/mhs_absensi')?>" target="_blank">Absensi</a></li>
					</li>
                  </ul>
              </li>
          </ul> 
			  <!-- BEGIN SIDEBAR MENU KEMAHASISWAAN-->
			  <ul class="sidebar-menu">
              <li class="has-sub">
                  <a href="javascript:;" class="">
                      <span class="icon-box"> <i class="icon-book"></i></span>Kemahasiswaan**
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li><a class="" href="http://intranet.stmi.ac.id/cetak_kartu/" target="_blank">Cetak Kartu Studi Tetap</a></li>
					  <li><a class="" href="http://intranet.stmi.ac.id/cetak_kartu/" target="_blank">Cetak Transkrip</a></li>
                      <!--<li><a class="" href="http://intranet.stmi.ac.id/cetak_kartu/menu/mhs/" target="_blank">Cetak Keterangan Mahasiswa Aktif</a></li>!-->
					</li>
                  </ul>
              </li>
          </ul>
		 
         <!-- END SIDEBAR MENU -->


         <br>
         <div align="center"><img src="<?=base_url();?>img/logo_2_white.png" alt="E-Learnig STMI" height="140" width="140"></div>
         
      </div>
      <!-- END SIDEBAR -->
