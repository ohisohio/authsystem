<?php include_once('lib/header.php'); 

if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}

               
//LAST LOGIN
$UserPath = "db/login/".$_SESSION['email'].".json";
$userlogin = json_decode(file_get_contents($UserPath));
$dblogin = $userlogin->last_login
?>

<p>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Patient Dashboard <br></h1>
  <h3 class="p-2 text-dark">Welcome <?php echo $_SESSION['first_name']." ".$_SESSION['last_name']; ?>! <a href="logout.php">Log Out</a></h3>
  <p>
		<a class="btn btn-bg btn-primary" href="bookappointment.php">Book Appointment</a>
    <a class="btn btn-bg btn-outline-secondary" href="payments.php">Pay Bills</a>
</p>
</div>
</p>
	
	<?php
                if(isset($_SESSION["message"])){
                        echo("<span style='color:green'>".$_SESSION["message"]."</span>");
                        unset($_SESSION["message"]);
                }   
?>
<main>
<table class="masterlist">
			<tr>
				<th>My Details</th>
				<th></th>
			</tr>
			<tr>
				<td>Full Name</td>
				<td><?php echo $_SESSION['first_name']." ".$_SESSION['last_name']; ?></td>
			</tr>
			<tr>
				<td>Your User ID</td>
				<td><?php echo $_SESSION['loggedIn'] ?></td>
			</tr>
			<tr>
				<td>User Access Level: </td>
				<td>General Access</td>
			</tr>
			<tr>
				<td>Email</td>
				<td><?php echo $_SESSION['email'] ?></td>
			</tr>
			<tr>
				<td>Department</td>
				<td><?php echo $_SESSION['department'] ?></td>
			</tr>
			<tr>
				<td>Registration Date</td>
				<td><?php echo $_SESSION['reg_date'] ?></td>
			</tr>
			<tr>
				<td>Last Login</td>
				<td><?php echo $dblogin; ?></td>
			</tr>
		</table>

		
		

</main>

</body>


</html>
