<div class="modal-header">
    <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo ($title!="")?$title:'';?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </button>
</div>
<div class="modal-body" style="height: auto;">
    <span class="msgs"></span>
    <input type="text" name="category" id="category" placeholder="category" class="form-control category" value="<?php echo $view[0]['resturant_category_name'];?>"><br>
    <input type="text" name="category_a" id="category_a" placeholder="الفئة" class="form-control category_a" value="<?php echo $view[0]['resturant_category_name_a'];?>"><br>
</div>
<div class="modal-footer">
    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
    <button type="button" class="btn btn-primary categorybutton" onclick="updatingcategortss('<?php echo $id;?>')" >Save</button>
    <button class="btn btn-info btn-lg mb-3 mr-3 loading" style="display:none">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin mr-2"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>  Loading
    </button>
</div>