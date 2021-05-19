		<div class="col-md-12 col-sm-12 col-12 text-right">
		    <?php 
		        $cat = ($category!="")?$category:'';
		        if($cat!=""){
		    ?>
            <a href="<?php echo adminurl('Add-Items/'.$cat);?>" class="btn btn-primary mb-2 mr-2" >
              +Add Item
            </a>
            <?php } ?>
        </div>
		<?php 
		//echo '<pre>';print_r($view);exit;
		if(is_array($view) && count($view) >0){
			foreach($view as $view){
            $pic    =   $view->resturant_items_image;
            $imh    =   $this->common_config->getvalueImagesize($pic);
            $stat='';
            if($view->resturant_items_abc == "Active"){
                $stat = 'checked=""';
            }
		?>
		<div class="todo-item all-list-<?php echo $category;?>">
			<div class="todo-item-inner">
				<div class="n-chk text-center">
					<img width="150px" height="150px" src="<?php echo $imh;?>">
				</div>
				<div class="todo-content">
				<?php echo $view->resturant_items_type;?>
					<h5 class="todo-heading" data-todoHeading="<?php echo $view->resturant_items_name;?>"><?php echo $view->resturant_items_name;?></h5>
					<p class="todo-text" data-todoHtml="">
					    <?php echo number_format((float)$view->resturant_items_price, 3, '.', '');?> KWD
					</p>
					<?php echo $view->resturant_items_desc;?>
				</div>
				<div class="priority-dropdown custom-dropdown-icon">
					<label class="switch s-secondary  mb-4 mr-2">
                        <input type="checkbox" name="itemid" id="itemid<?php echo $view->resturant_items_id;?>" data-status<?php echo $view->resturant_items_id;?>="<?php echo $view->resturant_items_abc;?>" onchange="itemchanges('<?php echo $view->resturant_items_id;?>')" <?php echo $stat;?>>
                        <span class="slider round"></span>
                    </label>
				</div>
				<div class="action-dropdown custom-dropdown-icon">
					<div class="dropdown">
						<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
						</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink-2">
							<a class="edit dropdown-item" href="<?php echo adminurl('Update-Items/'.$view->resturant_items_id);?>">Edit</a>
							<a class="dropdown-item delete" href="javascript:void(0);">Delete</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }
		}else{ ?>
		<div class="todo-item all-list">
			<center><img width="35%" src="<?php echo base_url().'theme-assets/assets/img/empty.jpg'?>"></center>
		</div>
		<?php } ?>