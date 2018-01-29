

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
                            <button class="btn btn-primary"><i class="fa fa-th-list">&nbsp;Edit Schedule</i></button>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-2">
                                    <form role="form" method="post" action="<?php echo base_url('admin/addSchedule/'.$schedule[0]->doctor_id) ?>" class="registration_form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Doctor Name </label>
                                             <select class="form-control" name="doctor_id">
                                                <option>Select Doctor</option>
                                                 <?php foreach ($doctor as $key => $value) { ?>
                                                      <option value="<?php echo $value->id; ?>" <?php if($schedule[0]->doctor_id==$value->id){ echo 'selected';}?>><?php echo $value->first_name; ?></option>
                                                <?php } ?>
                                             </select>
                                            <span><?php echo form_error('fk_doctor_id'); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Available Days</label>
                                            <?php  foreach ($schedule as $key => $value) {

                                                 // echo "<pre>";
                                                 // print_r($schedule);
                                                ?>
                                                
                                              
                                            <div class="col-lg-12">
                                                <div class="col-lg-4">
                                            <select class="form-control" name="schedule[]" >

                                                
                                                <option value="sunday"  <?php if($schedule[$key]->day=='sunday'){ echo 'selected';}?>>Sunday</option>
                                                <option value="Monday" <?php if($schedule[$key]->day=='monday'){ echo 'selected';}?>>Monday</option>
                                                <option value="tuesday" <?php if($schedule[$key]->day=='tuesday'){ echo 'selected';}?>>Tuesday</option>
                                                <option value="wednesday" <?php if($schedule[$key]->day=='wednesday'){ echo 'selected';}?>>Wednesday</option>
                                                <option value="thursday" <?php if($schedule[$key]->day=='thursday'){ echo 'selected';}?>>Thursday</option>
                                                <option value="friday" <?php if($schedule[$key]->day=='friday'){ echo 'selected';}?>>Friday</option>
                                                <option value="saturday" <?php if($schedule[$key]->day=='saturday'){ echo 'selected';}?>>Saturday</option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="text" id="starttime" name="starttime[]" value="<?php echo $schedule[$key]->starttime; ?>" class="form-control date" autocomplete="off" readonly="readonly"  placeholder="Start Time">
                                        </div>
                                        <div class="col-lg-3">
                                             <input type="text" id="endtime" name="endtime[]" value="<?php echo $schedule[$key]->endtime; ?>" class="form-control date" autocomplete="off" readonly="readonly"  placeholder="Start Time">
                                         </div>

                                         

                                         </div>

                                         <?php   } ?>
                                         <div class="col-lg-4 col-lg-offset-10">
                                               <i class="fa fa-plus" aria-hidden="true" id="add"></i>
                                         </div>

                                         <!-- lg 12 ends -->

                                            <div id="app"></div>
                                        </div>
                                        

                                        <!-- <div class="form-group row">
                                            <label>Available Time</label>
                                            <div class="col-lg-12">
                                                <div class="col-lg-6">
                                                  <input type="text" id="startdate" name="startdate" class="form-control" autocomplete="off" readonly="readonly"  placeholder="Start Time">
                                              </div>
                                              <div class="col-lg-6">
                                                <input type="text" id="enddate"  placeholder="End Time" name="enddate" class="form-control" autocomplete="off" readonly="readonly" required="required" >
                                            </div>
                                            </div>
                                           
                                        </div> -->
                                            
                                         <!-- <div class="form-group row">
                                            <label>Per Patient Time</label>
                                          
                                                
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
                                       -->
                                        
                                       
                                        
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
                <!-- /.col-lg-12 --
            </div>
            <!-- row -->

 </div>
</div>
     
        <script type="text/javascript">
                $(document).ready(function(){
                     
                        $("#add").click(function(){

                            $("#app").append('<div class="col-lg-12"><div class="col-lg-4"><select class="form-control " name="schedule[]" ><option>Select Option</option><option value="sunday">Sunday</option><option value="Monday">Monday</option><option value="tuesday">Tuesday</option><option value="wednesday">Wednesday</option><option value="thursday">Thursday</option><option value="friday">Friday</option><option value="saturday">Saturday</option></select></div> <div class="col-lg-3"><input type="text" id="starttime" name="starttime[]" class="form-control date" autocomplete="off" readonly="readonly"  placeholder="Start Time"></div><div class="col-lg-3"><input type="text" id="endtime" name="endtime[]" class="form-control date" autocomplete="off" readonly="readonly"  placeholder="Start Time"></div></div>');


                                     $('.date').each(function(){
                                        $(this).timepicker();
                                    });

                        });

                      
            
                });
       
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
            $('.date').each(function(){
                        $(this).timepicker();
                    });
        });
        </script>

        <<!-- script type="text/javascript">
            $(document).ready(function() {
                $("#starttime").timepicker();
                $("#endtime").timepicker();
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
</script> -->