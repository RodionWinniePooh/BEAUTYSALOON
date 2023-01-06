<?php 

    $mysqli = false;
    function connectDB(){
        global $mysqli;
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "beautysaloon";
        $mysqli = new mysqli($servername, $username, $password ,$database);
        $mysqli->query("SET NAMES 'UTF-8'");
    }

  //  functon chekUser($email, $password){
  //      global $mysqli;
  //      connectDB();
  //      result_set = $mysqli->query("SELECT * FROM `customer` WHERE `email`='$email' AND `pass`='$password'");
  //      closeDB();
//
  //      if($result_set->fetch_assoc()) 
  //          return true;
  //      else 
  //          return false;
  //  }

    function isAdmin($email, $password){ //Возвращаем true или false 
        global $mysqli;
        connectDB();
        $result_set = $mysqli->query("SELECT * FROM `administrator` WHERE `email`= $email AND `pass` = $password");
        closeDB();
        
        if($result_set->fetch_assoc())
            return true;
        else
            return false;
    }

    //$query = "SELECT `user_id` , `username` FROM `signup` WHERE username = 'Rodya' AND password = 'Words' AND admin = 1 ";





    function closeDB(){
        global $mysqli;
        $mysqli->close();
    }

    ?>