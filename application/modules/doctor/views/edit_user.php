<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Patient</h1>
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
                    <a class="btn btn-primary" href="<?php echo base_url('doctor/users_list')?>"><i class="fa fa-th-list">&nbsp;Patient List</i></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-2">
                            <form role="form" method="post" action="<?php echo base_url('doctor/register/'.$users[0]->id) ?>" class="registration_form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>User Role *</label>
                                    <select class="form-control" name="user_role" required="required">
                                        <option value="">--Select User Role--</option>
                                        <?php foreach($user_role as $role){?>
                                        <option value="<?php echo $role->role_id;?>" <?php if($users[0]->user_role==$role->role_id){ echo 'selected';}?>><?php echo ucfirst($role->role_name);?></option>
                                        <?php }?>
                                    </select>
                                    <span><?php echo form_error('user_role'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>First Name *</label>
                                    <input class="form-control" type="text" placeholder="First Name" name="first_name" autocomplete="off" required="required" value="<?php echo $users[0]->first_name;?>" >
                                    <span class="red"><?php echo form_error('first_name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Last Name *</label>
                                    <input class="form-control" type="text" name="last_name" placeholder="Last Name" autocomplete="off" required="required" value="<?php echo $users[0]->last_name; ?>">
                                    <span class="red"><?php echo form_error('last_name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Email Address *</label>
                                    <input type="text" name="email" class="form-control" placeholder="Email Address" autocomplete="off" required="required" value="<?php echo $users[0]->email; ?>" readonly>
                                    <span class="red"><?php echo form_error('email'); ?></span>
                                </div>
                                <!-- <div class="form-group">
                                    <label>Password *</label>
                                    <input type="Password" class="form-control" id="password" name="password" placeholder="Password" required="required">
                                    <span class="red"><?php //echo form_error('password'); ?></span>
                                </div> -->

                                <div class="form-group">
                                    <label>Address *</label>
                                    <textarea class="form-control" rows="5" name="address" placeholder="Address">
                                        <?php echo $users[0]->address;?>
                                    </textarea>
                                    <span class="red"><?php echo form_error('address'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Phone No</label>
                                    <input type="text" class="form-control" name="phone_no" placeholder="phone number" autocomplete="off" value="<?php echo $users[0]->phone_no;?>">
                                    <span class="red"><?php echo form_error('phone_no'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Mobile No</label>
                                    <input type="text" class="form-control" name="mobile_no" placeholder="mobile number" autocomplete="off" required="required" value="<?php echo $users[0]->mobile; ?>"> 
                                    <span class="red"><?php echo form_error('mobile_no'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Picture</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    <span class="red"><?php echo form_error('image'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="text" id="datepicker" name="dob" class="form-control" autocomplete="off" readonly="readonly" required="required" value="<?php echo $users[0]->date_of_birth; ?>">
                                    <span class="red"><?php echo form_error('dob'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Gender *</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender"  value="male" <?php if($users[0]->gender=="male"){?> checked<?php }?>>Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender"  value="female" <?php if($users[0]->gender=="female"){?> checked<?php }?>>Female
                                    </label>

                                </div>
                                <div class="form-group">
                                    <label>Blood Group</label>
                                    <select class="form-control" name="blood_group">
                                        <option value="">--SELECT--</option>
                                        <option value="a+" <?php if($users[0]->blood_group=="a+"){?>  selected<?php }?>>A+</option>
                                        <option value="a-" <?php if($users[0]->blood_group=="a-"){?>  selected<?php }?>>A-</option>
                                        <option value="b+" <?php if($users[0]->blood_group=="b+"){?>  selected<?php }?>>B+</option>
                                        <option value="b-" <?php if($users[0]->blood_group=="b-"){?>  selected<?php }?>>B-</option>
                                        <option value="o+" <?php if($users[0]->blood_group=="o+"){?>  selected<?php }?>>O+</option>
                                        <option value="o-" <?php if($users[0]->blood_group=="o-"){?>  selected<?php }?>>O-</option>
                                        <option value="ab+"<?php if($users[0]->blood_group=="ab+"){?> selected<?php }?>> AB+</option>
                                        <option value="ab-"<?php if($users[0]->blood_group=="ab-"){?> selected<?php }?>>AB-</option>
                                    </select>
                                    <span class="red"><?php echo form_error('blood_group'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status"  value="1" <?php if($users[0]->is_active=="1"){?> checked<?php }?>>Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status"  value="0" <?php if($users[0]->is_active=="0"){?> checked<?php }?>>Inactive
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
    $(document).ready(function() {
        $("#datepicker").datepicker();
    });
</script>