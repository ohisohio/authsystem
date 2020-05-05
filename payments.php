<?php include_once('lib/header.php'); 
require_once('function/alert.php');


if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}
?>
    <h3>Kindly Pay your Bills Here</h3>
    <p>
        <?php 
           message(); error();
        ?>
    <form action="processpay.php" method="POST">
<div class="center_div">

                               
    <p>
    <input type="hidden" name="first_name" 
                <?php 
                if(isset($_SESSION["first_name"])){
                    echo("value=" . $_SESSION["first_name"]);
                }
                
                ?>
                 >                          
                <input type="hidden" name="last_name" 
                <?php 
                if(isset($_SESSION["last_name"])){
                    echo("value=" . $_SESSION["last_name"]);
                }
                
                ?>
                 >               
                
                <input type="hidden" name="email" 
                <?php 
                if(isset($_SESSION["email"])){
                    echo("value=" . $_SESSION["email"]);
                }
                
                ?>
                
                 >
                                               
        
    </p>
    <p>
        <?php
$txgen = 0;
$numbers = ['1','2','3','4','5','6','7','8','9','0'];
			for ($i = 0 ; $i < 10; $i++){
				$index = mt_rand(0,count($numbers) -1);
				$txgen .= $numbers[$index];
            }
            
            $transID = 'rave-'. $txgen;
        ?>
        <input type="hidden" value= <?php echo $transID; ?> name="transactionID">
    </p>
    <p>
    <label for="">What are you paying for?</label><br />
    <input type="text" name="narration" placeholder="Narration of payment">
    </p>
 
    <p>
            <label>Department</label><br />
            <select name = "department">
            <option value="">Select One</option>
                <option 
                <?php              
                    if(isset($_SESSION['department']) && $_SESSION['department'] == 'General Consultation'){
                        echo "selected";                                                           
                    }                
                ?>
                value="2000">General Consultation (NGN2,000)</option>
                <option
                <?php              
                    if(isset($_SESSION['department']) && $_SESSION['department'] == 'Emergency Services'){
                        echo "selected";                                                           
                    }                
                ?>
                value="1000">Emergency Services(NGN1,000)</option>
                <option
                <?php              
                    if(isset($_SESSION['department']) && $_SESSION['department'] == 'Lab Services'){
                        echo "selected";                                                           
                    }                
                ?>
                value="5000">Lab Services(NGN5,000)</option>
                <option
                <?php              
                    if(isset($_SESSION['department']) && $_SESSION['department'] == 'Xray'){
                        echo "selected";                                                           
                    }                
                ?>
                value="10000">Xray(NGN10,000)</option>
            </select>
        </p>
        <p>
            <button type="submit" name="submit">Pay Bill</button>
        </p>
    </form>
    </div>

    
<?php include_once('lib/footer.php'); ?>