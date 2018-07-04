<style>
.manage-forms{margin-top:0}.manage-forms ul.list-unstyled li{margin-bottom:10px}.manage-forms ul.list-unstyled li .form-control{border-radius:2px;height:38px;border:1px solid #eee;box-shadow:0 0 0 1px #ccc}.manage-forms #diagnosis tr td .form-control,.manage-forms #medicine tr td .form-control{border-radius:2px;border:1px solid #eee;box-shadow:0 0 0 1px #ccc}.psform .col-md-2.col-sm-2{width:13.666667%}.psform .manage-forms{width:85.333333%}
</style>
<div class="content">
    <div class="container-fluid psform">
        <div class="row">
            <!--  form area -->
            <div class="col-md-2 col-sm-2"></div>
            <div class="col-md-10 col-sm-10 manage-forms">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> Add Prescription</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="panel panel-default thumbnail">
                    <div class="panel-heading no-print">
                        <div class="btn-group">
                            <a class="btn btn-primary" href="<?php echo base_url('pharma/prescription_list')?>"><i class="fa fa-list"></i>  Prescription List </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 table-responsive">
                                <form action="<?php echo base_url('pharma/add_billing')?>" class="registration_form1" method="post" accept-charset="utf-8">
                                    <!-- Information -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="40%">
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <select name="patient_id" class="invoice-input form-control" onchange="get_patient_data(this)">
                                                                <option value="">--Select Patient--</option>
                                                                <?php if(!empty($patient)){ foreach($patient as $value){?>
                                                                 <option value="<?php echo $value->id;?>"><?php echo ucwords($value->first_name.' '.$value->last_name);?></option>
                                                                <?php }}?>
                                                            </select>
                                                            <span class="red"><?php echo form_error('patient_id'); ?></span>
                                                        </li>
                                                        <li>
                                                            <input type="text" placeholder="Sex" class="invoice-input form-control" id="sex" name="sex">
                                                            <span class="red"><?php echo form_error('sex'); ?></span>
                                                        </li>
                                                        <li>
                                                            <input type="text" placeholder="Date of Birth" class="invoice-input form-control date" id="date_of_birth" name="date_of_birth">
                                                            <span class="red"><?php echo form_error('date_of_birth'); ?></span>
                                                        </li>
                                                    </ul>
                                                </th>

                                                <th width="33.33%">
                                                    <ul class="list-unstyled">
                                                        <li><input type="text" name="prescription_id" id="prescription_id" value="<?php echo 'PS' . mt_rand(100000, 999999);?>" class="invoice-input form-control" placeholder="Prescription ID" readonly="readonly"></li>

                                                        <li><input type="text" name="date" required="required" value="<?php echo date('Y-m-d')?>" class="invoice-input form-control" placeholder="Date" id="datepicker"></li>

                                                        <li><textarea id="address" value="" class="invoice-input form-control" placeholder="Address"></textarea></li>
                                                    </ul>
                                                </th>
                                            </tr>
                                            <!-- <tr>
                                                <th colspan="2">
                                                    <textarea type="text" required="" placeholder="Chief Complain" name="chief_complain" class="invoice-input form-control"></textarea>
                                                </th>
                                            </tr> -->
                                        </thead>
                                    </table>
                                    <!-- Medicine -->
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th width="160">Medicine Name</th>
                                                <th width="160">Medicine Type</th>
                                                <th>Instruction</th>
                                                <th width="80">Days</th>
                                                <th width="160">Add / Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody id="medicine">
                                            <tr>
                                                <td><input type="text" name="medicine_name[]" autocomplete="off" class="medicine form-control" placeholder="Medicine Name">
                                                </td>
                                                <td><input type="text" name="medicine_type[]" autocomplete="off" class="form-control" placeholder="Medicine Type"></td>
                                                <td><textarea name="medicine_instruction[]" class="form-control" placeholder="Instruction"></textarea></td>
                                                <td><input type="text" name="medicine_days[]" autocomplete="off" class="form-control" placeholder="Days"></td>
                                                <td>
                                                    <div class="btn btn-group">
                                                        <button type="button" class="btn btn-sm btn-primary MedAddBtn">Add</button>
                                                        <button type="button" class="btn btn-sm btn-danger MedRemoveBtn">Remove</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    
                                    <!-- Fees & Comments -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="patient_notes" class="col-xs-3 col-form-label">Patient Notes</label>
                                                <div class="col-xs-9">
                                                    <textarea name="patient_notes" class="form-control" placeholder="Patient Notes"></textarea>
                                                    <span class="red"><?php echo form_error('patient_notes'); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-offset-3 col-md-6">
                                                    <div class="ui buttons">
                                                        <input type="submit" name="submit" class="ui positive button btn btn-success" value="Save">&nbsp;
                                                        <button type="reset" class="ui button btn btn-default">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // medicine list
        $('body').on('keyup change click', '.medicine', function() {
            $(this).autocomplete({
                source: [
                    "Napa", "Poleka", "homena",
                ]
            });
        });

        //#------------------------------------
        //   STARTS OF MEDICINE 
        //#------------------------------------    
        //add row
        $('body').on('click', '.MedAddBtn', function() {
            var itemData = $(this).parent().parent().parent();
            $('#medicine').append("<tr>" + itemData.html() + "</tr>");
            $('#medicine tr:last-child').find(':input').val('');
        });
        //remove row
        $('body').on('click', '.MedRemoveBtn', function() {
            $(this).parent().parent().parent().remove();
        });  
    });


    function get_patient_data(str) {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('pharma/get_user')?>",
            dataType: 'json',
            data: {
                id: str.value
            },
            success: function(data) {
                if (data[0] != "") {
                    console.log(data[0]);
                    $('#sex').val(data[0].gender);
                    $('#date_of_birth').val(data[0].date_of_birth);
                    $('#address').val(data[0].address);
                }
            }
        });
    }

    function set_address(str) {
        $('#address').val(str);
    }
</script>