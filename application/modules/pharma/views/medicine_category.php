<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Medicine Category</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <?php if(validation_errors()){?>
            <div class="alert alert-danger"> <strong>Danger!</strong>
                <?php echo validation_errors(); ?> </div>
            <?php }if(!empty($msg)){?>
            <div class="alert alert-success">
                <?php echo $msg;?> </div>
            <?php }?>
            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?> </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('pharma/medicine_category_list')?>"><i class="fa fa-th-list">&nbsp;Appointment List</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <?php if(!empty($medicine_category[0])){?>
                            <form role="form" method="post" action="<?php echo base_url('pharma/medicine_category/'.$medicine_category[0]->id) ?>" class="registration_form1">
                            <?php }else{?>
                            <form role="form" method="post" action="<?php echo base_url('pharma/medicine_category') ?>" class="registration_form1">
                            <?php }?>
                                <div class="col-md-12">
                                    <div class="form-group"> <label class="col-md-2">Category Name * </label>
                                        <div class="col-md-6"><input type="text" name="category_name" class="form-control" placeholder="Category Name" value="<?php if(!empty($medicine_category[0]->category_name)){ echo $medicine_category[0]->category_name;}else{echo set_value('category_name');} ?>"> </div>
                                        <span class="red"><?php echo form_error('category_name'); ?></span> </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group"> <label class="col-md-2">Description  </label>
                                        <div class="col-md-6"> <textarea class="form-control" rows="5" id="description" name="description" placeholder="Description"><?php if(!empty($medicine_category[0]->description)){ echo $medicine_category[0]->description;}else{echo set_value('description');} ?></textarea> </div> <span><?php echo form_error('description'); ?></span> </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group"> <label class="col-md-2">Status *</label>
                                        <div class="col-md-6"> <label class="radio-inline">
                                            <input type="radio" name="status"  value="1" checked="checked">Active
                                        </label> <label class="radio-inline">
                                            <input type="radio" name="status"  value="0">Inactive
                                        </label> <span class="red"><?php echo form_error('status'); ?></span> </div>
                                    </div>
                                </div>
                                <div class="col-md-12" align="center"> <button type="submit" id="submit" value="Save" class="btn btn-success">Save</button> <button type="reset" class="btn btn-default">Reset</button> </div>
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