<?php if($this->session->flashdata('msg')): ?>

    <div class="alert alert-success">
      <strong>Success!</strong> <?php echo $this->session->flashdata('msg'); ?>
    </div>
<?php endif; ?>
<body>
    <div class="baner_poster">
        <section class="top_section" id="home1">
            <div class="desktops-display1">
                <nav class="navbar navbar-default">
                    <div class="container">
                        <div class="navbar-header"> <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button> <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url('asset/images/logos.png')?>" alt="Logo"></a> </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="active"><a href="">Safty for Your Data</a></li>
                                <li><a href="#"> For Clinic & Hospital </a></li>
                                <?php if(!empty($this->session->userdata('id')) && $this->session->userdata('user_role')==3){
                                    echo '<li> <div class="dropdown"><a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" style="color:white"> Welcome.. '.ucfirst($this->session->userdata('first_name').' '.$this->session->userdata('last_name')).'</a>';?>
                                      <span class="caret"></span></button>
                                      <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url('patient/dashboard');?>">Dashboard</a></li>
                                        <li><a href="<?php echo base_url('admin/logout');?>">Logout</a></li>
                                      </ul>
                                    </div>
                                <?php }else{?>
                                <li class="user_info"><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"><span><i class="fa fa-sign-in" aria-hidden="true"></i></span> Login / Sign Up</a></li>
                                <?php }?>
                                <!-- <li class="user_info"><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"><span><i class="fa fa-user" aria-hidden="true"></i></span> Sign Up</a></li> -->
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </section>
        <div class="clearfix"></div>
        <section class="baner_slider">
            <div class="container-fluid">
                <div class="row">
                    <div class="manage-sliders">
                        <div class="baner_1">
                            <div class="col-md-1"></div>
                            <div class="col-md-5 col-xs-12">
                                <div class="text-right baner-texts">
                                    <div id="myCarousel1" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="item active">
                                                <h1 class="wow fadeInLeft"> Online Hospital <br> Management System </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="baner_2">
                                <div class="col-md-5 col-xs-12">
                                    <div id="themeSlider" class="carousel slide" data-ride="carousel" data-interval="3000" data-pause="false">
                                        <div class="carousel-inner">
                                            <div class="item active">
                                                <div class="imgOverlay1"></div>
                                                <img src="<?php echo base_url('asset/images/laptop_baner.png')?>" alt="First slide">
                                            </div>
                                            <div class="item">
                                                <div class="imgOverlay1"></div>
                                                <img src="<?php echo base_url('asset/images/laptop_baner.png')?>" alt="Second slide">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <div class="search_bar">
            <form class="searchform cf">
                <span class="marker_icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                <input type="text" class="borders-right" id="city_name" name="city_name">
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                <input type="text" placeholder="Search Doctor Clinic Hospital etc" id="search_doctor">
                <ul style="display: none" id="speciality_list">
                    <?php foreach($speciality as $specialities){?>
                        <li><i class="fa fa-search aa"></i><a href="<?php echo base_url('front/search_doctor/'.$specialities->id);?>"><?php echo $specialities->name;?></a></li>
                    <?php }?>
                </ul>
            </form>
        </div>
        </div>

        <div class="clearfix"></div>
        <section class="about_us2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="wow fadeInLeft">SAFTY OF YOUR DATA IS OUR <br> TOP PRIORITY. </h1>
                    </div>
                    <div class="about_manage">
                        <div class="col-md-6 wow fadeInLeft">
                            <ul class="check_manages">
                                <li><span><img src="<?php echo base_url('asset/images/checked.png')?>" alt="Checked"></span>Multi-level security checks</li>
                                <li><span><img src="<?php echo base_url('asset/images/checked.png')?>" alt="Checked"></span>Multiple data backups</li>
                                <li><span><img src="<?php echo base_url('asset/images/checked.png')?>" alt="Checked"></span>Strigent data privacy policies</li>
                            </ul>
                            <div class="read_more">
                                <a href="#" class="btn">READ MORE</a>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <img src="<?php echo base_url('asset/images/doctor_img.png')?>" alt="webdesky" class="wow fadeInRight" data-wow-delay="1s" data-wow-duration="2s">
                        </div>
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                        <div class="top_priority wow fadeInRight">
                            <div class="col-md-3">
                                <img src="<?php echo base_url('asset/images/icon_1.png')?>" alt="icon_1">
                                <h1>256 - bit</h1>
                                <p>Encryption</p>
                            </div>
                            <div class="col-md-3">
                                <img src="<?php echo base_url('asset/images/icon_2.png')?>" alt="icon_1">
                                <h1>ISO - 27001</h1>
                                <p>Certified</p>
                            </div>
                            <div class="col-md-3">
                                <img src="<?php echo base_url('asset/images/icon_3.png')?>" alt="icon_1">
                                <h1>256 - HIPPA</h1>
                                <p>Compliant data centers</p>
                            </div>
                            <div class="col-md-3">
                                <img src="<?php echo base_url('asset/images/icon_4.png')?>" alt="icon_1">
                                <h1>256 - DSCI</h1>
                                <p>Members</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
        <section class="about_us2 appointments">
            <div class="corner_baner wow fadeOutDown">
                <img src="<?php echo base_url('asset/images/doctor_ban.png')?>" alt="corner_1">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="wow fadeInLeft">INSTANT APPOINTMENT WITH <br> DOCTORS.GUARANTEED. </h1>
                    </div>
                    <div class="about_manage">
                        <div class="col-md-5">
                            <img src="<?php echo base_url('asset/images/person.png')?>" alt="webdesky" class="setdatas wow fadeInRight" data-wow-delay="1s" data-wow-duration="2s">
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-6 wow fadeInLeft">
                            <ul class="check_manages">
                                <li>100,000 VERIFIED DOCTORS <span><img src="<?php echo base_url('asset/images/icon_5.png')?>" alt="Checked"></span></li>
                                <li>3M+ PATIENT RECOMMENDATIONS <span><img src="<?php echo base_url('asset/images/icon_5.png')?>" alt="Checked"></span></li>
                                <li>25M PATIENT/YEAR <span><img src="<?php echo base_url('asset/images/icon_5.png')?>" alt="Checked"></span></li>
                            </ul>
                            <div class="read_more">
                                <a href="#" class="btn">FIND ME THE <br> RIGHT DOCTOR</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <div id="testimonial4" class="carousel slide testimonial4_indicators testimonial4_control_button thumb_scroll_x swipe_x" data-ride="carousel" data-pause="hover" data-interval="5000" data-duration="2000">
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <div class="testimonial4_slide">
                                        <div class="star_icon">
                                            <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                            <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                            <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                            <span><i class="fa fa-star-o" aria-hidden="true"></i></span>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                        </p>
                                        <h4>Ben Hanna <img src="<?php echo base_url('asset/images/user_img.png')?>" class="img-circle img-responsive" /></h4>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="testimonial4_slide">
                                        <div class="star_icon">
                                            <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                            <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                            <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                            <span><i class="fa fa-star-o" aria-hidden="true"></i></span>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                        </p>
                                        <h4>Ben Hanna <img src="<?php echo base_url('asset/images/user_img.png')?>" class="img-circle img-responsive" /> </h4>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="testimonial4_slide">
                                        <div class="star_icon">
                                            <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                            <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                            <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                            <span><i class="fa fa-star-o" aria-hidden="true"></i></span>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                        </p>
                                        <h4>Ben Hanna <img src="<?php echo base_url('asset/images/user_img.png')?>" class="img-circle img-responsive" /></h4>
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#testimonial4" role="button" data-slide="prev">
                            <span class="fa fa-chevron-left"></span>
                          </a>
                            <a class="right carousel-control" href="#testimonial4" role="button" data-slide="next">
                            <span class="fa fa-chevron-right"></span>
                          </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <div class="clearfix"></div>
        <section class="about_us2 download_app">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="wow fadeInLeft"> DOWNLOAD THE PRACTO APP </h1>
                    </div>
                    <div class="about_manage">
                        <div class="col-md-6 wow fadeInLeft">
                            <ul class="check_manages">
                                <li><span><img src="<?php echo base_url('asset/images/icon_5.png')?>" alt="Checked"></span>Book appointments and lab tests</li>
                                <li><span><img src="<?php echo base_url('asset/images/icon_5.png')?>" alt="Checked"></span>Order medicines</li>
                                <li><span><img src="<?php echo base_url('asset/images/icon_5.png')?>" alt="Checked"></span>Consult doctors online</li>
                                <li><span><img src="<?php echo base_url('asset/images/icon_5.png')?>" alt="Checked"></span>Set medicine reminders</li>
                                <li><span><img src="<?php echo base_url('asset/images/icon_5.png')?>" alt="Checked"></span>Store health records</li>
                                <li><span><img src="<?php echo base_url('asset/images/icon_5.png')?>" alt="Checked"></span>Read health tips</li>
                            </ul>
                            <div class="play_store_btn">
                                <img src="<?php echo base_url('asset/images/play_btn.png')?>" alt="play_btn">
                                <img src="<?php echo base_url('asset/images/play_btn_2.png')?>" class="new-width" alt="play_btn">
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <img src="<?php echo base_url('asset/images/phone_img.jpg')?>" alt="webdesky" class="wow fadeInRight" data-wow-delay="1s" data-wow-duration="2s">
                        </div>
                    </div>
                </div>
            </div>
        </section>


