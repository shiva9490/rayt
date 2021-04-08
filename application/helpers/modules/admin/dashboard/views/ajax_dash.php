<!--Start Dashboard Content-->
<div class="row mt-3">
   <div class="col-12 col-lg-6 col-xl-3">
      <div class="card gradient-deepblue">
         <div class="card-body">
            <h5 class="text-white mb-0">
                <?php 
                $pmsd["whereCondition"]     =   "register_usertype = 'Student'";
                $csb  =   $this->api_model->cntviewRegister($pmsd);
                echo $csb;
                ?>
                <span class="float-right"><i class="zmdi zmdi-account-circle"></i></span></h5>
            <div class="progress my-3" style="height:3px;">
               <div class="progress-bar" style="width:55%"></div>
            </div>
            <p class="mb-0 text-white small-font">Total Students</p>
         </div>
      </div>
   </div>
   <div class="col-12 col-lg-6 col-xl-3">
      <div class="card gradient-orange">
         <div class="card-body">
            <h5 class="text-white mb-0">
                <?php 
                $pmsd["whereCondition"]     =   "register_usertype = 'Teacher'";
                $csb  =   $this->api_model->cntviewRegister($pmsd);
                echo $csb;
                ?>
                <span class="float-right"><i class="fa fa-users"></i></span></h5>
            <div class="progress my-3" style="height:3px;">
               <div class="progress-bar" style="width:55%"></div>
            </div>
            <p class="mb-0 text-white small-font">Total Teachers</p>
         </div>
      </div>
   </div>
   <div class="col-12 col-lg-6 col-xl-3">
      <div class="card gradient-ohhappiness">
         <div class="card-body">
            <h5 class="text-white mb-0">
                <?php 
                $pmsd["whereCondition"]     =   "register_usertype = 'Teacher'";
                $csb  =   $this->api_model->cntviewRegister($pmsd);
                echo $csb;
                ?>
                <span class="float-right"><i class="fa fa-inr"></i></span></h5>
            <div class="progress my-3" style="height:3px;">
               <div class="progress-bar" style="width:55%"></div>
            </div>
            <p class="mb-0 text-white small-font">Total Revenue </p>
         </div>
      </div>
   </div>
   <div class="col-12 col-lg-6 col-xl-3">
      <div class="card gradient-ibiza">
         <div class="card-body">
            <h5 class="text-white mb-0">
                <?php  
                $csb  =   $this->package_model->cntviewPackage();
                echo $csb;
                ?>
                <span class="float-right"><i class="fa fa-tags"></i></span></h5>
            <div class="progress my-3" style="height:3px;">
               <div class="progress-bar" style="width:55%"></div>
            </div>
            <p class="mb-0 text-white small-font">Packages</p>
         </div>
      </div>
   </div>
</div>
<div class="overlay toggle-menu"></div>