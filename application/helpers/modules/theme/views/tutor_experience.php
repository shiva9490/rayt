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
                                        <label>Organization <span class="text-danger">*</span></label>
                                        <input class="form-control" required="" name="teaching_organization" value="<?php echo set_value('teaching_organization');?>" placeholder="Organization"/>
                                        <?php echo form_error("teaching_organization");?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input class="form-control"  name="teaching_designation" value="<?php echo set_value('teaching_designation');?>" placeholder="Designation"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start <span class="text-danger">*</span></label>
                                        <input type="date" required="" class="form-control" name="teaching_start_year" value="<?php echo set_value("teaching_start_year");?>" placeholder="Start Year"/>
                                        <?php echo form_error('teaching_start_year');?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End <span class="text-danger">*</span></label>
                                        <input type="date" required="" class="form-control" name="teaching_end_year" value="<?php echo set_value("teaching_end_year");?>" placeholder="End Year"/>
                                        <?php echo form_error('teaching_end_year');?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Association <span class="text-danger">*</span></label>
                                        <select class="form-control" name="teaching_association" required="">
                                            <option value="">Select Association</option>
                                            <?php 
                                            if(count($association) > 0){
                                                foreach ($association as $ver){
                                                    $ve     =   $ver["associations"];
                                                    ?>
                                            <option value="<?php echo $ve;?>" <?php echo set_select($ve,"teaching_association");?>><?php echo $ve;?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_error("teaching_association");?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Job Description</label>
                                        <textarea class="form-control" name="teaching_description" placeholder="Description"><?php echo set_value("teaching_description");?></textarea>
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
                                                    <th>Organization</th>
                                                    <th>Designation</th>
                                                    <th>Start</th>
                                                    <th>End</th>
                                                    <th>Association</th>
                                                    <th>Description</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if(count($view) > 0){
                                                    foreach ($view as $ve){
                                                        $tutorsubject_id    =   $ve->teaching_id;
                                                        ?>
                                                <tr class="reid<?php echo $tutorsubject_id;?>">
                                                    <td><?php echo $limit++;?></td>
                                                    <td><?php echo $ve->teaching_organization;?></td>
                                                    <td><?php echo $ve->teaching_designation;?></td>
                                                    <td><?php echo $ve->teaching_start_year;?></td>
                                                    <td><?php echo $ve->teaching_end_year;?></td>
                                                    <td><?php echo $ve->teaching_association;?></td>
                                                    <td><?php echo $ve->teaching_description;?></td>
                                                    <td>
                                                        <a class="text-danger" href="javascript:void(0);" pagevale="Ajax-delete-teaching" reid="<?php echo $tutorsubject_id;?>" onclick="chekremove($(this))">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                        <?php
                                                    }
                                                }else{
                                                    ?>
                                                <tr>
                                                    <td colspan="10" class="text-danger text-center"><i class="fa fa-info-circle"></i> No Teaching Experience details are available</td>
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