<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Schedule </h1>
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
                <div class="panel-heading"> Schedule List </div>
              
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="schedule">
                            <thead>
                                <tr class="bg-primary">
                                    <th>SL.No</th>
                                    <th>Doctor Name</th>
                                    <th>Days Available</th>
                                    
                                    <th>Action</th>
                                  
                            </thead>
                            <tbody>
                                <?php 
                                    $count=1;
                                    if(!empty($scheduleList)){
                                    foreach ($scheduleList as  $value) {

                                        $days       =   $value->Days;
                                        $data       =   explode(",",$days);
                                        $sortedDays =   array_unique($data);
                                        $day        =   implode(",",$sortedDays);
                                        
                                     ?>
                                <tr class="odd gradeX" id="tr_<?php echo $count; ?>">
                                    <td>
                                        <?php echo $count; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->first_name; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $day ?>
                                    </td>
                                    <td class="center">
                                       <a href="<?php echo base_url('doctor/edit_schedule/').$value->doctor_id; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                       | <a href="javascript:void(0)" onclick="delete_schedule('<?php echo $value->doctor_id?>','<?php echo $count;?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                         </td>
                                  </tr>
                                <?php $count++; } }?> </tbody>
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
    $('#schedule').DataTable({
        responsive: true
    });

function delete_schedule(id, tr_id) {
    swal({
        title: "Are you sure?",
        text: "Are you sure that you want to delete?",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Yes, Delete it!",
        confirmButtonColor: "#ec6c62"
    }, function() {
        $.ajax({
            url: "<?php echo base_url('doctor/delete_schedule')?>",
            data: {
                id: id,
            },
            type: "POST"
        }).done(function(data) {
            swal("Deleted!", "Record was successfully deleted!", "success");
            $('#tr_' + tr_id).remove();
        }).error(function(data) {
            swal("Oops", "We couldn't connect to the server!", "error");
        });
    });
}
</script>