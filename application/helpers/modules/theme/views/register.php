<div class="login_section">
   <div class="login_form_wrapper">
      <div class="container">
         <div class="row">
            <div class="col-md-8 offset-md-2">
               <h1>Register TO YOUR ACCOUNT</h1>
               <form class="validdfrom" method="post" novalidate="">
                   <div class="login_wrapper">
                        <div class="formsix-e">
                            <div class="form-group">
                                <label><input type="radio" name="usertype" required="" value="Student" id="radio2" checked="checked"/> Student</label>
                                <label><input type="radio" required="" name="usertype" value="Teacher" id="radio2"/> Teacher</label>
                            </div>
                        </div>
                      <div class="formsix-e">
                         <div class="form-group">
                             <input type="text" class="form-control input_char" required="" id="fname" name="fullname" placeholder="Full Name *">
                         </div>
                      </div>
                      <div class="formsix-e">
                         <div class="form-group">
                             <input type="text" class="form-control mobileno input_num" minlength="10" maxlength="15" required="" id="mobileno" name="mobileno" placeholder="Mobile *">
                         </div>
                      </div>
                      <div class="formsix-e">
                         <div class="form-group">
                             <input type="email" class="form-control emailid" required="" id="emaildid" name="emailid" placeholder="Email *">
                         </div>
                      </div>
                      <div class="formsix-e">
                         <div class="form-group">
                             <input type="password" class="form-control" required="" name="password" id="password2" minlength="5" maxlength="50" placeholder="Password *">
                         </div>
                      </div>
                      <div class="formsix-e">
                         <div class="form-group">
                             <input type="password" class="form-control" name="conpassword" minlength="5" maxlength="50" required="" id="conpassword" placeholder="Re-enter Password *">
                         </div>
                      </div>
                      <div class="formsix-e">
                         <div class="form-group">
                             <input type="text" class="form-control" name="country" required="" id="country" placeholder="Type here for Country *" onkeyup="cusountry($(this))">
                             <input type="hidden" name="countryid" class="cutnryid"/>
                         </div>
                      </div>
                      <div class="login_remember_box">
                         <label class="control control--checkbox">I agreed to the Terms and Conditions.
                             <input type="checkbox" name="readagree" required="" value="1"><span class="control__indicator"></span>
                         </label>
                      </div>
                      <div class="login_btn_wrapper"><button type="submit" class="btn btn-primary login_btn"> Register Now </button></div>
                      <div class="login_message">
                         <p>Don’t have an account ? <a href="<?php echo base_url("Login");?>"> LogIn </a></p>
                      </div>
                   </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- /.login_form_wrapper-->
</div>