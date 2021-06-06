<?php

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $con=mysqli_connect('localhost','root','','complaints');
    if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
    }
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $mobileno=$_POST['mobileno'];
    $subject=$_POST['subject'];
    $query="INSERT INTO feedback VALUES('$firstname','$lastname','$mobileno','$subject')";

    $result=mysqli_query($con,$query);
    if($result){

      echo "<h1>Feedback Submitted</h1>";

    }else{
      echo "<h1>Feedback Not Submitted</h1>";
    }

  }else{

    echo " <h1>Feedback Not Submitted</h1>";

  }



 ?>
