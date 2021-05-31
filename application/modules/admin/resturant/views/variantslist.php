<?php
    $parAddon['whereCondition']     = "rv.resturant_variants_tempid = '".$tempid."'";
    $parAddon['group_by']           = "rv.resturant_variants_category";
    $variants = $this->menu_model->viewVariants($parAddon);
    if(is_array($variants) && count($variants) > 0){
        foreach($variants as $vari){
?>
    <div class="col-md-4">
        <blockquote class="blockquote media-object">
            <div class="note-inner-content">
                <div class="note-content">
                    <p class="note-title" data-noteTitle="Receive Package"><b><?php echo ($vari->variant_name!="")?$vari->variant_name:$vari->resturant_variants_title;?></b></p>
                    <div class="note-description-content">
                        <?php 
                            $parAddons['whereCondition']     = "rv.resturant_variants_tempid = '".$tempid."' and resturant_variants_category LIKE '".$vari->resturant_variants_category."'";
                            $varia = $this->menu_model->viewVariants($parAddons);
                            foreach($varia as $v){
                        ?>
                        <p class="note-description" data-noteDescription="<?php echo ($v->variant_name!="")?$v->variant_name:$v->resturant_variants_title;?>">
                            <div class="row">
                                <div class="col-md-8">
                                    <?php echo ($v->resturant_variants!="")?$v->resturant_variants:'';?>
                                </div>
                                <div class="col-md-4">
                                   - <?php echo number_format((float)$v->resturant_variants_price, 3, '.', '');?>
                                </div>
                            </div>
                        </p>
                        <?php } ?>
                    </div>
                </div>
                <div class="note-action">
                    <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Delete Variants')" data-toggle='tooltip' attrvalue="<?php echo adminurl("Delete-Variant-List/".$vari->resturant_variants_id);?>" data-original-title="Delete country" class="text-danger">
					    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 delete-note"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </a>
                </div>
            </div>
        </blockquote>
    </div>
<?php
        }
    }
 ?>