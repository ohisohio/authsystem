<?php  include_once('lib/header.php');  ?>
<div class="login">
    <p>
        <?php 
            if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
                echo "<p class='info'>" . $_SESSION['message'] . "</span>";
                session_destroy();
            }
        ?>
    
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Welcome to SNH <br></h1>
  <h3>Hospital for the ignorant</h3>
  <p class="lead">This is a specialist hospital to cure ignorance! <br>Come as you are, it is completely free!</p>
<p>
    <a class="btn btn-bg btn-outline-secondary" href="login.php">Login</a>
    <a class="btn btn-bg btn-outline-primary" href="register.php">Register</a>
</p>

</div>


<?php include_once('lib/footer.php'); ?>

