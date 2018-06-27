<div class="main-div">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-9 remove-padding1">
                    <!-- Filter div -->
                    <div class="filter-section">
                        <div class="container">
                            <div class="row">
                                <form class="form-inline" action="/action_page.php">
                                    <div class="form-group">

                                        <ul class="outer-ul">
                                            <li class="outer-li">
                                                <div class="dropdown">
                                                    <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown">Availability <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li class="dropdown-m"><a href="#">HTML</a></li>
                                                        <li class="dropdown-m"><a href="#">CSS</a></li>
                                                        <li class="dropdown-m"><a href="#">JavaScript</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="outer-li">
                                                <div class="checkbox checkbox-primary">
                                                    <input id="checkbox2" type="checkbox">
                                                    <label for="checkbox2">
                                                        In Hospital
                                                    </label>
                                                </div>

                                            </li>
                                            <li class="outer-li">
                                                <div class="checkbox checkbox-success">
                                                    <input id="checkbox3" type="checkbox">
                                                    <label for="checkbox3">
                                                        Online Booking
                                                    </label>
                                                </div>
                                            </li>
                                            <li class="outer-li all-filer">
                                                <div class="dropdown">
                                                    <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown">All Filters   <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li class="dropdown-m"><a href="#">HTML</a></li>
                                                        <li class="dropdown-m"><a href="#">CSS</a></li>
                                                        <li class="dropdown-m"><a href="#">JavaScript</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="outer-li">
                                                <div class="dropdown"> <label>Sort By</label>
                                                    <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown">Relevance <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li class="dropdown-m"><a href="#">HTML</a></li>
                                                        <li class="dropdown-m"><a href="#">CSS</a></li>
                                                        <li class="dropdown-m"><a href="#">JavaScript</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- <button type="submit" class="btn btn-default">Submit</button> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //Filter div -->
                <div class="clearfix"></div>
                <?php $i=1; foreach($doctors as $doctor){?>
                <div class="col-xs-12 col-sm-9 item-list left-side">
                    <div class="item-inner">
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 dr-details">
                                <div class="col-xs-12 col-sm-3">
                                <?php if(!empty($doctor->profile_pic)){?>
                                    <img src="<?php echo base_url('asset/uploads/'.$doctor->profile_pic)?>" alt="" class="img-responsive">
                                <?php }else{?>
                                 <img src="<?php echo base_url('asset/uploads/download.png')?>" alt="" class="img-responsive"><?php }?>
                                </div>
                                <div class="col-xs-12 col-sm-9">
                                    <div class="dr-name">
                                        <?php echo ucfirst($doctor->first_name.' '.$doctor->last_name);?>
                                    </div>
                                    <div class="address">
                                        <?php if(!empty($doctor->degree)){ echo $doctor->degree; }else{ echo 'N/A';}?>
                                        <br> <?php if(!empty($doctor->experience)){ echo $doctor->experience; }else{ echo 'N/A';}?><br> 
                                    </div>
                                    <div class="row img-bottom">
                                        <h3>Teeth & Braces Clinic</h3>
                                        <div class="col-xs-3 col-sm-2">
                                            <img src="<?php echo base_url('asset/images/img1.png')?>" alt="img">
                                        </div>
                                        <div class="col-xs-3 col-sm-2">
                                            <img src="<?php echo base_url('asset/images/img2.png')?>" alt="img">
                                        </div>
                                        <div class="col-xs-3 col-sm-2">
                                            <img src="<?php echo base_url('asset/images/img3.png')?>" alt="img">
                                        </div>
                                        <div class="col-xs-3 col-sm-2">
                                            <img src="<?php echo base_url('asset/images/img4.png')?>" alt="img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 dr-location">
                                <div class="clinic-contact">
                                    <div class="row">
                                        <div class="col-xs-2 col-sm-1">
                                            <img src="<?php echo base_url('asset/images/location.png')?>" alt="location">
                                        </div>
                                        <div class="col-xs-10 col-sm-10">
                                            <p class="clinic-contact-p"><?php if(!empty($doctor->address)){ echo ucfirst($doctor->address);}else{ echo 'N/A';}?></p>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-2 col-sm-1">
                                            <img src="<?php echo base_url('asset/images/icon1.png')?>" alt="location">
                                        </div>
                                        <div class="col-xs-10 col-sm-10">
                                            <p class="clinic-contact-p"><?php if(!empty($doctor->consultancy_fees)){ echo ucfirst($doctor->consultancy_fees);}else{ echo 'N/A';}?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-2 col-sm-1">
                                            <img src="<?php echo base_url('asset/images/watch.png')?>" alt="location">
                                        </div>
                                        <div class="col-xs-10 col-sm-10">
                                            <p class="clinic-contact-p"><span>Mon - Fri</span><br> 9:30 AM - 8:30 PM </p>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-2 col-sm-1">
                                            <img src="<?php echo base_url('asset/images/hand.png')?>" alt="location">
                                        </div>
                                        <div class="col-xs-10 col-sm-10">
                                            <p class="clinic-contact-p">98%</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-2 col-sm-1">
                                            <img src="<?php echo base_url('asset/images/notepad.png')?>" alt="location">
                                        </div>
                                        <div class="col-xs-10 col-sm-10">
                                            <p class="clinic-contact-p">50 FeedBack</p>
                                        </div>
                                    </div>

                                    <div class="contact-clinic-btn">
                                        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo_<?php echo $i?>">Simple collapsible</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row contact-clinic-expand-div">
                        <div class="col-xs-12 col-md-12">
                            <div id="demo_<?php echo $i?>" class="collapse">
                                <h2>
                                    Ph: +91 11111 11111 (Extension: 298)
                                </h2>
                                <p>
                                    Note: Dial the phone number first. The audio will guide you to enter the extension. This call may be recorded for quality control purpose and call recording may be shared with the center you are trying to connect By calling this number, you agree to the Terms & Conditions
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++;}?>
                <div class="col-xs-12 col-sm-3 right-side">
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>