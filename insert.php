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
  
  
$result = mysqli_query($con,"insert into Person (name,id,score,lasttime) values ('$name','$id','$score','$time')");  
  
  if($result){  
    echo 'success';  
  }  
  else{  
    mysqli_query($con,"update into Person set lasttime='$time' whrere 1");
    echo 'failure';  
  }  
  
  
mysqli_close($con);  
?> 
