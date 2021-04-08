<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Create Content Page</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li> 
                <li class="breadcrumb-item active">Create Content Page</li>
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
                         <h5 class="m-b-0 text-white">Create Content Page</h5>
                     </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform" id="category" novalidate="" >
                            <div class="form-group">
                                <label>Page Title<span class="required text-danger">*</span></label>
                                <input name="page_title" type="text" class="form-control" placeholder="Page Title" required="" autocomplete="off" />
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
                                                foreach ($contentform as $cer){
                                                    ?>
                                            <option atrvalue="<?php echo $cer->content_val;?>" value="<?php echo $cer->content_from_id;?>"><?php echo $cer->content_from_name;?></option>
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
                                                foreach ($layouts as $cer){
                                                    ?>
                                            <option atrvalue="<?php echo $cer->layout_val;?>" value="<?php echo $cer->layout_id;?>"><?php echo $cer->layout_name;?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Is Menu Header<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input type="checkbox" name="is_menu_header" value="1"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group pageurl">
                                <label>Page URL <span class="text-danger">*</span></label>
                                <input name="post_url" type="text" class="form-control" placeholder="Page URL" autocomplete="off" />
                            </div>
                            <div class="row_nest">
                                <div class="form-group  pagewidgets">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h4 class="text-info">Widgets</h4>
                                            <div class="dd">
                                                    <ol class="draggable-list dd-list"> 
                                                        <?php 
                                                            if(count($widgets) > 0){
                                                                foreach ($widgets as $wd){ ?>
                                                                <li class="draggable-item dd-item" data-id="<?php echo $wd->widget_id;?>">
                                                                <div class="dd-handle"><?php echo $wd->widget_display_name;?></div>
                                                                </li> 
                                                        <?php } 
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
                                                <div class="dd">
                                                    <div class="dd-empty"></div>
                                                </div>
                                                <?php echo form_error("left_contentval");?>
                                            </div>
                                            <div class="contet_widget">	 
                                                <h5>Content Widget</h5>
                                                <div class="dd">
                                                    <div class="dd-empty"></div>
                                                </div>
                                                <?php echo form_error("page_conentval");?>
                                            </div>
                                            <div class="right_widget">	 
                                                <h5>Right Widget</h5>
                                                <div class="dd">
                                                    <div class="dd-empty"></div>
                                                </div>
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
                                        <textarea name="cpage_leftsidebar" id="cpage_leftsidebar" rows="10" cols="80">
                                    </textarea>
                                    <script>
                                        
                                    </script>
                                    </div>
                                    <div class="col-sm-12 form-group contentpage">
                                        <label>Content</label>
                                        <textarea name="cpage_content" id="cpage_content" rows="10" cols="80">
                                    </textarea>
                                    <script>
                                        
                                    </script>
                                    </div>
                                    <div class="col-sm-12 form-group rightcontent">
        
                                        <label>Right Content</label>
                                        <textarea name="cpage_rightbar" id="cpage_rightbar" rows="10" cols="80">
                                    </textarea>
                                    <script>
        
                                    </script>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="text-info">Manage SEO Settings</h4><hr/>
                                    </div> 
                                    <div class="col-sm-6">
                                        <label>Meta Keywords </label>
                                        <textarea name="meta_keywords" placeholder="Meta Keywords" class="form-control"></textarea>
                                    </div>  
                                    <div class="col-sm-6">
                                        <label>Meta Description </label>
                                        <textarea name="meta_desc" placeholder="Meta Description" class="form-control"></textarea>
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