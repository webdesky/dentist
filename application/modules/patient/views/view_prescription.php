<style type="text/css">
.psform .col-md-2.col-sm-2 {
    width: 13.666667%;
}

.psform .manage-forms {
    width: 85.333333%;
}
</style>
<?php 
function ageCalculator($dob){
    if(!empty($dob)){
        $birthdate  = new DateTime($dob);
        $today      = new DateTime('today');
        $age        = $birthdate->diff($today)->y;
        return $age;
    }else{
        return 0;
    }
}
?>
<div class="content">
    <div class="container-fluid psform">
        <!-- content -->
        <div class="row">
            <!--  form area -->
            <div class="col-md-2 col-sm-2"></div>
            <div class="col-md-10 col-sm-10 manage-forms">
                <div class="panel panel-default thumbnail">
                    <div class="panel-heading no-print">
                        <div class="btn-group">
                            <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger"><i class="fa fa-print"></i> Print</button>
                        </div>
                    </div>
                    <div class="panel-body" id="PrintMe">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Headline -->
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="bg-primary">
                                                <td>
                                                    <strong>Patient ID</strong>:
                                                    <?php echo $prescription[0]->patient_id;?>,
                                                    <strong>App ID</strong>:
                                                    <?php echo $prescription[0]->appointment_id;?> </td>
                                                <td class="text-right"><strong>Date</strong>:
                                                    <?php echo $prescription[0]->created_at;?> </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="50%">
                                                    <ul class="list-unstyled">
                                                        <li><strong><?php echo ucwords($this->session->userdata('first_name').' '.$this->session->userdata('last_name'));?></strong></li>
                                                    </ul>
                                                </td>
                                                <td width="50%" class="text-right">
                                                <ul class="list-unstyled">
                                                    <li><strong><?php if(!empty($prescription[0]->hospital_name)){ echo ucwords($prescription[0]->hospital_name);}?></strong></li>
                                                    <li><?php if(!empty($prescription[0]->address)){ 
                                                                echo ucwords($prescription[0]->address);
                                                        }?>
                                                    </li>
                                                    <li>
                                                        <?php echo $this->session->userdata('email');?>
                                                    </li>
                                                </ul>
                                            </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-primary">
                                                <td colspan="2">
                                                    <strong>Patient  Name</strong>:
                                                    <?php echo ucwords($prescription[0]->first_name.' '.$prescription[0]->last_name);?>,
                                                    <strong>Age</strong>:
                                                    <?php   
                                                        $dob    =   $prescription[0]->date_of_birth;
                                                        echo ageCalculator($dob);
                                                    ?>,
                                                    <strong>Sex</strong>:
                                                    <?php echo $prescription[0]->gender;?>,
                                                    <strong>Weight</strong>:
                                                    <?php echo $prescription[0]->weight;?>,
                                                    <strong>BP</strong>:
                                                    <?php echo $prescription[0]->blood_pressure;?>,
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div style="float:left;width:35%;word-break:all;border-right:1px solid #e4e5e7;padding-right:10px">
                                        <!-- chief_complain -->
                                        <p>
                                            <strong>Chief Complain</strong>:
                                            <?php echo ucfirst($prescription[0]->chief_complain);?> </p>
                                        <!-- patient_notes -->
                                        <p>
                                            <strong>Patient Notes</strong>:
                                            <?php echo ucfirst($prescription[0]->patient_note);?> </p>
                                    </div>
                                    <div style="float:left;width:65%;padding-left:10px">
                                        <!-- Medicine -->
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="bg-info">
                                                    <th>Medicine Name</th>
                                                    <th width="80">Type</th>
                                                    <th width="80">Days</th>
                                                    <th>Instruction</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    if(!empty($medicine)){ 
                                                        foreach($medicine as $medicines){?>
                                                <tr>
                                                    <td>
                                                        <?php echo ucfirst($medicines->medicine_name);?>
                                                    </td>
                                                    <td>
                                                        <?php echo ucfirst($medicines->medicine_type);?>
                                                    </td>
                                                    <td>
                                                        <?php echo $medicines->days;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $medicines->instruction;?>
                                                    </td>
                                                </tr>
                                                <?php }}?>
                                            </tbody>
                                        </table>
                                        <!-- diagnosis -->
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="bg-info">
                                                    <th>Diagnosis</th>
                                                    <th>Instruction</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    if(!empty($diagnosis)){ 
                                                        foreach($diagnosis as $value){?>
                                                <tr>
                                                    <td>
                                                        <?php echo ucfirst($value->diagnosis);?>
                                                    </td>
                                                    <td>
                                                        <?php echo ucfirst($value->instruction);?>
                                                    </td>
                                                </tr>
                                                <?php }}?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- Signature -->
                                    <table class="table" style="margin-top:50px">
                                        <thead>
                                            <tr>
                                                <td style="width:50%;"></td>
                                                <td style="width:50%;text-align:center">
                                                    <div style="border-bottom:2px dashed #e4e5e7"></div>
                                                    <i>Signature</i>
                                                </td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function printContent(el) 
        {
            var restorepage  = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
            location.reload();
        }
    </script>