<?php
session_start();
?>


<?php
   if( $_SESSION["login"] == "yes" )
    header("Location: totravellist.php");
?>

<?php

if (isset($_GET["login"]))
{
$_SESSION["login"] = $_GET["login"];
}

?>

<!DOCTYPE html>
<html>



<head>


     <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="accountstylesheet.css">
          <link rel="stylesheet" type="text/css" href="footer.css">
        <link rel="stylesheet" type="text/css" href="buttonstyle.css">
      <title>
          TO TRAVEL LIST
      </title>


</head>

<body>


        <ul>
  <li><a href="index.html">Home</a></li>
  <li><a href="travelmap.html">Travel Map</a></li>
  <li><a href="http://localhost/myfiles/totravellist.php">To Travel List</a></li>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn" onclick="myFunction()">Food and Travel Diaries</a>
    <div class="dropdown-content" id="myDropdown">
      <a href="food and travel diaries/austrialia.html">Australia</a>
      <a href="food and travel diaries/india.html">India</a>
      <a href="food and travel diaries/singapore.html">Singapore</a>
      <a href="food and travel diaries/Scotland.html">Scotland</a>
    </div>
  </li>
  <li><a href="topdest/index.html">Top Destinations</a></li>
  <li><a href="packing/index.html">Packing Guide</a></li>
</ul>

<br>
<br>
<br>






<?php
$username=$password= "";
$noaccountErr="";


if ($_SERVER["REQUEST_METHOD"] == "POST")
{


$username=test_input($_POST["username"]);
$password=test_input($_POST["password"]);


$conn = new mysqli("localhost", "root","","myDB");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$sql = "SELECT * FROM logindet where username='$username' and password='$password'";


$result = $conn->query($sql);

if ($result->num_rows > 0)
{
   $_SESSION["login"] = "yes";
   $_SESSION["username"] = $username;
   header("Location: totravellist.php");
}
else {
    $noaccountErr="no account exist";
}


$conn->close();
  }



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>




 <div class="form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
       <h1 class="formhead">ENTER LOGIN DETAILS : </h1>
         <BR><BR>
         USERNAME : <br><br><input type="text" name="username"></input><br></br>
         PASSWORD : <br><br><input type="password" name="password"></input><br></br><br>
         <input type="submit" class="button"></input><span class="error"> <?php echo $noaccountErr;?></span>
    </form>
    <br><br>
    <h3>OR</h3><br>
        <a href="http://localhost/myfiles/createaccount.php" class="lo">CREATE ACCOUNT</a>
</div>
<br><br>
<br><br>
 <div class="footer-wrap">
    <footer class="site-footer site-footer-links">
      <nav>

        <a href="https://www.facebook.com/Studentwasim">FACEBOOK</a>
        <a href="https://www.quora.com/profile/Wasim-Akram-94">QUORA</a>
        <a href="https://www.instagram.com/studentwasim/">INSTAGRAM</a>
      </nav>
    </footer>
</div>



          <script>


    function myFunction()
    {
    document.getElementById("myDropdown").classList.toggle("show");
    }


    window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var d = 0; d < dropdowns.length; d++) {
      var openDropdown = dropdowns[d];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

      </script>





</body>

</html>

