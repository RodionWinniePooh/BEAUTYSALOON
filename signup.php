<?php  

require_once "php/connect.php";

if(isset($_POST['do_signup'])){
	$username = mysqli_real_escape_string($connection, trim($_POST['username']));
	$password1 = mysqli_real_escape_string($connection, trim($_POST['password1']));
	$password2 = mysqli_real_escape_string($connection, trim($_POST['password2']));
	if(!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2))   {
		$query = "SELECT * FROM `customer` WHERE name_customer = '$username'";
		$data = mysqli_query($connection, $query);
		if(mysqli_num_rows($data) == 0) {
			$query ="INSERT INTO `customer` (name_customer, pass) VALUES ('$username', SHA('$password2'))";
			mysqli_query($connection,$query);

			mysqli_close($connection);
            header("Location: http://www.example.com/");
			 /* Перенаправление браузера */

            /* Убедиться, что код ниже не выполнится после перенаправления .*/
            exit;
        } else{
            echo "Блохи";
        }

	}
}


?>

<form action="/signup.php" method="POST"> 
<!-- action отвечает что после нажатия на кнопку мы перезагрузим страницу --> 

    <p>
        <strong>Ваш логин</strong>
        <input type="text" name="username"
               value="<?php echo $_POST['username']; ?>">
               <!-- Присваем значения которые пользоваетль
               уже вводил что бы не приходилось повторно
               вводить руками к примеру логин -->
    </p>

    <p>
        <strong>Ваш Email</strong>
        <input type="email" name="email" 
               value="<?php echo $_POST['email']; ?>">
    </p>

    <p>
        <strong>Ваш пароль</strong>
        <input type="password" name="password1"
               value="<?php echo $_POST['password1']; ?>">
    </p>

    <p>
        <strong>Введите ваш пароль ещё раз</strong>
        <input type="password" name="password2"
               value="<?php echo $_POST['password2']; ?>">
    </p> 

    <p>
        <button type="submit" name="do_signup">Зарегистрироваться</button>
    </p>




</form>
