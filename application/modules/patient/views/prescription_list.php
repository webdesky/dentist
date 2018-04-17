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
                    <i class="fa fa-th-list">&nbsp;Prescription List</i>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
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
                                <tr class="odd gradeX">
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
                                        <?php echo $value->appointment_id; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->type; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->visiting_fee; ?>
                                    </td>
                                    <td class="center">
                                        <a href="<?php echo base_url('patient/view_prescription/'.$value->id);?>"><i class="fa fa-eye"></i></a>
                                        <?php if($review==''){ ?>
                                        <a href="<?php echo base_url('patient/review_doctor/'.$value->doctor_id.'/'.$value->id);?>"><i class="fa fa-comments"></i></a>
                                        <?php } ?>
                                        <!--  <a href="<?php echo base_url('doctor/edit_prescription/'.$value->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                                    | 
                                    <a href="javascript:void(0)" onclick="delete_prescription('<?php echo $value->id?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>  -->
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
$('#dataTables-example').DataTable();

function delete_prescription(id) {
    if (confirm("Are you sure want to delete?")) {
        $.ajax({
            url: "<?php echo base_url('doctor/delete_prescription')?>",
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