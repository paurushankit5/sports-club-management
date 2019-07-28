<!DOCTYPE html>
<!-- 
	Template Name: SportsZone: Sports Club, New & Game Magazine Mobile Responsive Bootstrap Html Template 
	Version: 1.0
	Author: DexignZone
	Website: http://www.dexignzone.com/
	Contact: dexignexpert@gmail.com
	Follow: www.twitter.com/dexignzones
	Like: www.facebook.com/dexignzone
	
-->
<!--[if IE 7 ]>  <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>  <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>  <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!-- Meta -->
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="" />
<meta name="author" content="" />
<meta name="robots" content="" />
<meta name="description" content="" />
<meta property="og:title" content="" />
<meta property="og:description" content="" />
<meta property="og:image" content="social-image.html" />
<meta name="format-detection" content="telephone=no">
<!-- Favicons Icon -->
<link rel="icon" href="ico/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" type="image/x-icon" href="front/png/favicon.png" />
<!-- Page Title Here -->
<title>@yield('title')</title>

<base href="{{env('APP_URL')}}">
<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if lt IE 9]>
        <script src="front/js/html5shiv.min.js"></script>
        <script src="front/js/respond.min.js"></script>
	<![endif]-->
<!-- Stylesheets -->
@yield('extra_before_css')

<link rel="stylesheet" type="text/css" href="{{ asset('front/css/plugins.css') }}">

<link rel="stylesheet" type="text/css" href="hover.html">
<!-- <link class="skin"  rel="stylesheet" type="text/css" href="front/css/skin-1.css"> -->
<link  rel="stylesheet" type="text/css" href="{{ asset('front/css/templete.css') }}">
<!-- Revolution Slider Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('front/css/settings.css') }}">
<!-- Revolution Navigation Style -->
<link rel="stylesheet" type="text/css" href="{{ asset('front/css/navigation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('front/css/style.css') }}">
<link class="skin"  rel="stylesheet" type="text/css" href="{{ asset('front/css/skin-2.css') }}">
<link  rel="stylesheet" type="text/css" href="{{ asset('front/css/front_extra.css') }}">


<!-- Google fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900|Open+Sans:300,400,600,700,800|Oswald:300,400,700|Roboto:100,300,400,500,700,900" rel="stylesheet"> 

@yield('extra_after_css')

</head>
<body id="bg">
<div class="page-wraper">
		<!-- header -->
          @include('front.layouts.nav')

        <!-- header END -->

        @yield('main')	

		<!-- Content -->
	</div>

			
   <!-- Content END-->
    <!-- Footer -->
<footer class="site-footer" style="display: block; height: 659px;">
        <div class="footer-top text-white footer-image overlay-black-dark bg-img-fix" style="background-image:url(front/jpg/bg3.jpg); background-attachment: fixed;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 footer-col-4">
                        <div class="widget widget_about">
                            <div class="logo-footer"><img src="png/footer-logo.png" alt=""></div>
                            <p class="m-t40"><strong>SportsZone</strong>  Lorem ipsum dolor sit amet, cons ectetur elit. Vestibulum nec odios Suspe ndisse cursus.  cons ectetur elit. Vestibulum nec odios Lorem ipsum dolor sit amet, cons ectetur elit. Vestibulum nec.</p>
                            <ul class="dez-social-icon border dez-social-icon-lg">
                                <li><a href="javascript:void(0);" class="fa fa-facebook fb-btn"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-twitter tw-btn"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-linkedin link-btn"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-pinterest-p pin-btn"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 footer-col-4">
                        <div class="widget widget_services">
                            <h4 class="m-b15 text-uppercase">Our services</h4>
                            <div class="dez-separator bg-primary"></div>
                            <ul>
                                <li><a href="services-2.html">Membership Offers</a></li>
                                <li><a href="services-2.html">Training Schedule</a></li>
                                <li><a href="services-2.html">Inter Competitions</a></li>
                                <li><a href="services-2.html">Awards &amp; Trophies</a></li>
                                <li><a href="services-2.html">Additional Help </a></li>
                                <li><a href="services-2.html">Training Schedule </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 footer-col-4">
                        <div class="widget widget_getintuch">
                            <h4 class="m-b15 text-uppercase">Contact us</h4>
                            <div class="dez-separator bg-primary"></div>
                            <ul>
                                <li><i class="fa fa-map-marker"></i><strong>address</strong> demo address #8901 Marmora Road Chi Minh City, Vietnam </li>
                                <li><i class="fa fa-phone"></i><strong>phone</strong>0800-123456 (24/7 Support Line)</li>
                                <li><i class="fa fa-fax"></i><strong>FAX</strong>(123) 123-4567<br>
                                    000 123 2294 089</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 footer-col-4">
                        <div class="widget widget_gallery">
                            <h4 class="m-b15 text-uppercase">Recent Post</h4>
                            <div class="dez-separator bg-primary"></div>
                            <ul>
                                <li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic1-3.jpg" alt=""></a> </li>
                                <li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic2-3.jpg" alt=""></a> </li>
                                <li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic3-3.jpg" alt=""></a> </li>
                                <li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic4-3.jpg" alt=""></a> </li>
                                <li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic5.jpg" alt=""></a> </li>
                                <li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic7.jpg" alt=""></a> </li>
                                <li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic6.jpg" alt=""></a> </li>
                                <li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic8.jpg" alt=""></a> </li>
                                <li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic9.jpg" alt=""></a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row dez-newsletter p-a30 style1">
                    <div class="col-lg-4">
                        <div class="icon-bx-wraper left">
                            <div class="icon-lg text-primary radius m-t10"> <a href="#" class="icon-cell"><i class="fa fa-envelope-o"></i></a> </div>
                            <div class="icon-content">
                                <h2 class="dez-tilte m-b0">NewsLetter</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="newsLetter-bx m-t20 m-b10">
                            <form role="search" method="post" action="http://sportszone.dexignlab.com/xhtml/script/mailchamp.php">
                                <div class="dzSubscribeMsg"></div>
                                <div class="input-group">
                                    <input name="dzEmail" required="required" class="form-control" placeholder="Your Email Id" type="email">
                                    <span class="input-group-btn">
                                    <button name="submit" value="Submit" type="submit" class="site-button m-l10">Submit</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer bottom part -->
        <div class="footer-bottom bg-primary">
            <div class="container">
                <div class="row text-white">
                    <div class="col-lg-4 text-left "> <span>Copyright © 2017 DesignZone</span> </div>
                    <div class="col-lg-4 text-center"> <span> Design With <i class="fa fa-heart heart"></i> By Mayank </span> </div>
                    <div class="col-lg-4 text-right "> <a href="about-2.html"> About</a> <a href="help.html"> Help Desk</a> <a href="privacy-policy.html"> Privacy Policy</a> </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer END-->
    <!-- scroll top button -->
    <button class="scroltop fa fa-caret-up" ></button>
</div>
<!-- <div id="loading-area"></div>

 --><!-- JavaScript  files ========================================= -->
<script src="{{ asset('front/js/jquery.min.js') }}"></script><!-- JQUERY.MIN JS -->
<script src="{{ asset('front/js/popper.min.js') }}"></script><!-- BOOTSTRAP.MIN JS -->
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script><!-- BOOTSTRAP.MIN JS -->
<script src="{{ asset('front/js/bootstrap-select.min.js') }}"></script><!-- FORM JS -->
<script src="{{ asset('front/js/jquery.bootstrap-touchspin.js') }}"></script><!-- FORM JS -->
<script src="{{ asset('front/js/magnific-popup.js') }}"></script><!-- MAGNIFIC POPUP JS -->
<script src="{{ asset('front/js/waypoints-min.js') }}"></script><!-- WAYPOINTS JS -->
<script src="{{ asset('front/js/counterup.min.js') }}"></script><!-- COUNTERUP JS -->
<script src="{{ asset('front/js/jquery.countdown.js') }}"></script><!-- COUNTDOWN JS -->
<script src="{{ asset('front/js/imagesloaded.js') }}"></script><!-- IMAGESLOADED -->
<script src="{{ asset('front/js/masonry-3.1.4.js') }}"></script><!-- MASONRY -->
<script src="{{ asset('front/js/masonry.filter.js') }}"></script><!-- MASONRY -->
<script src="{{ asset('front/js/owl.carousel.js') }}"></script><!-- OWL SLIDER -->
<script src="{{ asset('front/js/dz.ajax.js') }}"></script><!-- CONTACT JS  -->

<script src="{{ asset('front/js/dz.carousel.js') }}"></script><!-- SORTCODE FUCTIONS  -->
<!-- revolution JS FILES -->
<script type="text/javascript" src="{{ asset('front/js/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/jquery.themepunch.revolution.min.js') }}"></script>
<!-- Slider revolution 5.0 Extensions  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script type="text/javascript" src="{{ asset('front/js/revolution.extension.actions.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/revolution.extension.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/revolution.extension.kenburn.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/revolution.extension.layeranimation.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/revolution.extension.migration.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/revolution.extension.navigation.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/revolution.extension.parallax.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/revolution.extension.slideanims.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/revolution.extension.video.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/rev.slider.js') }}"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	'use strict';
	dz_rev_slider_1();
});	/*ready*/
</script>
</body>

</html>
