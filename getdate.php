<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="movie_booking"; // Database name 
// Connect to server and select databse.
session_start();
$movieid=$_GET["q"];
$cityid= $_SESSION['city'];
$conn = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($conn,$db_name)or die("cannot select DB");


$sql="SELECT * FROM movie WHERE movie_id = '".$movieid."' and status='Now Showing' and city_id='$cityid' group by mdate";
echo $sql;
$result= $conn->query($sql);

	 echo "<select name ='mdate' id ='mdate'>";
	 echo "<option value=\"\">--Select Date--</option>";
while($row = mysqli_fetch_array($result))
  {
	  
	 echo "<option value=".$row['mdate'].">".$row['mdate']." </option> ";
  }
		echo "</select>";


mysql_close($con);
?>