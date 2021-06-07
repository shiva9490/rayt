<div class="row layout-top-spacing">
	<div id="fuSingleFile" class="col-lg-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
				<div class="container-fluid py-3 pt-4 bb-grey sticky">
					<div class="row">
						<div class="col-md-2">
							<a href="<?php echo adminurl('Users');?>">
							<i class="fa fa-arrow-left" aria-hidden="true"></i></a>
						</div>
						<div class="col-md-6">
							<h4><?php echo $title;?></h4>
						</div>
						<div class="col-md-3 d-flex justify-content-between ml-3">
							<a href="<?php echo adminurl('Users');?>" class="btn btn-danger"> Cancel</a>
							<button type="submit" class="btn btn-primary" name="publish" value="publish"/>publish</button>
						</div>
					</div>
				</div>
				<div class="container-fluid py-3 pt-4">
					<?php $this->load->view('admin/success_error');?>
					<div class="row">
						<div class="col-md-8 mx-auto box-shaow">
							<!--<h5>English</h5>-->
							<div class="row bb-grey">
								<div class="col-md-12 m-3">
									<label for="Resturantname" >User Name *</label>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group b-grey">											
												<input type="text" class="form-control width-100"  id="user_name" name="user_name" value="<?php echo $view['user_name'];?>" placeholder="Enter Resturant Name" required>
												<div class="invalid-feedback">
													Please provide a valid user Name.
												</div>
											</div>								
										</div>
									</div>								
									<span class="text-danger"><?php echo form_error('user_name'); ?></span>
								</div>								
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label >Password *</label>
										<div class="input-group mb-4" id="show_hide_password">                                
											<input type="password" class="form-control" name="user_password" placeholder="Enter Password" value="<?php echo base64_decode($view['login_password']); ?>" required >
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="far fa-eye-slash" aria-hidden="true"></i></span>
											</div>                                                   
                                        </div>									
										<div class="invalid-feedback">
											Please provide a valid Password.
										</div>
									</div>
								</div>							
							</div>							
							<div class="row bb-grey">
								<div class="col-md-12 m-3">
									<label>Email address *</label>
									<div class="form-group b-grey">
									
										<input type="email" class="form-control" name="user_email" placeholder="Enter Email" value="<?php echo $view['user_email'];?>" required/>
										<div class="invalid-feedback">
											Please provide a valid Email.
										</div>
									</div>
								</div>							
								<div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label>Contact No *</label>
										<input type="text" class="form-control"  name="user_phone" value="<?php echo $view['user_phone'];?>" placeholder="Enter Contact number" required />
										<div class="invalid-feedback">
											Please provide a valid  Contact No.
										</div>
									</div>
								</div>
                                <div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label>Joining date *</label>
                                        <input  id="basicFlatpickr"  class="form-control flatpickr flatpickr-input active basicFlatpickr" type="text"  placeholder="Enter Joining date" name="user_joining" value="<?php echo $view['user_joining'];?>" required />
										<div class="invalid-feedback">
											Please provide a valid  Joining date.
										</div>
									</div>
								</div>
                                <div class="col-md-12 m-3">
									<div class="form-group b-grey">
										<label>Role *</label>
                                        <select name="user_role" class="form-control">
                                            <option>Select Role</option>
                                            <?php
                                            	$params["all_uid"]   =   "ut_acde = 'Active'";                                          
                                             $role=  $this->role_model->view_role($params);
                                              foreach($role as $rl){                                            
                                            ?>
                                            <option value="<?php echo $rl->ut_id; ?>" <?php if($rl->ut_id == $view['user_role'] ){echo 'selected'; }?>><?php echo $rl->ut_name;?></option>
                                            <?php } ?>
                                        </select>									
										<div class="invalid-feedback">
											Please provide a valid Role.
										</div>
									</div>
								</div>
							</div>
							<div class="row bb-grey">
								<div class="col-md-12 m-3">
									<label>Experience *</label>
									<div class="form-group b-grey">
										<input type="text" class="form-control "  name="user_experience" value="<?php echo $view['user_experience'];?>" placeholder="Experience"  required />
										<div class="invalid-feedback">
											Please provide a valid Experience.
										</div>										
									</div>
								</div>							
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>