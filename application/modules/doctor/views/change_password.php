<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Change Password</h1>
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
                            <form role="form" method="post" action="<?php echo base_url('doctor/change_password') ?>" class="registration_form" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label>Old Password *</label>
                                    <input class="form-control" type="password" placeholder="Old Password" name="old_password" autocomplete="off" required="required" value="<?php echo set_value('old_password');?>">
                                    <span class="red"><?php echo form_error('old_password'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>New Password *</label>
                                    <input class="form-control" type="password" name="new_password" placeholder="New Password" autocomplete="off" required="required" value="<?php echo set_value('new_password'); ?>">
                                    <span class="red"><?php echo form_error('new_password'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password *</label>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" autocomplete="off" required="required" value="<?php echo set_value('confirm_password'); ?>">
                                    <span class="red"><?php echo form_error('confirm_password'); ?></span>
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