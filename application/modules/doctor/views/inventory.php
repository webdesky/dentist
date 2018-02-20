<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Inventory Request</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('doctor/add_inventory')?>"><i class="fa fa-th-list">&nbsp;Inventory Request</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('doctor/add_inventory') ?>" class="registration_form1">
                                <div class="col-md-12">
                                    <div class="form-group"> <label class="col-md-2">Equipment Name * </label>
                                        <div class="col-md-6"> <input class="form-control" type="text" name="equipment_name" placeholder="Equipment Name" autocomplete="off" required="required" value="<?php echo set_value('equipment_name'); ?>"> </div> <span class="red"><?php echo form_error('equipment_name'); ?></span> </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group"> <label class="col-md-2">No of Equipment * </label>
                                        <div class="col-md-6"> <input type="text" name="no_of_equipment" class="form-control" placeholder="No of Equipment" autocomplete="off" required="required" value="<?php echo set_value('no_of_equipment'); ?>"> </div> <span class="red"><?php echo form_error('no_of_equipment'); ?></span> </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group"> <label class="col-md-2">Others * </label>
                                        <div class="col-md-6"> <textarea name="others" class="form-control"></textarea> </div> <span class="red"><?php echo form_error('others'); ?></span> </div>
                                </div>
                                <div class="col-md-12" align="center"> <input type="submit" name="submit" class="btn btn-success" value="Save"> <button type="reset" class="btn btn-default">Reset</button> </div>
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