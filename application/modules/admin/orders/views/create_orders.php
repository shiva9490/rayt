<div id="google_translate_element"></div>
<style>
    .goog-te-banner-frame{
        visibility:hidden !important;
        height:0px !important;
    }
    body{
        top:0px !important;
    }
    #google_translate_element{
        position:fixed;
        bottom:0px;
        right:0px;
    }
</style>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages : 'ar,en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>



<!--<div id="google_translate_element"></div>-->

<!--<script type="text/javascript">-->
<!--function googleTranslateElementInit() {-->
<!--  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');-->
<!--}-->
<!--</script>-->

<!--<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>-->








<form method="POST" enctype="multipart/form-data" onsubmit="novalidate" name="myForm">
 
        <div class="container-fluid py-3 pt-4 bb-grey sticky">
          <div class="row">
            <div class="col-md-2">
                <a href="<?php echo base_url('Admin/Orders');?>">
              <i class="fa fa-arrow-left" aria-hidden="true"></i></a>
            </div>
            <div class="col-md-7">
              <h4><?php echo $title;?></h4>
            </div>
            <div class="col-md-3 d-flex justify-content-between ml-3">
              <a href="<?php echo base_url('Admin/Orders');?>" class="btn b-light"> Cancel</a>
              <input type="submit" class="btn b-success" name="publish" value="Publish"/>
            </div>
          </div>
        </div>
        <div class="container-fluid py-3 pt-4">
          <div class="row">
            <div class="col-md-12">
              <!-- <div class="col-mdc-2 bg-secondary pl-5 hc-4"></div>
              <div class="col-md-8"></div>
              <div class="col-mdc-2">
                <button class="btn btn-block b-success">Choose Image</button>
              </div> -->
              
            </div>
            <div class="col-md-4">
                <h5>English</h5>
              <div class="row bb-grey">
                <div class="col-md-12 m-3">
                    <h4>Order Type</h4>
                  <div class="form-group">
                    <input type="radio" name="type" id="1"/> 
                    <label for="1">Online</label>
                     <input type="radio" name="type" id="2"/> 
                    <label for="2">Offline</label>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Date & Time</label>
                    <input type="date" class="form-control"  name="password"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Amount (in KWD)</label>
                    <input type="text" class="form-control"  name="name" value="" required>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Payment Type</label>
                    <select class="form-control">
                        <option value="">Select Payment Type</option>
                        <option value="COD">Cash on Delivery</option>
                        <option value="online payment">Online Payment</option>
                        <option value="credit points">Credit Points</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Driver</label>
                    <input type="text" class="form-control"  name="name" value="" disabled>
                  </div>
                  <span class="text-danger"><?php echo form_error('name'); ?></span>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Resturant</label>
                    <input type="text" class="form-control"  name="name" value="" disabled>
                  </div>
                </div>
                 <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Branch</label>
                    <input type="text" class="form-control"  name="name" value="">
                  </div>
                </div>
              </div>
              <div class="row bb-grey">
                  <h4>Customer Location</h4>
                  <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Full Name</label>
                    <input type="text" class="form-control"  name="name"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Area</label>
                    <input type="text" class="form-control"  name="area"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Block No</label>
                    <input type="text" class="form-control"  name="block"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Street</label>
                    <input type="text" class="form-control"  name="street"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Jaada</label>
                    <input type="text" class="form-control"  name="jaada"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Room No</label>
                    <input type="text" class="form-control"  name="room"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Floor No</label>
                    <input type="text" class="form-control"  name="floor"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>House No</label>
                    <input type="text" class="form-control"  name="house"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Building No</label>
                    <input type="text" class="form-control"  name="building"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Landmark( optional)</label>
                    <input type="text" class="form-control"  name="landmark"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Phone No</label>
                    <input type="text" class="form-control"  name="phone"/>
                  </div>
                </div>
              </div>
              <div class="row bb-grey">
                  <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Lattitude</label>
                    <input type="text" class="form-control"  name="latitude"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Longitude</label>
                    <input type="text" class="form-control"  name="longitude"/>
                  </div>
                </div>
              </div>
              <div class="row bb-grey">
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>ETA to Resturant : null</label>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>ETA to Customer : null</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              
            </div>
            <div class="col-md-4">
                <h5>Arabic</h5>
              <div class="row bb-grey">
                <div class="col-md-12 m-3">
                    <h4>Order Type</h4>
                  <div class="form-group">
                    <input type="radio" name="type" id="1"/> 
                    <label for="1">Online</label>
                     <input type="radio" name="type" id="2"/> 
                    <label for="2">Offline</label>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Date & Time</label>
                    <input type="date" class="form-control"  name="password"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Amount (in KWD)</label>
                    <input type="text" class="form-control"  name="name" value="" required>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Payment Type</label>
                    <select class="form-control">
                        <option value="">Select Payment Type</option>
                        <option value="COD">Cash on Delivery</option>
                        <option value="online payment">Online Payment</option>
                        <option value="credit points">Credit Points</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Driver</label>
                    <input type="text" class="form-control"  name="name" value="" disabled>
                  </div>
                  <span class="text-danger"><?php echo form_error('name'); ?></span>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Resturant</label>
                    <input type="text" class="form-control"  name="name" value="" disabled>
                  </div>
                </div>
                 <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label >Branch</label>
                    <input type="text" class="form-control"  name="name" value="">
                  </div>
                </div>
              </div>
              <div class="row bb-grey">
                  <h4>Customer Location</h4>
                  <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Full Name</label>
                    <input type="text" class="form-control"  name="name"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Area</label>
                    <input type="text" class="form-control"  name="area"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Block No</label>
                    <input type="text" class="form-control"  name="block"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Street</label>
                    <input type="text" class="form-control"  name="street"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Jaada</label>
                    <input type="text" class="form-control"  name="jaada"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Room No</label>
                    <input type="text" class="form-control"  name="room"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Floor No</label>
                    <input type="text" class="form-control"  name="floor"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>House No</label>
                    <input type="text" class="form-control"  name="house"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Building No</label>
                    <input type="text" class="form-control"  name="building"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Landmark( optional)</label>
                    <input type="text" class="form-control"  name="landmark"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Phone No</label>
                    <input type="text" class="form-control"  name="phone"/>
                  </div>
                </div>
              </div>
              <div class="row bb-grey">
                  <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Lattitude</label>
                    <input type="text" class="form-control"  name="latitude"/>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>Longitude</label>
                    <input type="text" class="form-control"  name="longitude"/>
                  </div>
                </div>
              </div>
              <div class="row bb-grey">
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>ETA to Resturant : null</label>
                  </div>
                </div>
                <div class="col-md-12 m-3">
                  <div class="form-group b-grey">
                    <label>ETA to Customer : null</label>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
</form>