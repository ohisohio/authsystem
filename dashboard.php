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
		<br>

		<?php


echo("<h4>PAYMENTS YOU HAVE MADE</h4><br/>");


$payrecord = scandir("db/payment_success/");
$numofpay = count($payrecord);
$exactcount = $numofpay - 2;
if ($exactcount == 0){
	echo("<h4>You have no payments yet</h4>");

}else{

	$temp = "<table class='table'>";
	$temp .= "<tr><th>TRANSACTION ID</th>";
	$temp .= "<th>NARRATION</th>";
	$temp .= "<th>AMOUNT</th>";
	$temp .= "<th>DATE</th>";
	$temp .= "<th>STATUS</th></tr>";


	for ($counter = 0; $counter < $numofpay ; $counter++) {
   
		$Userfiles = $payrecord[$counter];
	
		if($Userfiles != "." && $Userfiles != ".."){
		  //Retrieve Patients Payment details
			$userString = file_get_contents("db/payment_success/".$Userfiles);
			$userDetails = json_decode($userString, TRUE);
		
		
			$name=$userDetails["name"];
			$email=$userDetails["email"];
			$transid=$userDetails["transactionID"];
			$narration=$userDetails["narration"];
			$amount=$userDetails["amount"];
			$date=$userDetails["date"];
			$status=$userDetails["paymentstatus"];

//Display only patient information for a department
		if ($email == $_SESSION['email']){
//Display Patients Appointment details
			$temp .="<tr>";
			
			$temp .= "<td>".$transid."</td>";
			$temp .= "<td>".$narration."</td>";
			$temp .= "<td>".$amount."</td>";
			$temp .= "<td>".$date."</td>";
			$temp .= "<td>".$status."</td>";
			$temp .="</tr>";
		}
		
	}
}
	$temp .="</table>";

	echo $temp;
	


}

	


?>	
		

</main>

</body>


</html>
