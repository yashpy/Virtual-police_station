<?php
	if(isset($_POST['submit']))
	{
		$cid = $_POST['cid'];
		$sno = $_POST['sno'];
		$stat = $_POST['comment'];
		$con = mysqli_connect('localhost','root','','complaints');

	    $query = "UPDATE fir set Status = '$stat' WHERE SNo = '$sno'";
	    $result = $con->query($query);

	    $con->close();

		$con3 = mysqli_connect('localhost','root','','complaints');

		$query = "UPDATE cops SET Count = Count - 1 WHERE id ='$cid'";
		$result3 = $con3->query($query);

		$con3->close();
		echo '<script>
		window.location="si_dash.php";
		</script>';

	}

	else {
		echo "<h2>Error 404</h2>";
	}
?>
