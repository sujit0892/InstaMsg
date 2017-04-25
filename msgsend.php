<?php
$no_id;
$no_msgid;
session_start();
$msgid=$_SESSION['msgid'];
$id=$_SESSION['id'];
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"instaMsg");
if(isset($_POST['send']))
{
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
$query=mysqli_query($con,"SELECT * from ".$msgid."t");
if(!$query)
{
$sql="CREATE TABLE ".$msgid."t (
no INT(3),
id INT(3),
val INT(3))";
mysqli_query($con,$sql);
}
$msg=$_POST['msg'];
$insert1=mysqli_query($con,"INSERT INTO ".$table." VALUES(".$id.",'".$msg."')")or die(mysqli_error($con));
$id_no=mysqli_query($con,"SELECT no FROM ".$id."t ORDER BY id DESC LIMIT 1");
$row=mysqli_fetch_array($id_no);
$no_id= $row[0];
if(isset($no_id)){
$no_id=$no_id+1;
}
else {
$no_id=1;
}

$msg_no=mysqli_query($con,"SELECT no FROM ".$msgid."t ORDER BY id DESC LIMIT 1");
$row=mysqli_fetch_array($msg_no);
$no_msgid= $row[0];
if(isset($no_msgid)){
$no_msgid=$no_msgid+1;
}
else {
$no_msgid=1;
}
//id
$id_query=mysqli_query($con,"SELECT no FROM ".$id."t WHERE id=".$msgid);
$row=mysqli_fetch_array($id_query);
if(isset($row['0']))
{$id_delete=mysqli_query($con,"DELETE FROM ".$id."t WHERE no=".$row[0]);
}
$id_insert=mysqli_query($con,"INSERT INTO ".$id."t VALUES(".$no_id.",".$msgid.",0)");


//msgid
$id_query=mysqli_query($con,"SELECT no FROM ".$msgid."t WHERE id=".$id);
$row=mysqli_fetch_array($id_query);
if(isset($row['0']))
{$id_delete=mysqli_query($con,"DELETE FROM ".$msgid."t WHERE no=".$row[0]);
}
$id_insert=mysqli_query($con,"INSERT INTO ".$msgid."t VALUES(".$no_msgid.",".$id.",1)");
header("Location: msg.php?msg=".$msgid);
}
?>
