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

    .registration_form1 .form-group {
        margin-bottom: 15px;
        overflow: hidden;

    }
</style>

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
                            <form role="form" method="post" action="<?php echo base_url('admin/case_study') ?>" class="registration_form1" enctype="multipart/form-data">
                            
                            <div class="col-md-6">  
                                <div class="form-group">
                                    <label class="col-md-3">Doctor ID *</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="doctor_id">
                                            <option value="">--Select Doctor--</option>
                                            <?php foreach($doctor as $doctors){?>
                                            <option value="<?php echo $doctors->id;?>"><?php echo ucwords($doctors->first_name.' '.$doctors->last_name);?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <span class="red"><?php echo form_error('doctor_id'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Patient ID *</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="patient_id">
                                            <option value="">--Select Patient--</option>
                                            <?php foreach($patient as $patients){?>
                                            <option value="<?php echo $patients->id;?>"><?php echo ucwords($patients->first_name.' '.$patients->last_name);?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <span class="red"><?php echo form_error('patient_id'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Food Allergies </label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="allergies" placeholder="Allergies" autocomplete="off" required="required" value="<?php echo set_value('allergies'); ?>">
                                    </div>
                                    <span class="red"><?php echo form_error('allergies'); ?></span>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Problem </label>
                                    <div class="col-md-9">
                                        <input type="text" name="problem" class="form-control" placeholder="problem" autocomplete="off" required="required" value="<?php echo set_value('problem'); ?>">
                                    </div>
                                    <span class="red"><?php echo form_error('problem'); ?></span>
                                </div>
                            </div>
                               
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label class="col-md-3">High Blood Pressure *</label>
                                     <div class="col-md-9">
                                        <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" placeholder="Blood Pressure" required="required">
                                    </div>
                                    <span class="red"><?php echo form_error('blood_pressure'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label class="col-md-3">Diabetic *</label>
                                      <div class="col-md-9">
                                          <input type="text" class="form-control" name="diabetic" placeholder="Diabetic" value="<?php echo set_value('diabetic');?>">
                                     </div>
                                    <span class="red"><?php echo form_error('diabetic'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label class="col-md-3">Others</label>
                                     <div class="col-md-9">
                                         <input type="text" class="form-control" name="others" placeholder="Others" autocomplete="off">
                                     </div>
                                    <span class="red"><?php echo form_error('others'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label class="col-md-3">Family Medical History</label>
                                    <div class="col-md-9">
                                         <input type="text" class="form-control" name="medical_history" placeholder="Medical History" autocomplete="off" required="required" value="<?php echo set_value('medical_history'); ?>"> 
                                     </div>
                                    <span class="red"><?php echo form_error('medical_history'); ?></span>
                                </div>
                            </div>

                              <div class="col-md-6"> 
                                <div class="form-group">
                                    <label class="col-md-3">Reference</label>
                                    <div class="col-md-9">
                                        <input type="text" name="reference" id="reference" class="form-control">
                                    </div>
                                    <span class="red"><?php echo form_error('reference'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Status</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="status"  value="1" checked>Active
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status"  value="0">Inactive
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" align="center">
                                <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
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
     $(document).ready(function(){
            
            $(".registration_form").validate({
                rules :{
                    "doctor_id"    :"required",
                    "patient_id"    :"required",
                   
                },
             submitHandler : function(form) {
                form.submit();
                }
            });

         

        });
</script>