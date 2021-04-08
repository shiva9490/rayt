<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Budget Amount <span class="text-danger">*</span></label>
            <input type="text" name="student_budget" class="form-control input_geo" placeholder="Budget Amount" required="" value="<?php echo set_value('student_budget');?>"/>
            <?php echo form_error('student_budget');?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Budget type <span class="text-danger">*</span></label>
            <select class="form-control select3" name="student_budgettype" required="">
                <option value="">Select Budget Type</option>
                <?php 
                $vcu    =   $this->api_model->budgets();
                if(count($vcu) > 0){
                    foreach ($vcu as $ve){
                        $cs =   $ve["budgets"];
                        ?>
                <option value="<?php echo $cs;?>" <?php echo set_select($cs,"student_budgettype");?>><?php echo $cs;?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <?php echo form_error('student_budgettype');?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Gender Preference <span class="text-danger">*</span></label>
            <select class="form-control select3" name="student_preference" required="">
                <option value="">Select Gender Preference</option>
                <?php 
                $vcu    =   $this->api_model->gender_prefernce();
                if(count($vcu) > 0){
                    foreach ($vcu as $ve){
                        $cs =   $ve["gender_prefernce"];
                        ?>
                <option value="<?php echo $cs;?>" <?php echo set_select($cs,"student_preference");?>><?php echo $cs;?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <?php echo form_error('student_preference');?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Tutors Wanted <span class="text-danger">*</span></label>
            <select class="form-control select3" name="student_wanted" required="">
                <option value="">Select Tutors Wanted</option>
                <?php 
                $vcu    =   $this->api_model->tutoring_i_want();
                if(count($vcu) > 0){
                    foreach ($vcu as $ve){
                        $cs =   $ve["tutoring_i_want"];
                        ?>
                <option value="<?php echo $cs;?>" <?php echo set_select($cs,"student_wanted");?>><?php echo $cs;?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <?php echo form_error('student_wanted');?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>In Need Someone<span class="text-danger">*</span></label>
            <select class="form-control select3" name="student_need_time" required="">
                <option value="">Select I Need Someone</option>
                <?php 
                $vcu    =   $this->api_model->time_preference();
                if(count($vcu) > 0){
                    foreach ($vcu as $ve){
                        $cs =   $ve["time_preference"];
                        ?>
                <option value="<?php echo $cs;?>" <?php echo set_select($cs,"student_need_time");?>><?php echo $cs;?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <?php echo form_error('student_need_time');?>
        </div>
    </div>
</div>