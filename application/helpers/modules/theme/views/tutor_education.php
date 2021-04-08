<div class="breadcrumbs text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs-style1 sep1 posr">
                    <ul>
                        <li>
                            <div class="breadcrumbs-icon1">
                                <a href="<?php echo base_url();?>" title="Return to home">Home</a>
                            </div>
                        </li>
                        <li>/</li>
                        <li>
                            <div class="breadcrumbs-icon1">
                                <a href="<?php echo base_url('/Tutor-Profile');?>" title="Profile">Profile</a>
                            </div>
                        </li>
                        <li>/ <?php echo $ctitle;?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <aside class="single-aside pb-20">
                    <div class="aside-inner-wrapper">
                        <div class=""><?php $this->load->view("admin/success_error");?></div>
                        <div class="aside-title mb-10 aside-underline posr">
                            <h5>Add Subjects</h5>
                        </div>
                        <form class="lognnformvalue  mb-10" method="post" action="" novalidate="">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Institution <span class="text-danger">*</span></label>
                                        <select class="form-control" name="experince_institution" required="">
                                            <option value="">Select Institution</option>
                                            <?php 
                                            if(count($insit) > 0){
                                                foreach ($insit as $ve){
                                                    ?>
                                            <option value="<?php echo $ve->institution_id;?>" <?php echo set_select($ve->institution_id,"experince_institution");?>><?php echo $ve->institution_name;?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_error("experince_institution");?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Degree Type <span class="text-danger">*</span></label>
                                        <select class="form-control" name="experince_degree_type" required="">
                                            <option value="">Select Degree Type</option>
                                            <?php 
                                            if(count($degree) > 0){
                                                foreach ($degree as $ve){
                                                    ?>
                                            <option value="<?php echo $ve->degree_id;?>" <?php echo set_select($ve->degree_id,"experince_degree_type");?>><?php echo $ve->degree_name;?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_error("experince_degree_type");?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start</label>
                                        <input type="date" class="form-control" name="experince_start_year" value="<?php echo set_value("experince_start_year");?>" placeholder="Start Year"/>
                                        <?php echo form_error('experince_start_year');?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End</label>
                                        <input type="date" class="form-control" name="experince_end_year" value="<?php echo set_value("experince_end_year");?>" placeholder="End Year"/>
                                        <?php echo form_error('experince_end_year');?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Association <span class="text-danger">*</span></label>
                                        <select class="form-control" name="experince_assoication" required="">
                                            <option value="">Select Association</option>
                                            <?php 
                                            if(count($association) > 0){
                                                foreach ($association as $ver){
                                                    $ve     =   $ver["associations"];
                                                    ?>
                                            <option value="<?php echo $ve;?>" <?php echo set_select($ve,"experince_assoication");?>><?php echo $ve;?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_error("experince_assoication");?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Speciality</label>
                                        <input type="text" class="form-control" name="experince_speciality" value="<?php echo set_value("experince_speciality");?>" placeholder="Speciality"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Score</label>
                                        <input type="text" class="form-control" name="experince_score" value="<?php echo set_value("experince_score");?>" placeholder="Score"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn-success  btnbal" name="submit" value="submit"> Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="aside-title mt-10 aside-underline posr">
                            <h5><?php echo $ctitle;?></h5>
                        </div>
                        <div class="aside-text">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center table-striped">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Institution</th>
                                                    <th>Degree</th>
                                                    <th>Start</th>
                                                    <th>End</th>
                                                    <th>Association</th>
                                                    <th>Speciality</th>
                                                    <th>Score</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if(count($view) > 0){
                                                    foreach ($view as $ve){
                                                        $tutorsubject_id    =   $ve->experince_id;
                                                        ?>
                                                <tr class="reid<?php echo $tutorsubject_id;?>">
                                                    <td><?php echo $limit++;?></td>
                                                    <td><?php echo $ve->institution_name;?></td>
                                                    <td><?php echo $ve->degree_name;?></td>
                                                    <td><?php echo $ve->experince_start_year;?></td>
                                                    <td><?php echo $ve->experince_end_year;?></td>
                                                    <td><?php echo $ve->experince_assoication;?></td>
                                                    <td><?php echo $ve->experince_speciality;?></td>
                                                    <td><?php echo $ve->experince_score;?></td>
                                                    <td>
                                                        <a class="text-danger" href="javascript:void(0);" pagevale="Ajax-delete-education" reid="<?php echo $tutorsubject_id;?>" onclick="chekremove($(this))">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                        <?php
                                                    }
                                                }else{
                                                    ?>
                                                <tr>
                                                    <td colspan="10" class="text-danger text-center"><i class="fa fa-info-circle"></i> No Education details are available</td>
                                                </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>