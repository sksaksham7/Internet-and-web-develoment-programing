<?php
session_start();
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
<?php $_SESSION["accountcreated"] = "no"; ?>

<?php
$fname =$lname = $email=$nusername=$npassword=$repassword=$inserterror= "";
$fnameErr =$lnameErr = $emailErr = $repasswordErr =$npasswordErr =$nusernameErr =$matchErr="";


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  if (empty($_POST["fname"]))
  {
    $fnameErr = "First Name is required";
  }
  else
  {
    $fname = test_input($_POST["fname"]);

    if (!preg_match("/^[a-zA-Z ]*$/",$fname))
    {
      $fnameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["lname"]))
  {
    $lnameErr = "Last Name is required";
  }
  else
  {
    $lname = test_input($_POST["lname"]);

    if (!preg_match("/^[a-zA-Z ]*$/",$lname))
    {
      $lnameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["nusername"]))
  {
    $nusernameErr = "username is required";
  }
  else {
    $nusername=test_input($_POST["nusername"]);
      }

 $npassword=test_input($_POST["npassword"]);

  if (empty($_POST["npassword"]))
  {
    $npasswordErr = "password is required";
  }
  else {
   $npassword=test_input($_POST["npassword"]);
      }

 $repassword=test_input($_POST["repassword"]);

  if (empty($_POST["repassword"]))
  {
    $repasswordErr = "re-enter password is required";
  }
  else {
   $repassword=test_input($_POST["repassword"]);
      }

  if ($repassword!=$npassword)
  {
    $matchErr = "passwords don't match";
  }



if($fnameErr =="" and $lnameErr =="" and $emailErr == "" and $repasswordErr == "" and $npasswordErr == "" and $nusernameErr == "" and $matchErr == "")
  {
$conn = new mysqli("localhost", "root","","myDB");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$sql = "INSERT INTO logindet (fname,lname,email,password,username) VALUES ('$fname', '$lname','$email','$npassword','$nusername' )";



if ($conn->query($sql) === TRUE)
{
    $_SESSION["accountcreated"] = "yes";
    header("Location: login.php");
}
else
{
    $inserterror="Account was not created";
}


$conn->close();
  }


}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>



<br>
<br>

<div class="form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
       <h1 class="formhead"> CREATE ACCOUNT : </h1>
         <BR><BR>
         FIRST NAME : <br><br><input type="text" class="input-list style-1 clearfix" name="fname" value="<?php echo $fname;?>">
                      <span class="error"> <?php echo $fnameErr;?></span><br></br>
         LAST NAME  : <br><br><input type="text" name="lname" value="<?php echo $lname;?>">
                       <span class="error"> <?php echo $lnameErr;?></span><br></br>
         EMAIL : <br><br><input type="text" name="email" value="<?php echo $email;?>">
                       <span class="error"> <?php echo $emailErr;?></span><br></br>
         USERNAME :  <br><br><input type="text" name="nusername" value="<?php echo $nusername;?>">
                       <span class="error"> <?php echo $nusernameErr;?></span><br></br>
         PASSWORD :  <br><br><input type="password" name="npassword" value="<?php echo $npassword;?>">
                       <span class="error"> <?php echo $npasswordErr;?></span><br></br>
         RE-ENTER PASSWORD :  <span class="error"> <?php echo $repasswordErr;?></span>
                             <br><br><input type="password" name="repassword" value="<?php echo $repassword;?>">
                            <span class="error"> <?php echo $matchErr;?></span><br></br>
         <br><input type="submit" value="CREATE" class="button"></input><span class="error"> <?php echo $inserterror;?></span>

    </form>
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

