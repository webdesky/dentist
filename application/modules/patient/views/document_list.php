<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Documents list</h1>
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
                    <a class="btn btn-primary" href="<?php echo base_url('patient/add_document')?>"><i class="fa fa-th-list">&nbsp;Add Document</i></a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr class="bg-primary">
                                    <th>Sr.No</th>
                                    <th>Doctor Name</th>
                                    <th>Description</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if($documents_list){
                                    $count=1;
                                foreach ($documents_list as  $value) { ?>
                                <tr class="odd gradeX">
                                    <td>
                                        <?php echo $count; ?>
                                    </td>
                                    <td>
                                        <?php echo ucwords($value->first_name.' '.$value->last_name); ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->description; ?>
                                    </td>
                                    <td class="center"><img src="<?php echo base_url('asset/uploads/'.$value->file); ?>" width='50px' height='50px'></td>
                                    <td class="center"><a href="<?php echo base_url('patient/edit_document/'.$value->did); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href="javascript:void(0)" onclick="delete_doc('<?php echo $value->did?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        <!-- <i class="fa fa fa-plus" aria-hidden="true" onclick="updateStatus(<?php echo $value->doctor_id; ?>,<?php echo $value->doctor_status; ?>)"></i> -->
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
    $('#dataTables-example').DataTable();
});


function delete_doc(id) {
    if (confirm("Are you sure want to delete?")) {
        $.ajax({
            url: "<?php echo base_url('admin/delete')?>",
            method: "POST",
            data: {
                id: id,
                table: 'documents'
            },
            success: function(response) {
                window.location.reload();
            },

        });
    }
    return false;
}
</script>