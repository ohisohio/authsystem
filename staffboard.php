<?php include_once('lib/header.php'); 

if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}
//LAST LOGIN
$UserPath = "db/login/".$_SESSION['email'].".json";
$userlogin = json_decode(file_get_contents($UserPath));
$dblogin = $userlogin->last_login;

?>

<p>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Staff Dashboard <br></h1>
  <h3 class="p-2 text-dark">Welcome <?php echo $_SESSION['first_name']." ".$_SESSION['last_name']; ?>! <a href="logout.php">Log Out</a></h3>
</div>
</p>
	
	<main>
<table class="table">
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
<br>

</main>

<div class="container">
<h3>TABLE OF PATIENT APPOINTMENTS</h3>

<?php

$appointmentrecord = scandir("db/appointment/");
$numofappoint = count($appointmentrecord);
$exactcount = $numofappoint - 2;
if ($exactcount == 0){
	echo("<h4>You have no pending appointments</h4>");

}else{

	$temp = "<table class='table'>";
	$temp .= "<tr><th>NAME</th>";
	$temp .= "<th>EMAIL</th>";
	$temp .= "<th>DATE</th>";
	$temp .= "<th>TIME</th>";
	$temp .= "<th>NATURE OF APPOINTMENT</th>";
	$temp .= "<th>INITIAL COMPLAINT</th>";
	$temp .= "<th>DEPARTMENT</th>";
	$temp .= "<th>PAYMENT STATUS</th></tr>";

	


	for ($counter = 0; $counter < $numofappoint ; $counter++) {
   
		$Userfiles = $appointmentrecord[$counter];
	
		if($Userfiles != "." && $Userfiles != ".."){
		  //Retrieve Patients Appointment details
			$userString = file_get_contents("db/appointment/".$Userfiles);
			$userDetails = json_decode($userString, TRUE);
		
		
			$name=$userDetails["name"];
			$email=$userDetails["email"];
			$dept=$userDetails["department"];
			$date=$userDetails["appdate"];
			$nature=$userDetails["appointmentnature"];
			$time=$userDetails["time"];
			$comp=$userDetails["initialcomplaint"];

			$payrecord = scandir("db/payment_success/");
			$numofpay = count($payrecord);
			
		
	for ($i = 0; $i < $numofpay ; $i++) {	   
			$Ufiles = $payrecord[$counter];
		
			if($Ufiles != "." && $Ufiles != ".."){
		
				$userString1 = file_get_contents("db/payment_success/".$Ufiles);
				$uDetails = json_decode($userString1, TRUE);	
				$payemail=$uDetails["email"];
			}
		}
			
				

			if($email == $payemail){
				$status = 'Paid';
			} else{
				$status = 'Not Paid';
			}

//Display only patient information for a department
		if($_SESSION['department'] == $dept){
//Display Patients Appointment details
			$temp .="<tr>";
			$temp .= "<td>".$name."</td>";
			$temp .= "<td>".$email."</td>";
			$temp .= "<td>".$date."</td>";
			$temp .= "<td>".$time."</td>";
			$temp .= "<td>".$nature."</td>";
			$temp .= "<td>".$comp."</td>";
			$temp .= "<td>".$dept."</td>";
			$temp .= "<td>".$status."</td>";
			$temp .="</tr>";
		
	}
}
	}

	$temp .="</table>";

	echo $temp;
	


}

?>

</div>
<div class="footer">
	<p>&copy2020 SNH HOSPITAL</p>
</div>
</body>
</html>