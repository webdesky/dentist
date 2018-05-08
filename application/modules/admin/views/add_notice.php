<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">NoticeBoard</h1>
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
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/notices_list')?>"><i class="fa fa-th-list">&nbsp;Notice List</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('admin/notices')?>" class="registration_form1" enctype="multipart/form-data">

                                <?php if($this->session->userdata('user_role')==1){?>
                                <div class="form-group">
                                        <label class="col-md-2">Hospital *</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="hospital_id" id="hospital_id"> 
                                            <option value="">-- Select Hospital or Don't choose any , if you want to send notice to all the hospitals --</option>
                                            <?php foreach ($hospitals as $value) { ?>
                                            <option value="<?php echo $value->id; ?>"><?php echo ucfirst($value->hospital_name); ?></option>
                                            <?php   } ?>
                                        </select>
                                            <span class="red"><?php echo form_error('hospital_id'); ?></span>
                                    </div>
                                </div>
                                <?php }elseif($this->session->userdata('user_role')==4){?>
                                    <input type="hidden" name="hospital_id" value="<?php echo $this->session->userdata('hospital_id'); ?>">
                                <?php }?>

                                <div class="form-group"> <label class="col-md-2">Title * </label>
                                    <div class="col-lg-6"> <input class="form-control" type="text" name="title" placeholder="Title" autocomplete="off" required="required" value="<?php echo set_value('title'); ?>"> <span class="red"><?php echo form_error('title'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Description * </label>
                                    <div class="col-lg-6"> <textarea class="form-control" rows="5" id="Description" name="description" placeholder="description"></textarea> <span class="red"><?php echo form_error('description'); ?></span>
                                        <script type="text/javascript">
                                            CKEDITOR.replace('description');
                                        </script>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>
                                <div class="form-group"> <label class="col-md-2">Start Date * </label>
                                    <div class="col-lg-6"> <input type="text" id="start_date" name="start_date" class="form-control date" autocomplete="off" readonly="readonly" required="required" value=""> <span class="red"><?php echo form_error('start_date'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">End Date * </label>
                                    <div class="col-lg-6"> <input type="text" id="end_date" name="end_date" class="form-control date" autocomplete="off" readonly="readonly" required="required" value=""> <span class="red"><?php echo form_error('end_date'); ?></span> </div>
                                </div>
                                <div class="col-md-12" align="center"><button type="submit" value="Save" class="btn btn-success">Save</button><input type="reset" class="btn btn-default" value="Reset"> </div>
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
        $(".registration_form1").validate({
            rules: {
                "title": "required",
                "description": "required",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>