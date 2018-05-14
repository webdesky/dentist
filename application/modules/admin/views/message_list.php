<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Message Board </h1>
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
                    <a class="btn btn-primary" href="<?php echo base_url('admin/send_message')?>"><i class="fa fa-th-list">&nbsp;Send Message </i></a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%" id="notice">
                        <thead>
                            <tr class="bg-primary">
                                <th>Sr.No</th>
                                <th>To</th>
                                <th>Subject</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1; if(!empty($messages_list)) {  foreach ($messages_list as  $value) {

                              ?>
                            <tr class="odd gradeX" id="tr_<?php echo $count;?>">
                                <td>
                                    <?php echo $count; ?>
                                </td>
                                <td class="center">
                                    <?php echo ucwords($value->first_name); ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->subject;  ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->message;  ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->created_at;  ?>
                                </td>
                                 <td class="center"><a href="javascript:void(0)" onclick="delete_message('<?php echo $value->id?>','<?php echo $count;?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
    function delete_message(id,tr_id) {
        swal({
            title: "Are you sure?",
            text: "want to delete?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Yes, Delete it!",
            confirmButtonColor: "#ec6c62"
        }, function() {
            $.ajax({
                url: "<?php echo base_url('admin/delete')?>",
                data: {
                    id: id,
                    table: 'message'
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
   /* $('#notice').DataTable({
        responsive: true
    });*/

$(document).ready(function() {
    $('#notice').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        },
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': [-1] /* 1st one, start by the right */
        }]
    });
});

</script>