<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Review Doctor</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <style type="text/css">
    .switch-field {
        font-family: "Lucida Grande", Tahoma, Verdana, sans-serif;
        padding: 40px;
        overflow: hidden;
    }

    .switch-title {
        margin-bottom: 6px;
    }

    .switch-field input {
        position: absolute !important;
        clip: rect(0, 0, 0, 0);
        height: 1px;
        width: 1px;
        border: 0;
        overflow: hidden;
    }

    .switch-field label {
        float: left;
    }

    .switch-field label {
        display: inline-block;
        width: 60px;
        background-color: #e4e4e4;
        color: rgba(0, 0, 0, 0.6);
        font-size: 14px;
        font-weight: normal;
        text-align: center;
        text-shadow: none;
        padding: 6px 14px;
        border: 1px solid rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
        -webkit-transition: all 0.1s ease-in-out;
        -moz-transition: all 0.1s ease-in-out;
        -ms-transition: all 0.1s ease-in-out;
        -o-transition: all 0.1s ease-in-out;
        transition: all 0.1s ease-in-out;
    }

    .switch-field label:hover {
        cursor: pointer;
    }

    .switch-field input:checked+label {
        background-color: #A5DC86;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .switch-field label:first-of-type {
        border-radius: 4px 0 0 4px;
    }

    .switch-field label:last-of-type {
        border-radius: 0 4px 4px 0;
    }

    .checkbox label:after,
    .radio label:after {
        content: '';
        display: table;
        clear: both;
    }

    .checkbox .cr,
    .radio .cr {
        position: relative;
        display: inline-block;
        border: 1px solid #a9a9a9;
        border-radius: .25em;
        width: 1.3em;
        height: 1.3em;
        float: left;
        margin-right: .5em;
    }

    .radio .cr {
        border-radius: 50%;
    }

    .checkbox .cr .cr-icon,
    .radio .cr .cr-icon {
        position: absolute;
        font-size: .8em;
        line-height: 0;
        top: 50%;
        left: 20%;
    }

    .radio .cr .cr-icon {
        margin-left: 0.04em;
    }

    .checkbox label input[type="checkbox"],
    .radio label input[type="radio"] {
        display: none;
    }

    .checkbox label input[type="checkbox"]+.cr>.cr-icon,
    .radio label input[type="radio"]+.cr>.cr-icon {
        transform: scale(3) rotateZ(-20deg);
        opacity: 0;
        transition: all .3s ease-in;
    }

    .checkbox label input[type="checkbox"]:checked+.cr>.cr-icon,
    .radio label input[type="radio"]:checked+.cr>.cr-icon {
        transform: scale(1) rotateZ(0deg);
        opacity: 1;
    }

    .checkbox label input[type="checkbox"]:disabled+.cr,
    .radio label input[type="radio"]:disabled+.cr {
        opacity: .5;
    }

    .star-rating {
        line-height: 32px;
        font-size: 1.25em;
    }

    .star-rating .fa-star {
        color: #87CEFA;
    }
    </style>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-primary"><i class="fa fa-th-list">&nbsp;Doctors Review</i></button>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="<?php echo base_url('patient/doctor_review') ?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="col-lg-12">
                                    <h3>How was your Appointment experience with Dr.<?php if(!empty($doctor[0])){ echo $doctor[0]->first_name.' '.$doctor[0]->last_name.'?'; }?></h3>
                                    <h4>your feedback will help over 1 lac people choose the right doctor,daily.</h4>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Q1. Would you like to recommend the doctor?</label>
                                        <div class="switch-field">
                                            <input type="radio" id="switch_left" name="recommendation" value="yes" checked/>
                                            <label for="switch_left">Yes</label>
                                            <input type="radio" id="switch_right" name="recommendation" value="no" />
                                            <label for="switch_right">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label>Q2. For which health problem/treatment did you visit?</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="hidden" name="doctor_id" value="<?php if(!empty($doctor[0])){ echo $doctor[0]->id;} ?>">
                                            <input type="hidden" name="prescription_id" value="<?php echo $prescription_id; ?>">
                                            <input type="text" class="form-control" name="problem" placeholder="eg.stomach,Ache,body pain">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label>Q3. What do you think can be improved?</label>
                                        </div>
                                        <div class="checkbox">
                                            <label style="font-size: 1em">
                                                <input type="checkbox" value="friendiness" checked name="improvement[]">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span> Doctor Friendiness
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label style="font-size: 1em">
                                                <input type="checkbox" value="issue" name="improvement[]">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span> Explaination Of Health Issue
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label style="font-size: 1em">
                                                <input type="checkbox" value="treatment" name="improvement[]">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span> Treatment Satisfaction
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label style="font-size: 1em">
                                                <input type="checkbox" value="time" name="improvement[]">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span> Wait Time
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label>Q4. Tell us About your Experience with the doctor?</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <textarea class="form-control" rows="5" id="experience" name="experience" placeholder="experience"></textarea>
                                        </div>
                                        <script type="text/javascript">
                                        CKEDITOR.replace('experience');
                                        </script>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label>Rating</label>
                                        </div>
                                        <div class="star-rating">
                                            <span class="fa fa-star-o" data-rating="1" style="font-size:25px;"></span>
                                            <span class="fa fa-star-o" data-rating="2" style="font-size:25px;"></span>
                                            <span class="fa fa-star-o" data-rating="3" style="font-size:25px;"></span>
                                            <span class="fa fa-star-o" data-rating="4" style="font-size:25px;"></span>
                                            <span class="fa fa-star-o" data-rating="5" style="font-size:25px;"></span>
                                            <input type="hidden" name="rating" class="rating-value" value="2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12" align="center">
                                    <div class="form-group">
                                        <input type="submit" value="Submit" class="btn btn-primary">
                                        <input type="reset" name="reset" value="Reset" class="btn btn-success">
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
<script type="text/javascript">
var $star_rating = $('.star-rating .fa');

var SetRatingStar = function() {
    return $star_rating.each(function() {
        if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
            return $(this).removeClass('fa-star-o').addClass('fa-star');
        } else {
            return $(this).removeClass('fa-star').addClass('fa-star-o');
        }
    });
};

$star_rating.on('click', function() {
    $star_rating.siblings('input.rating-value').val($(this).data('rating'));
    return SetRatingStar();
});

SetRatingStar();
</script>