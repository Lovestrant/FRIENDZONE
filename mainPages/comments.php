<?php
session_start();
include_once('../db.php');

if(isset($_POST['submit'])){
  $hiddenid = $_POST['hiddenid'];
  $comment = $_POST['comment'];
  $fullname = $_SESSION['fullname'];
  $email = $_SESSION['email'];

    //   Comment Now
    $sql = "INSERT INTO comments (fullname, email,comment, postId) VALUES ('$fullname', '$email','$comment','$hiddenid')";
    $res = mysqli_query($con,$sql);

    if($res ==1){
     echo "<script>location.replace('comments.php?id=$hiddenid')</script>";
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
    <div class="container">
    <div class="row">
        <div class="col-sm-6">
            <?php
               $TheId = $_GET['id'];
                $sql1="SELECT * FROM posts WHERE id=$TheId";

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
                        <h3 style='color: green;'>$fullname</h3>
                        <p style='color: purple;'>$email-----$timestamp</p>
                        
                        <h4 style='text-decoration: underline;'>$topic<h4>
                        <p>$content</p>
                        <hr>
                        ";
                    }
                }  
            ?>
        </div>

        <div class="col-sm-6">
        <form action="comments.php" method="post" style='display:flex;'>
                <input type="hidden" name= "hiddenid" value=<?php $id= $_GET['id']; echo $id; ?>> <!-- Hidden input-->
                <input type="text" placeholder="Type Comment" name="comment" required>
                <button name="submit" class="btn btn-success">Comment</button><br>
                <hr>
            </form>
             <br>
            <!-- Display Other Comments -->
            <?php 

            $TheId = $_GET['id'];
                $sql1="SELECT * FROM comments WHERE postId=$TheId";

                $result= mysqli_query($con,$sql1);
                $queryResults= mysqli_num_rows($result);
        
                if($queryResults) {
                    while($row = mysqli_fetch_assoc($result)){
                        $fullname = $row['fullname'];
                        $email = $row['email'];
                        $comment = $row['comment'];
                        $id= $row['id'];
                        echo "
                        <p style='color: purple;text-decoration: underline;'>$fullname</p>
                        <p>$comment</p>
                        ";
                    }
                }
            ?>
        </div>
    </div>
    </div>
</body>
</html>