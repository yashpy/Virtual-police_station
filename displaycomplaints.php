<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<title>Complaints</title>

	<style media="screen">
		.complaintscontainer{
			margin-left: 10vw;
			margin-right: 10vw;
			margin-top: 5vh;
		}

		body{
			background-color: #ebebeb;
		}
	</style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div style="float:left; color:#fff; margin-left:10vw;">
          <a class="navbar-brand" href="index.html">
            <img src="./fir.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
            FIR
          </a>
      </div>
      <div style="float:right; color:#fff; margin-right:10vw;">
          <a href="addwanted.html" style="text-decoration: none; color:#fff; margin-right:20px">Add Wanted</a>
          <a href="logout.php" style="text-decoration: none; color:#fff;">Log Out</a>
      </div>

    </nav>
	<div class="complaintscontainer">
        <div><h1>Pending Complaint Requests</h1></div><br>
		<table class="table table-hover table-light">
		  <thead class="thead">
		    <tr>
		      <th scope="col">S.No.</th>
		      <th scope="col">Complaint ID</th>
		      <th scope="col">Name</th>
		      <th scope="col">Age</th>
		      <th scope="col">Address</th>
		      <th scope="col">Date of Incidence</th>
		      <th scope="col">Date of Registration</th>
		      <th scope="col">Complaint</th>
		      <th scope="col">Section</th>
		      <th scope="col">Category</th>
		      <th scope="col">Status</th>
		    </tr>
		  </thead>
		  <tbody>


		    <?php

            session_start();
            if(isset($_SESSION['email'])){
            }
            else{
                echo '<script>
                window.location="Login/login.html";
                </script>';
            }
		    $i =1;
		    $con = mysqli_connect('localhost','root','','complaints');

		    $query = "SELECT * from fir WHERE Approved = false ORDER BY Reg_DateTime DESC";
		    $res = mysqli_query($con,$query);
		    $count = mysqli_num_rows($res);

		    if($count>0)
		    {
		    	while($row = mysqli_fetch_array($res))
		    	{

		    ?>
		    		<tr>
				      <th scope="row"><?php echo $i ?></th>
				      <td><?php echo $row['SNo'] ?></td>
				      <td><?php echo $row['Name'] ?></td>
				      <td><?php echo $row['Age'] ?></td>
				      <td><?php echo $row['Address'] ?></td>
				      <td><?php echo $row['Inc_DateTime'] ?></td>
				      <td><?php echo $row['Reg_DateTime'] ?></td>
				      <td><?php echo $row['Complaint'] ?></td>
				      <td><?php echo $row['Section'] ?></td>
				      <td><?php echo $row['Category'] ?></td>
				      <td>
				      	<form action="approvalASI.php" method="POST" >
				      		<input type="hidden" name="sno" value="<?php echo $row['SNo'] ?>" >
				      		<input type="hidden" name="cat" value="<?php echo $row['Category'] ?>" >
					      	<button type="submit" name="approve" class="btn btn-outline-success">Approve</button>
					      	<button type="submit" name="reject" class="btn btn-outline-danger">Reject</button>
				      	</form>
				      </td>
				    </tr>

			<?php
					$i++;

		    	}
		    }
		    else
		    {
		    	echo "<h2>No pending complaints!</h2>";
		    }

		    $con->close();

		    ?>


		  </tbody>
		</table>
	</div>
	</body>
</html>
