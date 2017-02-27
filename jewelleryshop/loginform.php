<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: Management.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Form for Admin</title>

</head>
<body>
<div id="main">
<h1>Admin Login </h1>
<div id="login">
<h2>Login Form</h2>
<form action="" method="post">
<label>UserName :</label><br>
<input id="name" name="username" placeholder="username" type="text"><br>
<label>Password :</label><br>
<input id="password" name="password" placeholder="**********" type="password"><br>
<input name="submit" type="submit" value=" Login ">
<span><?php echo $error; ?></span>
</form>
</div>
</div>
</body>
</html>
