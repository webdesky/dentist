<style>
    .manage-forms {
        margin-top: 0;
    }

    .manage-forms ul.list-unstyled {}

    .manage-forms ul.list-unstyled li {
        margin-bottom: 10px;
    }

    .manage-forms ul.list-unstyled li .form-control {
        border-radius: 2px;
        height: 38px;
        border: solid 1px #eee;
        box-shadow: 0px 0px 0px 1px #ccc;
    }

    .manage-forms #medicine tr td .form-control {
        border-radius: 2px;
        border: solid 1px #eee;
        box-shadow: 0px 0px 0px 1px #ccc;
    }

    .manage-forms #diagnosis tr td .form-control {
        border-radius: 2px;
        border: solid 1px #eee;
        box-shadow: 0px 0px 0px 1px #ccc;
    }
    .psform .col-md-2.col-sm-2 {           
        width: 13.666667%;
    }

    .psform .manage-forms {
        width: 85.333333%;
    }
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
                            <a class="btn btn-primary" href="#"> <i class="fa fa-list"></i>  Prescription List </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 table-responsive">
                                <form action="<?php echo base_url('doctor/add_prescription')?>" class="registration_form1" method="post" accept-charset="utf-8">
                                    <!-- Information -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="33.33%">
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <select name="patient_id" class="invoice-input wide" onchange="get_patient_data(this)">
                                                                <option value="">--Select Patient--</option>
                                                                <?php if(!empty($patient)){ foreach($patient as $value){?>
                                                                 <option value="<?php echo $value->id;?>"><?php echo ucwords($value->first_name.' '.$value->last_name);?></option>
                                                                <?php }}?>
                                                            </select>
                                                            <span class="red"><?php echo form_error('patient_id'); ?></span>
                                                        </li>
                                                        <li>
                                                            <input type="text" placeholder="Patient  Name" class="invoice-input form-control" id="patient_name" name="patient_name">
                                                            <span class="red"><?php echo form_error('patient_name'); ?></span>
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
                                                        <li>
                                                            <input type="text" name="weight" placeholder="Weight" required="required" class="invoice-input form-control">
                                                            <span class="red"><?php echo form_error('weight'); ?></span>
                                                        </li>
                                                        <li>
                                                            <input type="text" name="blood_pressure" placeholder="Blood Pressure" class="invoice-input form-control">
                                                            <span class="red"><?php echo form_error('blood_pressure'); ?></span>
                                                        </li>
                                                        <li>
                                                            <input type="text" name="reference_by" placeholder="Reference" class="invoice-input form-control">
                                                            <span class="red"><?php echo form_error('reference_by'); ?></span>
                                                        </li>
                                                        <li>
                                                            <div class="form-check form-control invoice-input">
                                                                <label class="radio-inline" style="padding:0 10px 0 0 ">Type </label>
                                                                <label class="radio-inline"><input type="radio" name="patient_type" value="New" checked="">New</label>
                                                                <label class="radio-inline"><input type="radio" name="patient_type" value="Old">Old</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </th>
                                                <th width="33.33%">
                                                    <ul class="list-unstyled">
                                                        <li><input type="text" name="appointment_id" id="appointment_id" value="" class="invoice-input form-control" placeholder="Appointment ID"></li>
                                                        <li><input type="text" name="date" required="required" value="<?php echo date('Y-m-d')?>" class="invoice-input form-control" placeholder="Date" id="datepicker"></li>
                                                        <li><input type="text" value="Demo Hospital Limited" class="invoice-input form-control" placeholder="Hospital Name"></li>
                                                        <li><input type="text" value="105, Magnet Tower, Indore, 452001" class="invoice-input form-control" placeholder="Address"></li>
                                                    </ul>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="2">
                                                    <textarea type="text" required="" placeholder="Chief Complain" name="chief_complain" class="invoice-input form-control"></textarea>
                                                </th>
                                                <!-- <th>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm caseStudyBtn" data-toggle="modal" data-target="#myModal">Case Study</button>
                                                        <select name="insurance_id" class="btn btn-sm select2">
                                                                <option value="" selected="selected">Select Insurance</option>
                                                                <option value="7">Student</option>
                                                                <option value="8">IFIC insurance</option>
                                                                <option value="9">Agrani Insurance</option>
                                                            </select>
                                                    </div>
                                                </th> -->
                                            </tr>
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


                                    <!-- diagnosis -->
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th width="230">Diagnosis</th>
                                                <th>Instruction</th>
                                                <th width="160">Add / Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody id="diagnosis">
                                            <tr>
                                                <td><input type="text" name="diagnosis_name[]" autocomplete="off" class="form-control" placeholder="Diagnosis"></td>
                                                <td><textarea name="diagnosis_instruction[]" class="form-control" placeholder="Instruction"></textarea></td>
                                                <td>
                                                    <div class="btn btn-group">
                                                        <button type="button" class="btn btn-sm btn-primary DiaAddBtn">Add</button>
                                                        <button type="button" class="btn btn-sm btn-danger DiaRemoveBtn">Remove</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>


                                    <!-- Fees & Comments -->
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <div class="form-group row">
                                                <label for="visiting_fees" class="col-xs-3 col-form-label">Visiting Fees</label>
                                                <div class="col-xs-9">
                                                    <input name="visiting_fees" type="text" class="form-control" id="visiting_fees" placeholder="Visiting Fees">
                                                    <span class="red"><?php echo form_error('visiting_fees'); ?></span>
                                                </div>
                                            </div>

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
                                                        <button type="reset" class="ui button btn btn-default">Reset</button>
                                                        <input type="submit" name="submit" class="ui positive button btn btn-success" value="Save">
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
    <!-- Modal -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('select').niceSelect();
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

            //#------------------------------------
            //   STARTS OF DIAGNOSIS 
            //#------------------------------------    
            //add row
            $('body').on('click', '.DiaAddBtn', function() {
                var itemData = $(this).parent().parent().parent();
                $('#diagnosis').append("<tr>" + itemData.html() + "</tr>");
                $('#diagnosis tr:last-child').find(':input').val('');
            });
            //remove row
            $('body').on('click', '.DiaRemoveBtn', function() {
                $(this).parent().parent().parent().remove();
            });


            //#------------------------------------
            //   ENDS OF PATIENT INFORMATION
            //#------------------------------------


        //$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });

        $("#datepicker").datetimepicker({
            format: 'YYYY/MM/DD'
        });

    });


        function get_patient_data(str){
            var appointment_id = $(str).find(':selected').data("appointment");
            $('#appointment_id').val(appointment_id);
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('doctor/get_user')?>",
                dataType: 'json',
                data: {
                    id:str.value
                },
                success: function(data) {
                    if(data[0]!=""){
                        var first_name =  data[0].first_name.toUpperCase();
                        var last_name  =  data[0].last_name.toUpperCase();
                        $('#patient_name').val(first_name+' '+last_name);    
                        $('#sex').val(data[0].gender);  
                        $('#date_of_birth').val(data[0].date_of_birth);
                    }       
                }
            });
        }
    </script>

</div>