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
 mysqli_query($con,"UPDATE Person SET lasttime='abc'");
  
  if($result){  
    //echo 'success';  
  }  
  else{  
   
    echo '서버요청실패';  
  }  
  
  
mysqli_close($con);  
?> 
