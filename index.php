<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD Tutorial</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
 
    <!-- Script for Bootstrap JS -->
    <script type="text/javascript" src="js/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center><h2>PHP CRUD TUTORIAL</h2></center>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    <button class="btn btn-primary" class="add_new_user" id="add_new_user"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Add New</button>
                </div>
                </br></br>
                <table class="table table-striped table-responsive" id="usersdata">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </tr>
 
                    <?php 
                    include 'config.php';
                    $sql = "SELECT * FROM php_crud";
                    $query =  mysqli_query($conn, $sql);
                    $rows = mysqli_num_rows($query);
                    if($rows>0)
                    {
                        while($data = mysqli_fetch_array($query))
                        {
                    ?>
                    <tr class="user_<?php echo $data['user_id']; ?>">
                        <td><?php echo $data['firstname'] . " " . $data['lastname']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['phone']; ?></td>
                        <td><?php echo $data['gender']; ?></td>
                        <td>
                            <a href="javascript:void(0);" onclick="edit_user('<?php echo $data['user_id']; ?>')"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="javascript:void(0);" onclick="delete_user('<?php echo $data['user_id']; ?>')"><i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                        }
                    } /*if condition*/
                    ?>
                </table>
            </div>
        </div>
    </div>    
</body>
 
<div class="modal fade" id="add_new_user_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Fill Details</h4>
            </div>
            <div class="modal-body">
                <form method="POST" role="form">
 
                    <div class="form-group">
                        <label for="">Firstname</label>&nbsp;&nbsp;&nbsp;<span class="f_name_error error"></span>
                        <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Firstname">
                    </div>
 
                    <div class="form-group">
                        <label for="">Lastname</label>&nbsp;&nbsp;&nbsp;<span class="l_name_error error"></span>
                        <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Lastname">
                    </div>
 
                    <div class="form-group">
                        <label for="">Email</label>&nbsp;&nbsp;&nbsp;<span class="email_error error"></span>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
 
                    <div class="form-group">
                        <label for="">Phone</label>&nbsp;&nbsp;&nbsp;<span class="phone_error error"></span>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                    </div>
 
                    <div class="form-group">
                        <label for="">Gender</label><br>
                        <input type="radio" name="gender" class="gender" value="Male"> Male
                        <input type="radio" name="gender" class="gender" value="Female"> Female
                    </div>
 
                    <input type="hidden" id="action" name="action" value="add">
                    <input type="hidden" id="user_id" name="user_id" value="">
                    <button type="button" id="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </form>               
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>
 
<!-- Script for add new data -->
<script type="text/javascript">
$("#add_new_user").click(function(){
    $("#action").val("add");
    $("#user_id").val("");
    $('#f_name').val("");
    $('#l_name').val("");
    $('#email').val("");
    $('#phone').val("");
    $("#user_id").val("");
    $("#add_new_user_modal").modal('show');
});
 
$("#submit").click(function(){
    var f_name = $('#f_name').val();
    var l_name = $('#l_name').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var gender = $("input:radio[name='gender']:checked").val();
 
    var html = "";
    var email_validate = "";
    var phone_validate = "";
    var action = $("#action").val();
    var user_id = $("#user_id").val();
    var valid = true;
     
    if(f_name == "" || f_name == null)
    {
        valid = false;
        $(".f_name_error").html("* This field is required.");
    }
    else
    {
        $(".f_name_error").html("");    
    }
 
    if(l_name == "")
    {
        valid = false;
        $(".l_name_error").html("* This field is required.");
    }
    else
    {
        $(".l_name_error").html("");    
    }
 
    if(email == "")
    {
        valid = false;
        $(".email_error").html("* This field is required.");
    }
    else
    {
        email_validate = isEmail(email);
        if(!email_validate)
        {
            valid = false;
            $(".email_error").html("* Invalid email format. Please try like this <b>test@example.com</b>");
        }
        else
        {
            $(".email_error").html("");
        }
    }
 
    if(phone == "")
    {   
        valid = false;
        $(".phone_error").html("* This field is required.");
    }   
    else
    {
        phone_validate = isPhone(phone);
        if(!phone_validate)
        {
            valid = false;
            $(".phone_error").html("* Phone number must be numaric and have 10 digit. E.g. 0123456789");
        }
        else
        {
            $(".phone_error").html("");
        }
    }
 
    if(valid == true)
    {
        var form_data = {
            f_name : f_name,
            l_name : l_name,
            email : email,
            phone : phone,
            gender : gender,
            action : action,
            user_id : user_id
        };
         
        $.ajax({
            url : "insert.php",
            type : "POST",
            data : form_data,
            dataType : "json",
            success: function(response){
                if(response['valid']==false)
                {
                    alert(response['msg']);
                }
                else
                {
                    if(action == 'add')
                    {
                        $("#add_new_user_modal").modal('hide');
                        html += "<tr class=user_"+response['user_id']+">";
                        html += "<td>"+response['firstname']+" "+response['lastname']+"</td>";
                        html += "<td>"+response['email']+"</td>";
                        html += "<td>"+response['phone']+"</td>";
                        html += "<td>"+response['gender']+"</td>";
                        html += "<td><a href='javascript:void(0);' onclick='edit_user("+response['user_id']+");'><i class='glyphicon glyphicon-pencil'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_user("+response['user_id']+");'><i class='glyphicon glyphicon-trash'></i></a></td>";
                        html += "<tr>";
                        $("#usersdata").append(html);
                    }
                    else
                    {
                        window.location.reload();
                    }
                }
            }
        });
    }
    else
    {
        return false;
    }
});
 
/*Function for validate email*/
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
 
function isPhone(phone) {
    if(phone.length<=10)
    {
        if (phone.match(/^\d{10}/)) {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}
 
function edit_user(user_id) {
    var form_data = {
        user_id : user_id 
    };
    $.ajax({
        url : "edit.php",
        method : "POST",
        data : form_data,
        dataType : "json",
        success : function(response) {
            $('#f_name').val(response['firstname']);
            $('#l_name').val(response['lastname']);
            $('#email').val(response['email']);
            $('#phone').val(response['phone']);
            $('.gender').each(function(){
                if($(this).val() == response['gender'])
                {
                    $(this).prop("checked",true);
                }
            });
            $("#user_id").val(response['user_id']);
            $("#add_new_user_modal").modal('show');
            $("#action").val("edit");
        }
    });
}
 
function delete_user(user_id) {
    var form_data = {
        user_id : user_id 
    };
    $.ajax({
        url : "delete.php",
        method : "POST",
        data : form_data,
        success : function(response) {
            $(".user_"+user_id).css("background","red");
            $(".user_"+user_id).fadeOut(1000);
        }
    });
}
</script>
 
</html>
