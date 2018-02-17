<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Document</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

<style type="text/css">
    .red{
        color: red;
    }
</style>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">
            <?php if(!empty($msg)){?>
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
                    <!-- <a class="btn btn-primary" href="<?php //echo base_url('doctor/appointment_list')?>"><i class="fa fa-th-list">&nbsp;Appointment List</i></a> -->
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-2">
                            <form role="form" method="post" action="<?php echo base_url('doctor/add_document') ?>" class="registration_form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Patient * </label>
                                    <select class="form-control" name="patient_id" id="patient_id" required="required">
                                        <option>--Select Patient--</option>
                                         <?php foreach ($patient as $key => $value) { ?>
                                            <option value="<?php echo $value->id; ?>"><?php echo ucwords($value->first_name.' '.$value->last_name);?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <span class="red"><?php echo form_error('patient_id'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Description *</label>
                                    <textarea class="form-control" rows="5" id="description" name="description" placeholder="Description">
                                            </textarea>
                                    <span class="red"><?php echo form_error('description'); ?></span>
                                    <script type="text/javascript">
                                        CKEDITOR.replace('description');
                                    </script>
                                </div>

                                 <div class="form-group row">
                                    <label>Attach File *</label>
                                    
                                            <input type="file" id="file" name="file"  class="form-control">
                                        
                                         <span class="red"><?php echo form_error('file'); ?></span>
                                </div>

                                <button type="submit" value="Save" class="btn btn-success">Save</button>
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
