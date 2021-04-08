<html lang="zxx">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <title><?php echo sitedata("site_name");?> :: <?php echo $title;?></title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="<?php echo $desc;?>" />
    <meta name="keywords" content="<?php echo $desc;?>" />
    <meta name="author" content="<?php echo $desc;?>" />
    <meta name="MobileOptimized" content="320" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/animate.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/fonts.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/nice-select.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/settings.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/book.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/swiper.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/venobox.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/testimonial.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/flaticon.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/owl.theme.default.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/settings.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/layers.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/navigation.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>css/toastr.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("themeassets");?>tutor.css" />
    <link rel="shortcut icon" type="image/png" href="<?php echo $this->config->item("themeassets");?>logo.png" />
</head>
<body>
    <div id="preloader">
        <div id="status">
            <img src="<?php echo $this->config->item("themeassets");?>images/preloader.gif" id="preloader_image" alt="loader">
        </div>
    </div>
    <?php $this->load->view("theme/header");?>
    <a id="back2Top" title="Back to top" href="#">&#10148;</a>
    <?php $this->load->view($content);?>
    <?php $this->load->view("theme/footer");?>
    <div class="edu_footer_bottom float_left">
        <div class="container">
            <div class="bottom_footer float_left">
                <p>&copy; 2020-21 <?php echo sitedata("site_name");?>. All Rights Reserved.</p>
            </div>
        </div>
    </div>
    <div class="modal fade updaModl" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="largeModalLabel">Login</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="post" class="lognnform">
                        <div class="login_wrapper">
                             <div class="formsix-pos">
                                <div class="form-group i-email">
                                    <input type="text" class="form-control" name="mobileno" required="" id="email2" placeholder="Username*">
                                </div>
                             </div>
                             <div class="formsix-e">
                                <div class="form-group i-password">
                                    <input type="password" minlength="5" maxlength="50" name="password" class="form-control" required="" id="password2" placeholder="Password *">
                                </div>
                             </div>
                             <div class="login_remember_box">
                                <label class="control control--checkbox">Remember me
                                   <input type="checkbox">	<span class="control__indicator"></span>
                                </label>
                                 <a href="<?php echo base_url("Forgot-Password");?>" class="forget_password">Forgot Password</a>
                             </div>
                             <div class="login_btn_wrapper"><button type="submit" class="btn btn-primary login_btn"> Login </butto`n></div>
                             <div class="login_message">
                                <p>Don’t have an account ? <a href="<?php echo base_url("/Register");?>"> Register Now </a></p>
                             </div>
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade whatspModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <script src="<?php echo $this->config->item("themeassets");?>js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $this->config->item("themeassets");?>js/bootstrap.min.js"></script>
    <script src="<?php echo $this->config->item("themeassets");?>js/modernizr.js"></script>
    <script src="<?php echo $this->config->item("themeassets");?>js/jquery.themepunch.revolution.min.js"></script>
    <script src="<?php echo $this->config->item("themeassets");?>js/jquery.themepunch.tools.min.js"></script>
    <script src="<?php echo $this->config->item("themeassets");?>js/jquery.countTo.js"></script>
    <script src="<?php echo $this->config->item("themeassets");?>js/jquery.inview.min.js"></script>
    <script src="<?php echo $this->config->item("themeassets");?>js/swiper.min.js"></script>
    <script src="<?php echo $this->config->item("themeassets");?>js/venobox.min.js"></script>
    <script src="<?php echo $this->config->item("themeassets");?>js/owl.carousel.js"></script>
    <script src="<?php echo $this->config->item("themeassets");?>js/jquery.menu-aim.js"></script>
    <script src="<?php echo $this->config->item("themeassets");?>js/jquery.nice-select.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item("themeassets");?>js/revolution.extension.actions.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item("themeassets");?>js/revolution.extension.carousel.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item("themeassets");?>js/revolution.extension.kenburn.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item("themeassets");?>js/revolution.extension.layeranimation.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item("themeassets");?>js/revolution.extension.migration.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item("themeassets");?>js/revolution.extension.navigation.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item("themeassets");?>js/revolution.extension.parallax.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item("themeassets");?>js/revolution.extension.slideanims.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item("themeassets");?>js/revolution.extension.video.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item("themeassets");?>js/custom.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item("themeassets");?>js/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item("themeassets");?>js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item("themeassets");?>js/toastr.min.js"></script>  
    <script type="text/javascript" src="<?php echo $this->config->item("themeassets");?>select2/js/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item("themeassets");?>tutor.js"></script>
    <?php if($this->uri->segment("1") == "") {?>
    <script>
        $(".edu_coll_slider_tabs .nav-tabs a").click(function() {
            var position = $(this).parent().position();
            var width = $(this).parent().width();
            $(".slider").css({
                "left": +position.left,
                "width": width
            });
        });
        var actWidth = $(".edu_coll_slider_tabs .nav-tabs .active").width();
        var actPosition = $(".edu_coll_slider_tabs .nav-tabs .active").position();
        $(".slider").css({
            "left": +actPosition.left,
            "width": actWidth
        });

        // collection Slider
        var swiper = new Swiper('.swiper-container', {
            effect: 'coverflow',
            loop: !0,
            mode: 'horizontal',
            grabCursor: true,
            centeredSlides: !0,
            parallax: !0,
            grabCursor: true,
            effect: 'coverflow',
            slidesPerView: 'auto',
            coverflowEffect: {
                rotate: 20,
                stretch: 0,
                depth: 90,
                modifier: 1,
                slideShadows: !1,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: !0
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
    <script type="text/javascript">
        var tpj = jQuery;
        var revapi467;
        tpj(document).ready(function() {
            if (tpj("#rev_slider_467_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_467_1");
            } else {
                revapi467 = tpj("#rev_slider_467_1").show().revolution({
                    sliderType: "carousel",
                    jsFileLocation: "revolution/js/",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {
                        keyboardNavigation: "off",
                        keyboard_direction: "horizontal",
                        mouseScrollNavigation: "off",
                        mouseScrollReverse: "default",
                        onHoverStop: "off",
                        arrows: {
                            style: "erinyen",
                            enable: true,
                            hide_onmobile: true,
                            hide_under: 600,
                            hide_onleave: true,
                            hide_delay: 200,
                            hide_delay_mobile: 1200,
                            tmp: '<div class="tp-title-wrap">  	<div class="tp-arr-imgholder"></div>    <div class="tp-arr-img-over"></div>	<span class="tp-arr-titleholder">{{title}}</span> </div>',
                            left: {
                                h_align: "left",
                                v_align: "center",
                                h_offset: 30,
                                v_offset: 0
                            },
                            right: {
                                h_align: "right",
                                v_align: "center",
                                h_offset: 30,
                                v_offset: 0
                            }
                        },
                        thumbnails: {
                            style: "gyges",
                            enable: true,
                            width: 60,
                            height: 60,
                            min_width: 60,
                            wrapper_padding: 0,
                            wrapper_color: "transparent",
                            wrapper_opacity: "1",
                            tmp: '<span class="tp-thumb-img-wrap">  <span class="tp-thumb-image"></span></span>',
                            visibleAmount: 5,
                            hide_onmobile: true,
                            hide_under: 800,
                            hide_onleave: false,
                            direction: "horizontal",
                            span: false,
                            position: "inner",
                            space: 5,
                            h_align: "center",
                            v_align: "bottom",
                            h_offset: 0,
                            v_offset: 20
                        }
                    },
                    carousel: {
                        horizontal_align: "center",
                        vertical_align: "center",
                        fadeout: "off",
                        maxVisibleItems: 3,
                        infinity: "on",
                        space: 0,
                        stretch: "off"
                    },
                    viewPort: {
                        enable: true,
                        outof: "pause",
                        visible_area: "80%",
                        presize: false
                    },
                    responsiveLevels: [1240, 1024, 778, 480],
                    visibilityLevels: [1240, 1024, 778, 480],
                    gridwidth: [1240, 1024, 778, 480],
                    gridheight: [600, 600, 500, 400],
                    lazyType: "none",
                    parallax: {
                        type: "mouse",
                        origo: "slidercenter",
                        speed: 2000,
                        levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50, 46, 47, 48, 49, 50, 55],
                        type: "mouse",
                    },
                    shadow: 5,
                    spinner: "off",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    hideThumbsOnMobile: "on",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }
        }); /*ready*/
    </script>
    <?php } ?>
</body>
</html>