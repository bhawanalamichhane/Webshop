<?php
session_start();
if(!isset($_SESSION["user"])) {
header("Location: adminlogin.php");
exit();
}
$title = "Management";

$content = '<h3>Jewellery</h3>
            <a href="ProductAdd.php">Add a new jewellery</a><br/>
            <a href="uploadImage.php">Upload Image</a><br/>
            <a href="ProductOverview.php">Jewellery Overview</a><br/>
            <a href="logout.php">Logout</a></br>';

include 'template.php';
?>
