 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Wanted List</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
     <style media="screen">
       .main-div{
         text-align: center;
         margin: 10px;
       }
       h1{
         background-color: red;
       }
     </style>
   </head>
   <body>
     <div class="main-div">
       <h1>List Of Wanted Criminals</h1>
     </div>
     <div class="container py-5">
       <div class="row mt-4">
         <?php
           $con = mysqli_connect('localhost','root','','complaints');
           $sql = "SELECT * FROM wanted ";
           $result = $con->query($sql);
           $checknumber=mysqli_num_rows($result)>0;

           if($checknumber){
             while($row = mysqli_fetch_array($result)){
               ?>
               <div class="col-lg-3">
                 <div class="card">
                   <img src="upload/<?php echo $row['image']; ?>" class="card-img-top" height="200px" width="260px" alt="Criminal Image">
                   <div class="card-body">
                     <h2 class="card-title"><?php echo $row['name']; ?></h2>
                   </div>
                 </div>
               </div>
               <?php
             }
           }else{
             echo "No data found";
           }


          ?>

       </div>
     </div>
   </body>
 </html>
