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
                                <form action="#" method="post" accept-charset="utf-8">
                                    <!-- Information -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="33.33%">
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <select name="patient_id" class="invoice-input form-control" onchange="get_patient_data(this.value)">
                                                                <option value="">--Select Patient--</option>
                                                                <?php foreach($patient as $value){?>
                                                                <option value="<?php echo $value->id?>"><?php echo $value->id?></option>
                                                                <?php }?>
                                                            </select>
                                                            <p class="text-danger  invlid_patient_id"></p>
                                                        </li>
                                                        <li>
                                                            <input type="text" placeholder="Patient  Name" class="invoice-input form-control" id="patient_name">
                                                        </li>
                                                        <li>
                                                            <input type="text" placeholder="Sex" class="invoice-input form-control" id="sex">
                                                        </li>
                                                        <li>
                                                            <input type="text" placeholder="Date of Birth" class="invoice-input form-control datepicker hasDatepicker" id="date_of_birth">
                                                        </li>
                                                    </ul>
                                                </th>
                                                <th width="33.33%">
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <input type="text" name="weight" placeholder="Weight" required="" class="invoice-input form-control">
                                                        </li>
                                                        <li>
                                                            <input type="text" name="blood_pressure" placeholder="Blood Pressure" class="invoice-input form-control">
                                                        </li>
                                                        <li>
                                                            <input type="text" name="reference_by" placeholder="Reference" class="invoice-input form-control">
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
                                                        <li><input type="text" name="appointment_id" value="<?php echo 'APPID'.mt_rand();?>" class="invoice-input form-control" placeholder="Appointment ID"></li>
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
                                                <th>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm caseStudyBtn" data-toggle="modal" data-target="#myModal">Case Study</button>
                                                        <select name="insurance_id" class="btn btn-sm select2">
                                                                <option value="" selected="selected">Select Insurance</option>
                                                                <option value="7">Student</option>
                                                                <option value="8">IFIC insurance</option>
                                                                <option value="9">Agrani Insurance</option>
                                                            </select>
                                                    </div>
                                                </th>
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
                                                <td><input type="text" name="medicine_name[]" autocomplete="off" class="medicine form-control" placeholder="Medicine Name"></td>
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
                                            <tr class="bg-danger">
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
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="patient_notes" class="col-xs-3 col-form-label">Patient Notes</label>
                                                <div class="col-xs-9">
                                                    <textarea name="patient_notes" class="form-control" placeholder="Patient Notes"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-offset-3 col-md-6">
                                                    <div class="ui buttons">
                                                        <button type="reset" class="ui button btn btn-default">Reset</button>
                                                        <button class="ui positive button btn btn-success">Save</button>
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
    <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Case Study</h4>
                    </div>
                    <div class="modal-body" id="caseStudyOutput">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <a href="http://hospitalnew.bdtask.com/demo6/dashboard_doctor/prescription/case_study/create" class="btn btn-primary">Add Patient Case Study</a>
                    </div>
                </div>
            </div>
        </div>
 -->

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


        $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });

    });


        function get_patient_data(id){
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('doctor/get_user')?>",
                dataType: 'json',
                data: {
                    id:id
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