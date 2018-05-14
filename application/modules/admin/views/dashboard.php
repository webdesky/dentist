<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php 
        $user_role = $this->session->userdata('user_role');
    ?>
    <!-- /.row -->
    <div class="row">
    <?php if($user_role==1){?>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-first">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-hospital-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php echo $totalHospital;?>
                            </div>
                            <div>Total Hospitals!</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo base_url('admin/hospitals_list');?>">
                    <div class="panel-footer">
                        <span class="pull-left">Hospitals</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <?php }?>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa fa-user-md fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php echo $total_users_count[0]->doctor; ?>
                            </div>
                            <div>Total Doctors!</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo base_url('admin/users_list/2');?>">
                    <div class="panel-footer">
                        <span class="pull-left">Doctors</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa fa-wheelchair fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php echo $total_users_count[0]->patient; ?>
                            </div>
                            <div>Total Patients!</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo base_url('admin/users_list/3') ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Patients</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php echo $totalAppointment ?>
                            </div>
                            <div>Total Appointments!</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo base_url('admin/appointment_list/') ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Appointments</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <div class="row" style="margin-top: 25px;">
        <div class="col-lg-12">
            <!-- /.panel -->
            <?php if(!empty($appointmentList)){?>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-tasks"></i> Current Appointments
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th>#</th>
                                                <th>Appoitnment Id</th>
                                                <th>Patient Name</th>
                                                <th>Doctor Name</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count=1;foreach ($appointmentList as $key => $value) {?>
                                            <tr>
                                                <td>
                                                    <?php echo $count; ?>
                                                </td>
                                                <td>
                                                    <?php echo $value->appointment_id; ?>
                                                </td>
                                                <td>
                                                    <?php echo ucfirst($value->patient_name); ?>
                                                </td>
                                                <td>
                                                    <?php echo ucfirst($value->doctor_name); ?>
                                                </td>
                                                <td>
                                                    <?php echo $value->appointment_date; ?>
                                                </td>
                                                <td>
                                                    <?php echo $value->appointment_time; ?>
                                                </td>
                                            </tr>
                                            <?php $count++;  } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.col-lg-4 (nested) -->
                            <!-- /.col-lg-8 (nested) -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
            <?php }if(!empty($messages_list)){?>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-commenting "></i> Messages
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th>#</th>
                                                <th>To</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count=1;foreach ($messages_list as $key => $value) {?>
                                            <tr>
                                                <td>
                                                    <?php echo $count; ?>
                                                </td>
                                                <td>
                                                    <?php echo ucfirst($value->first_name); ?>
                                                </td>
                                                <td>
                                                    <?php echo $value->subject; ?>
                                                </td>
                                                <td>
                                                    <?php echo $value->message; ?>
                                                </td>
                                                <td>
                                                    <?php echo date('Y-m-d',strtotime($value->created_at)) ?>
                                                </td>

                                            </tr>
                                            <?php $count++;  }  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.col-lg-4 (nested) -->
                            <!-- /.col-lg-8 (nested) -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->