<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">User</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
<style type="text/css">
    .red{
        color: red;
    }

    .registration_form1 .form-group {
        margin-bottom: 15px;
        overflow: hidden;

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
                        <div class="col-lg-12 col-md-o12">
                            <form role="form" method="post" action="<?php echo base_url('admin/register/'.$users[0]->id) ?>" class="registration_form1" enctype="multipart/form-data">
                             
                            <div class="col-md-6">
                                <div class="">
                                    <label class="col-md-3">User Role *</label>
                                    <div class="col-md-9">
                                        <select class="wide" name="user_role" required="required">
                                           
                                            <?php foreach($user_role as $role){?>
                                            <option value="<?php echo $role->role_id;?>" <?php if($users[0]->user_role==$role->role_id){ echo 'selected';}?>><?php echo ucfirst($role->role_name);?></option>
                                            <?php }?>
                                        </select>
                                   </div>
                                    <span><?php echo form_error('user_role'); ?></span>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">User Name *</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" placeholder="User Name" name="user_name" autocomplete="off" required="required" value="<?php echo $users[0]->username;?>" >
                                    </div>
                                    <span class="red"><?php echo form_error('user_name'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">First Name *</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" placeholder="First Name" name="first_name" autocomplete="off" required="required" value="<?php echo $users[0]->first_name;?>" >
                                    </div>
                                    <span class="red"><?php echo form_error('first_name'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Last Name *</label>
                                    <div class="col-md-9">
                                       <input class="form-control" type="text" name="last_name" placeholder="Last Name" autocomplete="off" required="required" value="<?php echo $users[0]->last_name; ?>">
                                   </div>
                                    <span class="red"><?php echo form_error('last_name'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Email Address *</label>
                                    <div class="col-md-9">
                                        <input type="text" name="email" class="form-control" placeholder="Email Address" autocomplete="off" required="required" value="<?php echo $users[0]->email; ?>" readonly>
                                    </div>
                                    <span class="red"><?php echo form_error('email'); ?></span>
                                </div>
                            </div>
                                <!-- <div class="form-group">
                                    <label>Password *</label>
                                    <input type="Password" class="form-control" id="password" name="password" placeholder="Password" required="required">
                                    <span class="red"><?php //echo form_error('password'); ?></span>
                                </div> -->
                            

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Phone No</label>
                                    <div class="col-md-9">
                                      <input type="text" class="form-control" name="phone_no" placeholder="phone number" autocomplete="off" value="<?php echo $users[0]->phone_no;?>">
                                  </div>
                                    <span class="red"><?php echo form_error('phone_no'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Mobile No</label>
                                    <div class="col-md-9">
                                      <input type="text" class="form-control" name="mobile_no" placeholder="mobile number" autocomplete="off" required="  required" value="<?php echo $users[0]->mobile; ?>"> 
                                   </div>
                                    <span class="red"><?php echo form_error('mobile_no'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Picture</label>
                                    <div class="col-md-9">
                                         <input type="file" name="image" id="image" class="form-control">
                                     </div>
                                    <span class="red"><?php echo form_error('image'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Date of Birth</label>
                                    <div class="col-md-9">
                                        <input type="text" id="datepicker" name="dob" class="form-control" autocomplete="off" readonly="readonly" required="required" value="<?php echo $users[0]->date_of_birth; ?>">
                                    </div>
                                    <span class="red"><?php echo form_error('dob'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Gender *</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="gender"  value="male" <?php if($users[0]->gender=="male"){?> checked<?php }?>>Male
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="gender"  value="female" <?php if($users[0]->gender=="female"){?> checked<?php }?>>Female
                                        </label>
                                    </div>
                                </div>
                            </div>

                           
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Status</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="status"  value="1"  <?php if($users[0]->is_active=="1"){?> checked<?php }?>>Active
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status"  value="0" <?php if($users[0]->is_active=="0"){?> checked<?php }?>>Inactive
                                        </label>
                                    </div>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="">
                                    <label class="col-md-3">Blood Group</label>
                                    <div class="col-md-9">
                                        <select class="wide" name="blood_group">
                                            
                                            <option value="a+" <?php if($users[0]->blood_group=="a+"){?> selected<?php }?>>A+</option>
                                            <option value="a-" <?php if($users[0]->blood_group=="a-"){?> selected<?php }?>>A-</option>
                                            <option value="b+" <?php if($users[0]->blood_group=="b+"){?> selected<?php }?>>B+</option>
                                            <option value="b-" <?php if($users[0]->blood_group=="b-"){?> selected<?php }?>>B-</option>
                                            <option value="o+" <?php if($users[0]->blood_group=="o+"){?> selected<?php }?>>O+</option>
                                            <option value="o-" <?php if($users[0]->blood_group=="oO-"){?> selected<?php }?>>O-</option>
                                            <option value="ab+"<?php if($users[0]->blood_group=="ab+"){?> selected<?php }?>> AB+</option>
                                            <option value="ab-"<?php if($users[0]->blood_group=="ab-"){?> selected<?php }?>>AB-</option>
                                        </select>
                                    </div>
                                    <span class="red"><?php echo form_error('blood_group'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Address *</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="5" name="address" placeholder="Address"><?php echo $users[0]->address;?></textarea>
                                    </div>
                                    <span class="red"><?php echo form_error('address'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-12" align="center">
                                <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
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
<script>
    tinymce.init({
        selector: 'textarea#summernote'
    });
</script>
<script>
    tinymce.init({
        selector: 'textarea#education'
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $("#datepicker").datepicker();
    });
</script>