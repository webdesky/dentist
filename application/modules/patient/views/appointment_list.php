    
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-9">
                    <h1 class="page-header">Appointment </h1>
                </div>
                <!-- <div class="col-lg-3">
                    <button class="page-header btn btn-primary"><i class="fa fa-th-list">&nbsp;Csv </i></button>
                    <button class="page-header btn btn-primary"><i class="fa fa-th-list">&nbsp;Excel</i></button>
                    <button class="page-header btn btn-primary"><i class="fa fa-th-list">&nbsp;PDF </i></button>
                    <button class="page-header btn btn-primary"><i class="fa fa-th-list">&nbsp;Print </i></button>
                </div> -->
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
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>SL.No</th>
                                        <th>Appointment Id</th>
                                        <th>Doctor Name</th>
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
                                            <td><?php echo $count; ?></td>
                                            
                                            <td><?php echo $value->appointment_id; ?></td>
                                            
                                            <td class="center"><?php echo $value->first_name." ".$value->last_name; ?></td>
                                            <td class="center"><?php echo $value->problem; ?></td>
                                            <td class="center"><?php echo date('d/m/Y',strtotime($value->appointment_date))." ".date('h:i:A',strtotime($value->appointment_time)); ?></td>
                                            <td><?php
                                                if($value->is_active==0){  ?>

                                                <button class="btn btn-danger">Pending</button>

                                               <?php  }else{ ?>
                                               <button class="btn btn-success">Approved</button>


                                             <?php  }
                                             ?></td>
                                            <td class="center"><a href="<?php echo base_url('patient/view_appointment/').$value->ap_id; ?>"><i class="fa fa-eye"></i></a>
                                            </td>

                                        </tr>
                                    <?php 
                                    $count++; 
                                    } 
                                }
                                else
                                {
                                    ?>
                                    <tr class="odd gradeX" ><td colspan="7">No Record Found</td></tr>
                                    <?php
                                }
                                ?>
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

    $('#dataTables-example').DataTable({
        responsive: true
    });

		function updateStatus(id,status){
            swal({
                title: "Are you sure?",
                text: "Are you sure that you want to Update Status?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonText: "Yes, Update it!",
                confirmButtonColor: "#ec6c62"
            }, function() {
                $.ajax({
                    url: "<?php echo base_url('admin/updateStatus')?>",
                    data: {
                        id : id,
                        status :status
                    },
                    type: "POST"
                }).done(function(data) {
                    swal("Deleted!", "Record was successfully deleted!", "success");
                    $('#tr_' + tr_id).remove();
                });
            });		   

	  	}
	  
</script>