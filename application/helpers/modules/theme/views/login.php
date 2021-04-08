<div class="login_section">
   <div class="login_form_wrapper">
      <div class="container">
         <div class="row">
            <div class="col-md-8 offset-md-2">
               <h1>LOGIN TO YOUR ACCOUNT</h1>
               <form method="post" class="lognnform">
                   <div class="login_wrapper">
                        <div class="formsix-pos">
                           <div class="form-group i-email">
                               <input type="text" class="form-control" name="mobileno" required="" id="email2" placeholder="Username*">
                           </div>
                        </div>
                        <div class="formsix-e">
                           <div class="form-group i-password">
                               <input type="password" minlength="5" maxlength="50" name="password" class="form-control" required="" id="password2" placeholder="Password *">
                           </div>
                        </div>
                        <div class="login_remember_box">
                           <label class="control control--checkbox">Remember me
                              <input type="checkbox">	<span class="control__indicator"></span>
                           </label>
                            <a href="<?php echo base_url("Forgot-Password");?>" class="forget_password">Forgot Password</a>
                        </div>
                        <div class="login_btn_wrapper"><button type="submit" class="btn btn-primary login_btn"> Login </butto`n></div>
                        <div class="login_message">
                           <p>Don’t have an account ? <a href="<?php echo base_url("/Register");?>"> Register Now </a></p>
                        </div>
                     </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>