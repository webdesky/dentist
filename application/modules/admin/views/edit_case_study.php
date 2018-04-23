<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Case Study</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/case_study_list')?>"><i class="fa fa-th-list">&nbsp;Case Study List</i></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">

                            <form role="form" method="post" action="<?php echo base_url('admin/case_study/'.$case_study[0]->id) ?>" class="registration_form1" enctype="multipart/form-data">

                                <div class="form-group"> <label class="col-md-2">Patient * </label>
                                    <div class="col-lg-6"> <select class="form-control" name="patient_id">
                                        <option value="">--Select Patient--</option>
                                        <?php foreach($patient as $patients){?>
                                        <option value="<?php echo $patients->id;?>" <?php if($case_study[0]->patient_id==$patients->id){ echo 'selected';}?>><?php echo ucwords($patients->first_name.' '.$patients->last_name);?></option>
                                        <?php }?>
                                    </select>
                                        <span class="red"><?php echo form_error('patient_id'); ?></span> </div>
                                </div>

                                <div class="form-group"> <label class="col-md-2">Food Allergies * </label>
                                    <div class="col-lg-6"> <input class="form-control" type="text" name="allergies" placeholder="Allergies" autocomplete="off" required="required" value="<?php echo $case_study[0]->allergies; ?>">
                                        <span class="red"><?php echo form_error('allergies'); ?></span> </div>
                                </div>

                                <div class="form-group"> <label class="col-md-2">Problem * </label>
                                    <div class="col-lg-6"> <input type="text" name="problem" class="form-control" placeholder="problem" autocomplete="off" required="required" value="<?php echo $case_study[0]->problem; ?>">
                                        <span class="red"><?php echo form_error('problem'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">High Blood Pressure * </label>
                                    <div class="col-lg-6"> <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" placeholder="Blood Pressure" required="required" value="<?php echo $case_study[0]->blood_pressure;?>">
                                        <span class="red"><?php echo form_error('blood_pressure'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Diabetic * </label>
                                    <div class="col-lg-6"> <input type="text" class="form-control" name="diabetic" placeholder="Diabetic" value="<?php echo $case_study[0]->diabetic;?>">
                                        <span class="red"><?php echo form_error('diabetic'); ?> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Others * </label>
                                    <div class="col-lg-6">  <input type="text" class="form-control" name="others" placeholder="Others" autocomplete="off" value="<?php echo $case_study[0]->others?>">
                                    <span class="red"><?php echo form_error('others'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Family Medical History * </label>
                                    <div class="col-lg-6"> <input type="text" class="form-control" name="medical_history" placeholder="Medical History" autocomplete="off" required="required" value="<?php echo $case_study[0]->medical_history; ?>"> <span class="red"><?php echo form_error('medical_history'); ?></span> </div>
                                </div>

                                <div class="form-group"> <label class="col-md-2">Reference * </label>
                                    <div class="col-lg-6"> <input type="text" name="reference" id="reference" class="form-control" value="<?php echo $case_study[0]->reference;?>">
                                        <span class="red"><?php echo form_error('reference'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Status * </label>
                                    <div class="col-lg-6"> <label class="radio-inline">
                                        <input type="radio" name="status"  value="1" <?php if($case_study[0]->is_active=='1'){ echo 'checked';}?>>Active
                                    </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="status"  value="0" <?php if($case_study[0]->is_active=='0'){ echo 'checked';}?>>Inactive
                                    </label> </div>
                                </div>
                                <div class="col-md-12" align="center"> <input type="submit" name="submit" class="btn btn-success" value="Submit"> <input type="reset" class="btn btn-default" value="Reset"> </div>

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