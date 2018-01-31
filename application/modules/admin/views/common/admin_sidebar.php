
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
                <a class="navbar-brand" href="<?php echo base_url()?>">Dentist</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url('admin/profile')?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="<?php echo base_url('admin/change_password')?>"><i class="fa fa-gear fa-fw"></i> Settings</a>
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
                    <ul class="nav" id="side-menu">
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
                            <a href="<?php echo base_url('/admin/')?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        
                        <!-- <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Doctors<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php //echo base_url('admin/add_doctor') ?>">Add Doctor</a>
                                </li>
                                <li>
                                    <a href="<?php //echo base_url('admin/get_doctor') ?>">Doctor List</a>
                                </li>
                            </ul>
                           
                        </li>
                       
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Patients<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php //echo base_url('admin/register/')?>">Add Patients</a>
                                </li>
                                <li>
                                    <a href="<?php //echo base_url('admin/users_list/')?>">View Patients</a>
                                </li>
                                
                            </ul>
                          
                        </li> -->

                          <li>
                            <a href="#"><i class="fa fa fa-user-md"></i> Doctor<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/register/null/2')?>">Add Doctor</a>
                                </li>
                                 <li>
                                    <a href="<?php echo base_url('admin/users_list/2')?>">View Doctor</a>
                                </li> 

                            </ul>
                        </li>

                         <li>
                            <a href="#"><i class="fa fa-wheelchair"></i> Patient<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/register/null/3')?>">Add Patient</a>
                                </li>
                                 <li>
                                    <a href="<?php echo base_url('admin/users_list/3')?>">View Patient</a>
                                </li> 

                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-calendar"></i> Schedule<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/Schedule/')?>">Add Schedule</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/list_schedule/')?>">View Schedule</a>
                                </li>

                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-pencil"></i> Appointment<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/Appointment/')?>">Add Appointment</a>
                                </li>
                                 <li>
                                    <a href="<?php echo base_url('admin/appointment_list/')?>">View Appointment</a>
                                </li> 

                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-book" aria-hidden="true"></i> Prescription<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level treeview-menu">
                                <li>
                                    <a href="<?php echo base_url('admin/case_study/')?>">Add Patient Case Study</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/case_study_list/')?>">Patient Case Study List</a>
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
                            <a href="#"><i class="fa fa-bell" aria-hidden="true"></i> NoticeBoard<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level treeview-menu">
                                <li>
                                    <a href="<?php echo base_url('admin/notices/')?>">Add Notice</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/notices_list/')?>">Notice List</a>
                                </li>
                                
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa fa-user-md"></i> Sub Admin<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/register/null/4')?>">Add Sub Admin</a>
                                </li>
                                 <li>
                                    <a href="<?php echo base_url('admin/users_list/4')?>">View Sub Admin</a>
                                </li> 

                                 <li>
                                     <a href="#"><i class="fa fa fa-user"></i>Assign Rights <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                           <a href="<?php echo base_url('admin/subadmin_users_list/4')?>">View Sub Admin</a>
                                        </li> 
                                        <li>
                                            <a href="#">Patient</a>
                                        </li>
                                        
                                    </ul>
                                   
                                </li> 

                            </ul>
                        </li>

                        

                       
                        <!-- <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                    </ul>
                                   
                                </li>
                            </ul>
                            
                        </li> -->
                        <!-- <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="blank.html">Blank Page</a>
                                </li>
                                <li>
                                    <a href="login.html">Login Page</a>
                                </li>
                            </ul> -->
                            <!-- /.nav-second-level -->
                        <!-- </li> -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>


