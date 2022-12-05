<?php
session_start();
$_SESSION['windowTabbed'] = "Home";
//Requiring DB configs
include_once('../db.php');
$errors = array("Err" => "", "passwordErr" => "", "success" => "");

if(isset($_POST['submit'])){
    $topic = $_POST['topic'];
    $context = $_POST['context'];
    $t=time();
    $TheTimestamp= date( "Y-m-d H:i:s" , $t);
    $email = $_SESSION['email'];
    $fullname = $_SESSION['fullname'];
   
    $sql = "INSERT INTO posts(topic,context,TheTimestamp,email,fullname) VALUES('$topic','$context','$TheTimestamp','$email','$fullname')";
    $res = mysqli_query($con,$sql);
    if($res ==1){
        $errors['success'] = "Posting Success.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FriendZone</title>

    <!--Css link-->
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <!--Bootstrap css Links -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!--Bootstrap JS Links -->
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
<div class = "container-fluid">
    <div class = "row">
    
        <div class="col-sm-12">
        <?php include_once('../header.php'); ?>
        </div>
            
    
    </div>

    <div class="row">
<div class = "row" style="margin-left: 4%;">
    <p>Hello <?php $fullname = $_SESSION['fullname']; echo "<label style='color: red;font-size: 15px;'> $fullname</label>"; ?></p>


<div class="container" id="homebody">
    <div class="row">
        <div class="col-sm-12">
            <form action="home.php" method="post">
                <input type="text" placeholder="Topic of Post" name="topic" required>
                <input type="text" placeholder="Content of the Post" name="context" required><br><br>
                <button name="submit" class="btn btn-success">POST</button><br>
                <div><h5 style="color: red;"><?php echo $errors['passwordErr']; ?></h5></div>
                <div><h5 style="color: green;"><?php echo $errors['success']; ?></h5></div>
                <hr>

            </form>
        </div>
    </div>
   <div class="row">
    <div class="col-sm-12">
        <?php 
            $sql1="SELECT * FROM posts ORDER BY id DESC";

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
                    <div class='row'>
                    <a href='viewProfile.php?email=$email'><h3 style='color: green;'>$fullname</h3></a>
                    <p style='color: purple;'>$email-----$timestamp</p>
                    
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
       
   </div>

</body>
</html>

