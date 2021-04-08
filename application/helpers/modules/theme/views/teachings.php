<div class="breadcrumbs text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs-style1 sep1 posr">
                    <ul>
                        <li>
                            <div class="breadcrumbs-icon1">
                                <a href="<?php echo base_url();?>" title="Return to home">Home</a>
                            </div>
                        </li>
                        <li>/ <?php echo $ctitle;?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <aside class="single-aside pb-20">
                    <div class="aside-inner-wrapper">
                        <div class="aside-title aside-underline posr">
                            <h5>Search</h5>
                        </div>
                        <div class="aside-text">
                            <form method="" action="">
                                <div class="aside-input posr">
                                    <input type="text" placeholder="Skills" value="<?php echo $this->input->get("skills");?>" onkeyup="searchsubjects($(this))"/>
                                    <input type="hidden" name="skills" placeholder="Skills" <?php echo $this->input->get("skills");?> id="search-id"/>
                                    <input type="text" name="locations" placeholder="Location" value="<?php echo $this->input->get("locations");?>"/>
                                    <div class="input-button">
                                        <button type="submit"><i class="fa fa-search"></i>&nbsp;&nbsp;Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
<section class="events-grid">
    <input type="hidden" id="FilterTextBox" name="skills" value="<?php echo $this->input->get("skills");?>"> 
    <input type="hidden" id="locations" class="locations" name="locations" value="<?php echo $this->input->get("locations");?>"> 
    <input type="hidden" id="urlvalue" name="urlvalue" value="<?php echo $urlvalue;?>"> 
    <?php $this->load->view("admin/loader");?>   
    <div class="container postList">
    </div>
</section>