<?php
session_start();
$_SESSION['windowTabbed'] = "Profile";

//Requiring DB configs
include_once('../db.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!--Css link-->
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <!--Bootstrap css Links -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!--Bootstrap JS Links -->
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>


</head>
<body>
    <div class="container-fluid">
        <div class = "row">
    
        <div class="col-sm-12">
         <?php include_once('../header.php'); ?>
    </div>
    </div>
    
    <div class="container">

      <?php 
    //   Get Description From DB
      $email = $_GET['email'];
      $sql1="SELECT * FROM authentication WHERE email='$email'";

      $result= mysqli_query($con,$sql1);
      $queryResults= mysqli_num_rows($result);
      if($queryResults) {
        while($row = mysqli_fetch_assoc($result)){
            $bio = $row['bio'];
            $email = $row['email'];
            $fullname = $row['fullname'];
            echo "
            <h2 style='color:red;'>$fullname's PROFILE:</h2>
            <p>Name: $fullname</p>
            <p>Email: $email</p>
            <p>Bio: $bio</p>";
        }
      }
      
      ?>
    </div>

</body>
</html>