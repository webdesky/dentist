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
                <div class="panel-heading">
                    <button class="btn btn-primary"><i class="fa fa-th-list">&nbsp;Edit Appointment</i></button>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('doctor/addAppointment/'.$appointment[0]->id) ?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-2">Hospital Name * </label>
                                    <div class="col-lg-6">
                                        <input type="text" readonly="readonly" value="<?php echo $appointment[0]->hospital_name ?>" class="form-control"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Appointment Id * </label>
                                    <div class="col-lg-6">
                                        <input type="text" readonly="readonly" value="<?php echo $appointment[0]->appointment_id ?>" class="form-control"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Patient * </label>
                                    <div class="col-lg-6">
                                        <select class="wide" name="patient_id" id="patient_id">
                                            <?php foreach ($patient as $key => $value) { ?>
                                            <option value="<?php echo $value->id; ?>" <?php if($appointment[0]->patient_id==$value->id){ echo 'selected';}?>>
                                                <?php echo $value->id.'-'.ucfirst($value->first_name);?>
                                            </option>
                                            <?php } ?>
                                        </select> <span><?php echo form_error('patient_id'); ?></span> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Doctor * </label>
                                    <div class="col-lg-6">
                                        <input class="form-control" readonly name="doctor_id" value="<?php echo ucwords($this->session->userdata('first_name').' '.$this->session->userdata('last_name')); ?>">
                                        <input type="hidden" id="doctor_id" value="<?php echo $this->session->userdata('id') ?>">
                                        <span><?php echo form_error('doctor_id'); ?></span> </div>
                                </div>
                                <div id="data" style="display: none" class="col-lg-12">
                                    <div class="panel panel-info">
                                        <div class="panel-heading"><b>Schedule</b></div>
                                        <div class="panel-body">
                                            <table id="table" class="table table-striped table-hover">
                                                <tr>
                                                    <th>Day</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Appointment Date * </label>
                                    <div class="col-lg-6">
                                        <input type="text" name="appointment_date" id="appointment_date" class="form-control date" autocomplete="off" value="<?php echo $appointment[0]->appointment_date ?>" readonly="readonly"  style="width: 50%;float: left; ">
                                        <input type="text" id="timepicker" name="appointment_time" class="form-control" autocomplete="off" value="<?php echo $appointment[0]->appointment_time ?>" readonly="readonly" placeholder="Start Time" style="width: 50%;"> <span><?php echo form_error('appointment_date'); ?></span> </div>
                                </div>
                                <span id="error" style="color: red"></span>
                                <div class="form-group">
                                    <label class="col-md-2">Problem </label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" rows="5" id="problem" name="problem" placeholder="Problem"><?php echo $appointment[0]->problem; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12" align="center">
                                    <button type="submit" id="submit" value="Save " class="btn btn-success ">Save</button>
                                    <button type="reset " class="btn btn-default ">Reset</button>
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
<script type="text/javascript ">
$(document).ready(function() {
    $('select').niceSelect();
    $('#timepicker').timepicker({
        change: function(time) {

            doctor_id = $('#doctor_id').val();
            appointment_date = $('#appointment_date').val();

            var appointment_time = $(this).val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('patient/get_time')?>",
                data: {
                    'doctor_id': doctor_id,
                    'appointment_date': appointment_date
                },
                success: function(data) {
                    var obj = JSON.parse(data);
                    for (var i = 0; i < obj.length; i++) {
                        var check = obj[i].appointment_time;
                        if (check == appointment_time) {
                            $('#error').text('Appointment Already Booked Please Select Another time');
                            $('#submit').attr('disabled', true);
                            $('#timepicker').focus();
                            return false;

                        } else {
                            $('#error').text('');
                            $("#submit").removeAttr("disabled");
                        }
                    }
                }
            });
        }
    });

});
window.onload = getSchedule();

function getSchedule() {
    var doctor_id = $('#doctor_id').val();
    var appointment_date = $('#appointment_date').val();
    var appointment_time = $('#timepicker').val();
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/get_schedule')?>",
        data: {
            'doctor_id': doctor_id,
            'appointment_date': appointment_date,
            'appointment_time': appointment_time
        },
        success: function(data) {
            var obj = JSON.parse(data);
            $('#table tr').html('');
            for (var i = 0; i < obj.length; i++) {
                $('#table').append('<tr><td>' + obj[i].day.toUpperCase() + '</td><td>' + obj[i].starttime + '</td><td>' + obj[i].endtime + '</td></tr>');
                $('#data').show();

            }

        }
    });
}
</script>