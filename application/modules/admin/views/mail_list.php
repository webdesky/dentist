<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Mail List</h1>
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
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Reciever</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $count=1;
                                if($mail_list){
                                foreach ($mail_list as  $message) { ?>
                            <tr class="odd gradeX">
                                <td>
                                    <?php echo $count; ?>
                                </td>
                                <td>
                                    <?php echo $message->first_name.' '.$message->last_name; ?>
                                </td>
                                <td class="center">
                                    <?php echo $message->subject; ?>
                                </td>
                                <td class="center">
                                    <?php echo $message->message; ?>
                                </td>
                                <td class="center"><a href="javascript:void(0)" onclick="delete_mail('<?php echo $message->id?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php $count++; } }?>
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
    function delete_mail(id) {
        if (confirm("Are you sure want to delete?")) {
            $.ajax({
                url: "<?php echo base_url('admin/delete')?>",
                method: "POST",
                data: {
                    id: id,
                    table: 'mail'
                },
                success: function(response) {
                    window.location.reload();
                },

            });
        }
        return false;
    }

    $('#dataTables').DataTable();
</script>