<?php 
    include("navbar.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title></title>
    <style>
        #save-change
        {
            display: none;
        }
        .form-control[readonly]
        {
            border: none;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5 border rounded">
                <h4 class="text-center">User Profile</h4>
                <div class="text-right">
                    <button id="edit-profile" class="btn btn-sm btn-primary">Edit Profile</button>
                </div>
                <form action="" class="form-group">
                    <div>
                        <label for="username">Username</label>
                        <input type="text" class="form-control" value="nash.salon" readonly>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="text" class="form-control" value="nash@gmail.com" readonly>
                    </div>
                    <div>
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" value="9876543212" readonly>
                    </div>
                    <div>
                        <label for="phone">Address</label>
                        <textarea name="" id="" class="form-control" readonly>Electronic city</textarea>
                    </div>
                    <div class="text-right">
                        <input type="submit" value="Save" class="btn btn-success" id="save-change">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    $(document).ready(function(){
        $("#edit-profile").click(function(){
            $(".form-control").removeAttr("readonly");
            $("#save-change").show();
            $(this).hide();
        })
    })
</script>