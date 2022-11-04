<?php
session_start();
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="movie_booking"; // Database name 
// Connect to server and select databse.
 $conn = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
  
   

	function moviename($movie){
		$sql="Select * from movie where movie_id='$movie'" ;
		$sqlresult=mysql_query($sql);
		$row = mysqli_fetch_array($sqlresult);
		return $row['movie_name'];
		
	}
	function theatername($tname){
	$sql = "select * from theatre where theatre_name='$tname'";
	$sqlresult=mysql_query($sql);
	$row = mysqli_fetch_array($sqlresult);
	return $row['theatre_id'];	
	}
	 mysqli_select_db($conn,$db_name)or die("cannot select DB"); 
 	$username=$_SESSION['myusername'];
	$sql = "select * from booked where username='$username' ORDER BY mdate DESC";
	$result =$conn->query($sql); ?>
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
	<table width="80%">
	<tr>
	 <td>Name </td>
	 <td>Theater </td>
	 <td>Movie </td>
	  <td>Srat No</td>
	 <td>Date </td>
	 <td>Time </td>
	 <td>Price</td>
	</tr>
	<?php
	while($row = mysqli_fetch_array($result)){  
	echo '<tr>';
	echo '<td>'.$row["username"].'</td>';
	echo '<td>'.theatername($row["theatre_id"]).'</td>';
	echo '<td>'.moviename($row["movie_id"]).'</td>';
	echo '<td>'.$row["seat"].'</td>';
	echo '<td>'.$row["mdate"].'</td>';
	echo '<td>'.$row["time"].'</td>';
	echo '<td>'.$row["price"].'</td>';
	echo '</tr>';
	}
	?>
</p>
</body>
</head>
</html>

