<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Subject <span class="text-danger">*</span></label>
            <select class="form-control select3" name="student_subjects" multiple="" required="">
                <option value="">Select Select</option>
                <?php 
                $vcu    =   $this->api_model->subjects();
                if(count($vcu) > 0){
                    foreach ($vcu as $ve){
                        $cs =   $ve->subject_id;
                        ?>
                <option value="<?php echo $cs;?>" <?php echo set_select($cs,"student_subjects");?>><?php echo $ve->subject_name;?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <?php echo form_error("student_subjects");?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Level <span class="text-danger">*</span></label>
            <select class="form-control" name="student_from_level" required="">
                <option value="">Select From Level</option>
                <?php 
                $vcu    =   $this->api_model->levelsvalues();
                if(count($vcu) > 0){
                    foreach ($vcu as $ve){
                        ?>
                <option value="<?php echo $ve->level_id;?>" <?php echo set_select($ve->level_id,"student_from_level");?>><?php echo $ve->level_name;?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <?php echo form_error("student_from_level");?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>I Want <span class="text-danger">*</span></label>
            <select class="form-control" name="student_want" required="">
                <option value="">Select From Level</option>
                <?php 
                $vcu    =   $this->api_model->tutoring_i_want();
                if(count($vcu) > 0){
                    foreach ($vcu as $ve){
                        $cs =   $ve["tutoring_i_want"];
                        ?>
                <option value="<?php echo $cs;?>" <?php echo set_select($cs,"student_want");?>><?php echo $cs;?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <?php echo form_error("student_want");?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <div><input type="checkbox" class="studenine" name="student_online" value="1"/>&nbsp;Online</div>
            <div><input type="checkbox" class="studenine" name="student_myplace" value="1"/>&nbsp;At My Place (Home/Institution)</div>
            <div><input type="checkbox" class="studenine studentravel" onclick="travelthis()" name="student_tutor" value="1"/>&nbsp;Travel to Tutor</div>
        </div>
        <div class="text-danger studeninererr"></div>
    </div>
    <div class="col-md-4 studentrkm">
        <div class="form-group">
            <label>Travel in (kms)</label>
            <input type="text" class="form-control input_num studentext" name="student_travelkms" placeholder="Travel in (kms)"/>
        </div>
    </div>
</div>
<div class="ajacsubej mt-10 mb-10"></div>
<script>
    input_rest();
    selct2();
    travelthis();
</script>