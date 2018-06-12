<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Patient</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <?php   
        $session_role    = $this->session->userdata('user_role');
        if($session_role==4){
            $hospital_id = $this->session->userdata('hospital_id');
        }
    ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/users_list/3')?>"><i class="fa fa-th-list">&nbsp;Patient List</i></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('admin/register') ?>" class="registration_form12" enctype="multipart/form-data" id="registration_form">
                                <?php if($session_role==4){?>
                                <input type="hidden" name="hospital_id" value="<?php echo $hospital_id; ?>">
                                <?php } ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">User Name *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" placeholder="User Name" maxlength="30" name="user_name" autocomplete="off" value="<?php echo set_value('user_name');?>">
                                            <span class="red"><?php echo form_error('user_name'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">First Name *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" placeholder="First Name" maxlength="30" name="first_name" id="first_name" autocomplete="off" value="<?php echo set_value('first_name');?>">
                                            <span class="red"><?php echo form_error('first_name'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Last Name *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="last_name" placeholder="Last Name" maxlength="30" autocomplete="off" value="<?php echo set_value('last_name'); ?>">
                                            <span class="red"><?php echo form_error('last_name'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">E-mail *</label>
                                        <div class="col-md-9">
                                            <input type="text" name="email" class="form-control" placeholder="Email Address" autocomplete="new-password" value="<?php echo set_value('email'); ?>">
                                            <span class="red"><?php echo form_error('email'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Password *</label>
                                        <div class="col-md-9">
                                            <input type="Password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="new-password">
                                            <span class="red"><?php echo form_error('password'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Date of Birth*</label>
                                        <div class="col-md-9">
                                            <input type="text" id="datepicker" name="dob" class="form-control" autocomplete="off" value="<?php echo set_value('dob'); ?>" placeholder="Date of Birth">
                                            <span class="red"><?php echo form_error('dob'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Country *</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="country" id="country" onchange="get_state(this.value)">
                                            <option value="">-- Select Country --</option>
                                            <?php foreach($countries as $country){?>
                                            <option value="<?php echo $country['id']?>" <?php if(!empty($hospitals[0]->country) && $hospitals[0]->country==$country['id']){ echo 'selected';}?>><?php echo $country['name']?></option>
                                            <?php }?>
                                        </select>
                                            <span class="red"><?php echo form_error('country'); ?></span>
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
                                        <label class="col-md-3">Phone No *</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="phone_no" maxlength="10" placeholder="Phone Number" autocomplete="off">
                                            <span class="red"><?php echo form_error('phone_no'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Mobile No</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="mobile_no" placeholder="Mobile Number" maxlength="10" autocomplete="off" value="<?php echo set_value('mobile_no'); ?>" require="required">
                                            <span class="red"><?php echo form_error('mobile_no'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Picture</label>
                                        <div class="col-md-9">
                                            <input type="file" name="image" id="image" class="form-control">
                                            <span class="red"><?php echo form_error('image'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Address</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="5" name="address" placeholder="Address"><?php echo set_value('address');?></textarea>
                                            <span class="red"><?php echo form_error('address'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Status</label>
                                        <div class="col-md-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="status"  value="1" checked>Active
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="status"  value="0">Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Gender *</label>
                                        <div class="col-md-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="gender"  value="male" checked>Male
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="gender"  value="female">Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="formas">
                                        <label class="col-md-3">Blood Group</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="blood_group">
                                                <option value="">-- Select Blood Group --</option>
                                                <option value="a+">A+</option>
                                                <option value="a-">A-</option>
                                                <option value="b+">B+</option>
                                                <option value="b-">B-</option>
                                                <option value="o+">O+</option>
                                                <option value="o-">O-</option>
                                                <option value="ab+">AB+</option>
                                                <option value="ab-">AB-</option>
                                            </select>
                                        </div>
                                        <span class="red"><?php echo form_error('blood_group'); ?></span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12" align="center">
                                    <input type="submit" name="submit" class="btn btn-success" value="Save">&nbsp;
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
        $("#datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            endDate: '+0d',
            startDate:'-100y',

        });
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