<?php 
    session_start();

    function isUser($user_username, $user_password){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "beautysaloon";

        $connect = mysqli_connect($servername, $username, $password, $database);
        
        $query = "SELECT `phone_number` , `pass` FROM `customer` WHERE phone_number = '$user_username' AND pass = md5('$user_password')";

        $data = mysqli_query($connect,$query);
        return mysqli_num_rows($data) == 1 ? true : false;

        if($connect) 
        mysqli_close($connect);
    }

    if(!(isUser($_SESSION["login_user"], $_SESSION["pass_user"]))){
        header("Location: /");
        exit;
    }
?>