<?php require_once('../db_connection.php'); ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/admin/style.css">
    <title>Админ панель</title>
    <script src="/script/jquery-3.4.1.js"></script>
    <script src="/script/sort.js"></script>
    <script src="/script/input_mask.js"></script>
    <script src="/script/jquery.maskedinput.min.js"></script>

    <script>
        if(localStorage.getItem("color_first") != null && localStorage.getItem("color_second") != null) {
           var color_first= localStorage.getItem("color_first");
           var color_second= localStorage.getItem("color_second");

           $(":root").css("--bg-color-first", color_first);
           $(":root").css("--bg-color-second", color_second);
        }

        if(localStorage.getItem("font-size-main") != null) {
           var fontSizeMain= localStorage.getItem("font-size-main");

           $(":root").css("--font-size-main", fontSizeMain + 'px');
        }


    </script>

</head>