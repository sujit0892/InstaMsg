<?php
session_start();
$id=$_GET['id'];
$username;
$name;
$contact;
$birthday;
$img;
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"instaMsg");
$data=mysqli_query($con,"SELECT * FROM user WHERE id=$id");
while($row=mysqli_fetch_assoc($data))
{$username=$row['username'];
$name=$row['firstname']." ".$row['lastname'];
$contact=$row['phoneno'];
$birthday=$row['birthday'];
$img=$row['img'];
}
$img="DP/".$img;
echo"<head><title>profile</title>";
echo "<body>";
echo"<div style='width:100%;height:70%;box-shadow:  0px 10px 5px #888888'>
<div style='width:100%;height:270px;background-color:lightgreen'>
<img src='$img' style='height:270px;weight:200px;margin-left:45%'>
</div>
<pre>
<b> Profile info<b>


  Name       :  $name
  Username   :  $username
  Contact no.:  $contact
  Birthday   :  $birthday
</pre>
</div>
<br>
<br>

</body>
";
?>
