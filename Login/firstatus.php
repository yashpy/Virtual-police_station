<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Fir Status</title>

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

      <link rel="stylesheet" href="firstat.css">
</head>
<body >
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $fir_no = $_POST['fir_no'];

        $con = mysqli_connect('localhost','root','','complaints');

        $sql = "SELECT * from fir WHERE SNo='$fir_no'";
        $result = $con->query($sql);

        if ($result->num_rows > 0)
        {
            $row = mysqli_fetch_array($result);
            $fno = $row['SNo'];
            $name = $row['Name'];
            $age = $row['Age'];
            $address = $row['Address'];
            $incdate = $row['Inc_DateTime'];
            $incDT = strtotime($incdate);
            $regdate = $row['Reg_DateTime'];
            $regDT = strtotime($regdate);
            $complaint = $row['Complaint'];
            $section = $row['Section'];
            $category = $row['Category'];
            $approved = $row['Approved'];
            $siid = $row['SIID'];
            $stat = $row['Status'];

            if($stat==NULL)$stat = "Not Updated";
?>
<div class="card">
 <h1>FIR ID : <?php echo $row['SNo']?></h1>
 <p class="title"> Name : <?php echo $row['Name']?></p>
 <p> Age : <?php echo $row['Age']?></p>
 <p> Address : <?php echo $row['Address']?></p>
 <p> Date of Incidence : <?php echo date("d/m/y",$incDT)?></p>
 <p> Time of Incidence : <?php echo date("g:i A",$incDT)?></p>
 <p> Date of Registration : <?php echo date("d/m/y",$regDT)?></p>
 <p> Time of Registration : <?php echo date("g:i A",$regDT)?></p>
 <p> Complaint : <?php echo $row['Complaint']?></p>
 <p> Section : <?php echo $row['Section']?></p>
 <p> Category : <?php echo $row['Category']?></p>
 <p> Approved : <?php $converted_res = ($row['Approved']) ? 'YES' : 'NO'; echo $converted_res ?></p>
 <p> Status : <?php echo $row['Status']?></p>

<?php
    if ($row['Approved'] == 1) {
?>
        <p>
          <form action="../firgenerator.php" method="POST">
           <input type="hidden" name="sno" value="<?php echo $row['SNo'] ?>" >
           <button type="submit" class="btn btn-primary" name="dfir">Download FIR</button>
         </form>
       </p>
<?php
    }

 ?>

</div>


<?php
        }
        else
        {
            $message = "Your FIR has been rejected or no such FIR exists";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo '<script>
            window.location="firlogin.html";
            </script>';
        }
    }

 ?>

</body>
 </html>
