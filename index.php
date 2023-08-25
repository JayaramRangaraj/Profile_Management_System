<!DOCTYPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
</html>
<?php
   include("config.php");
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") 
   {

      $myusername = mysqli_real_escape_string($db,$_POST['mail']);
      $mypassword = mysqli_real_escape_string($db,$_POST['pass']); 
      $sql = "SELECT * FROM user1 WHERE mail = '$myusername' and pass = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      if($count == 1)
      {
        // session_start();
		$_SESSION['loggedin'] = TRUE;
        $_SESSION['login_user'] = $myusername; 
        ?>
        <script>
            swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Login Successful'
            }).then(function() 
            {
             window.location = "profile.php";
            });
        </script>
<?php       
	}
	else
	{
?>
    <script>
        swal.fire({
            icon: 'error',
            title: 'Login Failure',
            text: 'Check login credentials'
        }).then(function() 
        {
            window.location = "index.php";
        });
    </script>
<?php
	    exit();
    }
    }	
?>
<!DOCTYPE html>
<html >
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="icon" href="icon.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="./assets/CSS/index.css">

</head>
<body>
    <div class="main">
        <div class="container a-container" id="a-container">
            
            <form class="form" id="a-form" method="POST" >
                <h2 class="form_title title">Create Account</h2>
                <input class="form__input" placeholder="Email" type="email" name="mail">
                <input class="form__input" placeholder="Name" type="text" name="uname">
                <input class="form__input" placeholder="Password" type="password" name="pass">
                <input type="submit" value="SIGN UP" class="blue-button">
                <br> 
                <h2 id="errorMessage" class="alert alert-warning d-none"></h2>
            </form>
        </div>
        <div class="container b-container" id="b-container">
            <form class="form" id="b-form" method="POST" >
                <h2 class="form_title title">Sign in to Website</h2>
                <input class="form__input" placeholder="Email" type="email" name="mail">
                <input class="form__input" placeholder="Password" type="password" name="pass">
                <input type="submit" value="SIGN IN" class="blue-button" >
            </form>
        </div>
        <div class="switch" id="switch-cnt">
            <div class="switch__circle"></div>
            <div class="switch__circle switch__circle--t"></div>
            <div class="switch__container" id="switch-c1">
                <h2 class="switch__title title">Welcome Back !</h2>
                <button class="switch__button button switch-btn">SIGN IN</button>
            </div>
            <div class="switch__container is-hidden" id="switch-c2">
                <h2 class="switch__title title">Hello Friend !</h2>
                <button class="switch__button button switch-btn">SIGN UP</button>
                
            </div>
            
        </div>
    </div>
    <script src="./assets/JS/index.js"></script>
    <script>
        $(document).on('submit', '#a-form', function (e) 
        {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("save_a-form", true);
            $.ajax
            ({
                type: "POST",
                url: "index_insert.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {   
            var res = JSON.parse(response);
            if (res.status == 500) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: res.message,
                    confirmButtonColor: '#3085d6',
                });
            } else if (res.status == 200) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: res.message,
                    confirmButtonColor: '#3085d6',
                }).then(function () {
                    $('#a-form')[0].reset();
                });
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }      
            });
        });
	</script>
</body>
</html>