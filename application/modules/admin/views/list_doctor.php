
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Doctor </h1>
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
                            Doctor List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>SL.No</th>
                                        <th>Picture</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email Address</th>
                                        <th>Mobile No</th>
                                        <th>Phone No</th>
                                        <th>Address</th>
                                        <th>Sex</th>
                                        <th>Blood Group</th>
                                        <th>Date Of Birth</th>
                                        <th>Status</th>
                                        <th>User Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
 								$count=1;
<<<<<<< HEAD
=======
                                if($doctorList){
>>>>>>> 0786823f878c3f8c24f632c1152420691182d40e
                                foreach ($doctorList as  $value) { ?>
                                	<tr class="odd gradeX">
                                        <td><?php echo $count; ?></td>
                                        <td><img src="<?php echo base_url($value->doctor_image) ?>" style="max-width: 80px; max-height: 80px;"></td>
                                        <td><?php echo $value->doctor_fname; ?></td>
                                        <td class="center"><?php echo $value->doctor_lname; ?></td>
                                        <td class="center"><?php echo $value->doctor_email; ?></td>
                                        <td class="center"><?php echo $value->doctor_mobile_no; ?></td>
                                        <td class="center"><?php echo $value->doctor_phone_no; ?></td>
                                        <td class="center"><?php echo $value->doctor_address; ?></td>
                                        <td class="center"><?php echo $value->doctor_gender; ?></td>
                                        <td class="center"><?php echo $value->doctor_bg; ?></td>
                                        <td class="center"><?php echo $value->doctor_dob; ?></td>
                                        <td class="center" id="status">

<<<<<<< HEAD
                                        	<?php if($value->is_active=='1'){ ?>
=======
                                        	<?php if($value->doctor_status=='1'){ ?>
>>>>>>> 0786823f878c3f8c24f632c1152420691182d40e
                                        		<button class="btn btn-primary">Active</button>
                                       		 <?php } else{ ?>
                                        	<button class="btn btn-danger" >Inactive</button>

                                        	<?php } ?>
                                    	</td>
                                       
                                        <td class="center"><?php echo $value->role_name; ?></td>
                                        <td class="center"><a href="<?php echo base_url('admin/edit_doctor/').$value->doctor_id; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<<<<<<< HEAD
                                        <a href="<?php echo base_url('admin/edit_doctor/').$value->doctor_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        <i class="fa fa fa-plus" aria-hidden="true" onclick="updateStatus(<?php echo $value->doctor_id; ?>,<?php echo $value->is_active; ?>)"></i>
                                        </td>

                                    </tr>
                                 <?php $count++; } ?>
=======
                                        <a href="javascript:void(0)" onclick="delete_user('<?php echo $value->doctor_id?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        <i class="fa fa fa-plus" aria-hidden="true" onclick="updateStatus(<?php echo $value->doctor_id; ?>,<?php echo $value->doctor_status; ?>)"></i>
                                        </td>

                                    </tr>
                                 <?php $count++; } }?>
>>>>>>> 0786823f878c3f8c24f632c1152420691182d40e
                                    
                                    
                                </tbody>
                            </table>
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
        		function updateStatus($id,$status){
        			
				       	var url='admin/updateStatus';
				       	var id =$id;
				       	var status=$status
				        $.ajax({
				        	url: url, 
				        	type: "POST",
  							data: {id : id,status :status},
				        	success: function(result){
				            	window.location.reload();

				        }});
				   

        	  	}
<<<<<<< HEAD
=======

                function delete_user(id) {
                        if (confirm("Are you sure want to delete?")) {
                            $.ajax({
                                url: "<?php echo base_url('admin/delete_doctor')?>",
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
>>>>>>> 0786823f878c3f8c24f632c1152420691182d40e
        	  
        </script>