<?php
$cr     =   $this->session->userdata("manage-resturant");
$ur     =   $this->session->userdata("update-resturant");
$dr     =   $this->session->userdata("delete-resturant");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="row layout-top-spacing">
    <?php if($cr == "1") { ?>
   
    <?php } ?>
    <div class="col-lg-12">
		<div class="card">
			<div class="card-header">View Resturant</div>
			<div class="card-body">
				<div class="row">
					
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="card-header">CATEGORY </div>
						<?php foreach($category as $cat){?>
						<div class="row padding-16p">
							<div class="col-md-9">
								<?php echo $cat->resturant_category_name;?>
							</div>
							<div class="col-md-3">
								<label class="switch s-info  mb-4 mr-2">
									<input type="checkbox" checked="">
									<span class="slider round"></span>
								</label>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="col-md-3">
						<div class="card-header">SUB-CATEGORY </div>
						<?php foreach($subcategory as $subcat){?>
						<div class="row padding-16p">
							<div class="col-md-9">
								<?php echo $subcat->resturant_subcategory_name;?>
							</div>
							<div class="col-md-3">
								<label class="switch s-info  mb-4 mr-2">
									<input type="checkbox" checked="">
									<span class="slider round"></span>
								</label>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="col-md-6">
						<div class="card-header">ITEMS</div>
						<?php foreach($items as $item){ ?>
						<div class="row padding-16p">
							<div class="col-md-1">
								<?php if($item->resturant_items_type === "Veg"){?>
								<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 12 12"><g fill="none" fill-rule="evenodd"><path stroke="#843821" d="M.5.5h11v11H.5z"></path><circle cx="6" cy="6" r="3" fill="#843821"></circle></g></svg>
								<?php }elseif($item->resturant_items_type === "Non Veg"){?>
								<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g fill="none" fill-rule="evenodd" opacity=".7"><path stroke="green" d="M.5.5h11v11H.5z"></path><circle cx="6" cy="6" r="3" fill="green"></circle></g></svg>
								<?php } ?>
							</div>
							<div class="col-md-8">
								<?php echo $item->resturant_items_name.'<br>'.$item->resturant_items_price.'<br>'.$item->resturant_items_desc;?>
							</div>
							<div class="col-md-3">
								<label class="switch s-info  mb-4 mr-2">
									<input type="checkbox" checked="">
									<span class="slider round"></span>
								</label>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>