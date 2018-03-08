<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Prescription</h1>
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
                    <a class="btn btn-primary" href="<?php echo base_url('doctor/add_prescription')?>"><i class="fa fa-list"></i>  Add Prescription </a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="dataTables-example">
                            <thead>
                                <tr class="bg-primary">
                                    <th>SL.No</th>
                                    <th>Patient Id</th>
                                    <th>Patient Name</th>
                                    <th>Appointment Id</th>
                                    <th>Type</th>
                                    <th>Visiting Fee</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $count=1;
                                if($prescription_list){
                                foreach ($prescription_list as  $value) { ?>
                                <tr class="odd gradeX" id="tr_<?php echo $count?>">
                                    <td>
                                        <?php echo $count; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->patient_id; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo ucwords($value->first_name.' '. $value->last_name); ?>
                                    </td>
                                    <td>
                                        <?php echo $value->patient_id; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->type; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->visiting_fee; ?>
                                    </td>
                                    <td class="center">
                                        <a href="<?php echo base_url('doctor/view_prescription/'.$value->id);?>"><i class="fa fa-eye"></i></a> |
                                        <a href="<?php echo base_url('doctor/edit_prescription/'.$value->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                        <a href="javascript:void(0)" onclick="delete_prescription('<?php echo $value->id?>','<?php echo $count?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        <?php if(isset($value->review_id)){ ?> |
                                        <a href="<?php echo base_url('doctor/view_review/'.$value->id); ?>"><i class="fa fa-comments" aria-hidden="true"></i></a>
                                        <?php } ?>
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
$('#dataTables-example').DataTable({
    responsive: true
});

function delete_prescription(id, tr_id) {
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
            url: "<?php echo base_url('doctor/delete_prescription')?>",
            data: {
                id: id,
            },
            type: "POST"
        }).done(function(data) {
            swal("Deleted!", "Record was successfully deleted!", "success");
            $('#tr_' + tr_id).remove();
        });
    });
}
</script>