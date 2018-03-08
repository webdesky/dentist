<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Schedule</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <?php if(validation_errors()){?>
            <div class="alert alert-danger"> <strong>Danger!</strong>
                <?php echo validation_errors(); ?> </div>
            <?php }if(!empty($msg)){?>
            <div class="alert alert-success">
                <?php echo $msg;?> </div>
            <?php }?>
            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?> </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-primary"><i class="fa fa-th-list">&nbsp;Edit Schedule</i></button>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('doctor/addSchedule/'.$schedule[0]->doctor_id) ?>" class="registration_form1" enctype="multipart/form-data">
                                <?php $i=1;  foreach ($schedule as $key => $value) {?>
                                <div class="form-group" <?php if($i==count($schedule)){?> id="app"
                                    <?php }?>>
                                    <label class="col-md-2">
                                        <?php if($i==1){?>Available Days
                                        <?php }?>
                                    </label>
                                    <?php if($i>1){ ?>
                                        <div class="selected">
                                     <?php  } ?>
                                    <div class="col-lg-4">
                                        <select name="schedule[]" id="schedule" class="wide">
                                            <option value="">--SELECT DAY--</option>
                                            <option value="sunday" <?php if($schedule[$key]->day=='sunday'){ echo 'selected';}?>>Sunday</option>
                                            <option value="monday" <?php if($schedule[$key]->day=='monday'){ echo 'selected';}?>>Monday</option>
                                            <option value="tuesday" <?php if($schedule[$key]->day=='tuesday'){ echo 'selected';}?>>Tuesday</option>
                                            <option value="wednesday" <?php if($schedule[$key]->day=='wednesday'){ echo 'selected';}?>>Wednesday</option>
                                            <option value="thursday" <?php if($schedule[$key]->day=='thursday'){ echo 'selected';}?>>Thursday</option>
                                            <option value="friday" <?php if($schedule[$key]->day=='friday'){ echo 'selected';}?>>Friday</option>
                                            <option value="saturday" <?php if($schedule[$key]->day=='saturday'){ echo 'selected';}?>>Saturday</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="text" id="starttime" name="starttime[]" value="<?php echo $schedule[$key]->starttime; ?>" class="form-control time" autocomplete="off" readonly="readonly" placeholder="Start Time"> </div>
                                    <div class="col-lg-2">
                                        <input type="text" id="endtime" name="endtime[]" value="<?php echo $schedule[$key]->endtime; ?>" class="form-control time" autocomplete="off" readonly="readonly" placeholder="Start Time"> </div>
                                    <?php if($i>1){?>
                                    <div class="col-lg-2" style="margin-top: 5px;"><i class="fa fa-minus-circle remove" aria-hidden="true" id="removeButton" style="font-size:25px;"></i></div>
                                    <?php }else{?>
                                    <div class="col-lg-2" style="margin-top: 5px;"> <i class="fa fa-plus-circle" aria-hidden="true" id="add" style="font-size: 25px;"></i> </div>
                                    <?php }?>
                                    <?php if($i>1){ ?>
                                        </div>
                                     <?php  } ?>
                                </div>
                                <?php   $i++; }?>
                                <!-- lg 12 ends -->
                        </div>
                        <div class="col-md-12" align="center">
                            <button type="submit" value="Save" class="btn btn-success">Save</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- row -->
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('select').niceSelect();
    var counter = 2;
    $("#add").click(function() {
        if (counter > 14) {
            alert("Only 14 textboxes allow");
            return false;
        }
        $("#app").after('<div class="form-group" id="box' + counter + '"><label class="col-md-2"></label><div class="col-lg-4"><select class="wide" name="schedule[]" ><option value="" selected="selected">--SELECT DAY--</option><option value="sunday">Sunday</option><option value="monday">Monday</option><option value="tuesday">Tuesday</option><option value="wednesday">Wednesday</option><option value="thursday">Thursday</option><option value="friday">Friday</option><option value="saturday">Saturday</option></select></div> <div class="col-lg-2"><input type="text" id="starttime" name="starttime[]" class="form-control time" autocomplete="off" readonly="readonly"  placeholder="StartTime"></div><div class="col-lg-2"><input type="text" id="endtime" name="endtime[]" class="form-control time" autocomplete="off" readonly="readonly"  placeholder="EndTime"></div><i class="fa fa-minus-circle remove" aria-hidden="true" id="removeButton" style="font-size:25px;margin-left: 15px;"></i></div>');
        // $('select').select2({
        //     // dropdownAutoWidth : true,
        //     width: '50%'
        // });
        $('.time').each(function() {
            $(this).timepicker();
        });
        $('select').each(function() {
            $(this).niceSelect();
        });
        counter++;
    });
    $("body").on("click", ".remove", function() {
        $(this).closest("div").remove();
    });
    $("#removeButton").click(function() {
        console.log(counter);
        if (counter == 1) {
            alert(counter);
            return false;
        }
        counter--;
        $("#box" + counter).remove();
    });
    $('.time').each(function() {
        $(this).timepicker();
    });

    var i = 1;
    $(".selected").each(function(index) {
        $(this).on("click", function() {
            $(this).remove();


        });
    });


});
</script>