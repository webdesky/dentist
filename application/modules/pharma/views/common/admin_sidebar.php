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
            <a class="navbar-brand" href="javascript:void(0)" style="color:red">
                <?php echo 'Welcome, '.ucwords($this->session->userdata('first_name').' '.$this->session->userdata('last_name')); ?></a>
            <!-- <br/>
                <a href="#"><i class="fa fa-circle text-success"></i>Doctor</a> -->
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i> <i class="fa fa-caret-down"></i>
                </a><b class="notification_count" style="display: none"></b>
                <ul class="dropdown-menu dropdown-user">
                    <li style="font-size: 16px"><a href="<?php echo base_url('pharma/view_prescribed_medicine')?>"><i class="fa fa-user fa-fw"></i> You have new prescription notification</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li style="font-size: 16px"><a href="<?php echo base_url('pharma/profile')?>"><i class="fa fa-user fa-fw"></i> Update Profile</a>
                    </li>
                    <li style="font-size: 16px"><a href="<?php echo base_url('pharma/change_password')?>"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                    </li>
                    <li class="divider"></li>
                    <li style="font-size: 16px"><a href="<?php echo base_url('pharma/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                        <a href="<?php echo base_url('pharma/dashboard')?>"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-calendar"></i> Billing<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('pharma/add_billing/')?>">Add New Bill</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('pharma/list_billing/')?>">View All Bills</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-book" aria-hidden="true"></i> Hospital Activity<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level treeview-menu">
                            <li>
                                <a href="<?php echo base_url('pharma/medicine_category/')?>">Add Medicine Category</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('pharma/medicine_category_list/')?>">Medicine Category List</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bell" aria-hidden="true"></i> NoticeBoard<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level treeview-menu">
                            <li>
                                <a href="<?php echo base_url('pharma/notices_list/')?>">Notice List</a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-commenting" aria-hidden="true"></i> Message<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level treeview-menu">
                            <li>
                                <a href="<?php echo base_url('pharma/send_message/')?>">Send Message</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('pharma/message_list/')?>">Message List</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> Mail<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level treeview-menu">
                            <li>
                                <a href="<?php echo base_url('pharma/send_mail/')?>">Compose</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('pharma/mail_list_me/')?>">Inbox</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('pharma/mail_list/')?>">Outbox</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench" aria-hidden="true"></i> Inventory<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level treeview-menu">
                            <li>
                                <a href="<?php echo base_url('pharma/add_inventory/')?>">Inventory Request</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('pharma/inventory_list/')?>">Inventory Request by Me</a>
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
        .notification_count{position:absolute;top:0;right:7px;background:red;display:block;width:20px;color:#fff;line-height:20px;height:19px;font-size:13px;text-align:center;border-radius:50%}
    </style>

    <script type="text/javascript">
        setInterval(function() {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('pharma/get_prescription_from_doc')?>",
                datatype: "Json",
                success: function(data) {
                    if (data > 0) {
                        $('.notification_count').show();
                        $('.notification_count').html(data);
                    } else {
                        $('.notification_count').hide();
                    }
                }
            });
        }, 10000);
    </script>