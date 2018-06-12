<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Assign Doctor</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <?php if(validation_errors()){?>
            <div class="alert alert-danger"> <strong>Error!</strong>
                <?php echo validation_errors(); ?> </div>
            <?php } if(!empty($msg)){?>
            <div class="alert alert-success">
                <?php echo $msg;?>
            </div>
            <?php }?>
            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?>
            </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-primary"><i class="fa fa-th-list">&nbsp;Assign Doctors to Multiple Hospital</i></button>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-2">
                            <form role="form" method="post" id="commentForm" action="<?php echo base_url('admin/assign_hospital') ?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-2">Doctor * </label>
                                    <div class="col-lg-6">
                                        <select id="doctor_id" name="doctor_id" class="wide" onchange="get_hospital_list(this.value)">
                                            <option value="">--Select Doctor--</option>
                                            <?php foreach($doctors as $value){?>
                                            <option value="<?php echo $value->id?>"><?php echo ucwords($value->first_name.' '.$value->last_name);?></option>
                                        <?php }?>
                                    </select>
                                        <span class="red"><?php echo form_error('speciality_name'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Hospitals * </label>
                                    <div class="col-lg-6" id="hospitals">
                                        <ul style="list-style:none;margin:0;padding:0;" id="hospital_ids">
                                            <?php foreach($hospitals as $hospital){?>
                                            <li>
                                                <input type="checkbox" name="hospital_ids[]" value="<?php echo $hospital->id;?>">
                                                <?php echo ucwords(trim($hospital->hospital_name));?>
                                            </li>
                                            <?php }?>
                                        </ul>
                                        <span class="red"><?php echo form_error('speciality_name'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12" align="center">
                                    <button type="submit" name="submit" class="btn btn-success">Save</button>
                                    <button type="reset" class="btn btn-default">Reset</button></div>
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
<script type="text/javascript ">
    $(document).ready(function() {
        $('select').niceSelect();
    });

    function get_hospital_list(id) {
        if (id !== '') {
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('admin/get_hospitals')?>",
                data: {
                    'doctor_id': id,
                },
                success: function(data) {
                    var obj = JSON.parse(data);
                    var ids = obj[0].hospital_id.split(',');
                    if (ids.length > 0) {
                        $('#hospital_ids').find('input[type=checkbox]').prop('checked', false);
                        for (var i = 0; i < ids.length; i++) {
                            $('#hospital_ids').find('input[type=checkbox][value="' + ids[i] + '"]').prop('checked', true);
                        }
                    }
                }
            });
        }
    }
</script>