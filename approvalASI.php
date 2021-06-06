<?php
	if(isset($_POST['approve']))
	{
		$sno = $_POST['sno'];
		$category = $_POST['cat'];
		$con = mysqli_connect('localhost','root','','complaints');

		$sql = "SELECT * from cops WHERE Post = 'SI' and Category = '$category' ORDER BY Count ASC";
		$result1 = $con->query($sql);
		$con->close();

		if ($result1->num_rows > 0)
        {
			$row = mysqli_fetch_array($result1);
			$id = $row['id'];

			$con2 = mysqli_connect('localhost','root','','complaints');

			$query = "UPDATE fir set Approved = True, SIID = '$id' WHERE SNo = '$sno'";
		    $result2 = $con2->query($query);

		    $con2->close();
			// Increment SI cases count
			$con3 = mysqli_connect('localhost','root','','complaints');

			$query = "UPDATE cops SET Count = Count + 1 WHERE id ='$id'";
		    $result3 = $con3->query($query);

		    $con3->close();

			echo '<script>
            window.location="displaycomplaints.php";
            </script>';
		}
		else
		{
			$message = "No SI under that category";
            echo "<script type='text/javascript'>alert('$message');</script>";
			echo '<script>
            window.location="displaycomplaints.php";
            </script>';
		}


	}

	else if(isset($_POST['reject']))
	{
		$sno = $_POST['sno'];
		$con = mysqli_connect('localhost','root','','complaints');
		$query = "DELETE from fir WHERE SNo = '$sno'";
	    $result = $con->query($query);
	    $con->close();

		echo '<script>
		window.location="displaycomplaints.php";
		</script>';
	}

	else {
		echo "<h2>Error 404</h2>";
	}
?>
