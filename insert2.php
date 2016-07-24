<?php
include 'config.php';
$f_name = $l_name = $email = $phone = $error = $action = $user_id = "";
$valid = true;
if(isset($_POST['f_name']) && !empty($_POST['f_name']))
{
    $f_name = mysqli_real_escape_string($conn,$_POST['f_name']);
}
else
{
    $valid = false;
    $error .= "* Firstname is required.\n";
    $f_name = '';
}
 
if(isset($_POST['l_name']) && !empty($_POST['l_name']))
{
    $l_name = mysqli_real_escape_string($conn,$_POST['l_name']);
}
else
{
    $valid = false;
    $error .= "* Lastname is required.\n";
    $l_name = '';
}
 
if(isset($_POST['email']) && !empty($_POST['email']))
{
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        $error .= "* Invalid email format. Valid email should be test@example.com\n";
        $email = "";
    }
    else
    {
        $email = $_POST['email'];
    }
}
else
{
    $valid = false;
    $error .= "* Email is required.\n";
    $email = '';
}
 
if(isset($_POST['phone']) && !empty($_POST['phone']))
{
    $phone = $_POST['phone'];
    if (!preg_match("/^\d{10}/",$phone)) {
        $valid = false;
        $error .= "* Phone number is not valid"; 
        $phone = '';
    }
    else
    {
        $phone = $_POST['phone'];
    }
}
else
{
    $valid = false;
    $error .= "* Phone number is required.\n";
    $phone = '';
}
 
if(isset($_POST['gender']) && !empty($_POST['gender']))
{
    $gender = $_POST['gender'];
}
else
{
    $gender = "";   
}
 
if(isset($_POST['action']) && !empty($_POST['action']))
{
    $action = $_POST['action'];
}
else
{
    $action = "";
}
 
if(isset($_POST['user_id']) && !empty($_POST['user_id']))
{
    $user_id = $_POST['user_id'];
}
else
{
    $user_id = "";
}
 
if($valid)
{
    if($action == 'add')
    {
        $sql = "INSERT INTO php_crud (user_id, firstname, lastname, email, phone, gender) VALUES (NULL, '$f_name', '$l_name', '$email', '$phone', '$gender')";
        $query = mysqli_query($conn, $sql);
        if($query)
        {
            $retrive_sql = "SELECT * FROM php_crud WHERE user_id = (SELECT MAX(user_id) FROM php_crud)";
            $retrive_query = mysqli_query($conn, $retrive_sql);
            if($retrive_query)
            {
                $data = mysqli_fetch_assoc($retrive_query);
                echo json_encode($data);
            }
        }
        else
        {
            $data = array("valid"=>false, "msg"=>"Data not inserted.");
            echo json_encode($data);
        }
    }
 
    if($action == 'edit')
    {
        $sql = "UPDATE php_crud SET firstname = '$f_name', lastname = '$l_name', email = '$email', phone = '$phone', gender = '$gender' WHERE user_id = '$user_id' ";
        $query = mysqli_query($conn, $sql);
        if($query)
        {
            $data = array("valid"=>true, "msg"=>"Data successfully updated.");
            echo json_encode($data);
        }
        else
        {
            $data = array("valid"=>false, "msg"=>"Data not updated.");
            echo json_encode($data);
        }   
    }
 
}
else
{
    $resp = [];
    $resp = array("valid"=>false, "msg"=>$error);
        echo json_encode($resp);
}
 
?>
