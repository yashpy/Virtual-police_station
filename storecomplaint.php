<?php

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$con = mysqli_connect('localhost','root','','complaints');
		$name = $_POST['name'];
		$age = $_POST['age'];
		$address = $_POST['address'];
		$incDT = $_POST['incDT'];
		$typeComplaint = $_POST['typeComplaint'];
		$section = "";
		$category = "";
		switch ($typeComplaint) {
			case 'Attempt to Murder':
				$section = "307";
				$category = "Murder";
				break;

			case 'Theft':
				$section = "378";
				$category = "Theft & Robbery";
				break;

			case 'Domestic Violence':
				$section = "304";
				$category = "Domestic Affairs";
				break;

			case 'Others':
				$section = "999";
				$category = "Others";
				break;

			default:
				$section = "999";
				$category = "Others";
				break;
		}

		$sql = "insert into fir (Name,Age,Address,Inc_DateTime,Reg_DateTime,Complaint,Section,Category) VALUES ('$name','$age','$address','$incDT',now(),'$typeComplaint','$section','$category')";
		$result = $con->query($sql);
		$con->close();

		$con = mysqli_connect('localhost','root','','complaints');
		$query = "SELECT * from fir ORDER BY SNo ASC";
		$res = mysqli_query($con,$query);
		$count = mysqli_num_rows($res);

		if($count>0)
		{
			while($row = mysqli_fetch_array($res))
			{
				$firid = $row['SNo'];
			}
		}
		$message = "Complaint Registered";
		echo "<h2>$message. Your Unique ID for registered complaint is $firid. Please, NOTE IT DOWN to monitor the status of FIR online. </h2>";

	}
	else {
		echo '<script>
		window.location="registercomplaint.php";
		</script>';
	}

?>
