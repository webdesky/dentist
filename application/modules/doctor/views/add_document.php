<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Document</h1>
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
                <div class="panel-heading"> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('doctor/add_document') ?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <div class="form-group"> <label class="col-md-2">Patient * </label>
                                        <div class="col-md-6"> <select class="wide" name="patient_id" id="patient_id" required="required">
                                        <option>Select Patient</option>
                                         <?php foreach ($patient as $key => $value) { ?>
                                            <option value="<?php echo $value->id; ?>"><?php echo ucwords($value->first_name.' '.$value->last_name);?>
                                            </option>
                                        <?php } ?>
                                    </select> </div> <span class="red"><?php echo form_error('patient_id'); ?></span> </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group"> <label class="col-md-2">Description * </label>
                                        <div class="col-md-6"> <textarea class="form-control" rows="5" id="description" name="description" placeholder="Description">
                                            </textarea> </div> <span class="red"><?php echo form_error('description'); ?></span>
                                        <script type="text/javascript">
                                        CKEDITOR.replace('description');
                                        </script>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group"> <label class="col-md-2">Attach File * </label>
                                        <div class="col-md-6"> <input type="file" id="file" name="file" class="form-control"> <span class="red"><?php echo form_error('file'); ?> </div> 
                                    </div>
                                    <div class="col-md-12" align="center"> <button type="submit" value="Save" class="btn btn-success">Save</button> <button type="reset" class="btn btn-default">Reset</button> </div>
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