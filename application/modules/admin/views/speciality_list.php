<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Speciality </h1>
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
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/speciality')?>"><i class="fa fa-th-list">&nbsp;Add Speciality </i></a> </div>
                <?php 
                    $user_role  =   $this->session->userdata('user_role'); 
                    if($user_role==4)
                    {
                        $rights     =   explode(',',trim($this->session->userdata('rights')->rights,'"'));   
                        $right3     =   str_split($rights[3]);
                    }
                ?>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="appointment">
                            <thead>
                                <tr class="bg-primary">
                                    <th>Sr. no</th>
                                    <th>Speciality</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    <?php //if($user_role==1||($user_role==4 && $right3[1]==1||$right3[2]==1)){?>
                                    <th>Action</th>
                                    <?php //}?> </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $count=1;
                                if($speciality){
                                foreach ($speciality as  $value) { ?>
                                <tr class="odd gradeX" id="tr_<?php echo $count;?>">
                                    <td>
                                        <?php echo $count; ?>
                                    </td>
                                    <td>
                                        <?php  echo $value['name'];?>
                                    </td>
                                    <td>
                                        <?php echo $value['details']; ?>
                                    </td>
                                    <td>
                                        <?php  if($value['is_active']==0){ echo 'Inactive';}else{ echo 'Active';}?>
                                    </td>

                                    <?php if($user_role==1 || ($user_role==4 && $right3[1]==1 || $right3[2]==1)){?>
                                    <td class="center">
                                        <?php if($user_role==1 || ($user_role==4 && $right3[1]==1)){?> <a href="<?php echo base_url('admin/speciality/').$value['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <?php }if($user_role==1 || ($user_role==4 && $right3[2]==1)){?> <a href="javascript:void(0)" onclick="delete_speciality('<?php echo $value['id'];?>','<?php echo $count;?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        <?php }?> </td>
                                    <?php }?> </tr>
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
$('#appointment').DataTable({
        responsive: true
    });

function delete_speciality(id,tr_id) {
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
                table:'speciality'
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

// function updateStatus(id, active) {
//     if (active == 0) {
//         data = 1;
//     } else {
//         data = 0;
//     }
//     swal({
//         title: "Are you sure?",
//         text: "You want to Change Status?",
//         type: "warning",
//         showCancelButton: true,
//         closeOnConfirm: false,
//         confirmButtonText: "Yes, Change it!",
//         confirmButtonColor: "#ec6c62"
//     }, function() {
//         $.ajax({
//             url: "<?php //secho base_url('admin/update_status')?>",
//             data: {
//                 id: id,
//                 active: data,
//             },
//             type: "POST"
//         }).done(function(data) {
//             swal("Changed!", "Status was successfully changed!", "success");
//              window.location.reload();
//         });
//     });
// }
</script>