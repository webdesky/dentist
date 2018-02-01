

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Appointment </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<!-- row -->
 			<div class="row">
                <div class="col-lg-12">
                	  <?php if ($info_message = $this->session->flashdata('info_message')): ?>
                        <div id="form-messages" class="alert alert-success" role="alert"><?php echo $info_message; ?></div>
                    <?php endif ?> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Appointment List
                        </div>
                        <?php 
                            $user_role  =   $this->session->userdata('user_role'); 
                            if($user_role==4){
                                $rights     =   explode(',',trim($this->session->userdata('rights')->rights,'"'));   
                                $right3     =   str_split($rights[3]);
                            }
                        ?>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="appointment">
                                <thead>
                                    <tr>
                                        <th>SL.No</th>
                                        <th>Appointment Id</th>
                                        <th>Patient_id</th>
                                        <th>Doctor Name</th>
                                        <th>Appointment Date</th>
                                        <th>Appointment Time</th>
                                        <?php if($user_role==1 || ($user_role==4 && $right3[1]==1 || $right3[2]==1)){?>
                                        <th>Action</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
 								$count=1;
                                if($appointmentList){
                                foreach ($appointmentList as  $value) { ?>
                                	<tr class="odd gradeX">
                                        <td><?php echo $count; ?></td>
                                        
                                        <td><?php echo $value->appointment_id; ?></td>
                                        <td class="center"><?php echo $value->patient_id; ?></td>
                                        <td class="center"><?php echo $value->first_name.' '. $value->last_name; ?></td>
                                        <td class="center"><?php echo $value->appointment_date; ?></td>
                                        <td class="center"><?php echo $value->appointment_time; ?></td>
                                       
                                       <?php if($user_role==1 || ($user_role==4 && $right3[1]==1 || $right3[2]==1)){?>
                                        
                                        <td class="center">
                                            
                                            <?php if($user_role==1 || ($user_role==4 && $right3[1]==1)){?>
                                            <a href="<?php echo base_url('admin/edit_appointment/').$value->ap_id; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <?php }if($user_role==1 || ($user_role==4 && $right3[2]==1)){?>

                                            <a href="javascript:void(0)" onclick="delete_appointment('<?php echo $value->ap_id?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>

                                            <?php }?>
                                        
                                        </td>

                                        <?php }?>

                                    </tr>
                                 <?php $count++; } }?>
                                    
                                    
                                </tbody>
                            </table>
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
        		
               $('#appointment').DataTable();
                function delete_appointment(id) {
                        if (confirm("Are you sure want to delete?")) {
                            $.ajax({
                                url: "<?php echo base_url('admin/delete_appointment')?>",
                                method: "POST",
                                data: {
                                    id: id,
                                },
                                success: function(response) {
                                    window.location.reload();
                                },

                            });
                        }
                        return false;
                    }

                </script>
        	  

