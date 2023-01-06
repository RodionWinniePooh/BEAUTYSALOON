<?php 
    session_start();

    function isAdmin($user_username, $user_password){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "beautysaloon";

        $connect = mysqli_connect($servername, $username, $password, $database);
        
        $query = "SELECT `login` , `pass` FROM `administrator` WHERE login = '$user_username' AND pass = md5('$user_password')";

        $data = mysqli_query($connect,$query);
        return mysqli_num_rows($data) == 1 ? true : false;

        if($connect) 
        mysqli_close($connect);
    }

    if(!(isAdmin($_SESSION["login_admin"], $_SESSION["pass_admin"]))){
        header("Location: /admin/auth.php");
        exit;
    }
?>