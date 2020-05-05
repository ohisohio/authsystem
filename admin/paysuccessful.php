
<?php
session_start();
?>


<div class="appname">SNG Management System</div>
		<div class="loggedin">Welcome <?php echo $_SESSION['first_name']; ?>! <a href="logout.php">Log Out</a></div>
		<div>
		<a href="superadmin_dashboard.php">Return to Dashboard</a></div>
		</div>

		<?php
$payrecord = scandir("../db/payment_success/");
$numofpay = count($payrecord);
$exactcount = $numofpay - 2;
if ($exactcount == 0){
	echo("<h4>You have no payments yet</h4>");

}else{

	$temp = "<table class='table'>";
	$temp .= "<tr><th>NAME</th>";
	$temp .= "<th>EMAIL</th>";
	$temp .= "<th>TRANSACTION ID</th>";
	$temp .= "<th>NARRATION</th>";
	$temp .= "<th>AMOUNT</th>";
	$temp .= "<th>DATE</th>";
	$temp .= "<th>STATUS</th></tr>";




	for ($counter = 0; $counter < $numofpay ; $counter++) {
   
		$Userfiles = $payrecord[$counter];
	
		if($Userfiles != "." && $Userfiles != ".."){
		  //Retrieve Patients Payment details
			$userString = file_get_contents("../db/payment_success/".$Userfiles);
			$userDetails = json_decode($userString, TRUE);
		
		
			$name=$userDetails["name"];
			$email=$userDetails["email"];
			$transid=$userDetails["transactionID"];
			$narration=$userDetails["narration"];
			$amount=$userDetails["amount"];
			$date=$userDetails["date"];
			$status=$userDetails["paymentstatus"];

//Display only patient information for a department
		
//Display Patients Appointment details
			$temp .="<tr>";
			$temp .= "<td>".$name."</td>";
			$temp .= "<td>".$email."</td>";
			$temp .= "<td>".$transid."</td>";
			$temp .= "<td>".$narration."</td>";
			$temp .= "<td>".$amount."</td>";
			$temp .= "<td>".$date."</td>";
			$temp .= "<td>".$status."</td>";
			$temp .="</tr>";
		
	}
}
	$temp .="</table>";

	echo $temp;
	


}

	


?>