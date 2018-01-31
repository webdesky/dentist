<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Case Study</h1>
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('doctor/case_study_list')?>"><i class="fa fa-th-list">&nbsp;Case Study List</i></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-2">
                            <form role="form" method="post" action="<?php echo base_url('doctor/case_study') ?>" class="registration_form" enctype="multipart/form-data">
                                
                                <div class="form-group">
                                    <label>Patient ID *</label>
                                    <select class="form-control" name="patient_id">
                                        <option value="">--Select Patient--</option>
                                        <?php foreach($patient as $patients){?>
                                        <option value="<?php echo $patients->id;?>"><?php echo ucwords($patients->first_name.' '.$patients->last_name);?></option>
                                        <?php }?>
                                    </select>
                                    <span class="red"><?php echo form_error('first_name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Food Allergies </label>
                                    <input class="form-control" type="text" name="allergies" placeholder="Allergies" autocomplete="off" required="required" value="<?php echo set_value('allergies'); ?>">
                                    <span class="red"><?php echo form_error('allergies'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Problem </label>
                                    <input type="text" name="problem" class="form-control" placeholder="problem" autocomplete="off" required="required" value="<?php echo set_value('problem'); ?>">
                                    <span class="red"><?php echo form_error('problem'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>High Blood Pressure *</label>
                                    <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" placeholder="Blood Pressure" required="required">
                                    <span class="red"><?php echo form_error('blood_pressure'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Diabetic *</label>
                                    <input type="text" class="form-control" name="diabetic" placeholder="Diabetic" value="<?php echo set_value('diabetic');?>">
                                    <span class="red"><?php echo form_error('diabetic'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Others</label>
                                    <input type="text" class="form-control" name="others" placeholder="Others" autocomplete="off">
                                    <span class="red"><?php echo form_error('others'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Family Medical History</label>
                                    <input type="text" class="form-control" name="medical_history" placeholder="Medical History" autocomplete="off" required="required" value="<?php echo set_value('medical_history'); ?>"> 
                                    <span class="red"><?php echo form_error('medical_history'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Reference</label>
                                    <input type="text" name="reference" id="reference" class="form-control">
                                    <span class="red"><?php echo form_error('reference'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status"  value="1" checked>Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status"  value="0">Inactive
                                    </label>
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