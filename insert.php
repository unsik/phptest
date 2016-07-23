<?php  
$con=mysqli_connect("127.0.0.1","root","next1004","db");  
 
mysqli_set_charset($con,"utf8");
  
if (mysqli_connect_errno($con))  
{  
   echo "Failed to connect to MySQL: " . mysqli_connect_error();  
}  
$name = $_POST['name'];  
$address = $_POST['address'];  
  
  
$result = mysqli_query($con,"insert into Person (name,address) values ('$name','$address')");  
  
  if($result){  
    echo 'success';  
  }  
  else{  
    echo 'failure';  
  }  
  
  
mysqli_close($con);  
?> 
