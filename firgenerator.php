<?php
    //call the FPDF library
    require('fpdf17/fpdf.php');

    if(isset($_POST['dfir']))
	{
        $sno = $_POST['sno'];

		$con = mysqli_connect('localhost','root','','complaints');

		$sql = "SELECT * from fir WHERE SNo = '$sno'";
		$result = $con->query($sql);
		$con->close();

		if ($result->num_rows > 0)
        {
			      $row = mysqli_fetch_array($result);

            $firno = $row['SNo'];
            $name = $row['Name'];
            $age = $row['Age'];
            $address = $row['Address'];
            $inc = $row['Inc_DateTime'];
            $incDT = strtotime($inc);
            $reg = $row['Reg_DateTime'];
            $regDT = strtotime($reg);
            $typeComplaint = $row['Complaint'];
            $section = $row['Section'];
		}
		else
		{
			$message = "Try again later.";
            echo "<script type='text/javascript'>alert('$message');</script>";
			echo '<script>
            window.location="INDEX.html";
            </script>';
		}


	}

    $pdf = new FPDF('P','mm','A4');

    $pdf->AddPage();

    $pdf->SetFont('Arial','BU',20);

    $pdf->Cell(190,40,'First Investigation Report',0,1,'C');

    $pdf->SetFont('Arial','',14);
    $pdf->Cell(170,10,'No: '.$firno,0,1,'R');

    $pdf->Cell(50,20,'Name :',0,0,'R');
    $pdf->Cell(10,20,'',0,0,'R');
    $pdf->Cell(110,20,$name,0,1,'L');

    $pdf->Cell(50,20,'Age :',0,0,'R');
    $pdf->Cell(10,20,'',0,0,'R');
    $pdf->Cell(110,20,$age,0,1,'L');

    $pdf->Cell(50,20,'Address :',0,0,'R');
    $pdf->Cell(10,20,'',0,0,'R');
    $pdf->MultiCell(110,20,$address,0);

    $pdf->Cell(50,20,'Complaint :',0,0,'R');
    $pdf->Cell(10,20,'',0,0,'R');
    $pdf->Cell(110,20,$typeComplaint,0,1,'L');

    $pdf->Cell(50,30,'Section :',0,0,'R');
    $pdf->Cell(10,30,'',0,0,'R');
    $pdf->Cell(110,30,$section,0,1,'L');

    $pdf->Cell(70,20,'Date of Incidence :',0,0,'R');
    $pdf->Cell(10,20,'',0,0,'R');
    $pdf->Cell(30,20,date("d/m/y",$incDT),0,0,'L');
    $pdf->Cell(20,20,'Time :',0,0,'R');
    $pdf->Cell(10,20,'',0,0,'R');
    $pdf->Cell(30,20,date("g:i A",$incDT),0,1,'L');

    $pdf->Cell(70,20,'Date of Registration :',0,0,'R');
    $pdf->Cell(10,20,'',0,0,'R');
    $pdf->Cell(30,20,date("d/m/y",$regDT),0,0,'L');
    $pdf->Cell(20,20,'Time :',0,0,'R');
    $pdf->Cell(10,20,'',0,0,'R');
    $pdf->Cell(30,20,date("g:i A",$regDT),0,1,'L');


    $pdf->Output();
?>
