
<?php
session_start();

$phonenumber=$regNo =$password = '';
$errors = array("phonenumberErr" => "", "success" => "");

//Requiring DB configs
include_once('db.php');

if(isset($_POST['submit'])){
    
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password =  mysqli_real_escape_string($con, $_POST['password']);
    

    $password1 = md5($password); //encrypting password
    $sql1="SELECT * FROM authentication where  email = '$email' and password= '$password1' LIMIT 1";
  
    $result= mysqli_query($con,$sql1);
    $queryResults= mysqli_num_rows($result);
    
    if($queryResults) {
        while($row = mysqli_fetch_assoc($result)) {

            //set session variables
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['email'] = $row['email'];

            $errors['success'] = "Login Success.";
            echo "<script>location.replace('mainPages/home.php');</script>";
            
        }
    }else{
        $errors['phonenumberErr'] = "Wrong combinations. Fill your details correctly.";  
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Friendzone</title>

<!--Bootstrap css Links -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!--Bootstrap JS Links -->
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

<!--Css link-->
<link rel="stylesheet" type="text/css" href="css/index.css">


</head>



<body>

<div class="col-sm-12">
        <?php include_once('header1.php'); ?>
</div>

<div class="container">
<div class = "row"  id="headerbody">

    <div class="row">
    <div class="col-sm-12">
        <br>
            <p id="topparagraph" style="font-size: 20px">Login to Friendzone:</p>
           
        </div>
    </div>
    <br><br>

    <div class="row">
    <div class="col-sm-12" id="topparagraph" style="text-align: center; font-style: bold; background: lightgrey;border-radius: 20px;">
            <form action="index.php" method="post">
                <br>
                <input class="reginput"  type="email" name ="email" placeholder="Enter your email" value="<?php echo $regNo;?>"><br><br>
                <input  class="passinput" type="password" name = "password" placeholder ="Enter password" value="<?php echo $password;?>"> <br><br>
            
            <!--Error display-->
            <div><h5 style="color: red;"><?php echo $errors['phonenumberErr']; ?></h5></div>
            <div><h5 style="color: green;"><?php echo $errors['success']; ?></h5></div>
            
                <button class='btn btn-success' style='width: auto;' type= "submit" name="submit" title="Login">Login</button>

            </form>

            <br>
    <div class="row" id="topparagraph" >
    <div class="col-sm-12" id ="bottomdiv">
            <a href="signup.php" id="register">Create A new Account</a><br><br>
            <a id="reset" href="reset.php">Forgot Password</a>
            <br>
    </div>
    </div>
        </div>
    </div>



</div>

</div>

    
</body>
</html>