<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?php echo sitedata("site_name");?> :: <?php echo $title;?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url().'upload/favrayt.png';?>"/>
    <link href="<?php echo $this->config->item('admin_assets');?>assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $this->config->item('admin_assets');?>assets/js/loader.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo $this->config->item('admin_assets');?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('admin_assets');?>assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $this->config->item('admin_assets');?>assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/users/account-setting.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/dropify/dropify.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $this->config->item('admin_assets');?>assets/css/dashboard.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $this->config->item('admin_assets');?>assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/forms/switches.css" rel="stylesheet" type="text/css">
     <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets');?>plugins/font-icons/fontawesome/css/regular.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets');?>plugins/font-icons/fontawesome/css/fontawesome.css">

	<?php if($this->uri->segment(1) !=""){?>
	<link href="<?php echo $this->config->item('admin_assets');?>assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/sweetalerts/promise-polyfill.js"></script>
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('admin_assets');?>assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
	<?php } if($this->uri->segment(2) =="Add-Res-Image-Doc" || $this->uri->segment(2) =="Update-Res-Image-Doc" || $this->uri->segment(2) =="Update-Resturant-Document" || $this->uri->segment(2) =="Create-Resturant" || $this->uri->segment(2) =="Update-Resturant" || $this->uri->segment(2) =="Create-Drivers"  || $this->uri->segment(2) =="Update-Driver" || $this->uri->segment(2) =="Banner" 
	        || $this->uri->segment(2) =="Update-Banner" || $this->uri->segment(2) =="Resturant-Banner" || $this->uri->segment(2) =="Update-Resturant-Banner" || $this->uri->segment(2) =="Update-Dri-Image-Doc" || $this->uri->segment(2) =="Add-Dri-Image-Doc" || $this->uri->segment(2) =="Add-Items" || $this->uri->segment(2) =="Update-Items" || $this->uri->segment(2) =="Create-Users" || $this->uri->segment(2) =="Update-Users" || $this->uri->segment(2) =="Update-Cuisine" || $this->uri->segment(2) =="Cuisine"){?>
	<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $this->config->item('admin_assets');?>assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/noUiSlider/custom-nouiSlider.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/bootstrap-range-Slider/bootstrap-slider.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('admin_assets');?>plugins/select2/select2.min.css">
    <link href="<?php echo $this->config->item('admin_assets');?>assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
	<?php }if($this->uri->segment(2) =="Orders"){ ?>
	  <link href="<?php echo $this->config->item('admin_assets');?>assets/css/components/tabs-accordian/custom-tabs.css" rel="stylesheet" type="text/css" />
	 <?php }if($this->uri->segment(2) =="Menus"){ ?>
	 <link href="<?php echo $this->config->item('admin_assets');?>assets/css/apps/todolist.css" rel="stylesheet" type="text/css" />
	 <?php } ?>
	 	<link href="<?php echo $this->config->item('admin_assets');?>assets/css/custom.css" rel="stylesheet" type="text/css" />
	 <style>
    #snackbar {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 17px;
    }

    #snackbar.show {
      visibility: visible;
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @-webkit-keyframes fadein {
      from {bottom: 0; opacity: 0;} 
      to {bottom: 30px; opacity: 1;}
    }

    @keyframes fadein {
      from {bottom: 0; opacity: 0;}
      to {bottom: 30px; opacity: 1;}
    }
    
    @-webkit-keyframes fadeout {
      from {bottom: 30px; opacity: 1;} 
      to {bottom: 0; opacity: 0;}
    }
    
    @keyframes fadeout {
      from {bottom: 30px; opacity: 1;}
      to {bottom: 0; opacity: 0;}
    }
</style>

</head>
<body>
    <style>
        #map {
    	  height: 100%;
    	}
    </style>
    <!-- BEGIN LOADER -->
    <div id="load_screen"> 
		<div class="loader"> 
			<div class="loader-content">
				<div class="spinner-grow align-self-center"></div>
			</div>
		</div>
	</div>
    <!--  END LOADER -->
	<?php $this->load->view('admin/header')?>
	<?php $this->load->view('admin/navbar')?>
     <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>
		<?php $this->load->view('admin/sidenav')?>        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
				<?php $this->load->view($content);?>
            </div>
            <?php $this->load->view('admin/footer')?>
        </div>
    </div>
      <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md " role="document">
            <div class="modal-content pinkey pt-4 pb-4 pl-4 pr-4">

            </div>           	                                                                             
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content datas">
                
            </div>
        </div>
    </div>
    <div class="modal right fade orderModel" id="myModal" data-backdrop="static" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content orderModel">
                      
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lgs" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content addon">
                
            </div>
        </div>
    </div>
    <div class="modal right fade resturantModel" id="myModal" data-backdrop="static" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content resturantModel">
                      
            </div>
        </div>
    </div>
    <div id="snackbar"></div>
    <div id="snackbars">Some text some message..</div>
    <div class="modal right fade itemModel" id="myModal" data-backdrop="static" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content itemModel">
                      
            </div>
        </div>
    </div>
    <script>
    function copy(element){
      var copyText = $('.copy'+element).attr('data-tap'+element).select();
      copyText.setSelectionRange(0, 99999);
      document.execCommand("copy");
      alert("Copied the text: " + copyText.value);
    }
    </script>
    <script src="<?php echo $this->config->item('admin_assets');?>assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>bootstrap/js/popper.min.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>assets/js/app.js"></script>
     <script src="<?php echo $this->config->item('admin_assets');?>plugins/users/account-settings.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/dropify/dropify.min.js"></script>
    <?php if($this->uri->segment(2) !="New-Zone"){?>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="<?php echo $this->config->item('admin_assets');?>assets/js/custom.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/apex/apexcharts.min.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>assets/js/dashboard/dash_1.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>assets/js/scrollspyNav.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/sweetalerts/custom-sweetalert.js"></script>
	<?php }else if($this->uri->segment(1) !=""){?>
    <?php } if($this->uri->segment(2) =="Add-Res-Image-Doc" || $this->uri->segment(2) =="Update-Res-Image-Doc" || $this->uri->segment(2) =="Update-Resturant-Document" || $this->uri->segment(2) =="Create-Resturant" || $this->uri->segment(2) =="Update-Resturant" || $this->uri->segment(2) =="Create-Drivers" || $this->uri->segment(2) =="Update-Driver" || $this->uri->segment(2) =="Banner" || $this->uri->segment(2) =="Update-Banner" || $this->uri->segment(2) =="Resturant-Banner" || $this->uri->segment(2) =="Update-Resturant-Banner" || $this->uri->segment(2) =="Update-Dri-Image-Doc" || $this->uri->segment(2) =="Add-Dri-Image-Doc"|| $this->uri->segment(2) =="Add-Items"|| $this->uri->segment(2) =="Update-Items" || $this->uri->segment(2) =="Create-Users" || $this->uri->segment(2) =="Update-Users" || $this->uri->segment(2) =="Update-Cuisine" || $this->uri->segment(2) =="Cuisine"){?>
	<script src="<?php echo $this->config->item('admin_assets');?>plugins/file-upload/file-upload-with-preview.min.js"></script>
	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        //First upload
        var firstUpload = new FileUploadWithPreview('myFirstImage')
        //Second upload
        var secondUpload = new FileUploadWithPreview('mySecondImage')
		//3rd upload
        var threeUpload = new FileUploadWithPreview('mythreeImage')
    </script>
	 <script>
        $('#timepicker0').timepicker({
            uiLibrary: 'bootstrap4'
        });
		$('#timepicker1').timepicker({
            uiLibrary: 'bootstrap4'
        });
		$('#timepicker2').timepicker({
            uiLibrary: 'bootstrap4'
        });
		$('#timepicker3').timepicker({
            uiLibrary: 'bootstrap4'
        });
		$('#timepicker4').timepicker({
            uiLibrary: 'bootstrap4'
        });
		$('#timepicker5').timepicker({
            uiLibrary: 'bootstrap4'
        });
		$('#timepicker6').timepicker({
            uiLibrary: 'bootstrap4'
        });
       	$('#timepicker7').timepicker({
            uiLibrary: 'bootstrap4'
        });
		
		$('#timepicker10').timepicker({
            uiLibrary: 'bootstrap4'
        });
		$('#timepicker11').timepicker({
            uiLibrary: 'bootstrap4'
        });
		$('#timepicker12').timepicker({
            uiLibrary: 'bootstrap4'
        });
		$('#timepicker13').timepicker({
            uiLibrary: 'bootstrap4'
        });
		$('#timepicker14').timepicker({
            uiLibrary: 'bootstrap4'
        });
		$('#timepicker15').timepicker({
            uiLibrary: 'bootstrap4'
        });
		$('#timepicker16').timepicker({
            uiLibrary: 'bootstrap4'
        });
        $('#timepicker17').timepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
    <script>
		window.addEventListener('load', function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
			  form.addEventListener('submit', function(event) {
				if (form.checkValidity() === false) {
				  event.preventDefault();
				  event.stopPropagation();
				}
				form.classList.add('was-validated');
			  }, false);
			});
		}, false);
    </script>
	<script src="<?php echo $this->config->item('admin_assets');?>assets/js/scrollspyNav.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/flatpickr/flatpickr.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/noUiSlider/nouislider.min.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/flatpickr/custom-flatpickr.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/noUiSlider/custom-nouiSlider.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/select2/select2.min.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/select2/custom-select2.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>assets/js/authentication/form-2.js"></script>
	<?php }if($this->uri->segment(2) == "Zones"){?>
	<script>
        function initMap() {
            var macc = {lat: 29.378586, lng: 47.990341};
            var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 15, center: macc});
            var marker = new google.maps.Marker({position: macc, map: map});
        }
     </script>
	<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBe-HPCsy9e136sYKeO549pu3Zj8GytkXI&callback=initMap&libraries=&v=weekly"
      async
    ></script>
    <?php }if($this->uri->segment(2) == "Update-Items"){?>
    <script>
        addons();
    </script>
     
    <?php }elseif($this->uri->segment(2) == "Orders"){?>
    <script>
        function OrderRefresh(){
            url = $('#urlvalue').val();
            searchFilter('',url,'');
            counts();
        }
    </script>
    <?php }elseif($this->uri->segment(2) == "Driver-Details"){?>
    <script>
        $(function(){
            updatedriloca();
        });
    </script>
    <?php } ?>
	<script src="<?php echo $this->config->item('admin_assets');?>assets/js/rayt.js"></script>
	 <script>
        $(document).ready(function() {
            $("#show_hide_password span").on('click', function(event) {           
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });
        });
</script>
    <script>
    function timeFunction() {     
        if ($("#same").is(':checked')){  
                   
            var start = $('.pristrtime0').val();
            var end   = $('.priendtime0').val();      
            for (i = 1; i <= 6 ; i++) {
                $('.pristrtime'+i).val(start);
                $('.priendtime'+i).val(end);   
            }
         }
         else{
            for (i = 0; i <= 6 ; i++) {
                $('.pristrtime'+i).val('');
                $('.priendtime'+i).val('');   
            }
         }
    }
</script>
<script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'page-description' );  
</script>
</body>
</html>