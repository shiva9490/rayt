<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, shrink-to-fit=9">
      <meta name="description" content="rayt">
      <meta name="author" content="rayt">
      <title>Rayt</title>
      <link rel="icon" type="image/png" href="<?php echo base_url('tassets/');?>images/fav.png">
      <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
      <link href='<?php echo base_url('tassets/');?>vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
      <link href="<?php echo base_url('tassets/');?>css/style.css" rel="stylesheet">
      <link href="<?php echo base_url('tassets/');?>css/responsive.css" rel="stylesheet">
      <link href="<?php echo base_url('tassets/');?>css/night-mode.css" rel="stylesheet">
      <link href="<?php echo base_url('tassets/');?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
      <link href="<?php echo base_url('tassets/');?>vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
      <link href="<?php echo base_url('tassets/');?>vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
      <link href="<?php echo base_url('tassets/');?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('tassets/');?>vendor/semantic/semantic.min.css">
   </head>
   <body>
    
    <div class="bs-canvas bs-canvas-left position-fixed bg-cart h-100">
        <div class="bs-canvas-header side-cart-header p-3 ">
           <div class="d-inline-block  main-cart-title">My Cart <span>(2 Items)</span></div>
           <button type="button" class="bs-canvas-close close" aria-label="Close"><i class="uil uil-multiply"></i></button>
        </div>
        <div class="bs-canvas-body">
           <div class="cart-top-total">
              <div class="cart-total-dil">
                 <h4>Total Cart</h4>
                 <span>KD 34</span>
              </div>
              <div class="cart-total-dil pt-2">
                 <h4>Delivery Charges</h4>
                 <span>KD 1</span>
              </div>
           </div>
           <div class="side-cart-items">
              <div class="cart-item">
                 <div class="cart-product-img">
                    <img src="<?php echo base_url('tassets/');?>images/product/img-1.jpg" alt="">
                    <div class="offer-badge">6% OFF</div>
                 </div>
                 <div class="cart-text">
                    <h4>Product Title Here</h4>
                    <div class="cart-radio">
                       <ul class="kggrm-now">
                          <li>
                             <input type="radio" id="a1" name="cart1">
                             <label for="a1">0.50</label>
                          </li>
                          <li>
                             <input type="radio" id="a2" name="cart1">
                             <label for="a2">1kg</label>
                          </li>
                          <li>
                             <input type="radio" id="a3" name="cart1">
                             <label for="a3">2kg</label>
                          </li>
                          <li>
                             <input type="radio" id="a4" name="cart1">
                             <label for="a4">3kg</label>
                          </li>
                       </ul>
                    </div>
                    <div class="qty-group">
                       <div class="quantity buttons_added">
                          <input type="button" value="-" class="minus minus-btn">
                          <input type="number" step="1" name="quantity" value="1" class="input-text qty text">
                          <input type="button" value="+" class="plus plus-btn">
                       </div>
                       <div class="cart-item-price">KD 10 <span>KD 15</span></div>
                    </div>
                    <button type="button" class="cart-close-btn"><i class="uil uil-multiply"></i></button>
                 </div>
              </div>
              <div class="cart-item">
                 <div class="cart-product-img">
                    <img src="<?php echo base_url('tassets/');?>images/product/img-2.jpg" alt="">
                    <div class="offer-badge">6% OFF</div>
                 </div>
                 <div class="cart-text">
                    <h4>Product Title Here</h4>
                    <div class="cart-radio">
                       <ul class="kggrm-now">
                          <li>
                             <input type="radio" id="a5" name="cart2">
                             <label for="a5">0.50</label>
                          </li>
                          <li>
                             <input type="radio" id="a6" name="cart2">
                             <label for="a6">1kg</label>
                          </li>
                          <li>
                             <input type="radio" id="a7" name="cart2">
                             <label for="a7">2kg</label>
                          </li>
                       </ul>
                    </div>
                    <div class="qty-group">
                       <div class="quantity buttons_added">
                          <input type="button" value="-" class="minus minus-btn">
                          <input type="number" step="1" name="quantity" value="1" class="input-text qty text">
                          <input type="button" value="+" class="plus plus-btn">
                       </div>
                       <div class="cart-item-price">KD 24 <span>KD 30</span></div>
                    </div>
                    <button type="button" class="cart-close-btn"><i class="uil uil-multiply"></i></button>
                 </div>
              </div>
           </div>
        </div>
        <div class="bs-canvas-footer">
           <div class="cart-total-dil saving-total ">
              <h4>Total Saving</h4>
              <span>KD11</span>
           </div>
           <div class="main-total-cart">
              <h2>Total</h2>
              <span>KD 35</span>
           </div>
           <div class="checkout-cart">
              <a href="#" class="promo-code">Have a promocode?</a>
              <a href="#" class="cart-checkout-btn hover-btn">Proceed to Checkout</a>
           </div>
        </div>
     </div>
      <header class="header clearfix">
         <div class="top-header-group">
            <div class="top-header">              
               <div class="select_location">
                  <div class="ui inline dropdown loc-title">
                     <div class="text">
                        <i class="uil uil-location-point"></i>
                        Kuwait
                     </div> 
                  </div>
               </div>
             
               <div class="header_right">
                  <ul>
                     <li>
                        <a href="#" class="offer-link"><i class="uil uil-phone-alt"></i>1800-000-000</a>
                     </li>     
                             
                     <li>
                        <a href="#" class="option_links" title="Wishlist"><i class='uil uil-heart icon_wishlist'></i><span class="noti_count1">3</span></a>
                     </li>
                     <li class="ui dropdown">
                        <a href="#" class="opts_account">
                        <img src="<?php echo base_url('tassets/');?>images/avatar/img-5.jpg" alt="">
                        <span class="user__name">John Doe</span>
                        <i class="uil uil-angle-down"></i>
                        </a>
                        <div class="menu dropdown_account">    
                           <div class="night_mode_switch__btn">
                              <a href="#" id="night-mode" class="btn-night-mode">
                              <i class="uil uil-moon"></i> Night mode
                              <span class="btn-night-mode-switch">
                              <span class="uk-switch-button"></span>
                              </span>
                              </a>
                           </div>                     
                           <a href="#" class="item channel_item"><i class="uil uil-apps icon__1"></i>Dashbaord</a>
                           <a href="#" class="item channel_item"><i class="uil uil-box icon__1"></i>My Orders</a>
                           <a href="#" class="item channel_item"><i class="uil uil-heart icon__1"></i>My Wishlist</a>
                           <a href="#" class="item channel_item"><i class="uil uil-usd-circle icon__1"></i>My Wallet</a>
                           <a href="#" class="item channel_item"><i class="uil uil-location-point icon__1"></i>My Address</a>
                           <a href="#" class="item channel_item"><i class="uil uil-gift icon__1"></i>Offers</a>
                           <a href="#" class="item channel_item"><i class="uil uil-info-circle icon__1"></i>Faq</a>
                           <a href="#" class="item channel_item"><i class="uil uil-lock-alt icon__1"></i>Logout</a>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="sub-header-group">
            <div class="sub-header">
               <div class="ui dropdown">
                  <a href="#" class="category_drop" ><img src="<?php echo base_url('tassets/');?>images/logo.png" class="logos" /> </a>
               </div>
               <nav class="navbar navbar-expand-lg navbar-light py-3">
                  <div class="container-fluid">
                     <button class="navbar-toggler menu_toggle_btn" type="button" data-target="#navbarSupportedContent"><i class="uil uil-bars"></i></button>
                     <div class="collapse navbar-collapse d-flex flex-column flex-lg-row flex-xl-row justify-content-lg-end bg-dark1 p-3 p-lg-0 mt1-5 mt-lg-0 mobileMenu" id="navbarSupportedContent">
                        <ul class="navbar-nav main_nav align-self-stretch">
                           <li class="nav-item"><a href="#" class="nav-link active" title="Home">Offers</a></li>
                           <li class="nav-item"><a href="#" class="nav-link new_item" title="New Products">Become Partners</a></li>
                           <li class="nav-item"><a href="#" class="nav-link" title="Featured Products">Featured a Products</a></li>                         
                           <li class="nav-item"><a href="#" class="nav-link" title="Contact">All restaurant</a></li>
                           <li class="nav-item"><a href="#" class="nav-link" title="Contact">العربية</a></li>                           
                        </ul>
                     </div>
                  </div>
               </nav>
               <div class="header_cart order-1">
                <a href="#" class="cart__btn hover-btn pull-bs-canvas-left" title="Cart"><i class="uil uil-shopping-cart-alt"></i><span>Cart</span><ins>2</ins><i class="uil uil-angle-down"></i></a>
                </div>
             
            </div>
         </div>
      </header>
      <div class="wrapper">
         <div class="main-banner-slider banner-bg">
            <div class="container">
               <div class="row">
                  <div class="col-md-6">
                      <div class="" style="">
                        <img class="ms-px-n-lg-45 d-lg-block d-none position-absolute top-px-lg-23 start-px-lg-0" src="<?php echo base_url('tassets/');?>images/banners/f100.png" alt="hero flower image">
                        <div class="wrap">
                            <div class="mb-5">
                                <h1 class="bnh1">Order food and grocery delivery online from hundreds of restaurants and shops nearby.</h1>
                            </div>
                            <div class="search">
                               <input type="text" class="searchTerm" placeholder="What are you looking for?">
                               <button type="submit" class="searchButton">
                                 <i class="fa fa-search"></i>
                              </button>
                            </div>
                         </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="main-banner-slider">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="owl-carousel offers-banner owl-theme">
                        <div class="item">
                           <div class="offer-item">
                              <div class="offer-item-img">
                                 <div class="gambo-overlay"></div>
                                 <img src="<?php echo base_url('tassets/');?>images/banners/offer-1.jpg" alt="">
                              </div>
                              <div class="offer-text-dt">
                                 <div class="offer-top-text-banner">
                                    <p>6% Off</p>
                                    <div class="top-text-1">Buy More & Save More</div>
                                    <span>Fresh Vegetables</span>
                                 </div>
                                 <a href="#" class="Offer-shop-btn hover-btn">Shop Now</a>
                              </div>
                           </div>
                        </div>
                        <div class="item">
                           <div class="offer-item">
                              <div class="offer-item-img">
                                 <div class="gambo-overlay"></div>
                                 <img src="<?php echo base_url('tassets/');?>images/banners/offer-2.jpg" alt="">
                              </div>
                              <div class="offer-text-dt">
                                 <div class="offer-top-text-banner">
                                    <p>5% Off</p>
                                    <div class="top-text-1">Buy More & Save More</div>
                                    <span>Fresh Fruits</span>
                                 </div>
                                 <a href="#" class="Offer-shop-btn hover-btn">Shop Now</a>
                              </div>
                           </div>
                        </div>
                        <div class="item">
                           <div class="offer-item">
                              <div class="offer-item-img">
                                 <div class="gambo-overlay"></div>
                                 <img src="<?php echo base_url('tassets/');?>images/banners/offer-3.jpg" alt="">
                              </div>
                              <div class="offer-text-dt">
                                 <div class="offer-top-text-banner">
                                    <p>3% Off</p>
                                    <div class="top-text-1">Hot Deals on New Items</div>
                                    <span>Daily Essentials Eggs & Dairy</span>
                                 </div>
                                 <a href="#" class="Offer-shop-btn hover-btn">Shop Now</a>
                              </div>
                           </div>
                        </div>
                        <div class="item">
                           <div class="offer-item">
                              <div class="offer-item-img">
                                 <div class="gambo-overlay"></div>
                                 <img src="<?php echo base_url('tassets/');?>images/banners/offer-4.jpg" alt="">
                              </div>
                              <div class="offer-text-dt">
                                 <div class="offer-top-text-banner">
                                    <p>2% Off</p>
                                    <div class="top-text-1">Buy More & Save More</div>
                                    <span>Beverages</span>
                                 </div>
                                 <a href="#" class="Offer-shop-btn hover-btn">Shop Now</a>
                              </div>
                           </div>
                        </div>
                        <div class="item">
                           <div class="offer-item">
                              <div class="offer-item-img">
                                 <div class="gambo-overlay"></div>
                                 <img src="<?php echo base_url('tassets/');?>images/banners/offer-5.jpg" alt="">
                              </div>
                              <div class="offer-text-dt">
                                 <div class="offer-top-text-banner">
                                    <p>3% Off</p>
                                    <div class="top-text-1">Buy More & Save More</div>
                                    <span>Nuts & Snacks</span>
                                 </div>
                                 <a href="#" class="Offer-shop-btn hover-btn">Shop Now</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="restant-area">
            <div class="restant-shape"><img  src="<?php echo base_url('tassets/');?>images/banners/services-shape2.png" alt="Shape"></div>
            <div class="container-fluid">
               <div class="row textcenter">
                  <div class="col-lg-6">
                     <div class="restant-img"><img src="<?php echo base_url('tassets/');?>images/banners/restant.png" alt="Restant">
                        <img src="<?php echo base_url('tassets/');?>images/banners/restant2.png" class="img-responsive" alt="Restant">
                        <img src="<?php echo base_url('tassets/');?>images/banners/restant3.png" class="img-responsive" alt="Restant">
                        <img src="<?php echo base_url('tassets/');?>images/banners/restant4.png" class="img-responsive" alt="Restant">
                        <img src="<?php echo base_url('tassets/');?>images/banners/restant5.png" class="img-responsive" alt="Restant"></div>
                  </div>
                  <div class="col-lg-6">
                     <div class="restant-content">
                        <div class="section-title">
                           <h2 >Your everyday, right away</h2>
                           <p >Order food and grocery delivery online from hundreds of restaurants and shops nearby.</p>
                           <ul class="downloadimg">
                              <li><a href="#"><img class="download-btn img-responsive" src="<?php echo base_url('tassets/');?>images/download-1.svg" alt=""></a></li>
                              <li><a href="#"><img class="download-btn img-responsive" src="<?php echo base_url('tassets/');?>images/download-2.svg" alt=""></a></li>
                              <li><a href="#"><img class="download-btn img-responsive" src="<?php echo base_url('tassets/');?>images/logo_huaweistore1.svg" alt=""></a></li>
                           </ul>
                          

                        </div>
                     
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="section145">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="main-title-tt">
                        <div class="main-title-left">
                           <span>Offers</span>
                           <h2>Best Values</h2>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                     <a href="#" class="best-offer-item">
                     <img src="<?php echo base_url('tassets/');?>images/best-offers/offer-1.jpg" alt="">
                     </a>
                  </div>
                  <div class="col-lg-4 col-md-6">
                     <a href="#" class="best-offer-item">
                     <img src="<?php echo base_url('tassets/');?>images/best-offers/offer-2.jpg" alt="">
                     </a>
                  </div>
                  <div class="col-lg-4 col-md-6">
                     <a href="#" class="best-offer-item offr-none">
                        <img src="<?php echo base_url('tassets/');?>images/best-offers/offer-3.jpg" alt="">
                        <div class="cmtk_dt">
                           <div class="product_countdown-timer offer-counter-text" data-countdown="2021/01/06"></div>
                        </div>
                     </a>
                  </div>
                  <div class="col-md-12">
                     <a href="#" class="code-offer-item">
                     <img src="<?php echo base_url('tassets/');?>images/best-offers/offer-4.jpg" alt="">
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="section145 ">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="main-title-tt">
                        <div class="main-title-left">
                           <span>For You</span>
                           <h2>Added New Products</h2>
                        </div>
                        <a href="#" class="see-more-btn">See All</a>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="owl-carousel featured-slider owl-theme">
                        <div class="item">
                           <div class="product-item">
                              <a href="#" class="product-img">
                                 <img src="<?php echo base_url('tassets/');?>images/product/img-10.jpg" alt="">
                                 <div class="product-absolute-options">
                                    <span class="offer-badge-1">New</span>
                                    <span class="like-icon" title="wishlist"></span>
                                 </div>
                              </a>
                              <div class="product-text-dt">
                                 <p>Available<span>(In Stock)</span></p>
                                 <h4>Product Title Here</h4>
                                 <div class="product-price">KD 12 <span>KD 15</span></div>
                                 <div class="qty-cart">
                                    <div class="quantity buttons_added">
                                       <input type="button" value="-" class="minus minus-btn">
                                       <input type="number" step="1" name="quantity" value="1" class="input-text qty text">
                                       <input type="button" value="+" class="plus plus-btn">
                                    </div>
                                    <span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="item">
                           <div class="product-item">
                              <a href="#" class="product-img">
                                 <img src="<?php echo base_url('tassets/');?>images/product/img-9.jpg" alt="">
                                 <div class="product-absolute-options">
                                    <span class="offer-badge-1">New</span>
                                    <span class="like-icon" title="wishlist"></span>
                                 </div>
                              </a>
                              <div class="product-text-dt">
                                 <p>Available<span>(In Stock)</span></p>
                                 <h4>Product Title Here</h4>
                                 <div class="product-price">KD 10</div>
                                 <div class="qty-cart">
                                    <div class="quantity buttons_added">
                                       <input type="button" value="-" class="minus minus-btn">
                                       <input type="number" step="1" name="quantity" value="1" class="input-text qty text">
                                       <input type="button" value="+" class="plus plus-btn">
                                    </div>
                                    <span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="item">
                           <div class="product-item">
                              <a href="#" class="product-img">
                                 <img src="<?php echo base_url('tassets/');?>images/product/img-15.jpg" alt="">
                                 <div class="product-absolute-options">
                                    <span class="offer-badge-1">5% off</span>
                                    <span class="like-icon" title="wishlist"></span>
                                 </div>
                              </a>
                              <div class="product-text-dt">
                                 <p>Available<span>(In Stock)</span></p>
                                 <h4>Product Title Here</h4>
                                 <div class="product-price">KD 5</div>
                                 <div class="qty-cart">
                                    <div class="quantity buttons_added">
                                       <input type="button" value="-" class="minus minus-btn">
                                       <input type="number" step="1" name="quantity" value="1" class="input-text qty text">
                                       <input type="button" value="+" class="plus plus-btn">
                                    </div>
                                    <span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="item">
                           <div class="product-item">
                              <a href="#" class="product-img">
                                 <img src="<?php echo base_url('tassets/');?>images/product/img-11.jpg" alt="">
                                 <div class="product-absolute-options">
                                    <span class="offer-badge-1">New</span>
                                    <span class="like-icon" title="wishlist"></span>
                                 </div>
                              </a>
                              <div class="product-text-dt">
                                 <p>Available<span>(In Stock)</span></p>
                                 <h4>Product Title Here</h4>
                                 <div class="product-price">KD 15 <span>KD 16</span></div>
                                 <div class="qty-cart">
                                    <div class="quantity buttons_added">
                                       <input type="button" value="-" class="minus minus-btn">
                                       <input type="number" step="1" name="quantity" value="1" class="input-text qty text">
                                       <input type="button" value="+" class="plus plus-btn">
                                    </div>
                                    <span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="item">
                           <div class="product-item">
                              <a href="#" class="product-img">
                                 <img src="<?php echo base_url('tassets/');?>images/product/img-14.jpg" alt="">
                                 <div class="product-absolute-options">
                                    <span class="offer-badge-1">New</span>
                                    <span class="like-icon" title="wishlist"></span>
                                 </div>
                              </a>
                              <div class="product-text-dt">
                                 <p>Available<span>(In Stock)</span></p>
                                 <h4>Product Title Here</h4>
                                 <div class="product-price">KD 9</div>
                                 <div class="qty-cart">
                                    <div class="quantity buttons_added">
                                       <input type="button" value="-" class="minus minus-btn">
                                       <input type="number" step="1" name="quantity" value="1" class="input-text qty text">
                                       <input type="button" value="+" class="plus plus-btn">
                                    </div>
                                    <span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="item">
                           <div class="product-item">
                              <a href="#" class="product-img">
                                 <img src="<?php echo base_url('tassets/');?>images/product/img-2.jpg" alt="">
                                 <div class="product-absolute-options">
                                    <span class="offer-badge-1">New</span>
                                    <span class="like-icon" title="wishlist"></span>
                                 </div>
                              </a>
                              <div class="product-text-dt">
                                 <p>Available<span>(In Stock)</span></p>
                                 <h4>Product Title Here</h4>
                                 <div class="product-price">KD 7</div>
                                 <div class="qty-cart">
                                    <div class="quantity buttons_added">
                                       <input type="button" value="-" class="minus minus-btn">
                                       <input type="number" step="1" name="quantity" value="1" class="input-text qty text">
                                       <input type="button" value="+" class="plus plus-btn">
                                    </div>
                                    <span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="item">
                           <div class="product-item">
                              <a href="#" class="product-img">
                                 <img src="<?php echo base_url('tassets/');?>images/product/img-5.jpg" alt="">
                                 <div class="product-absolute-options">
                                    <span class="offer-badge-1">New</span>
                                    <span class="like-icon" title="wishlist"></span>
                                 </div>
                              </a>
                              <div class="product-text-dt">
                                 <p>Available<span>(In Stock)</span></p>
                                 <h4>Product Title Here</h4>
                                 <div class="product-price">KD 6.95</div>
                                 <div class="qty-cart">
                                    <div class="quantity buttons_added">
                                       <input type="button" value="-" class="minus minus-btn">
                                       <input type="number" step="1" name="quantity" value="1" class="input-text qty text">
                                       <input type="button" value="+" class="plus plus-btn">
                                    </div>
                                    <span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="item">
                           <div class="product-item">
                              <a href="#" class="product-img">
                                 <img src="<?php echo base_url('tassets/');?>images/product/img-6.jpg" alt="">
                                 <div class="product-absolute-options">
                                    <span class="offer-badge-1">New</span>
                                    <span class="like-icon" title="wishlist"></span>
                                 </div>
                              </a>
                              <div class="product-text-dt">
                                 <p>Available<span>(In Stock)</span></p>
                                 <h4>Product Title Here</h4>
                                 <div class="product-price">KD 8 <span>8.75</span></div>
                                 <div class="qty-cart">
                                    <div class="quantity buttons_added">
                                       <input type="button" value="-" class="minus minus-btn">
                                       <input type="number" step="1" name="quantity" value="1" class="input-text qty text">
                                       <input type="button" value="+" class="plus plus-btn">
                                    </div>
                                    <span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <section  class="reservation-area">
      
         <div  class="container">
            <div  class="row text-center">
               <div  class="col-lg-7">
                  <div  class="reservation-item">
                     <div  class="section-title">
                        <h2 class="text-left">Join us</h2>
                        <p class=" text-left">Be a part of the Rayt story</p>
                     </div>
                     <div class="row">
                        <div class="col-md-6">                          
                           <div class="become">
                              <div class="row">
                                 <div class="col-md-5 ">
                                    <img src="<?php echo base_url('tassets/');?>images/banners/partner.png"  class="img-responsive"/>
                                    </div>
                                 <div class="col-md-7 pl-0">
                                    <h4 class="">Become a partner</h4>
                                    <p class="">Reach more customers and achieve growth with us</p>
                                    <a href="#" class="restbtn">Find Out More</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="become">
                              <div class="row">
                                 <div class="col-md-5">
                                    <img src="<?php echo base_url('tassets/');?>images/banners/career.png"  class="img-responsive"/>
                                    </div>
                                 <div class="col-md-7 pl-0">
                                    <h4 class="">Build your career</h4>
                                    <p class="">Join the dynamic team that makes it all happen</p>
                                    <a href="#"  class="restbtn">Find Job</a>
                                 </div>
                              </div>
                           </div>  
                        </div>
                     </div>
                    
                  </div>
               </div>
               <div  class="col-lg-5">
                  <div  class="reservation-img"><img  src="<?php echo base_url('tassets/');?>images/banners/subscribe-main.png" class="img-responsive" alt="Reservation"></div>
               </div>
            </div>
         </div>
      </section>
      <footer class="footer">        
         <div class="footer-second-row">
            <div class="container">
               <div class="row">
                  <div class="col-lg-3 col-md-6 col-sm-6">
                     <div class="second-row-item">
                        <h4>Categories</h4>
                        <ul>
                           <li><a href="#">Fruits and Vegetables</a></li>
                           <li><a href="#">Grocery & Staples</a></li>
                           <li><a href="#">Dairy & Eggs</a></li>
                           <li><a href="#">Beverages</a></li>
                           <li><a href="#">Snacks</a></li>                      
                           <li><a href="#">Meat & Seafood</a></li>
                           <li><a href="#">Electronics</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6">
                     <div class="second-row-item">
                        <h4>Useful Links</h4>
                        <ul>
                           <li><a href="#">About US</a></li>
                           <li><a href="#">Featured Products</a></li>
                           <li><a href="#">Offers</a></li>
                           <li><a href="#">Blog</a></li>
                           <li><a href="#">Faq</a></li>
                           <li><a href="#">Careers</a></li>
                           <li><a href="#">Contact Us</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6">
                     <div class="second-row-item">
                        <h4>Get In Touch</h4>
                        <ul>   
                            <li><a href="#" class="callemail"><i class="uil uil-map-marker-alt"></i>Address</a></li>                        
                            <li><a href="#" class="callemail"><i class="uil uil-phone"></i>1800-000-000</a></li>
                            <li><a href="#" class="callemail"><i class="uil uil-envelope-alt"></i><span class="__cf_email__" >info@Rayt.com</span></a></li>                          
                        </ul>
                        <div class="social-links-footer mt-4">
                            <h5 class="text-left">Follow us</h5>
                            <ul class="d-flex">
                               <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                               <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                               <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                               <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                               <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                               <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                            </ul>
                         </div>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6">
                     <div class="second-row-item-app">
                        <h4>Download App</h4>
                        <ul>
                           <li><a href="#"><img class="download-btn" src="<?php echo base_url('tassets/');?>images/download-1.svg" alt=""></a></li>
                           <li><a href="#"><img class="download-btn" src="<?php echo base_url('tassets/');?>images/download-2.svg" alt=""></a></li>
                           <li><a href="#"><img class="download-btn" src="<?php echo base_url('tassets/');?>images/logo_huaweistore1.svg" alt=""></a></li>
                        </ul>
                       
                     </div>                   
                     
                  </div>
               </div>
            </div>
         </div>
         <div class="footer-last-row">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="footer-bottom-links">
                        <ul>
                           <li><a href="#">About</a></li>
                           <li><a href="#">Contact</a></li>
                           <li><a href="#">Privacy Policy</a></li>
                           <li><a href="#">Term & Conditions</a></li>
                           <li><a href="#">Refund & Return Policy</a></li>
                        </ul>
                     </div>
                     <div class="copyright-text">
                        <i class="uil uil-copyright"></i>Copyright 2021 <b>Rayt</b> . All rights reserved
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <script src="<?php echo base_url('tassets/');?>js/jquery-3.3.1.min.js"></script>
      <script src="<?php echo base_url('tassets/');?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="<?php echo base_url('tassets/');?>vendor/OwlCarousel/owl.carousel.js"></script>
      <script src="<?php echo base_url('tassets/');?>vendor/semantic/semantic.min.js"></script>
      <script src="<?php echo base_url('tassets/');?>js/jquery.countdown.min.js"></script>
      <script src="<?php echo base_url('tassets/');?>js/custom.js"></script>
      <script src="<?php echo base_url('tassets/');?>js/offset_overlay.js"></script>
      <script src="<?php echo base_url('tassets/');?>js/night-mode.js"></script>
   </body>
  </html>