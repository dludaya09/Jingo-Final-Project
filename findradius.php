<html>
<head>
  <title>Enter Location</title>

<meta name="keywords" content=""></meta>
<meta name="description" content=""></meta>
<meta http-equiv="content-type" content="text/html; charset=utf-8"></meta>
<link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<form action="filtersearch.php" method="post">
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
        $platlng="SELECT lat, lng FROM places";
        
        if($result=($mysqli->query($platlng)))
        {
            while ($row = $result->fetch_row()){
            foreach($row as $key=>$value){
             
              $radius="SELECT * , 6371 * ACOS( SIN( RADIANS( $lat ) ) * SIN( RADIANS( $row[0] ) ) + COS( RADIANS( $lat ) ) * COS( RADIANS( $row[0] ) ) * COS( RADIANS( $row[1] ) - RADIANS( $lng ) ) ) AS distance FROM places, notes, tags WHERE places.place_id = notes.place_id  and notes.radius <=200 
              ORDER BY notes.radius ASC LIMIT 0 , 30";
              $rad=$mysqli->query($radius);
              
            }
          }
        }

       echo "<table border='1'>
        <tr>
        <th> Notesid </th>
        <th> Notes </th>
        <th> Hyperlink </th>
        <th> Placeid </th>
        <th> Radius </th>
        <th> Userid </th>
        <th> Scheduleid </th>
        <th> Tagid </th>        
        </tr>";
         if($result=($mysqli->query($radius)))
        {
           while ($row = $result->fetch_array()){
            
             
            echo "<tr>";
            echo "<td>" . $row['notesid'] . "</td>";
            echo "<td>" . $row['notes'] . "</td>";
            echo "<td>" . $row['hyperlink'] . "</td>";
            echo "<td>" . $row['place_id'] . "</td>";
            echo "<td>" . $row['radius'] . "</td>";
            echo "<td>" . $row['userid'] . "</td>";
            echo "<td>" . $row['scheduleid'] . "</td>";
            echo "<td>" . $row['tagid'] . "</td>";
            echo '<td><a href="Note.php?notesid='.$row['notesid'].'">View</a></td>';

            echo "</tr>";
              
            }
           }
         


        ?>
        <br />
  <form action="" method="post">
    Type Your Location : <input type="text" name="myaddress" /> (eg.Brooklyn, NewYork)
    <input type="submit" value="submit">

    
  </form>
<br />       

</body>
</html>
