@extends('front.layouts.main')

@section('title')
Home page
@endsection



@section('main')

	<div class="page-content">
            <!-- Slider -->
            @include('front.pages.slider')
		   
            <!-- Slider END -->
        <!-- Latest Result -->
    <!--     <div class="section-full score-board bg-white p-t70 ">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-lg-12 text-center section-head">
                            <h2 class="h2 text-uppercase">Latest Result</h2>
							<div class="dez-separator-outer "><div class="dez-separator bg-primary style-liner"></div></div>
                            <div class="clear"></div>
                            <p class="m-b0">Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the industry's standard dummy text ever since the been when an unknown printer.</p>
                        </div>    
					</div>		
					<div class="row">
						<div class="col-lg-5 col-md-5">
							<div class="team-box-left clearfix">
								<div class="player pull-right">
									<img src="front/png/team-1.png" alt=""/>
								</div>
								<div class="team-result text-white text-left">
									<h3 class="text-uppercase font-weight-600 m-a0">England</h3>
									<div class="m-tb5"><span class="text-green">WIN</span></div>
									<a href="#" class="site-button">Score Board</a>
								</div>		
							</div>
						</div>	
						<div class="col-lg-2 col-md-2 text-center p-lr0">
							<div class=" score-info">
								<span class="vs">V/S</span>	
								<span class="score">5-2</span>
								<p>May 16,2015 15:30pm Wbeysley Stadium (london)</p>
							</div>	
						</div>
						<div class="col-lg-5 col-md-5">
							<div class="team-box-right clearfix">
								<div class="player pull-left">
									<img src="front/png/team-2.png"  alt=""/>
								</div>
								<div class="team-result text-white text-right">
									<h3 class="text-uppercase font-weight-600 m-a0">England</h3>
									<div class="m-tb5"><span class="text-red">LOSS</span></div>
									<a href="#" class="site-button">Score Board</a>
								</div>		
							</div>
						</div>
					</div>
                </div>
            </div>
        </div> -->
        <!-- Latest Result END -->
		<!-- Next Match -->
		<!-- <div class="section-full bg-white p-t70 p-b40 bg-img-fix overlay-white-dark" style="background-image:url(jpg/bg5.jpg); background-position:center; ">
            <div class="container">
				<div class="section-head text-center ">
                    <h2 class="h2 text-uppercase"> Next Match</h2>
                    <div class="dez-separator-outer "><div class="dez-separator bg-primary style-liner"></div></div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the industry's standard dummy text ever since the been when an unknown printer.</p>
                </div>
				<div class="section-content">
					<div class="next-match owl-loaded owl-theme owl-carousel owl-btn-center-lr">
						<div class="item p-t20">
							<div class="row next-match-team clearfix m-b30">
								<div class="col-lg-5 col-sm-5 col-4">	
									<a href="#" class="pull-right  m-t20">
										<span class="country"><img src="front/jpg/flag1.jpg"  alt=""/></span>
										<span>England</span>
									</a>
								</div>		
								<div class="col-lg-2 col-sm-2 col-4  ">
									<div class="vs-team bg-primary"><span>VS</span></div>
								</div>
								<div class="col-lg-5 col-sm-5 col-4">
									<a href="#" class="pull-left m-t20">
										<span>The Africa</span>
										<span class="country"><img src="front/jpg/flag2.jpg"  alt=""/></span>
									</a>
								</div>
							</div>
							<div class="countdown dez-style-1 text-center">
								<div class="date">
									<span class="time days text-primary"></span>
									<span class="time-counting">Days</span>
								</div>
								<div class="date">
									<span class="time hours text-primary"></span>
									<span class="time-counting">Hours</span>
								</div>
								<div class="date">
									<span class="time mins text-primary"></span>
									<span class="time-counting">Minutess</span>
								</div>
								<div class="date">
									<span class="time secs text-primary"></span>
									<span class="time-counting">Second</span>
								</div>
							</div>
							<div class="m-t30 loction text-center">
								<strong>November 14, 2017 | 12:00 AM</strong>
								<strong>Cambridgeshire UK</strong>
							</div>
						</div>
						<div class="item p-t20">
							<div class="row next-match-team clearfix m-b30">
								<div class="col-lg-5 col-sm-5 col-4">	
									<a href="#" class="pull-right  m-t20">
										<span class="country"><img src="front/jpg/flag1.jpg" alt=""/></span>
										<span>England</span>
									</a>
								</div>		
								<div class="col-lg-2 col-sm-2 col-4  ">
									<div class="vs-team bg-primary"><span>VS</span></div>
								</div>
								<div class="col-lg-5 col-sm-5 col-4">
									<a href="#" class="pull-left m-t20">
										<span>The Africa</span>
										<span class="country"><img src="front/jpg/flag2.jpg"  alt=""/></span>
									</a>
								</div>
							</div>
							<div class="countdown dez-style-1 text-center">
								<div class="date">
									<span class="time days text-primary"></span>
									<span class="time-counting">Days</span>
								</div>
								<div class="date">
									<span class="time hours text-primary"></span>
									<span class="time-counting">Hours</span>
								</div>
								<div class="date">
									<span class="time mins text-primary"></span>
									<span class="time-counting">Minutess</span>
								</div>
								<div class="date">
									<span class="time secs text-primary"></span>
									<span class="time-counting">Second</span>
								</div>
							</div>
							<div class="m-t30 loction text-center">
								<strong>November 14, 2017 | 12:00 AM</strong>
								<strong>Cambridgeshire UK</strong>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	 -->
		<!-- Next Match End -->
		<!-- About The Sports -->
        <div class="section-full bg-white p-t70 p-b40">
            <div class="container">
                <div class="section-head text-center ">
                    <h2 class="h2 text-uppercase"> About The Sports</h2>
                    <div class="dez-separator-outer "><div class="dez-separator bg-primary style-liner"></div></div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the industry's standard dummy text ever since the been when an unknown printer.</p>
                </div>
				<div class="section-content text-center ">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="text-left">
								<h3 class="font-weight-600 m-t10">OUR MISSION STATEMENT</h3>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
								<div class="row">
									<div class="col-lg-4 col-sm-4 col-4">
										<div class="dez-media dez-img-effect off-color"> 
											<img src="front/jpg/pic1.jpg" alt=""/> 
										</div>
									</div>
									<div class="col-lg-4 col-sm-4 col-4 ">
										<div class="dez-media dez-img-effect off-color"> 
											<img src="front/jpg/pic2.jpg" alt=""/> 
										</div>
									</div>
									<div class="col-lg-4 col-sm-4 col-4 ">
										<div class="dez-media dez-img-effect  off-color"> 
											<img src="front/jpg/pic3.jpg" alt=""/> 
										</div>
									</div>
								</div>
								<div class="m-tb30">
									<a href="#" class="site-button">Read More</a>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="dez-box">
								<div class="dez-media dez-img-effect off-color "> 
									<img src="front/jpg/pic4.jpg" alt=""/>
								</div>
                            </div>
						</div>
					</div>
				</div>            
            </div>
        </div>
        <!-- About The Sports -->
		<!-- Our Sports  -->
        <div class="section-full bg-img-fix p-t70 p-b50 overlay-black-middle our-projects-galery" style="background-image:url(jpg/bg5.jpg); background-position:center;">
            <div class="container">
				<div class="row">
					<div class="col-lg-3 col-sm-6 m-b30">
						<div class="border-1 p-a15 text-center text-white skew-triangle left-top hvr-wobble-horizontal">
							<div class="sports-icon ">
								<img src="front/png/pic1.png"  alt=""/>
							</div>
							<h3>AMAZING EXPERIENCE</h3>
							<div class="dez-separator-outer "><div class="dez-separator bg-primary style-liner"></div></div>
							<p class="m-b0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 m-b30">
						<div class="border-1 p-a15 text-center text-white skew-triangle left-top hvr-wobble-horizontal">
							<div class="sports-icon ">
								<img src="front/png/pic2.png"  alt=""/>
							</div>
							<h3>MEDALS WON</h3>
							<div class="dez-separator-outer "><div class="dez-separator bg-primary style-liner"></div></div>
							<p class="m-b0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 m-b30 ">
						<div class="border-1 p-a15 text-center text-white skew-triangle left-top hvr-wobble-horizontal">
							<div class="sports-icon ">
								<img src="front/png/pic3.png"  alt=""/>
							</div>
							<h3>TALENTED STAFF</h3>
							<div class="dez-separator-outer "><div class="dez-separator bg-primary style-liner"></div></div>
							<p class="m-b0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6  m-b30 ">
						<div class="border-1 p-a15 text-center text-white skew-triangle left-top hvr-wobble-horizontal">
							<div class="sports-icon ">
								<img src="front/png/pic4.png"  alt=""/>
							</div>
							<h3>ADVENTURE ZONE</h3>
							<div class="dez-separator-outer "><div class="dez-separator bg-primary style-liner"></div></div>
							<p class="m-b0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
						</div>
					</div>
				</div>
            </div>
        </div>
        <!-- Our Sports END -->
		<!-- Our Achievements -->
        <<!-- div class="section-full bg-white p-t70 p-b40 our-achievements">
            <div class="container">
                <div class="section-head text-center ">
                    <h2 class="h2 text-uppercase"> OUR ACHIEVEMENTS</h2>
                    <div class="dez-separator-outer "><div class="dez-separator bg-primary style-liner"></div></div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the industry's standard dummy text ever since the been when an unknown printer.</p>
                </div>
				<div class="section-content text-center ">
					<div class="row">
						<div class="col-lg-3 col-sm-6 p-a0">
							<div class="dez-box dez-media">
								<div class=""> <img src="front/jpg/pic1-2.jpg" alt="">
									<div class="dez-info-has p-a20 bg-primary text-left skew-triangle right-top text-center">
										<h4> EXTREME LEVEL OF SPORTS</h4>
										<div class="dez-info-has-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
										<div class="m-tb30"><a href="#" class="site-button outline white border-1">Read More</a></div>
									</div>
								</div>
								<div class="dez-title-bx bg-gray p-a20 text-left skew-triangle left-top">
									<h4 class="m-a0"> EXTREME LEVEL OF SPORTS</h4>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6 p-a0">
							<div class="dez-box dez-media">
								<div class=""> <img src="front/jpg/pic2-2.jpg" alt="">
									<div class="dez-info-has p-a20 bg-primary text-left skew-triangle right-top text-center">
										<h4> EXTREME LEVEL OF SPORTS</h4>
										<div class="dez-info-has-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
										<div class="m-tb30"><a href="#" class="site-button outline white border-1">Read More</a></div>
									</div>
								</div>
								<div class="dez-title-bx bg-gray p-a20 text-left skew-triangle left-top">
									<h4 class="m-a0"> EXTREME LEVEL OF SPORTS</h4>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6 p-a0">
							<div class="dez-box dez-media">
								<div class=""> <img src="front/jpg/pic3-2.jpg" alt="">
									<div class="dez-info-has p-a20 bg-primary text-left skew-triangle right-top text-center">
										<h4> EXTREME LEVEL OF SPORTS</h4>
										<div class="dez-info-has-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
										<div class="m-tb30"><a href="#" class="site-button outline white border-1">Read More</a></div>
									</div>
								</div>
								<div class="dez-title-bx bg-gray p-a20 text-left skew-triangle left-top">
									<h4 class="m-a0"> EXTREME LEVEL OF SPORTS</h4>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6 p-a0">
							<div class="dez-box dez-media">
								<div class=""> <img src="front/jpg/pic4-2.jpg" alt="">
									<div class="dez-info-has p-a20 bg-primary text-left skew-triangle right-top text-center">
										<h4> EXTREME LEVEL OF SPORTS</h4>
										<div class="dez-info-has-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
										<div class="m-tb30"><a href="#" class="site-button outline white border-1">Read More</a></div>
									</div>
								</div>
								<div class="dez-title-bx bg-gray p-a20 text-left skew-triangle left-top">
									<h4 class="m-a0"> EXTREME LEVEL OF SPORTS</h4>
								</div>
							</div>
						</div>
						
					</div>
				</div>            
            </div>
        </div> -->
        <!-- Team member END -->
        <!-- Sports Offered -->
        <div class="section-full bg-img-fix p-t70 p-b40 overlay-black-middle" style="background-image:url(jpg/bg1.jpg); background-position:center;">
            <div class="container">
                <div class="section-head  text-center text-white">
                    <h2 class="h2">CLUB GALLERY </h2>
                    <div class="dez-separator-outer "><div class="dez-separator bg-primary style-liner"></div></div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the industry's standard dummy text ever since the been when an unknown printer.</p>
                </div>
                <div class="site-filters clearfix center  m-b40">
                    <ul class="filters" data-toggle="buttons">
                        <li data-filter="" class="btn active">
                            <input type="radio">
                            <a href="#" class="site-button white radius-xl"><span>All Sports</span></a> 
						</li>
                        <li data-filter="water" class="btn">
                            <input type="radio" >
                            <a href="#" class="site-button white radius-xl"><span>Water Sports</span></a> </li>
                        <li data-filter="jumping" class="btn">
                            <input type="radio">
                            <a href="#" class="site-button white radius-xl"><span>Jumping</span></a> 
						</li>
                        <li data-filter="bikes" class="btn">
                            <input type="radio">
                            <a href="#" class="site-button white radius-xl"><span>Bikes</span></a> 
						</li>
                    </ul>
                </div>
                <div class="clearfix">
                    <ul id="masonry" class="row dez-gallery-listing gallery-grid-4 gallery mfp-gallery">
                        <li class="card-container col-lg-3 col-lg-3 col-sm-6 col-6 jumping">
                            <div class="dez-box dez-gallery-box">
                                <div class="dez-media dez-img-overlay1 dez-img-effect zoom-slow"> <a href="javascript:void(0);"> <img src="front/jpg/pic1-3.jpg"  alt=""> </a>
                                    <div class="overlay-bx">
                                        <div class="overlay-icon"> <a href="javascript:void(0);"> <i class="fa fa-link icon-bx-xs"></i> </a> <a  href="front/jpg/pic1-3.jpg" class="mfp-link"  title="DexignZone"> <i class="fa fa-picture-o icon-bx-xs"></i> </a> </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="office  card-container col-lg-3 col-lg-3 col-sm-6 col-6 bikes jumping">
                            <div class="dez-box dez-gallery-box">
                                <div class="dez-media dez-img-overlay1 dez-img-effect zoom-slow dez-img-effect zoom"> <a href="javascript:void(0);"> <img src="front/jpg/pic2-3.jpg"  alt=""> </a>
                                    <div class="overlay-bx">
                                        <div class="overlay-icon"> <a href="javascript:void(0);"> <i class="fa fa-link icon-bx-xs"></i> </a> <a  href="front/jpg/pic2-3.jpg" class="mfp-link"  title="DexignZone"> <i class="fa fa-picture-o icon-bx-xs"></i> </a> </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class=" card-container col-lg-3 col-lg-3 col-sm-6 col-6 jumping">
                            <div class="dez-box dez-gallery-box">
                                <div class="dez-media dez-img-overlay1 dez-img-effect zoom-slow"> <a href="javascript:void(0);"> <img src="front/jpg/pic3-3.jpg"  alt=""> </a>
                                    <div class="overlay-bx">
                                        <div class="overlay-icon"> <a href="javascript:void(0);"> <i class="fa fa-link icon-bx-xs"></i> </a> <a href="front/jpg/pic3-3.jpg" class="mfp-link"  title="DexignZone"> <i class="fa fa-picture-o icon-bx-xs"></i> </a> </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="commercial card-container col-lg-3 col-lg-3 col-sm-6 col-6 bikes">
                            <div class="dez-box dez-gallery-box">
                                <div class="dez-media dez-img-overlay1 dez-img-effect zoom-slow"> <a href="javascript:void(0);"> <img src="front/jpg/pic4-3.jpg"  alt=""> </a>
                                    <div class="overlay-bx">
                                        <div class="overlay-icon"> <a href="javascript:void(0);"> <i class="fa fa-link icon-bx-xs"></i> </a> <a  href="front/jpg/pic4-3.jpg" class="mfp-link"  title="DexignZone"> <i class="fa fa-picture-o icon-bx-xs"></i> </a> </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="card-container col-lg-3 col-lg-3 col-sm-6 col-6 water bikes">
                            <div class="dez-box dez-gallery-box">
                                <div class="dez-media dez-img-overlay1 dez-img-effect zoom-slow"> <a href="javascript:void(0);"> <img src="front/jpg/pic5.jpg"  alt=""> </a>
                                    <div class="overlay-bx">
                                        <div class="overlay-icon"> <a href="javascript:void(0);"> <i class="fa fa-link icon-bx-xs"></i> </a> <a  href="front/jpg/pic5.jpg" class="mfp-link"  title="DexignZone"> <i class="fa fa-picture-o icon-bx-xs"></i> </a> </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="card-container col-lg-3 col-lg-3 col-sm-6 col-6 water">
                            <div class="dez-box dez-gallery-box">
                                <div class="dez-media dez-img-overlay1 dez-img-effect zoom-slow"> <a href="javascript:void(0);"> <img src="front/jpg/pic6.jpg"  alt=""> </a>
                                    <div class="overlay-bx">
                                        <div class="overlay-icon"> <a href="javascript:void(0);"> <i class="fa fa-link icon-bx-xs"></i> </a> <a  href="front/jpg/pic6.jpg" class="mfp-link"  title="DexignZone"> <i class="fa fa-picture-o icon-bx-xs"></i> </a> </div>
                                    </div>
                                </div>
                            </div>
                        </li>
						<li class="card-container col-lg-3 col-lg-3 col-sm-6 col-6 bikes">
                            <div class="dez-box dez-gallery-box">
                                <div class="dez-media dez-img-overlay1 dez-img-effect zoom-slow"> <a href="javascript:void(0);"> <img src="front/jpg/pic7.jpg"  alt=""> </a>
                                    <div class="overlay-bx">
                                        <div class="overlay-icon"> <a href="javascript:void(0);"> <i class="fa fa-link icon-bx-xs"></i> </a> <a  href="front/jpg/pic7.jpg" class="mfp-link"  title="DexignZone"> <i class="fa fa-picture-o icon-bx-xs"></i> </a> </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="card-container col-lg-3 col-lg-3 col-sm-6 col-6 water">
                            <div class="dez-box dez-gallery-box">
                                <div class="dez-media dez-img-overlay1 dez-img-effect zoom-slow"> <a href="javascript:void(0);"> <img src="front/jpg/pic8.jpg"  alt=""> </a>
                                    <div class="overlay-bx">
                                        <div class="overlay-icon"> <a href="javascript:void(0);"> <i class="fa fa-link icon-bx-xs"></i> </a> <a  href="front/jpg/pic8.jpg" class="mfp-link"  title="DexignZone"> <i class="fa fa-picture-o icon-bx-xs"></i> </a> </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Sports Offered END -->
        <!-- Qualified Staff -->
        <!-- <div class="section-full bg-white p-t70 p-b40">
            <div class="container">
                <div class="section-head text-center ">
                    <h2 class="h2">QUALIFIED STAFF</h2>
                    <div class="dez-separator-outer "><div class="dez-separator bg-primary style-liner"></div></div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the industry's standard dummy text ever since the been when an unknown printer.</p>
                </div>
				<div class="section-content text-center ">
					<div class="row">
						<div class="col-lg-3 col-sm-6">
							<div class="dez-box m-b30 dez-img-effect vertical-pan dez-staff">
								<div class="dez-media vertical-pan dez-img-effect">
									<a href="javascript:;">
										<img src="front/jpg/pic1-4.jpg" alt="" width="358" height="460">
									</a>
								</div> 
								<div class="p-a10 bg-primary text-white dez-team">
									<h4 class="dez-title text-uppercase">ANDREA</h4>
									<div class="dez-separator-outer "><div class="dez-separator bg-white style-liner"></div></div>
									<span class="dez-member-position">Coatch</span>
									<div class="m-t10 ">
										<ul class="dez-social-icon dez-social-icon-lg border">
											<li><a href="javascript:void(0);" class="fa fa-facebook text-white"></a></li>
											<li><a href="javascript:void(0);" class="fa fa-twitter text-white"></a></li>
											<li><a href="javascript:void(0);" class="fa fa-linkedin text-white"></a></li>
											<li><a href="javascript:void(0);" class="fa fa-pinterest-p text-white"></a></li>
										</ul>
									</div>	
								</div>       
							</div>
						</div>
						<div class="col-lg-3 col-sm-6">
							<div class="dez-box m-b30 dez-img-effect vertical-pan dez-staff">
								<div class="dez-media vertical-pan dez-img-effect">
									<a href="javascript:;">
										<img src="front/jpg/pic2-4.jpg" alt="" width="358" height="460">
									</a>
								</div> 
								<div class="p-a10 bg-primary text-white dez-team">
									<h4 class="dez-title text-uppercase">LEEZA</h4>
									<div class="dez-separator-outer "><div class="dez-separator bg-white style-liner"></div></div>
									<span class="dez-member-position">Coatch</span>
									<div class="m-t10 ">
										<ul class="dez-social-icon dez-social-icon-lg border">
											<li><a href="javascript:void(0);" class="fa fa-facebook text-white"></a></li>
											<li><a href="javascript:void(0);" class="fa fa-twitter text-white"></a></li>
											<li><a href="javascript:void(0);" class="fa fa-linkedin text-white"></a></li>
											<li><a href="javascript:void(0);" class="fa fa-pinterest-p text-white"></a></li>
										</ul>
									</div>	
								</div>       
							</div>
						</div>
						<div class="col-lg-3 col-sm-6">
							<div class="dez-box m-b30 dez-img-effect vertical-pan dez-staff">
								<div class="dez-media vertical-pan dez-img-effect">
									<a href="javascript:;">
										<img src="front/jpg/pic3-4.jpg" alt="" width="358" height="460">
									</a>
								</div> 
								<div class="p-a10 bg-primary text-white dez-team">
									<h4 class="dez-title text-uppercase">ROBAT</h4>
									<div class="dez-separator-outer "><div class="dez-separator bg-white style-liner"></div></div>
									<span class="dez-member-position">Coatch</span>
									<div class="m-t10 ">
										<ul class="dez-social-icon dez-social-icon-lg border">
											<li><a href="javascript:void(0);" class="fa fa-facebook text-white"></a></li>
											<li><a href="javascript:void(0);" class="fa fa-twitter text-white"></a></li>
											<li><a href="javascript:void(0);" class="fa fa-linkedin text-white"></a></li>
											<li><a href="javascript:void(0);" class="fa fa-pinterest-p text-white"></a></li>
										</ul>
									</div>	
								</div>       
							</div>
						</div>
						<div class="col-lg-3 col-sm-6">
							<div class="dez-box m-b30 dez-img-effect vertical-pan dez-staff">
								<div class="dez-media vertical-pan dez-img-effect">
									<a href="javascript:;">
										<img src="front/jpg/pic4-4.jpg" alt="" width="358" height="460">
									</a>
								</div> 
								<div class="p-a10 bg-primary text-white dez-team">
									<h4 class="dez-title text-uppercase">JACK</h4>
									<div class="dez-separator-outer "><div class="dez-separator bg-white style-liner"></div></div>
									<span class="dez-member-position">Coatch</span>
									<div class="m-t10 ">
										<ul class="dez-social-icon dez-social-icon-lg border">
											<li><a href="javascript:void(0);" class="fa fa-facebook text-white"></a></li>
											<li><a href="javascript:void(0);" class="fa fa-twitter text-white"></a></li>
											<li><a href="javascript:void(0);" class="fa fa-linkedin text-white"></a></li>
											<li><a href="javascript:void(0);" class="fa fa-pinterest-p text-white"></a></li>
										</ul>
									</div>	
								</div>       
							</div>
						</div>
						
					</div>
				</div>            
            </div>
        </div> -->
        <!-- Qualified Staff END -->
		<!-- Why Choose Us -->
		<!-- <div class="section-full text-white bg-img-fix p-tb70 overlay-black-middle choose-us" style="background-image:url(jpg/bg2.jpg); background-position:center">
            <div class="container">
				<div class="text-center text-white">
                    <h2 class="h2 text-uppercase">Show <span class="text-primary"><i class="fa fa-play-circle-o"></i></span> Reel</h2>
                </div>
            </div>
        </div> -->
		<!-- Why Choose Us End -->
        <!-- Latest blog -->
        <<!-- div class="section-full p-t70 p-b20 ">
            <div class="container">
                <div class="section-head text-center">
                    <h2 class="h2 text-uppercase">latest Blog</h2>
                    <div class="dez-separator-outer "><div class="dez-separator bg-primary style-liner"></div></div>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the industry's standard dummy text ever since the been when an unknown printer.</p>
                </div>
                <div class="section-content ">
                    <div class="row">
						<div class="col-lg-6 col-sm-12 m-b30">
							<div class="dez-box  blog-details">
								<div class="dez-media dez-img-effect"> 
									<img src="front/jpg/pic1-5.jpg" alt="">
									<div class="dez-info-has p-a20 text-white no-hover bg-primary right-top skew-triangle skew-angle-1">
										<div class="text-white">
											<h4>EXTREME LEVEL OF SPORTS</h4>
											<div class="ow-post-meta">
												<ul>
													<li class="post-date"> <i class="fa fa-calendar"></i><strong>17 Mar</strong> <span> 2017</span> </li>
													<li class="post-author"><i class="fa fa-user"></i>By demongo </li>
												</ul>
											</div>
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an...</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-sm-12 m-b30 block">
							<div class="row clearfix bg-primary blog-details m-b30 m-lr0">
								<div class="col-lg-6 col-sm-6 p-a0">
									<img class="img-height" src="front/jpg/pic2-5.jpg"  height="100%" alt=""/>
								</div>
								<div class="col-lg-6 col-sm-6 p-tb10 skew-triangle right-top">
									<div class="text-white">
										<h4>EXTREME LEVEL OF SPORTS</h4>
										<div class="ow-post-meta">
											<ul>
												<li class="post-date"> <i class="fa fa-calendar"></i><strong>17 Mar</strong> <span> 2017</span> </li>
												<li class="post-author"><i class="fa fa-user"></i>By demongo </li>
											</ul>
										</div>
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
										<a href="#" class="site-button outline white ">Read More</a>
									</div>
								</div>
							</div>
							<div class="row bg-primary blog-details m-b30 m-lr0">
								<div class="col-lg-6 col-sm-6 p-a0">
									<img class="img-height" src="front/jpg/pic3-5.jpg"  alt=""/>
								</div>
								<div class="col-lg-6 col-sm-6 p-tb10 skew-triangle right-top">
									<div class="text-white">
										<h4>EXTREME LEVEL OF SPORTS</h4>
										<div class="ow-post-meta">
											<ul>
												<li class="post-date"> <i class="fa fa-calendar"></i><strong>17 Mar</strong> <span> 2017</span> </li>
												<li class="post-author"><i class="fa fa-user"></i>By demongo </li>
											</ul>
										</div>
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
										<a href="#" class="site-button outline white ">Read More</a>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div> -->
        <!-- Latest blog END -->
        <!-- World Sport Template blog -->
       <!--  <div class="section-full overlay-black-dark bg-img-fix p-t70 p-b70 dez-move-image" style="background-image:url(jpg/mamber.jpg);">
            <div class="container">
				<div class="row">
					<div class="col-lg-12 text-white">					
						<h2 class="m-auto font-40 m-b40 text-left">" Champions Keep Playing until they get it right " 
							<span class="pull-right font-16 m-t20"><i> -Billie Jean King</i></span>
						</h2>
						<div class="text-center"><a href="#" class="site-button">Join Are Club</a></div>
					</div>
				</div>
			</div>
        </div> -->
        <!-- World Sport Template END -->
        <!-- Testimoniyal blog -->
        <!-- <div class="section-full p-t70 p-b50  bg-white">
            <div class="container">
                <div class="section-head text-center">
                    <h2 class="h2 text-uppercase">Testimoniyal</h2>
                    <div class="dez-separator-outer "><div class="dez-separator bg-primary style-liner"></div></div>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the industry's standard dummy text ever since the been when an unknown printer.</p>
                </div>
				<div class="section-content p-b40">
					<div class="testimonial-four owl-carousel owl-theme owl-loaded">
						<div class="item">
							<div class="testimonial-4 text-white">
								<div class="testimonial-pic"><img src="front/jpg/pic1-6.jpg" width="100" height="100" alt=""></div>
								<div class="testimonial-text">
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the standard dummy text ever since the when printer. [...]</p>
								</div>
								<div class="testimonial-detail"> <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> </div>
								<div class="quote-right"></div>
							</div>
						</div>
						<div class="item">
							<div class="testimonial-4 text-white">
								<div class="testimonial-pic"><img src="front/jpg/pic2-6.jpg" width="100" height="100" alt=""></div>
								<div class="testimonial-text">
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the standard dummy text ever since the when printer. [...]</p>
								</div>
								<div class="testimonial-detail"> <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> </div>
								<div class="quote-right"></div>
							</div>
						</div>
						<div class="item">
							<div class="testimonial-4 text-white">
								<div class="testimonial-pic"><img src="front/jpg/pic2-6.jpg" width="100" height="100" alt=""></div>
								<div class="testimonial-text">
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the standard dummy text ever since the when printer. [...]</p>
								</div>
								<div class="testimonial-detail"> <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> </div>
								<div class="quote-right"></div>
							</div>
						</div>
					</div>
				</div>
				
            </div>
        </div> -->
        <!-- Testimoniyal END -->
   

@endsection