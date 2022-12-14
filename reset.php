<?php
session_start();

$phonenumber = $securitykey = $password = $passwordconfirm = '';

$errors = array("passwordErr" => "", "success" =>"");

//Requiring DB configs
include_once('db.php');

if(isset($_POST['submit'])){

    
    $securitykey= $_POST['securitykey'];
    $email= $_POST['email'];
    $password= $_POST['password'];
    $passwordconfirm= $_POST['passwordconfirm'];

    if(empty($securitykey) || empty($email) || empty($password) || empty($passwordconfirm)) {
        $errors['passwordErr'] = "Fill all fields.";
    } 
        if(!($password == $passwordconfirm)){
            $errors['passwordErr'] = "Password doesn't match with its confirmation. Try again.";

        }elseif(($password == $passwordconfirm)){
            $securitykey1 = md5($securitykey);//Encrypting Security Key

            $sql1 = "SELECT * from authentication where email = '$email' and securitykey = '$securitykey1' Limit 1";
            $result= mysqli_query($con,$sql1);
            $queryResults= mysqli_num_rows($result);
            
            
            if($queryResults) {

                while($row = mysqli_fetch_assoc($result)) {
               $password1 = md5($password);//encryption of password
                $sql = "UPDATE authentication set password = '$password1' where email= '$email'";
               $res = mysqli_query($con,$sql);       
                if($res ==1){
                //set session variables
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['email'] = $row['email'];
                $errors['success'] ="Update successful. You are now logged in";
    
                echo "<script>location.replace('mainPages/home.php')</script>";    
            }else{   

            $errors['phonenumberErr'] = "No user with those details in the system. Please try again. Ensure you fill your details correctly.";
                                   
            }
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
    <title>Location-Based Ecommerce System</title>

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

    <div class="row">
        <div class="col-sm-12">
            <p id="topparagraph" style="font-size: 20px; margin-top: 5px;">Reset Password:</p>
        </div>
    </div> <br>

    <div class="row" id="topparagraph" style="text-align: center; font-style: bold; background: lightgrey;border-radius: 20px;">
    <br><br>    
    <div class="col-sm-12">
            <form action="reset.php" method="post">
            
                <input class="reginput" type="email" name ="email" placeholder="Enter your email" value="<?php echo $phonenumber;?>"><br><br>
                <input  class="passinput" type="text" name = "securitykey" placeholder ="Enter your Security Key" value="<?php echo $securitykey;?>"> <br><br>
                <input  class="passinput" type="password" name = "password" placeholder ="Create new password" value="<?php echo $password;?>"> <br><br>
                <input  class="passinput" type="password" name = "passwordconfirm" placeholder ="Repeat password" value="<?php echo $passwordconfirm;?>"> <br><br>
                
                <!--Error display-->
                <div><h3 style="color: green;"><?php echo $errors['success']; ?></h3></div>
                <div><h3 style="color: red;"><?php echo $errors['passwordErr']; ?></h3></div>
                
                <button class="btn btn-success" name="submit" title="sign Up" >Reset</button>

            </form>
                
            <br>
            <div class="row" id="topparagraph">
        <div class="col-sm-12" id ="bottomdiv">
            <a href="signup.php"> Register.</a> <br><br>
            <a id="reset" href="index.php"> Back to login page.</a>
            
        </div>
    </div>
        </div>
    </div> <br><br>




</div>
 
</body>
</html>