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
                    <?php 
                        $user_role  =   $this->session->userdata('user_role'); 
                        if($user_role==4){
                            $rights     =   explode(',',trim($this->session->userdata('rights')->rights,'"'));   
                            $right0     =   str_split($rights[0]);
                        }
                        if($user_role==1 || ($user_role==4 && $right0[0]==1)){
                    ?>
                    <a class="btn btn-primary" href="<?php echo base_url('admin/register/null/4')?>"><i class="fa fa-th-list">&nbsp;Add Subadmin</i></a>

                    <?php }else{?>
                    
                    <a class="btn btn-primary" href=""><i class="fa fa-th-list">&nbsp;View Subadmin</i></a>
                    
                    <?php }?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered" id="users">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Gender</th>
                                        <th>User Role</th>
                                        <?php if($user_role==1 || ($user_role==4 && $right0[1]==1 || $right0[2]==1)){?>
                                        <th>Action</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($users as $users_list){?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <?php echo $users_list->first_name;?>
                                        </td>
                                        <td>
                                            <?php echo $users_list->last_name;?>
                                        </td>
                                        <td>
                                            <?php echo $users_list->email;?>
                                        </td>
                                        <td>
                                            <?php echo $users_list->mobile;?>
                                        </td>
                                        <td>
                                            <?php echo $users_list->gender;?>
                                        </td>

                                        <td>
                                            <?php if($users_list->user_role==2){ echo 'Doctor';}elseif($users_list->user_role==3){ echo 'Patient';}elseif($users_list->user_role==4){ echo 'Sub-Admin';}else{echo 'Admin';}?>
                                        </td>
                                        <?php if($user_role==1 || ($user_role==4 && $right0[1]==1 || $right0[2]==1)){?>
                                        <td>
                                            <?php if($user_role==1 || ($user_role==4 && $right0[1]==1)){?>
                                                
                                                <a href="<?php echo base_url('admin/edit_user/'.$users_list->id)?>"><span class="glyphicon glyphicon-edit"></span></a> |
                                            
                                            <?php }if($user_role==1 || ($user_role==4 && $right0[2]==1)){?> 
                                                
                                                <a href="javascript:void(0)" onclick="delete_user('<?php echo $users_list->id?>')"><span class="glyphicon glyphicon-trash"></span></a>

                                            <?php }?>
                                        </td>
                                        <?php }?>
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
    $('#users').DataTable();

    function delete_user(id) {
        if (confirm("Are you sure want to delete?")) {
            $.ajax({
                url: "<?php echo base_url('admin/delete')?>",
                method: "POST",
                data: {
                    id: id,
                    table: 'user'
                },
                success: function(response) {
                    window.location.reload();
                },

            });
        }
        return false;
    }
</script>