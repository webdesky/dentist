<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Profile</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
        <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?> </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <!-- <a class="btn btn-primary" href="<?php //echo base_url('admin/users_list')?>"><i class="fa fa-th-list">&nbsp;Users List</i></a> -->
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('pharma/profile/') ?>" class="registration_form1" class="form-horizontal" enctype="multipart/form-data">
                                <?php if(!empty($users[0]->profile_pic)){?>
                                <div class="form-group">
                                    <div class="col-md-12" align="center">
                                        <img src="<?php echo base_url('asset/uploads/').$users[0]->profile_pic ?>" style="max-width: 100px;max-height: 100px;">

                                    </div>
                                </div>
                                <?php }?>
                                <div class="clearfix"></div><br/>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="first name">First Name:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="<?php if(!empty($users[0])){ echo $users[0]->first_name;}?>">
                                            <span class="red"><?php echo form_error('first_name'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="last name">Last Name:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="<?php if(!empty($users[0])){ echo $users[0]->last_name;}?>">
                                            <span class="red"><?php echo form_error('last_name'); ?></span>
                                        </div>
                                    </div>
                                </div><div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="email">Email:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="email" placeholder="Enter Email" value="<?php if(!empty($users[0])){ echo $users[0]->email;}?>">
                                            <span class="red"><?php echo form_error('email'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="date of birth">Date of Birth:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" value="<?php if(!empty($users[0])){ echo date('Y-m-d', strtotime($users[0]->date_of_birth));}?>">
                                            <span class="red"><?php echo form_error('date_of_birth'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <label class="control-label col-md-3" for="Blood Group">Blood Group:</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="blood_group">
                                                <option value="">--SELECT--</option>
                                                <option value="a+" <?php if(!empty($users[0]) && $users[0]->blood_group=="a+"){echo 'selected';};?>>A+</option>
                                                <option value="a-" <?php if(!empty($users[0]) && $users[0]->blood_group=="a-"){echo 'selected';};?>>A-</option>
                                                <option value="b+" <?php if(!empty($users[0]) && $users[0]->blood_group=="b+"){echo 'selected';};?>>B+</option>
                                                <option value="b-" <?php if(!empty($users[0]) && $users[0]->blood_group=="b-"){echo 'selected';};?>>B-</option>
                                                <option value="o+" <?php if(!empty($users[0]) && $users[0]->blood_group=="o+"){echo 'selected';};?>>O+</option>
                                                <option value="o-" <?php if(!empty($users[0]) && $users[0]->blood_group=="o-"){echo 'selected';};?>>O-</option>
                                                <option value="ab+"<?php if(!empty($users[0]) && $users[0]->blood_group=="ab+"){echo 'selected';};?>>AB+</option>
                                                <option value="ab-"<?php if(!empty($users[0]) && $users[0]->blood_group=="ab-"){echo 'selected';};?>>AB-</option>
                                            </select>
                                            <span class="red"><?php echo form_error('blood_group'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="mobile"> Mobile:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="mobile" placeholder="Enter Mobile" value="<?php if(!empty($users[0])){ echo $users[0]->mobile; }?>">
                                            <span class="red"><?php echo form_error('mobile'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="phone"> Phone no:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" value="<?php if(!empty($users[0])){ echo $users[0]->phone_no; }?>">
                                            <span class="red"><?php echo form_error('phone'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="dob">Gender:</label>
                                        <div class="col-md-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" value="male" <?php if(!empty($users[0]) && $users[0]->gender=="male"){ echo 'checked';}?>>Male</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" value="female" <?php if(!empty($users[0]) && $users[0]->gender=="female"){ echo 'checked';}?>>Female</label>

                                                <span class="red"><?php echo form_error('gender'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="image"> Profile Pic:</label>
                                        <div class="col-md-9">
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                                              
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="address"> Address:</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="address" placeholder="Enter Address"><?php if(!empty($users[0])){ echo $users[0]->address;}?></textarea>
                                            <span class="red"><?php echo form_error('address'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12" align="center">
                                    <div class="form-group">
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
$(document).ready(function() {
    $("#date_of_birth").datepicker({

    });



})
//$('select').niceSelect();

/*$('#consultancy_time').timepicker();*/


function get_state(country_id) {
    $.ajax({
        url: "<?php echo base_url('admin/get_record')?>",
        method: "GET",
        dataType: "json",
        data: {
            id: country_id,
            table: 'states',
            field: 'country_id'
        },
        success: function(response) {
            var option = '<option value="">-- Select State --</option>';
            for (var i = 0; i < response.length; i++) {
                option += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
            }
            $("#state").html('');
            $("#state").html(option);
            $("#state").niceSelect('update');
        },
        error: function() {
            alert("error");
        }
    });
}

function get_city(state_id) {
    $.ajax({
        url: "<?php echo base_url('admin/get_record')?>",
        method: "GET",
        dataType: "json",
        data: {
            id: state_id,
            table: 'cities',
            field: 'state_id'
        },
        success: function(response) {
            var option = '<option value="">-- Select City --</option>';
            for (var i = 0; i < response.length; i++) {
                option += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
            }
            $("#city").html('');
            $("#city").html(option);
            $("#city").niceSelect('update');
        },
        error: function() {
            alert("error");
        }
    });
}
</script>