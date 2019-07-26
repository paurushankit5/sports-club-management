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
<meta name="description" content="SportsZone is an HTML5/CSS3 eCommerce template that is best for Sports Items/Tools, any kind of stores Like Sports Store, Bike and Cycle Parts, Hardware, Toos, Construction Item." />
<meta property="og:title" content="SportsZone - Sports Template" />
<meta property="og:description" content="SportsZone is an HTML5/CSS3 eCommerce template that is best for Sports Items/Tools, any kind of stores Like Sports Store, Bike and Cycle Parts, Hardware, Toos, Construction Item." />
<meta property="og:image" content="social-image.html" />
<meta name="format-detection" content="telephone=no">
<!-- Favicons Icon -->
<link rel="icon" href="ico/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" type="image/x-icon" href="front/png/favicon.png" />
<!-- Page Title Here -->
<title>@yield('title')</title>
<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if lt IE 9]>
        <script src="front/js/html5shiv.min.js"></script>
        <script src="front/js/respond.min.js"></script>
	<![endif]-->
<!-- Stylesheets -->
<link rel="stylesheet" type="text/css" href="front/css/plugins.css">
<link rel="stylesheet" type="text/css" href="front/css/style.css">
<link rel="stylesheet" type="text/css" href="hover.html">
<!-- <link class="skin"  rel="stylesheet" type="text/css" href="front/css/skin-1.css"> -->
<link class="skin"  rel="stylesheet" type="text/css" href="front/css/skin-2.css">
<link  rel="stylesheet" type="text/css" href="front/css/templete.css">
<!-- Revolution Slider Css -->
<link rel="stylesheet" type="text/css" href="front/css/settings.css">
<!-- Revolution Navigation Style -->
<link rel="stylesheet" type="text/css" href="front/css/navigation.css">
<!-- Google fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900|Open+Sans:300,400,600,700,800|Oswald:300,400,700|Roboto:100,300,400,500,700,900" rel="stylesheet"> 
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
	<footer class="site-footer footer-overlay bg-img-fix footer-skew" style="background-image: url(jpg/bg5.jpg); background-position: center bottom; background-size: cover; display: block;">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 footer-col-4">
                        <form role="search" method="post" action="http://sportszone.dexignlab.com/xhtml/script/mailchamp.php" class="dzSubscribe bg-primary p-a20 text-white m-t15">
							<h2 class="m-tb0 font-40">Subscribe</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
							<div class="m-tb15">
								<ul class="dez-social-icon border dez-social-icon-lg">
									<li><a href="javascript:void(0);" class="fa fa-facebook fb-btn"></a></li>
									<li><a href="javascript:void(0);" class="fa fa-twitter tw-btn"></a></li>
									<li><a href="javascript:void(0);" class="fa fa-linkedin link-btn"></a></li>
									<li><a href="javascript:void(0);" class="fa fa-pinterest-p pin-btn"></a></li>
								</ul>
							</div>
							<div class="m-b15">
								<div class="dzSubscribeMsg"></div>
								<input name="dzEmail" required="required" class="form-control" placeholder="Email Adddres" type="email">
							</div>
							<div class="">
								<input  name="submit" value="Submit" type="submit" class="site-button button-3d gray btn-block">
							</div>
						</form>
                    </div>
                    <div class="col-lg-3 col-sm-6 footer-col-4">
                        <div class="widget recent-posts-entry">
                            <h4 class="m-b15 text-uppercase">Recent Post</h4>
							<div class="dez-separator bg-primary"></div>
                            <div class="widget-post-bx">
                                <div class="widget-post clearfix">
                                    <div class="dez-post-media"> <img src="front/jpg/pic1-7.jpg" alt="" width="200" height="143"> </div>
                                    <div class="dez-post-info">
                                        <div class="dez-post-header">
                                            <h6 class="post-title"><a href="blog-single.html">Title of first blog</a></h6>
                                        </div>
                                        <div class="dez-post-meta">
                                            <ul>
                                                <li class="post-author">By <a href="#">Admin</a></li>
                                                <li class="post-comment"><i class="fa fa-comments"></i> 28</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-post clearfix">
                                    <div class="dez-post-media"> <img src="front/jpg/pic2-7.jpg" alt="" width="200" height="160"> </div>
                                    <div class="dez-post-info">
                                        <div class="dez-post-header">
                                            <h6 class="post-title"><a href="blog-single.html">Title of first blog</a></h6>
                                        </div>
                                        <div class="dez-post-meta">
                                            <ul>
                                                <li class="post-author">By <a href="#">Admin</a></li>
                                                <li class="post-comment"><i class="fa fa-comments"></i> 28</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-post clearfix">
                                    <div class="dez-post-media"> <img src="front/jpg/pic3-6.jpg" alt="" width="200" height="160"> </div>
                                    <div class="dez-post-info">
                                        <div class="dez-post-header">
                                            <h6 class="post-title"><a href="blog-single.html">Title of first blog</a></h6>
                                        </div>
                                        <div class="dez-post-meta">
                                            <ul>
                                                <li class="post-author">By <a href="#">Admin</a></li>
                                                <li class="post-comment"><i class="fa fa-comments"></i> 28</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                <li><a href="services-2.html">Awards & Trophies</a></li>
                                <li><a href="services-2.html">Additional Help</a></li>
                                <li><a href="services-2.html">Training Schedule</a></li>
                            </ul>
                        </div>
                    </div>
					<div class="col-lg-3 col-sm-6 footer-col-4">
						<div class="widget widget_gallery">
							<h4 class="m-b15 text-uppercase">PHOTOS FROM FLICKR</h4>
							<div class="dez-separator bg-primary"></div>
							<ul>
								<li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic1-3.jpg" alt=""></a> </li>
								<li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic2-3.jpg" alt=""></a> </li>
								<li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic3-3.jpg" alt=""></a> </li>
								<li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic4-3.jpg" alt=""></a> </li>
								<li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic5.jpg" alt=""></a> </li>
								<li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic6.jpg" alt=""></a> </li>
								<li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic7.jpg" alt=""></a> </li>
								<li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic8.jpg" alt=""></a> </li>
								<li class="img-effect2"> <a href="javascript:void(0);"><img src="front/jpg/pic9.jpg" alt=""></a> </li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
        <!-- footer bottom part -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 text-left"> <span>© Copyright 2019</span> </div>
					<div class="col-lg-4 text-center"> <span> Design With <i class="fa fa-heart text-red heart"></i> By Mayank pal </span> </div>
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
<script src="front/js/jquery.min.js"></script><!-- JQUERY.MIN JS -->
<script src="front/js/popper.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="front/js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="front/js/bootstrap-select.min.js"></script><!-- FORM JS -->
<script src="front/js/jquery.bootstrap-touchspin.js"></script><!-- FORM JS -->
<script src="front/js/magnific-popup.js"></script><!-- MAGNIFIC POPUP JS -->
<script src="front/js/waypoints-min.js"></script><!-- WAYPOINTS JS -->
<script src="front/js/counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="front/js/jquery.countdown.js"></script><!-- COUNTDOWN JS -->
<script src="front/js/imagesloaded.js"></script><!-- IMAGESLOADED -->
<script src="front/js/masonry-3.1.4.js"></script><!-- MASONRY -->
<script src="front/js/masonry.filter.js"></script><!-- MASONRY -->
<script src="front/js/owl.carousel.js"></script><!-- OWL SLIDER -->
<script src="front/js/dz.ajax.js"></script><!-- CONTACT JS  -->

<script src="front/js/dz.carousel.js"></script><!-- SORTCODE FUCTIONS  -->
<!-- revolution JS FILES -->
<script type="text/javascript" src="front/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="front/js/jquery.themepunch.revolution.min.js"></script>
<!-- Slider revolution 5.0 Extensions  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script type="text/javascript" src="front/js/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="front/js/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="front/js/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="front/js/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="front/js/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="front/js/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="front/js/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="front/js/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="front/js/revolution.extension.video.min.js"></script>
<script type="text/javascript" src="front/js/rev.slider.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	'use strict';
	dz_rev_slider_1();
});	/*ready*/
</script>
</body>

</html>
