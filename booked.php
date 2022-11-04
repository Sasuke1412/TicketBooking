<?php
session_start();
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="movie_booking"; // Database name 
// Connect to server and select databse.
?>
<?php
//$q=$_GET["q"];

$conn = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($conn,$db_name)or die("cannot select DB");
  
?>
<html>
<head>
<meta http-equiv="refresh" content="3; URL=main2.php">
</head>
<body>
<p>
  <?php
 	$username=$_SESSION['myusername'];
	
	$movie = $_POST['movie'];
	$mdate = $_POST['mdate'];
	$stime = $_POST['stime'];
	$city =$_POST['city'];
	$tname = 	$_POST['theatre'];
	
	$sql3 = "select * from city where city_name='$city'";
	$result3= $conn->query($sql3);
	$row = mysqli_fetch_array($result3);
	$cid= $row['city_id'];
	
	$sql4 = "select * from theatre where theatre_name='$tname'";
	$result4= $conn->query($sql4);
	$row = mysqli_fetch_array($result4);
	$tid= $row['theatre_id'];
	
	$sql2 = "select * from movie where movie_name='$movie' and theatre_id='$tid' and mdate='$mdate' and city_id='$cid' and showtiming='$stime'";
	$result2 = $conn->query($sql2);
	$row = mysqli_fetch_array($result2);
	$movie= $row['movie_id'];
	
	$seat = $_POST['seat'];
	$sql = "select * from theatre where theatre_name='$tname'";
	$result = $conn->query($sql);
	$row = mysqli_fetch_array($result);
	$tid = $row['theatre_id'];
	
	$sql = "select price from movie where movie_id='$movie' and theatre_id='$tid' and mdate='$mdate' and showtiming='$stime'";
	$result =$conn->query($sql);
	$row = mysqli_fetch_array($result);
	$price = $row['price'];
	
	$sql = "Insert into booked (username,seat,movie_id,theatre_id,mdate,time,price) values ('$username','$seat','$movie','$tid','$mdate','$stime','$price')";
	$result =$conn->query($sql);
	if($result)
	{
		echo "Ticket booked succesfully";
	}

	$sql = "Upmdate seats set status='booked' where seat=".$_POST['seat']." and movie_id='$movie' and theatre_id='$tid' and mdate='$mdate' and time='$stime'";
	$result = $conn->query($sql);
?>
</p>
</body>
</head>
</html>