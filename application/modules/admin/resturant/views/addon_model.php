<div class="modal-header">
    <h5 class="modal-title" id="myLargeModalLabel"><?php echo ($title!="")?$title:''?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </button>
</div>
<div class="modal-body" style="height:450px !important;overflow-y: scroll;">
    <div class="row">
        <div class="col-md-6">Add variant <?php echo ($title!="")?$title:''?></div>
        <div class="col-md-6">
            <a href="javascript:void(0);" class="addonitems" id="addonitems" data-value="<?php echo (count($datas)!="")?count($datas):'1';?>" onclick="addonsitems(this)" style="float: right;color: red;font-weight: 600;"><b>ADD MORE OPTION</b></a>
        </div>
    </div><hr>
    <?php if($title == ""){ ?>
        Title of customization *
        <input type="text" class="form-control customization" value="<?php if(isset($datas[0]->resturant_variants_title)){ echo $datas[0]->resturant_variants_title;}?>" placeholder="Title of customization"><br>
    <?php } ?>
    <input type="hidden" id="eve" value="<?php echo ($eve !="")?$eve:''?>">
    <input type="hidden" id="total" value="<?php echo ($total !="")?$total:''?>">
    <input type="hidden" id="tempid" value="<?php echo ($tempid !="")?$tempid:''?>">
    <?php if(is_array($datas) && count($datas) >0){
        $i=0;foreach($datas as $key=>$d){
        $sta='';
        if($d->resturant_variants_defelat!=""){
            $sta = 'checked="checked"';
        }
        ?>
        <div class="row">
            <div class="col-md-1">
                <input type="hidden" class="variantsids" name="variantsid[]" value="<?php echo $d->resturant_variants_id;?>">
                <input type="radio" class="from-control defelat" name="defelat[]" value="<?php echo $i;?>" <?php echo ($sta!="")?$sta:'';?>>
            </div>
            <div class="col-md-3">
                <label></label>
                <input type="text" class="form-control addonoption" name="resturant_addon_option[]" value="<?php echo $d->resturant_variants;?>" placeholder="Option Name">
            </div>
            <div class="col-md-3">
                <label></label>
                <select class="form-control veg" name="veg[]" id="exampleFormControlSelect1" required="">
                    <option value="">Select Veg</option>
                    <?php 
        		        $veg   =   $this->config->item("veg");
        			    foreach($veg as $key=>$veg){
        			?>
        			    <option value="<?php echo $veg;?>" <?php if($veg == $d->resturant_variants_veg){echo 'selected';}?>><?php echo $veg;?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-1">
                <label>Item Price</label><br>
                <?php echo ($total!="")?$total:'0';?>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">Additional Price</label><br>
                <input type="number" class="form-control addprice0 addprince" id="addprice0" value="<?php echo $d->resturant_variants_price;?>" name="addon_amount[]" onkeyup="addvariant('0')" placeholder="0" required/>
            </div>
            <div class="col-md-2">
                <label>Final Price</label><br>
                <input type="hidden" id="tol0" name="addon_amount[]" required/>
                <span class="addontotal0"><?php echo $total+$d->resturant_variants_price?></span>
            </div>
        </div><hr>
    <?php 
        $i++;}
        }else{
    ?>
    <div class="row">
        <div class="col-md-1">
            <input type="radio" class="from-control defelat" name="defelat[]" value="0" checked>
        </div>
        <div class="col-md-3">
            <label></label>
            <input type="text" class="form-control addonoption" name="resturant_addon_option[]" placeholder="Option Name">
        </div>
        <div class="col-md-3">
            <label></label>
            <select class="form-control veg" name="veg[]" id="exampleFormControlSelect1"  required="">
                <option value="">Select Veg</option>
                <?php 
    		        $veg   =   $this->config->item("veg");
    			    foreach($veg as $key=>$veg){
    			?>
    			    <option value="<?php echo $veg;?>"><?php echo $veg;?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-1">
            <label>Item Price</label><br>
            <?php echo ($total!="")?$total:'0';?>
        </div>
        <div class="col-md-2">
            <label style="font-size: 11px;">Additional Price</label><br>
            <input type="number" class="form-control addprice0 addprince" id="addprice0" name="addon_amount[]" onkeyup="addvariant('0')" placeholder="0" required/>
        </div>
        <div class="col-md-2">
            <label>Final Price</label><br>
            <input type="hidden" id="tol0" name="addon_amount[]" required/>
            <span class="addontotal0">0</span>
        </div>
    </div><hr>
    <div class="row">
        <div class="col-md-1">
            <label></label>
            <input type="radio" class="from-control defelat" name="defelat[]" value="1">
        </div>
        <div class="col-md-3">
            <label></label>
            <input type="hidden" class="form-control" name="resturant_tempid" value="<?php echo ($tempid!="")?$tempid:'';?>" placeholder="Option Name" />
            <input type="text" class="form-control addonoption" name="resturant_addon_option[]" placeholder="Option Name" required />
        </div>
        <div class="col-md-3">
            <label></label>
            <select class="form-control veg" name="veg[]" id="exampleFormControlSelect1" required >
                <option value="">Select Veg</option>
                <?php 
    		        $veg   =   $this->config->item("veg");
    			    foreach($veg as $key=>$veg){
    			?>
    			    <option value="<?php echo $veg;?>"><?php echo $veg;?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-1">
            <label>Item Price</label><br>
            <input type="hidden" name="item_amount" id="item_amount" value="<?php echo ($total!="")?$total:'0';?>">
            <?php echo ($total!="")?$total:'0';?>
        </div>
        <div class="col-md-2">
            <label style="font-size: 11px;">Additional Price</label><br>
            <input type="number" class="form-control addprice1 addprince" id="addprice1" name="addon_amount[]" onkeyup="addvariant('1')" placeholder="0" required/>
        </div>
        <div class="col-md-2">
            <label>Final Price</label><br>
            <input type="hidden" id="tol1" name="total_amount[]" required/>
            <span class="addontotal1">0</span>
        </div>
    </div>
    <?php } ?>
    <div class="AddDels"></div>
    
</div>
<div class="modal-footer">
    <span class="msg"></span>
    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
    <button type="submit" name="submit" class="btn btn-primary" onclick="add_variants()">Save</button>
</div>