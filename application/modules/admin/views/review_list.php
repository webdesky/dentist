<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Review</h1>
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
                    <button class="btn btn-primary"><i class="fa fa-th-list">&nbsp;Review List</i></button>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="notice">
                        <thead>
                            <tr class="bg-primary">
                                <th>Sr.No</th>
                                <th>Patient Name</th>
                                <th>Doctor Name</th>
                                <th>Rating</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1; if(!empty($review)) { foreach ($review as $key => $value) {
                            ?>
                            <tr class="odd gradeX" id="tr_<?php echo $count;?>">
                                <td>
                                    <?php echo $count; ?>
                                </td>
                                <td class="center">
                                    <?php if(!empty($value['patient_first_name'])){ echo ucwords($value['patient_first_name']);}  ?>
                                </td>
                                <td class="center">
                                    <?php if(!empty($value['doctor_first_name'])){ echo ucwords($value['doctor_first_name']);} ?>
                                </td>
                                <td class="center">
                                    <div class="star-rating">
                                         <?php $rating= $value['rating']; 
                                        for ($i=1; $i <=$rating ; $i++) { ?>
                                        <span class="fa fa-star-o" data-rating="1" style="font-size:25px;"></span>
                                       <?php }?>         
                                    </div>
                                   
                                </td>
                                <td class="center">
                                    <?php echo $value['created_at'];  ?>
                                </td>
                                <td>
                                <?php if($value['is_active']==0){?>
                                    <button class="btn btn-danger" onclick="updateStatus('<?php echo $value['id'] ?>','<?php echo $value['is_active'] ?>')">Pending</button>
                                <?php }else{ ?>
                                     <button class="btn btn-success" onclick="updateStatus('<?php echo $value['id'] ?>','<?php echo $value['is_active'] ?>')">Approved</button>
                                <?php } ?>
                                </td>
                                <td class="center"><a href="<?php echo base_url('admin/view_review/').$value['id']; ?>"><i class="fa fa fa-eye" aria-hidden="true"></i></a></td> 
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
    function updateStatus(id, active) {
    if (active == 0) {
        data = 1;
    } else {
        data = 0;
    }
    swal({
        title: "Are you sure?",
        text: "You want to Change Status?",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Yes, Change it!",
        confirmButtonColor: "#ec6c62"
    }, function() {
        $.ajax({
            url: "<?php echo base_url('admin/update_review')?>",
            data: {
                id: id,
                active: data,
            },
            type: "POST"
        }).done(function(data) {
            swal("Changed!", "Status was successfully changed!", "success");
            window.location.reload();
        });
    });
}
</script>