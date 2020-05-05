<?php
include_once('lib/header.php'); 

if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}


echo "<h1>PAYMENT SUCCEEDED</h1><br>";


?>

<a href="dashboard.php">Return to Dashboard</a>