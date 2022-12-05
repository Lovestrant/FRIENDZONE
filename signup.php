<?php
session_start();

//initializing input values
$fullname = $email= $password = $passwordconfirm = $securitykeyConfirm = $securitykey =$phonenumber = '';

$errors = array("Err" => "", "passwordErr" => "", "success" => "");

//Requiring DB configs
include_once('db.php');


if(isset($_POST['submit'])){

    $fullname = $_POST['fullname'];
    $securitykeyConfirm = $_POST['securitykeyConfirm'];
    $securitykey = $_POST['securitykey'];
    $email = $_POST['email'];
   
    $password = $_POST['password'];
    $passwordconfirm = $_POST['passwordconfirm'];
   


     if($password != $passwordconfirm || $securitykey != $securitykeyConfirm){
         $errors['passwordErr'] = "Password or security key with their confirmations does not match";
      
     }elseif(empty($email) || empty($fullname) || empty($securitykey)|| empty($securitykeyConfirm)||empty($password) || empty($passwordconfirm)){

        $errors['Err'] = "Fill all the fields.";
     }else{
       //insert to db
       $sql1="SELECT * FROM authentication where email = '$email' Limit 1";
    
       $result= mysqli_query($con,$sql1);
       $queryResults= mysqli_num_rows($result);
       
       if($queryResults) {

           $errors['passwordErr'] = "A user with same email already exist.";
          // echo"<script>alert('A user with same phone number already exist. Try again with a different number.')</script>"; 
       }else{
        $password1 = md5($password);//encryption of password
        $securitykey2 = md5($securitykey);

         $sql = "INSERT INTO authentication (fullname, email,securitykey, password,bio) VALUES ('$fullname', '$email','$securitykey2','$password1','')";
         $res = mysqli_query($con,$sql);
     
         if($res ==1){

         //set session variables
         $_SESSION['fullname'] = "$fullname";
         $_SESSION['email'] = "$email";

         $errors['success'] = "Registration Success.";
         echo "<script>location.replace('index.php');</script>";
         }
         
       }
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
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <!--Bootstrap css Links -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!--Bootstrap JS Links -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>


</head>
<body>
<div class="col-sm-12">
 <?php include_once('header1.php'); ?>
</div>

<div class = "container" id="headerbody">
<div class = "row" style='margin-top: -2%;'>

    <div class="row">
        <div class="col-sm-12">
            <p id="topparagraph" style="font-size: 20px; margin-top: 5px;">Create An Account:</p>
        </div>
    </div>

    <div class="row">
    <div class="col-sm-12" id="topparagraph" style="text-align: center; font-style: bold; background: lightgrey;border-radius: 20px;">
            <form action="signup.php" method="post" >
                 <br>
                <div><h5 style="color: red;"><?php echo $errors['Err']; ?></h5></div>

                <input  class="reginput" type="text" name = "fullname" placeholder ="Enter Full Name" value="<?php echo $fullname;?>"> <br><br>
            
                <input  class="passinput" type="email" name = "email" placeholder ="Email" value="<?php echo $email;?>"> <br><br>
                <input  class="passinput" type="text" name = "securitykey" placeholder ="Set Security Key" value="<?php echo $securitykey;?>"> <br><br>
                <input  class="passinput" type="text" name = "securitykeyConfirm" placeholder ="Confirm Security Key" value="<?php echo $securitykeyConfirm;?>"> <br><br>
                
                <input  class="passinput" type="password" name = "password" placeholder ="Set password" value="<?php echo $password;?>"> <br><br>
                <input  class="passinput" type="password" name = "passwordconfirm" placeholder ="Repeat password" value="<?php echo $passwordconfirm;?>"> <br><br>
            
                <div><h5 style="color: red;"><?php echo $errors['passwordErr']; ?></h5></div>
                <div><h5 style="color: green;"><?php echo $errors['success']; ?></h5></div>

                <button class='btn btn-success' name="submit" title="sign Up" >Sign Up</button>

            </form>

            <div class="row" id="topparagraph">
            <div class="col-sm-12" id ="bottomdiv">
            <br>
                <a id="reset" href="index.php"> Go back to login page.</a>
                
            </div>
            </div>
        </div>
    </div> <br> 


</div>

</div>

</body>
</html>