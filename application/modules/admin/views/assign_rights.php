<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sub Admin</h1>
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
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?>
            </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-primary"><i class="fa fa-th-list">&nbsp;Assign Rights</i></button>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-2">
                            <form role="form" method="post" action="<?php echo base_url('admin/addRights') ?>" class="registration_form" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                                <?php 
                                $rights = explode(',',trim($user_rights->rights,'"'));
                                $i=0;
                                foreach ($rights_menu as $menu) {
                                    
                                    $right = str_split($rights[$i]);
                            ?>

                                <div class="form-group">

                                    <label class="checkbox-inline">
                                      <b><?php echo ucfirst($menu->menu_name);?>:</b>
                                    </label>
                                    <input type="hidden" name="user_role[]" value="<?php echo $menu->menu_name;?>">
                                    <label class="checkbox-inline">
                                      <input type="checkbox" name="<?php echo $menu->menu_name;?>_add" value="1" <?php if($right[0]==1){ echo 'checked';}?>>Add
                                    </label>
                                    <label class="checkbox-inline">
                                      <input type="checkbox" name="<?php echo $menu->menu_name;?>_edit" value="1" <?php if($right[1]==1){ echo 'checked';}?>>Edit
                                    </label>
                                    <label class="checkbox-inline">
                                      <input type="checkbox" name="<?php echo $menu->menu_name;?>_delete" value="1" <?php if($right[2]==1){ echo 'checked';}?>>Delete
                                    </label>
                                </div>
                                <?php $i++;}?>
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