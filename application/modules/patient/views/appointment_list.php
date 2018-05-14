<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Appointment </h1>
        </div>
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
                    <a class="btn btn-primary" href="<?php echo base_url('patient/addAppointment')?>"><i class="fa fa-th-list">&nbsp;Take Appointment</i></a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="notice">
                            <thead>
                                <tr class="bg-primary">
                                    <th>Sr.No</th>
                                    <th>Id</th>
                                    <th>Doctor</th>
                                    <th>Problem</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $count=1;
                                if(!empty($appointmentList))
                                {
                                    foreach ($appointmentList as  $value) 
                                    { 

                                        ?>
                                <tr class="odd gradeX">
                                    <td>
                                        <?php echo $count; ?>
                                    </td>
                                    <td>
                                        <?php echo $value->appointment_id; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo ucwords($value->first_name." ".$value->last_name); ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->problem; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo date('d/m/Y',strtotime($value->appointment_date))." ".date('h:i:A',strtotime($value->appointment_time)); ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($value->is_active==0){  ?>
                                            <button class="btn btn-danger">Pending</button>
                                            <?php  }else{ ?>
                                            <button class="btn btn-success">Approved</button>
                                        <?php  }?>
                                    </td>
                                    <td class="center"><a href="<?php echo base_url('patient/view_appointment/'.$value->id); ?>"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                <?php $count++; }}?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#notice').DataTable({
        responsive: true,
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': [-1] /* 1st one, start by the right */
        }]
    });
});
</script>