<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
      <meta name="description" content=""/>
      <meta name="author" content=""/>
      <title><?php echo sitedata("site_name");?> :: <?php echo $title;?></title>
		<link rel="icon" type="image/x-icon" href="<?php echo base_url().'upload/favrayt.png';?>"/>
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
		<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
		<link href="<?php echo $this->config->item('admin_assets');?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $this->config->item('admin_assets');?>assets/css/plugins.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $this->config->item('admin_assets');?>assets/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
		<!-- END GLOBAL MANDATORY STYLES -->
		<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('admin_assets');?>assets/css/forms/theme-checkbox-radio.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('admin_assets');?>assets/css/forms/switches.css">   </head>
   <body>
        <div id="pageloader-overlay" class="visible incoming">
            <div class="loader-wrapper-outer">
                <div class="loader-wrapper-inner" >
                    <div class="loader"></div>
                </div>
            </div>
        </div>
        <div id="wrapper">
            <?php $this->load->view($content);?>
            <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        </div>
		<script src="<?php echo $this->config->item('admin_assets');?>assets/js/libs/jquery-3.1.1.min.js"></script>
		<script src="<?php echo $this->config->item('admin_assets');?>bootstrap/js/popper.min.js"></script>
		<script src="<?php echo $this->config->item('admin_assets');?>bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo $this->config->item('admin_assets');?>assets/js/authentication/form-1.js"></script>
		<script src="<?php echo $this->config->item('admin_assets');?>assets/js/forms/bootstrap_validation/bs_validation_script.js"></script>
        <script>
            $(function() {
                $(".fromvalue").validate({
                    rules: {
                        username:{
                            required:true, 
                            remote:{
                                url:"/Ajax-User-Exist",
                                type:"post",
                                data:{
                                    username:function(){
                                        return  $(".username").val();
                                    }
                                }
                            }
                        },
                        email_id:{
                            required:true,
                            email:true,
                            remote:{
                                url:"/Ajax-User-Email",
                                type:"post",
                                data:{
                                    emailid:function(){
                                        return  $(".emailid").val();
                                    }
                                }
                            }
                        },
                        password: {
                            required: true,
                            minlength: 5
                        }
                    },
                    messages: {
                        username: {
                            required: "Please enter a username/Email Id",
                            remote: jQuery.validator.format('<span class="text-success">"{0}"</span> : Username does not exists.')
                        },
                        password: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 5 characters long"
                        }
                    }
                });

            });
    </script>
    </body>
</html>