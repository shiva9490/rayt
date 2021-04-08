<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
      <meta name="description" content=""/>
      <meta name="author" content=""/>
      <title><?php echo sitedata("site_name");?> :: <?php echo $title;?></title>
      <link rel="icon" href="<?php echo $this->config->item("tutorassets");?>images/favicon.ico" type="image/x-icon"/>
      <link href="<?php echo $this->config->item("tutorassets");?>plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
      <link href="<?php echo $this->config->item("tutorassets");?>plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
      <link href="<?php echo $this->config->item("tutorassets");?>css/bootstrap.min.css" rel="stylesheet"/>
      <link href="<?php echo $this->config->item("tutorassets");?>css/animate.css" rel="stylesheet" type="text/css"/>
      <link href="<?php echo $this->config->item("tutorassets");?>css/icons.css" rel="stylesheet" type="text/css"/>
      <link href="<?php echo $this->config->item("tutorassets");?>css/sidebar-menu.css" rel="stylesheet"/>
      <link href="<?php echo $this->config->item("tutorassets");?>css/app-style.css" rel="stylesheet"/>
      <link href="<?php echo $this->config->item("tutorassets");?>css/skins.css" rel="stylesheet"/>
      <link href="<?php echo $this->config->item("tutorassets");?>tutor.css" rel="stylesheet"/>
   </head>
   <body>
      <div id="wrapper"> 
         <?php $this->load->view("admin/sidebar");?>
         <?php $this->load->view("admin/header");?> 
         <div class="clearfix"></div>
         <div class="content-wrapper">
            <div class="container-fluid">
               <?php $this->load->view("$content");?> 
            </div>
         </div>
         <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
         <footer class="footer">
            <div class="container">
               <div class="text-center">
                  Copyright © 2020 <?php echo sitedata("site_name");?>
               </div>
            </div>
         </footer>
      </div>
      <script src="<?php echo $this->config->item("tutorassets");?>js/jquery.min.js"></script>
      <script src="<?php echo $this->config->item("tutorassets");?>js/popper.min.js"></script>
      <script src="<?php echo $this->config->item("tutorassets");?>js/bootstrap.min.js"></script>
      <script src="<?php echo $this->config->item("tutorassets");?>plugins/simplebar/js/simplebar.js"></script>
      <script src="<?php echo $this->config->item("tutorassets");?>js/sidebar-menu.js"></script>
      <script src="<?php echo $this->config->item("tutorassets");?>js/jquery.loading-indicator.js"></script>
      <script src="<?php echo $this->config->item("tutorassets");?>js/app-script.js"></script>
      <?php if($this->uri->segment('2') == 'Dashboard'){ ?>
      <script src="<?php echo $this->config->item("tutorassets");?>plugins/Chart.js/Chart.min.js"></script>
      <script src="<?php echo $this->config->item("tutorassets");?>plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
      <script src="<?php echo $this->config->item("tutorassets");?>plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
      <script src="<?php echo $this->config->item("tutorassets");?>plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
      <script src="<?php echo $this->config->item("tutorassets");?>plugins/sparkline-charts/jquery.sparkline.min.js"></script>
      <script src="<?php echo $this->config->item("tutorassets");?>plugins/jquery-knob/excanvas.js"></script>
      <script src="<?php echo $this->config->item("tutorassets");?>plugins/jquery-knob/jquery.knob.js"></script>
      <script>
         $(function() {
             $(".knob").knob();
         });
      </script>
      <script src="<?php echo $this->config->item("tutorassets");?>js/index.js"></script>
       <?php } ?>
        <script src="<?php echo $this->config->item("tutorassets");?>plugins/jquery-validation/js/jquery.validate.min.js"></script>
        <script src="<?php echo $this->config->item("tutorassets");?>plugins/alerts-boxes/js/sweetalert.min.js"></script>
        <script src="<?php echo $this->config->item("tutorassets");?>plugins/notifications/js/lobibox.min.js"></script>
        <script src="<?php echo $this->config->item("tutorassets");?>plugins/notifications/js/notifications.min.js"></script>
        <script src="<?php echo $this->config->item("tutorassets");?>tutor.js"></script>
        <script> 
         var adminurl    =   '/<?php echo sitedata("site_admin");?>';
         function ajacdah(){
             $('.pageloaderwrapper').show();
             $.post(adminurl+"/Ajax-Dashboard",function(data){ 
                 $(".ajax_dash").html(data);
                 $('.pageloaderwrapper').show();
             }); 
         }  
         <?php if($this->uri->segment('2') == 'Dashboard'){ ?>
                 ajacdah(); 
         <?php } ?>
         var uri     =   '<?php echo $this->uri->segment('2');?>';
         $("."+uri+"-show").addClass("active");
         $("."+uri+"-show").addClass("open");
         $("."+uri).addClass("active");  
      </script>
   </body>
</html>