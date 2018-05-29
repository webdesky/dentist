<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <?php if($role==2){ ?>
            <h1 class="page-header">Doctor List</h1>
            <?php }elseif($role==3){ ?>
            <h1 class="page-header">Patient List</h1>
            <?php }else{ ?>
            <h1 class="page-header">Sub Admin List</h1>
            <?php } ?>
        </div>
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
                    <?php if($role==2){ ?> <a class="btn btn-primary" href="<?php echo base_url('admin/add_doctor')?>"><i class="fa fa-th-list">&nbsp;Add Doctor</i></a>
                    <?php }elseif($role==3){ ?> <a class="btn btn-primary" href="<?php echo base_url('admin/register/null/3')?>"><i class="fa fa-th-list">&nbsp;Add Patient</i></a>
                    <?php } else{?> <a class="btn btn-primary" href="<?php echo base_url('admin/register/null/4')?>"><i class="fa fa-th-list">&nbsp;Add Subadmin</i></a>
                    <?php }}    ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="users">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Sr no.</th>
                                            <?php if($role!=4){?>
                                            <th>Name</th>
                                            <?php }if($user_role==4 && $role==2){?>
                                            <th>Speciality</th>
                                            <?php }?>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <?php if($role!=4){?>
                                            <th>Gender</th>
                                            <?php }?>
                                            <th>User Role</th>
                                            <?php if($user_role==1 || ($user_role==4 && $right0[1]==1 || $right0[2]==1)){?>
                                            <th>Action</th>
                                            <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  $i=1;if(!empty($users)){ foreach($users as $users_list){?>
                                        <tr id="tr_<?php echo $i;?>">
                                            <td>
                                                <?php echo $i; ?>
                                            </td>
                                            <?php if($role!=4){?>
                                            <td>
                                                <?php echo ucfirst($users_list->user_name);?>
                                            </td>
                                            <?php }if($user_role==4 && $role==2){?>
                                            <td>
                                                <?php echo ucfirst($users_list->speciality_name);?>
                                            </td>
                                            <?php }?>
                                            <td>
                                                <?php echo $users_list->email;?>
                                            </td>
                                            <td>
                                                <?php echo $users_list->mobile;?>
                                            </td>
                                            <?php if($role!=4){?>
                                            <td>
                                                <?php echo ucfirst($users_list->gender);?>
                                            </td>
                                            <?php }?>
                                            <td>
                                                <?php if($users_list->user_role==2){ echo 'Doctor';}elseif($users_list->user_role==3){ echo 'Patient';}elseif($users_list->user_role==4){ echo 'Sub-Admin';}else{echo 'Admin';}?>
                                            </td>
                                            <?php if($user_role==1 || ($user_role==4 && $right0[1]==1 || $right0[2]==1)){?>
                                            <td>
                                                <?php if($user_role==1 || ($user_role==4 && $right0[1]==1)){?> <a href="<?php echo base_url('admin/edit_user/'.$users_list->id)?>" title="Edit"><span class="glyphicon glyphicon-edit"></span></a> |
                                                <?php }if($user_role==1 || ($user_role==4 && $right0[2]==1)){?> <a href="javascript:void(0)" onclick="delete_user('<?php echo $users_list->id?>','<?php echo $i;?>')" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                                                <?php }?>
                                            </td>
                                            <?php }?>
                                        </tr>
                                        <?php $i++;}}?>
                                    </tbody>
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
        responsive: true,
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': [-1] /* 1st one, start by the right */
        }]
    });

    function delete_user(id, tr_id) {
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
                type: "POST",
                success: function() {
                    swal("Done!", "It was succesfully deleted!", "success");
                    $('#tr_' + tr_id).remove();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    swal("Error deleting!", "Please try again", "error");
                }
            });
        });
    }
</script>