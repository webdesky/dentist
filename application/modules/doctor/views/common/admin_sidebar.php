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
                <a class="navbar-brand" href="javascript:void(0)"><?php echo ucwords($this->session->userdata('first_name').' '.$this->session->userdata('last_name')); ?></a>
                <!-- <br/>
                <a href="#"><i class="fa fa-circle text-success"></i>Doctor</a> -->
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url('doctor/profile')?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="<?php echo base_url('doctor/change_password')?>"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('doctor/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu" class="sidebar-menu">
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
                            <a href="<?php echo base_url('')?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-wheelchair"></i> Patients<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level treeview-menu">
                                <li>
                                    <a href="<?php echo base_url('doctor/register/')?>">Add Patients</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('doctor/users_list/')?>">View Patients</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('doctor/add_document/')?>">Add Document</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('doctor/document_list/')?>">Document List</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-edit" aria-hidden="true"></i> Appointment<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level treeview-menu">
                                <li>
                                    <a href="<?php echo base_url('doctor/Appointment/')?>">Add Appointment</a>
                                </li>
                                 <li>
                                    <a href="<?php echo base_url('doctor/appointment_list/')?>">View Appointment</a>
                                </li> 

                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-book" aria-hidden="true"></i> Prescription<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level treeview-menu">
                                <li>
                                    <a href="<?php echo base_url('doctor/case_study/')?>">Add Patient Case Study</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('doctor/case_study_list/')?>">Patient Case Study List</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Add Prescription</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Prescription List</a>
                                </li> 
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> Message<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level treeview-menu">
                                <li>
                                    <a href="<?php echo base_url('doctor/send_message/')?>">Send Message</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('doctor/message_list/')?>">Message List</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>


<style type="text/css">
.sidebar-menu .treeview-menu {
    position: relative;
    display: none;
    list-style: none;
    padding: 5px 0 10px;
    margin: 0;
    padding-left: 35px;
    
}
    /*.sidebar-menu .treeview-menu > li > a {
    padding: 5px 5px 5px 20px;
    display: block;
    color: #a6a6a6;
    letter-spacing: 0.3px;
}
.sidebar-menu .treeview-menu > li::before {
    left: 0;
    top: 13px;
    width: 15px;
    content: ' ';
    position: absolute;
    display: inline-block;
    border: 1px solid rgba(59, 70, 72, 0.5);
}*/
</style>