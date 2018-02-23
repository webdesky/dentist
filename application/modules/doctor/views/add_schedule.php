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
                <div class="panel-heading"> <button class="btn btn-primary"><i class="fa fa-th-list">&nbsp;Add Schedule</i></button> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('doctor/addSchedule') ?>" class="registration_form1" enctype="multipart/form-data">
                                
                                
                                <div id="app"> <label class="col-md-2">Available Days * </label>
                                    <div class="col-lg-4"> 
                                        <select class="wide" name="schedule[]">
<<<<<<< HEAD
                                            <option data-display="Select Days">--Select Days--</option>
=======
                                            <option data-display="-- Select Days --">Select Days</option>
>>>>>>> d04e904cd3a90a0d7d018f54e7ba8eeafe157957
                                            <option value="sunday">Sunday</option>
                                            <option value="monday">Monday</option>
                                            <option value="tuesday">Tuesday</option>
                                            <option value="wednesday">Wednesday</option>
                                            <option value="thursday">Thursday</option>
                                            <option value="friday">Friday</option>
                                            <option value="saturday">Saturday</option>
                                        </select> 
                                    </div>
                                    <div class="col-lg-2"> <input type="text" id="starttime" name="starttime[]" class="form-control date" autocomplete="off" readonly="readonly" placeholder="StartTime"> </div>
                                    <div class="col-lg-2"> <input type="text" id="endtime" name="endtime[]" class="form-control date" autocomplete="off" readonly="readonly" placeholder="EndTime"> </div>
                                    <div class="col-lg-2" style="margin-top: 5px;"> <i class="fa fa-plus-circle" aria-hidden="true" id="add" style="font-size: 25px;"></i> </div>
                                </div>
                                <div class="clearfix"></div>
                                <br>
                                <div class="col-md-12" align="center"> <button type="submit" value="Save" class="btn btn-success">Save</button><button type="reset" class="btn btn-default">Reset</button> </div>
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
        $("#app").after('<div class="form-group" id="box' + counter + '"><label class="col-md-2"></label><div class="col-lg-4"><select class="wide" name="schedule[]" ><option data-display="-- Select Days --">Select Days</option><option value="sunday">Sunday</option><option value="Monday">Monday</option><option value="tuesday">Tuesday</option><option value="wednesday">Wednesday</option><option value="thursday">Thursday</option><option value="friday">Friday</option><option value="saturday">Saturday</option></select></div> <div class="col-lg-2"><input type="text" id="starttime" name="starttime[]" class="form-control date" autocomplete="off" readonly="readonly"  placeholder="StartTime"></div><div class="col-lg-2"><input type="text" id="endtime" name="endtime[]" class="form-control date" autocomplete="off" readonly="readonly"  placeholder="EndTime"></div><i class="fa fa-minus-circle remove" aria-hidden="true" id="removeButton" style="font-size:25px;margin-left: 15px;"></i></div>');
        $('.date').each(function() {
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
    $('.date').each(function() {
        $(this).timepicker();
    });
    $('select').niceSelect();
});

     
</script>