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
                <div class="card-title text-uppercase text-center pb-3 pt-3">Reset Password</div>
                <p class="text-center pb-2">Please enter your email address. You will receive a link to create a new password via email.</p>
                <form action="" method="post">
                    <div class="form-group">
                        <div class="position-relative has-icon-left">
                            <label for="exampleInputUsername" class="sr-only">Email Address</label>
                            <input type="text" id="exampleInputUsername" name="emailid" value="<?php echo set_value("emailid");?>" class="form-control  text-capitalize" placeholder="Email Address">
                            <div class="form-control-position">
                                <i class="icon-user"></i>
                            </div>
                        </div>
                        <?php echo form_error('emailid');?>
                    </div>
                    <button type="submit" name="submit" value="Login" class="btn btn-primary btn-block waves-effect waves-light">Reset Password</button>
                    <div class="clearfix"></div>
                    <div class="text-center pt-3"><hr>
                        <p class="text-dark">Return to the <a href="<?php echo adminurl("Login");?>"> Sign In</a></p>
                    </div>
                </form>
             </div>
          </div>
       </div>
    </div>
 </div>