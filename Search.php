<html>
<head>
<meta name="keywords" content=""></meta>
<meta name="description" content=""></meta>
<meta http-equiv="content-type" content="text/html; charset=utf-8"></meta>
<title>Jingo</title>
<link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />

<div id="Jingo">
    <div id="header" class="container">
        <div id="logo">
            <h1><a href="#">Jingo </a></h1>
        </div>
        <div id="menu">
            <ul>
              <li><a href="#searchlocation"data-toggle="tab" id="location" onClick="loc()">Search Location</a></li>
              <li><a href="#profile" data-toggle="tab" id="profile" onClick="profile()">View Profile</a></li>
              <li><a href="#friends" data-toggle="tab" id="friends" onClick="friends()">Search People</a></li>
              <li><a href="#findloc" data-toggle="tab" id="findloc" onClick="findloc()">Search location by radius</a></li>
              <li><a href="#findnotes" data-toggle="tab" id="findnotes" onClick="findnotes()">Find notes by others</a></li>
              <li><a href="#logout" data-toggle="tab" id="logout" onClick="logout()">Logout</a></li>
              
            </ul>
        </div>
    </div>
    </div>
    <div id="content"><br><br>
      Hi,

      Welcome to home page. <br>
      You can Search a location, post a notes at location, view your friends notes.<br>
      You can also find nearby locations based on radius.<br>
      You can add schedules and tags to a notes. You can view different schedules and tags<br>

    </div>
</head>
<body>

<form action="login.php" method="post">
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
{
  ?>
  <script type="text/javascript">
  alert("Please Login");
  window.close("http://localhost/Jingo/Jingo/Search.php");
  </script>
  <?php
}?>

<div id="UserProfile">
  <div class="actions">
    <form id="Tags2" action="Tags.php" method="post">
</form>
</div>
  </div>
<script type="text/javascript">
function loc(){
  window.open("http://localhost/jingo/Jingo/Places.php");
}
function profile(){
  window.open("http://localhost/jingo/Jingo/ViewProfile.php");
}
function friends(){
  window.open("http://localhost/jingo/Jingo/SearchUser.php");
}
function findloc(){
  window.open("http://localhost/Jingo/Jingo/filtersearch.php");
}
function findnotes(){
  window.open("http://localhost/jingo/jingo/filterothers.php");
}
function logout(){
  window.open("http://localhost/jingo/Jingo/logout.php");
}
</script>
</font>
</form>
</body>

<style type="text/css">
html, body{
    height: 100%;
    font-family: 'Open Sans Condensed', sans-serif;
    font-size: 16px;
    color: #000000;
}

body {
    margin: 0;
    padding: 0;
    background: #ffffff url(images/img01.jpg) repeat;
    font-family: 'Open Sans Condensed', sans-serif;
    font-size: 16px;
    color: #000000;
}

h1, h2, h3 {
    margin: 0;
    padding: 0;
    text-transform: lowercase;
    font-weight: normal;
    color: #000000;
}

h1 {
    font-size: 2em;
}

h2 {
    font-size: 2.8em;
}

h3 {
    font-size: 1.6em;
}

p, ul, ol {
    margin-top: 0;
    line-height: 180%;
}

ul, ol {
}

a {
    text-decoration: none;
    color: #000000;
}

a:hover {
}

#wrapper {
    overflow: hidden;
    background-color: #FFFFFF;
}

.container {
    width: 1000px;
    margin: 0px auto;
}

/* Header */

#Jingo{
    overflow: hidden;
    height: 300px;
    background: url(img02.jpg) repeat-x left top;
}

#header {
    width: 960px;
    height: 200px;
    margin: 0 auto;
    padding: 0px 20px;
    background: url(img01.jpg) no-repeat left top;
}



/* Logo */

#logo {
    float: left;
    width: 300px;
    margin: 0;
    padding: 0;
    color: #000000;
}

#logo h1, #logo p {
}

#logo h1 {
    padding: 60px 0px 0px 0px;
    letter-spacing: -2px;
    text-transform: lowercase;
    font-size: 3.8em;
}

#logo p {
    margin-top: -10px;
    padding: 0px 0px 0px 5px;
    font-size: 22px;
    color: #FFFFFF;
} 

#logo p a {
    color: #FFFFFF;
}

#logo a {
    border: none;
    background: none;
    text-decoration: none;
    color: #FFFFFF;
}


#menu {
    float: right;
    width: 500px;
    height: 90px;
    margin: 0 auto;
    padding: 0;
}

#menu ul {
    float: right;
    margin: 0;
    padding: 85px 0px 0px 0px;
    list-style: none;
    line-height: normal;
}

#menu li {
    float: left;
}

#menu a {
    display: block;
    margin-right: 1px;
    padding: 10px 0px 15px 30px;
    text-decoration: none;
    text-transform: lowercase;
    text-align: center;
    font-size: 20px;
    font-weight: 300;
    color: #FFFFFF;
    border: none;
}

#menu a:hover, #menu .current_page_item a {
    text-decoration: none;
    color: #000000;
}

</html>
