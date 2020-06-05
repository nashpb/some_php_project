<?php
include_once('configs/db.php');
//FLASH MESSAGE SECTION
$flash_message['status'] = "";
$flash_message['message'] = "";
$flash_div = "";
if(isset($_SESSION['flash']))
{
    $explode_flash = explode("!!!",$_SESSION['flash']);
    $flash_message['status'] = $explode_flash[0];
    $flash_message['message'] = $explode_flash[1];
    if(!strcasecmp($flash_message['status'],'ERROR'))
    {
        $flash_div = '<div class="alert alert-danger alert-dismissible" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$flash_message['message'].'</div>';
    }
    else if(!strcasecmp($flash_message['status'],'Success'))
    {
        $flash_div = '<div class="alert alert-success alert-dismissible" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$flash_message['message'].'</div>';
    }
    unset($_SESSION['flash']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Salon</title>
	<link rel="stylesheet" href="style/style.css">
	<script src="script/script.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body class="back-img">
    <?= $flash_div;?>
	<div class="container-fluid display-flex-center login">
		<div class="login-div">
			<p class="form-title">Forgot Username</p>
			<form  method="post" action="" onSubmit="return validation(event)">
				<div class="input-container">
					<input id="email" type="email" onfocusout="checkEmail();" class="form-control" placeholder="Email" name="email" required><div id="errorEmail"></div>
					<input id="phone" type="number" onfocusout="mobileNumber();" class="form-control" placeholder="Phone Number" name="phone" required><div id="errorPhone"></div>
				</div>
				<input type="submit" value="SUBMIT" class="form-submit" name="login_hit">
			</form>
		</div>
    </div>
    <script>
    const login_url = '<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/login.php'?>';
    function mobileNumber()
    {
        var Number = document.getElementById("phone");
        var IndNum =/^[6-9]\d{9}$/;
        if(!IndNum.test(Number.value)){
            document.getElementById("errorPhone").innerHTML="please enter valid mobile number";
            phone.classList.add("invalid");
            errorPhone.style.color="red";
            phone.focus();
            return false ;
        }else{
            document.getElementById("errorPhone").innerHTML="";
            phone.classList.add("valid");
            errorPhone.style.color="green";
            return true;
        }
    }
    function checkEmail() {
        var email = document.getElementById("email");
        var filter = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
         
		if (!filter.test(email.value))
		{
			email.classList.add("invalid");
			document.getElementById("errorEmail").innerHTML="please enter valid Email ID";
			errorEmail.style.color="red";
		    email.focus();
			return false;
        }else{
			email.classList.add("valid");
			document.getElementById("errorEmail").innerHTML="";
			errorEmail.style.color="green";
            return true;
		}
    }
    async function validation(event) {
        event.preventDefault();
        if(checkEmail() && mobileNumber())
        {
            var payload = {
                email: email.value,
                phone: phone.value
            };

            // var data = new FormData();
            // data.append( "json", JSON.stringify( payload ) );

            const response = await fetch("actions/registration/fetch_username.php",
            {
                method: "POST",
                headers: {
                "Content-Type": "application/json"
                },
                mode: "same-origin",
                credentials: "same-origin",
                body: JSON.stringify(payload)
            });
            const data = await response.text();
            console.log(data);
            switch(data){
                case '!no-user-found!':
                alert('NO USER FOUND. PLEASE TRY AGAIN');
                break;
                case '!mismatch!':
                alert('EMAIL AND PHONE NUMBER DO NOT MATCH')
                break;
                case '!error!':
                alert('SOMETHING WENT WRONG!');
                break;
                default:
                alert('USERNAME: '+data);
                window.location.href = login_url;
                break;
            }
        }
        else
        return false;
    }
    </script>
</body>
</html>
