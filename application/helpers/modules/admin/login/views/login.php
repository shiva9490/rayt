 <div class="card-authentication2 mx-auto my-5">
    <div class="card-group">
       <div class="card mb-0">
          <div class="bg-signin2"></div>
          <div class="card-img-overlay rounded-left my-5">
<!--             <h2 class="text-white">Lorem</h2>
             <h1 class="text-white">Ipsum Dolor</h1>
             <p class="card-text text-white pt-3">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>-->
          </div>
       </div>
       <div class="card mb-0 ">
          <div class="card-body">
             <div class="card-content p-3">
                <div class="text-center">
                   <img src="<?php echo $this->config->item("tutorassets");?><?php echo sitedata("site_logo");?>" alt="<?php echo sitedata("site_name");?>">
                </div>
                <div class="card-title text-uppercase text-center py-3 pt-3">Sign In</div>
                <?php $this->load->view("admin/success_error");?>
                <form action="" method="post" class="fromvalue">
                   <div class="form-group">
                      <div class="position-relative has-icon-left">
                         <label for="exampleInputUsername" class="sr-only">Username</label>
                         <input type="text" id="exampleInputUsername" name="username" value="<?php echo set_value("username");?>" class="form-control username text-capitalize" placeholder="Username">
                         <div class="form-control-position">
                            <i class="icon-user"></i>
                         </div>
                      </div>
                       <?php echo form_error('emailid');?>
                   </div>
                   <div class="form-group">
                      <div class="position-relative has-icon-left">
                         <label for="exampleInputPassword" class="sr-only">Password</label>
                         <input type="password" id="exampleInputPassword" name="password" minlength="5" maxlength="50" class="form-control" placeholder="Password">
                         <div class="form-control-position">
                            <i class="icon-lock"></i>
                         </div>
                      </div>
                       <?php echo form_error('password');?>
                   </div>
                   <div class="form-row mr-0 ml-0">
                      <div class="form-group col-6">
<!--                                 <div class="icheck-material-primary">
                            <input type="checkbox" id="user-checkbox" checked="" />
                            <label for="user-checkbox">Remember me</label>
                         </div>-->
                      </div>
                      <div class="form-group col-6 text-right">
                         <a href="<?php echo adminurl("Forgot-Password");?>">Reset Password</a>
                      </div>
                   </div>
                    <button type="submit" name="submit" value="Login" class="btn btn-primary btn-block waves-effect waves-light">Sign In</button>
                </form>
             </div>
          </div>
       </div>
    </div>
 </div>