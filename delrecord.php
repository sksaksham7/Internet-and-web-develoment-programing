<?php


$conn = new mysqli("localhost", "root","","myDB");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$des=$_POST["deldes"];

$sql = "DELETE FROM userlist WHERE destination='$des'";



if ($conn->query($sql) === TRUE) {
   header("Location: totravellist.php");
}



$conn->close();


?>
