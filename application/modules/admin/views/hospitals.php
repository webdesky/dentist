<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Hospitals</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/hospitals_list')?>"><i class="fa fa-th-list">&nbsp;  Hospitals List</i></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php if(isset($hospitals[0])){ echo base_url('admin/hospitals/'.$hospitals[0]->id); }else{ echo base_url('admin/hospitals'); }?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Hospital Name *</label>
                                        <div class="col-md-9">
                                            <input class="form-control capitalize" type="text" placeholder="Hospital Name" name="hospital_name" autocomplete="off" value="<?php if(!empty($hospitals[0]->hospital_name)){ echo $hospitals[0]->hospital_name;}else{ echo set_value('hospital_name');} ?>">
                                            <span class="red"><?php echo form_error('hospital_name'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Registration No. *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" placeholder="Registration Number" name="registration_number" id="registration_number" autocomplete="off" value="<?php if(!empty($hospitals[0]->registration_number)){ echo $hospitals[0]->registration_number;}else{ echo set_value('registration_number');}?>">
                                            <span class="red"><?php echo form_error('registration_number'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Registration Date. *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" placeholder="Registration Date" name="registration_date" id="registration_date" autocomplete="off" value="<?php if(!empty($hospitals_details[0]->date_of_birth)){ echo date(" Y-m-d ", strtotime($hospitals_details[0]->date_of_birth));}else{ echo set_value('registration_date');}?>">
                                            <span class="red"><?php echo form_error('registration_date'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Owner Name *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="owner_name" placeholder="Owner Name" autocomplete="off" value="<?php if(!empty($hospitals[0]->owner_name)){ echo $hospitals[0]->owner_name;}else{ echo set_value('owner_name');} ?>">
                                            <span class="red"><?php echo form_error('owner_name'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php if(empty($hospitals_details[0])){?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Email *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="email" name="email" placeholder="Email" autocomplete="off" value="<?php if(!empty($hospitals_details[0]->email)){ echo $hospitals_details[0]->email;}else{ echo set_value('email');} ?>">
                                            <span class="red"><?php echo form_error('email'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Username *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="username" placeholder="Username" autocomplete="off" value="<?php if(!empty($hospitals_details[0]->username)){ echo $hospitals_details[0]->username;}else{ echo set_value('username');} ?>">
                                            <span class="red"><?php echo form_error('username'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Password *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="password" name="password" placeholder="Password" autocomplete="off" value="<?php if(!empty($hospitals_details[0]->password)){ echo $hospitals_details[0]->password;}else{ echo set_value('password');} ?>">
                                            <span class="red"><?php echo form_error('password'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Mobile No *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="mobile" placeholder="Mobile" autocomplete="off" value="<?php if(!empty($hospitals_details[0]->mobile)){ echo $hospitals_details[0]->mobile;}else{ echo set_value('mobile');} ?>">
                                            <span class="red"><?php echo form_error('mobile'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Phone No *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="phone_no" placeholder="phone" autocomplete="off" value="<?php if(!empty($hospitals_details[0]->phone_no)){ echo $hospitals_details[0]->phone_no;}else{ echo set_value('phone_no');} ?>">
                                            <span class="red"><?php echo form_error('phone_no'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Country *</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="country" id="country" onchange="get_state(this.value)">
                                                <option data-display="-- Select Country --">-- Select Country --</option>
                                                <?php foreach($countries as $country){?>
                                                <option value="<?php echo $country['id']?>" <?php if(!empty($hospitals[0]->country) && $hospitals[0]->country==$country['id']){ echo 'selected';}?>><?php echo $country['name']?>
                                                </option>
                                                <?php }?>
                                            </select>
                                            <span class="red"><?php echo form_error('country');?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">State *</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="state" id="state" onchange="get_city(this.value)">
                                                <option value="">-- Select State --</option>
                                                <?php if(!empty($hospitals[0]->state_id)){?>
                                                    <option value="<?php echo $hospitals[0]->state_id;?>" selected><?php echo $hospitals[0]->state_name;?></option>
                                                <?php }?>
                                            </select>
                                            <span class="red"><?php echo form_error('state'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">City *</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="city" id="city">
                                                <option value="">-- Select City --</option>
                                                <?php if(!empty($hospitals[0]->city)){?>
                                                    <option value="<?php echo $hospitals[0]->city;?>" selected><?php echo $hospitals[0]->city_name;?></option>
                                                <?php }?>
                                            </select>
                                            <span class="red"><?php echo form_error('city'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Address *</label>
                                        <div class="col-md-9">
                                            <input type="text" name="address" class="form-control" placeholder="Address" autocomplete="off" value="<?php if(!empty($hospitals[0]->address)){ echo $hospitals[0]->address;}else{ echo set_value('address');} ?>">
                                            <span class="red"><?php echo form_error('address'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">No. of Doctors*</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="no_of_doc" name="no_of_doc" placeholder="No. of Doctors" value="<?php if(!empty($hospitals[0]->no_of_doc)){ echo $hospitals[0]->no_of_doc;}else{echo set_value('no_of_doc');} ?>">
                                            <span class="red"><?php echo form_error('no_of_doc'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">No. of Staff</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="staff_number" placeholder="No. of Staff" value="<?php if(!empty($hospitals[0]->staff_number)){ echo $hospitals[0]->staff_number;}else{echo set_value('staff_number'); }?>">
                                            <span class="red"><?php echo form_error('staff_number'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">No. of Ambulance*</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="no_of_ambulance" placeholder="No. of Ambulance" autocomplete="off" value="<?php if(!empty($hospitals[0]->no_of_ambulance)){ echo $hospitals[0]->no_of_ambulance;}else{echo set_value('no_of_ambulance');} ?>">
                                            <span class="red"><?php echo form_error('no_of_ambulance'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Main Speciality*</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="speciality" id="speciality"> 
                                                <option value="">-- Select Speciality --</option>
                                                <?php 
                                                    foreach ($speciality as $value) { 
                                                    //$HiddenProducts = explode(',',$hospitals[0]->speciality);
                                                ?>
                                                <option value="<?php echo $value->id; ?>" <?php if($value->id==$hospitals[0]->speciality){ 
                                                    echo "selected";}?>><?php echo $value->name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="red"><?php echo form_error('speciality'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Logo</label>
                                        <div class="col-md-9">
                                            <input type="file" name="logo" id="logo" class="form-control">
                                            <span class="red"><?php echo form_error('logo'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="formas">
                                        <label class="col-md-3">Blood Bank*</label>
                                        <div class="col-md-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="blood_bank" value="1"<?php if(!empty($hospitals[0]->blood_bank) && $hospitals[0]->blood_bank==1){ echo 'checked';}else{ echo set_value('no_of_ambulance');} ?>>Yes
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="blood_bank" value="0"<?php if(!empty($hospitals[0]->blood_bank) && $hospitals[0]->blood_bank==0){ echo 'checked';}else{ echo set_value('no_of_ambulance');} ?>>No
                                            </label>
                                        </div>
                                        <span class="red"><?php echo form_error('blood_bank'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Status</label>
                                        <div class="col-md-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="status"  value="1"<?php if(!empty($hospitals[0]->is_active) && $hospitals[0]->is_active==1){ echo 'checked';}else{ echo set_value('no_of_ambulance');} ?>>Active
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="status"  value="0"<?php if(!empty($hospitals[0]->is_active) && $hospitals[0]->is_active==0){ echo 'checked';}else{ echo set_value('no_of_ambulance');} ?>>Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Other Speciality*</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="other_speciality[]" id="other_speciality" multiple="multiple"> 
                                                <option value="">-- Select Speciality --</option>
                                                <?php 
                                                    foreach ($speciality as $value) { 
                                                    $HiddenProducts = explode(',',$hospitals[0]->other_speciality);
                                                ?>
                                                <option value="<?php echo $value->id; ?>" <?php if(in_array($value->id, $HiddenProducts)){ 
                                                    echo "selected";}?>><?php echo $value->name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="red"><?php echo form_error('other_speciality'); ?></span>
                                        </div>
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
    //$('select').niceSelect();
    $("#registration_date").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

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