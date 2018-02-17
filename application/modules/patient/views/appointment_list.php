<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-9">
                    <h1 class="page-header">Appointment </h1>
                </div>
              <!--   <div class="col-lg-3">
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
                            <table width="100%" class="table table-striped table-bordered table-hover" id="appointmentList">
                                <thead>
                                    <tr>
                                        <th>SL.No</th>
                                        <th>Appointment Id</th>
                                        <th>Type</th>
                                        <th>Doctor Name</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
 								$count=1;
                                if(!empty($appointmentList))
                                {
                                    foreach ($appointmentList as  $value) 
                                    { ?>
                                    	<tr class="odd gradeX">
                                            <td><?php echo $count; ?></td>
                                            
                                            <td><?php echo $value->appointment_id; ?></td>
                                            <td class="center"><?php echo $value->problem; ?></td>
                                            <td class="center"><?php echo $value->first_name." ".$value->last_name; ?></td>
                                           
                                            <td class="center"><?php echo date('d/m/Y',strtotime($value->appointment_date))." ".date('h:i:A',strtotime($value->appointment_time)); ?></td>
                                            <td class="center"><a href="<?php echo base_url('patient/view_appointment/').$value->ap_id; ?>">View</a>
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


<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

<script type="text/javascript">
        
function updateStatus($id, $status) {
    var url = 'admin/updateStatus';
    var id = $id;
    var status = $status
    $.ajax({
        url: url,
        type: "POST",
        data: {
            id: id,
            status: status
        },
        success: function(result) {
            window.location.reload();
        }
    });
}
$('#appointmentList').DataTable({
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
});
	  
</script>