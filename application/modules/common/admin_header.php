<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dentist Admin Panel</title>
    <link href="<?php echo base_url('asset/jquery-ui.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('asset/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('asset/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('asset/vendor/metisMenu/metisMenu.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('asset/dist/css/sb-admin-2.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('asset/dist/css/dataTables.bootstrap.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('asset/vendor/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('asset/timepicker.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('asset/ckeditor/styles.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('asset/dataTables.min.css'); ?>" rel="stylesheet">
    
    <script src="<?php echo base_url('asset/js/jquery.js');?>"></script>
    <script src="<?php echo base_url('asset/js/jquery-ui.js');?>"></script>
    <script src="<?php echo base_url('asset/vendor/bootstrap/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('asset/js/datatable.js')?>"></script>
    <script src="<?php echo base_url('asset/js/timepicker.js')?>"></script>
    <script src="<?php echo base_url('asset/ckeditor/ckeditor.js'); ?>"></script>
    <script src="<?php echo base_url('asset/js/validation.js');?>"></script>
    <script src="<?php echo base_url('asset/dist/js/dataTables.bootstrap.js')?>"></script>

    <style>
    .registration_form {
        width: 500px;
    }
    .registration_form label {
        width: 250px;
    }
    .registration_form label.error, .registration_form input.submit {
        color: red;
        
    }


    @media (max-width: 767px) {

        #page-wrapper .panel-default .form-group .form-control {
                width: 63%;
                max-width: 100%;
        }

    }

    
    </style>
    
    
</head>
<body>