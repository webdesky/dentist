<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Speciality</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <?php if(!empty($msg)){?>
            <div class="alert alert-success">
                <?php echo $msg;?> </div>
            <?php }?>
            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?> </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/speciality_list')?>"><i class="fa fa-th-list">&nbsp;Speciality List</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php if(!empty($speciality[0])){ echo base_url('admin/speciality/'.$speciality[0]->id);}else{echo base_url('admin/speciality');} ?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-2">Speciality Name * </label>
                                    <div class="col-lg-6">
                                        <input type="text" name="speciality_name" id="speciality_name" class="form-control" value="<?php if(!empty($speciality[0]->name)){echo $speciality[0]->name;}else{ echo set_value('speciality_name');}?>" maxlength="30">
                                        <span class="red"><?php echo form_error('speciality_name'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Details </label>
                                    <div class="col-lg-6">
                                        <textarea name="details" id="details" class="form-control"><?php if(!empty($speciality[0]->details)){ echo $speciality[0]->details;}else{ echo set_value('details');} ?></textarea>
                                        <span><?php echo form_error('details'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Status *</label>
                                    <div class="col-md-6">
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="1"  <?php if(!empty($speciality[0]->is_active)){ echo ($speciality[0]->is_active=='1')?'checked':'';}else{ echo set_value('status');} ?>>Active
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="0" <?php if(!empty($speciality[0]->is_active)){ echo ($speciality[0]->is_active=='0')?'checked':''; }else{ echo set_value('status');}?>>Inactive
                                        </label>
                                        <span class="red"><?php echo form_error('status'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12" align="center">
                                    <button type="submit" value="Save" id="submit" class="btn btn-success">Save</button>
                                    <input type="reset" class="btn btn-default" value="Reset"> </div>
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
        $('select').niceSelect();
    });
</script>