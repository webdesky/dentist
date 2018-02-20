<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Appointment</h1>
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
                <div class="panel-heading"> <button class="btn btn-primary"><i class="fa fa-th-list">&nbsp;Edit Appointment</i></button> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('doctor/addAppointment/'.$appointment[0]->ap_id) ?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="form-group"> <label class="col-md-2">Appointment Id * </label>
                                    <div class="col-lg-6"> <input type="text" readonly="readonly" value="<?php echo $appointment[0]->appointment_id ?>" class="form-control"> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Patient ID * </label>
                                    <div class="col-lg-6"> <select class="wide" name="patient_id" id="patient_id">
                                            <?php foreach ($patient as $key => $value) { ?>
                                              <option value="<?php echo $value->id; ?>" <?php if($appointment[0]->patient_id==$value->id){ echo 'selected';}?>><?php echo $value->id;?></option>
                                            <?php } ?>
                                        </select> <span><?php echo form_error('patient_id'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Doctor Name * </label>
                                    <div class="col-lg-6"> <select class="wide" name="doctor_id">
                                            <?php foreach ($doctor as $key => $value) { ?>
                                                <option value="<?php echo $value->id; ?>" <?php if($appointment[0]->doctor_id==$value->id){ echo 'selected';}?>><?php echo $value->first_name;?></option>
                                            <?php } ?>
                                        </select> <span><?php echo form_error('doctor_id'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Appointment Date * </label>
                                    <div class="col-lg-6"> <input type="text" id="startdate" name="appointment_date" id="appointment_date" class="form-control" autocomplete="off" readonly="readonly" placeholder="Start Date" style="width: 50%;float: left; "> <input type="text" id="timepicker" name="appointment_time" class="form-control" autocomplete="off" readonly="readonly" placeholder="Start Time" style="width: 50%;"> <span><?php echo form_error('appointment_date'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Problem </label>
                                    <div class="col-lg-6"> <textarea class="form-control" rows="5" id="problem" name="problem" placeholder="Problem"><?php echo $appointment[0]->problem; ?></textarea> </div>
                                </div>
                                <div class="col-md-12" align="center"> <button type="submit " value="Save " class="btn btn-success ">Save</button> <button type="reset " class="btn btn-default ">Reset</button> </div>
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
<script type="text/javascript ">
$(document).ready(function() {
    $('select').niceSelect();
    $("#startdate ").datepicker();
    $("#enddate ").datepicker();
    $('#timepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 60,
        minTime: '10',
        maxTime: '6:00pm',
        defaultTime: '11',
        startTime: '10:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
});
</script>