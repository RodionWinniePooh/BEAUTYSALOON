<?php

session_start();

$connect = mysqli_connect("localhost", "root", "", "beautysaloon");

if(isset($_SESSION['success']) && $_SESSION['success'] != '')
{
    echo $_SESSION['success'];
    unset($_SESSION['success']);
}


if(isset($_POST['update_btn_customer_user'])){

    $id = $_POST['edit_id'];


    $edit_email               = mysqli_real_escape_string($connect, trim($_POST['edit_email']));
    //$edit_phone_number        = mysqli_real_escape_string($connect, trim($_POST['edit_phone_number']));
    $edit_first_and_last_name = mysqli_real_escape_string($connect, trim($_POST['edit_first_and_last_name']));


    //$query_phone_number = "SELECT * from customer WHERE phone_number = '$edit_phone_number'";
    //$result_phone_number = mysqli_query($connect, $query_phone_number);

    //if(mysqli_num_rows($result_phone_number) == 0) {

            $query = "UPDATE `customer`  SET  email               = '$edit_email',
                                              
                                              first_and_last_name = '$edit_first_and_last_name'
                      WHERE id_customer = '$id' ";

            $result = mysqli_query($connect, $query);

            if($result)
            {
                $_SESSION['success'] = '<script>
                                            setTimeout(function(){
                                            alert( "Ваши данные были обновлены" );
                                            }, 50);
                                        </script>';
                //$_SESSION['login_user'] = $edit_phone_number;
                header('Location: /myprofile.php');
            }
            else
            {
                $_SESSION['status'] = '<script>
                                            setTimeout(function(){
                                            alert( "Ваши данные не были обновлены" );
                                            }, 50);
                                        </script>';
                header('Location: /myprofile.php');
            }
    //}
    // else{
    //     $_SESSION['success'] = '<script>
    //                                 setTimeout(function(){
    //                                 alert( "Клиент с таким номером телефона уже существует" );
    //                                 }, 50);
    //                             </script>';
    //     header('Location: /');       
    // }


}




require_once "start.php";

if(isset($_POST["button_exit"])){
    session_destroy();
    header('Location: /');
    exit;
}



?>



<!DOCTYPE html>
<html lang="ru">
        <?php 
            require_once "block/head.php";
        ?>
            
<body style="background-image: url(/library/background_service_2.jpg);">

    <div class="grid_main_user">


    <article class="article_edit_personal_data_user">

        <?php 

        //echo $_SESSION["login_user"];

        $connect = mysqli_connect("localhost", "root", "", "beautysaloon");
        $login_user = $_SESSION["login_user"];
        //echo $id;


        $query = "SELECT * FROM customer WHERE phone_number = '$login_user' ";
        $result = mysqli_query($connect, $query);
        if(!$result){ echo 'Ошибка в подключении или в запросе'; }

        foreach($result as $row)
        {
            ?>

            <form method="post" action="/myprofile.php">
                <div>
                    <input type="hidden" name="edit_id" value="<?php echo $row['id_customer'] ?>">

                    <div>
                        <h2>Редактирование личных данных</h2>
                    </div>
                    <br>
                    <div>
                        <label>Email:</label>
                    </div>
                    <br>
                    <div>
                        <input type="email" name="edit_email" placeholder="Введите email" class="input_min" required value="<?php echo $row['email'] ?>">
                    </div>
                    <br>
                    <div>
                        <label>Телефон:</label>
                    </div>
                    <br>

                    <div>
                        <input type="text" name="edit_phone_number" disabled id="phone" title="Используйте числовой формат 29*******(5)" placeholder="Введите телефон" required class="input_min"  value="<?php echo $row['phone_number'] ?>">
                    </div>

                    <script>
                    $(function(){
                        //2. Получить элемент, к которому необходимо добавить маску маска подключается через jquery
                        $("#phone").mask("+375(99)999-99-99");
                    });
                    </script>
                    <br>
                    <div>
                        <label>Фамилия и Имя:</label>
                    </div>
                    <br>
                    <div>
                        <input type="text" name="edit_first_and_last_name" placeholder="Введите фамилию и имя" required class="input_min" value="<?php echo $row['first_and_last_name'] ?>">
                    </div>
                    <br>
                    <div id="div_edit">
                        <div style="display:inline;">
                           
                                <a href="/" class="input_min btn_gray">Назад на главную</a>
                        
                        </div>
                        <div style="display:inline;">
                            <input type="submit" name="update_btn_customer_user" value="Обновить" class="rectangle_btn btn_green">
                        </div>
                    </div>
                </div>
            </form>

            <style>
                #div_edit{
                    display:block;
                }
            </style>
            
            <?php
        }
    
        ?>
    </article>

        <aside class="aside_left">
        </aside>

        <aside class="aside_right">
        </aside>

        <header class="header_logo">
      
            <a href="/"> <img src="/library/logo_svg.svg" alt="" style="max-height:60px; padding-top:15px;"></a>
            <style>
                a{
                    font-size:18px;
                    text-decoration: none;
                    color: inherit;
                }

                a:hover 
                {
                    cursor:pointer;  
                }


            </style>
        </header>
        <header class="header_li_user">  
            <form action="" method="post">
            <div style="width: 100%; margin-top:2em;">
                <div style="float:left"><a href="/">Главная страница</a></div>
                <div style="float:right"><input type="submit" name="button_exit" value="Выйти" class="rectangle_btn btn_gray" style="float:right"></div>
            </div>
            </form>
        </header>

        <!-- <header class="exit_account">
            <form action="" method="post">
                <table>
                        <tr>
                            <td style="vertical-align: middle"><label>Логин: <u><?php //echo $_SESSION[""]; ?></u></label></td>
                            <td style="vertical-align: middle">
                                
                            </td>
                        </tr>
                </table>

            </form>

        </header> -->


        <aside class="aside_table">
            <form>
                <ol class="widget-list">
                    <li><a href="/myprofile.php">     Личные данные     </a></li>
                    <li><a href="/myprofile_visit.php">      Посещения       </a></li>
                    <hr>
                    <li>


                     <a href="/myprofile.php">Настройки</a>
                   
                     
                    </li>
                    
                </ol>
            </form>
        </aside>


    </div>
</body>
</html>