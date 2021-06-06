<?php

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $con=mysqli_connect('localhost','root','','complaints');
    if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
    }
    $name=$_POST['name'];
    $image=$_FILES["image"]['name'];

    $sql="INSERT INTO wanted VALUES('$image','$name')";
    $result=mysqli_query($con,$sql);

    if($result){
      move_uploaded_file($_FILES["image"]["tmp_name"], "upload/".$_FILES["image"]["name"]);
      echo "<h1> Person Added <h1>";

    }else{
      echo "Person Not Added";

    }
  }else {
		echo '<script>
		window.location="addwanted.html";
		</script>';
	}




 ?>
