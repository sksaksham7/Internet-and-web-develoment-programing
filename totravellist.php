<?php
session_start();
?>

<!DOCTYPE html>
<html>


<head>
     <meta name="viewport" content="width=device-width, initial-scale=1">

           <link rel="stylesheet" type="text/css" href="ttlstyle.css">
            <link rel="stylesheet" type="text/css" href="buttonstyle.css">
                <link rel="stylesheet" type="text/css" href="footer.css">
             <link rel="stylesheet" type="text/css" href="temp.css">
      <title>
          TO TRAVEL LIST
      </title>

<style>



</style>

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
     if($_SESSION["login"] == "no")
        header("Location: login.php");
 ?>



<div class="logoutlink">
    <a href="http://localhost/myfiles/login.php?login=no" class="lo">LOGOUT</a>
</div>

<br><br>



<?php

$inserterror= "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{



$i = $_POST['who'];
$cooli="%";
foreach ($i as $who)
  $cooli=$cooli.$who."%";


$mq= $_POST['mq'];
$fq= $_POST['fq'];
$cq= $_POST['cq'];



$k = $_POST['wheres'];
$coolk="%";
foreach ($k as $wheres)
  $coolk=$coolk.$wheres."%";


$l = $_POST['activity'];
$cooll="%";
foreach ($l as $act)
  $cooll=$cooll.$act."%";


$conn = new mysqli("localhost", "root","","myDB");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$username=$_SESSION["username"] ;
$destination = $_POST["destination"];
$dateofvisit=$_POST["dateofvisit"];
$dateofreturn=$_POST["dateofreturn"];


$sql = "INSERT INTO userlist(username,who,destination,stay,activities,dateofvisit,dateofreturn) VALUES ('$username','$cooli','$destination','$coolk','$cooll','$dateofvisit','$dateofreturn')";



if ($conn->query($sql) === TRUE)
{
    header("Location: totravellist.php");
}
else
{
    $inserterror="New to travel destination not added";
}




$conn->close();



}

?>






<div class="form">
    <form name="checklist" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
       <h1 class="head">ADD TO LIST : </h1>
         <BR><BR>

       <?php


$username=$_SESSION["username"];

$conn = new mysqli("localhost", "root","","myDB");


$sql = "SELECT * FROM userlist where username='$username'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
{

  echo "<div style='margin:auto;width:90%;text-align:left;padding:20px;color:rgb(28, 184, 65);font-size:15px'>";
    while($row = $result->fetch_assoc())
    {
        echo "<table>";
        echo "<tr><th> DESTINATION: </th><td>&nbsp&nbsp&nbsp" . $row["destination"]. "</td></tr><tr> <th> DATE:</th><td>&nbsp&nbsp&nbsp". $row["dateofvisit"]."</td></tr><tr><th>"." WITH:</th>";
        $pieces1 = explode("%",$row["who"]);
        $pieces3 = explode("%",$row["stay"]);
        $pieces4 = explode("%",$row["activities"]);

        echo "<td>";
        for($f=0;$f<count($pieces1);$f++)
          {
            echo $pieces1[$f]."&nbsp&nbsp ";
          }
        echo "</td></tr><tr>";
        echo "<th> ACCOMODATION PLANNED:</th>&nbsp&nbsp&nbsp";
        echo "<td>";
        for($f=0;$f<count($pieces3);$f++)
          {
            echo $pieces3[$f]."&nbsp&nbsp ";
          }
        echo "</td></tr><tr>";
        echo "<th> ACTIVITIES PLANNED:</th>&nbsp&nbsp&nbsp ";
        echo "<td>";
        for($f=0;$f<count($pieces4);$f++)
          {
            echo $pieces4[$f]."&nbsp&nbsp ";
          }
        echo "</td></tr></table>";
        echo "<br><br><br><br>";
    }
  echo "</div>";
}
 else
 {
    echo "No Destination in LIST <br><br>";
}


$conn->close();
?>



<br><br>

<div class="table1">
<table>
             WHO'S TRAVELLING WITH YOU:
            <tr>
            <td><br><br><br><input id="chk_mom" class="vis-hidden" type="checkbox" name="who[]" value="Mom"></input><label for="chk_mom">MOM</label></td>
            <td><br><br><br><input id="chk_dad" class="vis-hidden" type="checkbox" name="who[]" value="Dad"></input><label for="chk_dad">DAD</label></td>
             <td><br><br><br><input id="chk_wife" class="vis-hidden" type="checkbox" name="who[]" value="Wife"></input><label for="chk_wife">WIFE</label></td>
             <td><br><br><br><input id="chk_husband" class="vis-hidden" type="checkbox" name="who[]" value="Husband"></input><label for="chk_husband">HUSBAND</label></td>
             <td><br><br><br><input id="chk_alone" class="vis-hidden" type="checkbox" name="who[]" value="Alone"></input><label for="chk_alone">ALONE</label></td>
             <td><br><br><br><input id="chk_kids" class="vis-hidden" type="checkbox" name="who[]" value="Kids"></input><label for="chk_kids">KIDS</label></td>
             <td><br><br><br><input id="chk_friends" class="vis-hidden" type="checkbox" name="who[]" value="friends"></input><label for="chk_friends">FRIENDS</label></td>
            </tr>

</table>
</div>
<br><br><br>
<div class="table2">
            <table>

            WHERE ARE YOU PLANNING TO TRAVELLING :
            <tr>
            <td><br></br>DESTINATION : </td>
            <td>

<br></br>
<select name="destination">


<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp;amp; Barbuda">Antigua &amp;amp; Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia &amp;amp; Herzegovina">Bosnia &amp;amp; Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Canary Islands">Canary Islands</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Channel Islands">Channel Islands</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Island">Cocos Island</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote DIvoire">Cote D'Ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curaco">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Ter">French Southern Ter</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malaysia">Malaysia</option>
<option value="Malawi">Malawi</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Midway Islands">Midway Islands</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Nambia">Nambia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherland Antilles">Netherland Antilles</option>
<option value="Netherlands">Netherlands (Holland, Europe)</option>
<option value="Nevis">Nevis</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau Island">Palau Island</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Pitcairn Island">Pitcairn Island</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Republic of Montenegro">Republic of Montenegro</option>
<option value="Republic of Serbia">Republic of Serbia</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="St Barthelemy">St Barthelemy</option>
<option value="St Eustatius">St Eustatius</option>
<option value="St Helena">St Helena</option>
<option value="St Kitts-Nevis">St Kitts-Nevis</option>
<option value="St Lucia">St Lucia</option>
<option value="St Maarten">St Maarten</option>
<option value="St Pierre &amp;amp; Miquelon">St Pierre &amp;amp; Miquelon</option>
<option value="St Vincent &amp;amp; Grenadines">St Vincent &amp;amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome &amp;amp; Principe">Sao Tome &amp;amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tahiti">Tahiti</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad &amp;amp; Tobago">Trinidad &amp;amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp;amp; Caicos Is">Turks &amp;amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Vatican City State">Vatican City State</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
<option value="Wake Island">Wake Island</option>
<option value="Wallis &amp;amp; Futana Is">Wallis &amp;amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>


      </select>

            </td>
            </tr>

            </table>
            </div>
<br><br><br>



            <div class="table3">
            <table>
            WHERE WILL YOU STAY :

            <tr>
            <td><br><br><br><input id="chk_hotel" class="vis-hidden" type="checkbox" name="wheres[]" value="Hotel"></input><label for="chk_hotel">HOTEL</label></td>
            <td><br><br><br><input id="chk_guest" class="vis-hidden" type="checkbox" name="wheres[]" value="Guest-House" ></input><label for="chk_guest">GUESTHOUSE</label></td>
            <td><br><br><br><input id="chk_camping" class="vis-hidden" type="checkbox" name="wheres[]" value="Camping"></input><label for="chk_camping">CAMPING</label></td>
            <td><br><br><br><input id="chk_other" class="vis-hidden" type="checkbox" name="wheres[]" value="Other"></input><label for="chk_other">OTHER</label></td>
            </tr>
            </table>
            </div>
            <br><br><br>


            <div class="table4">
            <table>
            PLANNED ACTIVITIES :
            <tr>
            <td><br><br><br><input id="chk_fishing" class="vis-hidden" type="checkbox" name="activity[]" value="Fishing"></input><label for="chk_fishing">FISHING</label></td>
            <td><br><br><br><input id="chk_diving" class="vis-hidden" type="checkbox" name="activity[]" value="Diving" ></input><label for="chk_diving">DIVING</label></td>
            <td><br><br><br><input id="chk_cruise" class="vis-hidden" type="checkbox" name="activity[]" value="Cruise"></input><label for="chk_cruise">CRUISE</label></td>
            <td><br><br><br><input id="chk_work" class="vis-hidden" type="checkbox" name="activity[]" value="Work"></input><label for="chk_work">BUSINESS/WORK</label></td>
            <td><br><br><br><input id="chk_hiking" class="vis-hidden" type="checkbox" name="activity[]" value="Hiking"></input><label for="chk_hiking">HIKING</label></td>
            <td><br><br><br><input id="chk_skiing" class="vis-hidden" type="checkbox" name="activity[]" value="Skiing"></input><label for="chk_skiing">SKIING</label></td>
            <td><br><br><br><input id="chk_going" class="vis-hidden" type="checkbox" name="activity[]" value="Going-out"></input><label for="chk_going">GOING OUT</label></td>
            <td><br><br><br><input id="chk_pother" class="vis-hidden" type="checkbox" name="activity[]" value="Other"></input><label for="chk_pother">OTHER</label></td>
            </tr>
            </table>
            </div>

            <br><br><br><br><br>


      DATE OF PLANNED TRIP : <input type="date" name="dateofvisit"></input><br><br><br><br>

      DATE OF RETURN : <input type="date" name="dateofreturn"></input><br><br><br><br>


<br><br><br><br>
                    DONE ?? <input type="submit" value="CREATE CHECKLIST" class="button"/><?php echo $inserterror;?>




    <br><br>

    </form>

</div>

<br><br>

<div class="form1">

        <form action="delrecord.php" method="post">
            <h1 class="head">DELETE FROM LIST : </h1><br><br>
        DESTINATION TO DELETE FROM LIST :
        <select name="deldes">
              <option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp;amp; Barbuda">Antigua &amp;amp; Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia &amp;amp; Herzegovina">Bosnia &amp;amp; Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Canary Islands">Canary Islands</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Channel Islands">Channel Islands</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Island">Cocos Island</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote DIvoire">Cote D'Ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curaco">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Ter">French Southern Ter</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malaysia">Malaysia</option>
<option value="Malawi">Malawi</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Midway Islands">Midway Islands</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Nambia">Nambia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherland Antilles">Netherland Antilles</option>
<option value="Netherlands">Netherlands (Holland, Europe)</option>
<option value="Nevis">Nevis</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau Island">Palau Island</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Pitcairn Island">Pitcairn Island</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Republic of Montenegro">Republic of Montenegro</option>
<option value="Republic of Serbia">Republic of Serbia</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="St Barthelemy">St Barthelemy</option>
<option value="St Eustatius">St Eustatius</option>
<option value="St Helena">St Helena</option>
<option value="St Kitts-Nevis">St Kitts-Nevis</option>
<option value="St Lucia">St Lucia</option>
<option value="St Maarten">St Maarten</option>
<option value="St Pierre &amp;amp; Miquelon">St Pierre &amp;amp; Miquelon</option>
<option value="St Vincent &amp;amp; Grenadines">St Vincent &amp;amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome &amp;amp; Principe">Sao Tome &amp;amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tahiti">Tahiti</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad &amp;amp; Tobago">Trinidad &amp;amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp;amp; Caicos Is">Turks &amp;amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Vatican City State">Vatican City State</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
<option value="Wake Island">Wake Island</option>
<option value="Wallis &amp;amp; Futana Is">Wallis &amp;amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>

        </select><br></br><br><br><br><br>
        <input type="submit" value="DELETE DESTINATION" class="button"></input>
        </form>
        <form action="deleteall.php"><br>
            <input type="submit" value="CLEAR ALL" class="button"></input>
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
