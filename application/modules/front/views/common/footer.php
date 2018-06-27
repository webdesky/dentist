<div class="clearfix"></div>
<section class="footer_info">
    <div class="contact" id="contact">
        <div class="container wow fadeInDown">
            <div class="f-bg-w3l">
                <div class="col-md-4  w3layouts_footer_grid1">
                    <div class="form-bg-w3ls">
                        <img src="<?php echo base_url('asset/images/logo_2.png')?>" alt="logos">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                    </div>
                </div>
                <div class="col-md-4  w3layouts_footer_grid w3layouts_footer_grid_2">
                    <ul class="quicks_linke">
                        <li> <a href="#">Practo</a> </li>
                        <li> <a href="#">About Us</a> </li>
                        <li> <a href="#">Blog</a> </li>
                        <li> <a href="#">Careers</a> </li>
                        <li> <a href="#">Press</a> </li>
                        <li> <a href="#">Contact Us</a> </li>
                    </ul>
                </div>
                <div class="col-md-4  w3layouts_footer_grid">
                    <ul class="con_inner_text">
                        <li><span class="fa fa-map-marker" aria-hidden="true"></span> 6/1, 105 Magnet Tower, New Palasia, <br> Opposite to Corporation Bank New <br>Palasia Indore (452001) </li>
                        <li><span class="fa fa-phone" aria-hidden="true"></span> +91-9826021003 <br> +91-8770023264 </li>
                        <li><span class="fa fa-envelope-o" aria-hidden="true"></span> <a href="#">contact@doctorsearch.com</a>
                            <br> <a href="#">support@doctorsearch.com</a></li>
                    </ul>
                    <ul class="social_agileinfo">
                        <li><a href="#" class="w3_facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" class="w3_instagram"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#" class="w3_twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" class="w3_google"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
                <ul class="terms_conditionns">
                    <li>Terms and Condition</li>
                    <li>Privacy Policy</li>
                    <li>© Copyright 2018 Teqween.</li>
                    <li>- All Rights Reserved</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
<script src="<?php echo base_url('asset/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('asset/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('asset/dist/js/bootstrap-datepicker.js')?>"></script>
<script src="<?php echo base_url('asset/js/wow.js')?>"></script>


<script>
    $('.carousel').carousel({
        interval: 2000
    });
    new WOW().init();

    $(function() {
        $('.repeat ').click(function() {
            var classes = $(this).parent().attr('class ');
            $(this).parent().attr('class', 'animate ');
            var indicator = $(this);
            setTimeout(function() {
                $(indicator).parent().addClass(classes);
            }, 2000);
        });

        $('ul.nav.navbar-nav li').click(function() {
            $('li').removeClass("active");
            $(this).addClass("active");
        });

        $('#login-form-link').click(function(e) {
            $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });

        $('#register-form-link').click(function(e) {
            $("#register-form").delay(100).fadeIn(100);
            $("#login-form").fadeOut(100);
            $('#login-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });

        $("#signup_dob").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            startView: "months",
            startDate: '-100y',
            endDate: '-30y'
        });

        var speciality_list = $('#speciality_list');

        $('#search_doctor').on('click', function(e) {
            e.stopPropagation();
            speciality_list.toggle();
        });

        $(document).on('click', function(e) {
            speciality_list.hide();
        });
    });


    var stickyOffset = $('.sticky').offset().top;

    $(window).scroll(function() {
        var sticky = $('.sticky'),
            scroll = $(window).scrollTop();

        if (scroll >= 100) sticky.addClass('fixed');
        else sticky.removeClass('fixed');
    });

    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("myBtn").style.display = "block";
        } else {
            document.getElementById("myBtn").style.display = "none";
        }
    }

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    $(".myButton").click(function() {
        var effect = 'slide';
        var options = {
            direction: $('.mySelect').val()
        };
        var duration = 2000;
        $('#myDiv').toggle(effect, options, duration);
    });
</script>

<script type="text/javascript">
    $.get("http://ipinfo.io", function(response) {
        $("#city_name").val(response.city);
        document.cookie = "user_location="+response.city;
    }, "jsonp");
</script>
</body>

</html>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn btn-default" data-dismiss="modal">X</button>
                        <h4 class="modal-title">Login / Register</h4>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-login">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <a href="#" class="active" id="login-form-link">Login</a>
                                                </div>
                                                <div class="col-xs-6">
                                                    <a href="#" id="register-form-link">Sign Up</a>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form id="login-form" action="<?php echo base_url('front/verifylogin')?>" method="post" role="form" style="display: block;">
                                                        <div class="form-group">
                                                            <input type="text" name="login_username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" name="login_password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                                        </div>
                                                        <div class="form-group text-center">
                                                            <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                                            <label for="remember"> Remember Me</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-sm-offset-3">
                                                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="text-center">
                                                                        <a href="" tabindex="5" class="forgot-password">Forgot Password?</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <form id="register-form" action="<?php echo base_url('front/add_user')?>" method="post" role="form" style="display: none;" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <input type="text" name="signup_first_name" id="signup_first_name" tabindex="1" class="form-control" placeholder="First Name" value="<?php echo set_value('user_name');?>">
                                                            <span class="red"><?php echo form_error('signup_first_name'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="signup_last_name" id="signup_last_name" tabindex="1" class="form-control" placeholder="Last Name" value="<?php echo set_value('user_name');?>">
                                                            <span class="red"><?php echo form_error('signup_last_name'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="signup_dob" id="signup_dob" tabindex="1" class="form-control" placeholder="Date of Birth" value="<?php echo set_value('user_name');?>">
                                                            <span class="red"><?php echo form_error('signup_dob'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="signup_username" id="signup_username" tabindex="1" class="form-control" placeholder="Username" value="<?php echo set_value('user_name');?>">
                                                            <span class="red"><?php echo form_error('signup_username'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="email" name="signup_email" id="signup_email" tabindex="1" class="form-control" placeholder="Email Address" value="<?php echo set_value('user_name');?>">
                                                            <span class="red"><?php echo form_error('signup_email'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" name="signup_password" id="signup_password" tabindex="2" class="form-control" placeholder="Password">
                                                            <span class="red"><?php echo form_error('signup_password'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" name="signup_confirm_password" id="signup_confirm_password" tabindex="2" class="form-control" placeholder="Confirm Password">
                                                            <span class="red"><?php echo form_error('signup_confirm_password'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="signup_contact" id="signup_contact" class="form-control" placeholder="Contact No">
                                                            <span class="red"><?php echo form_error('signup_confirm_password'); ?></span>
                                                        </div>

                                                        <div class="form-group">
                                                            <textarea name="signup_address" id="signup_address" class="form-control" placeholder="Address"></textarea>
                                                            <span class="red"><?php echo form_error('signup_address'); ?></span>
                                                        </div>



                                                        <div class="form-group">
                                                         <b>Gender : </b>
                                                            &nbsp;<input type="radio" name="signup_sex" tabindex="2" value="male">&nbsp;Male
                                                            &nbsp;&nbsp;
                                                            <input type="radio" name="signup_sex" tabindex="2" value="female">&nbsp;Female
                                                        </div>
                                                        <div class="form-group">
                                                        <b>I want to Sign up as : </b>
                                                            &nbsp;<input type="radio" name="signup_type"  tabindex="2" value="2">&nbsp;Doctor
                                                            &nbsp;&nbsp;
                                                            <input type="radio" name="signup_type" tabindex="2" value="3">&nbsp;Patient
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-sm-offset-3">
                                                                    <input type="submit" name="submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
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
        </div>


        <style type="text/css">
    #myModal .panel-login {
        border-color: #ccc;
        -webkit-box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.2);
        box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.2);
    }

    #myModal .panel-login>.panel-heading {
        color: #00415d;
        background-color: #fff;
        border-color: #fff;
        text-align: center;
    }

    .panel-login>.panel-heading a {
        text-decoration: none;
        color: #666;
        font-weight: bold;
        font-size: 15px;
        -webkit-transition: all 0.1s linear;
        -moz-transition: all 0.1s linear;
        transition: all 0.1s linear;
    }

    #myModal .panel-login>.panel-heading a.active {
        color: #029f5b;
        font-size: 18px;
    }

    #myModal .panel-login>.panel-heading hr {
        margin-top: 10px;
        margin-bottom: 0px;
        clear: both;
        border: 0;
        height: 1px;
        background-image: -webkit-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));
        background-image: -moz-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));
        background-image: -ms-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));
        background-image: -o-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));
    }

    #myModal .panel-login input[type="text"],
    .panel-login input[type="email"],
    .panel-login input[type="password"] {
        height: 45px;
        border: 1px solid #ddd;
        font-size: 16px;
        -webkit-transition: all 0.1s linear;
        -moz-transition: all 0.1s linear;
        transition: all 0.1s linear;
    }

    #myModal .panel-login input:hover,
    #myModal .panel-login input:focus {
        outline: none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        border-color: #ccc;
    }

    #myModal .btn-login {
        background-color: #59B2E0;
        outline: none;
        color: #fff;
        font-size: 14px;
        height: auto;
        font-weight: normal;
        padding: 14px 0;
        text-transform: uppercase;
        border-color: #59B2E6;
    }

    #myModal .btn-login:hover,
    #myModal .btn-login:focus {
        color: #fff;
        background-color: #53A3CD;
        border-color: #53A3CD;
    }

    #myModal .forgot-password {
        text-decoration: underline;
        color: #888;
    }

    #myModal .forgot-password:hover,
    #myModal .forgot-password:focus {
        text-decoration: underline;
        color: #666;
    }

    #myModal .btn-default {
        float: right;
    }

    .modal#myModal {
        z-index: 99999;
    }

    #myModal .btn-register {
        background-color: #1CB94E;
        outline: none;
        color: #fff;
        font-size: 14px;
        height: auto;
        font-weight: normal;
        padding: 14px 0;
        text-transform: uppercase;
        border-color: #1CB94A;
    }

    #myModal .btn-register:hover,
    #myModal .btn-register:focus {
        color: #fff;
        background-color: #1CA347;
        border-color: #1CA347;
    }
</style>