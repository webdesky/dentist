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
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="<?php echo base_url('patient/profile')?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="<?php echo base_url('patient/change_password')?>"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url('admin/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                                <a href="<?php echo base_url('patient/prescription_list')?>"><i class="fa fa-dashboard fa-fw"></i> Prescription List</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-pencil-square"></i> Appointment <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                             <li>
                                <a href="<?php echo base_url('patient/addAppointment') ?>"><i class="fa fa-bar-chart-o fa-fw"></i>Add Appointment<span class="fa arrow"></span></a>

                            </li>
                            
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Appointment <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('patient/appointment_list') ?>"><i class="fa fa-bar-chart-o fa-fw"></i> Appointment List<span class="fa arrow"></span></a>
                            </li>
                            
                        </ul>
                    </li>
                    
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>