<html>
<head><title>instamsg-login</title>
<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div name="d">
<h1>instaMsg</h1>
<form action="login.php" method="POST">
<pre>
<input type="text" name="username" placeholder="username"  id="username">
<input type="password" name="password" placeholder="password" id="password">


<input type="submit" name="login" value="login" class="login">  <button name="signup"  value="signup" class="login">signup</button>
</pre>
</form>
</div>
</body>
</html>
<?php
session_start();
if(isset($_SESSION['id']))
{header("Location: home.php");
}
else{
if(isset($_POST['signup']))
{
header("Location: signup.php");
}
if(isset($_POST['login']))
{$i=0;
$username=$_POST['username'];
$password=$_POST['password'];
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"instaMsg");
$logindata=mysqli_query($con,"SELECT * FROM user");
if($username&&$password){
while($row=mysqli_fetch_assoc($logindata))
{$username1=$row['username'];
$password1=$row['password'];
if($username==$username1&&$password==$password1)
{
$iddata=mysqli_query($con,"SELECT id FROM user WHERE username='$username1'")or die("failed");
$id=mysqli_fetch_array($iddata);
$_SESSION['id']=$id[0];
$i=1;
header("Location: home.php");
}
}
if($i==0)
echo "<p style='color:red'>incorrect password<P>";
}
else
{
echo "<p style='color:red'>username empty<P>";
}


}
}
?>


