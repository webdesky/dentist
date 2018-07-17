<style type="text/css">
.psform .col-md-2.col-sm-2{width:13.666667%}.psform .manage-forms{width:85.333333%}
</style>

<?php
    function ageCalculator($dob)
    {
        if (!empty($dob)) {
            $birthdate = new DateTime($dob);
            $today     = new DateTime('today');
            $age       = $birthdate->diff($today)->y;
            return $age;
        } else {
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
                            <a href="javascript:history.back()" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                    <div class="panel-body" id="PrintMe">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Headline -->
                                <table class="table">
                                    <thead>
                                        <tr class="bg-primary">
                                            <td>
                                                <strong>Patient ID</strong>:
                                                <?php if(!empty($prescription[0]->patient_id)){ echo $prescription[0]->patient_id;}?>,
                                                <strong>Prescription ID</strong>:
                                                <?php if(!empty($prescription[0]->prescription_code)) { echo $prescription[0]->prescription_code;}?>
                                            </td>
                                            <td class="text-right"><strong>Date</strong>:
                                                <?php if(!empty($prescription[0]->created_at)){ echo $prescription[0]->created_at;}?>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="50%">
                                                <ul class="list-unstyled">
                                                    <li><strong><?php echo ucwords($this->session->userdata('first_name').' '.$this->session->userdata('last_name'));?></strong>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td width="50%" class="text-right">
                                                <ul class="list-unstyled">
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
                                                <?php echo ucwords($prescription[0]->patient_name);?>,
                                                <strong>Age</strong>:
                                                <?php
                                                    if(!empty($prescription[0]->date_of_birth)){
                                                        $dob    =   $prescription[0]->date_of_birth;
                                                        echo ageCalculator($dob);
                                                    }
                                                ?>,
                                                <strong>Sex</strong>:
                                                <?php if(!empty($prescription[0]->gender)){ echo $prescription[0]->gender;}?>,
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div style="float:left;width:35%;word-break:all;border-right:1px solid #e4e5e7;padding-right:10px">
                                    <p>
                                        <strong>Patient Notes</strong>:
                                        <?php if(!empty($prescription[0]->patient_note)) { echo ucfirst($prescription[0]->patient_note);}?> 
                                    </p>
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
                                                if(!empty($prescription)){ 
                                                    foreach($prescription as $medicines){ ?>
                                            <tr>
                                                <td>
                                                    <?php if(!empty($medicines->medicine_name)) { echo ucfirst($medicines->medicine_name);}?>
                                                </td>
                                                <td>
                                                    <?php if(!empty($medicines->medicine_type)) { echo ucfirst($medicines->medicine_type);}?>
                                                </td>
                                                <td>
                                                    <?php if(!empty($medicines->days)){ echo $medicines->days; }?>
                                                </td>
                                                <td>
                                                    <?php if(!empty($medicines->instruction)){ echo $medicines->instruction;}?>
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
function printContent(el) {
    var restorepage = $('body').html();
    var printcontent = $('#' + el).clone();
    $('body').empty().html(printcontent);
    document.title = "Prescription Report";
    window.print();
    $('body').html(restorepage);
    location.reload();
}
</script>

