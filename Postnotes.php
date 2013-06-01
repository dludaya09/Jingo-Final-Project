<html>
<head>
<form action="PostNote.php?placeid=<?php $placeid=$_GET['placeid']; echo $placeid; ?>" method="post">

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

if(is_null($_SESSION['userid'])){
?>
<script type="text/javascript">
alert("Please Login");
window.close("http://localhost/Jingo/Jingo/PostNote.php");
window.open("http://localhost/Jingo/Jingo/Home.php");
</script>
<?php
}
?>
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
                <li><a href="#addschedule" data-toggle="tab" id="schedule" onClick="schedule()">Add Schedule</a></li>
                <li><a href="#addtag" data-toggle="tab" id="tag" onClick="tag()">Add Tag</a></li>
                <li><a href="#viewnotes" data-toggle="tab" id="notes" onClick="notes()">View Notes</a></li>
                <li><a href="#returnhome" data-toggle="tab" id="returnhome" onClick="home()">Retrun Home</a></li>
                <li><a href="#logout" data-toggle="tab" id="logout" onClick="logout()">Logout</a></li>
            </ul>
        </div>
    </div>
    </div>
<div id="Edit1"></div>
<div class="actions">
    <form id="Edit2" action="PostNote.php" method="post">
    <h3>PostNotes</h3>
    <fieldset>
    <legend>PostNotes</legend>
    <label for="notesid">Notesid</label>
    <input type="text" name="notesid" id="notesid" required><br><br>
    <label for="notes">Notes</label>
    <input type="text" name="notes" id="notes" style="WIDTH: 500px; HEIGHT: 40px" size=11><br>
    <label for="link">Link</label>
    <input type="text" name="link" id="link"><br>
    <label for="radius">Radius</label>
    <input type="text" name="radius" id="radius"><br>
    Locationid:<name="placeid"><?php echo $placeid;    
    ?><br>

Scheduleid:<select name="scheduleid">
<?php
$schedule="select scheduleid from schedule";
$scid=($mysqli->query($schedule));?>
<?php
while ($row = mysqli_fetch_array($scid)){
    $id=$row['scheduleid'];
    echo $id; ?>
    <option value="<?php echo $id; ?>">
    <?php   echo $id;?>
    </option>
<?php
}
?>
</select><br>

Tagid:<br><select name="tagid">
<?php
$tag="select tagid from tags";
$tid=($mysqli->query($tag));?>
<?php
while ($row = mysqli_fetch_array($tid)){
    $tagid=$row['tagid'];
    echo $id; ?>
    <option value="<?php echo $tagid; ?>">
    <?php   echo $tagid;?>
    </option>
<?php
}
?>
</select><br>
<form>
  Visibility:<select name="visibility">
    <option value="Friend">Friend</option>
    <option value="Public">Public</option>
    <option value="Onlyme">onlyme</option>
  </select>
</form>
<br>
<input value="Post" type="submit" id="post">

</fieldset>
</form>
</div>
</head>
<body>
<form action="PostNotes.php" method="post">
<?php 
    $notesid=@$_POST['notesid'];
    $notes=@$_POST['notes'];
    $hyperlink=@$_POST['link'];
    $id=$_SESSION['userid'];
    $radius=@$_POST['radius'];
    $scheduleid=@$_POST['scheduleid'];
    $tagid=@$_POST['tagid'];
    $place=$placeid;
    $visibility=@$_POST['visibility'];
    $likes=0;
    $notesfind="SELECT notesid FROM notes WHERE notesid='$notesid'";
    $find=($mysqli->query($notesfind));
    if($find->num_rows>0){
        ?>
        <script type="text/javascript">
        alert("Notes already exists");
        </script>
        <?php
    }
    if(empty($notesid)){?>
        <script type="text/javascript">
        alert("Please enter notesid");
        </script><?php
    }
    else{

    $insert="INSERT INTO Notes VALUES('$notesid', '$notes', '$hyperlink', $placeid, '$radius', '$id', '$scheduleid', '$tagid', '$visibility', '$likes')";
    $val=($mysqli->query($insert));
    if($val){
    ?>
    <script type="text/javascript">
    alert("Notes successfully created");
    </script>
    <?php 
}
}
?>
<script type="text/javascript">
function logout(){
  window.open("http://localhost/Jingo/Jingo/logout.php");
}
function home(){
  window.open("http://localhost/Jingo/Jingo/Search.php");
}
function schedule(){
  window.open("http://localhost/Jingo/Jingo/schedule.php");
}
function tag(){
  window.open("http://localhost/Jingo/Jingo/tags.php");
}
function notes(){
  window.open("http://localhost/Jingo/Jingo/ViewNote.php");
}
</script>

</body>


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

#Edit1{
position:absoloute;
height: 30px;
width: 100px;
left: 300px;
top: 400px;
}

.actions{
    background-color: #FFFFFF;
    bottom: 100px;
    padding: 0px;
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

.Edit2{
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


#Edit2 fieldset{
  border: none;
}

#Edit2 legend{
  display: none;
}

#Edit2 input, #Edit2 textarea{
display:block;
}

#Edit2 label {
padding:4px 10px 4px 4px;
font-size:1em;
color:#000;
}

#Edit2 input#Post {   

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

#Edit2 input#Post:active{
border:1px solid #3084a4;
}

#Edit2 input#Post:hover, #Login input#login:focus{
box-shadow: inset 0px 1px 0px #3e9cbf, 0px 2px 0px 0px #205c73, 0px 1px 4px #5d6257;
cursor:pointer;
}

</style>
</html>
</html>
