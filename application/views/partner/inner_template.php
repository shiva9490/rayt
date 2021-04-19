<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?php echo sitedata("site_name");?> :: <?php echo $title;?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo $this->config->item('admin_assets');?>assets/img/logo.png"/>
    <link href="<?php echo $this->config->item('admin_assets');?>assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $this->config->item('admin_assets');?>assets/js/loader.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo $this->config->item('admin_assets');?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('admin_assets');?>assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $this->config->item('admin_assets');?>assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
	<?php if($this->uri->segment(1) !=""){?>
	<link href="<?php echo $this->config->item('admin_assets');?>assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/sweetalerts/promise-polyfill.js"></script>
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('admin_assets');?>assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
	<?php } if($this->uri->segment(2) =="Menu" || $this->uri->segment(2) =="Add-Items"){?>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('admin_assets');?>assets/css/forms/theme-checkbox-radio.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('admin_assets');?>assets/css/forms/switches.css">
	<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $this->config->item('admin_assets');?>assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/noUiSlider/custom-nouiSlider.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $this->config->item('admin_assets');?>plugins/bootstrap-range-Slider/bootstrap-slider.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('admin_assets');?>plugins/editors/quill/quill.snow.css">
    <link href="<?php echo $this->config->item('admin_assets');?>assets/css/apps/todolist.css" rel="stylesheet" type="text/css" />
	<?php } ?>
	<link href="<?php echo $this->config->item('admin_assets');?>assets/css/Partner.css" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen"> 
		<div class="loader"> 
			<div class="loader-content">
				<div class="spinner-grow align-self-center"></div>
			</div>
		</div>
	</div>
    <!--  END LOADER -->
	<?php $this->load->view('partner/header')?>
	<?php $this->load->view('partner/navbar')?>
     <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>
		<?php $this->load->view('partner/sidenav')?>        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
				<?php $this->load->view($content);?>
            </div>
            <?php $this->load->view('partner/footer')?>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Vertically Aligned</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-heading mb-4 mt-2">Aligned Center</h4>
                        <p class="modal-text">In hac habitasse platea dictumst. Proin sollicitudin et lacus in tincidunt. Integer nisl ex, sollicitudin eget nulla nec, pharetra lacinia nisl. Aenean nec nunc ex. Integer varius neque at dolor scelerisque porttitor.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo $this->config->item('admin_assets');?>assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>bootstrap/js/popper.min.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>assets/js/app.js"></script>
   
    <script src="<?php echo $this->config->item('admin_assets');?>assets/js/custom.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/apex/apexcharts.min.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>assets/js/dashboard/dash_1.js"></script>
	<?php if($this->uri->segment(1) !=""){?>
	<script src="<?php echo $this->config->item('admin_assets');?>assets/js/scrollspyNav.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/sweetalerts/custom-sweetalert.js"></script>
	<?php } if($this->uri->segment(2) =="Add-Items"){?>
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
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <script src="<?php echo $this->config->item('admin_assets');?>plugins/bootstrap-maxlength/custom-bs-maxlength.js"></script>
	<?php } if($this->uri->segment(2) =="Menu"){?>
		<script src="<?php echo $this->config->item('admin_assets');?>assets/js/ie11fix/fn.fix-padStart.js"></script>
		<script src="<?php echo $this->config->item('admin_assets');?>plugins/editors/quill/quill.js"></script>
		<script src="<?php echo $this->config->item('admin_assets');?>assets/js/apps/todoList.js"></script>
	<?php } ?>
	<script src="<?php echo $this->config->item('admin_assets');?>assets/js/rayt.js"></script>
</body>
</html>