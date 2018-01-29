<!doctype html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url('asset/animate.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('asset/styles.css');?>">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div id="loing_container">
        <?php if(validation_errors()){?>
        <div class="alert alert-danger">
            <strong>Danger!</strong>
            <?php echo validation_errors(); ?>
        </div>
        <?php }if(!empty($msg)){?>
        <div class="alert alert-success">
            <?php echo $msg;?>
        </div>
        <?php }?>
<<<<<<< HEAD
        <form action="<?php echo base_url('admin/verifylogin')?>" method="post" id="login">
            <label for="name">Username:</label>
            <input type="name" id="username" name="username" autocomplete="off" required="required" placeholder="Username" required="required">
            <label for="username">Password:</label>
            <input type="password" id="passowrd" name="password" autocomplete="off" required="required" placeholder="Password" required="required"/>
=======
        <form action="<?php echo base_url('admin/verifylogin')?>" method="post">
            <label for="name">Username:</label>
            <input type="name" id="username" name="username" autocomplete="off" required="required" placeholder="Username">
            <label for="username">Password:</label>
            <input type="password" id="passowrd" name="password" autocomplete="off" required="required" placeholder="Password" />
>>>>>>> 0786823f878c3f8c24f632c1152420691182d40e
            <div id="lower">
                <input type="submit" value="Login" name="submit">
            </div>
        </form>
    </div>
</body>

</html>

<style type="text/css">
    body {
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;background-color:#eee;
          }
</style>