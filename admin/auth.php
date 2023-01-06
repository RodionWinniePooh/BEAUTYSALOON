<?php 
	session_start();
	
	$admin_location = "Location: /admin/index.php";

	if(!empty($_SESSION["login_admin"]) && !empty($_SESSION["pass_admin"])){
              header($admin_location);
              exit;
	}

    if(isset($_POST['button_auth'])) {
        $servername = "localhost";
        $username   = "root";
        $password   = "";
        $database   = "beautysaloon";

        $connect = mysqli_connect($servername, $username, $password, $database);

        $admin_name = mysqli_real_escape_string($connect, trim($_POST['login_admin']));
        $admin_password = mysqli_real_escape_string($connect, trim($_POST['pass_admin']));

        if(!empty($admin_name) && !empty($admin_password)) {
			$query_login = "SELECT `login` , `pass` FROM `administrator` WHERE login = '$admin_name' AND pass != md5('$admin_password')";
			$result_login = mysqli_query($connect, $query_login);

			if($result_login){
				$_SESSION['success'] = "Пароль введён неверно";
			}

            $query = "SELECT `login` , `pass` FROM `administrator` WHERE login = '$admin_name' AND pass = md5('$admin_password')";

            $data = mysqli_query($connect,$query);
            if(mysqli_num_rows($data) == 1 && $result_login) {

              $row = mysqli_fetch_assoc($data);
              $_SESSION["login_admin"] = $admin_name;
              $_SESSION["pass_admin"] = $admin_password;
                
              header($admin_location);
              exit;
              //setcookie('user_id', $row['user_id'], time() + (60*60*24*30));
              //setcookie('username', $row['username'], time() + (60*60*24*30));
            }
            else {
				$_SESSION['user_error'] = "Извините, вы должны ввести правильное имя и/или пароль";
            }
          }

    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/admin/auth.css">
    <title>Вход в Admin-панель</title>
</head>
<body>


    <div class="container">
	    <form class="signUp" method="post">
            <h3>
				WELCOME<br>BACK !
			</h3>

            <button class="fb" type="button">
				Log In With Facebook
			</button>

	    	<p>
                Just enter your email address</br>and your password for join.
            </p>
	    	<input class="w100" name="login_admin" placeholder="Insert eMail" reqired autocomplete='off' />
	    	<input class="w100" type="password" name="pass_admin" placeholder="Insert Password" reqired />
			<?php
                if(isset($_SESSION['user_error']) && $_SESSION['user_error'] != '')
                {
                    echo '<p>'.$_SESSION['user_error'].'</p>';
                    unset($_SESSION['user_error']);
                }
            ?>
	    	<button class="form-btn log-in" type="submit" name="button_auth">
				Log In
			</button>
	    </form>
    </div>

<style>
@font-face{

	src:url("../font/Roboto-Light.ttf") format("truetype");
	font-family: "Roboto";
}

@font-face{

	src:url("../font/Dosis-Light.otf") format("truetype");
	font-family: "Dosis";
}

* {
	margin: 0;
	padding: 0;
}

body {
	background: #ffc185;
}

.container{
	position:absolute;
	width: auto;
	height:auto;
	top: calc(50% - 240px);
	left: calc(50% - 160px);
}

form {
	position: absolute;
	text-align: center;
	background: #fff;
	width: 310px;
	height: 470px;
	border-radius: 5px;
	padding: 30px 20px 0 20px;
	box-shadow: 0 10px 50px 0 rgba(0, 0, 0, 0.25);
	box-sizing: border-box;
}

p {
	font-family: 'Roboto', sans-serif;
	font-weight: 100;
	text-transform: uppercase;
	font-size: 12px;
	color: #87613d;
	margin-bottom: 40px;
}

h3 {
	font-family: 'Dosis';
	font-size: 35px;
	text-transform: uppercase;
	color: #87613d;
	margin-bottom: 30px;
}

input,
button{
	outline: none !important; /*При наведении убирает синюю обводку у компонентов*/
}

/* Класс кнопки Facebook */
button.fb {
	border: none;
	background: #3b5998;
	width: 160px;
	height: 25px;
	font-family: 'Roboto', sans-serif;
	font-size: 12px;
	color: #fff;
	text-transform: uppercase;
	border-radius: 4px;
	border: 1px solid #29487d;
	cursor: pointer;
	margin-bottom: 20px;
	transition:all 0.3s linear;
}

button.fb:hover {
	background: #fff;
	color: #3b5998;
}

button.form-btn {
	position: absolute;
	width: 100%;
	height: 60px;
	bottom: 0;
	border: 0;
	font-family: 'Dosis';
	font-size: 24px;
	text-transform: uppercase;
	cursor: pointer;
}

button.form-btn {
	left: 0;
	border-radius: 0 0 5px 5px;
	background-color: #ff7d00;
	color: #fff;
	transition:all 0.3s linear;
}

button.form-btn:hover {
	background-color:rgba(255, 125, 0, 0.65);
	color: #fff;
}

input {
	border: none;
	border-bottom: 1px solid #ffc185;
	width: 85%;
	font-family: 'Roboto';
	color: #ff7d00;
	text-align: center;
	font-size: 21px;
	font-weight:100;
	margin-bottom:25px;
}

::-webkit-input-placeholder {
   color: #ffc185;
	font-family: 'Roboto';
	font-weight:100;
}


::-moz-placeholder {
   color: #ffc185;  
	font-family: 'Roboto';
	font-weight:100;
}

:-ms-input-placeholder {  
   color: #ffc185; 
	font-family: 'Roboto';
	font-weight:100;
}

.signIn input,
.signUp .w100 {
	width: 100%;
}

.signUp {
	z-index: 2;
}

</style>




</body>
</html>