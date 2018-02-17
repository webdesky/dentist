<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Profile</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <style type="text/css">
        .red {
            color: red;
        }
    </style>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <!-- <a class="btn btn-primary" href="<?php //echo base_url('admin/users_list')?>"><i class="fa fa-th-list">&nbsp;Users List</i></a> -->
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-2">
                            <form role="form" method="post" action="<?php echo base_url('doctor/profile/') ?>" class="registration_form" class="form-horizontal" enctype="multipart/form-data">

                                <div class="form-group">
                                    
                                    <div class="col-sm-10">
                                       <img src="<?php echo base_url('asset/uploads/').$users[0]->profile_pic ?>" style="max-width: 300px;max-height: 300px;">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="first name">  First Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="<?php echo $users[0]->first_name;?>">
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="last name">Last Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="<?php echo $users[0]->last_name;?>">
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Email:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="email" placeholder="Enter Email" value="<?php echo $users[0]->email;?>">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="date of birth">Date of Birth:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" value="<?php echo $users[0]->date_of_birth;?>">
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="Blood Group">Blood Group:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="blood_group">
                                        <option value="">--SELECT--</option>
                                        <option value="a+"<?php if($users[0]->blood_group=="a+"){echo 'selected';};?>>A+</option>
                                        <option value="a-"<?php if($users[0]->blood_group=="a-"){echo 'selected';};?>>A-</option>
                                        <option value="b+"<?php if($users[0]->blood_group=="b+"){echo 'selected';};?>>B+</option>
                                        <option value="b-"<?php if($users[0]->blood_group=="b-"){echo 'selected';};?>>B-</option>
                                        <option value="o+"<?php if($users[0]->blood_group=="o+"){echo 'selected';};?>>O+</option>
                                        <option value="o-"<?php if($users[0]->blood_group=="o-"){echo 'selected';};?>>O-</option>
                                        <option value="ab+"<?php if($users[0]->blood_group=="ab+"){echo 'selected';};?>> AB+</option>
                                        <option value="ab-"<?php if($users[0]->blood_group=="ab-"){echo 'selected';};?>>AB-</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dob">Gender:</label>
                                    <div class="col-sm-10">
                                        <label class="radio-inline"><input type="radio" name="gender" value="male" <?php if($users[0]->gender=="male"){ echo 'checked';}?>>Male</label>
                                        <label class="radio-inline"><input type="radio" name="gender" value="female" <?php if($users[0]->gender=="female"){ echo 'checked';}?>>Female</label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="mobile">  Mobile:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="mobile" placeholder="Enter Mobile" value="<?php echo $users[0]->mobile;?>">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="phone">  Phone no:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" value="<?php echo $users[0]->phone_no;?>">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="address">  Address:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address" placeholder="Enter Address"><?php echo $users[0]->address;?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="image">  Profile Pic:</label>
                                    <div class="col-sm-10">
                                       <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                                    </div>
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

<script type="text/javascript">
    $(document).ready(function(){
        $("#date_of_birth").datepicker();
    })
</script>