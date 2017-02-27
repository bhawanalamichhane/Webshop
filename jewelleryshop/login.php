<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="Styles/style2.css" />
</head>
<body>
<?php
session_start();
require('config.php');
//create connection 
$conn = mysqli_connect($servername, $username, $password, $dbname);

//check connection
if (!$conn) {
  die("connection failed:" .mysqli_connect_error());
}
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($conn,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn,$password);
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='".md5($password)."'";
	$result = mysqli_query($conn,$query) or die(mysqli_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['username'] = $username;
            // Redirect user to index.php
	    header("Location: index1.php");
         }else{
	echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
	}
    }else{
?>
 <div class="form">
<h1>Log In</h1>
<a href = "index.php">Back</a>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Username" required /><br />
<input type="password" name="password" placeholder="Password" required /><br />
<input name="submit" type="submit" value="Login" /><br />
</form>
<p>Not registered yet? <a href='register.php'>Register Here</a></p>
</div>
<?php } ?>
</body>
</html>
