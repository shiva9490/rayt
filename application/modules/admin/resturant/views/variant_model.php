<div class="modal-header">
    <h5 class="modal-title" id="myLargeModalLabel">Add <?php echo ($title!="")?$title:''?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </button>
</div>
<div class="modal-body" style="height:450px !important;overflow-y: scroll;">
    <div class="row">
        <div class="col-md-6">Add <?php echo ($title!="")?$title:'Make your own'?></div>
        <div class="col-md-6">
            <a href="javascript:void(0);" class="variantsitem" id="Variants" data-value="<?php echo (count($datas)!="")?count($datas):'0';?>" onclick="addonsitemsvariants(this)" style="float: right;color: red;font-weight: 600;"><b>ADD MORE OPTION</b></a>
        </div>
    </div><hr>
    <?php if($title ==""){ ?>
    Title of customization *
    <input type="text" class="form-control addonoption" name="resturant_addon_option" value="" required />
    <?php } ?>
    
    <input type="hidden" id="eve" value="<?php echo ($eve!="")?$eve:'';?>">
    <input type="hidden" id="tempid" value="<?php echo ($tempid!="")?$tempid:'';?>">
    <br><b>Customisation behaviour *</b><br>
    <div class="row">
        <div class="col-md-6">
            <label>Customer selection is *</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="n-chk">
                        <label class="new-control new-radio square-radio new-radio-text">
                            <?php $e='';if(isset($datas[0]) && $datas[0]->resturant_addon_option =="Compulsory"){ $e=  'Checked';}?>
                            <input type="radio" class="new-control-input selection" name="selection" onclick="Compulsory('1')" value="Compulsory" <?php echo ($e!="")?$e:'checled';?>>
                            <span class="new-control-indicator"></span><span class="new-radio-content">Compulsory</span>
                        </label>
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="n-chk">
                        <label class="new-control new-radio square-radio new-radio-text">
                            <?php $e='';if(isset($datas[0]) && $datas[0]->resturant_addon_option =="Optional"){ $e=  'Checked';}?>
                          <input type="radio" class="new-control-input selection" name="selection" onclick="Compulsory('2')" value="Optional" <?php echo ($e!="")?$e:'checled';?>>
                          <span class="new-control-indicator"></span><span class="new-radio-content">Optional</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <label>Min selection</label>
            <select class="form-control minselection" name="zone_time" id="minselection" required="" <?php if(isset($datas[0]) && $datas[0]->resturant_addon_option =="Optional"){ echo 'disabled="disabled"';}?> >
                <?php  if(is_array($datas) && count($datas)!=""){
                        $i=1;foreach($datas as $r){
                            $sel='';
                            if($datas[0]->resturant_addon_max == $i){ $sel = "selected";}
                            echo '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
                        $i++;}
                }else{?>
                <option value="1">1</option>
                <?php } ?>
			</select>
        </div>
        <div class="col-md-3">
            <label>Max selection</label>
            <select class="form-control maxvalue" name="maxvalue" id="exampleFormControlSelect1" required="">
                <?php  if(is_array($datas) && count($datas)!=""){
                        $i=1;foreach($datas as $r){
                            $sel='';
                            if($datas[0]->resturant_addon_max == $i){ $sel = "selected";}
                            echo '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
                        $i++;}
                        $sels='';
                        if($datas[0]->resturant_addon_max == "All"){ $sels = "selected";}
                        echo '<option value="All" '.$sels.'>All</option>';
                }else{?>
				<option value="All">All</option>
				<?php } ?>
			</select>
        </div>
    </div><br>
    <?php if(is_array($datas) && count($datas) >0){
        foreach($datas as $d){
        ?>
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" class="addon_listid" name="addon_listid[]" value="<?php echo $d->resturant_addon_listid;?>">
                    <input type="text" class="form-control addonitem" name="addonitem[0][]" value="<?php echo $d->resturant_addonitem;?>" placeholder="Add On Item" required />
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control addonitem_amount" name="addonitem_amount[0][]" value="<?php echo $d->resturant_addonitem_amount;?>" placeholder="Add Item amount" required />
                </div>
                <div class="col-md-2">
                </div>
            </div><br>
        <?php   
        }
    }else{
    ?>
    <div class="row">
        <div class="col-md-6">
            <input type="hidden" class="addon_listid" name="addon_listid[]" value="">
            <input type="text" class="form-control addonitem" name="addonitem[0][]" placeholder="Add On Item" required />
        </div>
        <div class="col-md-4">
            <input type="number" class="form-control addonitem_amount" name="addonitem_amount[0][]" placeholder="Add Item amount" required />
        </div>
        <div class="col-md-2">
        </div>
    </div><br>
    <?php } ?>
    <div class="Addvariants" id="Addvariants"></div>
</div>
<div class="modal-footer">
    <div class="msg"></div>
    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
    <button type="button" class="btn btn-primary" onclick="addonvariant()">Save</button>
</div>