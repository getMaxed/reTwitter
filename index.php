<?php
ob_start();
require "main/init.php";
if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            .fieldset-auto-width {
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <!--LOGIN FORM-->
        <div class="login-wrapper">
            <?php include 'includes/login.php';?>
        </div>
        <!--SIGNUP FORM-->
        <div class="signup-wrapper">
            <?php include 'includes/signup-form.php';?>
        </div>
    </body>
</html>