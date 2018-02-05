<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Inventory Request</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <style type="text/css">
        .red {
            color: red;
        }
    </style>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/add_inventory')?>"><i class="fa fa-th-list">&nbsp;Inventory Request</i></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-2">
                            <form role="form" method="post" action="<?php echo base_url('admin/add_inventory/'.$inventory[0]->id) ?>" class="registration_form">
                                <div class="form-group">
                                    <label>Equipment Name *</label>
                                    <input class="form-control" type="text" name="equipment_name" placeholder="Equipment Name" autocomplete="off" required="required" value="<?php echo $inventory[0]->equipment_name; ?>">
                                    <span class="red"><?php echo form_error('equipment_name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>No of Equipment *</label>
                                    <input type="text" name="no_of_equipment" class="form-control" placeholder="No of Equipment" autocomplete="off" required="required" value="<?php echo $inventory[0]->no_of_equipment; ?>">
                                    <span class="red"><?php echo form_error('no_of_equipment'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Others</label>
                                    <textarea name="others" class="form-control"><?php echo $inventory[0]->others;?></textarea>
                                    <span class="red"><?php echo form_error('others'); ?></span>
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