<?php

session_start();
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

        $query = "SELECT 
                    Visit.id_visit,
                    Customer.first_and_last_name, 
                    Customer.phone_number, 
                    Service.name_service, 
                    Employee.full_name, 
                    Visit.date_of_visit, 
                    Visit.time_of_visit, 
                    Visit.service_provided, 
                    customer.phone_number,
                    round((100 - Customer.customer_discount) / 100 * Service.price, 2) as discount
               FROM Customer INNER JOIN Service INNER JOIN Employee INNER JOIN Visit 
               ON Customer.id_customer = Visit.id_customer AND Service.id_service = Visit.id_service AND Employee.id_employee = Visit.id_employee WHERE customer.phone_number = '$login_user'";

        //$query = "SELECT * FROM customer WHERE phone_number = '$login_user' ";
        $result = mysqli_query($connect, $query);
        if(!$result){ echo 'Ошибка в подключении или в запросе'; }

        if(mysqli_num_rows($result) > 0)
        {
            $output .= '
                <table id="myTable" class="material_table">
                    <thead> 
                    <tr id="point_cursor">
                        <th onclick="sortTable(0)">Имя и фамилия клиента</th>
                        <th onclick="sortTable(1)">Номер клиента</th>
                        <th onclick="sortTable(2)">Услуга</th>
    
                        <th onclick="sortTable(3)">Дата посещения</th>
                        <th onclick="sortTable(4)">Время посещения</th>
                        <th onclick="sortTable(5)">ФИО сотрудника</th>
                        <th onclick="sortTable(6)">Цена с учётом скидки</th>
             
                        
                        
                        <th></th>
                    </tr>
                </thead>
               
                <tbody>
                
            ';
            while($row = mysqli_fetch_array($result))
            {
                $service ='';
    
                $output .= '
        
              
                <tr>
                    <td>'.$row["first_and_last_name"].'</td>
                    <td><a href="tel:+375'.$row["phone_number"].'">'.$row["phone_number"].'</a></td>
                    <td>'.$row["name_service"].'</td>
                    <td>'.$row["date_of_visit"].'</td>
                    <td>'.$row["time_of_visit"].'</td>
                    <td>'.$row["full_name"].'</td>
                    <td>'.$row["discount"].'</td>
    
                    
    
                    <td>
                        <form method="post" action="/admin/visit/visit_edit.php">
                            <input type="hidden" name="edit_id"  value="'.$row["id_visit"].'">
                            <input type="submit" name="edit_btn" value="Редактировать" class="rectangle_btn btn_gray">
                        </form>
    
                    </td>
                </tr>
               
                ';
            }
            $output .= ' </tbody></table>';
    
            echo $output;
            mysqli_close($connect);
        }
        else
        {
            echo '<h2 style="margin:10px;">У вас пока нет посещений</h2>';
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
            <div style="width: 100%; margin-top:2em;">
                <div style="float:left"><a href="/">Главная страница</a></div>
                <div style="float:right"><input type="submit" name="button_exit" value="Выйти" class="rectangle_btn btn_gray" style="float:right"></div>
            </div>
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
                    <li><a href="/visit_user.php">      Посещения       </a></li>
                    <hr>
                    <li>


                     <a href="/setting.php">Настройки</a>
                   
                     
                    </li>
                    
                </ol>
            </form>
        </aside>


    </div>
</body>
</html>