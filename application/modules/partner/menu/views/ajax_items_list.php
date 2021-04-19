		<div class="col-md-12 col-sm-12 col-12 text-right">
            <a href="<?php echo partnerurl('Add-Items/'.$category);?>" class="btn btn-primary mb-2 mr-2" >
              +Add Item
            </a>
        </div>
		<?php 
		if(is_array($view) && count($view) >0){
			foreach($view as $view){
            $pic    =   $view->resturant_items_image;
            $imh    =   $this->common_config->getvalueImagesize($pic);
		?>
		<div class="todo-item all-list-<?php echo $category;?>">
			<div class="todo-item-inner">
				<div class="n-chk text-center">
					<img width="150px" height="150px" src="<?php echo $imh;?>">
				</div>
				<div class="todo-content">
				<?php echo $view->resturant_items_type;?>
					<h5 class="todo-heading" data-todoHeading="<?php echo $view->resturant_items_name;?>"><?php echo $view->resturant_items_name;?></h5>
					<p class="todo-text" data-todoHtml=""><?php echo $view->resturant_items_price;?></p>
					<p class="todo-text" data-todoHtml=""><?php echo $view->resturant_items_desc;?></p>
				</div>
				<div class="priority-dropdown custom-dropdown-icon">
					<div class="dropdown p-dropdown">
						<a class="dropdown-toggle warning" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
						</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
							<a class="dropdown-item danger" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> High</a>
							<a class="dropdown-item warning" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> Middle</a>
							<a class="dropdown-item primary" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> Low</a>
						</div>
					</div>
				</div>
				<div class="action-dropdown custom-dropdown-icon">
					<div class="dropdown">
						<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
						</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink-2">
							<a class="edit dropdown-item" href="javascript:void(0);">Edit</a>
							<a class="important dropdown-item" href="javascript:void(0);">Important</a>
							<a class="dropdown-item delete" href="javascript:void(0);">Delete</a>
							<a class="dropdown-item permanent-delete" href="javascript:void(0);">Permanent Delete</a>
							<a class="dropdown-item revive" href="javascript:void(0);">Revive Task</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }
		}else{ ?>
		<div class="todo-item all-list">
			<img src="<?php echo base_url().'theme-assets/assets/img/empty.jpg'?>">
		</div>
		<?php } ?>