<html>
<head><title>instaMsg-signup</title>
<link rel="stylesheet" type="text/css" href="signup.css">
</head>
<body>
<form action="signup.php" method="POST" enctype="multipart/form-data">
<pre>
<h1>instaMsg</h1>
<input type="text" class="text" name="firstname" placeholder="first name" required><br>
<input type="text" class="text" name="surname" placeholder="surname" required><br>
<input type="text" class="text" name="phoneno" placeholder=" Phone no." required><br>
<input type="email" class="text" name="email" placeholder="abc@example.com" ><br>
<input type="text" class="text" name="date" placeholder="YYYY-MM-DD" ><br>
<input type="password" name="password" class="text" placeholder="password"><br>
<input type="password" name="repassword" class="text" placeholder="retype password"><br>
<input type="file" name="myfile" accept="image/*" required>

   <input type="submit" value="signup" name="signup" class="signup">   <input type="reset" name="reset" value="reset" class="signup">
</pre>
</form>
</html>
<?php
session_start();
if(isset($_SESSION['id']))
{header("Location: home.php");
}
else
{
$id;
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"instaMsg");
$last_id=mysqli_query($con,"SELECT id FROM user ORDER BY id DESC LIMIT 1");
while($row=mysqli_fetch_assoc($last_id))
{
$id= $row['id'];
}
if(isset($id)){
$id=$id+1;
}
else {
$id=101;
}


if(isset($_POST['signup']))
{$username=$_POST['email'];
$password=$_POST['password'];
$firstname=$_POST['firstname'];
$surname=$_POST['surname'];
$phoneno=$_POST['phoneno'];
$date=$_POST['date'];

$img=$id;
if($password==$_POST['repassword']){
$data=mysqli_query($con,"INSERT INTO user VALUES($id,'$username','$password','$firstname','$surname','$phoneno','$date','$img')") or die(mysqli_error($con));

$temp=$_FILES['myfile']['tmp_name'];
move_uploaded_file($temp,"DP/".$id)or die("failed");

$_SESSION['id']=$id;
header("Location: home.php");
}
else
{
echo "<p style='color:red'>password not match<p>";
}
}
}

?>
