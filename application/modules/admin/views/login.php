<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url('asset/styles.css');?>">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .alert>p, .alert>ul {
            font-size: 17px !important;
        }
    </style>
</head>
<body>
    <div id="loing_container">
        <?php if(validation_errors()){?>
        <div class="alert alert-danger">
            <strong style="font-size: 17px;">Danger!</strong>
            <?php echo validation_errors(); ?>
        </div>
        <?php }if(!empty($msg)){?>
        <div class="alert alert-info">
            <?php echo $msg;?>
        </div>
        <?php }?>

        <form action="<?php echo base_url('admin/verifylogin')?>" method="post" class="login_form">
            <label for="name">Username:</label>
            <input type="name" id="username" name="username" autocomplete="off" required="required" placeholder="Username...">
            <label for="username">Password:</label>
            <input type="password" id="passowrd" name="password" autocomplete="off" required="required" placeholder="Password..." />
            <div id="lower"><input type="submit" value="Login" name="submit"></div>
        </form>
    </div>
</body>
</html>

