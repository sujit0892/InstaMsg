<meta http-equiv="refresh" content="5">
<?php
session_start();
$id=$_SESSION['id'];
$msgid=array();
$val=array();
$name=array();
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"instaMsg");
$query=mysqli_query($con,"SELECT * from ".$id."t") ;
if(!$query)
{
$sql="CREATE TABLE ".$id."t (
no INT(3),
id INT(3),
val INT(3))";
mysqli_query($con,$sql);
}

$query=mysqli_query($con,"SELECT * FROM ".$id."t ORDER BY no DESC");
$i=0;
while($data=mysqli_fetch_assoc($query)){
$msgid[$i]=$data['id'];
$val[$msgid[$i]]=$data['val'];
$name_sql=mysqli_query($con,"SELECT firstname,lastname FROM user WHERE id=".$msgid[$i]);
while($data_name=mysqli_fetch_assoc($name_sql)){
$name[$msgid[$i]]=$data_name['firstname']." ".$data_name['lastname'];
}
if($val[$msgid[$i]]==0){
echo "<div style='width:100%;padding: 8px 8px 8px 32px;box-shadow:  0px 10px 5px #888888;'>
<a href='msg.php?msg=".$msgid[$i]."' style='
    text-decoration: none;
    font-size: 25px;
   color:black;  
' target='frame'>".$name[$msgid[$i]]."</a></div>";
}
else
{
echo "<div style='width:100%;padding: 8px 8px 8px 32px;box-shadow:  0px 10px 5px #888888;'>
<a href='msg.php?msg=".$msgid[$i]."' style='
    text-decoration: none;
    font-size: 25px;
   color:black;  
' target='frame'>".$name[$msgid[$i]]."*</a></div>";
}
}
?>
