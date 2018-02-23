<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <?php if($user_role==2){ ?>
            <h1 class="page-header">Add Doctor</h1>
            <?php }elseif($user_role==3){?>
            <h1 class="page-header">Add Patient</h1>
            <?php }else{ ?>
                <h1 class="page-header">Add Sub Admin</h1>
            <?php } ?>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php if($user_role==2){ ?>
                    <a class="btn btn-primary" href="<?php echo base_url('admin/users_list/2')?>"><i class="fa fa-th-list">&nbsp;Doctor List</i></a>
                    <?php }elseif($user_role==3){ ?>

                     <a class="btn btn-primary" href="<?php echo base_url('admin/users_list/3')?>"><i class="fa fa-th-list">&nbsp;  Patient List</i></a>
                    <?php }else{?>
                        <a class="btn btn-primary" href="<?php echo base_url('admin/users_list/4')?>"><i class="fa fa-th-list">&nbsp;  Sub Admin List</i></a>
                    <?php } ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">

                            <form role="form" method="post"  action="<?php echo base_url('admin/register') ?>" class="registration_form12" enctype="multipart/form-data">
                                <?php if($user_role==2){ ?>

                                <div class="col-md-6">
                                    <div class="">
                                        <label class="col-md-3">Doctor Category*</label>
                                        <div class="col-md-9">
                                        <select class="wide" name="category" id="category" style="height: 35px;"> 
                                            <option data-display="-- Select Category --">-- Select Category --</option>
                                            <?php foreach ($category as $key => $value) { ?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                            <?php   } ?>
                                        </select>    
                                        <span class="red"><?php echo form_error('category'); ?></span>
                                         </div>      
                                    </div>
                                </div>

                                <?php } ?>



                              <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">User Name *</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" placeholder="User Name" name="user_name" autocomplete="off" value="<?php echo set_value('user_name');?>" >
                                        <span class="red"><?php echo form_error('user_name'); ?></span>
                                    </div>
                                </div>
                            </div>
                            
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">First Name *</label>
                                     <div class="col-md-9">
                                    <input type="hidden" name="user_role" value="<?php echo $user_role; ?>">
                                    <input class="form-control" type="text" placeholder="First Name" name="first_name" id="first_name"  autocomplete="off"  value="<?php echo set_value('first_name');?>" >
                                    <span class="red"><?php echo form_error('first_name'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Last Name *</label>
                                     <div class="col-md-9">
                                    <input class="form-control" type="text" name="last_name" placeholder="Last Name"  autocomplete="off"  value="<?php echo set_value('last_name'); ?>">
                                    <span class="red"><?php echo form_error('last_name'); ?></span>
                                </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Email Address *</label>
                                <div class="col-md-9">
                                    <input type="text" name="email" class="form-control" placeholder="Email Address" autocomplete="off"  value="<?php echo set_value('email'); ?>">
                                    <span class="red"><?php echo form_error('email'); ?></span>
                                </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Password *</label>
                                    <div class="col-md-9">
                                         <input type="Password" class="form-control" id="password" name="password" placeholder="Password" >
                                         <span class="red"><?php echo form_error('password'); ?></span>
                                    </div>
                                </div>
                            </div>
                             <?php if($user_role==2){ ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Specialization *</label>
                                 <div class="col-md-9">
                                    <input type="text" class="form-control" id="specialization" name="specialization" placeholder="Specialization" >
                                    <span class="red"><?php echo form_error('specialization'); ?></span>
                                </div>
                                </div>
                            </div>
                            <?php } ?>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Date of Birth*</label>
                                     <div class="col-md-9">
                                        <input type="text" id="datepicker" name="dob" class="form-control date" autocomplete="off"  value="<?php echo set_value('dob'); ?>" placeholder="Date of Birth">
                                        <span class="red"><?php echo form_error('dob'); ?></span>
                                    </div>
                                </div>
                            </div>

                           
                            
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Phone No</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="phone_no" placeholder="Phone Number" autocomplete="off">
                                        <span class="red"><?php echo form_error('phone_no'); ?></span>
                                    </div>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Mobile No</label>
                                     <div class="col-md-9">
                                        <input type="text" class="form-control" name="mobile_no" placeholder="Mobile Number" autocomplete="off"  value="<?php echo set_value('mobile_no'); ?>"> 
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

                            

                            <div class="col-md-6">
                                <div class="formas"> 
                                    <label class="col-md-3">Blood Group</label>
                                    <div class="col-md-9">
                                        <select class="wide" name="blood_group">
                                            <option data-display="-- Select Blood Group --">-- Select Blood Group --</option>
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
                                    <label class="col-md-3">Address</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="5" name="address" placeholder="Address"><?php echo set_value('address');?></textarea>
                                        <span class="red"><?php echo form_error('address'); ?></span>
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
    $(document).ready(function(){
        $('select').niceSelect();
    });
</script>