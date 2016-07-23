<?php  
$con=mysqli_connect("127.0.0.1","root","next1004","data");  
 
mysqli_set_charset($con,"utf8");

$name = $_POST['name'];  
$id = $_POST['id']; 
$score = $_POST['score'];
$time = $_POST['time'];
  
  
mysqli_query($con,"insert into Person (name,id,score,lasttime) values ('$name','$id','$score','$time')");  
mysqli_query($con,"UPDATE Person SET lasttime='$time'");
mysqli_query($con,"UPDATE Person SET score='$score'");

  
mysqli_close($con);  
?> 
