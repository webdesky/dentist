<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <h1 class="page-header">User List</h1>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/add_user')?>"><i class="fa fa-th-list">&nbsp;Add User</i></a>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="users">
                                <thead>
                                  <tr class="bg-primary">
                                    <th>Sr no.</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Gender</th>
                                    <th>User Role</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach($users as $users_list){?>
                                  <tr id="tr_<?php echo $i?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $users_list->first_name;?></td>
                                    <td><?php echo $users_list->last_name;?></td>
                                    <td><?php echo $users_list->email;?></td>
                                    <td><?php echo $users_list->mobile;?></td>
                                    <td><?php echo $users_list->gender;?></td>
                                    <td><?php if($users_list->user_role==2){ echo 'Doctor';}elseif($users_list->user_role==3){ echo 'Patient';}elseif($users_list->user_role==4){ echo 'Sub-Admin';}else{echo 'Admin';}?></td>
                                    <td><a href="<?php echo base_url('admin/assign_rights/'.$users_list->id)?>"><span class="glyphicon glyphicon-edit"></span></a> <!-- | <a href="javascript:void(0)" onclick="delete_user('<?php echo $users_list->id?>')"><span class="glyphicon glyphicon-trash"></span></a> --></td>
                                  </tr>
                                  <?php $i++;}?>
                                </tbody>
                              </table>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->

</div>
</div>

<script type="text/javascript">
    $('#users').DataTable({
        responsive: true
    });
    
    function delete_user(id) {
         swal({
            title: "Are you sure?",
            text: "want to delete?",
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
                    table: 'user'
                },
                type: "POST"
            }).done(function(data) {
                swal("Deleted!", "Record was successfully deleted!", "success");
                $('#tr_' + tr_id).remove();
            });
        });

    }

</script>
