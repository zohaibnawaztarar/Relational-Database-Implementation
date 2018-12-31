<?php
$servername = "silva.computing.dundee.ac.uk";
$username = "18ac3u03";
$password = "132acb";
$dbname = "18ac3d03";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
?>