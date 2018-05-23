<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <?php if($user_role==2){ ?>
            <h1 class="page-header">Edit Doctor</h1>
            <?php }elseif($user_role==3){?>
            <h1 class="page-header">Edit Patient</h1>
            <?php }elseif($user_role==4){ ?>
            <h1 class="page-header">Edit Sub Admin</h1>
            <?php } ?>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php $session_user_role = $this->session->userdata('user_role');?>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-th-list">&nbsp;Users Information</i>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-o12">
                        <?php if(isset($users[0]) && !empty($users[0]) && $users[0]->user_role==2){?>
                            <form role="form" method="post" action="<?php echo base_url('admin/update_user/'.$users[0]->id.'/'.$users[0]->user_role) ?>" class="registration_form1" enctype="multipart/form-data">
                            <?php }elseif(isset($users[0]) && !empty($users[0]) && $users[0]->user_role==3){?>
                            <form role="form" method="post" action="<?php echo base_url('admin/update_patient/'.$users[0]->id.'/'.$users[0]->user_role) ?>" class="registration_form1" enctype="multipart/form-data">
                                <?php }if(isset($users[0]) && $users[0]->user_role==2 && $session_user_role!=4){?>
                                <div class="col-md-6">
                                    <div class="">
                                        <label class="col-md-3">Hospital *</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="hospitals_id[]" id="hospitals_id" multiple="multiple"> 
                                            <option value="">-- Select Hospital --</option>
                                            <?php foreach ($hospitals as $value){?>
                                            <option value="<?php echo $value->id; ?>" <?php $hospitals_id = explode(',',$users[0]->hospital_id); if(in_array($value->id,$hospitals_id)){ echo 'selected';}?>><?php echo ucfirst($value->hospital_name); ?></option>
                                            <?php   } ?>
                                        </select>
                                            <span class="red"><?php echo form_error('hospitals_id'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <label class="col-md-3">Doctor Speciality *</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="specialization" id="category"> 
                                            <?php foreach($speciality as $specialities){?>
                                                <option value="<?php echo $specialities->id;?>"><?php echo $specialities->name;?></option>
                                            <?php }?>
                                            </select>
                                            <span class="red"><?php echo form_error('category'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>
                                <?php } if($users[0]->user_role==2){?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Speciality *</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="speciality" id="speciality">
                                                <option value="">--Select Speciality--</option>
                                                <?php foreach($speciality as $specialities){?>
                                                <option value="<?php echo $specialities->id?>" <?php if($doctor[0]->specialization==$specialities->id){ echo 'selected';}?>><?php echo $specialities->name?></option>
                                                <?php }?>
                                            </select> 
                                        </div>
                                        <span class="red"><?php echo form_error('speciality'); ?></span>
                                    </div>
                                </div>
                                <?php }?>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">User Name *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" placeholder="User Name" name="user_name" autocomplete="off" required="required" value="<?php if(isset($users[0])){ echo $users[0]->username;}else{ echo  set_value('username');}?>" readonly="readonly">
                                        </div>
                                        <span class="red"><?php echo form_error('user_name'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">First Name *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" placeholder="First Name" name="first_name" autocomplete="off" required="required" value="<?php if(isset($users[0])){ echo $users[0]->first_name;}else{ echo  set_value('first_name');}?>">
                                        </div>
                                        <span class="red"><?php echo form_error('first_name'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Last Name *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="last_name" placeholder="Last Name" autocomplete="off" required="required" value="<?php if(isset($users[0])){ echo $users[0]->last_name;}else{ echo  set_value('last_name');}?>">
                                        </div>
                                        <span class="red"><?php echo form_error('last_name'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Email Address *</label>
                                        <div class="col-md-9">
                                            <input type="email" name="email" class="form-control" placeholder="Email Address" autocomplete="off" required="required" value="<?php if(isset($users[0])){ echo $users[0]->email;}else{ echo  set_value('email');}?>" readonly>
                                        </div>
                                        <span class="red"><?php echo form_error('email'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Phone No</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="phone_no" placeholder="phone number" autocomplete="off" value="<?php if(isset($users[0])){ echo $users[0]->phone_no;}else{ echo  set_value('phone_no');}?>">
                                        </div>
                                        <span class="red"><?php echo form_error('phone_no'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Mobile No</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="mobile_no" placeholder="mobile number" autocomplete="off" required="  required" value="<?php if(isset($users[0])){ echo $users[0]->mobile;}else{ echo  set_value('mobile');}?>">
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
                                            <input type="text" id="datepicker" name="dob" class="form-control" autocomplete="off" readonly="readonly" required="required" value="<?php if(isset($users[0])){ echo date("Y-m-d", strtotime($users[0]->date_of_birth));}else{ echo  set_value('date_of_birth');}?>">
                                        </div>
                                        <span class="red"><?php echo form_error('dob'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Gender *</label>
                                        <div class="col-md-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="gender"  value="male" <?php if(isset($users[0]) && $users[0]->gender=="male"){?> checked<?php }?>>Male
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="gender"  value="female" <?php if(isset($users[0]) && $users[0]->gender=="female"){?> checked<?php }?>>Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Status</label>
                                        <div class="col-md-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="status"  value="1"  <?php if(isset($users[0]) &&  $users[0]->is_active=="1"){?> checked<?php }?>>Active
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="status"  value="0" <?php if(isset($users[0]) &&  $users[0]->is_active=="0"){?> checked<?php }?>>Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <label class="col-md-3">Blood Group</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="blood_group">
                                                <option value="a+"  <?php if(isset($users[0]) && $users[0]->blood_group == "a+"){?> selected<?php }?>>A+</option>
                                                <option value="a-"  <?php if(isset($users[0]) && $users[0]->blood_group == "a-"){?> selected<?php }?>>A-</option>
                                                <option value="b+"  <?php if(isset($users[0]) && $users[0]->blood_group == "b+"){?> selected<?php }?>>B+</option>
                                                <option value="b-"  <?php if(isset($users[0]) && $users[0]->blood_group == "b-"){?> selected<?php }?>>B-</option>
                                                <option value="o+"  <?php if(isset($users[0]) && $users[0]->blood_group == "o+"){?> selected<?php }?>>O+</option>
                                                <option value="o-"  <?php if(isset($users[0]) && $users[0]->blood_group == "o-"){?> selected<?php }?>>O-</option>
                                                <option value="ab+" <?php if(isset($users[0]) && $users[0]->blood_group== "ab+"){?> selected<?php }?>>AB+</option>
                                                <option value="ab-" <?php if(isset($users[0]) && $users[0]->blood_group== "ab-"){?> selected<?php }?>>AB-</option>
                                            </select>
                                        </div>
                                        <span class="red"><?php echo form_error('blood_group'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Address *</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="5" name="address" placeholder="Address"><?php if(isset($users[0])){ echo $users[0]->address;}else{ echo  set_value('address');}?></textarea>
                                        </div>
                                        <span class="red"><?php echo form_error('address'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12" align="center">
                                    <input type="submit" name="submit" class="btn btn-success" value="Save">
                                    <input type="reset" class="btn btn-default" value="Reset">
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
        <?php if(isset($users[0]) && $users[0]->user_role==2){?>
        get_specialty('<?php echo $doctor[0]->specialization;?>');
        <?php }?>
    });

    $("#datepicker").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    function get_specialty(id) {
        $.ajax({
            url: "<?php echo base_url('admin/get_speciality_by_hospital')?>",
            method: "GET",
            dataType: "json",
            data: {
                id: id,
            },
            success: function(response) {
                var option = '<option value="">-- Select Speciality --</option>';
                for (var i = 0; i < response.length; i++) {
                    $('#category').val(response[i].id);
                    //option += '<option value="' + response[i].id + '" selected="selected">' + response[i].name + '</option>';
                }
                //$('#category').html(option);
            },
            error: function() {
                alert('Something went wrong please try again later');
            }
        });
    }
</script>