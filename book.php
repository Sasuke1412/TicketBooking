<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="movie_booking"; // Database name 
// Connect to server and select databse.
session_start();
	$movie = $_POST['movie'];
	$mdate = $_POST['mdate'];
	$city = $_POST['city'];
   	$tname = $_POST['tname'];
	$stime = $_POST['stime'];
	$_SESSION['stime'] =$stime;
	$_SESSION['tname'] =$tname;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//$q=$_GET["q"];
$conn = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($conn,$db_name)or die("cannot select DB");
?>
<title>Online Ticket Booking</title>
<style type="text/css">
a:link {
	color:#ffffff;
	text-decoration: underline;
}
a:visited {
	color: #ffffff;
	text-decoration: underline;
}
html, body {height:100%; margin:0; padding:0;}

#page-background {position:fixed; top:0; left:0; width:100%; height:100%;}
#content {position:relative; z-index:1; padding:10px;}
</style>

</head>

<body>
<div id="page-background"><img src="images/mbg.jpg" width="100%" height="100%" alt="Smile"></div>
<center>
<div class="container" style="width:800px" id="content">
  <div class="header"><img src="images/logo.png" width="177" height="61" longdesc="main.php" />                              	<!-- end .header --></div>
<center>
  <div class="content" style="background-image:url(); height:427px; color: #FFF;vertical-align:middle">
  <p align="right"><?php 
  $username = $_SESSION['myusername'];
  $sql= "select * from users_tbl where username='$username' and userlevel='9'"; 
  $result = $conn->query($sql);
  if($row = mysqli_fetch_array($result))
  {
	  echo "[<a href=\"admin.php\">Admin Center</a>]";
  }
  ?> [<a href="first.php">Main Page</a>] [<a href="logout.php">Logout</a>]</p><p align="left"><?php
$username = $_SESSION['myusername'];
echo "Welcome $username";
?></p>
  <p>
    <?php

	$sql = "Select theatre_id,showtiming from movie where movie_name='$movie' and mdate='$mdate'";
	$result= $conn->query($sql);

	$sql3 = "select * from city where city_name='$city'";
	$result3=$conn->query($sql3);
	$row = mysqli_fetch_array($result3);
	$cid= $row['city_id'];
	
	$sql4 = "select * from theatre where theatre_name='$tname'";
	$result4= $conn->query($sql4);
	$row = mysqli_fetch_array($result4);
	$tid= $row['theatre_id'];
	
	$sql2 = "select * from movie where movie_name='$movie' and theatre_id='$tid' and mdate='$mdate' and city_id='$cid' and showtiming='$stime'";
	$result2 = $conn->query($sql2);
	$row = mysqli_fetch_array($result2);
	$movieid= $row['movie_id'];
  ?>
  </p>
  <form name="form2" method="post" action="booked.php">
  <table width="200" border="0">
  <tr>
    <td>City</td>
    <td><input name="city" type="text" id="city" readonly="true" style="background-color:#000; color:#FFF" value="<?php echo $city; ?>" /></td>
  </tr>
  <tr>
    <td>Movie</td>
    <td><input name="movie" type="text" id="movie" readonly="true" style="background-color:#000; color:#FFF" value="<?php echo $movie; ?>" />	</td>
  </tr>
  <tr>
    <td>Theatre</td>
    <td><input name="theatre" type="text" id="theatre" readonly="true" style="background-color:#000; color:#FFF" value="<?php echo $tname; ?>" /></td>
  </tr>
  <tr>
    <td>Date</td>
    <td><input name="mdate" type="text" id="mdate" readonly="true" style="background-color:#000; color:#FFF" value="<?php echo $mdate; ?>" /></td>
  </tr>
  <tr>
    <td>Show Time</td>
    <td><input name="stime" type="text" id="stime" readonly="true" style="background-color:#000; color:#FFF" value=<?php echo $stime; ?> /></td>
  </tr>

</table>
  <p>&nbsp;</p>
  <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="">
    <tr>
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="">
<tr>
<td width="108">Select Seat</td>
<td width="6">:</td>
<td width="294">
<select name ='seat' id = 'seat'>
<option value=""> </option>
<?php $tbl_name="seats"; // Table name ?>

<?php 
$sql="SELECT * FROM $tbl_name where mdate='$mdate' and movie_id='$movieid' and time='$stime' and status='not booked' and theatre_id='$tid'";
echo $sql;
$result= $conn->query($sql); ?> 
    <?php while($row= mysqli_fetch_array($result)) { ?> 
        <option value= " <?php echo $row['seat'];?>"> 
            <?php echo $row['seat']; ?> 
        </option> 
    <?php } ?> 
</select>
</td>
</tr>
<tr>
<td></td>
<td></td>
<td><input name="submit" type="Submit" value="Book Ticket" />
</tr>
</table>
</td>

</tr>
</table> 
</form>
    <p align="center"><br />
<b>Seating Plan:</b>
  <table border="1">
  <tr>
    <td width="20px" style="text-align: center">1</td>
    <td width="20px" style="text-align: center">2</td>
    <td width="20px" style="text-align: center">3</td>
    <td width="20px" style="text-align: center">4</td>
  </tr>
  <tr>
    <td width="20px" style="text-align: center">5</td>
    <td style="text-align: center">6</td>
    <td style="text-align: center">7</td>
    <td style="text-align: center">8</td>
  </tr>
  <tr>  
    <td width="20px" style="text-align: center">9</td>
    <td style="text-align: center">10</td>
    <td style="text-align: center">11</td>
    <td style="text-align: center">12</td>
  </tr>
</table>

  </p>
  </div>
    </center>
  </center>
</body>
</html>