<!DOCTYPE html>
<html>

<head>
    <title> Hospital </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url('asset/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/dist/css/styles.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/animate.css')?>">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body>
    <header id="header2">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-3">
                    <div class="col-xs-6 col-sm-4 toggle-img">
                        <img src="<?php echo base_url('asset/images/toggle.png')?>" alt="toggle">
                    </div>

                    <div class="col-xs-6 col-sm-8 logos">
                        <img src="<?php echo base_url('asset/images/logo_2.png')?>" alt="toggle">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-5">
                    <form class="form-inline" action="/action_page.php">
                        <div class="form-group">
                            <label for="email"><img src="<?php echo base_url('asset/images/location.png')?>" alt="location"></label>
                            <input type="email" class="form-control" id="email" placeholder="Indore">
                            <img src="<?php echo base_url('asset/images/area.png')?>">
                        </div>
                        <div class="form-group second-search">
                            <label for="pwd"><img src="<?php echo base_url('asset/images/search.png')?>"></label>

                            <select class="form-control">
                  <option>Dentist</option>
                  <option>Dentist</option>
                  <option>Dentist</option>
                  <option>Dentist</option>
                </select>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-4 login">
                    <ul>
                        <li>
                            <div class="dropdown">
                                <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown">For Clinic & Hospital <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-m"><a href="#">HTML</a></li>
                                    <li class="dropdown-m"><a href="#">CSS</a></li>
                                    <li class="dropdown-m"><a href="#">JavaScript</a></li>
                                </ul>
                            </div>
                        </li>
                        <!-- <li class="sign-up">
                            <a href="#">Login </a>
                        </li> -->

                        <?php if(!empty($this->session->userdata('id')) && $this->session->userdata('user_role')==3){
                            echo '<li> <div class="dropdown"><a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" style="color:white"> Welcome.. '.ucfirst($this->session->userdata('first_name').' '.$this->session->userdata('last_name')).'</a>';?>
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('patient/dashboard');?>">Dashboard</a></li>
                                <li><a href="<?php echo base_url('admin/logout');?>">Logout</a></li>
                              </ul>
                            </div>
                        <?php }else{?>
                        <li class="sign-up"><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"><span><i class="fa fa-sign-in" aria-hidden="true"></i></span> Login / Sign Up</a></li>
                        <?php }?>

                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="clearfix"></div>