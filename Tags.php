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
                <li><a href="#tag" data-toogle="tab" id="tag" onClick="tag()">View Tag</a></li>
                <li><a href="#Return" data-toogle="tab" id="return" onClick="returnhome()">Return Home</a></li>
                <li><a href="#logout" data-toogle="tab" id="logout" onClick="logout()">Logout</a></li>
            </ul>
        </div>
    </div>
    </div>
<div id="Tags1"></div>
<div class="actions">
    <form id="Tags2" action="Tags.php" method="post">
    <h3>Add a new Tag</h3>
    <fieldset>
    <legend>Tags3</legend>
    <label for="tagid">Tagid:</label>
    <input type="text" name="tagid" id="tagid" required><br><br>
    <label for="text">Tag Name</label>
    <input type="text" name="tagname" id="tagname" required><br><br>
    <input type="submit" value="Submit" id="submit"><br>
    </fieldset>
</form>
</div>
</head>
<body>
<form action="Tags.php" method="post">

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
window.close("http://localhost/Jingo/Jingo/Tags.php");
</script>
<?php
}?>

<?php
if($_POST){
    $tagid=$_POST['tagid'];
    $tname=$_POST['tagname'];
    $tfind="SELECT tagid FROM tags WHERE tagid='$tagid'";
    $find=($mysqli->query($tfind));
    if($find->num_rows>0){
    ?> 
    <script type="text/javascript">
    alert("Tag already exists");
    </script>
    <?php }
    else{
    $INSERT="INSERT INTO tags VALUES('$tagid', '$tname')";
    $val=($mysqli->query($INSERT));
    
        ?>
        <script type="text/javascript">
        alert("Tag posted");
        </script>
        <?php
    
    }   
}
?>
<script type="text/javascript">

function returnhome(){
    window.open('http://localhost/Jingo/Jingo/Search.php');
}

function logout(){
   window.open('http://localhost/Jingo/Jingo/Logout.php');
}

function tag(){
   window.open('http://localhost/Jingo/Jingo/viewTag.php');
}

</script>
</body> 
</form>

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
    height: 150px;
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


#Tags1{
position:absoloute;
height: 30px;
width: 100px;
left: 300px;
top: 400px;
}

.actions{
    background-color: #FFFFFF;
    bottom: 150px;
    padding: 10px;
    position: absolute;
    right: 550px;
    z-index: 2;

    border-top: 1px solid #abbbcc;
    border-left: 1px solid #a7b6c7;
    border-bottom: 1px solid #a1afbf;
    border-right: 1px solid #a7b6c7;
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
    border-radius: 20px;
}

.Tags2{
width: 200px;
background: #ffffff; 
margin:20px 0;
padding:10px;
border: 1px solid #597c30;
border-radius:10px; 
box-shadow: 0 0 10px rgba(0,0,0, .65); 
font-family: Open Sans Condensed, Verdana, Arial, Helvetica, sans-serif; 
font-size: 1.1em;
right:500;

}

#Tags2 fieldset{
  border: none;
}

#Tags2 legend{
  display: none;
}

#Tags2 input, #Tag textarea{
display:block;
}

#Tags2 label {
padding:4px 10px 4px 4px;
font-size:1.2em;
color:#000;
}

#Tags2 input#Submit {   

background: #3084a4;
border:1px solid #3084a4;
color:#fff;
text-shadow: 0 -1px 0px rgba(0, 0, 0, 0.3);
padding:5px 10px;
font-size:1.2em;
margin-left:30px;
border-radius:5px;
box-shadow: inset 0px 1px 0px #3e9cbf, 0px 5px 0px 0px #205c73, 0px 4px 4px #5d6257;
}

#Tags2 input#Submit:active{
border:1px solid #3084a4;
}

#Tags2 input#Submit:hover, #Login input#login:focus{
box-shadow: inset 0px 1px 0px #3e9cbf, 0px 2px 0px 0px #205c73, 0px 1px 4px #5d6257;
cursor:pointer;
}

</style>
</html>
