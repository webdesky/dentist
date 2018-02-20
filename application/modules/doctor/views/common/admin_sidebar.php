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
                    <li style="font-size: 15px"><a href="<?php echo base_url('doctor/profile')?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li style="font-size: 15px"><a href="<?php echo base_url('doctor/change_password')?>"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                    </li>
                    <li class="divider"></li>
                    <li style="font-size: 15px"><a href="<?php echo base_url('doctor/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                        <a href="<?php echo base_url('doctor/dashboard')?>"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-wheelchair-alt" aria-hidden="true"></i> Patients<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level treeview-menu">
                            <li>
                                <a href="<?php echo base_url('doctor/register/')?>">Add Patients</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('doctor/users_list/')?>">View Patients</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-file-text" aria-hidden="true"></i> Document<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level treeview-menu">
                            <li>
                                <a href="<?php echo base_url('doctor/add_document/')?>">Add Document</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('doctor/document_list/')?>">Document List</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-pencil-square" aria-hidden="true"></i> Appointment<span class="fa arrow"></span></a>
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
                        <a href="#"><i class="fa fa-calendar"></i> Schedule<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                        
                            <li>
                                <a href="<?php echo base_url('doctor/Schedule/')?>">Add Schedule</a>
                            </li>
                      
                            <li>
                                <a href="<?php echo base_url('doctor/list_schedule/')?>">View Schedule</a>
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
                                <a href="<?php echo base_url('doctor/add_prescription/');?>">Add Prescription</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('doctor/prescription_list/');?>">Prescription List</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bell" aria-hidden="true"></i> NoticeBoard<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level treeview-menu">
                                <!-- <li>
                                    <a href="<?php //echo base_url('admin/notices/')?>">Add Notice</a>
                                </li> -->
                                <li>
                                    <a href="<?php echo base_url('doctor/notices_list/')?>">Notice List</a>
                                </li>
                                
                            </ul>
                        </li>
                    <li>
                        <a href="#"><i class="fa fa-commenting" aria-hidden="true"></i> Message<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level treeview-menu">
                            <li>
                                <a href="<?php echo base_url('doctor/send_message/')?>">Send Message</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('doctor/message_list/')?>">Message List</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> Mail<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level treeview-menu">
                            <li>
                                <a href="<?php echo base_url('doctor/send_mail/')?>">Send Mail</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('doctor/mail_list/')?>">Mail by Me</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('doctor/mail_list_me/')?>">Mail to Me</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-wrench" aria-hidden="true"></i> Inventory<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level treeview-menu">
                            <li>
                                <a href="<?php echo base_url('doctor/add_inventory/')?>">Inventory Request</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('doctor/inventory_list/')?>">Inventory Request by Me</a>
                            </li>
                            
                        </ul>
                    </li>


                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>