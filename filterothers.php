<html>
<html>
<head>
  <title>Enter Location</title>

<meta name="keywords" content=""></meta>
<meta name="description" content=""></meta>
<meta http-equiv="content-type" content="text/html; charset=utf-8"></meta>
<link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<form action="filterothers.php" method="post">
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
function logout(){
  window.open("http://localhost/Jingo/Jingo/logout.php");
}
function home(){
  window.open("http://localhost/Jingo/Jingo/Search.php");
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
  <form action="filterothers.php" method="post">
  tagname:<input type="text" name="tagname">
  schedule:<input type="date" name="schedule">
  
  <input type="submit" value="submit">
<?php 
    $database='jingo';
    $user='root';
    $password='';
    $mysqli =new mysqli("localhost",$user,$password,$database);
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
session_start();
if(is_null($_SESSION['userid']))
{?>
  <script type="text/javascript">
  alert("Please Login");
  window.close("http://localhost/Jingo/Jingo/SearchUser.php");
  window.open("http://localhost/Jingo/Jingo/Home.php");
  </script>
  <?php
}
$usr=$_SESSION['userid'];
$ID=(int)$usr;
if($_POST){
$schedule=$_POST['schedule'];
$tagname=$_POST['tagname'];
$sql="SELECT distinct n.notesid, n.notes, n.hyperlink, n.place_id, n.radius, n.scheduleid, n.tagid
FROM notes n, tags t, schedule s WHERE t.tagname like '%$tagname%' and userid<>'$ID' and '$schedule' between s.fromDate and s.toDate";

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
if($result=($mysqli->query($sql)))
        {
           while ($row = $result->fetch_array()){
            
             
            echo "<tr>";
            echo "<td>" . $row['notesid'] . "</td>";
            echo "<td>" . $row['notes'] . "</td>";
            echo "<td>" . $row['hyperlink'] . "</td>";
            echo "<td>" . $row['place_id'] . "</td>";
            echo "<td>" . $row['radius'] . "</td>";
            echo "<td>" . $ID . "</td>";
            echo "<td>" . $row['scheduleid'] . "</td>";
            echo "<td>" . $row['tagid'] . "</td>";
            echo '<td><a href="Note.php?notesid='.$row['notesid'].'">View</a></td>';

            echo "</tr>";
              
            }
           }
         }?>
         </body>
         </html>
