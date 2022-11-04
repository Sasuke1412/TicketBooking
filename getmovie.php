<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="movie_booking"; // Database name 
// Connect to server and select databse.
session_start();
echo $city= $_GET["q"];
$city = stripslashes($city);
$_SESSION['city']=$city;
$conn = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($conn,$db_name)or die("cannot select DB");

$sql="SELECT * FROM movie WHERE city_id = '".$city."' and status='Now Showing' group by movie_name";

$result= $conn->query($sql);
	 echo "<select name ='movie' id ='movie' onchange=\"showdate(this.value)\">";
	 echo "<option value=\"\">--Select Movie--</option>";
while($row = mysqli_fetch_array($result))
  {
	 echo "<option value=".$row['movie_id'].">".$row['movie_name']." </option> ";

  }
		echo "</select>";


mysql_close($con);
?>