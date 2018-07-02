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
        <script src="<?php echo base_url('asset/js/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('asset/js/bootstrap.min.js')?>"></script>
    <script>
        $(".myButton").click(function() {
            var effect = 'slide';
            var options = {
                direction: $('.mySelect').val()
            };
            var duration = 2000;
            $('#myDiv').toggle(effect, options, duration);
        });
        
    </script>
</body>
</html>