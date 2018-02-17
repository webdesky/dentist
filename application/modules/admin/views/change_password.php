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
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('admin/change_password') ?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="form-group"> <label class="col-md-2">Old Password * </label>
                                    <div class="col-lg-6"> <input class="form-control" type="password" placeholder="Old Password" onblur="check_password(this.value)" name="old_password" autocomplete="off" id="old_password" required="required" value="<?php echo set_value('old_password');?>"> <span class="red" id="old"><?php echo form_error('old_password'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">New Password * </label>
                                    <div class="col-lg-6"> <input class="form-control" type="password" name="new_password" id="new_password" placeholder="New Password" autocomplete="off" required="required" value="<?php echo set_value('new_password'); ?>"> <span class="red"><?php echo form_error('new_password'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Confirm Password * </label>
                                    <div class="col-lg-6"> <input type="password" name="confirm_password" id="confirm_password" onblur="password(this.value)" class="form-control" placeholder="Confirm Password" autocomplete="off" required="required" value="<?php echo set_value('confirm_password'); ?>"> <span class="red" id="new"><?php echo form_error('confirm_password'); ?></span> </div>
                                </div>
                                <div class="col-md-12" align="center"> <input type="submit" name="submit" class="btn btn-success" value="Save"><button type="reset" class="btn btn-default">Reset</button> </div>
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
function check_password(data) {
    var url = 'admin/check_password';
    $.ajax({
        url: url,
        type: "POST",
        data: {
            data: data
        },
        success: function(result) {
            if (result == 1) {
                $('#old').text('old password not match');
                $('#old_password').focus();
            }
            //  window.location.reload();
        }
    });
}

function password(confirm_password) {
    var new_password = $('#new_password').val();
    if (new_password != confirm_password) {
        $('#new').text("New password and confirm password not match");
        $('#confirm_password').val('');
    }
}
</script>