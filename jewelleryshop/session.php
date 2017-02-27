<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql="select username from login where username='$user_check'";
$result = mysqli_query($conn, $ses_sql);
$row = mysql_fetch_assoc($result);
$login_session =$row['username'];
if(!isset($login_session)){
mysqli_free_result($result);

mysqli_close($conn); // Closing Connection
header('Location: Management.php'); // Redirecting To Home Page
}
?>