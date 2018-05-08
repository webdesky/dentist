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
            <a class="navbar-brand" href="<?php echo base_url()?>" style="color: maroon;">Welcome, <?php echo ucwords($this->session->userdata('first_name'));?>!</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right ">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li style="font-size: 16px"><a href="<?php echo base_url('admin/profile')?>"><i class="fa fa-user fa-fw"></i> Update Profile</a>
                    </li>
                    <li style="font-size: 16px"><a href="<?php echo base_url('admin/change_password')?>"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                    </li>
                    <li class="divider"></li>
                    <li style="font-size: 16px"><a href="<?php echo base_url('admin/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
        <?php
        $user_role = $this->session->userdata('user_role');
        if ($user_role == 4) {
            $rights = explode(',', trim($this->session->userdata('rights')->rights, '"'));
            $right0 = str_split($rights[0]);
            $right1 = str_split($rights[1]);
            $right2 = str_split($rights[2]);
            $right3 = str_split($rights[3]);
            $right4 = str_split($rights[4]);
            $right5 = str_split($rights[5]);
            $right6 = str_split($rights[6]);
            $right7 = str_split($rights[7]);
            $right8 = str_split($rights[8]);
            $right9 = str_split($rights[9]);
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
                        <?php if($user_role==1){?>
                        <li> <a href="#"><i class="fa fa-hospital-o" aria-hidden="true"></i> Hospitals<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/hospitals')?>">Add Hospital</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/hospitals_list')?>">View Hospital</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users"></i> Sub Admin<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/users_list/4')?>">Manage Sub Admin</a>
                                </li>
                                <!-- <li>
                                    <a href="<?php //echo base_url('admin/subadmin_users_list/4')?>">Assign Rights</a>
                                </li> -->
                            </ul>
                        </li>
                        <?php } if($user_role==1 || ($right4[0]!=0 && $right4[1]!=0 && $right4[2]!=0)){?>
                        <li>
                            <a href="#"><i class="fa fa-user-md" aria-hidden="true"></i> Speciality<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php if($user_role==1 || $right4[0]!=0){?>
                                <li>
                                    <a href="<?php echo base_url('admin/speciality')?>">Add Speciality</a>
                                </li>
                                <?php }?>
                                <li>
                                    <a href="<?php echo base_url('admin/speciality_list/')?>">View Speciality</a>
                                </li>
                            </ul>
                        </li>
                        <?php }if($user_role==1 || ($right0[0]!=0 && $right0[1]!=0 && $right0[2]!=0)){?>
                        <li>
                            <a href="#"><i class="fa fa-user-md" aria-hidden="true"></i> Doctors<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php if($user_role==1 || ($user_role==4 && $right0[0]==1)){?>
                                <li>
                                    <a href="<?php echo base_url('admin/register/null/2')?>">Add Doctor</a>
                                </li>
                                <?php }?>
                                <li>
                                    <a href="<?php echo base_url('admin/users_list/2')?>">View Doctor</a>
                                </li>
                                <?php if($user_role==1){?>
                                <li>
                                    <a href="<?php echo base_url('admin/assign_doctor')?>">Assign Doctor to more hospital</a>
                                </li>
                                <?php }?>
                            </ul>
                        </li>
                        <?php } if($user_role==1 || ($right1[0]!=0 && $right1[1]!=0 && $right1[2]!=0)){?>
                        <li>
                            <a href="#"><i class="fa fa-wheelchair" aria-hidden="true"></i> Patients<span class="fa arrow"></span></a>
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
                        <?php }if($user_role==1 || ($right2[0]!=0 && $right2[1]!=0 && $right2[2]!=0)){?>
                        <li>
                            <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> Schedule<span class="fa arrow"></span></a>
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
                        <?php }if($user_role==1 || ($right3[0]!=0 && $right3[1]!=0 && $right3[2]!=0)){?>
                        <li>
                            <a href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Appointments<span class="fa arrow"></span></a>
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
                        <?php }if($user_role==1 || ($right4[0]!=0 && $right4[1]!=0 && $right4[2]!=0)){?>
                        <li>
                            <a href="#"><i class="fa fa-book" aria-hidden="true"></i> Prescriptions<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level treeview-menu">
                                <?php if($user_role==1 || ($user_role==4 && $right4[0]==1)){?>
                                <li>
                                    <a href="<?php echo base_url('admin/case_study/')?>">Add Patient Case Study</a>
                                </li>
                                <?php }?>
                                <li>
                                    <a href="<?php echo base_url('admin/case_study_list/')?>">Patient Case Study List</a>
                                </li>
                            </ul>
                        </li>
                        <?php }if($user_role==1 || ($right5[0]!=0 && $right5[1]!=0 && $right5[2]!=0)){?>
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
                        <?php }if($user_role==1 || ($user_role==4 && $right6[0]==1)){?>
                        <li>
                            <a href="#"><i class="fa fa-comments" aria-hidden="true"></i> Reviews<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level treeview-menu">
                                <li>
                                    <a href="<?php echo base_url('admin/review_list/')?>">Review List</a>
                                </li>
                            </ul>
                        </li>
                        <?php } if($user_role==1 || ($right7[0]!=0 && $right7[1]!=0 && $right7[2]!=0)){?>
                        <li>
                            <a href="#"><i class="fa fa-commenting" aria-hidden="true"></i> Message<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level treeview-menu">
                                <?php if($user_role==1 || ($user_role==4 && $right7[0]==1)){?>
                                <li>
                                    <a href="<?php echo base_url('admin/send_message/')?>">Send Message</a>
                                </li>
                                <?php }?>
                                <li>
                                    <a href="<?php echo base_url('admin/message_list/')?>">Message List</a>
                                </li>
                            </ul>
                        </li>
                        <?php }if($user_role==1 || ($right8[0]!=0 && $right8[1]!=0 && $right8[2]!=0)){?>
                        <li>
                            <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> Mail<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level treeview-menu">
                                <?php if($user_role==1 || ($user_role==4 && $right8[0]==1)){?>
                                <li>
                                    <a href="<?php echo base_url('admin/send_mail/')?>">Send Mail</a>
                                </li>
                                <?php }?>
                                <li>
                                    <a href="<?php echo base_url('admin/mail_list/')?>">Mail to Me</a>
                                </li>
                            </ul>
                        </li>
                        <?php }if($user_role==1 || ($user_role==4 && $right9[0]==1)){?>
                        <li>
                            <a href="#"><i class="fa fa-wrench" aria-hidden="true"></i> Inventory<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level treeview-menu">
                                <li>
                                    <a href="<?php echo base_url('admin/inventory_list/')?>">Inventory Requests</a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
    </nav>