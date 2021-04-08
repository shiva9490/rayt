<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Update Content Page</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li> 
                <li class="breadcrumb-item"><a href="<?php echo bildourl('view-content-pages');?>">View</a></li> 
                <li class="breadcrumb-item active">Update Content Page</li>
            </ol>
        </div>
    </div>
 </div>
</div>

<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <?php $this->load->view("admin/success_error");?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                         <h5 class="m-b-0 text-white">Update Content Page</h5>
                     </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform" id="category" novalidate="" >
                            <div class="form-group">
                                <label>Page Title<span class="required text-danger">*</span></label>
                                <input name="page_title" type="text" class="form-control" value="<?php echo $view->cpage_title;?>" required="" autocomplete="off" />
                                <?php echo form_error('page_title');?>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>Page Content <span class="text-danger">*</span></label>
                                        <select name="cpage_content_from" class="form-control page_content" required="" onchange="pageform()">
                                            <option value="">Select Content</option>
                                            <?php
                                        if(count($contentform) > 0){
                                            foreach ($contentform as $crt){
                                                ?>
                                        <option value="<?php echo $crt->content_from_id;?>" atrvalue='<?php echo $crt->content_val;?>' <?php echo ($view->cpage_content_from ==  $crt->content_from_id)?"selected=selected":"";?>><?php echo $crt->content_from_name;?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Page Layout <span class="text-danger">*</span></label>
                                        <select name="page_layout" class="form-control page_layout" required="" onchange="pageform()">
                                            <option value="">Select Layout</option>
                                            <?php
                                        if(count($layouts) > 0){
                                            foreach ($layouts as $crdt){
                                                ?>
                                        <option value="<?php echo $crdt->layout_id;?>" atrvalue='<?php echo $crdt->layout_val;?>' <?php echo ($view->cpage_layout == $crdt->layout_id)?"selected=selected":"";?>><?php echo $crdt->layout_name;?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Is Menu Header<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input type="checkbox" name="is_menu_header" value="1" <?php echo ($view->cpage_show_menu == '1')?"checked=checked":"";?> />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group pageurl">
                                <label>Page URL <span class="text-danger">*</span></label>
                                <input name="post_url" type="text" class="form-control"  value="<?php echo $view->cpage_content_url;?>" autocomplete="off" />
                            </div>
                            <div class="row_nest">
                                <div class="form-group pagewidgets">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h4 class="text-info">Widgets</h4>
                                                <div class="dd">
                                            <ol class="draggable-list dd-list">
                                            
                                                <?php
                                                    $left   =   $view->cpage_leftsidebar;
                                                    $cntt   =   $view->cpage_content;
                                                    $rght   =   $view->cpage_rightbar;  
                                                    $msp    =   $left.",".$cntt.",".$rght;
                                                    $vsp    =   array_filter(explode(",",$msp)); 
                                                    if(count($widgets) > 0){
                                                        foreach ($widgets as $wd){
                                                        if(!in_array($wd->widget_id,$vsp)){
                                                         ?>
                                                        <li class="draggable-item dd-item" data-id="<?php echo $wd->widget_id;?>">
                                                        <div class="dd-handle"><?php echo $wd->widget_display_name;?></div>
                                                        </li> 
                                                <?php 
                                                            }
                                                        } 
                                                    }
                                                ?>
                                            </ol>
                                            </div>
                                            <input type="hidden" name="left_contentval" class="left_contentval" values="[]">
                                            <input type="hidden" name="page_conentval" class="page_conentval" values="[]">
                                            <input type="hidden" name="right_contentval" class="right_contentval" values="[]">
                                           </div> 
                                        <div class="col-sm-8">
                                            <div class="left_widget">   
                                                <h5>Left Widget</h5>
                                                <div class="dd" id="left_widget_1">
                                                    <div class="dd-empty">
                                                    <?php 
                                                    $lft = $view->cpage_leftsidebar;
                                                    $lvsp   = array_filter(explode(",",$lft)); 
                                                    if(count($lvsp) > 0){
                                                        if(count($widgets) > 0){
                                                            foreach ($widgets as $lst){
                                                                if(in_array($lst->widget_id,$lvsp)){
                                                                ?> 
                                                                <li class="draggable-item dd-item" data-id="<?php echo $lst->widget_id;?>">
                                                                    <div class="dd-handle"><?php echo $lst->widget_display_name;?></div>
                                                                </li> 
                                                                <?php
                                                                }
                                                            }
                                                        }
                                                    }else {
                                                            echo '<div class="dd-empty"></div>';
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                                <!--<div class="dd" id="left_widget_1">
                                                    <div class="dd-empty"></div>
                                                </div>-->
                                                <?php echo form_error("left_contentval");?>
                                            </div>
                                            <div class="contet_widget">  
                                                <h5>Content Widget</h5>
                                                <div class="dd" id="content_widget_1">
                                                    <div class="dd-empty">
                                                    <?php 
                                                    $cont = $view->cpage_content;
                                                    $lvsp   = array_filter(explode(",",$cont)); 
                                                    if(count($lvsp) > 0){
                                                        if(count($widgets) > 0){
                                                            foreach ($widgets as $lst){
                                                                if(in_array($lst->widget_id,$lvsp)){
                                                                ?> 
                                                                <li class="draggable-item dd-item" data-id="<?php echo $lst->widget_id;?>">
                                                                    <div class="dd-handle"><?php echo $lst->widget_display_name;?></div>
                                                                </li> 
                                                                <?php
                                                                }
                                                            }
                                                        }
                                                    }else {
                                                            echo '<div class="dd-empty"></div>';
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                               <!-- <div class="dd" id="content_widget_1">
                                                    <div class="dd-empty"></div>
                                                </div>-->
                                                <?php echo form_error("page_conentval");?>
                                            </div>
                                            <div class="right_widget">   
                                                <h5>Right Widget</h5>
                                                <div class="dd" id="right_widget_1">
                                                    <div class="dd-empty">
                                                    <?php 
                                                    $rint = $view->cpage_rightbar;
                                                    $lvsp   = array_filter(explode(",",$rint)); 
                                                    if(count($lvsp) > 0){
                                                        if(count($widgets) > 0){
                                                            foreach ($widgets as $lst){
                                                                if(in_array($lst->widget_id,$lvsp)){
                                                                ?> 
                                                                <li class="draggable-item dd-item" data-id="<?php echo $lst->widget_id;?>">
                                                                    <div class="dd-handle"><?php echo $lst->widget_display_name;?></div>
                                                                </li> 
                                                                <?php
                                                                }
                                                            }
                                                        }
                                                    }else {
                                                            echo '<div class="dd-empty"></div>';
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                                <!--<div class="dd" id="right_widget_1">
                                                    <div class="dd-empty"></div>
                                                </div>-->
                                                <?php echo form_error("right_contentval");?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">   
                                <div class="row">
                                    <div class="col-sm-12 form-group leftcontent">
                                        <label>Left Content</label>
                                        <textarea  class="texatval" name="cpage_leftsidebar" id="cpage_leftsidebar" rows="10" cols="80"><?php echo $view->cpage_leftsidebar;?></textarea>
                                    </div>
                                    <div class="col-sm-12 form-group contentpage">
                                        <label>Content</label>
                                        <textarea  class="texatval" name="cpage_content" id="cpage_content" rows="10" cols="80"><?php echo $view->cpage_content;?></textarea>
                                    </div>
                                    <div class="col-sm-12 form-group rightcontent">
                                        <label>Right Content</label>
                                        <textarea class="texatval" name="cpage_rightbar" id="cpage_rightbar" rows="10" cols="80"><?php echo $view->cpage_rightbar;?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="text-info">Manage SEO Settings</h4><hr/>
                                    </div> 
                                    <div class="col-sm-6">
                                        <?php  $seo = unserialize($view->cpage_seo_settings);?>
                                        <label>Meta Keywords </label>
                                        <textarea name="meta_keywords" placeholder="Meta Keywords" class="form-control"><?php echo $seo['meta_keys'];?></textarea>
                                    </div>  
                                    <div class="col-sm-6">
                                        <label>Meta Description </label>
                                        <textarea name="meta_desc" placeholder="Meta Description" class="form-control"><?php echo $seo['meta_desc'];?></textarea>
                                    </div>  
                                </div>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-success" name="submit" value="submit">Submit</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
