<?php
ob_start();
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="movie_booking"; // Database name 
$tbl_name="users_tbl"; // Table name
// Connect to server and select databse.
$conn = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($conn,$db_name)or die("cannot select DB");

// Define $myusername and $mypassword 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword'];



$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result= $conn->query($sql);

// Mysql_num_row is counting table row
$count= $result->num_rows;
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
/*$myemail=mysql_result($result,0,"email");
$userlevel=mysql_result($result,0,"userlevel");*/
session_start();
$_SESSION['myusername']=$myusername;
header("location:first.php");
}
else {
echo "Wrong Username or Password";
}

ob_end_flush();
?>


