<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Mail Board </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?>
            </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Mail List
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="notice">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Doctor Name</th>
                                <th>Equipment Name</th>
                                <th>No of Equipment</th>
                                <th>Others</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1; if($inventory_list){  foreach ($inventory_list as  $value) {?>
                            <tr class="odd gradeX">
                                <td>
                                    <?php echo $count; ?>
                                </td>
                                <td class="center">
                                    <?php echo ucwords($value->first_name.' '.$value->last_name); ?>
                                </td>
                                <td class="center">
                                    <?php echo ucwords($value->equipment_name); ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->no_of_equipment;  ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->others;  ?>
                                </td>
                                 <td class="center">
                                    <?php if($value->is_active==1){ echo 'active';}else{ echo 'deactive';}  ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->created_at;  ?>
                                </td>
                                <td class="center"> 
                                   <!--  <a href="<?php //echo base_url('admin/edit_inventory/'.$value->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                                    |  -->
                                    <a href="javascript:void(0)" onclick="delete_inventory('<?php echo $value->id?>')"><i class="fa fa-trash-o" aria-hidden="true" title="delete"></i></a>
                                    |
                                    <a href="javascript:void(0)" onclick="update_inventory_status('<?php echo $value->id?>')"><i class="fa fa-hourglass-start" title="change status"></i></a>
                                </td>
                            </tr>
                            <?php $count++; }}?>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>

<script type="text/javascript">
    $('#notice').DataTable();
    function delete_inventory(id) {
        if (confirm("Are you sure want to delete?")) {
            $.ajax({
                url: "<?php echo base_url('admin/delete')?>",
                method: "POST",
                data: {
                    id: id,
                    table:'inventory'
                },
                success: function(response) {
                    window.location.reload();
                },

            });
        }
        return false;
    }

    function update_inventory_status(id){
        if (confirm("Are you sure want to Change Status?")) {
            $.ajax({
                url: "<?php echo base_url('admin/change_status')?>",
                method: "POST",
                data: {
                    id: id,
                    table:'inventory'
                },
                success: function(response) {
                    window.location.reload();
                },

            });
        }
        return false;

    }
</script>