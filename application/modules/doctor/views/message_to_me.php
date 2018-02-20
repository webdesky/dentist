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
                    Mail To Me
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="notice">
                        <thead>
                            <tr class="bg-primary">
                                <th>Sr.No</th>
                                <th>From</th>
                                <th>Subject</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1; if($mail_list){ foreach ($mail_list as  $value) {?>
                            <tr class="odd gradeX">
                                <td>
                                    <?php echo $count; ?>
                                </td>
                                <td class="center">
                                    <?php echo ucwords($value->first_name.' '.$value->last_name); ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->subject;  ?>
                                </td>
                                <td class="center">
                                    <?php echo trim($value->message);  ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->created_at;  ?>
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
    $(document).ready(function(){
    $('#notice').DataTable({
        responsive:true,
    });
});
</script>