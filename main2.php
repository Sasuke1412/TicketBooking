<?php
session_start();
if(!$_SESSION['myusername']){
header("location:main.php");
}
?>

<html>
<body>
<body>
<center>
<div class="header"><img src="images/logo.png" width="177" height="61" longdesc="main.php" /> </div>

</center>

<p align="left"><?php
$username = $_SESSION['myusername'];
echo "Welcome $username"; 
?>
<span style="float:right"><a href="booktiket.php"> Booked Tickets</a> </span>
</p>
<p> <a href="first.php"> Book New Tickets</a>  </p>

</body>
</html>