<?php  
$con=mysqli_connect("127.0.0.1","root","next1004","data");  
 
mysqli_set_charset($con,"utf8");
  
if (mysqli_connect_errno($con))  
{  
   echo "Failed to connect to MySQL: " . mysqli_connect_error();  
}  
$name = $_POST['name'];  
$id = $_POST['id']; 
$score = $_POST['score'];
$time = $_POST['time'];  
  
  
 mysqli_query($con,"insert into Person (name,id,score,install) values ('$name','$id','$score','$time')");  
$result = mysqli_query($con,"UPDATE Person SET lasttime='$time' where id = '$id'");
if($result)
{
 mysqli_query($con,"UPDATE Person SET score='$score' where (score < '$score') && (id = '$id')");
}
  
mysqli_close($con);  
?> 
