<html>
<head>
<link rel="stylesheet" type="text/css" href="home.css">
<?php
session_start();
$id=$_SESSION['id'];
$name;
$msgid;

$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"instaMsg");
$data=mysqli_query($con,"SELECT id,firstname,lastname FROM user WHERE id!=$id") or die("failed");
$row1=mysqli_num_rows($data);
$url;
echo "<script>
function openNav() {
    document.getElementById('mySidenav').style.width = '25%';
   
}

function closeNav() {
    document.getElementById('mySidenav').style.width = '0';
}   


</script>

</head>
<body>
<form action='home.php' method='GET'>
<div style='height:100%;width:25%;float:left'>
<div id='mySidenav' class='sidenav'>
  <a href='javascript:void(0)' class='closebtn' onclick='closeNav()'>&times;</a>
  <a href='profile.php' target='frame'onclick='closeNav()' '>profile</a>";
$i=1;
while($row=mysqli_fetch_assoc($data))
{$msgid[$i]=$row['id'];
$name=$row['firstname']." ".$row['lastname'];
echo "<a href='msg.php?msg=".$msgid[$i]."' target='frame' onclick='closeNav()'>".$name."</a>";
}
echo"<a href='logout.php'>logout</a></div>


<div id='main' onclick='openNav()'>&#9776; instaMsg</div>
<iframe src='recmsg.php'   width='100%' scrolling='no' frameborder='0'></iframe>
</div>
<div style='float:left;height:100%;width:75%'><iframe name='frame' src='profile.php'  height='100%' width='100%' scrolling='no'></iframe>

</div>
</form>
</body>
</html>
";

?>
