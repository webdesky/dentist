

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Schedule</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>


             <!-- /.row -->
            <div class="row">
                
                <div class="col-lg-12">
                    <?php if(validation_errors()){?>
                            <div class="alert alert-danger">
                                <strong>Danger!</strong>
                                <?php echo validation_errors(); ?>
                            </div>
                            <?php }if(!empty($msg)){?>
                            <div class="alert alert-success">
                                <?php echo $msg;?>
                            </div>
                            <?php }?>

                     <?php if ($info_message = $this->session->flashdata('info_message')): ?>
                        <div id="form-messages" class="alert alert-success" role="alert"><?php echo $info_message; ?></div>
                    <?php endif ?> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button class="btn btn-primary"><i class="fa fa-th-list">&nbsp;Add Schedule</i></button>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-2">
                                    <form role="form" method="post" action="<?php echo base_url('admin/addSchedule') ?>" class="registration_form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Doctor Name </label>
                                             <select class="form-control" name="fk_doctor_id">
                                                <option>Select Doctor</option>
                                                 <?php foreach ($doctor as $key => $value) { ?>
                                                      <option value="<?php echo $value['doctor_id']; ?>"><?php echo $value['doctor_fname'].' '.$value['doctor_lname']; ?></option>
                                                <?php } ?>
                                             </select>
                                            <span><?php echo form_error('fk_doctor_id'); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Available Days</label>
                                            <select class="form-control" name="schedule[]" multiple="multiple">
                                                <option>Select Option</option>
                                                <option value="sunday">Sunday</option>
                                                <option value="Monday">Monday</option>
                                                <option value="tuesday">Tuesday</option>
                                                <option value="wednesday">Wednesday</option>
                                                <option value="thursday">Thursday</option>
                                                <option value="friday">Friday</option>
                                                <option value="saturday">Saturday</option>
                                                
                                            </select>
                                        </div>

                                        <div class="form-group row">
                                            <label>Available Time</label>
                                            <div class="col-lg-12">
                                                <div class="col-lg-6">
                                                  <input type="text" id="startdate" name="startdate" class="form-control" autocomplete="off" readonly="readonly"  placeholder="Start Time">
                                              </div>
                                              <div class="col-lg-6">
                                                <input type="text" id="enddate"  placeholder="End Time" name="enddate" class="form-control" autocomplete="off" readonly="readonly" required="required" >
                                            </div>
                                            </div>
                                           
                                        </div>
                                            
                                         <div class="form-group row">
                                            <label>Available Time</label>
                                          
                                                
                                                  <input type="text" id="timepicker" name="time" class="form-control" autocomplete="off" readonly="readonly"  placeholder="Start Time">
                                           </div>
                                           
                                        <div class="form-group">
                                            <label>Status</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="doctor_status"  value="1" checked>Active
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="doctor_status"  value="0">Inactive
                                            </label>
                                            
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
        $(document).ready(function(){
            $(".registration_form").validate({
                rules :{
                    "fname" :"required",
                    
                    
                },
            submitHandler : function(form) {
                form.submit();
            }
            });

        });

        </script>

        <script type="text/javascript">
    $(document).ready(function() {
        $("#startdate").datepicker();
        $("#enddate").datepicker();
         $('#timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 60,
            minTime: '10',
            maxTime: '6:00pm',
            defaultTime: '11',
            startTime: '10:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
                 });
    });
</script>