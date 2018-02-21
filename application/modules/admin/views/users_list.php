<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <?php if($role==2){ ?>
            <h1 class="page-header">Doctor List</h1>
            <?php }else{ ?>
            <h1 class="page-header">Patient List</h1>
            <?php   } ?> </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php 
                        $user_role  =   $this->session->userdata('user_role'); 
                        if($user_role==4){
                            $rights     =   explode(',',trim($this->session->userdata('rights')->rights,'"'));   
                            $right0     =   str_split($rights[0]);
                        }
                        if($user_role==1 || ($user_role==4 && $right0[0]==1)){
                    ?>
                    <?php if($role==2){ ?> <a class="btn btn-primary" href="<?php echo base_url('admin/register/null/2')?>"><i class="fa fa-th-list">&nbsp;Add Doctor</i></a>
                    <?php }else{ ?> <a class="btn btn-primary" href="<?php echo base_url('admin/register/null/3')?>"><i class="fa fa-th-list">&nbsp;Add Patient</i></a>
                    <?php } }else{?> <a class="btn btn-primary" href=""><i class="fa fa-th-list">&nbsp;View Subadmin</i></a>
                    <?php }?> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
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
                                            <?php if($user_role==1 || ($user_role==4 && $right0[1]==1 || $right0[2]==1)){?>
                                            <th>Action</th>
                                            <?php }?> </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach($users as $users_list){?>
                                        <tr id="tr_<?php echo $i;?>">
                                            <td>
                                                <?php echo $i; ?> </td>
                                            <td>
                                                <?php echo ucfirst($users_list->first_name);?> </td>
                                            <td>
                                                <?php echo ucfirst($users_list->last_name);?> </td>
                                            <td>
                                                <?php echo $users_list->email;?> </td>
                                            <td>
                                                <?php echo $users_list->mobile;?> </td>
                                            <td>
                                                <?php echo $users_list->gender;?> </td>
                                            <td>
                                                <?php if($users_list->user_role==2){ echo 'Doctor';}elseif($users_list->user_role==3){ echo 'Patient';}elseif($users_list->user_role==4){ echo 'Sub-Admin';}else{echo 'Admin';}?> </td>
                                            <?php if($user_role==1 || ($user_role==4 && $right0[1]==1 || $right0[2]==1)){?>
                                            <td>
                                                <?php if($user_role==1 || ($user_role==4 && $right0[1]==1)){?> <a href="<?php echo base_url('admin/edit_user/'.$users_list->id)?>"><span class="glyphicon glyphicon-edit"></span></a> |
                                                <?php }if($user_role==1 || ($user_role==4 && $right0[2]==1)){?> <a href="javascript:void(0)" onclick="delete_user('<?php echo $users_list->id?>','<?php echo $i;?>')"><span class="glyphicon glyphicon-trash"></span></a>
                                                <?php }?> </td>
                                            <?php }?> </tr>
                                        <?php $i++;}?> </tbody>
                                </table>
                            </div>
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
                    table: 'users'
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