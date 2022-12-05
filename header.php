<?php 

$windowTabbed = $_SESSION['windowTabbed'];


// include_once('db.php');  


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friendzone</title>

    <!--Css link-->
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <!--Bootstrap css Links -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!--Bootstrap JS Links -->
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>

</head>

<body>
<div class = "container_fluid" id="headerbody1">
    <div class = "row">
        
        <div class ="col-sm-6">
        <h3 class="institution">Friendzone</h3>
        </div>

        <div class="col-sm-6">
        <h3 class="elearningLabel">Converse and Interact</h3>
        </div>

    </div>

    <div class = "row">
        <div class="col-sm-12">
        <h3 class="motto">Let's talk.</h3>
        </div>
    </div>

<div class="col-sm-12" style="text-align: right; margin-right: 2%; margin-top: -2%;">
  
<?php 

 if($windowTabbed === "Home"){
  echo "
  <a href='home.php'> <button style='color: red;' id='radius'>Home</button></a>
  <a href='profile.php'><button>Profile</button></a>
  ";
 } else if( $windowTabbed === "Profile") {
    echo "
    <a href='home.php'> <button id='radius'>Home</button></a>
    <a href='profile.php'><button style='color: red;'>Profile</button></a> 
    ";

 }

?>

</div>
  
</div> 
</body>
</html>