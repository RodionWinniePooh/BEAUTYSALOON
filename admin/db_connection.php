<?php
session_start();
require_once "../start.php";
if(isset($_POST["button_exit"])){
    session_destroy();
    header('Location: /admin/auth.php');
    exit;
}

$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "beautysaloon";

$query = '';
$output = '';

$connect = mysqli_connect($servername, $username, $password, $database) OR DIE('Ошибка подключения к базе данных');





