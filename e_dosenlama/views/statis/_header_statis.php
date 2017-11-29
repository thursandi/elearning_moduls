<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>stmi.ac.id | <?php echo $data['title']; ?></title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta name="description" content="<?php echo $data['description']; ?>" />
   <meta name="keywords" content="<?php echo $data['keywords']; ?>" />

   <link rel="shortcut icon" href="<?=base_url();?>assets/img/stmi.ico">
   <link href="<?=base_url();?>assets/elearning_admin/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="<?=base_url();?>assets/elearning_admin/assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="<?=base_url();?>assets/elearning_admin/assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" />
   <link href="<?=base_url();?>assets/elearning_admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="<?=base_url();?>assets/elearning_admin/css/style.css" rel="stylesheet" />
   <link href="<?=base_url();?>assets/elearning_admin/css/style_responsive.css" rel="stylesheet" />
   <link href="<?=base_url();?>assets/elearning_admin/css/style_default.css" rel="stylesheet" id="style_color" />

   <link href="<?=base_url();?>assets/elearning_admin/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/elearning_admin/assets/uniform/css/uniform.default.css" />

<?php foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>

<?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
       


   <script type="text/javascript">
        <!-- 
            window.history.forward();
            function noBack(){ window.history.forward(); }
           
            -->
   </script>

</head>
<!-- END HEAD -->