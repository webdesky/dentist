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
                    <div class="table-responsive">
                    <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="notice">
                        <thead>
                            <tr class="bg-primary">
                                <th>Sr.No</th>
                                <th>Equipment Name</th>
                                <th>No of Equipment</th>
                                <th>Others</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1; if($inventory_list){ foreach ($inventory_list as  $value) {?>
                            <tr class="odd gradeX" id="tr_<?php echo $count?>">
                                <td>
                                    <?php echo $count; ?>
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
                                    <a href="<?php echo base_url('doctor/edit_inventory/'.$value->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                                    | 
                                    <a href="javascript:void(0)" onclick="delete_inventory('<?php echo $value->id?>','<?php echo $count?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a> 

                                </td>
                            </tr>
                            <?php $count++; }}?>
                        </tbody>
                    </table>
                </div>
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
    $('#notice').DataTable({
        responsive:true
    });
    function delete_inventory(id, tr_id) {
        swal({
            title: "Are you sure?",
            text: "Are you sure that you want to delete?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Yes, Delete it!",
            confirmButtonColor: "#ec6c62"
        }, function() {
            $.ajax({
                url: "<?php echo base_url('doctor/delete')?>",
                data: {
                    id: id,
                    table:'inventory'
                },
                type: "POST"
            }).done(function(data) {
                swal("Deleted!", "Record was successfully deleted!", "success");
                $('#tr_' + tr_id).remove();
            }).error(function(data) {
                swal("Oops", "We couldn't connect to the server!", "error");
            });
        });
    }
</script>