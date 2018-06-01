<style type="text/css">

#notification-header {
    background: #17eccf;
    padding: 10px;
    text-align:right;
}
button#notification-icon {
    background: transparent;
    border: 0;
    position:relative;
    cursor:pointer;
}
#notification-count{
    position: absolute;
    left: 0px;
    top: 0px;
    font-size: 0.8em;       
    color: #de5050;
    font-weight:bold;
}
#form-header {
    font-size:1.5em;
}
#frmNotification {
    padding:20px 30px;
}
.form-row{
    padding-bottom:20px;
}
#btn-send {
    background: #258bdc;
    color: #FFF;
    padding: 10px 40px;
    border: 0px;
}
div.demo-content input[type='text'],textarea{
    width: 100%;
    padding: 10px 5px;
}
#notification-latest {
    color: white;
    position: absolute;
    right: 0px;
    background: #17eccf;
    box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.20);        
    max-width: 250px;
    text-align: left;
}
.notification-item {
    padding:10px;
    border-bottom: #3ae2cb 1px solid;
    cursor:pointer;
}
.notification-subject {     
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.notification-comment {     
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  font-style:italic;
}
</style>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            <a class="navbar-brand" href="javascript:void(0)" style="color:red"><?php echo 'Welcome, '. ucwords($this->session->userdata('first_name')); ?></a>
        </div>
        <!-- /.navbar-header -->
        <?php
             $notification = $this->session->userData('notification');
        ?>
        <ul class="nav navbar-top-links navbar-right">
     
                     <i class="fa fa-bell fa-lg dropbtn " aria-hidden="true" onclick="get_notification()">
                     <span class="badge badge-notify"><?php echo $notification;  ?></span></i>
                     <div id="notification-latest" style="display: none;"><ul></ul></div>
                
             <!-- <span class="badge"></span></span> -->
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw" ></i> <i class="fa fa-caret-down"></i>
                    </a>
                <ul class="dropdown-menu dropdown-user">
                    <li style="font-size: 16px">
                        <a href="<?php echo base_url('patient/profile')?>"><i class="fa fa-user fa-fw"></i> Update Profile</a>
                    </li>
                    <li style="font-size: 16px">
                        <a href="<?php echo base_url('patient/change_password')?>"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                    </li>
                    <li class="divider"></li>
                    <li style="font-size: 16px">
                        <a href="<?php echo base_url('admin/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>

        <!-- /.navbar-top-links -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav sidebar-menu" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="<?php echo base_url('patient/appointment_list') ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <!--  <a href="<?php echo base_url('/patient/patient_status')?>"><i class="fa fa-dashboard fa-fw"></i> Status</a> -->
                        <a href="#"><i class="fa fa-file-text"></i> Documents<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('patient/add_document')?>">Add Documents</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('patient/document_list')?>">Documents List</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-book"></i> Prescription<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('patient/prescription_list')?>">Prescription List</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> Appointment <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('patient/addAppointment')?>">Take Appointment<span class="fa arrow"></span></a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('patient/appointment_list')?>">Appointment List<span class="fa arrow"></span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
    <script type="text/javascript">
        
        function get_notification(){
            var read = "<?php echo base_url('patient/read_notification')?>";
            $.ajax({
            type: "GET",
            url: "<?php echo base_url('patient/get_notification')?>",
            
                success: function(data) {
                    
                    var obj = JSON.parse(data);
                   
                    $('#notification-latest').html('');
                    for (var i = 0; i < obj.length; i++) {
                    $('#notification-latest').append("<div class='notification-item'><a href="+ read +'/' + obj[i].id +"><div class='notification-comment'>" +obj[i].updated_by+ "<span>has changes your appointment Schedule</span></div></a></div>");
                    $('#notification-latest').show();
                    }
                    
                }
            });
        }

    </script>