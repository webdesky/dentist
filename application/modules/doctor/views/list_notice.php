<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Notice Board </h1>
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
                    Notices List
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="notice">
                        <thead>
                            <tr>
                                <th>SL.No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Start Date</th>
                                <th>End date</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $count=1;
                                if($notice_list){
                                foreach ($notice_list as  $value) {
                                 ?>
                            <tr class="odd gradeX">
                                <td>
                                    <?php echo $count; ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->title; ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->description;  ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->start_date;  ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->end_date;  ?>
                                </td>
                            </tr>
                            <?php $count++; } }?>


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
    $('#notice').DataTable();

    function delete_notices(id) {
        if (confirm("Are you sure want to delete?")) {
            $.ajax({
                url: "<?php echo base_url('doctor/delete')?>",
                method: "POST",
                data: {
                    id: id,
                    table: 'notices'
                },
                success: function(response) {
                    window.location.reload();
                },

            });
        }
        return false;
    }
</script>