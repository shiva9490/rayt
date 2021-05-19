
<option value="">Select Resturant</option>
<?php foreach($rest as $r){
	$r=(array) $r;?>
    <option value="<?php echo $r['resturant_id'];?>" <?php if(set_value('zone')==$r['resturant_id']){echo 'selected';}?>><?php echo $r['resturant_name'];?></option>	
<?php }?>
