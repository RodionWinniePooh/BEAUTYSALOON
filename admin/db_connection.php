<?php
session_start();
require_once "../start.php";
if(isset($_POST["button_exit"])){
    session_destroy();
    header('Location: /admin/auth.php');
    exit;
}
$connect = mysqli_connect("localhost", "root", "", "beautysaloon");
$query = '';
$output = '';




