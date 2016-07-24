<?php 
include 'config.php';
$user_id = '';
if(isset($_POST['user_id']) && !empty($_POST['user_id']))
{
    $user_id = $_POST['user_id'];
}
 
$sql = "DELETE FROM php_crud WHERE user_id = '$user_id'";
$query = mysqli_query($conn, $sql);
 
if($query)
{
    echo "Data successfully removed.";
}
?>
