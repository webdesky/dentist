<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dr. <?php echo ucfirst($doctor[0]->first_name).'\'s';?> Review</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <style type="text/css">
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
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label>Q1. Would you like to recommend the doctor?</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <p>
                                                <?php echo $review[0]->recommendation; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label>Q2. For which health problem/treatment did you visit?</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <p>
                                                <?php echo $review[0]->problem ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label>Q3. What do you think can be improved?</label>
                                        </div>
                                        <div class="checkbox">
                                            <?php
                                                    $improvement=explode(',', $review[0]->improvement);
                                                    
                                                   ?>
                                                <label style="font-size: 1em">
                                                    <input type="checkbox" value="friendiness" name="improvement[]" <?php if(in_array( "friendiness", $improvement)){ echo "checked" ;}?> >
                                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span> Doctor Friendiness
                                                </label>
                                        </div>
                                        <div class="checkbox">
                                            <label style="font-size: 1em">
                                                <input type="checkbox" value="issue" name="improvement[]" <input type="checkbox" value="issue" name="improvement[]" <?php if(in_array( "friendiness", $improvement)){ echo "checked" ;}?>>
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span> Explaination Of Health Issue
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label style="font-size: 1em">
                                                <input type="checkbox" value="treatment" name="improvement[]" <?php if(in_array( "treatment", $improvement)){ echo "checked" ;}?>>
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span> Treatment Satisfaction
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label style="font-size: 1em">
                                                <input type="checkbox" value="time" name="improvement[]" <?php if(in_array( "time", $improvement)){ echo "checked" ;}?> >
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
                                            <p>
                                                <?php  echo $review[0]->experience?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label>Rating</label>
                                        </div>
                                        <div class="star-rating">
                                            <?php
                              for ($i=0; $i <=$review[0]->rating-1 ; $i++) { ?>
                                                <span class="fa fa-star-o" data-rating="1" style="font-size:25px;"></span>
                                                <?php } ?>
                                                <input type="hidden" name="rating" class="rating-value" value="<?php echo $review[0]->rating ?>">
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