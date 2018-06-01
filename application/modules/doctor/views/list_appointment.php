<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Appointment</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?>
            </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary"><i class="fa fa-th-list">&nbsp;View Appointment</i></a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="dataTables-example">
                            <thead>
                                <tr class="bg-primary">
                                    <th>SL.No</th>
                                    <th>Hospital Name</th>
                                    <th>Appointment Id</th>
                                    <th>Patient Name</th>
                                    <th>Appointment Date</th>
                                    <th>Appointment Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $count=1;
                                if($appointmentList){
                                foreach ($appointmentList as  $value) {?>
                                <tr class="odd gradeX" id="tr_<?php echo $count;?>">
                                    <td>
                                        <?php echo $count; ?>
                                    </td>
                                    <td>
                                        <?php echo ucwords($value->hospital_name); ?>
                                    </td>
                                    <td>
                                        <?php echo $value->appointment_id; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo ucwords($value->first_name.' '. $value->last_name); ?>
                                    </td>
                                    <td class="center">
                                        <?php echo date("Y-m-d", strtotime($value->appointment_date)); ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->appointment_time; ?>
                                    </td>
                                    <td class="center">
                                        <?php  if($value->is_active==0){ ?> 
                                        <button class="btn btn-danger" onclick="updateStatus('<?php echo $value->id ?>','<?php echo $value->is_active; ?>')">Pending</button> 
                                        <?php }else{?> <button class="btn btn-success" onclick="updateStatus('<?php echo $value->id ?>','<?php echo $value->is_active ?>')">Approved</button>
                                        <?php } ?> </td>
                                    <td class="center"><a href="<?php echo base_url('doctor/edit_appointment/').$value->id; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href="javascript:void(0)" onclick="delete_appointment('<?php echo $value->id?>','<?php echo $count;?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <?php $count++; } }?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

            <!-- calender starts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<h2 align="center"><a href="#">View all appointments</a></h2>
<div id="calendar"></div>
            
            <!-- calender ends -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<script type="text/javascript">
$('#dataTables-example').DataTable({
    responsive: true,
    'aoColumnDefs': [{
        'bSortable': false,
        'aTargets': [-1] /* 1st one, start by the right */
    }]
});

function delete_appointment(id, tr_id) {
    swal({
        title: "Are you sure?",
        text: "Are you sure that you want to Delete?",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Yes, Delete it!",
        confirmButtonColor: "#ec6c62"
    }, function() {
        $.ajax({
            url: "<?php echo base_url('doctor/delete_appointment')?>",
            data: {
                id: id,
                table: 'appointment'
            },
            type: "POST"
        }).done(function(data) {
            swal("Deleted!", "Record was successfully deleted!", "success");
            $('#tr_' + tr_id).remove();
        });
    });
}

function updateStatus(id, active) {
    if (active == 0) {
        data = 1;
    } else {
        data = 0;
    }
    swal({
        title: "Are you sure?",
        text: "You want to Change Status?",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Yes, Change it!",
        confirmButtonColor: "#ec6c62"
    }, function() {
        $.ajax({
            url: "<?php echo base_url('admin/update_status')?>",
            data: {
                id: id,
                active: data,
            },
            type: "POST"
        }).done(function(data) {
            swal("Changed!", "Status was successfully changed!", "success");
            window.location.reload();
        });
    });
}
</script>

<script>
$(document).ready(function() {
    var today = moment().day();
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
        },
        firstDay: today,
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        timeFormat: 'HH:mm',
        events: [
            <?php 
            if(!empty($appointmentList)){
            foreach ($appointmentList as  $value) {?> {
                title: '<?php echo $value->appointment_id;?> - <?php echo $value->first_name." ".$value->last_name;?> ',
                start: '<?php $date = explode(' ', $value->appointment_date); echo $date[0]?>T<?php $a = explode(' ', $value->appointment_time); echo $a[0]?>',
            },
            <?php } }?>
        ]
    });

});

</script>