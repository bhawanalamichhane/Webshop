<?php
session_start(); // Starting Session

$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
include './Model/config.php';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);
// Selecting Database
include './Model/config.php'
// SQL query to fetch information of registerd users and finds user match.
$query = "select * from login where password='$password' AND username='$username'";
$result = mysqli_query($conn,$query);
$rows = mysqli_num_rows($result);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
header("location: Management.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysqli_close($conn); // Closing Connection
}
}
?>