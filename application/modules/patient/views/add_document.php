<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <?php   if(isset($edit_doc_id)){
                        echo '<h1 class="page-header">Edit Document</h1>';
                    }else{
                        echo '<h1 class="page-header">Add Document</h1>';
                    }
            ?>
        </div>
        <!-- /.col-lg-12 -->
    </div>
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
                    <a class="btn btn-primary" href="<?php echo base_url('patient/document_list')?>"><i class="fa fa-th-list">&nbsp;Document List</i></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <?php if(isset($edit_doc_id)){?>
                            <form role="form" method="post" action="<?php echo base_url().'patient/edit_document/'.$edit_doc_id ?>" class="registration_form1" enctype="multipart/form-data">
                                <?php }else{?>
                            <form role="form" method="post" action="<?php echo base_url('patient/add_document') ?>" class="registration_form1" enctype="multipart/form-data">
                                    <?php }?>
                                <div class="form-group">
                                    <label class="col-md-2">Doctor * </label>
                                    <div class="col-lg-6">
                                        <select class="wide" name="doctor_id" id="doctor_id">
                                            <option>--Select Doctor--</option>
                                            <?php foreach ($doctor as $key => $value) { ?>
                                            <option value="<?php echo $value->id; ?>" <?php if(!empty($edit_document_data[0]->doctor_id)){ if($value->id==$edit_document_data[0]->doctor_id){ echo "selected";}}?>>
                                                <?php echo ucwords($value->first_name.' '.$value->last_name);?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <span class="red"><?php echo form_error('doctor_id'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Description * </label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" rows="5" id="description" name="description" placeholder="Description"><?php if(!empty($edit_document_data[0]->description)){ echo $edit_document_data[0]->description;}?></textarea>
                                        <span class="red"><?php echo form_error('description'); ?></span>
                                        <script type="text/javascript">
                                            CKEDITOR.replace('description');
                                        </script>
                                    </div>
                                </div>
                                <div class="clearfix"></div><br/>
                                <div class="form-group">
                                    <label class="col-md-2">Attach File * </label>
                                    <div class="col-lg-6">
                                        <input type="file" id="file" name="file" class="form-control"> <span><?php if(!empty($edit_document_data[0]->file)){ echo $edit_document_data[0]->file;}?>
                                            </span> <span class="red"><?php echo form_error('file'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12" align="center">
                                    <?php if(isset($edit_doc_id)){?>
                                    <button type="submit" value="Save" class="btn btn-success">Update</button>
                                    <?php }else{?>
                                    <button type="submit" value="Save" class="btn btn-success">Save</button>
                                    <?php }?>
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
    $('select').niceSelect();
</script>
