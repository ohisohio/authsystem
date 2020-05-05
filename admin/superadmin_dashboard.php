<?php include_once('../lib/header.php'); ?>
<?php 
	// checking if a user is logged in
	if (!isset($_SESSION['first_name'])) {
		header('Location: index.php');
	}

 ?>


		<div class="appname">SNG Management System</div>
		<div class="loggedin">Welcome <?php echo $_SESSION['first_name']; ?>! <a href="logout.php">Log Out</a></div>
	

	<p>
	<h3>Users <span><a href="adduser.php">+ Add New</a></span></h3>
	</p>
	<p>
	<h3>View All Staff <span><a href="allstaff.php">Staff Page</a></span></h3>
	</p>
	<p>
	<h3>View All Staff <span><a href="allpatients.php">Patients Page</a></span></h3>
	</p>
	<p>
	<h3>View All Successful Payments <span><a href="paysuccessful.php">Patients Payment</a></span></h3>
	</p>


		
				
	
</body>
</html>
