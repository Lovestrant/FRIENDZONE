<?php
session_start();
$_SESSION['windowTabbed'] = "Profile";

//Requiring DB configs
include_once('../db.php');

if(isset($_POST['submit'])) {
    $hiddenid = $_POST['hiddenid'];
    $fullname = $_POST['fullname'];
    $bio = $_POST['bio'];

   $sql = "UPDATE authentication SET bio = '$bio',fullname='$fullname' WHERE email='$hiddenid'";
   $res = mysqli_query($con,$sql);       
   if($res ==1){
    $_SESSION['fullname'] = $fullname;
    echo "<script>location.replace('profile.php');</script>";
   }
}
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

    <script>
        function myfunction() {
          let x = document.getElementById('theform');

          if (x.style.display === "none") {
                x.style.display = "block";
            
            } else {
                x.style.display = "none";
            }
        }
        function mySecondFunction() {
          let x = document.getElementById('thediv');
          let editbtn2 = document.getElementById('editbtn2');
          if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

    </script>

</head>
<body>
    <div class="container-fluid">
        <div class = "row">
    
        <div class="col-sm-12">
         <?php include_once('../header.php'); ?>
    </div>
    </div>
    
    <div class="container">
      <h2>YOUR PROFILE:</h2>
      <p>Name: <?php echo $_SESSION['fullname']; ?></p>
      <p>Email: <?php echo $_SESSION['email']; ?></p>


      <?php 
    //   Get Description From DB
      $email = $_SESSION['email'];
      $sql1="SELECT * FROM authentication WHERE email='$email'";

      $result= mysqli_query($con,$sql1);
      $queryResults= mysqli_num_rows($result);
      if($queryResults) {
        while($row = mysqli_fetch_assoc($result)){
            $bio = $row['bio'];
            $email = $row['email'];
            $fullname = $row['fullname'];
            echo "<p>Bio: $bio</p>";
            echo "
            <form action='../logout.php' method='post'>
            <button style='color: red;'>Log Out</button>
            </form>
            ";
        }
        echo" <hr>
        <button id='editbtn' onclick='myfunction()'>Edit Profile</button>
        <button id='editbtn2' onclick='mySecondFunction()'>See Your Posts</button>
        <form action='profile.php' method='post' id='theform'style='display:none;'>
            <h4>EDIT YOUR BIO</h4>
            <input type='hidden' name= 'hiddenid' value='$email'> 
            <input style='width: 50%; height: 100px;' type='text' value='$fullname' name='fullname' placeholder='Edit your name'><br><br>
            <input style='width: 50%; height: 100px;' type='text' value='$bio' name='bio' placeholder='Set your Bio'><br><br>
            <button name='submit'>Finish Edit</button>
        </form>
        
        ";
       
      }
      
      ?>
        <div id="thediv" style="display:none;">
        <?php
           $email = $_SESSION['email'];
            $sql1="SELECT * FROM posts WHERE email='$email' ORDER BY id DESC";
            $result= mysqli_query($con,$sql1);
            $queryResults= mysqli_num_rows($result);
  
            if($queryResults) {
                while($row = mysqli_fetch_assoc($result)){
                    $fullname = $row['fullname'];
                    $email = $row['email'];
                    $content = $row['context'];
                    $topic = $row['topic'];
                    $timestamp = $row['TheTimestamp'];
                    $id= $row['id'];

                    echo
                    "
                    <div class='row' style='margin-left:10px;'>
                    <a href='viewProfile.php?email=$email'><h3 style='color: green;'>$fullname</h3></a>
                    <p style='color: purple;'>$email--$timestamp</p>
                    
                    <h4 style='text-decoration: underline;'>$topic<h4>
                    <p>$content</p>
                 
                    </div>
                    <a href='comments.php?id=$id'><button class='btn btn-success'>Comment</button></a>
                    <hr>
                    ";
                }
            }

            ?>
        </div>
    </div>

</body>
</html>