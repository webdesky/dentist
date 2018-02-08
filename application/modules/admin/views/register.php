<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <h1 class="page-header">User Section</h1>

        </div>
        <!-- /.col-lg-12 -->
    </div>

<style type="text/css">
    .red{
        color: red;
    }
</style>

    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/users_list')?>"><i class="fa fa-th-list">&nbsp;Users List</i></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-2">
                            <form role="form" method="post"  action="<?php echo base_url('admin/register') ?>" class="registration_form" enctype="multipart/form-data">
                                    

                                <div class="form-group">
                                    <label>User Name *</label>
                                    <input type="hidden" name="user_role" value="<?php echo $user_role; ?>">
                                    <input class="form-control" type="text" placeholder="User Name" name="user_name" autocomplete="off"   value="<?php echo set_value('user_name');?>" >
                                    <span class="red"><?php echo form_error('user_name'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>First Name *</label>
                                    <input type="hidden" name="user_role" value="<?php echo $user_role; ?>">
                                    <input class="form-control" type="text" placeholder="First Name" name="first_name" id="first_name"  autocomplete="off"  value="<?php echo set_value('first_name');?>" >
                                    <span class="red"><?php echo form_error('first_name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Last Name *</label>
                                    <input class="form-control" type="text" name="last_name" placeholder="Last Name"  autocomplete="off"  value="<?php echo set_value('last_name'); ?>">
                                    <span class="red"><?php echo form_error('last_name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Email Address *</label>
                                    <input type="text" name="email" class="form-control" placeholder="Email Address" autocomplete="off"  value="<?php echo set_value('email'); ?>">
                                    <span class="red"><?php echo form_error('email'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Password *</label>
                                    <input type="Password" class="form-control" id="password" name="password" placeholder="Password" >
                                    <span class="red"><?php echo form_error('password'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Address *</label>
                                    <textarea class="form-control" rows="5" name="address" placeholder="Address"><?php echo set_value('address');?></textarea>
                                    <span class="red"><?php echo form_error('address'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Phone No</label>
                                    <input type="text" class="form-control" name="phone_no" placeholder="phone number" autocomplete="off">
                                    <span class="red"><?php echo form_error('phone_no'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Mobile No</label>
                                    <input type="text" class="form-control" name="mobile_no" placeholder="mobile number" autocomplete="off"  value="<?php echo set_value('mobile_no'); ?>"> 
                                    <span class="red"><?php echo form_error('mobile_no'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Picture</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    <span class="red"><?php echo form_error('image'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="text" id="datepicker" name="dob" class="form-control" autocomplete="off" readonly="readonly"  value="<?php echo set_value('dob'); ?>">
                                    <span class="red"><?php echo form_error('dob'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Gender *</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender"  value="male" checked>Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender"  value="female">Female
                                    </label>

                                </div>
                                <div class="form-group">
                                    <label>Blood Group</label>
                                    <select class="form-control" name="blood_group">
                                        <option value="">--SELECT--</option>
                                        <option value="a+">A+</option>
                                        <option value="a-">A-</option>
                                        <option value="b+">B+</option>
                                        <option value="b-">B-</option>
                                        <option value="o+">O+</option>
                                        <option value="o-">O-</option>
                                        <option value="ab+"> AB+</option>
                                        <option value="ab-">AB-</option>
                                    </select>
                                    <span class="red"><?php echo form_error('blood_group'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status"  value="1" checked>Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status"  value="0">Inactive
                                    </label>
                                </div>
                                <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                <button type="reset" class="btn btn-default">Reset</button>
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
 
<script type="text/javascript">
        $(document).ready(function(){
            
            $(".registration_form").validate({
                rules :{
                    "first_name"    :"required",
                    "user_name"     :"required",
                    "email"         :"required",
                    "password"      :"required",
                },
             submitHandler : function(form) {
                form.submit();
                }
            });

           $("#datepicker").datepicker();

        });

</script>