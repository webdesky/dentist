<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Hospitals List </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?> </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/hospitals')?>"><i class="fa fa-th-list">&nbsp;Add Hospitals</i></a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" cellspacing="0" width="100%"  id="notice">
                            <thead>
                                <tr class="bg-primary">
                                    <th>Sr. no</th>
                                    <th>Name</th>
                                    <th>Registration</th>
                                    <th>Owner</th>
                                    <!-- <th>City</th> -->
                                    <th>Address</th>
                                    <th>Staff</th>
                                    <th>Doctors</th>
                                    <th>Speciality</th>
                                    <th>Ambulance</th>
                                    <th>Blood Bank</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count=1; if($hospitals_list){  foreach ($hospitals_list as  $value) {?>
                                <tr class="odd gradeX" id="tr_<?php echo $count;?>">
                                    <td>
                                        <?php echo $count; ?> </td>
                                    <td class="center">
                                        <?php echo ucwords($value['hospital_name']); ?> </td>
                                    <td class="center">
                                        <?php echo $value['registration_number']; ?> </td>
                                    <td class="center">
                                        <?php echo ucwords($value['owner_name']); ?> </td>
                                    <td class="center">
                                        <?php echo ucwords($value['address']);  ?> </td>
                                    <td class="center">
                                        <?php echo $value['staff_number'];  ?> </td>
                                    <td class="center">
                                        <?php echo $value['no_of_doc'];  ?> </td>
                                    <td class="center">
                                        <?php echo $value['speciality'];  ?> </td>
                                    <td class="center">
                                        <?php echo $value['no_of_ambulance'];  ?> </td>
                                    <td class="center">
                                        <?php if($value['blood_bank']==1){ echo 'Yes';}else{ echo 'No';}  ?> </td>
                                    <td class="center">
                                        <?php echo date('Y-m-d',strtotime($value['created_at']));  ?> </td>
                                    <td class="center">
                                        <a href="<?php echo base_url('admin/hospitals/'.$value['id']) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href="javascript:void(0)" onclick="delete_hospital('<?php echo $value['id']?>','<?php echo $count;?>')"><i class="fa fa-trash-o" aria-hidden="true" title="delete"></i></a>
                                    </td>
                                </tr>
                                <?php $count++; }}?> </tbody>
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
    
    $('#notice').DataTable({
        responsive: true,
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': [-1] /* 1st one, start by the right */
        }]
    });


    function delete_hospital(id, tr_id) {
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
                    table: 'hospitals'
                },
                type: "POST",
                success: function () {
                    swal("Done!", "It was succesfully deleted!", "success");
                    $('#tr_' + tr_id).remove();
                    delete_hospital_from_users(id);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error deleting!", "Please try again", "error");
                }
            });
        });
    }

    function delete_hospital_from_users(id) {
        $.ajax({
            url: "<?php echo base_url('admin/delete_hospital_from_user')?>",
            data: {
                id: id,
                table: 'users'
            },
            type: "POST",
            success: function(response) {
            },
            error: function() {
                alert("error");
            }
        });
    }
</script>