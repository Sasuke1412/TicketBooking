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
$mypassword2=$_POST['mypassword2'];
$myemail=$_POST['myemail'];
$address= $_POST['address'];


$sql="SELECT * FROM $tbl_name WHERE username='$myusername'";
$result=$conn->query($sql);

// Mysql_num_row is counting table row
$count= $result->num_rows;
// If result matched $myusername and $mypassword, table row must be 1 row

if($mypassword!="" && $mypassword!="" && $mypassword2!="" && $myemail!="")
{
if($count==1){echo "User already exist";}
else {
	if($mypassword==$mypassword2)
	{
			$sql="Insert into $tbl_name (username,password,email,userlevel,address) values ('$myusername','$mypassword','$myemail',1,'$address')";
			$result=$conn->query($sql);
			echo "Sing Up Succesfull<br><br>";
			session_start();
			$_SESSION['myusername']=$myusername;
			header("location:first.php");
	}
	else
		echo "Passwords don't match";
}
}
else
{
	echo "One or more fields are empty";
}
ob_end_flush();
?>