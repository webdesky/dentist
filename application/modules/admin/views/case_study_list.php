<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Case Study</h1>
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
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/case_study')?>"><i class="fa fa-th-list">&nbsp;Add Case Study </i></a> </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="dataTables-example">
                            <thead>
                                <tr class="bg-primary">
                                    <th>Sr. no</th>
                                    <th>Patient</th>
                                    <th>Doctor</th>
                                    <th>Problem</th>
                                    <th>Allergies</th>
                                    <th>Diabetic</th>
                                    <th>Blood Pressure</th>
                                    <th>Medical History</th>
                                    <th>Reference</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $count=1; 
                                if($documents_list){
                                foreach ($documents_list as  $value) {?>
                                <tr class="odd gradeX" id="tr_<?php echo $count;?>">
                                    <td>
                                        <?php echo $count; ?>
                                    </td>
                                    <td>
                                        <?php echo ucwords($value->patient_name); ?>
                                    </td>
                                    <td>
                                        <?php echo ucwords($value->doctor_name); ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->problem; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->allergies; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->diabetic; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->blood_pressure; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->medical_history; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->reference; ?>
                                    </td>
                                    <td class="center"><a href="<?php echo base_url('admin/case_study/'.$value->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <a href="javascript:void(0)" onclick="delete_case_study('<?php echo $value->id?>','<?php echo $count;?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a> </td>
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
    $('#dataTables-example').DataTable({
        responsive: true,
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': [-1] /* 1st one, start by the right */
        }]
    });
    function delete_case_study(id, tr_id) {
        swal({
            title: "Are you sure?",
            text: "you want to delete?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Yes, Delete it!",
            confirmButtonColor: "#ec6c62"
        }, function() {
            $.ajax({
                url: "<?php echo base_url('admin/delete')?>",
                data: {
                    id: id,
                    table: 'case_study'
                },
                type: "POST"
            }).done(function(data) {
                swal("Deleted!", "Record was successfully deleted!", "success");
                $('#tr_' + tr_id).remove();
            });
        });
    }
</script>