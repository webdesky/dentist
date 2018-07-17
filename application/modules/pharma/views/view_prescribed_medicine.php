<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Prescribed Medicine</h1>
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
                    <button class="btn btn-primary"><i class="fa fa-th-list">&nbsp; Prescribed Medicine</i></button>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="notice">
                            <thead>
                                <tr class="bg-primary">
                                    <th>S.No</th>
                                    <th>Appointment Code</th>
                                    <th>Notes</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $count = 1;
                                    if($billing){
                                        foreach ($billing as $value) {
                                           
                                ?>
                                <tr class="odd gradeX" id="tr_<?php echo $count?>">
                                    <td>
                                        <?php echo $count; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->appointment_id;?>
                                    </td>

                                    <td class="center">
                                        <?php echo $value->patient_note;  ?>
                                    </td>
                                    <td class="center">
                                        <?php if($value->pharma_status==0){ ?>
                                        <button class="btn btn-primary">Active</button>
                                        <?php } else{ ?>
                                        <button class="btn btn-danger">Inactive</button>
                                        <?php } ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->created_at;  ?>
                                    </td>
                                    <td class="center">
                                        <a href="<?php echo base_url('pharma/view_medicine_category/'.$value->id); ?>" title="View">View</a> | 
                                        <a href="javascript:void(0)" title="Change Status" onclick="change_status('<?php echo $value->id;?>')">Change Status</a>
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


function change_status(id, tr_id) {
    swal({
        title: "Are you sure?",
        text: "Are you sure that you want to Change Status?",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Yes, Change it!",
        confirmButtonColor: "#ec6c62"
    }, function() {
        $.ajax({
            url: "<?php echo base_url('pharma/update_status')?>",
            data: {
                id: id,
                table: 'prescription'
            },
            type: "POST"
        }).done(function(data) {
            swal("Updated!", "Record was successfully Updated!", "success");
           // $('#tr_' + tr_id).remove();
        });
    });
}
</script>