

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Doctor</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>


             <!-- /.row -->
            <div class="row">
                
                <div class="col-lg-12">
                    <?php if(validation_errors()){?>
                            <div class="alert alert-danger">
                                <strong>Danger!</strong>
                                <?php echo validation_errors(); ?>
                            </div>
                            <?php }if(!empty($msg)){?>
                            <div class="alert alert-success">
                                <?php echo $msg;?>
                            </div>
                            <?php }?>

                     <?php if ($info_message = $this->session->flashdata('info_message')): ?>
                        <div id="form-messages" class="alert alert-success" role="alert"><?php echo $info_message; ?></div>
                 <?php endif ?> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button class="btn btn-primary"><i class="fa fa-th-list">&nbsp;Doctors List</i></button>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-2">
                                    <form role="form" method="post" action="<?php echo base_url('admin/insertDoctor') ?>" class="registration_form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>First Name *</label>
                                            <input class="form-control" type="text" id="doctor_fname" placeholder="First Name" name="doctor_fname" >
                                            <span><?php echo form_error('doctor_fname'); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name *</label>
                                            <input class="form-control" type="text" id="doctor_lname" name="doctor_lname" placeholder="Last Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address *</label>
                                            <input type="text" name="doctor_email" id="doctor_email" class="form-control"  placeholder="Email Addres">
                                        </div>
                                        <div class="form-group">
                                            <label>Password *</label>
                                            <input type="Password" class="form-control" id="doctor_password" name="doctor_password">
                                        </div>

                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input type="text" class="form-control"  id="doctor_designation"  name="doctor_designation">
                                        </div>
                                        <div class="form-group">
                                            <label>Address *</label>
                                            <textarea class="form-control" rows="5" id="doctor_address" name="doctor_address" placeholder="Address"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Phone No</label>
                                            <input type="text" class="form-control" id="doctor_phone_no"  name="doctor_phone_no"  placeholder="phone number">
                                        </div>

                                        <div class="form-group">
                                            <label>Mobile No</label>
                                            <input type="text" class="form-control"  id="doctor_mobile_no" name="doctor_mobile_no"  placeholder="mobile number">
                                        </div>

                                        <div class="form-group">
                                            <label>Picture</label>
                                            <input type="file"  name="doctor_image" id="doctor_image" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Short Biography</label>
                                            <textarea id="summernote" class="form-control" id="doctor_biography" name="doctor_biography"></textarea>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label>Specialist</label>
                                            <input type="text" class="form-control" id="doctor_specialist" name="doctor_specialist" placeholder="Specialist">
                                        </div>

                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                        <input type="Date" id="datepicker" id="doctor_dob" name="doctor_dob" class="form-control">
                                        </div>

                                     
                                        <div class="form-group">
                                            <label>Sex *</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="doctor_gender"  value="male" checked>Male
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="doctor_gender"  value="female">Female
                                            </label>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Blooad Group</label>
                                            <select class="form-control" id="doctor_bg name="doctor_bg">
                                                <option value="A+">A+</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B-">B-</option>
                                                <option value="O+">O+</option>
                                                <option value="O-">O-</option>
                                                 <option value="AB+">AB+</option>
                                                 <option value="AB-">AB-</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Education/Degree</label>
                                            <textarea id="education" class="form-control" id="doctor_qualification" name="doctor_qualification"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Status</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="doctor_status"  value="1" checked>Active
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="doctor_status"  value="0">Inactive
                                            </label>
                                            
                                        </div>
                                        
                                        <button type="submit" name="submit" class="btn btn-success">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
                                    </form>
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
 <script>tinymce.init({ selector:'textarea#summernote' });</script>
 <script>tinymce.init({ selector:'textarea#education' });</script>

      

          <script type="text/javascript" src="<?php echo base_url("asset/js/jquery.js");?>"></script> 
          <script type="text/javascript" src="<?php echo base_url("asset/js/validation.js");?>"></script>
        <script type="text/javascript">
        $(document).ready(function(){
            $(".registration_form").validate({
                rules :{
                    "fname" :"required",
                    
                    
                },
            submitHandler : function(form) {
                form.submit();
            }
            });

        });

        </script>