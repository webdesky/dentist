
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
                <?php echo $info_message; ?>
            </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-primary"><i class="fa fa-th-list">&nbsp;Add Notice</i></button>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-2">
                            <form role="form" method="post" action="<?php echo base_url('admin/notices') ?>" class="registration_form" enctype="multipart/form-data">
                               		<div class="form-group">
                                    <label>Title </label>
                                    <input class="form-control" type="text" name="title" placeholder="title" autocomplete="off" required="required" value="<?php echo set_value('title'); ?>">
                                    <span class="red"><?php echo form_error('title'); ?></span>
                                    </div>

                                     <div class="form-group">
                                    <label>Description *</label>
                                    <textarea class="form-control" rows="5" id="Description" name="description" placeholder="description">
                                            </textarea>
                                    <span class="red"><?php echo form_error('description'); ?></span>
                                    <script type="text/javascript">
                                        CKEDITOR.replace('description');
                                    </script>
                                    </div>
 									
 									<div class="form-group">
                                    <label>Start Date *</label>
                                     <input type="text" id="start_date" name="start_date" class="form-control" autocomplete="off" readonly="readonly" required="required" value="<?php echo date("Y-m-d"); ?>">
                                     <span class="red"><?php echo form_error('start_date'); ?></span>
                                    
                                    </div>

                                    <div class="form-group">
                                    <label>End Date *</label>
                                     <input type="text" id="end_date" name="end_date" class="form-control" autocomplete="off" readonly="readonly" required="required" value="<?php echo date("Y-m-d"); ?>">
                                     <span class="red"><?php echo form_error('end_date'); ?></span>
                                    
                                    </div>

                                     <button type="submit" value="Save"  class="btn btn-success">Save</button>
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
   <script type="text/javascript">
     $(document).ready(function() {
     $("#start_date").datepicker();
     $("#end_date").datepicker();

		});
	</script>

