<div class="main-div">
<div class="bdr"></div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-9">
                <!-- Filter div -->
                <div class="filter-section">
                        <div class="row">
                            <form class="form-inline" action="<?php echo base_url('front/filter_doctor');?>" method="POST">
                                <div class="form-group">
                                    <ul class="outer-ul">
                                    <input type="hidden" name="specialization" value="<?php if(!empty($this->uri->segment(3))){ echo $this->uri->segment(3);}?>">
                                        <!-- <li class="outer-li">
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox2" type="checkbox" value="1" name="hospital">
                                                <label for="checkbox2">
                                                    In Hospital
                                                </label>
                                            </div>
                                        </li>
                                        <li class="outer-li Online-Booking">
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox3" type="checkbox" value="1" name="online_booking">
                                                <label for="checkbox3">
                                                    Online Booking
                                                </label>
                                            </div>
                                        </li> -->
                                        <li class="outer-li all-filer">
                                            <div class="dropdown">
                                                <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown">All Filters   <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <div class="col-xs-12 col-md-6">
                                                        <h5>Consultation Fee</h5>
                                                        <input type="radio" name="consultancy_fee" value="0" checked="checkbox"> Free <br>
                                                        <input type="radio" name="consultancy_fee" value="200"> 1-200 <br>
                                                        <input type="radio" name="consultancy_fee" value="500"> 201 - 500 <br>
                                                        <input type="radio" name="consultancy_fee" value="10000"> 500+ <br>
                                                    </div>
                                                    <div class="col-xs-12 col-md-6">
                                                        <h5>Gender</h5>

                                                        <input type="radio" name="doctor_gender" value="male"> Male Doctor <br/>
                                                        <input type="radio" name="doctor_gender" value="female"> Female Doctor <br/>
                                                    </div>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="outer-li Relevance">
                                            <div class="dropdown"> <label>Sort By </label>&nbsp;&nbsp;
                                                <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown">Relevance <i class="fa fa-angle-down"></i>
                                                    </button>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-m"><input type="radio" name="experience" value="asc"/>Experience- Low to High</li>
                                                    <li class="dropdown-m"><input type="radio" name="experience" value="desc"/>Experience- High to Low</li>
                                                    <li class="dropdown-m"><input type="radio" name="price" value="asc"/>Price - Low to High</li>
                                                    <li class="dropdown-m"><input type="radio" name="price" value="desc"/>Price - High to Low</li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="outer-li Availability">
                                            <div class="dropdown">
                                                <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown">Availability <i class="fa fa-angle-down"></i>
                                                    </button>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-m"><input type="radio" name="availability" value="<?php echo date('Y-m-d')?>" checked="checked"/>
                                                    Available Today</li>
                                                    <li class="dropdown-m"><input type="radio" name="availability" value="<?php echo date('Y-m-d' , strtotime('tomorrow'))?>"/>
                                                    Available Tomorrow</li>
                                                    <!-- <li class="dropdown-m"><a href="#">JavaScript</a></li> -->
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="outer-li">
                                            <input type="submit" name="submit" value="Search" class="btn btn-info">
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
        <?php if(!empty($doctors[0])) {
                $i=1; 
                foreach($doctors as $doctor){?>
        <div class="">
            <div class="col-xs-12 col-sm-9 item-list left-side">
                <div class="item-inner">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 dr-details">
                            <div class="col-xs-12 col-sm-3">
                                <?php if(!empty($doctor->profile_pic)){?>
                                <img src="<?php echo base_url('asset/uploads/'.$doctor->profile_pic)?>" alt="" class="img-responsive">
                                <?php }else{?>
                                <img src="<?php echo base_url('asset/uploads/download.png')?>" alt="" class="img-responsive">
                                <?php }?>
                            </div>
                            <div class="col-xs-12 col-sm-9">
                                <div class="dr-name">
                                    <?php echo ucwords($doctor->first_name.' '.$doctor->last_name);?>
                                </div>
                                <div class="address">
                                    <?php if(!empty($doctor->degree)){ echo strtoupper($doctor->degree).' ,'; }else{ echo 'N/A ,';}?>
                                    
                                    <?php if(!empty($doctor->experience)){ echo $doctor->experience .' Years Experience'; }else{ echo 'N/A';}?> <br>
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
                                    <div class="col-xs-2 col-sm-1 remove-padding-xs-1">
                                        <img src="<?php echo base_url('asset/images/location.png')?>" alt="location">
                                    </div>
                                    <div class="col-xs-10 col-sm-10">
                                        <p class="clinic-contact-p">
                                            <?php if(!empty($doctor->address)){ echo ucfirst($doctor->address);}else{ echo 'N/A';}?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-2 col-sm-1 remove-padding-xs-1">
                                        <img src="<?php echo base_url('asset/images/icon1.png')?>" alt="location">
                                    </div>
                                    <div class="col-xs-10 col-sm-10">
                                        <p class="clinic-contact-p">
                                            <?php if(!empty($doctor->consultancy_fees)){ echo ucfirst($doctor->consultancy_fees);}else{ echo 'N/A';}?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-2 col-sm-1 remove-padding-xs-1">
                                        <img src="<?php echo base_url('asset/images/watch.png')?>" alt="location">
                                    </div>
                                    <div class="col-xs-10 col-sm-10">
                                        <p class="clinic-contact-p"><a href="JavaScript:void(0)" onclick="get_doctor_schedule('<?php echo $doctor->id?>')">Schedule</a> </p>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-xs-2 col-sm-1 remove-padding-xs-1">
                                        <img src="<?php //echo base_url('asset/images/hand.png')?>" alt="location">
                                    </div>
                                    <div class="col-xs-10 col-sm-10">
                                        <p class="clinic-contact-p">98%</p>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-xs-2 col-sm-1 remove-padding-xs-1">
                                        <img src="<?php echo base_url('asset/images/notepad.png')?>" alt="location">
                                    </div>
                                    <div class="col-xs-10 col-sm-10">
                                        <p class="clinic-contact-p"><?php if(!empty($doctor->review_count)) { echo $doctor->review_count; }else{ echo '0';}?> FeedBack</p>
                                    </div>
                                </div>
                                <div class="contact-clinic-btn">
                                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo_<?php echo $i?>">Address / Contact</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row contact-clinic-expand-div">
                    <div class="col-xs-12 col-md-12">
                        <div id="demo_<?php echo $i?>" class="collapse">
                            <h2>
                                <?php if(!empty($doctor->mobile)){ echo '<u>Phone no</u>: ' .$doctor->mobile;}?>
                            </h2>
                            <p>
                            <h2>
                                <?php if(!empty($doctor->phone_no)){ echo '<u>Contact no</u>: ' .$doctor->phone_no;}?>
                            </h2>
                            <h2>
                                <?php if(!empty($doctor->address)){ echo '<u>Address</u>: ' .$doctor->address;}?>
                            </h2>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 right-side">
            </div>
        </div>
        <?php $i++;}}else{ echo '<div class="alert alert-info"><strong>Info!</strong> No Result Found... Please try with different filter</div><b></b><div style="min-height:200px"></div>';}?>
    </div>
</div>





<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Doctor's Schedule</h4>
            </div>
            <div class="modal-body">
                <table id="table" class="table table-bordered" border="1">
                    <tr>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>