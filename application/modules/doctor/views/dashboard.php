 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            
                    <div class="col-lg-6 col-md-12">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa fa-wheelchair fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $totalAppointment ?></div>
                                    <div>Total Patient!</div>
                                </div>
                            </div>
                        </div>
                         <a href="<?php echo base_url('doctor/users_list/') ?>">
                            <div class="panel-footer">
                                <span class="pull-left">Patient</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $totalAppointment ?></div>
                                    <div>Total Appointment!</div>
                                </div>
                            </div>
                        </div>
                         <a href="<?php echo base_url('doctor/appointment_list/') ?>">
                            <div class="panel-footer">
                                <span class="pull-left">Appointment</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
             
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                   
                    <!-- /.panel -->
                    <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tasks "></i> Current Appointments
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
                                                    <th>Patient ID</th>
                                                    <th>Doctor Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count=1;
                                                if(!empty($appointmentList)){
                                                foreach ($appointmentList as $key => $value) {
                                                    ?>
                                                    <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $value->appointment_id; ?></td>
                                                    <td><?php echo $value->patient_id; ?></td>
                                                    <td><?php echo $value->first_name; ?></td>
                                                    <td><?php echo $value->appointment_date; ?></td>
                                                    <td><?php echo $value->appointment_time; ?></td>
                                                </tr>
                                                 <?php $count++;  } }?>
                                                
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
                                                    <th>From</th>
                                                    <th>Subject</th>
                                                    <th>Message</th>
                                                    <th>Date</th>
                                                    
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count=1;
                                                 if(!empty($messages_list)){
                                                foreach ($messages_list as $key => $value) {
                                                    ?>
                                                    <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $value->first_name; ?></td>
                                                    <td><?php echo $value->subject; ?></td>
                                                    <td><?php echo $value->message; ?></td>
                                                    <td><?php echo $value->created_at; ?></td>
                                                   
                                                </tr>
                                                 <?php $count++;  } } ?>
                                                
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
            </div>
         </div>
                   
     </div>
        <!-- /#page-wrapper -->

    
    
   