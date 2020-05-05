<?php    include_once('lib/header.php');
         require_once('function/alert.php');

if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: dashboard.php");
}
// include_once('lib/header.php'); 

?>
<div class="center_div">
    <p>
        <?php 
           message(); error();
        ?>
    </p>
    <form method="POST" action="processlogin.php">
	 <fieldset>
	  <legend><h1>Log In</h1></legend>
      <p>
        <?php 
            if(isset($_SESSION['emailerr']) && !empty($_SESSION['emailerr'])){
                echo "<p class='error'>" . $_SESSION['emailerr'] . "</p>";
                session_unset();
            }
            if(isset($_SESSION['emailerrfmt']) && !empty($_SESSION['emailerrfmt'])){
                echo "<p class='error'>" . $_SESSION['emailerrfmt'] . "</p>";
                session_unset();
            }
            if(isset($_SESSION['passworderr']) && !empty($_SESSION['passworderr'])){
                echo "<p class='error'>" . $_SESSION['passworderr'] . "</p>";
                session_unset();
            }
        ?>
    </p>
               
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
            <label>Password</label><br />
            <input type="password" name="password" placeholder="Password"  />
        </p>       
       
       
        <p>
            <button type="submit">Login</button>
        </p>
	  </fieldset>
    </form>
            </div>
<?php include_once('lib/footer.php'); ?>
