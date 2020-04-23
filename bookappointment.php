<?php include_once('lib/header.php');
if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}

//TODO Check and prevent submission of an empty form, Valaidation happens here

?>
<div class="login">
	<form method="POST" action="processappointment.php">
		<fieldset>
	  		<legend><h1>Book Appointment</h1></legend>
		   		<p>All Fields are required</p>
                <?php
                if(isset($_SESSION["error"])){
                        echo("<span style='color:red'>".$_SESSION["error"]."</span>");
                        unset($_SESSION["error"]);
                }   
                ?>

                <?php
                if(isset($_SESSION["message"])){
                        echo("<span style='color:green'>".$_SESSION["message"]."</span>");
                        unset($_SESSION["message"]);
                }   
                ?>
                
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
                                               
        <p>
            <label>Choose Appointment Date</label><br />
            <input type="date" name="appdate" />
        </p>
        <p>
            <label>Choose Appointment Time</label><br />
            <select name="time" >
                <option value="">Select a Time Slot</option>
                <option value = "Morning - 9am - 11am">Morning - 9am - 11am</option>
                <option value = "Noon - 2pm - 4pm">Noon - 2pm - 4pm</option>
                <option value = "Evening - 6pm - 8pm">Evening - 6pm - 8pm</option>
            </select>
        </p>
       
        <p>
            <label>Nature of Appointment</label><br />
            <select name="appointmentnature" >
            
                <option value="">Select One</option>
                <option value = "New Appointment">New Appointment</option>
                <option value = "Follow-up Appointment">Follow-up Appointment</option>
            </select>
        </p>
        <p>
            <label>Department</label><br />
            <select name = "department">
            <option value="">Select One</option>
                <option value = "General Consultation">General Consultation</option>
                <option value = "Emergency Services">Emergency Services</option>
                <option value = "Lab Services">Lab Services</option>
                <option value = "Xray">Xray</option>
            </select>
        </p>
        <p>
            <label>Initial Complaints/Symptoms</label><br />
            <input type="textarea" name="initialcomplaint" placeholder="State your Complaints" />
        </p>
        <p>
            <button type="submit">Book Appointment</button>
        </p>
		</fieldset>
    </form>
<?php include_once('lib/footer.php'); ?>
