<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/scripts.js"></script>
    <title>Welcome to SNG : Hospital for the ignorant</title>
</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">Start NG Hospital</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="index.php">Home</a>
    <?php if(!isset($_SESSION['loggedIn'])){ ?>
    <a class="p-2 text-dark" href="login.php">Login</a>
    <a class="btn btn-primary" href="register.php">Register</a>
    <!--<a class="p-2 text-dark" href="forgot.php">Forgot Password</a>-->
    <?php }else{ ?>
    <a class="p-2 text-dark" href="logout.php">Logout</a>
    <a class="p-2 text-dark" href="forgot.php">Reset Password</a>
    <?php } ?>
  </nav>
  
</div>