<?php include_once('lib/header.php');
    require_once('function/alert.php');
?>

<div class="center_div">


    <h3>Kindly Reset your password here</h3>
    <p>Provide Email Address Associated with this account</p>

    <form action="processforgot.php" method="post">
    <?php
    error();
    ?>
    
    <p>
            <label>Email</label><br />
            <input
            
            <?php              
                if(isset($_SESSION['email'])){
                    echo "value=" . $_SESSION['email'];                                                             
                }                
            ?>

             type="text" name="email" placeholder="Email"  />
        </p>
        <p>
            <button type="submit">Send Reset Code</button>
        </p>
    </form>
    </div>
    
<?php include_once('lib/footer.php'); ?>