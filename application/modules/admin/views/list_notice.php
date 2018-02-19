<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Notice Board </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<!-- row -->


            <div class="row">
                <div class="col-lg-12">
                      <?php if ($info_message = $this->session->flashdata('info_message')): ?>
                        <div id="form-messages" class="alert alert-success" role="alert"><?php echo $info_message; ?></div>
                    <?php endif ?> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Notices List
                        </div>
                        <?php 
                            $user_role      =   $this->session->userdata('user_role'); 
                            if($user_role == 4 ){
                                $rights     =   explode(',',trim($this->session->userdata('rights')->rights,'"'));   
                                $right4     =   str_split($rights[4]);
                            }
                        ?>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                            <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="notice">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>SL.No</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Start Date</th>
                                        <th>End date</th>
                                       <?php if($user_role==1 || ($user_role==4 && $right4[1]==1 || $right4[2]==1)){?>
                                        <th>Action</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $count=1;
                                if($notice_list){
                                foreach ($notice_list as  $value) {
                                 ?>
                                    <tr class="odd gradeX" id="tr_<?php echo $count;?>">
                                          <td><?php echo $count; ?></td>
                                          <td class="center"><?php echo $value['title']; ?></td>
                                          <td class="center"><?php echo $value['description'];  ?></td>
                                          <td class="center"><?php echo $value['start_date'];  ?></td>
                                          <td class="center"><?php echo $value['end_date'];  ?></td>
                                        
                                       
                                        <?php if($user_role==1 || ($user_role==4 && $right4[1]==1 || $right4[2]==1)){?>

                                        <td class="center">
                                            <?php if($user_role==1 || ($user_role==4 && $right4[1]==1)){?>
                                            <a href="<?php echo base_url('admin/notices/').$value['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <?php }if($user_role==1 || ($user_role==4 && $right4[2]==1)){?>

                                            <a href="javascript:void(0)" onclick="delete_notices('<?php echo $value['id']?>','<?php echo $count;?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>

                                            <?php }?>
                                        
                                        </td>

                                    <?php }?>

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
    
    $('#notice').DataTable({
        responsive: true
    });

    function delete_notices(id, tr_id) {
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
                    table: 'notices'
                },
                type: "POST"
            }).done(function(data) {
                swal("Deleted!", "Record was successfully deleted!", "success");
                $('#tr_'+tr_id).remove();
            }).error(function(data) {
                swal("Oops", "We couldn't connect to the server!", "error");
            });
        });
    }
</script>     
