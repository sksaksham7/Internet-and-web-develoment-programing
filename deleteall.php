<?php
session_start();
?>

<?php


$conn = new mysqli("localhost", "root","","myDB");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 $username=$_SESSION["username"];

$sql = "DELETE FROM userlist WHERE username='$username'";



if ($conn->query($sql) === TRUE) {
   header("Location: totravellist.php");
}



$conn->close();


?>
