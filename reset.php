<?php include_once('lib/header.php');
require_once('function/alert.php');


if(!isset($_SESSION["loggedin"]) && !isset($_GET['token']) && !isset($_SESSION['token'])){
    $_SESSION['error'] = "You are not authorised to view this page";
    header("Location: login.php");


}



?>

<div class="center_div">



    <h3>Kindly Reset your password here</h3>
    <p>Provide Email Address Associated with this account</p>

    <form action="processreset.php" method="post">
<p>
<?php
    error(); message();
?>

</p>

<?php if(!$_SESSION['loggedin']) {?>
<p>
    <input 
    <?php
    if(isset($_SESSION['token'])){
            echo "value='" . $_SESSION['token'] . "'";
    }else{
        echo "value='" . $_GET['token'] . "'";
    }
    
    ?>
    type="hidden" value="<?php echo $_GET['token'] ?>" name="token">

<?php } ?>
</p>

    <p>
            <label>Email</label><br />
            <input value="[email]" type="text" name="email" placeholder="Email"  />
        </p>
        <p>
            <label for="">Enter New Password</label><br>
            <input type="password" name="password" placeholder="Enter new password">
        </p>
        <p>
            <button type="submit">Reset Password</button>
        </p>
    </form>
    </div>
    
<?php include_once('lib/footer.php'); ?>