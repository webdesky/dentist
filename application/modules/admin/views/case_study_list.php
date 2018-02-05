

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Case Study</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<!-- row -->
 			<div class="row">
                <div class="col-lg-12">
                	  <?php if ($info_message = $this->session->flashdata('info_message')): ?>
                        <div id="form-messages" class="alert alert-success" role="alert"><?php echo $info_message; ?></div>
                    <?php endif ?> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Case Study List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Patient Name</th>
                                        <th>Problem</th>
                                        <th>Allergies</th>
                                        <th>Diabetic</th>
                                        <th>Blood Pressure</th>
                                        <th>Medical History</th>
                                        <th>Reference</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
 								$count=1;
                                if($documents_list){
                                foreach ($documents_list as  $value) { ?>
                                	<tr class="odd gradeX">
                                        <td><?php echo $count; ?></td>
                                        
                                        <td><?php echo ucwords($value->first_name.' '.$value->last_name); ?></td>
                                        <td class="center"><?php echo $value->problem; ?></td>
                                        <td class="center"><?php echo $value->allergies; ?></td>
                                        <td class="center"><?php echo $value->diabetic; ?></td>
                                        <td class="center"><?php echo $value->blood_pressure; ?></td>
                                        <td class="center"><?php echo $value->medical_history; ?></td>
                                        <td class="center"><?php echo $value->reference; ?></td>                                        
                                        <td class="center"><a href="<?php echo base_url('admin/case_study/'.$value->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href="javascript:void(0)" onclick="delete_case_study('<?php echo $value->id?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
    function delete_case_study(id) {
        if (confirm("Are you sure want to delete?")) {
            $.ajax({
                url: "<?php echo base_url('admin/delete_appointment')?>",
                method: "POST",
                data: {
                    id: id,
                    table: 'case_study'
                },
                success: function(response) {
                    window.location.reload();
                },

            });
        }
        return false;
    }
</script>
        	  

