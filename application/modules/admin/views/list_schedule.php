
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Schedule </h1>
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
                            Schedule List
                        </div>
                    <?php 
                        $user_role  =   $this->session->userdata('user_role'); 
                        if($user_role==4){
                            $rights     =   explode(',',trim($this->session->userdata('rights')->rights,'"'));   
                            $right2     =   str_split($rights[2]);
                        }
                    ?>

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="schedule">
                                <thead>
                                    <tr>
                                        <th>SL.No</th>
                                        <th>Doctor Name</th>
                                        <th>Days Available</th>
                                        <?php if($user_role==1 || ($user_role==4 && $right2[1]==1 || $right2[2]==1)){?>
                                        <th>Action</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
     								$count=1;
                                    if(!empty($scheduleList)){
                                    foreach ($scheduleList as  $value) {

                                        $days       =   $value->Days;
                                        $data       =   explode(",",$days);
                                        $sortedDays =   array_unique($data);
                                        $day        =   implode(",",$sortedDays);
                                        
                                     ?>
                                	<tr class="odd gradeX">
                                        <td><?php echo $count; ?></td>
                                        
                                        
                                        <td class="center"><?php echo $value->first_name; ?></td>
                                       
                                         
                                         <td class="center"><?php echo $day ?></td>
                                       
                                        
                                       
                                        <?php if($user_role==1 || ($user_role==4 && $right2[1]==1 || $right2[2]==1)){?>

                                        <td class="center">

                                        <?php if($user_role==1 || ($user_role==4 && $right2[1]==1)){?>

                                            <a href="<?php echo base_url('admin/edit_schedule/').$value->doctor_id; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        
                                        <?php }  if($user_role==1 || ($user_role==4 && $right2[2]==1)){?>

                                            <a href="javascript:void(0)" onclick="delete_schedule('<?php echo $value->doctor_id?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>

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
        		$('#schedule').DataTable();

                function delete_schedule(id) {
                        if (confirm("Are you sure want to delete?")) {
                            $.ajax({
                                url: "<?php echo base_url('admin/delete_schedule')?>",
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
        	  
