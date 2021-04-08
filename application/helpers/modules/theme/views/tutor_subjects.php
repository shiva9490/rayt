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
                                        <label>Subject <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Subject" value="<?php echo $this->input->get("skills");?>" onkeyup="searchsubjects($(this))"/>
                                        <input type="hidden" name="subjectid" value="<?php echo set_value("subjectid");?>" id="searchid"/>
                                        <?php echo form_error("subjectid");?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>From Level <span class="text-danger">*</span></label>
                                        <select class="form-control" name="formlevel" required="">
                                            <option value="">Select From Level</option>
                                            <?php 
                                            if(count($vcu) > 0){
                                                foreach ($vcu as $ve){
                                                    ?>
                                            <option value="<?php echo $ve->level_id;?>" <?php echo set_select($ve->level_id,"formlevel");?>><?php echo $ve->level_name;?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_error("formlevel");?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>To Level <span class="text-danger">*</span></label>
                                        <select class="form-control" name="tolevel" required="">
                                            <option value="">Select From Level</option>
                                            <?php 
                                            if(count($vcu) > 0){
                                                foreach ($vcu as $ve){
                                                    ?>
                                            <option value="<?php echo $ve->level_id;?>" <?php echo set_select($ve->level_id,"tolevel");?>><?php echo $ve->level_name;?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_error("tolevel");?>
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
                                                    <th>Subject Name</th>
                                                    <th>From Level</th>
                                                    <th>To Level</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if(count($view) > 0){
                                                    foreach ($view as $ve){
                                                        $tutorsubject_id    =   $ve->tutorsubject_id;
                                                        $sf     =   $ve->subject_alias_name."-Tutor-Jobs";
                                                        ?>
                                                <tr class="reid<?php echo $tutorsubject_id;?>">
                                                    <td><?php echo $limit++;?></td>
                                                    <td>
                                                        <a href="<?php echo base_url($sf);?>">
                                                            <?php echo $ve->subject_name;?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $ve->fromlevel;?></td>
                                                    <td><?php echo $ve->tolevel;?></td>
                                                    <td>
                                                        <a class="text-danger" href="javascript:void(0);" pagevale="Ajax-delete-subjects" reid="<?php echo $tutorsubject_id;?>" onclick="chekremove($(this))">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                        <?php
                                                    }
                                                }else{
                                                    ?>
                                                <tr>
                                                    <td colspan="10" class="text-danger text-center"><i class="fa fa-info-circle"></i> No Subjects are available</td>
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