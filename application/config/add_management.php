        	<!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
               <div class="col-sm-9">
		            <h4 class="page-title">Form Input</h4>
		            <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javaScript:void();">Dashtreme</a></li>
                       <li class="breadcrumb-item active" aria-current="page"><?php echo $title?></li>
                    </ol>
	            </div>
            </div>
            <!-- End Breadcrumb-->

	        <form class="add-medium validform" method="post" novalidate="novalidate">
			    <div class="card height-auto">
    			    <div class="card-body">
    				    <div class="row">
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>First Name *</label>
    						<input type="hidden" value="Management" name="type">
    						<input type="text" name="teacher_fstname" value="<?php echo set_value('teacher_fstname')?>" placeholder="staff first name (max. 50 characters)" class="form-control" required>
    						<?php echo form_error('teacher_fstname'); ?>
    					</div>
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>Surname / Initial*</label>
    						<input type="text" name="teacher_surname" value="<?php echo set_value('teacher_surname')?>" placeholder="surname / initial (max. 50 characters)" class="form-control" required>
    						<?php echo form_error('teacher_surname'); ?>
    					</div>
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>Active Status</label>
    						<input type="radio" value="Active" name="teacher_status" checked> Active
    						<input type="radio" value="Deactive" name="teacher_status" > Inactive
    						<?php echo form_error('teacher_status'); ?>
    					</div>
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>Gender *</label>
    						<select class="select2 form-control" name="teacher_gender" required>
    							<option value="">Please Select Gender *</option>
    							<?php 
        							$gender    =   $this->config->item("gender");
                                    foreach($gender as $ce){
                                ?>
                                <option value="<?php echo $ce;?>" <?php echo (set_value('teacher_gender') == $ce)?"selected='selected'":'';?>><?php echo $ce;?></option>
                                <?php } ?> 
    						</select>
    						<?php echo form_error('teacher_gender'); ?>
    					</div>
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>Date Of Birth *</label>
    						<input type="date" placeholder="dd/mm/yyyy" name="teacher_dob" value="<?php echo set_value('teacher_dob')?>" max="<?php echo date('Y-m-d H:i:s');?>" class="form-control " required>
    						<i class="far fa-calendar-alt"></i>
    						<?php echo form_error('teacher_dob'); ?>
    					</div>
    					
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>Blood Group *</label>
    						<select class="select2 form-control" name="teacher_bloodgroup" required>
    							<option value="">Please Select Group *</option>
    							<?php 
        							$gender    =   $this->config->item("bloodgroup");
                                    foreach($gender as $bl){
                                ?>
                                <option value="<?php echo $bl;?>" <?php echo set_select('teacher_bloodgroup', $bl);?>><?php echo $bl;?></option>
                                <?php } ?> 
    						</select>
    						<?php echo form_error('teacher_bloodgroup'); ?>
    					</div>
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>Marital Status*</label>
    						<select class="select2 form-control" name="teacher_marital" required>
    							<option value="">Please Select Marital Status</option>
    							<?php 
        							$gender    =   $this->config->item("marital_status");
                                    foreach($gender as $ms){
                                ?>
                                <option value="<?php echo $ms;?>" <?php echo set_select('teacher_marital' , $ms);?>><?php echo $ms;?></option>
                                <?php } ?>
    						</select>
    						<?php echo form_error('teacher_marital'); ?>
    					</div>
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>Anniversary Date </label>
    						<input type="text" placeholder="dd/mm/yyyy" id="default-datepicker" name="teacher_anniversary" value="<?php echo set_value('teacher_anniversary')?>" class="form-control air-datepicker">
    						<i class="far fa-calendar-alt"></i>
    						<?php echo form_error('teacher_anniversary'); ?>
    					</div>
    					
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>Spouse Name</label>
    						<input type="text" placeholder="Spouse Name" name="teacher_Spouse_name" value="<?php echo set_value('teacher_Spouse_name')?>" class="form-control">
    						<?php echo form_error('teacher_Spouse_name'); ?>
    					</div>
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>Religion *</label>
    						<select class="select2 form-control" name="teacher_religion" required>
    							<option value="">Please Select Religion *</option>
    							<?php if(is_array($religionlist) && count($religionlist) >0){
    							    foreach($religionlist as $re){
    							?>
    							<option value="<?php echo $re->religion_id;?>" <?php echo set_select('teacher_religion' , $re->religion_id);?>><?php echo $re->religion_name;?></option>
    							<?php } }?>
    						</select>
    						<?php echo form_error('teacher_religion'); ?>
    					</div>
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>Caste *</label>
    						<select class="select2 form-control" name="teacher_caste" required>
    							<option value="">--Select Caste--</option>
    							<?php if(is_array($castes) && count($castes) >0){
    							    foreach($castes as $cs){
    							?>
    							<option value="<?php echo $cs->caste_id;?>" <?php echo set_select('teacher_caste', $cs->caste_id);?>><?php echo $cs->caste_name;?></option>
    							<?php } }?>
    						</select>
    						<?php echo form_error('teacher_caste'); ?>
    					</div>
    					
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>Nationality</label>
    						<?php $natu = $this->pincode_model->viewnationality();?>
    						<select class="select2 form-control" name="teacher_nationality">
    							<option value="">Please Select Nationality</option>
    							<?php
                                    foreach($natu as $nl){
                                ?>
                                <option value="<?php echo $nl->countryid;?>" <?php echo set_select('teacher_nationality' , $nl->countryid);?>><?php echo $nl->country_name;?></option>
                                <?php } ?>
    						</select>
    						<?php echo form_error('teacher_nationality'); ?>
    					</div>
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>Mother Tongue</label>
    						<select class="select2 form-control" name="teacher_mother_tongue">
    							<option value="">Please Select Mother Tongue</option>
    							<?php if(is_array($mothertongue) && count($mothertongue) >0){
    							    foreach($mothertongue as $mt){
    							?>
    							<option value="<?php echo $mt->mothertongue_id;?>" <?php echo set_select('teacher_mother_tongue', $mt->mothertongue_id);?>><?php echo $mt->mother_tongue;?></option>
    							<?php } }?>
    						</select>
    						<?php echo form_error('teacher_mother_tongue'); ?>
    					</div>
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>Aadhar Card number </label>
    						<input type="text" placeholder="AADHAR card number" name="teacher_aadhar" value="<?php echo set_value('teacher_aadhar');?>" data-type="adhaar-number" maxLength="19" class="form-control">
    						<?php echo form_error('teacher_aadhar'); ?>
    					</div>
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>PAN card number </label>
    						<input type="text" placeholder="PAN card number" value="<?php echo set_value('teacher_pancard');?>" name="teacher_pancard" maxLength="10" class="form-control pan">
    						<?php echo form_error('teacher_pancard'); ?>
    					</div>
    					<!--
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>Kid Studying in School</label>
    						<select class="select2 form-control">
    							<option value="">Please Select Student</option>
    						</select>
    					</div>
    					<div class="col-xl-4 col-lg-6 col-12 form-group">
    						<label>Assigned Activity</label>
    						<select class="select2 form-control">
    							<option value="">Please Select Activity</option>
    						</select>
    					</div>-->
    				</div>
    				</div>
				</div>
				<br>
				<div class="card height-auto">
				    <div class="card-body">
        				<div class="item-title">
        					<h3>Contact Information</h3>
        				</div>	
        				<div class="row">
        				    <div class="col-xl-6 col-lg-6 col-12 form-group">
        						<label> Mobile No *</label>
        						<input type="text" name="teacher_mobile" value="<?php echo set_value('teacher_mobile');?>" placeholder="Primary Contact No (To send alerts & notifications)" class="form-control mobile" onkeypress="return onlyNumberKey(event)" required>
        						<?php echo form_error('teacher_mobile'); ?>
        					</div>
        					<div class="col-xl-6 col-lg-6 col-12 form-group">
        						<label>Emergency Contact No *</label>
        						<input type="text" name="teacher_emergency_contact" value="<?php echo set_value('teacher_emergency_contact');?>" onkeypress="return onlyNumberKey(event)" placeholder="Emergency Contact No (with STD code if landline)" class="form-control cmobile" required>
        						<?php echo form_error('teacher_emergency_contact'); ?>
        					</div>
        					
        					<div class="col-xl-6 col-lg-6 col-12 form-group">
        						<label>E-Mail *</label>
        						<input type="email" name="teacher_email" value="<?php echo set_value('teacher_email');?>" placeholder="Primary Email ID  (To send alerts & notifications)" class="form-control" required>
        						<?php echo form_error('teacher_email'); ?>
        					</div>
        					<div class="col-xl-6 col-lg-6 col-12 form-group">
        						<label>Alternate Email ID</label>
        						<input type="email" name="teacher_alternate_email" value="<?php echo set_value('teacher_alternate_email');?>" placeholder="Alternate Email ID" class="form-control">
        						<?php echo form_error('teacher_alternate_email'); ?>
        					</div>
        					<div class="col-12 form-group mg-t-8">
        						<button type="submit" name="submit" value="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
        						<button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
        					</div>
        				</div>
    			    </div>
    			</div><br>
    		</form>
	