<html>
<head>
  <title>Enter Location</title>

<meta name="keywords" content=""></meta>
<meta name="description" content=""></meta>
<meta http-equiv="content-type" content="text/html; charset=utf-8"></meta>
<link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<form action="Places.php" method="post">
  <div id="Jingo">
    <div id="header" class="container">
        <div id="logo">
            <h1>Jingo </a></h1>
        </div>
        <div id="menu">
            <ul>
                <li><a href="#returnhome" data-toggle="tab" id="returnhome" onClick="home()">Retrun Home</a></li>
                <li><a href="#logout" data-toggle="tab" id="logout" onClick="logout()">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">

function returnhome(){
    window.open('http://localhost/Jingo/Jingo/Search.php');
}

function logout(){
   window.open('http://localhost/Jingo/Jingo/Logout.php');
}

</script>
<style type="text/css">
html, body{
    height: 100%;
    font-family: 'Open Sans Condensed', sans-serif;
    font-size: 16px;
    color: #000000;
}
#Jingo {
    overflow: hidden;
    height: 90px;
    background: url(img02.jpg) repeat-x left top;
}

#header {
    width: 950px;
    height: 200px;
    margin: 0 auto;
    padding: 0px 20px;
    background: url(img01.jpg) no-repeat left top;
}
</style>
</head>
<body>
<?php

        $database='jingo';
        $user='root';
        $password='';
        $mysqli =new mysqli("localhost",$user,$password,$database);
        if (mysqli_connect_errno()) {
               printf("Connect failed: %s\n", mysqli_connect_error());
               exit();
               session_start();

        }
if(isset($_POST['myaddress'])){
$myaddress = urlencode($_POST['myaddress']);

$url = "http://maps.googleapis.com/maps/api/geocode/json?address=$myaddress&sensor=false";
$getmap = file_get_contents($url); 
$googlemap = json_decode($getmap);
foreach($googlemap->results as $res){
   $address = $res->geometry;
   $latlng = $address->location;
   $formattedaddress = $res->formatted_address;

?>
<br />
<?php echo "Latitude: ". $latlng->lat ."<br />". "Longitude:". $latlng->lng; ?>
<h2>Our Location is!</h2>
<iframe class="map" width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $myaddress;?>&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo urlencode($formattedaddress);?>&amp;t=m&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
<?php
}
}
        $place=@$_POST['myaddress'];
        $lat=@$latlng->lat;
        $lng=@$latlng->lng;
        $sql="INSERT INTO places(place, lat, lng) VALUES('$place', '$lat', '$lng')";
        $val=($mysqli->query($sql));
        $placeid = $mysqli->insert_id;
        $_SESSION['place']=$place; 
        ?>
        <br />
  <form action="Places.php" method="post">
    Type Your Location : <input type="text" name="myaddress" /> (eg.Brooklyn, NewYork)
    <input type="submit" value="submit">
    <a href="PostNote.php?placeid=<?php echo $placeid; ?>">Post Notes at <?php
        echo $place;?>
  </form>
<br />       

</body>
<script type="text/javascript">
function notes(){
  window.open('http://localhost/Jingo/Jingo/PostNote.php?');
}
</script>
</form>
</html>
