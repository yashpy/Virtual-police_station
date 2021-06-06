 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     	<link rel="stylesheet" href="Login/css/firstat.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

 	<title>Complaints</title>

 	<style media="screen">
 		.complaintscontainer{
 			margin-left: 10vw;
 			margin-right: 10vw;
 			margin-top: 5vh;
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
           <a href="logout.php" style="text-decoration: none; color:#fff;">Log Out</a>
       </div>

     </nav>
 	<div class="complaintscontainer">
        <div><h1>Approved Complaints</h1></div><br>
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
            if( isset( $_SESSION['email'] ) ) {
                    $si_email = $_SESSION['email'];
               }else {
                   echo '<script>
                   window.location="Login/login.html";
                   </script>';
               }
          //
          // $si_email = $_SESSION['email'];
          $con = mysqli_connect('localhost','root','','complaints');

          if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
          }

          $sql = "SELECT * FROM cops WHERE Email='$si_email'";
          $result = $con->query($sql);
          $cid = 0;
          if($result->num_rows > 0)
  		    {
  		    	$row = mysqli_fetch_array($result);
                $cid = $row['id'];
            }

          $con->close();
          $i =1;
          $con = mysqli_connect('localhost','root','','complaints');

          $sql = "SELECT * FROM fir WHERE SIID = '$cid' ORDER BY Reg_DateTime DESC";
          $result = $con->query($sql);

          if($result->num_rows > 0)
  		    {
  		    	while($row = mysqli_fetch_array($result))
  		    	{

         ?>
 		    		<tr>
 				      <th scope="row"><?php echo $i ?></th>
 				      <td><?php echo $row['SNo'] ?></td>
 				      <td><?php echo $row['Name'] ?></td>
 				      <td><?php echo $row['Age'] ?></td>
 				      <td><?php echo $row['Address'] ?></td>
 				      <td><?php echo date("d/m/y G:i A",strtotime($row['Inc_DateTime'])) ?></td>
 				      <td><?php echo date("d/m/y G:i A",strtotime($row['Reg_DateTime'])) ?></td>
 				      <td><?php echo $row['Complaint'] ?></td>
 				      <td><?php echo $row['Section'] ?></td>
 				      <td><?php echo $row['Category'] ?></td>
              <td>
        <?php
        if ($row['Status'] == NULL ) {
            ?>
				      	<form action="siupdatestatus.php" method="POST" >
                  <div class="input-group flex-container "><textarea name="comment"><?php echo $row['Status'] ?></textarea><button style=" margin: 2px;width:100px;" type="submit" name="submit" class="btn btn-outline-success input-group-addon">Submit</button></div>

                  <input type="hidden" name="sno" value="<?php echo $row['SNo'] ?>" >
                  <input type="hidden" name="cid" value="<?php echo $cid ?>" >
				      	</form>

        <?php
    }
    else {
        ?>
        <p style="color:green"><?php  echo "Submitted";?></p>
        <?php
        }
         ?>
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
