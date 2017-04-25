<meta http-equiv="refresh" content="10">
<?php
session_start();
$msgid=$_SESSION['msgid'];
$id=$_SESSION['id'];
echo"<head>
<script>
function autoScrolling() {
   window.scrollTo(0,document.body.scrollHeight);
}
</script>
</head>
<body bgcolor='lightgrey' onload=autoScrolling()>";
$r;
$no;
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"instaMsg");
$val_chn=mysqli_query($con,"UPDATE ".$id."t set val=0 WHERE id=".$msgid);
$msgid=$_SESSION['msgid'];
$id=$_SESSION['id'];
if($id<$msgid){
$table=$id."to".$msgid;
}
else
$table=$msgid."to".$id;
$query=mysqli_query($con,"SELECT * from ".$table);
if(!$query)
{
$sql="CREATE TABLE ".$table." (
id INT(3),
msg VARCHAR(500))";
mysqli_query($con,$sql);
}

$msgload=mysqli_query($con,"Select * from ".$table);
while($row=mysqli_fetch_assoc($msgload)){

$name=$row['id'];
$msg=$row['msg'];
if($name==$msgid){
echo "<div style='
position:fixed;background-color:lightgreen;display:inline;
border-top-right-radius:15px;
border-bottom-right-radius:15px;
border-top-left-radius:15px;
box-shadow:  10px 10px 5px #888888;
padding: 8px 8px 8px 8px ;'>".$msg."
</div><br><br>";
}
else
{echo "<div style='
position:fixed;background-color:white;right:10px;display:inline;
border-top-right-radius:15px;
border-bottom-left-radius:15px;
border-top-left-radius:15px;
box-shadow:  10px 10px 5px #888888;
padding: 8px 8px 8px 8px ;'>".$msg."</div><br><br>";
}
}
?>
