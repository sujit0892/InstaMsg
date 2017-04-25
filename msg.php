<?php
$msgid=$_GET['msg'];
session_start();
$_SESSION['msgid']=$msgid;
$id=$_SESSION['id'];
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"instaMsg");
$val_chn=mysqli_query($con,"UPDATE ".$id."t set val=0 WHERE id=".$msgid);
$data=mysqli_query($con,"SELECT firstname,lastname FROM user WHERE id=$msgid") or die("failed");
$row=mysqli_fetch_assoc($data);
$name=$row['firstname']." ".$row['lastname'];

echo "<form action='msgsend.php' method='POST'>
<div style='background-color:#32cd32'>
<a href='profile1.php?id=".$msgid."' style='padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: white;
box-shadow:  0px 10px 5px #888888;
    display: block;
    transition: 0.3s
'>".$name."</a>
</div>
<iframe src='msgcontent.php' style='height:83%;width:100%;' frameborder='0'></iframe>
<div><input type=text name='msg' placeholder='enter msg' style='height:40px;
width:80%;'><button name='send'>send</button></div></form>";?>





