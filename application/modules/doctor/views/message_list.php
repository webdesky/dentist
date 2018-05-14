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
                    <a class="btn btn-primary" href="<?php echo base_url('doctor/send_message')?>"><i class="fa fa-list">&nbsp;</i>Add Message</a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="notice">
                            <thead>
                                <tr class="bg-primary">
                                    <th>Sr.No</th>
                                    <th>To</th>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count=1; if($messages_list){ foreach ($messages_list as  $value) {?>
                                <tr class="odd gradeX" id="tr_<?php echo $count?>">
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
                                        <?php echo $value->message;  ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->message_date;  ?>
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
    $(document).ready(function() {
        $('#notice').DataTable({
            responsive: true,
            'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [-1] /* 1st one, start by the right */
            }]
        });
    });
</script>