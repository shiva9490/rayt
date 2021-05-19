
<?php 
	if($eve == "differentdays"){
	$menu   =   $this->config->item("menu_hours");
	$i=0;foreach($menu as $m){
?>
<div class="form-group b-grey">
	<div class="row">
		<div class="col-md-2">
			<label><?php echo $m;?> - </label>
		</div>
		<div class="col-md-4">
			<input type="time"  id="timeFlatpickr<?php echo $i;?>" name="strt_time[]" class="form-control flatpickr flatpickr-input active" value="<?php echo set_value('strt_time".$i."');?>" />
		</div>
		<div class="col-md-4">
			<input type="time"  id="timepicker1<?php echo $i;?>" name="end_time[]" value=""  class="form-control"/>
		</div>
	</div>
</div>
<?php 
	$i++;
	}
}
	if($eve == "alldays"){
?>
<div class="row">
	<div class="col-md-3">Days</div>
	<div class="col-md-3">Start Time</div>
	<div class="col-md-3">End Time</div>
	<div class="col-md-3"></div>
</div>
<div class="row">
	<div class="col-md-3">All Day 1/3</div>
	<div class="col-md-3">
		<input id="timeFlatpickr" class="form-control flatpickr flatpickr-input active alltime " name="strt_time[]"  type="time" data-value="1" placeholder="Select Date.." >
	</div>
	<div class="col-md-3">
		<input id="timepicker10" class="form-control flatpickr flatpickr-input" name="end_time[]" type="time" placeholder="Select Date.." >
	</div>
	<div class="col-md-3">
		<a href="javascript:void(0);" id="add" onclick="myevent(this)">Add</a>
	</div>
</div>
<div class="alldays" id="AddDel"></div>
<?php } ?>