            <div class="layout-px-spacing">
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="mail-box-container">
                            <div class="mail-overlay"></div>
                            <div class="tab-title">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12 text-center">
                                        <button type="button" class="btn btn-primary mb-2 mr-2 addcategory" data-title="Add Category" onclick="addcategory()">
                                          Add Category
                                        </button>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-12 text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                        <h5 class="app-title">Menu sections</h5>
                                    </div>
									<div class="todoList-sidebar-scroll">
                                        <div class="col-md-12 col-sm-12 col-12 mt-4 pl-0">
                                            <ul class="nav nav-pills d-block" id="pills-tab" role="tablist">
												<?php foreach($category as $key=>$cat){?>
                                                <li class="nav-item d-flex justify-content">
                                                    <a class="nav-link <?php if($key=="0"){echo 'list-actions active';}?>" data-key="<?php echo $key?>" data-valu="<?php echo $cat->resturant_category_id;?>" onclick="searchFilter('','<?php echo $urlvalue;?>','<?php echo $cat->resturant_category_id;?>')" id="all-list-<?php echo $cat->resturant_category_id;?>" data-toggle="pill" href="#pills-inbox" role="tab" aria-selected="true">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg> 
														<?php echo $cat->resturant_category_name;?> 
    												</a>
												    <div class="action-dropdown custom-dropdown-icon mt-2 mb-2">
                                    					<div class="dropdown">
                                    						<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                    						</a>
                                    						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink-2" style="will-change: transform;">
                                    							<a class="edit dropdown-item" href="https://rayt.advitsoftware.com/Partner-Admin/Update-Items/RESTITEM1">Edit</a>
                                    							<a class="dropdown-item delete" href="javascript:void(0);">Delete</a>
                                    						</div>
                                    					</div>
                                    				</div>
                                                </li>
												<?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="todo-inbox" class="accordion todo-inbox"><br>
                                <div class="todo-box">
                                    <div id="ct" class="todo-box-scroll">
										<input type="hidden" id="urlvalue" name="urlvalue" value="<?php echo $urlvalue;?>"> 
										<input type="hidden" id="orderby" name="orderby" value="<?php echo isset($orderby)?$orderby:'';?>">
										<input type="hidden" id="tipoOrderby" name="tipoOrderby" value="<?php echo isset($tipoOrderby)?$tipoOrderby:'';?>">
										<?php $this->load->view("admin/loader");?>
										<div class="postList"></div>
									</div>
                                </div>
                            </div>                                    
                        </div> 
                    </div>
                </div>

            </div>