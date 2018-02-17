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

        <ul class="nav navbar-top-links navbar-right ">

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

        <?php 
            $user_role  =   $this->session->userdata('user_role'); 
            if($user_role==4){
                $rights     =   explode(',',trim($this->session->userdata('rights')->rights,'"'));   
                $right0     =   str_split($rights[0]);
                $right1     =   str_split($rights[1]);
                $right2     =   str_split($rights[2]);
                $right3     =   str_split($rights[3]);
                $right4     =   str_split($rights[4]);
                $right5     =   str_split($rights[5]);
            }
        ?>


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
                        <a href="<?php echo base_url('admin/index')?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                
                    <li>
                        <a href="#"><i class="fa fa-user-md"></i> Doctor<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                        <?php if($user_role==1 || ($user_role==4 && $right0[0]==1)){?>
                            <li>
                                <a href="<?php echo base_url('admin/register/null/2')?>">Add Doctor</a>
                            </li>
                        <?php }?>
                            <li>
                                <a href="<?php echo base_url('admin/users_list/2')?>">View Doctor</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-wheelchair"></i> Patient<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                        <?php if($user_role==1 || ($user_role==4 && $right1[0]==1)){?>
                            <li>
                                <a href="<?php echo base_url('admin/register/null/3')?>">Add Patient</a>
                            </li>
                        <?php }?>
                            <li>
                                <a href="<?php echo base_url('admin/users_list/3')?>">View Patient</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-calendar"></i> Schedule<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                        <?php if($user_role==1 || ($user_role==4 && $right2[0]==1)){?>
                            <li>
                                <a href="<?php echo base_url('admin/Schedule/')?>">Add Schedule</a>
                            </li>
                        <?php }?>
                            <li>
                                <a href="<?php echo base_url('admin/list_schedule/')?>">View Schedule</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-pencil"></i> Appointment<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                        <?php if($user_role==1 || ($user_role==4 && $right3[0]==1)){?>
                            <li>
                                <a href="<?php echo base_url('admin/Appointment/')?>">Add Appointment</a>
                            </li>
                        <?php }?>
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
                        <?php if($user_role==1 || ($user_role==4 && $right4[0]==1)){?>
                            <!-- <li>
                                <a href="javascript:void(0)">Add Prescription</a>
                            </li> -->
                        <?php }?>
                           <!--  <li>
                                <a href="javascript:void(0)">Prescription List</a>
                            </li> -->
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-bell" aria-hidden="true"></i> NoticeBoard<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level treeview-menu">
                        <?php if($user_role==1 || ($user_role==4 && $right5[0]==1)){?>
                            <li>
                                <a href="<?php echo base_url('admin/notices/')?>">Add Notice</a>
                            </li>
                        <?php }?>
                            <li>
                                <a href="<?php echo base_url('admin/notices_list/')?>">Notice List</a>
                            </li>

                        </ul>
                    </li>

                    <?php if($user_role==1){?>

                    <li>
                        <a href="#"><i class="fa fa-users"></i> Sub Admin<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('admin/register/null/4')?>">Add Sub Admin</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/users_list/4')?>">View Sub Admin</a>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-users"></i> Rights <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="<?php echo base_url('admin/subadmin_users_list/4')?>">Assign Rights</a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-commenting" aria-hidden="true"></i> Message<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level treeview-menu">
                            <li>
                                <a href="<?php echo base_url('admin/send_message/')?>">Send Message</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/message_list/')?>">Message List</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> Mail<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level treeview-menu">
                            <li>
                                <a href="<?php echo base_url('admin/send_mail/')?>">Send Mail</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/mail_list/')?>">Mail to Me</a>
                            </li>
                            <!-- <li>
                                <a href="<?php //echo base_url('admin/mail_list_me/')?>">Mail to Me</a>
                            </li> -->
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-wrench" aria-hidden="true"></i> Inventory<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level treeview-menu">
                            <li>
                                <a href="<?php echo base_url('admin/inventory_list/')?>">Inventory Requests</a>
                            </li>
                            
                        </ul>
                    </li>

                    <?php }?>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>